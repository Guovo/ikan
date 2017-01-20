<?php

 /*==================================================================================
 *	                       风行本地解析插件组合开发平台
 *	
 * http://api.ghcd.cc/funid/115237
 *	
 ==================================================================================*/
 
	function GetVideo_FLASH($key, $hdstyle){
	
	$banben= date('Y-m-d');

//	插件名字
	 $video['name'] = "☆解析插件-fun系统☆-".$banben;
	 
      list($videoid_str, $key_str) = explode('_', strrev($key), 2);
      $vodkey = strrev($key_str);
      $videoid = strrev($videoid_str);
  //获取数据
     $content = getfile('http://api.funshion.com/ajax/vod_panel/'.$key.$vodkey.'/w-1','api.funshion.com');
     $data = json_decode($content);
     $data = $data->data->fsps->mult;  

  if(!empty($vodkey)){
  	  $i=0; 
  //得到集数   
    foreach($data as $value){
			$serialid[$i] = $value->serialid;
			$hashid[$i] = $value->hashid;
			$full[$i] = $value->full;
			$i++;
    }
 //得到full
  $full = array_combine($serialid, $full);
  $full = $full[$videoid];
 //得到集数的hashid
  $data = array_combine($serialid, $hashid);
  $data = $data[$videoid];
 }else{
 			$full = $data[0]->name;
			$data = $data[0]->hashid;
	}
 //组建json
 $content = getfile('http://jobsfe.funshion.com/query/v1/mp4/'.$data.'.json','http://api.funshion.com');
 $json = json_decode($content);
 //得到标题
 	if(!empty($full))$video['subject'] = $full;
 //得到bytes
 $bits = $json->playlist[0]->bits;
 $video['data'][0]['bytes'] = $bits;
 //得到duration
 $size = $json->playlist[0]->size;
 $video['data'][0]['duration'] = $size;
 //得到MP4
 $mp4 = $json->playlist[0]->urls[0];
 $video['data'][0]['src'] = $mp4;
		
	if(empty($video['data'][0]['src']))return false;	

		return $video;
		
	}

    	function GetVideo_HTML5($key, $hdstyle){
		
      list($videoid_str, $key_str) = explode('_', strrev($key), 2);
      $vodkey = strrev($key_str);
      $videoid = strrev($videoid_str);
  //获取数据
     $content = getfile('http://api.funshion.com/ajax/vod_panel/'.$key.$vodkey.'/w-1','api.funshion.com');
     $data = json_decode($content);
     $data = $data->data->fsps->mult;  

  if(!empty($vodkey)){
  	  $i=0; 
  //得到集数   
    foreach($data as $value){
			$serialid[$i] = $value->serialid;
			$hashid[$i] = $value->hashid;
			$full[$i] = $value->full;
			$i++;
    }
 //得到full
  $full = array_combine($serialid, $full);
  $full = $full[$videoid];
 //得到集数的hashid
  $data = array_combine($serialid, $hashid);
  $data = $data[$videoid];
 }else{
 			$full = $data[0]->name;
			$data = $data[0]->hashid;
	}
 //组建json
 $content = getfile('http://jobsfe.funshion.com/query/v1/mp4/'.$data.'.json','http://api.funshion.com');
 $json = json_decode($content);
 //得到标题
 	if(!empty($full))$video['subject'] = $full;
 //得到bytes
 $bits = $json->playlist[0]->bits;
 $video['data'][0]['bytes'] = $bits;
 //得到duration
 $size = $json->playlist[0]->size;
 $video['data'][0]['duration'] = $size;
 //得到MP4
 $mp4 = $json->playlist[0]->urls[0];
 $video['data'][0]['src'] = $mp4;
		
	 if(empty($video['data'][0]['src']))return false;	
		
		return $video;
}

?>