<?php

 /*==================================================================================
 *	                       新浪本地解析插件组合开发平台
 *	
 * http://video.sina.com.cn/movie/detail/201503061219618
 *	
 ==================================================================================*/
 
	function GetVideo_FLASH($key, $hdstyle){
	
		$banben= date('Y-m-d');

//	插件名字
	$video['name'] = "☆解析插件-sina系统☆-".$banben;
	

//高清格式信息
	$hdstr = array(0 => "720P",1 => "350",2 => "1080P",3 => "1000");
	
	$video['Nowhds']  = $hds = $hdstyle >= 0 && $hdstyle < 4 ? $hdstyle : 2;
		
	$video['mixhds'] = 4;

	//加载信息
	$url=geturl($key);
	
		for($i=0; $i<3; $i++){
			
	    $info = getfile($url,'http://video.sina.com.cn' , null);
	    
			if(!empty($info))break;
			
		}
	preg_match('#\<vname\>\<\!\[CDATA\[(.*?)\]\>\<\/vname\>#i', $info, $subject);
	//preg_match_all('#\<filesize\>(.*?)\<\/filesize\>#i', $info, $bytes);
	//preg_match_all('#\<length\>(.*?)\<\/length\>#i', $info, $duration);
	preg_match_all('#\<url\>\<\!\[CDATA\[(.*?)\]\]\>\<\/url\>#i', $info, $vurl);

  $i=0; 
  if(!empty($subject))$video['subject'] = $subject[1];
//  if(!empty($bytes))$video['data'][$i]['bytes'] = $bytes[$ia];
// if(!empty($duration))$video['data'][$i]['duration'] = $duration[$ia];
   
  foreach($vurl[1] as $value){
	
			if(!empty($value))$video['data'][$i]['src'] = $value;
		
			$i++;
 }
	if(empty($video['data'][0]['src']))return false;	

		return $video;
	}

 	function GetVideo_HTML5($key, $hdstyle){
 		
 	
	//加载信息
	$url=geturl($key);
	
		for($i=0; $i<3; $i++){
			
	    $info = getfile($url,'http://video.sina.com.cn' , null);
	    
			if(!empty($info))break;
			
		}

	preg_match_all('#\<url\>\<\!\[CDATA\[(.*?)\]\]\>\<\/url\>#i', $info, $vurl);

  $i=0; 

   
  foreach($vurl[1] as $value){
	
			if(!empty($value))$video['data'][$i]['src'] = $value;
		
			$i++;
 }
	if(empty($video['data'][0]['src']))return false;	

		return $video;
	}


/*   function GetVideo_HTML5($key, $hdstyle){
	
	$info = 'http://v.iask.com/v_play_ipad.php?vid='.$key;
	$isfile = get_headers($info);
  $result = str_replace("Location: ","",$isfile[6]);
  	
  if(!empty($result))$video['data'][0]['src'] = $result;
  
      if(empty($video['data'][0]['src']))return false;
		
		return $video;
}*/


function geturl($vid){
	function code(){}
   $rand = rand(0,100000)/100000;
   $code1 = code(time() /1000);
   $str1 = "Z6prk18aWxP278cVAH";
   $str = $vid.$str1.$code1.$rand;
   $hash = md5($str);
   $k = substr($hash,0,16).$code1;
   $url='http://v.iask.com/v_play.php?vid='.$vid .'&referrer=http://v.iask.com&ran='.$rand.'&p=i&k='.$k.'&r=video.sina.com.cn&v=4.1.43.10';
  return  $url;
}

?>