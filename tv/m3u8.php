<?php
if(!empty($_GET['url'])){
	$urls=@$_GET['url'];
}else{
	exit("urlµØÖ·´íÎó");
}
?>
<div id="main">		
<style> html,body{ margin:0px; height:100%; } </style>   
<div id="a1"></div>
<script type="text/javascript" src="/tv/ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">
	var flashvars={
		f:'/tv/ckplayer/m3u8.swf',
		a:'http://pl.youku.com/partner/m3u8?vid=COTA3NTE3Ng==&type=mp4&ep=DJ5ScxYCzLhEFkrG7wjcoUCyWHeLmDy0jfvnSblo%2FVnwOKyFd1tXvA%3D%3D&sid=34812114495018613765a&token=7680&ctype=86&ev=1&oip=1931258729',
		s:4,
		c:0
};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
	var video=['http://pl.youku.com/partner/m3u8?vid=COTA3NTE3Ng==&type=mp4&ep=DJ5ScxYCzLhEFkrG7wjcoUCyWHeLmDy0jfvnSblo%2FVnwOKyFd1tXvA%3D%3D&sid=34812114495018613765a&token=7680&ctype=86&ev=1&oip=1931258729'];
	CKobject.embed('/tv/ckplayer/ckplayer.swf','a1','ckplayer_a1','100%','100%',false,flashvars,video,params);
</script>