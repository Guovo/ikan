<?php

 /*==================================================================================
 *	                       央视本地解析插件组合开发平台
 *	
 * http://tv.cntv.cn/video/VSET100157955652/4578e895c6d54968a8f1b76db2204f54
 *	
 ==================================================================================*/
	
	function GetVideo_FLASH($key, $hdstyle){
	
	$banben= date('Y-m-d');

	//插件名字
	$video['name'] = "☆解析插件-cntv系统☆-".$banben;
	//高清格式信息
	$hdstr = array(0 => "lowChapters",1 => "chapters");
	
	$video['Nowhds']  = $hds = $hdstyle >= 0 && $hdstyle < 3 ? $hdstyle : 2;
		
	$video['mixhds'] = 2;

	for($i=0; $i<3; $i++){
			
			$info = getfile('http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid='.$key, 'http://www.cntv.cn' , null);
			
			if(!empty($info))break;
			
		}

   $json = json_decode($info);
   $data = $json;

		if(!empty($data->title))$video['subject'] = $data->title;
		$i= 0;
		$data = $data->video->$hdstr[$hds];
		foreach ($data as $value) {
//    if(!empty($value->filesize))$video['data'][$i]['bytes'] = $value->filesize;
    if(!empty($value->duration))$video['data'][$i]['duration'] = $value->duration;
    if(!empty($value->url))$video['data'][$i]['src'] = $value->url;
    $i++;
    	}			
		if(empty($video['data'][0]['src']))return false;
		
		return $video;
	}
	
	 function GetVideo_HTML5($key, $hdstyle){
 		
	for($i=0; $i<3; $i++){
			
			$info = getfile('http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid='.$key, 'http://www.cntv.cn' , null);
			
			if(!empty($info))break;
			
		}

   $json = json_decode($info);
   $data = $json;
   
	 $video['data'][0]['bpsrc'] = $data->hls_url;
		
		if(empty($video['data'][0]['src'])){
		
			$video['data'][0]['src'] = $data->hls_url;
			
			$video['data'][0]['bpsrc'] = null;
			
		}

		if(empty($video['data'][0]['src']))return false;
		
		return $video;
		
	}
?>