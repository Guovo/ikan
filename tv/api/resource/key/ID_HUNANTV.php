<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'hunantv.com');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions


function GetVid($url){

	if(empty($url))return false;
	
	//http://i1.hunantv.com/ui/swf/share/player.swf?video_id=1133572
	
	preg_match('/\/f\/(.*?)\.html/',$url, $ketStr);
	
	if(empty($key_str[1]))preg_match('#/\player.swf?video_id=/(.*?)\#is', $url, $key_str);
	
	if(!empty($ketStr[1]))$key = $ketStr[1];
	
	if(empty($key))return false;
	
	return $key;
}
?>