<?php

 /*==================================================================================
 *	                       乐视本地解析插件组合开发平台
 *	
 * http://www.letv.com/ptv/vplay/22350337.html
 *	
 ==================================================================================*/
 
	function GetVideo_FLASH($key, $hdstyle){
	
	$banben= date('Y-m-d');

	//插件名字
	$video['name'] = "☆解析插件-letv系统☆-".$banben;
	
	//高清格式信息
	$hdstr = array(0 => "720P",1 => "350",2 => "1080P",3 => "1000");
	
	$video['Nowhds']  = $hds = $hdstyle >= 0 && $hdstyle < 4 ? $hdstyle : 3;
		
	$video['mixhds'] = 4;

	//许可
	$url = 'http://api.letv.com/time?tn='.microtime();
	$content = getfile($url,'http://www.letv.com');
  $content = json_decode($content);
  if(empty($content->stime)) return;
  $tkey = GenerateKey($content->stime);
  //GenerateKey(time())
  if(!is_numeric($tkey)) return;
	//加载信息
	$info = getfile('http://api.letv.com/mms/out/video/playJson?id='.$key.'&platid=1&splatid=101&domain=www.letv.com&tkey='.$tkey,'http://www.letv.com' , null);
  $json = json_decode($info);
  $playurl = $json->playurl;
  //视频标题
  if(!empty($playurl->title))$video['subject'] = $playurl->title;
           
  //视频路径
  $hd = $hdstr[$hds];
  $i=0;
  if(!empty($playurl->duration))$video['data'][$i]['duration'] = $playurl->duration;
  
    $domain = $playurl->domain[0]; 
  
		$ur = $json->playurl->dispatch;
		$dispatch = get_object_vars($ur);
		 //Ultra-clear format
		if(array_key_exists("1000", $dispatch))
			$vurl = $dispatch["1000"][0];
		 //1080P format
		elseif(array_key_exists("1080P", $dispatch))
			$vurl = $dispatch["1080P"][0];
		 //720p format
		elseif(array_key_exists("720P", $dispatch))
			$vurl = $dispatch["720P"][0];
		 //ormal format
		else
			$vurl = $dispatch["350"][0];
      $url = str_replace("tss=ios", "tss=no", $vurl).'&format=1&sign=letv&expect=3000&rateid='.$hd;
      $dour= $domain.$url;
      $vid = getfile($dour,'http://www.letv.com');
      $content = json_decode($vid);
        $video['data'][$i]['src'] = $content->location;
      
        		if(empty($video['data'][0]['src']))return false;
		
		return $video;
	}

 	function GetVideo_HTML5($key, $hdstyle){
 		
 	
	
	//高清格式信息
	$hdstr = array(0 => "720P",1 => "350",2 => "1080P",3 => "1000");
	
	$video['Nowhds']  = $hds = $hdstyle >= 0 && $hdstyle < 4 ? $hdstyle : 0;
		
	$video['mixhds'] = 4;

	//许可
	$url = 'http://api.letv.com/time?tn='.microtime();
	$content = getfile($url,'http://www.letv.com');
  $content = json_decode($content);
  if(empty($content->stime)) return;
  $tkey = GenerateKey($content->stime);
  //GenerateKey(time())
  if(!is_numeric($tkey)) return;
	//加载信息..//  http://api.letv.com/mms/out/common/geturl/http://api.letv.com/mms/out/video/playJson
	$info = getfile('http://api.letv.com/mms/out/video/playJson?id='.$key.'&platid=1&splatid=101&domain=www.letv.com&tkey='.$tkey,'http://m.letv.com' , null);
  $json = json_decode($info);
  $playurl = $json->playurl;               
  //视频路径
  $hd = $hdstr[$hds];

    //乐视域名
  $domain = $playurl->domain[0]; 
		$ur = $json->playurl->dispatch;
		$dispatch = get_object_vars($ur);
		 //Ultra-clear format
		if(array_key_exists("1000", $dispatch))
			$vurl = $dispatch["1000"][0];
		 //1080P format
		elseif(array_key_exists("1080P", $dispatch))
			$vurl = $dispatch["1080P"][0];
		 //720p format
		elseif(array_key_exists("720P", $dispatch))
			$vurl = $dispatch["720P"][0];
		 //ormal format
		else
			$vurl = $dispatch["350"][0];
      $url = str_replace("tss=ios", "tss=no", $vurl).'&format=1&sign=letv&expect=3000&rateid='.$hd;    
      $dour= $domain.$url;
      $vid = getfile($dour,'http://www.letv.com');
      $content = json_decode($vid);
      $video['data'][0]['src'] = $content->location;
      
        		if(empty($video['data'][0]['src']))return false;
		
		return $video;
}
/*
function GenerateKey($t){
	for($e, $s = 0; $s < 8; $s++){
    	$e = 1 & $t;
    	$t >>= 1; 
    	$e <<= 31; 
    	$t += $e;
	}
	return $t^185025305;
}*/


/*
function GenerateKeyRor($value, $key) {
        $i = 0;
        while ( $i < $key ) {
                $value = (0x7fffffff & ($value >> 1)) | (($value & 1) << 31);
                ++ $i;
        }
        return $value;
}
function GenerateKey($stime) {
        $key = 773625421;
        $value = GenerateKeyRor ( $stime, $key % 13 );
        $value = $value ^ $key;
        $value = GenerateKeyRor ( $value, $key % 17 );
        return $value;
        }

*/


function GenerateKeyRor($value, $key){
        $i = 0;
        while($i < $key){
                $value = (2147483647 & ($value >> 1)) | (($value & 1) << 31);
                ++ $i;
        }
        return $value;
}

function GenerateKey($stime){
        $key = 773625421;
        $value = GenerateKeyRor($stime, $key % 13);
        $value = $value ^ $key;
        $value = GenerateKeyRor($value, $key % 17);
        return $value;
}



?>