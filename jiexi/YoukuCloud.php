<?php
	header("Content-type: text/json; charset=utf-8"); 
	if(empty($_REQUEST['vid'])){

	}else{
		$vid=$_REQUEST['vid'];
		$stream_types['flv']['quality']='flv';
		$stream_types['3gphd']['quality']='mp4';
		$stream_types['flvhd']['quality']='flv';
		$stream_types['mp4hd']['quality']='mp4';
		$stream_types['mp4hd2']['quality']='hd2';
		$stream_types['mp4hd3']['quality']='hd3';
		$gid = get_embsig($vid);
		$data=curl_tGet("https://api.youku.com/players/custom.json?type=h5&client_id=908a519d032263f8&video_id=$vid&refer=http://cdn.aixifan.com/player/sslhomura/AcFunV3Player161009.swf&vext=null&embsig=$gid&styleid=undefined&type=hd3");
		$objt=json_decode($data,true);
		$sign=$objt['playsign'];
		$data=curl_tGet("http://play.youku.com/partner/get.json?vid=$vid&ct=86&cid=908a519d032263f8&sign=$sign");
		$objt=json_decode($data,true);
		$oip=$objt['data']['security']['ip'];
		$encrypt_string=$objt['data']['security']['encrypt_string'];
		$stream=$objt['data']['stream'];
		list($sid,$token)=explode("_", Security($encrypt_string));
		$ep=getEncryptStr($sid."_".$vid."_".$token);
		$app_m3u8 = 'http://pl.youku.com/partner/m3u8?vid='.$vid.'&type=hd2&ep='.$ep.'&sid='.$sid.'&token='.$token.'&ctype=86&ev=1&oip='.$oip.'';
        header('Content-Type: application/x-mpegurl;charset=UTF-8');
        header('Location:'.$app_m3u8);
	}
	function get_youku_m3u8($encrypt_string,$oip,$vid,$type){
		list($sid,$token)=explode("_", Security($encrypt_string));
		$ep=getEncryptStr($sid."_".$vid."_".$token);
		$downlink = "http://pl.youku.com/partner/m3u8?vid=$vid&type=hd2&ep=$ep&sid=$sid&token=$token&ctype=86&ev=1&oip=$oip";
		return $downlink;
	}
	function get_embsig($vid){
	$VERSION = '1';
	$TIMESTAMP = time();
	$CLIENT_SECRET = 'a413bf8e1ac536a36203a01adbddd272';
	$s = $vid.'_'.$TIMESTAMP.'_'.$CLIENT_SECRET;
	$gid = $VERSION.'_'.$TIMESTAMP.'_'.md5($s);
	return $gid;
}
	function curl_tGet($url){
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('deviceType:2'));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $src = curl_exec($curl);
        curl_close($curl);
        return $src;
    }
	function getEncryptStr($e){
		$t='msjv7h2b';
		return urlencode(encode64(rc4($t,$e)));
	}
	function Security($encrypt_string){
		$i=rc4("10ehfkbv",decode64($encrypt_string));
		return $i;
	}
	function rc4($t,$e){
		for ($n=0,$i=array(),$r=0,$o="",$a=0; 256>$a ;$a++) { 
			$i[$a]=$a;
		}
		for($a=0;256>$a;$a++){
			$r=($r+$i[$a]+charCodeAt($t,$a%strlen($t)))%256;
			$n=$i[$a];
			$i[$a]=$i[$r];
			$i[$r]=$n;
		}
		$a=0;
		$r=0;
		for($s=0;$s<strlen($e);$s++){
			$a=($a+1)%256;
			$r=($r+$i[$a])%256;
			$n=$i[$a];
			$i[$a]=$i[$r];
			$i[$r]=$n;
			$o.=fromCharCode(charCodeAt($e,$s)^$i[($i[$a]+$i[$r])%256]);
		}
		return $o;
	}
	function decode64($t){
		$e; $n; $i; $r; $o; $a; $s; $u = array(-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,62,-1,-1,-1,63,52,53,54,55,56,57,58,59,60,61,-1,-1,-1,-1,-1,-1,-1,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,-1,-1,-1,-1,-1,-1,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,-1,-1,-1,-1,-1);
		for($a=strlen($t),$o=0,$s="";$a>$o;){
			do
				$e=$u[255 & charCodeAt($t,$o++)];
			while($a>$o && -1==$e);if(-1==$e)
				break;
			do
                $n = $u[255 & charCodeAt($t,$o++)];
            while ($a > $o && -1 == $n);if (-1 == $n)
                    break;
            $s .= fromCharCode($e << 2 | (48 & $n) >> 4);
            do {
            	$i = 255 & charCodeAt($t,$o++);
                if (61 == $i)
                        return $s;
                    $i = $u[$i];
            } while ($a > $o && -1 == $i);if (-1 == $i)
                    break;
            $s .= fromCharCode((15 & $n) << 4 | (60 & $i) >> 2);
            do {
                $r = 255 & charCodeAt($t,$o++);
                if (61 == $r)
                    return $s;
                $r = $u[$r];
            } while ($a > $o && -1 == $r);if (-1 == $r)
                    break;
            $s .= fromCharCode((3 & $i) << 6 | $r);
        }
        return $s;
	}
	function encode64($t){
		$e;$n;$i;$r;$o;$a;$s="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
		for($i=strlen($t),$n=0,$e="";$i>$n;){
			$r = 255 & charCodeAt($t,$n++);
			if ($n == $i){
				$e .= charAt($s,$r >> 2);
                $e .= charAt($s,(3 & $r) << 4);
                $e .= "==";
                break;
			}
			$o = charCodeAt($t,$n++);
			if($n==$i){
				$e .= charAt($s,$r >> 2);
                $e .= charAt($s,(3 & $r) << 4 | (240 & $o) >> 4);
                $e .= charAt($s,(15 & $o) << 2);
                $e .= "=";
                break;
			}
			$a = charCodeAt($t,$n++);
                $e .= charAt($s,$r >> 2);
                $e .= charAt($s,(3 & $r) << 4 | (240 & $o) >> 4);
                $e .= charAt($s,(15 & $o) << 2 | (192 & $a) >> 6);
                $e .= charAt($s,63 & $a);
		}
		return $e;
	}
	function charAt($str,$index){
        return substr($str, $index,1);
    }
    function charCodeAt($str,$index){
        return ord(substr($str, $index,1));
    }
    function fromCharCode($codes) {
	   if (is_scalar($codes)) $codes= func_get_args();
	   $str= '';
	   foreach ($codes as $code) $str.= chr($code);
	   return $str;
	}
        
        