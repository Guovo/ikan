<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>申请收录留言－{sdcms:webname}</title>

<meta name="robots" content="all" />
<meta name="author" content="{sdcms:weburl}" />
<link rel="stylesheet" href="/Skins/mb/css/index.css" type="text/css" media="all" />
<link rel="stylesheet" href="/Skins/mb/css/list.css">
<script>var webdir="{sdcms:root}";</script>
<script src="/Skins/mb/css/sdcms.js" language="javascript"></script>
<script src="/Skins/mb/css/show.js" language="javascript"></script>
</head>
<body>
{sdcms:include("Sdcms_top.asp")}
<div class="bg">
{sdcms:include("Sdcms_head.asp")}

<div class="wrapper"> 
<div class="clear mt10"></div>
<div class="bookbox">
<div class="booktitle  pl10">收录说明</div>
<div class="soulu">
<li>不收录有反动、色、赌等不良内容或提供不良内容链接的网站，以及网站名称或内容违反国家有关政策法规的网站；</li>
<li>不收录含有病毒、木马，弹出插件或恶意更改他人电脑设置的网站、及有多个弹窗广告的网站；</li>
<li>不收录网站名称和实际内容不符的网站，如贵站正在建设中，或尚未明确主题的网站，请不必现在申请收录，欢迎您在贵站建设完毕后再申请；</li>
<li>不收录以同类型网站通用名称文字作为申请的名称，例如“在线音乐”，请以适当的网站名做为申请名称，如http://www.600it.com/ 的网站中文名是“六百源码”；</li>
<li>不收入非顶级域名、挂靠其他站点、无实际内容，只提供域名指向的网站或仅有单页内容的网站；</li>
<li>公益性网站，或内容确实有独特之处的网站将优先收录；</li>
<div class="tishi">
<p>特别提示：申请收录的网站，如果在其首页设置本站的友情链接，我们将会优先考虑收录；</p>
<b>链接代码：</b><input readonly="true" type="text" name="link-txt" class="link-int" style=" padding:6px;" value="&lt;a href=&quot;{sdcms:weburl}&quot; target=&quot;_blank&quot;&gt;{sdcms:webname}&lt;/a&gt;">

</div>
</div>
</div>

<div class="clear mt10"></div>

<div class="bookbox">
<div class="booktitle pl10">发表留言</div>
<dl class="plug_publish_add h200">
<form onsubmit="return checkbook(this);" target="_self">
<dt>
<textarea name="content" style="width:978px;height:125px;"></textarea>
</dt>
<dt style="margin-left:180px">姓名：
<input name="username" size="6" type="text" class="input" maxlength="10" value="匿名" onfocus="if(this.value=='匿名')this.value=''" onblur="if(this.value=='')this.value='匿名'" />
　验证码：
<input id="yzm" size="6" name="yzm" type="text"  class="input" maxlength="10" />
<img align="absmiddle" src="{sdcms:root}inc/sdcmscode.asp?t0=60&t1=18" alt="看不清楚，换一个" onClick="this.src+='&'+Math.random();" id="yzm_num" /></dt>

<dt><input class="vote_bnt" value="提 交" type="submit" /><span id="showmsg"></span></dt>
</form>
</dl>
</div>





<div class="clear mt10"></div>

<div class="bookbox2" style="display:none;">
<div class="booktitle pl10">用户留言</div>
<div class="pl10 pr10"> 
{@sdcms:page field="adddate,username,content,recontent" table="sd_book" where="ispass=1" pagesize="5"}
{@eof}
<div class="book_booktitle">没有留言 </div>
{/@eof}
<div class="book_booktitle"><b>{@adddate date="yyyy-mm-dd hh.ff.ss"}</b>{@username} </div>
<div class="book_content">{@content}[@if {@recontent function="len"}>0]
<div class="mt10"><b>回复</b>：{@recontent}</div>
[@end if]</div>
{/@sdcms:page}
<div class="List_page">{sdcms:listpage}</div>
</div>
<div class="clearfix"></div>
</div>

</div>

</div>
{sdcms:include("Sdcms_foot.asp")}
</body>
</html>