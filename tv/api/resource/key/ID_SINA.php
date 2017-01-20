<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'sina.com.cn');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions


function GetVid($url){
	
	if(empty($url))return false;
	
	$geturl = getfile($url,'http://video.sina.com.cn' , null);
	//手机版
  preg_match('#ipad\_vid\:\'(.*?)\'#is', $geturl, $key_str);
  //电脑版
  if(empty($key_str[1]))preg_match('#vid\:\'(.*?)\|#is', $geturl, $key_str);
  if(empty($key_str[1]))preg_match('#vid\:\'(.*?)\'#is', $geturl, $key_str);
	//新浪新闻
	if(empty($key_str[1]))preg_match('#videoId\:\'(.*?)\'#is', $geturl, $key_str);
	//新浪娱乐
//	if(empty($key_str[1]))preg_match('#CurrentPlayingVideo[\s]\=[\s](.*?)\'#is', $geturl, $key_str);
	if(!empty($key_str[1]))$key = $key_str[1];
	
	if(empty($key))return false;
	
	return $key;	
}
?>