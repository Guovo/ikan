<?php
error_reporting(0);
header("Content-Type:text/xml;charset=utf-8");
$sign = "_";//用什么来分割，可以自己修改 改完之后传值格式也要修改 非空!(建议用默认的就好)
$hz = $sign."youku";
$a = "1001001";
$b = "1010000";
//定义全局变量
define("X", "$a");
define("Y", "$b");
define("HZ", "$hz");
define("SG", "$sign");
$url = $_GET["url"];
if ($url && $url != "") {
    $ykid = stripos($url, "v.youku.com");
    if ($ykid > "0") {
        $ykvid = checkyk($url);
        $ykdata = getyk($ykvid,$qxd);
        getckxml($ykdata);
        exit;
    }
}
$id = $_GET["id"];
if ($id && $id != "") {
    $ykid = stripos($id, "youku");
    if ($ykid > "0") {
        $ykidlists = explode(SG, $id);//cq_XOTE4NjE2MzQ4_youku
        $arrlen = count($ykidlists);//3
        // 判断分割后数组的长度，原本(cq_XOTE4NjE2MzQ4_youku)的长度为3
        if ($arrlen != 3) {//如果不等于3，就直接获取id的值，也就是下标为0的值
            $ykid = $ykidlists[0];
            $ykdata = getyk($ykid,$qxd);
            getckxml($ykdata);
            //不管有没有清晰度，默认传个空参数，避免有些空间会出错
            exit;
        }
        $qxd = $ykidlists[0];
        $ykid = $ykidlists[1];
        $ykdata = getyk($ykid,$qxd);
        getckxml($ykdata);
        exit;
    }
}
//调用出错
Get_CW();
//利用分割符来取出优酷vid值
function checkyk($url){
	//根据优酷网址的特征，利用下划线来分割,并且取到下标为2的值
    $vid = explode('_', $url);
    if ($vid[2]){
        //接着用点来分割，取出下标为0的值。也就是VID了
        $id = explode('.', $vid[2]);
    }
    if ($id[0]){
        //将VID传入取优酷视频信息的方法进行下一步操作
        return $id[0];
    }
    return;
}
function getyk($vid, $qxd){
    $api = "http://play.youku.com/play/get.json";
    $app = "&ran=";
    $ctype = "&ct=".chr(dechex(bindec(X))).chr(dechex(bindec(Y)));
    $kurl ="http://k.youku.com/player/getFlvPath/sid/";
    $url = $api . "?vid=" . $vid . $ctype . $app . rand(0,9999);
    $html = get_curl_contents($url);
    $jdata = json_decode($html);
    $jdata1 = $jdata->data;
	$oip = $jdata1->security->ip;
	$ep = $jdata1->security->encrypt_string;
    if ($ep =="") {
        return "视频不存在！";
        exit;
    }
    $stream = $jdata1->stream;
    $st = explode('_', yk_e('becaf9be', yk_na($ep)));
    $sid = $st[0];
    $token = $st[1];
    if ($sid=="") {
        echo "sidnull";
        return;
    }
    if ($token=="") {
        echo "tokennull";
        return;
    }
    $definition = $stream;
    // 当没有传指定清晰度的值的时候，默认输出最高清晰度，所以需要循环视频所有清晰度，然后再取最后一个清晰度。
    // 定义一个数组用来存放清晰度数据
    $types = array();
    // 用foreach循环来把获得的清晰度数据加入到指定数组中  可以用来智能识别清晰度的值
    foreach ($definition as $key => $v) {
        $stream_type = $v->stream_type;
        $audio_lang = $v->audio_lang;
        if ($stream_type == "3gphd") {
        //3gp清晰度一般用不到，因为是分段的，改成手机端也放不了，所以这里直接跳过
            continue;
        }
        if ($audio_lang == "default" || $audio_lang == "guoyu") {
            array_push($types, $stream_type);
        }
    }
    $xhcs = count($types);
    $hden2 = array("bq","gq","cq","hd2");
    if ($qxd == "") {
        $vtype = $hden2[count($types)-1];
        $qxurl = $vtype.SG.$vid.HZ;
        $vtype = $types[count($types)-1];
    }else{
        $vtype2 = $qxd;
        $qxurl = $vtype2.SG.$vid.HZ;
    }
    
    // 判断是否存在该清晰度
    // 重置清晰度的值 将传过来的参数cq/gq/bq/转化成原始清晰度数据
    /*如果传的参数含有清晰度则需要进一步判断*/
    // 加个if判断，提高效率，如果不加if不管参数是否带清晰度都会执行一次。
    if ($vtype2 != "") {
        for ($i=0; $i < count($types); $i++) { 
            if ($hden2[$i] == $vtype2) {
                $num = $i;
                $vtype = $types[$num];
                break;
            }
        }
        // 判断是否存在该清晰度
        if ($vtype == "") {
            $vtype = $types[count($types)-1];//如果不存在指定的清晰度，则默认输出该视频存在的最高清晰度
        }
    }
    $yktypes = array("flvhd","mp4hd","mp4hd2","mp4hd3");
    $ykhd = array("0","1","2","3");
    $ykformatname = array("flv","mp4","flv","flv");
    $ykclear = array("标清","高清","超清","1080");
    $ykarr = array("type"=>$yktypes,"hd"=>$ykhd,"fn"=>$ykformatname,"cl"=>$ykclear);
    $title = $jdata1->show->title;
    if ($title=="") {
        $title = $jdata1->video->title;
    }
    $xml["data"]["qxurl"] = $qxurl;
    $xml["data"]["defa"] = getdefa($xhcs,$vid);
    $xml["data"]["deft"] = getdeft($xhcs);
    $xml["data"]["phpself"] = $_SERVER['PHP_SELF'];
    $xml["data"]["title"] = $title;
    foreach ($stream as $key => $v) {
        $stream_fileid = $v->stream_fileid;
        $stream_type = $v->stream_type;
        if ($stream_type == $vtype) {
            $segs = $v->segs;
            $fileid_1 = substr($stream_fileid, 0, 8);
            $fileid_2 = substr($stream_fileid, 10);
            for ($i=0; $i < count($types); $i++) {
                if ($stream_type == $ykarr["type"][$i]) {
                    $hd = $ykarr["hd"][$i];
                    $formatname = $ykarr["fn"][$i];
                    $clear = $ykarr["cl"][$i];
                    break;
                }
            }
            $xml["data"]["clear"] = $clear;
            foreach ($segs as $k => $value) {
                $hex = strtoupper(dechex($k)) ."";
                if (strlen($hex) < 2)
                    $hex = '0' . $hex;
                $fileid = $fileid_1 . $hex . $fileid_2;
                $ep1 = urlencode(iconv("gbk", "UTF-8", yk_d(yk_e('bf7e5f01', $sid . '_' . $fileid . '_' . $token))));
                $key = $value->key;            
                $ts = $value->total_milliseconds_video;
                $downlink = $kurl . $sid ."_".$hex."/st/" . $formatname . "/fileid/" . $fileid. "?K=" . $key . "&hd=".$hd."&myp=0&ts=".intval($ts/1E3). "&ypp=0&ymovie=1&ctype=".str_replace("&ct=", "", $ctype)."&ev=1&token=". $token ."&oip=". $oip ."&ep=". $ep1;
                $xml["data"]["url"][$k]["downlink"] = $downlink;
                $xml["data"]["url"][$k]["size"] = $value->size;
                $xml["data"]["url"][$k]["ts"] = intval($ts/1E3);
            }
            return $xml;
        }
    }
    return;
}
function getckxml($data){
    $ckxml .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $ckxml .= "<ckplayer>\n";
    if ($data["data"]["qxurl"] != "") {
        $ckxml .= "  <flashvars>\n";
        $ckxml .= "{h->3}{a->".$data["data"]["qxurl"]."}{defa->".$data["data"]["defa"]."}{deft->".$data["data"]["deft"]."}{f->".$data["data"]["phpself"]."?id=[\$pat]}\n";
        $ckxml .= "  </flashvars>\n";
    }
    if ($data["data"]["title"] != "") {
    $ckxml .= "      <filename>\n";
    $ckxml .= "          <![CDATA[".$data["data"]["title"]."]]>\n";
    $ckxml .= "      </filename>\n";
    }
    if ($data["data"]["clear"] != "") {
        $ckxml .= "      <type>\n";
        $ckxml .= "          <![CDATA[".$data["data"]["clear"]."]]>\n";
        $ckxml .= "      </type>\n";
    }
    if ($data["data"]["createtime"] != "") {
        $ckxml .= "      <time>\n";
        $ckxml .= "          <![CDATA[".$data["data"]["createtime"]."]]>\n";
        $ckxml .= "      </time>\n";
    }
    foreach ($data["data"]["url"] as $k => $value) {
        $downlink = $value["downlink"];
        $size = $value["size"];
        $ts = $value["ts"];
        $ckxml .= "  <video>\n"; 
        $ckxml .= "      <file>\n";
        $ckxml .= "          <![CDATA[".$downlink."]]>\n";
        $ckxml .= "      </file>\n";
        if ($size != "") {
            $ckxml .= "      <size>".$size."</size>\n";
            $ckxml .= "      <seconds>".$ts."</seconds>\n";
        } 
        $ckxml .= "  </video>\n";
    }
    $ckxml .= "</ckplayer>";
    echo $ckxml;
}
function getdefa($xhcs,$vid){
    $hden2 = array("bq","gq","cq","hd2");
    for ($i=0; $i < $xhcs; $i++) { 
        if ($i>0) {
            $defa .= "|".$hden2[$i].SG.$vid.HZ;
        }else{
            $defa .= $hden2[$i].SG.$vid.HZ;
        }
    }
    return $defa;
}
function getdeft($xhcs){
    $hdcn = array("标清","高清","超清","1080P");
    for ($i=0; $i < $xhcs; $i++) { 
        if ($i>0) {
            $qxd .= "|".$hdcn[$i];
        }else{
            $qxd .= $hdcn[$i];
        }
    }
    return $qxd;
}
function yk_na($a){
    if (!$a)
        return "";
    $sz = "-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,62,-1,-1,-1,63,52,53,54,55,56,57,58,59,60,61,-1,-1,-1,-1,-1,-1,-1,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,-1,-1,-1,-1,-1,-1,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,-1,-1,-1,-1,-1";
    $h = explode(',', $sz);
    $i = strlen($a);
    $f = 0;
    for ($e = ""; $f < $i;) {
        do
            $c = $h[charCodeAt($a, $f++) & 255]; while ($f < $i && -1 == $c);
        if (-1 == $c)
            break;
        do
            $b = $h[charCodeAt($a, $f++) & 255]; while ($f < $i && -1 == $b);
        if (-1 == $b)
            break;
        $e .= fromCharCode($c << 2 | ($b & 48) >> 4);
        do {
            $c = charCodeAt($a, $f++) & 255;
            if (61 == $c)
                return $e;
            $c = $h[$c];
        } while ($f < $i && -1 == $c);
        if (-1 == $c)
            break;
        $e .= fromCharCode(($b & 15) << 4 | ($c & 60) >> 2);
        do {
            $b = charCodeAt($a, $f++) & 255;
            if (61 == $b)
                return $e;
            $b = $h[$b];
        } while ($f < i && -1 == $b);
        if (-1 == $b)
            break;
        $e .= fromCharCode(($c & 3) << 6 | $b);
    }
    return $e;
}
function yk_d($a){
    if (!$a)
        return '';
    $zm = "abcdefghijklmnopqrstuvwxyz";
    $f   = strlen($a);
    $b   = 0;
    $str = strtoupper($zm) . strtolower($zm) . '0123456789+/';
    for ($c = ''; $b < $f;) {
        $e = charCodeAt($a, $b++) & 255;
        if ($b == $f) {
            $c .= charAt($str, ($e >> 2));
            $c .= charAt($str, (($e & 3) << 4));
            $c .= "==";
            break;
        }
        $g = charCodeAt($a, $b++);
        if ($b == f) {
            $c .= charAt($str, ($e >> 2));
            $c .= charAt($str, (($e & 3) << 4 | ($g & 240) >> 4));
            $c .= charAt($str, (($g & 15) << 2));
            $c .= "=";
            break;
        }
        $h = charCodeAt($a, $b++);
        $c .= charAt($str, ($e >> 2));
        $c .= charAt($str, (($e & 3) << 4 | ($g & 240) >> 4));
        $c .= charAt($str, (($g & 15) << 2 | ($h & 192) >> 6));
        $c .= charAt($str, ($h & 63));
    }
    return $c;
}
function yk_e($a, $c){
    for ($f = 0, $i, $e = '', $h = 0; 256 > $h; $h++)
        $b[$h] = $h;
    for ($h = 0; 256 > $h; $h++) {
        $f     = ($f + $b[$h] + charCodeAt($a, $h % strlen($a))) % 256;
        $i     = $b[$h];
        $b[$h] = $b[$f];
        $b[$f] = $i;
    }
    for ($q = $f = $h = 0; $q < strlen($c); $q++) {
        $h     = ($h + 1) % 256;
        $f     = ($f + $b[$h]) % 256;
        $i     = $b[$h];
        $b[$h] = $b[$f];
        $b[$f] = $i;
        $e .= fromCharCode(charCodeAt($c, $q) ^ $b[($b[$h] + $b[$f]) % 256]);
    }
    return $e;
}
//接受一个指定的 Unicode 值，然后返回一个字符串
function fromCharCode($codes){
    if (is_scalar($codes))
        $codes = func_get_args();
    $str = '';
    foreach ($codes as $code)
        $str .= chr($code);
    return $str;
}
//返回指定位置的字符的 Unicode 编码。这个返回值是 0 - 65535 之间的整数。
function charCodeAt($str, $index){
    static $charCode = array();
    $key   = md5($str);
    $index = $index + 1;
    if (isset($charCode[$key])) {
        return $charCode[$key][$index];
    }
    $charCode[$key] = unpack("C*", $str);
    return $charCode[$key][$index];
}
/*等价于as3的charAt*/
function charAt($str, $index = 0){
    return substr($str, $index, 1);
}
//curl方法
function get_curl_contents($url){ 
    if(!function_exists('curl_init')) die('php.ini未开启php_curl.dll'); 
    $cweb = curl_init(); 
    curl_setopt($cweb,CURLOPT_URL,$url); 
    curl_setopt($cweb,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36"); 
    curl_setopt($cweb,CURLOPT_HEADER,0);
    curl_setopt($cweb,CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cweb,CURLOPT_REFERER,"http://static.youku.com/v1.0.0595/v/swf/player_yknpsv.swf");
    curl_setopt($cweb,CURLOPT_COOKIE,base64_decode("Il9feXN1aWQ9Ii50aW1lKCkuIjsi"));
    $cnt = curl_exec($cweb);
    curl_close($cweb); 
    return $cnt; 
} 
function Get_CW(){
    header("Content-Type:text/html;charset=utf-8");
    echo "illegal parameters!";
    exit;
}
?>
