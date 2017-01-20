<?php

 /*==================================================================================
 *	                       本地解析插件组合开发平台
 *	
 * http://v.yinyuetai.com/video/2272512
 *	
 ==================================================================================*/
 
	function GetVideo_FLASH($key, $hdstyle, $userkey){
	
	$banben= date('Y-m-d');

//	插件名字
	
	$video['name'] = "☆解析插件-yinyuetai系统☆-".$banben;
	
	$hdstr = array(0 => "hc",1 => "hd",2 => "he");
	
	$video['Nowhds'] = $hdstyle >= 0 && $hdstyle < 3 ? $hdstyle : 2;
	
	for($i=0; $i<3; $i++){
		
		$c = getfile('http://www.yinyuetai.com/insite/get-video-info?flex=true&videoId='.$key, 'http://www.yinyuetai.com', null);
		
		if(strpos($c, '.flv') !== false)break;
		
	}
	
	for($s=0, $mhds = 0;$s<count($hdstr);$s++){
		
		if(strpos($c, 'http://'.$hdstr[$s].'.yinyuetai.com/uploads/videos/common/') !== false)$mhds++;
		
		if($mhds > 2 || $s > 2)break;
			
	}
	
	$video['mixhds'] = isset($mhds) ? $mhds : null;
	
	$video['Nowhds'] = min($video['mixhds']-1, $video['Nowhds']);
	
	preg_match_all('#http:\/\/h.*?sc=[0-9A-Za-z]+\&br=[0-9A-Za-z]+#is', $c, $flv);
	if(empty($flv[0][0]))preg_match_all('#http:\/\/h.*?sc=[0-9A-Za-z]+#is', $c, $flv);
	if(empty($flv[0][0]))preg_match_all('#http:\/\/h.*?\.flv#is', $c, $flv);
	
	if(!empty($flv[0][$video['Nowhds']]))$video['data'][0]['src'] = $flv[0][$video['Nowhds']];
	
	return $video;
}

 	function GetVideo_HTML5($key, $hdstyle){
 		
	for($i=0; $i<3; $i++){
		
		$c = getfile('http://m.yinyuetai.com/video/'.$key, 'http://m.yinyuetai.com', null);
		
		preg_match('/videoUrl[\s]:[\s]\"(.*?)\",/', $c, $mp4);
		if(empty($mp4[1]))preg_match('/window\.location\.herf[\s]=[\s]\"(.*?)\";/', $c, $mp4);
		if(empty($mp4[1]))preg_match('/video[\s]preload[\s]controls[\s]x-webkit-airplay=\"allow\" src=\"(.*?)\"/', $c, $mp4);
		if(empty($mp4[1]))preg_match('/a class=\"video-cover\"[^>]*href=\"(.*?)\">/', $c, $mp4);
		if(empty($mp4[1]))preg_match('/source src=\"(.*?)\"/', $c, $mp4);

		if(!empty($mp4[1]))break;
		
	}
	
	if(!empty($mp4[1]))$video['data'][0]['src'] = $mp4[1];

	
	return $video;	
}

?>