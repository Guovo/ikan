<?php
/*
 * [KW.G] (C)2014-2112 kw.G Sdo	.
 * This is NOT a freeware, use is subject to license terms
 */

// Function and Version Definitions
define('EVarsion', '1.0');
define('EWebsite', 'sohu.com');
define('ECode', 'MD5 CODE');
define('TARCHAR', 'UTF-8');
// --END-- Function and Version Definitions


function GetVid($url){

	if(empty($url))return false;
	
	for($i=0; $i<3; $i++){
		
		$c = getfile($url, null, null);
				
		if(!empty($c))break;
		
	}

	preg_match("/var[\s]+vid=\"([0-9]+)\"/i", $c, $key_str);
	if(empty($key_str[1]))preg_match("/var[\s]+vid[\s]+=[\s]+\'([0-9]+)\'/i", $c, $key_str);
	if(empty($key_str[1]))preg_match("/,vid:[\s]+\'([0-9]+)\'/i", $c, $key_str);
	
	if(empty($key_str[1]))return false;
		
	$key = $key_str[1];
		
	return $key;	
}

?>