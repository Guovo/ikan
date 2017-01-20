<?php
error_reporting(0);
define('IN_GWIYOMI', true);
define('EUser', '127.0.0.1');
define('CHARSET', 'UTF-8');
//通过验证=================================================================
//header("Content-Type: text/html;charset=utf-8"); 
	if(is_array($_GET)&&count($_GET)==0) { 
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $realip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) { 
    $realip = $_SERVER['HTTP_CLIENT_IP']; 
    } else { 
    $realip = $_SERVER['REMOTE_ADDR']; 
    } 
  $name = "QQ：78079142"; 
  $xml .= '<?xml version="1.0" encoding="utf-8"?>'.chr(13);
	$xml .= '	<Information>'.chr(13);
	$xml .= '<ip><![CDATA['.$realip.']]></ip>'.chr(13);
	$xml .= '<name><![CDATA['.$name.']]></name>'.chr(13);
	$xml .= '	</Information>';
   echo $xml;

	}

//系统配置
include_once('./config/global.php');
//载入核心文件
include_once('./function/core.php');
  ob_start();
//加载解析配置 
	include_once('/function/vod.php');

?>
