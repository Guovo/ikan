var Ajax_msg="���һ������";
//��������	
function runcode(codeBtn)
{
	var codeText=codeBtn.parentNode.firstChild;
	var codeValue=codeText.value;
	var rng=window.open('','','');
		rng.opener=null;
		rng.document.write(codeValue);
		rng.document.close();
}

//���ƴ���
function copycode(codeBtn)
{
	var codeText=codeBtn.parentNode.firstChild;
	var rng=codeText.createTextRange();
		rng.moveToElementText(codeText);
		rng.scrollIntoView();
		rng.select();
		rng.execCommand("Copy");
		rng.collapse(false);
}

//�������
function savecode(codeBtn)
{	
	var winname=window.open('about:blank', '_blank', 'top=100');
		winname.document.open();
		winname.document.write(codeBtn.parentNode.firstChild.value);
		winname.document.execCommand('saveas','','runcode.htm');
		winname.close();		
}

//JS���Server.UrlEncode���뺯��
function urlEncode(str) 
{ 
    str = str.replace(/./g,function(sHex) 
    { 
        window.EnCodeStr = ""; 
        window.sHex = sHex; 
        window.execScript('window.EnCodeStr=Hex(Asc(window.sHex))',"vbscript"); 
        return window.EnCodeStr.replace(/../g,"%$&"); 
    }); 
    return str; 
} 

function trim(s){return  s.replace(/(^\s*)|(\s*$)/g,  "");} 

function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=jQuery('#'+name+i);
		var con=jQuery("#con_"+name+"_"+i);
		menu[0].className=i==cursel?"hover":"";
		con[0].style.display=i==cursel?"block":"none";
	}
}

function addNum(t0){o=jQuery('#'+t0);o.parent().css('position','relative').append(jQuery('<span>+1</span>').css({'position':'absolute','left':'0px','top':'-15px','color':'#f00'}).animate({fontSize:80,opacity:0},800,function(){jQuery(this).remove();}))}

function Get_Spider()
{
	jQuery.ajax({
	type: "get",
	cache:false,
	url: webdir+"inc/Spider.asp",
	timeout: 20000,
	error: function(){},
	success: function(){}
	});
}

function get_hits(t0,t1,t2,t3)
{
	jQuery('#'+t3).html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type: "get",
	cache:false,
	url: webdir+"inc/gethits.asp?id="+t0+"&action="+t1+"&t="+t2+"",
	timeout: 20000,
	error: function(){jQuery('#'+t3).html(Ajax_msg);},
	success: function(t0){jQuery('#'+t3).html(t0);}
	});
}

function Get_Digg(t0,t1)
{
	jQuery('#'+t1).html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type: "get",
	cache:false,
	url: webdir+"inc/Digg.asp?id="+t0+"",
	timeout: 20000,
	error: function(){jQuery('#'+t1).html(Ajax_msg);},
	success: function(t0){jQuery('#'+t1).html(t0);}
	});
}

function Digg(t0,t1,t2)
{
	jQuery('#'+t2).html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type: "get",
	cache:false,
	url: webdir+"inc/Digg.asp?id="+t0+"&action=Digg",
	timeout: 20000,
	error: function(){jQuery('#'+t2).html(Ajax_msg);},
	success: function(t3){jQuery('#'+t2).html(t3.substring(1));if(t3.substring(0,1)==0){Get_Digg(t0,t1)}}
	});
}

function Send_Digg(t0,t1)
{
	jQuery.ajax({
	type: "get",
	cache:false,
	url: webdir+"Plug/Digg.asp?id="+t0+"&act="+t1+"&action=up",
	timeout: 20000,
	error: function(){alert(Ajax_msg);},
	success: function(t00){
		var t2=t00.split(':');
		if(t2[8]==0)
		{alert("�㲻���Ѿ����̬����!")}
		else{
			addNum("digg_num_"+(t1+1))
			Load_Gigg(t0);
			}
		}
	});
}

