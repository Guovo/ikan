<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'yinyuetai.com');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions

function GetUrls($key){

	if(empty($key))return false;
	
	$url = 'http://v.yinyuetai.com/video/'.$key;
	
	return $url;	
}

function GetVid($url){

	if(empty($url))return false;
	
	preg_match('#video\/([0-9]+)#is', $url, $keyStr);
	
	if(!empty($keyStr[1]))$key = $keyStr[1];
	
	if(empty($key))return false;
	
	return $key;
}
?>