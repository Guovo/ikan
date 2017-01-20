<?php

 /*==================================================================================
 *	                       搜狐本地解析插件组合开发平台
 *	
 * http://www.56.com/u85/v_MTM2MTYyOTE0.html
 *	
 ==================================================================================*/
 
	function GetVideo_FLASH($key, $hdstyle){
	
	$banben= date('Y-m-d');

//	插件名字
	$video['name'] = "☆解析插件-sohu系统☆-".$banben;
	//高清格式信息
	$hdstr = array(0 => "clear",1 =>"normal",2 => "vga",3 => "super");
	
	$video['Nowhds'] =  $hds = $hdstyle >= 0 && $hdstyle < 3 ? $hdstyle : 2;
		
	$video['mixhds'] = 3;
	
	for($i=0; $i<3; $i++){
			
			$content = getfile('http://hot.vrs.sohu.com/vrs_flash.action?vid='.$key,'http://tv.sohu.com');
			
			//if(!empty($content))break;
			
			//$content =getfile('http://my.tv.sohu.com/videinfo.jhtml?m=viewnew&vid='.$key,'http://tv.sohu.com');
			
			if(!empty($content))break;
			
		}
		
	// decode json data
	$json = json_decode($content);
	
	// get the su object, which is the uri list of the video clips
	$clips = $json->data->su;
	
	// if we get one or more video resource(s), we handle it(them)
	// continue to ge more detail like file size, video duration, uri, ect.
	if($clips > 0){
		// the video files host
		$host = 'http://sohu.vodnew.lxdns.com';
		
		// the clips bytes, which are the file size of the video clips
		$bytes = $json->data->clipsBytes;
		
		// the clips duration, which are the duration of the video clips
		$duration = $json->data->clipsDuration;
		
		// the ck object, that are the list of the keys, they are not required here.
		// if the server needs them, then we will use them
		//$key = $json->data->ck;
		
		for($i = 0; $i < count($clips); $i++){
				$video['data'][$i]['bytes'] = $bytes[$i];
				$video['data'][$i]['duration'] = $duration[$i];
				$video['data'][$i]['src'] = $host.$clips[$i];
			}
		}
			return $video;
	// Done.
}
 	function GetVideo_HTML5($key, $hdstyle, $userkey){
 		
 	if(hostmd5key()!=$userkey){
		$video['data'][0]['src']='对不起您的授权码错误，暂不能提供解析！';return $video;exit();
		} else {
				for($i=0; $i<3; $i++){	        
	        $token=getfile('http://api.lyhaoyu.cn/Index.php/Index/index/License/token/'.$userkey, '' , null);	       			
	        if(!empty($token))break;			
		     }
	       $token = json_decode($token);
	       $keytime=$token[0]->keytime;
	       	if ($keytime <= (date('Y-m-d'))){$video['data'][0]['src']='对不起您的许可码已过期，暂不能提供解析！';return $video;exit();}
	       $whtime=$token[0]->whtime;
	       $banben="2015-04-24";
	        if ($whtime <= $banben){$video['data'][0]['src']='对不起您的维护期已过期，暂不能使用此版本！';return $video;exit();}
	  } 		
	
	$um3u8 = 'http://hot.vrs.sohu.com/ipad';
	$um3u8 .= $key;
	$um3u8 .= '.m3u8';
	
  $video['data'][0]['src'] = $um3u8;
  
      if(empty($video['data'][0]['src']))return false;
		
		return $video;
}
	//客户端
?>