function Load_Gigg(t0)
{
	jQuery.ajax(
		{
			type: "get",
			cache:false,
			url: webdir+"Plug/Digg.asp?id="+t0,
			timeout: 20000,
			error: function(){alert(Ajax_msg);},
			success: function(t1)
			{
				var t2=t1.split(':');
				for(i=0;i<8;i++)
				{
					var t3=t2[i].split('#');
					jQuery("#digg_"+(i+1)).html(t3[0]);
					jQuery("#digg_num_"+(i+1))[0].style.height=t3[1]*0.5+'px';
				}	
			}
		}
	);
}

function get_comment(t0,t1)
{
	jQuery('#'+t1).html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type: "get",
	cache:false,
	url: webdir+"inc/gethits.asp?id="+t0+"&action=2",
	timeout: 20000,
	error: function(){jQuery('#'+t1).html(Ajax_msg)},
	success: function(t0){jQuery('#'+t1).html(t0);}
	})
}


function checksearch(theform)
{
	if (trim(theform.key.value)=='')
	{alert('�ؼ��ֲ���Ϊ��');
	theform.key.focus();
	theform.key.value='';
	return false
	}
	if (theform.key.value=='������ؼ���')
	{alert('�ؼ��ֲ���Ϊ��');
	theform.key.focus();
	theform.key.value='';
	return false
	}
	if(navigator.userAgent.indexOf("MSIE")>0)
	{
		window.location.href=webdir+"search/?/"+urlEncode(trim(theform.key.value))+"/";
	}
	else
	{
		window.location.href=webdir+"search/?/"+trim(theform.key.value)+"/";
	}
	return false
}

function set_comment(followid,title)
{
	jQuery("#followid")[0].value=followid;
	jQuery("#get_html")[0].style.display="block";
	jQuery("#get_html").html("<b>���ã�</b>"+title+"��<a href='javascript:void(0)' onclick='del_comment()' title='�������'>��</a>");
	jQuery("#coment_content")[0].focus();
}

function del_comment()
{
	jQuery("#followid")[0].value="";
	jQuery("#get_html")[0].style.display="none";
	jQuery("#get_html").html("");
}

function checkcomment(theform)
{
	if (trim(theform.content.value)=='')
	{   
		alert('���ݲ���Ϊ��');
		theform.content.focus();
		theform.content.value='';
		return false
	}
	if (trim(theform.username.value)=='')
	{
		alert('��������Ϊ��');
		theform.username.focus();
		theform.username.value='';
		return false
	}
	if (trim(theform.yzm.value)=='')
	{   
		alert('��֤�벻��Ϊ��');
		theform.yzm.focus();
		theform.yzm.value='';
		return false
	}
	var url,param;
	url=webdir+"plug/comment/index.asp?action=save";
	param="username="+escape(trim(theform.username.value));
	param+="&content="+escape(trim(theform.content.value));
	param+="&yzm="+escape(trim(theform.yzm.value));
	param+="&id="+escape(trim(theform.id.value));
	param+="&followid="+escape(trim(theform.followid.value));
	jQuery('#showmsg').html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type:"post",
	cache:false,
	url:url,
	data:param,
	timeout:param,
	error:function(){jQuery('#showmsg').html(Ajax_msg);},
	success:function(t0)
	{
		jQuery('#showmsg').html(t0.substring(1));
		if(t0.substring(0,1)==0){theform.username.value='';theform.yzm.value='';theform.content.value='';jQuery("#yzm_num")[0].src = jQuery("#yzm_num")[0].src+"&"+Math.random();location.href=webdir+"plug/comment/?id="+theform.id.value}
		}
	});
	return false
}

function Comment_Support(ID)
{
	param=webdir+"plug/comment/?action=support";
	param+="&ID="+escape(ID);
	jQuery.ajax({
	type:"get",
	cache:false,
	url:param,
	timeout:20000,
	error:function(){jQuery('#support_'+ID).html(Ajax_msg);},
	success:function(t0)
	{
		if(t0.substring(0,1)==0){
			jQuery('#support_'+ID).html("��֧��("+t0.substring(1)+")")
		}
		else
		{
			alert("���ύ���ٶ�̫�죡")
			}
		}
	});
	return false
}
 
