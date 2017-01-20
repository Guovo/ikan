<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'wasu.cn');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions

function GetUrls($key){

	if(empty($key))return false;
	
	$url = 'http://www.wasu.cn/Play/show/id/'.$key;
	
	return $url;	
}

function GetVid($url){

	if(empty($url))return false;
	
	preg_match('#id\/([0-9]+)#is', $url, $ketStr);
	
	if(empty($key_str[1]))preg_match("/id\/([0-9]+)/i", $url, $key_str);
	
	if(empty($key_str[1]))return false;
	
	$key = $key_str[1];
	
	return $key;
	
}
?>