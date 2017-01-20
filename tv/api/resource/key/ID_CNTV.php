<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'cntv.cn');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions

function GetUrls($key){

	if(empty($key))return false;
	
	$url = 'http://tv.cntv.cn/video/gwiyomi/'.$key;
	
	return $url;	
}

function GetVid($url){
	
	if(empty($url))return false;
	
	$key = '';
	
	preg_match('/xiyou\.cntv\.cn\/v-([0-9a-z-]+)\.html/', $url, $keyStr);
	
	if(!empty($keyStr[1]))$key = $keyStr[1];
		
	if(!empty($key))return $key;
	
	for($i=0; $i<3; $i++){
		
		$c = getfile($url, null, null);
		
		if(!empty($c))break;
		
	}
	
	preg_match('/contentid\"[\s]+content=\"([0-9a-z]+)\">/i', $c, $keyStr);
	if(!empty($keyStr[1]))preg_match('/videoCenterId\",\"([0-9a-z]+)\"/i', $c, $keyStr);
	if(!empty($keyStr[1]))preg_match('/<!--repaste.video.code.begin-->([0-9a-z]+)<!--repaste.video.code.end-->/i', $c, $keyStr);
	
	if(!empty($keyStr[1]))$key = $keyStr[1];
	
	if(empty($key))return false;
	
	return $key;
}
?>