function checkbook(theform)
{  
	if (trim(theform.content.value)=='')
	{   alert('���ݲ���Ϊ��');
		theform.content.focus();
		theform.content.value='';
		return false
	}
	if (trim(theform.username.value)=='')
	{   alert('��������Ϊ��');
		theform.username.focus();
		theform.username.value='';
		return false
	}
	if (trim(theform.yzm.value)=='')
	{   alert('��֤�벻��Ϊ��');
		theform.yzm.focus();
		theform.yzm.value='';
		return false
	}
	var url,param;
	url=webdir+"plug/book/index.asp?action=save";
	param="username="+escape(trim(theform.username.value));
	param+="&content="+escape(trim(theform.content.value));
	param+="&yzm="+escape(trim(theform.yzm.value));
	jQuery('#showmsg').html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type:"post",
	cache:false,
	url:url,
	data:param,
	timeout:20000,
	error:function(){jQuery('#showmsg').html(Ajax_msg);},
	success:function(t0)
	{
		jQuery('#showmsg').html(t0.substring(1));
		if(t0.substring(0,1)==0){theform.username.value='';theform.content.value='';;jQuery('#showmsg').html("<img src="+webdir+"css/loading.gif>�����ɹ�");setTimeout("window.location.href='?';","3000");}
		}
	});
	return false
}

function checkLink(theform)
{  
	if (trim(theform.t0.value)=='')
	{   alert('��վ����Ϊ��');
		theform.t0.focus();
		theform.t0.value='';
		return false
	}
	if (trim(theform.t1.value)=='')
	{   alert('��ַ����Ϊ��');
		theform.t1.focus();
		theform.t1.value='';
		return false
	}
	if (trim(theform.t3.value)=='')
	{   alert('��֤�벻��Ϊ��');
		theform.t3.focus();
		theform.t3.value='';
		return false
	}
	var url,param;
	url=webdir+"plug/link/index.asp?action=save";
	param="t0="+escape(trim(theform.t0.value));
	param+="&t1="+escape(trim(theform.t1.value));
	param+="&t2="+escape(trim(theform.t2.value));
	param+="&t3="+escape(trim(theform.t3.value));
	jQuery('#showmsg').html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type:"post",
	cache:false,
	url:url,
	data:param,
	timeout:20000,
	error:function(){jQuery('#showmsg').html(Ajax_msg);},
	success:function(_)
	{
		jQuery('#showmsg').html(_.substring(1));
		if(_.substring(0,1)==1)
		{
			theform.t0.value='';
			theform.t1.value='';
			theform.t2.value='';
			theform.t3.value='';
			jQuery("#yzm_num")[0].src = jQuery("#yzm_num")[0].src+"&"+Math.random();
			setTimeout("window.location.href='?';","3000");
			}
		}
	});
	return false
}

function checkvote(theform,t1)
{  
	var temp=""; 
	for(var i=0;i<theform.vote.length;i++) 
	{ 
	if(theform.vote[i].checked) 
	temp+=theform.vote[i].value+","; 
	}
	if(temp==""){
		jQuery("#showvote").html("����ѡ��һ��ѡ��");
	return false
	}
	var param;
	param=webdir+"plug/vote/Index.asp?action=save";
	param+="&t0="+escape(trim(temp));
	param+="&id="+escape(trim(theform.vote_id.value));
	jQuery('#showvote').html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type:"post",
	cache:false,
	url:param,
	timeout:20000,
	error:function(){jQuery('#showvote').html(Ajax_msg);},
	success:function(t0)
	{
		jQuery('#showvote').html(t0.substring(1));
		if(t0.substring(0,1)==0){jQuery('#showvote').html(t0.substring(1));if(t1==1){window.location.href='?id='+theform.vote_id.value+'';}}
		}
	});
	return false
}

