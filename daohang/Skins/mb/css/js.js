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
<!--Ƥ�����չ�����ý���-->


jQuery.noConflict(); 

<!--Ƥ��TAB�л�-->
function changeBody(index) { 
jQuery(".skinbox-wrapper").hide(); 
jQuery("#Js_pic" + index).show(0); 
} 

<!--Ƥ���л�-->
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
<!--Ĭ��Ƥ���л�-->
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

<!--���������ļ�����-->






// ����Ϊ��ҳ 
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
alert("�˲�����������ܾ���\n�����������ַ�����롰about:config�����س�\nȻ�� [signed.applets.codebase_principal_support]��ֵ����Ϊ'true',˫�����ɡ�"); 
} 
var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch); 
prefs.setCharPref('browser.startup.homepage',vrl); 
}else{ 
alert("�����������֧�֣��밴�����沽�������1.����������á�2.���������ҳ��3.���룺"+vrl+"���ȷ����"); 
} 
} 
} 
// �����ղ� ����360��IE6 
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
alert("�����ղ�ʧ�ܣ���ʹ��Ctrl+D�������"); 
} 
} 
} 












// Ƥ�����ҹ�������
