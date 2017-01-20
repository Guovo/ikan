<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'letv.com');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions

function GetUrls($key){

	if(empty($key))return false;
	
	$url = 'http://www.letv.com/ptv/vplay/'.$key.'.html';
	
	return $url;	
}

function GetVid($url){
	
		if(empty($url))return false;
	
	preg_match('#vplay\/(.*?)\/v#is', $url, $key_str);
	
	if(empty($key_str[1]))preg_match("/\/vplay\/(.*?)\.html/i", $url, $key_str);
	
  if(empty($key_str[1]))preg_match("/^http\:\/\/i\d+\.imgs\.letv\.com\/player\/swfPlayer\.swf\?[0-9a-z&=_-]*id=(\d+)/i", $url, $key_str);
	
	if(empty($key_str[1]))return false;
	
	$key = $key_str[1];
	
	return $key;
	
	
}

?>