<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>������¼���ԣ�{sdcms:webname}</title>

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
<div class="booktitle  pl10">��¼˵��</div>
<div class="soulu">
<li>����¼�з�����ɫ���ĵȲ������ݻ��ṩ�����������ӵ���վ���Լ���վ���ƻ�����Υ�������й����߷������վ��</li>
<li>����¼���в�����ľ��������������������˵������õ���վ�����ж������������վ��</li>
<li>����¼��վ���ƺ�ʵ�����ݲ�������վ�����վ���ڽ����У�����δ��ȷ�������վ���벻������������¼����ӭ���ڹ�վ������Ϻ������룻</li>
<li>����¼��ͬ������վͨ������������Ϊ��������ƣ����硰�������֡��������ʵ�����վ����Ϊ�������ƣ���http://www.600it.com/ ����վ�������ǡ�����Դ�롱��</li>
<li>������Ƕ����������ҿ�����վ�㡢��ʵ�����ݣ�ֻ�ṩ����ָ�����վ����е�ҳ���ݵ���վ��</li>
<li>��������վ��������ȷʵ�ж���֮������վ��������¼��</li>
<div class="tishi">
<p>�ر���ʾ��������¼����վ�����������ҳ���ñ�վ���������ӣ����ǽ������ȿ�����¼��</p>
<b>���Ӵ��룺</b><input readonly="true" type="text" name="link-txt" class="link-int" style=" padding:6px;" value="&lt;a href=&quot;{sdcms:weburl}&quot; target=&quot;_blank&quot;&gt;{sdcms:webname}&lt;/a&gt;">

</div>
</div>
</div>

<div class="clear mt10"></div>

<div class="bookbox">
<div class="booktitle pl10">��������</div>
<dl class="plug_publish_add h200">
<form onsubmit="return checkbook(this);" target="_self">
<dt>
<textarea name="content" style="width:978px;height:125px;"></textarea>
</dt>
<dt style="margin-left:180px">������
<input name="username" size="6" type="text" class="input" maxlength="10" value="����" onfocus="if(this.value=='����')this.value=''" onblur="if(this.value=='')this.value='����'" />
����֤�룺
<input id="yzm" size="6" name="yzm" type="text"  class="input" maxlength="10" />
<img align="absmiddle" src="{sdcms:root}inc/sdcmscode.asp?t0=60&t1=18" alt="�����������һ��" onClick="this.src+='&'+Math.random();" id="yzm_num" /></dt>

<dt><input class="vote_bnt" value="�� ��" type="submit" /><span id="showmsg"></span></dt>
</form>
</dl>
</div>





<div class="clear mt10"></div>

<div class="bookbox2" style="display:none;">
<div class="booktitle pl10">�û�����</div>
<div class="pl10 pr10"> 
{@sdcms:page field="adddate,username,content,recontent" table="sd_book" where="ispass=1" pagesize="5"}
{@eof}
<div class="book_booktitle">û������ </div>
{/@eof}
<div class="book_booktitle"><b>{@adddate date="yyyy-mm-dd hh.ff.ss"}</b>{@username} </div>
<div class="book_content">{@content}[@if {@recontent function="len"}>0]
<div class="mt10"><b>�ظ�</b>��{@recontent}</div>
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