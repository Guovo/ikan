<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'iqiyi.com');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions

/*function GetUrls($key){

	if(empty($key))return false;
	
	$url = 'http://v.qq.com/iframe/player.html?vid='.$key.'&tiny=0&auto=0';
	
	return $url;	
}*/

function GetVid($url){

	if(empty($url))return false;
/*	
			preg_match("/^http\:\/\/static\.video\.qq\.com\/TPout\.swf\?[0-9a-z&=_-]*vid=(\w+)/i", $url, $ketStr);
		
	if(empty($ketStr)){*/
	
	$geturl = getfile($url,'http://www.iqiyi.com' , null);
	
	preg_match('#videoid="(.*?)"#is', $geturl, $key_str);
	
//	}
	if(!empty($key_str[1]))$key = $key_str[1];
	
	if(empty($key))return false;
	
	return $key;	
}

?>