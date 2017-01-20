<?php

 /*==================================================================================
 *	                       56本地解析插件组合开发平台
 *	
 * http://www.56.com/u85/v_MTM2MTYyOTE0.html
 *	
 ==================================================================================*/
	
	function GetVideo_FLASH($key, $hdstyle){
	$banben= date('Y-m-d');

	//插件名字
	$video['name'] = "☆解析插件-56系统☆-".$banben;
	//高清格式信息
	$hdstr = array(0 => "normal",1 => "clear",2 => "super");
	
	$video['Nowhds'] = $hdstyle >= 0 && $hdstyle < 3 ? $hdstyle : 2;
		
	$video['mixhds'] = 2;

	for($i=0; $i<3; $i++){
			
			$info = getfile('http://vxml.56.com/json/'.$key.'/?src=out', 'http://vxml.56.com' , null);
			
			if(!empty($info))break;
			
		}

   $json = json_decode($info);
   $data = $json->info;

		if(!empty($data->Subject))$video['subject'] = $data->Subject;
		$i= 0;
		foreach ($data->rfiles as $value) {
    if(!empty($value->filesize))$video['data'][$i]['bytes'] = $value->filesize;
    if(!empty($value->totaltime))$video['data'][$i]['duration'] = $value->totaltime;
    if(!empty($value->url))$video['data'][$i]['src'] = $value->url;
    	}			
		if(empty($video['data'][0]['src']))return false;
		
		return $video;
	}
	

?>