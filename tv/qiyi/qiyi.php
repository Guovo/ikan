<?php
header("Content-type: text/html; charset=utf-8");
// Turn off all error reporting;关闭所有的错误 
error_reporting(0); 
        
        
        $domain_list = array("200919.com", "www.200919.com");//这里改写成上自己使用到这个播放页的域名，防止别人盗用
$is_black_list = FALSE;
$allow_empty_referer = true; //测试的时候，可以把值FALSE修改为true，但是为了防止别人盗用你的解析，请正式使用的时候修改回FALSE
$referer = $_SERVER["HTTP_REFERER"];   
   
if($referer) {
        $refererhost = parse_url($referer);
        $host = strtolower($refererhost['host']);
        if($is_black_list) {
                if (in_array($host, $domain_list)) {
                                                die;
                } else {
                    $cmpid = $_GET['cmpid'];
        $ckid = $_GET['qyvip3'];
                }
        } else {
                if($host == $_SERVER['HTTP_HOST'] || in_array($host, $domain_list)) {
                  $cmpid = $_GET['cmpid'];
        $ckid = $_GET['qyvip3'];
                } else {
                                                die;
                }
        }
} else {
        if ($allow_empty_referer) {
         $cmpid = $_GET['cmpid'];
        $ckid = $_GET['qyvip3'];
        } else {
                        die;

        }
}

        $sysary = array(

                '爱奇艺VIP解析',
                '爱站之家',

                'http://www.200919.com',
        );
        if($cmpid != '' || $ckid != ''){
                $url = $cmpid.$ckid;
                $strs = explode('_',$url);
                $vid = '';
                $proxy = '';
                $xmlt = 0;
                $isOk = false;
                $iqiyiary = array(false);
                
                
                if(strpos($url,'iqiyi.com')>-1){
                        $content = file_get_contents($url);
                        preg_match('/tvId:(.*?),/',$content,$preg);
                        $vid = trim($preg[1]);
                        $proxy = 'iqiyi';
                        preg_match('/data-player-ismember="(.*?)"/',$content,$preg);
                        if($preg[1] == 'true')
                                $iqiyiary[0] = true;
                        preg_match('/data-player-albumid="(.*?)"/',$content,$preg);
                        $iqiyiary[1] = $preg[1];
                        preg_match('/data-player-videoid="(.*?)"/',$content,$preg);
                        $iqiyiary[2] = $preg[1];
                }else if($strs[1] == 'iqiyi'){
                        $vid = $strs[0];
                        $proxy = 'iqiyi';
                        $isOk = true;
                }
                
                if($cmpid != '')
                        $xmlt = 1;
                if($ckid != '')
                        $xmlt = 2;

                if($proxy == 'iqiyi'){
                        $ary = array();
                        $ary2 = array();
                        $ary3 = array();
                        $ary4 = array();
                        if($iqiyiary[0]){
                                $vipcookie = 'BAIDUID=CB0A4721F40111149E450A6C1C9FBAAA:FG=1; PSTM=1470798394; BIDUPSID=409768ECAE8EFB4CA57A68F89E0FCDC3; H_PS_PSSID=20740_1427_18240_19860_11559_20705_20770';
                                $ut = time().rand(100,999);
                                $utt = ($ut % 1000 * intval(substr($ut,0,2)) + (100 + 0));
                                $uuid = uuid();
                                $hash = md5($iqiyiary[1].'_afbe8fd3d73448c9_'.$iqiyiary[2].'_'.$ut.'_'.$utt.'_'.intval(0 ^ 2391461978));
                                $url = 'http://serv.vip.iqiyi.com/services/ck.action?ut='.$ut.'&vid='.$iqiyiary[2].'&cid=afbe8fd3d73448c9&aid='.$iqiyiary[1].'&utt='.$utt.'&v='.$hash.'&version=1%2E0&platform=b6c13e26323c537d&uuid='.$uuid.'&playType=main';
                                $content = getUrlContent($url,$vipcookie);
                                //echo $url;
                                $json = json_decode($content,true);
                                $keys = $json['data']['t'];
                                $us = $json['data']['u'];
                                $content = file_get_contents('http://cache.vip.qiyi.com/np/'.$vid.'/'.$iqiyiary[2].'/afbe8fd3d73448c9/'.$keys.'/'.$us.'/');
                                $content = stripslashes(DecodeBytesV1(getBytes($content)));
                                preg_match('/"vs":(.*?),"vsext"/',$content,$preg);
                                $json = json_decode($preg[1],true);
                                foreach($json as $key => $val){
                                        $ary4[] = $key;
                                }
                                $gqd = $ary4[0];
                                if($isOk == true && $strs[2] != ''){
                                        $gqd = $strs[2];
                                }
                                foreach($json[$gqd]['fs'] as $key=>$val){
                                        $ary2[] = $val['s'];
                                        $ary3[] = $val['b'];
                                        $url = 'http://sf.video.qiyi.com/videos'.$val['l'].'?t='.$keys.'&cid=afbe8fd3d73448c9&vid='.$iqiyiary[2].'&QY00001='.$us.'&start='.$val['s'].'&su='.$uuid.'&client=&z=&mi=tv_415535900_415535900_'.$json[$gqd]['fid'].'&bt=&ct=&e=&tn='.time();
                                        $content = file_get_contents($url);
                                        $jsons = json_decode($content,true);
                                        /*$tary = array(
                                                'tvid'=>$vid,
                                                'albumid'=>$iqiyiary[1],
                                                'videoid'=>$iqiyiary[2],
                                                'gqd'=>$gqd,
                                                'fd'=>$key
                                        );传递保留*/
                                        $url = str_replace("\n",'',preg_replace('/http:\/\/.+\/videos\//is','http://wgdcdn.inter.qiyi.com/videos/',$jsons['l']));
                                        preg_match('/http:\/\/(.*?)&src=iqiyi.com/',$url,$preg);
                                        $ary[] = 'http://'.$preg[1];
                                        //$ary[] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?qiyi='.str_replace('=','',base64_encode($url));
                                }
                                for($i = 0;$i < count($ary2);$i++){
                                        $ary2[$i] = (($i == count($ary2) - 1)?($json[$gqd]['duration']*1000 - $ary2[$i]):($ary2[$i + 1] - $ary2[$i]))/1000;
                                }
                        }else{
                                $content = file_get_contents('http://mixer.video.iqiyi.com/jp/mixin/videos/'.$vid);
                                $json = json_decode(str_replace('var tvInfoJs=','',$content),true);
                                $videoid = $json['vid'];
                                $tvid = $json['tvId'];
                                $uuid = uuid();
                                $content = getUrlContent('http://cache.video.qiyi.com/vp/'.$tvid.'/'.$videoid.'/');
                                $json = json_decode($content,true);
                                foreach($json['tkl'][0]['vs'] as $key => $val){
                                        $ary4[] = $key;
                                }
                                $gqd = $ary4[0];
                                if($isOk == true && $strs[2] != ''){
                                        $gqd = $strs[2];
                                }
                                foreach($json['tkl'][0]['vs'][$gqd]['fs'] as $key=>$val){
                                        $Link = $val['l'];
                                        if(strstr($val['l'],'-',true) != '')
                                                $Link = GetQiyLink($val['l']);
                                        $Size = $val['b'];
                                        $Length = $val['s'];
                                        $t = time();
                                        preg_match_all('/\/([a-z0-9]*).f4v/',$Link,$Links);
                                        $linkHash = floor(doubleval($t)/600.0).')(*&^flash@#$%a'.$Links[1][0];
                                        $dispathKey = md5($linkHash);
                                        $url = 'http://data.video.qiyi.com/'.strtolower($dispathKey).'/videos'.$Link.'?su='.$uuid.'&qyid='.uuid().'&tn='.rand();
                                        $cts = file_get_contents($url);
                                        $jsons = json_decode($cts,true);
                                        $ary[] = preg_replace('/http:\/\/.+\/videos\//is','http://wgdcdn.inter.qiyi.com/videos/',$jsons['l']);
                                        $ary2[] = $Length;
                                        $ary3[] = $Size;
                                }
                                for($i = 0;$i < count($ary2);$i++){
                                        $ary2[$i] = (($i == count($ary2) - 1)?($json['tkl'][0]['vs'][$gqd]['duration']*1000 - $ary2[$i]):($ary2[$i + 1] - $ary2[$i]))/1000;
                                }
                        }
                }
                
                if($xmlt == 1){
                        header('Content-Type:text/xml;');
                        echo arrayXmlCMP($ary,$ary2,$ary3);
                        return;
                }
                if($xmlt == 2){
                        header('Content-Type:text/xml;');
                        echo arrayXmlCK($ary,$ary2,$ary3,$ary4,$vid,$gqd,$proxy);
                        return;
                }
                return;
        }
        if($qiyi != ''){
                $url = base64_decode($qiyi);
                $content = file_get_contents($url);
                $json = json_decode($content,true);
                $url = preg_replace('/http:\/\/.+\/videos\//is','http://wgdcdn.inter.qiyi.com/videos/',$json['l']);
                header('Location: '.$url);
        }
        echo '提示:参数错误!<br />本程序只做学习参考,请勿使用本解析用作商业用途,原创作者将不负任何责任,请合理使用';
        function DecodeBytesV1($param1){
                $loc3 = count($param1);
                $loc5 = 20110218;
                $loc6 = intval($loc5 % 100);
                $loc7 = $loc3 % 4;
                $loc2 = array();
                $loc4 = 0;
                while ($loc4 + 4 <= $loc3)
                {
                        $temp = $param1[$loc4] << 24 | $param1[$loc4 + 1] << 16 | $param1[$loc4 + 2] << 8 | $param1[$loc4 + 3];
                        $loc8 = $temp < 0 ? intval(4294967295 + $temp + 1) : intval($temp);
                        $loc8 = $loc8 ^ intval($loc5);
                        $loc8 = rotate_right($loc8, $loc6);
                        $loc2[$loc4] = ($loc8 & 4278190080) >> 24;
                        $loc2[$loc4 + 1] = ($loc8 & 16711680) >> 16;
                        $loc2[$loc4 + 2] = ($loc8 & 65280) >> 8;
                        $loc2[$loc4 + 3] = $loc8 & 255;
                        $loc4 = $loc4 + 4;
                }
                $loc4 = 0;
                while ($loc4 < $loc7)
                {
                        $loc2[$loc3 - $loc7 - 1 + $loc4] = $param1[$loc3 - $loc7 - 1 + $loc4];
                        $loc4++;
                }
                return byteToStr($loc2);
        }
        function rotate_right($param1,$param2)
        {
                $param1 = uint($param1);
                $loc4 = 0;
                while ($loc4 < intval($param2))
                {
                        $loc3 = $param1 & 1;
                        $param1 = $param1 >> 1;
                        $loc3 = $loc3 << 31;
                        $param1 = $param1 + $loc3;
                        $loc4++;
                }
                return $param1;
        }
        function getBytes($string){
        $bytes = array();
        for($i = 0; $i < strlen($string); $i++){
             $bytes[] = ord($string[$i]);
        }
        return $bytes;
    }
        function integerToBytes($val) {
        $byt = array();
        $byt[0] = ($val & 0xff);
        $byt[1] = ($val >> 8 & 0xff);
        $byt[2] = ($val >> 16 & 0xff);
        $byt[3] = ($val >> 24 & 0xff);
        return $byt;
    }
        function byteToStr($bytes){
        $str = '';
        foreach($bytes as $ch) {
            $str .= chr($ch);
        }
        return $str;
    }
        function urlBin($url){
                global $videoyes;
                $index = -1;
                for($i = 0;$i < count($videoyes);$i++){
                        $str = strstr($url,$videoyes[$i],true);
                        if($str!='')$index = $i;
                }
                return $index;
        }
        function arrayXmlCMP($ary,$ary2,$ary3){
                global $sysary;
                $str = '<m label="'.$sysary[0].'" version="'.$sysary[1].'" url="'.$sysary[2].'" auth="'.$sysary[3].'" type="2" bg_video="{xywh:[0,0,100P,100P]}">';
                if(count($ary) > 0 && $ary[0] != ''){
                        for($i = 0;$i < count($ary);$i++){
                                $str .= '<u bytes="'.$ary3[$i].'" duration="'.$ary2[$i].'" src="'.str_replace('&','&',$ary[$i]).'"/>';
                        }
                }else{
                        $str .= '<u bytes="50429" duration="10" src="'.$sysary[4].'"/>';
                }
                $str .= '</m>';
                return $str;
        }
        function arrayXmlCK($ary,$ary2,$ary3,$ary4,$vid,$gqd,$proxy){
                global $sysary;
                $str = '<ckplayer><plugins><name><![CDATA['.$sysary[0].']]></name><version><![CDATA['.$sysary[1].']]></version><url><![CDATA['.$sysary[2].']]></url><auth><![CDATA['.$sysary[3].']]></auth></plugins>';
                if(count($ary) > 0 && $ary[0] != ''){
                        $index = array_search($gqd,$ary4);
                        $str .= '<flashvars>{h->'.($index+1).'}{a->'.$vid.'_'.$proxy.'_'.$ary4[$index].'}{defa->';
                        for($i = 0;$i < count($ary4);$i++){
                                if($i == 0)
                                        $str .= $vid.'_'.$proxy.'_'.$ary4[$i];
                                else
                                        $str .= '|'.$vid.'_'.$proxy.'_'.$ary4[$i];
                        }
                        $str .= '}{deft->';
                        for($i = 0;$i < count($ary4);$i++){
                                if($i == 0)
                                        $str .= $ary4[$i];
                                else
                                        $str .= '|'.$ary4[$i];
                        }
                        $str .= '}{f->http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?ckid=[$pat]}</flashvars>';
                        for($i = 0;$i < count($ary);$i++){
                                $str .= '<video><file><![CDATA['.str_replace('&','&',$ary[$i]).']]></file></video><seconds>'.$ary2[$i].'</seconds><size>'.$ary3[$i].'</size>';
                        }
                }else{
                        $str .= '<video><file><![CDATA['.$sysary[4].']]></file><seconds>10</seconds><size>50429</size></video>';
                }
                $str .= '</ckplayer>';
                return $str;
        }
        function getUrlContent($url,$cookie,$data,$ref){
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                $header = array();
                if($ref != '')
                        $header[] = 'Referer: '.$ref;
                if($cookie != '')
                        $header[] = 'Cookie: '.$cookie;
                $header[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.87 Safari/537.36 QQBrowser/9.2.5584.400';
                curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
                if($data != ''){
                        curl_setopt($ch,CURLOPT_POST,1);
                        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
                }
                curl_setopt($ch,CURLOPT_TIMEOUT,3);
                $content = curl_exec($ch);
                curl_close($ch);
                return $content;
        }


        function http_status($url) {
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_HEADER,1);
                curl_setopt($ch,CURLOPT_NOBODY,1);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_exec($ch);
                $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
                curl_close($ch);
                return $status;
        }
        function uuid(){
                if (function_exists('com_create_guid')){
                        return com_create_guid();
                }else{
                        mt_srand((double)microtime()*10000);
                        $charid = strtoupper(md5(uniqid(rand(), true)));
                        $hyphen = chr(45);
                        $uuid = chr(123).substr($charid, 0, 8).$hyphen.substr($charid, 8, 4).$hyphen.substr($charid,12, 4).$hyphen.substr($charid,16, 4).$hyphen.substr($charid,20,12).chr(125);
                        return strtolower(str_replace('-','',str_replace('}','',str_replace('{','',$uuid))));
                }
        }
        function GetQiyLink($strs)
        {
                $loc6 = 0;
                $loc2 = '';
                $loc3 = split('-',$strs);
                $loc4 = count($loc3);
                $loc5 = $loc4 - 1;
                while($loc5 >= 0)
                {
                        $loc6 = uint(GetVrsxorCode(intval($loc3[$loc4 - $loc5 - 1],16),$loc5));
                        $loc2 = fromCharCode($loc6).$loc2;
                        $loc5--;
                }
                return $loc2;
        }
        function fromCharCode($codes) {
           if (is_scalar($codes)) $codes= func_get_args();
           $str= '';
           foreach ($codes as $code) $str.= chr($code);
           return $str;
        }
        function GetVrsxorCode($strs1,$strs2)
        {
                $strs1 = uint($strs1);
                $strs2 = uint($strs2);
                $loc3 = intval($strs2 % 3);
                if($loc3 == 1)
                {
                        return $strs1 ^ 121;
                }
                if($loc3 == 2)
                {
                        return $strs1 ^ 72;
                }
                return $strs1 ^ 103;
        }
        function uint($var) {
                if (is_string($var)) {
                        if (PHP_INT_MAX > 2147483647) {
                                $var = intval($var);
                                $var = $var + 1 - abs($var - 4294967295);
                        } else {
                                $var = floatval($var);
                        }
                }
                if (!is_int($var)) {
                        $var = intval($var);
                }
                if ((0 > $var) || ($var > 4294967295)) {
                        $var &= 4294967295;
                        if (0 > $var) {
                                $var = sprintf('%u', $var);
                        }
                }
                return $var;
        }


?>