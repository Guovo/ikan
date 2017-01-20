<script type="text/javascript" src="/Skins/mb/css/jquery-1.5.1.js"></script>
<script type="text/javascript" src="/Skins/mb/css/jquery.cookie.js"></script>
<script type="text/javascript" src="/Skins/mb/css/js.js"></script>
<link type="text/css" href="bg0.css" rel="stylesheet" id="mystyle" />


<!--皮肤切换开始--->

<script type="text/javascript" src="/Skins/mb/css/jquery.skin.js"></script>
<script type="text/javascript" src="/Skins/mb/skin.js"></script>

<!---皮肤左右滚动代码--->
<script type="text/javascript">
jQuery('#Js_pic1').elastislide({
    imageW 	: 190,
    minItems	: 5
});
jQuery('#Js_pic2').elastislide({
    imageW 	: 190,
    minItems	: 5
});
jQuery('#Js_pic3').elastislide({
    imageW 	: 190,
    minItems	: 5
});
jQuery('#Js_pic4').elastislide({
    imageW 	: 190,
    minItems	: 5
});
</script>

<!--皮肤切换结束--->


<div class="Toph">
<div class="wrapper">
<div class="TopTime f14">
<span id="thetime"></span>
<script>setInterval("thetime.innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);</script> 
</div>
<div class="Tophr"><a href="#" class="btn-slide" title="更换皮肤"  onclick="fn(this,2)" target="_self"><img src="/Skins/mb/img/huan.png" /></a></div>
<div class="Tophr"> 
<a href="javascript:void(0)" onclick="SetHome(this,window.location)" target="_self">设为首页</a> | <a href="javascript:void(0)" onclick="shoucang(document.title,window.location)"  target="_self">加入收藏</a>
</div>
</div>
</div>



