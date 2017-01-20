<?php
if(!empty($_GET['url'])){
	$urls=@$_GET['url'];
}else{
	exit("urlµØÖ·´íÎó");
}
?>
<div id="main">		
           <style> html,body{ margin:0px; height:100%; } </style>         
<div id="a1"> </div> 
<script type="text/javascript" src="/tv/player/player.js" charset="utf-8"></script>
<script type="text/javascript">
    var flashvars={
        f:'http://www.200919.com/tv/qiyi/qiyi.php?qyvip3=<?php echo $urls;?>',
        a:88,
        s:2,
        c:0
    };
    var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
    var video=['http://www.200919.com/tv/qiyi/qiyi.php?qyvip3=&mobile'];
    CKobject.embed('/tv/player/player.swf','a1','ckplayer_a1','100%','100%',false,flashvars,video,params);
    CKobject.embedHTML5('moveid', 'a1', '100%', 400, video, flashvars, support)
</script>  

</div>