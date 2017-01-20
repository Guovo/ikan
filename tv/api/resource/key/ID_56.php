<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', '56.com');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions

function GetUrls($key){

	if(empty($key))return false;
	
	$url = 'http://www.56.com/u99/v_'.$key.'.html';
	
	return $url;	
}

function GetVid($url){

	if(empty($url))return false;
	
	preg_match('#\/open_([0-9A-Za-z]+).swf#is', $url, $key_str);
	
	if(empty($key_str[1]))preg_match('#\/v_([0-9A-Za-z]+).html#is', $url, $key_str);
	
	if(empty($key_str[1]))preg_match('#\/vid-([0-9A-Za-z]+).html#is', $url, $key_str);

	if(empty($key_str[1]))return false;
		
	$key = $key_str[1];
		
	return $key;	
}
?>