function checkPublish(theform)
{  
	if (trim(theform.t0.value)=='')
	{   alert('���ⲻ��Ϊ��');
		theform.t0.focus();
		theform.t0.value='';
		return false
	}
	if (trim(theform.t1.value)=='')
	{   alert('���߲���Ϊ��');
		theform.t1.focus();
		theform.t1.value='';
		return false
	}
	if (trim(theform.t2.value)=='')
	{   alert('��Դ����Ϊ��');
		theform.t2.focus();
		theform.t2.value='';
		return false
	}
	if (trim(theform.t3.value)=='0')
	{   alert('��ѡ����Ŀ');
		theform.t3.focus();
		return false
	}
	if (KE.isEmpty('t6'))
	{   alert('���ݲ���Ϊ��');
		trim(theform.t6.value).focus;
		return false
	}
	if (trim(theform.yzm.value)=='')
	{   alert('��֤�벻��Ϊ��');
		theform.yzm.focus();
		theform.yzm.value='';
		return false
	}
	var url,param;
	url=webdir+"plug/publish/index.asp?action=save";
	param="t0="+escape(trim(theform.t0.value));
	param+="&t1="+escape(trim(theform.t1.value));
	param+="&t2="+escape(trim(theform.t2.value));
	param+="&t3="+escape(trim(theform.t3.value));
	param+="&t4="+escape(trim(theform.t4.value));
	param+="&t5="+escape(trim(theform.t5.value));
	param+="&t6="+escape(trim(theform.t6.value));
	param+="&t7="+escape(trim(theform.yzm.value));
	jQuery('#showmsg').html("<img src="+webdir+"css/loading.gif>");
	jQuery.ajax({
	type:"post",
	cache:false,
	url:url,
	data:param,
	timeout:20000,
	error:function(){jQuery('#showmsg').html(Ajax_msg);},
	success:function(_)
	{
		jQuery('#showmsg').html(_.substring(1));
		if(_.substring(0,1)==1){
			theform.t0.value='';
			theform.t1.value='';
			theform.t2.value='';
			theform.t3.value='';
			theform.t4.value='';
			theform.t5.value='';
			KE.html("t6","");
			jQuery("#yzm_num")[0].src = jQuery("#yzm_num")[0].src+"&"+Math.random();
			setTimeout("window.location.href='?';","3000");
			}
		}
	});
	return false
}


//����ҳ������ַ
function copyurl(id){
var testCode=jQuery("#"+id)[0].value;
	if(copy2Clipboard(testCode)!=false)
		{
			jQuery("#"+id).select();
			alert("�Ѹ��ƣ�ʹ��Ctrl+Vճ����������������Ѱ�`");
		}
}
copy2Clipboard=function(txt)
{
if(window.clipboardData)
{
	window.clipboardData.clearData();
	window.clipboardData.setData("Text",txt);
}
else if(navigator.userAgent.indexOf("Opera")!=-1)
{
	window.location=txt;
}
else if(window.netscape)
{
	try{
	   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
	}
catch(e){
   alert("����firefox��ȫ�������������м�������������'about:config'��signed.applets.codebase_principal_support'����Ϊtrue'֮�����ԡ�");
   return false;
}
var clip=Components.classes['@mozilla.org/widget/clipboard;1'].createInstance

(Components.interfaces.nsIClipboard);
if(!clip)return;
var trans=Components.classes['@mozilla.org/widget/transferable;1'].createInstance

(Components.interfaces.nsITransferable);
if(!trans)return;
trans.addDataFlavor('text/unicode');
var str=new Object();
var len=new Object();
var str=Components.classes["@mozilla.org/supports-string;1"].createInstance
(Components.interfaces.nsISupportsString);
var copytext=txt;str.data=copytext;
trans.setTransferData("text/unicode",str,copytext.length*2);
var clipid=Components.interfaces.nsIClipboard;
if(!clip)return false;
clip.setData(trans,null,clipid.kGlobalClipboard);
}
}

//�����ղ�
        function AddFavorite(sURL, sTitle) {
             sURL = encodeURI(sURL); 
        try{   
            window.external.addFavorite(sURL, sTitle);   
 
        }catch(e) {   
 
            try{   
 
                window.sidebar.addPanel(sTitle, sURL, "");   
 
            }catch (e) {   
 
                alert("�����ղ�ʧ�ܣ���ʹ��Ctrl+D�������,���ֶ�����������������.");
 
            }   
 
        }
 
    }
//��Ϊ��ҳ
    function SetHome(url){
 
        if (document.all) {
 
            document.body.style.behavior='url(#default#homepage)';
 
               document.body.setHomePage(url);
 
        }else{
             alert("����,�����������֧���Զ�����ҳ��Ϊ��ҳ����,�����ֶ�������������ø�ҳ��Ϊ��ҳ!");
         }
    }

//-->