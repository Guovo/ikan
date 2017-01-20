<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>播放中...C值视频在线解析 - 爱看影院提供更新</title>
<!--模式：C值 用法：http://域名/tv/ykyun/index.php?vid=CNTM0NzAxMg== -->
</head>
<style>
<!--
body,html,div{background-color:#000;padding: 0;margin: 0;width:100%;height:100%;color:#aaa;}
-->
</style>
<body style="margin:0px;overflow-y:hidden;">
<div id="a1"></div>
<script type="text/javascript" src="../ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript" src="../ckplayer/ad.js" charset="utf-8"></script>
<script type="text/javascript">
var vid = document.location.href.split('vid=');
var url = 'http://api.pronvod.com/mg/mg.php?v=1772318';
function player(url,id,w,h){
var isPhone = navigator.userAgent.match(/iPad|iPhone|Android|iPod/i) != null;
var mobileUrl;
if (isPhone) {
var htm = '<video width="'+ w +'" height="'+ h +'" controls="controls" autoplay="autoplay" src="'+url+'"></video>';
document.getElementById(id).innerHTML = htm;
} 
else{
var flashvars={
f:url,
s:0,
p:1,
c:0,
i: '/static/images/letitgo.jpg',
subtitle_cn:'/tv/ckplayer/subtitle/cn.srt',
subtitle_en:'/tv/ckplayer/subtitle/en.srt',
my_url: encodeURIComponent(window.location.href)
};
var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always'};
CKobject.embedSWF('/tv/ckplayer/ckplayer.swf',id,'ckplayer_dr',w,h,flashvars,params);
}
}
player(url,'a1','100%','100%');
</script>
<div style="display:none"></div>
<script src="https://s95.cnzz.com/z_stat.php?id=1260143307&web_id=1260143307" language="JavaScript"></script>
</body>
</html>
