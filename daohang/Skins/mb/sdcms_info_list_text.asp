<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>{sdcms:class_title} _ {sdcms:webname}</title>
<meta name="keywords" content="{sdcms:class_key}">
<meta name="description" content="{sdcms:class_desc}">
<meta name="robots" content="all" />
<meta name="author" content="{sdcms:weburl}" />
<link rel="stylesheet" href="/Skins/mb/css/index.css" type="text/css" media="all" />
<link rel="stylesheet" href="/Skins/mb/css/list.css">
<base target="_blank"/>
</head>
<body>
{sdcms:include("Sdcms_head.asp")}

<div id="main-container" style="margin-top:10px">
<div id="masthead">当前位置: <a href="{sdcms:root}">网站首页</a> {sdcms:class_position} </div>
<div class="main-content-row">

<div id="video" class="category mod">
<div class="category-title-wrap">
<h3 class="category-title hd">{sdcms:class_title}</h3>
</div>
<div class="category-content bd">
<ul class="category-list clearfix">
{@sdcms:page table="View_info" where="classid in({sdcms:class_allclassid}) and ispass=1" order="Ontop desc,id asc"}
<li class="category-item"> <a href="{@url}">{@title}</a> </li>
{/@sdcms:page}
</ul>
</div>
</div>







</div>
</div>
{sdcms:include("Sdcms_foot.asp")}
</body>
</html>