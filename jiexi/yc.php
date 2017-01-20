<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>电影云—云解析调用</title>
<style type="text/css">body,html,div{padding: 0;margin: 0;width:100%;height:100%;psotion:relative;"}</style>
</head>
<body>
<div id="a1" style="psotion:relative;"></div>
<script type="text/javascript" src="ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">
    var vid='<?php echo $_GET['vid'];?>';
	var purl='YoukuCloud.php?vid='+vid;
	var flashvars={
	    f: 'ckplayer/m3u8.swf', 		//使用swf向播放器发送视频地址进行播放
		a: encodeURIComponent(purl),     
	    c: 0,		//调用 ckplayer.js 配置播放器
	    p: 1,		//自动播放视频
	    s: 4,		//flash插件形式发送视频流地址给播放器进行播放
	    lv: 0
	};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
	var isiPad = navigator.userAgent.match(/iPad|iPhone|Linux|Android|iPod/i) != null;
    if (isiPad) {
        document.getElementById('a1').innerHTML = '<video src="'+purl+'" controls="controls" autoplay="autoplay" width="100%" height="460" style="psotion:relative;""></video>'
	}else{
	    CKobject.embedSWF('ckplayer/ckplayer.swf','a1','ckplayer_a1','100%','100%',flashvars,params);
	}
  </script>
</body>
</html>
