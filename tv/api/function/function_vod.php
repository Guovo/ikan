<?php
/**
 *	[KW.G] (C)2014-2112 kw.G Sdo.	.
 *	This is NOT a freeware, use is subject to license terms
 *
 *	GET THE URL INFO AND VIDEO FILE
 */

@$v = $_GET['v'];
if(!empty($v)){if(preg_match('#^([0-9A-Za-z_\-\=\/\.\#]+\_[0-9A-Za-z]+)(\.[0-9]{0,2})?$#is', $v)){$skey = $v;}else{$url = $v;}}
@$url = empty($url) ? $_GET['url'] : $url;
@$key = $_GET['kkey'];
@$type = strtolower($_GET['type']);
@$skey = empty($skey) ? $_GET['skey'] : $skey;
@$player = strtolower($_config['player']['Default']);
@$defHds = empty($mobile) ? $_player['ckplayer'][0]['Plugins']['hds']['Default_FLASH'] : $_player['ckplayer'][0]['Plugins']['hds']['Default_HTML5'];
@$hds = isset($_GET['hdstyle']) && intval($_GET['hdstyle']) >= 0 && intval($_GET['hdstyle']) <= 10 ? intval($_GET['hdstyle']) : $defHds;
//if (isMobile()) { $player='download'; $mobile = 1;}
if (isset($_GET['mobile'])) { $player='download'; $mobile = 1;}

if(empty($key) && empty($url) && empty($skey))die();

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate( 'D, d M Y H:i:s' ).' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

if(empty($mobile) && empty($download)&& empty($mp4))header('Content-Type: text/xml');

$video = $video2 = $video3 = array();

if(!empty($skey)){
  
	list($type_str, $key_str) = explode('_', strrev($skey), 2);
	
	if(!empty($key_str)){
			
		if(b64UrlCheck(strrev($key_str)) == true){
			
			$url = strpos(base64_decode(strrev($key_str)), '://')? base64_decode(strrev($key_str)) : 'http://'. base64_decode(strrev($key_str));
			
		}else{
			
			$key = strrev($key_str);
			
      if(!empty($_config['vodkey']))$key = passport_decrypt($key,$_config['vodkey']);
			
		}
		
	}
	
	if(strpos($type_str, '.')){
		
		list($type, $hds) = explode('.', strrev($type_str), 2);
		
	}else{
		
		$type = strtolower(strrev($type_str));
			
	}
	
}

if(!empty($url)){
	
	if(!empty($_config['vodkey']))$url = passport_decrypt($url,$_config['vodkey']);
	
	if(strpos($url, '.')){
		
		$host = parse_url($url, PHP_URL_HOST);
		if(empty($host))$host = parse_url('http://'.$url, PHP_URL_HOST);
		
	}else{
				
		if(b64UrlCheck($url) == true){
			
			$url = strpos(base64_decode($url), '://')? base64_decode($url) : 'http://'. base64_decode($url);
			
		}else{
			header("Content-Type: text/html;charset=utf-8"); 
			echo '对不起！我们暂时不提供该网站的解析.'.die();
				
		}
		
	}
	
	$host = parse_url($url, PHP_URL_HOST);	
		
	$array = array_slice(explode(".", $host), -2, 1);
	
	$video['videourl'] = $url;
	
	$video['videotype'] = $type = strtolower($array[0]);
	
}

if((!empty($key) && !empty($type)) || !empty($url)){
	
	if(kms_strpos($url, explode(',', $_config['Passage']))){
		
		$video['data'][0]['src'] = $url;
		
	}else{
		

		
		if(!empty($type)){
			
			if(empty($video['videotype']))$video['videotype'] = $type; 
			
			$_extractorFile = './resource/key/ID_'.strtoupper($type).'.php';
			
			if(file_exists($_extractorFile))include_once($_extractorFile);
			
		}
		
		if(!empty($url) && function_exists('GetVid') && empty($key))$key = GetVid($url);
		

		
		if(!empty($key) && function_exists('GetUrls')){
			
			$_url = GetUrls($key); 
			
			@$video['videourl'] = $url = !empty($_url) ? $_url : $url;
			
		}
	
		if(empty($video['videourl']))$video['videourl'] = !empty($url) ? $url : null;
			
		$listmode = explode("->", $_config['extractor']['order']);
    
		$userkey=$_config['userkey'];
		
		foreach($listmode as $value){
			
			$videos = _LoadOder($value, $url, $type, $key, $hds, $_extractor, $mobile);
			
			if(!empty($videos))break;
			
		}
		
		if(!empty($videos))$video = array_merge($video, $videos);
		
	}
	if(!empty($_config['vodkey']))$key = passport_encrypt($key,$_config['vodkey']);
	
	if(empty($videos['data'][0]['src']))die();

	if(!empty($mobile)){
		
		switch($player){

			case 'ckplayer':
				echo CreateMobile($video, $_player);
				break;

			case 'ckm':
				echo CreateMobile($video, $_player);
				break;
			
			case 'mp4':
				echo CreateMp4($video, $_player);
				break;
			
			case 'download':
				header("location:".$video['data'][0]['src']);
				break;
					
			default:
			  header("Content-Type: text/html;charset=utf-8"); 
				echo '对不起，我们没有提供这样的调试方法！';
				
		}
		
	}else{

		switch($player){
			
			case 'cmp4':
				echo get_cmp4_merge($video, $key, $type);
				break;
				
			case 'ckplayer':
				echo get_ckplayer_xml($video, $url, $key, $type, $_player);
				break;
				
			case 'mp4':
				echo CreateMp4($video, $_player);
				break;		
						
			case 'download':
				header("location:".$video['data'][0]['src']);
				break;
				
			default:
			  header("Content-Type: text/html;charset=utf-8"); 
				echo '对不起，我们没有提供这样的调试方法！';
				
		}
		
	}
	
}
ob_end_flush();
?>