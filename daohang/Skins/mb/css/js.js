// JavaScript Document
var h = new Array(0,380,25,25,25);
var tf = new Array(false,true,false,false,false);
var minheight = 0;
var maxheight = 190;
function fn(likey,tag){
	if (tf[tag]){
		if (h[tag]>=minheight){
			document.getElementById("panel"+tag).style.height = h[tag] + "px";
			setTimeout(function(){fn(likey,tag)},1);
			h[tag] -= 5;
		} else {
			tf[tag] = !tf[tag];
			h[tag] += 5;
		}
	} else {
		if (h[tag]<=maxheight){
			document.getElementById("panel"+tag).style.height = h[tag] + "px";
			setTimeout(function(){fn(likey,tag)},1);
			h[tag] += 5;
		} else {
			tf[tag] = !tf[tag];
			h[tag] -= 5;
		}
	}
}
<!--皮肤点击展开引用结束-->


jQuery.noConflict(); 

<!--皮肤TAB切换-->
function changeBody(index) { 
jQuery(".skinbox-wrapper").hide(); 
jQuery("#Js_pic" + index).show(0); 
} 

<!--皮肤切换-->
jQuery(document).ready(function(){

    var jQueryli=jQuery(".my_skin>li a");
    jQueryli.click(function(){
           setstyle(this.id);
    });   
    var skinname=jQuery.cookie("MySkin");   
    if(skinname)
    {
       setstyle(skinname);
    }
       
    function setstyle(name)
    {
      jQuery("#"+name).addClass("selected").siblings().removeClass("selected");
       jQuery("#mystyle").attr("href","/Skins/mb/css/"+(name)+".css");
       jQuery.cookie("MySkin",name,{expires:10,path:'/'});
    }
   
});
<!--默认皮肤切换-->
jQuery(document).ready(function(){

    var jQueryli=jQuery(".skinok2>a");
    jQueryli.click(function(){
           setstyle(this.id);
    });   
    var skinname=jQuery.cookie("MySkin");   
    if(skinname)
    {
       setstyle(skinname);
    }
       
    function setstyle(name)
    {
      jQuery("#"+name).addClass("selected").siblings().removeClass("selected");
       jQuery("#mystyle").attr("href","/Skins/mb/css/"+(name)+".css");
       jQuery.cookie("MySkin",name,{expires:10,path:'/'});
    }
   
});

<!--换肤引用文件结束-->






// 设置为主页 
function SetHome(obj,vrl){ 
try{ 
obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl); 
} 
catch(e){ 
if(window.netscape) { 
try { 
netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); 
} 
catch (e) { 
alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。"); 
} 
var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch); 
prefs.setCharPref('browser.startup.homepage',vrl); 
}else{ 
alert("您的浏览器不支持，请按照下面步骤操作：1.打开浏览器设置。2.点击设置网页。3.输入："+vrl+"点击确定。"); 
} 
} 
} 
// 加入收藏 兼容360和IE6 
function shoucang(sTitle,sURL) 
{ 
try 
{ 
window.external.addFavorite(sURL, sTitle); 
} 
catch (e) 
{ 
try 
{ 
window.sidebar.addPanel(sTitle, sURL, ""); 
} 
catch (e) 
{ 
alert("加入收藏失败，请使用Ctrl+D进行添加"); 
} 
} 
} 












// 皮肤左右滚动代码
