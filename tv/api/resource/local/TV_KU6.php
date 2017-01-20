<?php

 /*==================================================================================
 *	                       酷6本地解析插件组合开发平台
 *	
 * http://v.ku6.com/fetchVideo4Player/aPUUm8nC3StsepsnhRXsJw..html
 *	
 ==================================================================================*/
	
	function GetVideo_FLASH($key, $hdstyle){
	
      $banben= date('Y-m-d');
	//插件名字
	$video['name'] = "☆解析插件-ku6系统☆-".$banben;
	//高清格式信息
	$hdstr = array(1 => "normal",2 => "clear",3 => "super");
	
	$video['Nowhds'] = $hdstyle >= 0 && $hdstyle < 4 ? $hdstyle : 3;
		
	$video['mixhds'] = 3;

	for($i=0; $i<3; $i++){
			
			$info = getfile('http://v.ku6.com/fetchVideo4Player/'.$key.'.html', 'http://v.ku6.com' , null);
			
			if(!empty($info))break;
			
		}
		
   $json = json_decode($info);
   $data = $json;
		if(!empty($data->data->t))$video['subject'] = $data->data->t;	
//		

//		$vtimems = $data->vtimems;
//		$vtime = $data->vtime;
//		$f = $data->f;
//    $vtimems = explode(',',$vtimems);
//    $vtime = explode(',',$vtime);
//    $f  = explode(',',$f);

//    foreach ($vtime as $value1){
//        $video['data'][$i]['bytes'] = $vtimems;
//        $video['data'][$i]['duration'] = $vtime;
//        $video['data'][$i]['src'] = $f; 
//   	$i++;	
//    } 
//            if(!empty($vtimems))$video['data'][$i]['bytes'] = $vtimems;
//        if(!empty($vtime))$video['data'][$i]['duration'] = $vtime;
//        if(!empty($f))$video['data'][$i]['src'] = $f;   
//    $i++;	
   
//   if(!empty($vtime))$video['data'][$i]['duration'] = $vtime;
//    if(!empty($f))$video['data'][$i]['src'] = $f;

 //  $data->data->vtime = explode(',',$data->data->vtime);
//   $data->data->vtimems = explode(',',$data->data->vtimems);
   $data->data->f = explode(',',$data->data->f);

  $i= 0;
		foreach ($data as $value){ 
		for($i=0; $i<count($value->f); $i++){
//    if(!empty($value->vtimems[$i]))$video['data'][$i]['bytes'] = $value->vtimems[$i];
//    if(!empty($value->vtime[$i]))$video['data'][$i]['duration'] = $value->vtime[$i];
    if(!empty($value->f[$i]))$video['data'][$i]['src'] = $value->f[$i];  
    
//		$i++;	
    	}
    	}
		if(empty($video['data'][0]['src']))return false;
		
		return $video;
	}

?>