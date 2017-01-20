<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<style type="text/css">
#a1
 {
    background-color:#000000;
    width:100%;
    position:absolute;
    top:0px;
    bottom:0px;
    left:0px;
}
</style>
</head>
<body bgcolor="#000000"><!--bgcolor="#000000"-->
<center>
<div id="a1"></div>


var isiPad = navigator.userAgent.match(/iPad|iPhone|Linux|Android|iPod/i) != null;
    if(isiPad){
        document.getElementById("a1").innerHTML='<video id="vod" src="'+'http://pl.youku.com/partner/m3u8?vid=COTA3NTE3Ng==&type=mp4&ep=CJ5ScxYCz7pFGE7G6Qjc8kewC3ePmDy0jfvnSblo%2FVnwOKyFc1pYvw%3D%3D&sid=748121265710786b45e5e&token=3773&ctype=86&ev=1&oip=1931258729'+'" controls="controls" autoplay="autoplay" width="100%" height="100%"></video>';

    } else{
	var flashvars={
	    f:'/ckplayer/m3u8.swf',
        a:'http%3A%2F%2Fpl.youku.com%2Fpartner%2Fm3u8%3Fvid%3DCOTA3NTE3Ng%3D%3D%26type%3Dmp4%26ep%3DCJ5ScxYCz7pFGE7G6Qjc8kewC3ePmDy0jfvnSblo%252FVnwOKyFc1pYvw%253D%253D%26sid%3D748121265710786b45e5e%26token%3D3773%26ctype%3D86%26ev%3D1%26oip%3D1931258729',
	    c: 0,
	    p: 1,
	    s: 4,
	    lv: 0
	};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
	CKobject.embedSWF('/ckplayer/player.swf','a1','ckplayer_a1','100%','100%',flashvars,params);
	}
  </script></center>

 
</body>
</html>