<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'pptv.com');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions

function GetUrls($key){

	if(empty($key))return false;
	
	$url = 'http://v.pptv.com/show/'.$key.'.html';
	
	return $url;	
}

function GetVid($url){

	if(empty($url))return false;
/*	
			preg_match("/^http\:\/\/static\.video\.qq\.com\/TPout\.swf\?[0-9a-z&=_-]*vid=(\w+)/i", $url, $ketStr);
		
	if(empty($ketStr)){*/
	
  preg_match('/show\/(.*?)\.html/i', $url, $key_str);
	
//	}
	if(!empty($key_str[1]))$key = $key_str[1];
	
	if(empty($key))return false;
	
	return $key;	
}

?>