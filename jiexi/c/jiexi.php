﻿<?php
if(!empty($_GET['url'])){
	$urls=@$_GET['url'];
}else{
	exit("url地址错误");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>c值解析 - 爱看影院提供</title>
</head>
<div id="main">		
<style> html,body{ margin:0px; height:100%; } </style>         
<div id="a1"> </div> 
<frameset cols="100%,*">
<frame src='http://www.200919.com/jiexi/c.php?vid=<?php echo $urls;?>'/>
<frame src="tv/UntitledFrame-3"></frameset><noframes></noframes><strong></strong>
<body>
<script src="https://s95.cnzz.com/z_stat.php?id=1260143307&web_id=1260143307" language="JavaScript"></script></body>
</html>

