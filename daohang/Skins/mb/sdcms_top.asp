<script type="text/javascript" src="/Skins/mb/css/jquery-1.5.1.js"></script>
<script type="text/javascript" src="/Skins/mb/css/jquery.cookie.js"></script>
<script type="text/javascript" src="/Skins/mb/css/js.js"></script>
<link type="text/css" href="bg0.css" rel="stylesheet" id="mystyle" />


<!--Ƥ���л���ʼ--->

<script type="text/javascript" src="/Skins/mb/css/jquery.skin.js"></script>
<script type="text/javascript" src="/Skins/mb/skin.js"></script>

<!---Ƥ�����ҹ�������--->
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

<!--Ƥ���л�����--->


<div class="Toph">
<div class="wrapper">
<div class="TopTime f14">
<span id="thetime"></span>
<script>setInterval("thetime.innerHTML=new Date().toLocaleString()+' ����'+'��һ����������'.charAt(new Date().getDay());",1000);</script> 
</div>
<div class="Tophr"><a href="#" class="btn-slide" title="����Ƥ��"  onclick="fn(this,2)" target="_self"><img src="/Skins/mb/img/huan.png" /></a></div>
<div class="Tophr"> 
<a href="javascript:void(0)" onclick="SetHome(this,window.location)" target="_self">��Ϊ��ҳ</a> | <a href="javascript:void(0)" onclick="shoucang(document.title,window.location)"  target="_self">�����ղ�</a>
</div>
</div>
</div>



