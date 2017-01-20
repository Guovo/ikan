<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'fun.tv');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions


function GetVid($url){
	
	if(empty($url))return false;
	
	$geturl = getfile($url,'http://www.fun.tv' , null);
	//网址形式
  preg_match('#\"galleryid\"\:(.*?)\,#is', $geturl, $key_str);
	//网址形式
  preg_match('#vplay\.videoid[\s]\=[\s](.*?)\;#is', $geturl, $videoid);
//  //电脑版
//  if(empty($key_str[1]))preg_match('#vid\:\'(.*?)\|#is', $geturl, $key_str);
//  if(empty($key_str[1]))preg_match('#vid\:\'(.*?)\'#is', $geturl, $key_str);
//	//新浪新闻
//	if(empty($key_str[1]))preg_match('#videoId\:\'(.*?)\'#is', $geturl, $key_str);
//	//新浪娱乐
////	if(empty($key_str[1]))preg_match('#CurrentPlayingVideo[\s]\=[\s](.*?)\'#is', $geturl, $key_str);
  if(!empty($key_str[1]))$key = $key_str[1];
	if(!empty($videoid[1]))$key .= '_'.$videoid[1];
	
	if(empty($key))return false;
	
	return $key;	
}
?>