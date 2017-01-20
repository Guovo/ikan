<?php
error_reporting(0);
define('IN_GWIYOMI', true);
define('EUser', '127.0.0.1');
define('CHARSET', 'UTF-8');
if(version_compare(PHP_VERSION,'5.1.0','<')){
header("Content-Type: text/html;charset=utf-8"); 
echo('您的版本过低请使用 PHP > 5.1.0 以上版本!<br/>');
}else {
include_once(dirname(__FILE__).'/config/config_global.php');
include_once(dirname(__FILE__).'/function/function_core.php');
  ob_start();
include_once(dirname(__FILE__).'/function/function_vod.php');
} 
?>
