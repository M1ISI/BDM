<%
Response.AddHeader "P3P", "CP=CAO PSA OUR"
Response.ExpiresAbsolute = Now() - 1
Response.Expires = 0
Response.CacheControl = "no-cache"
passe=Request.ServerVariables("Script_Name")
passe1=split(passe,"/")
passe2=UBound(passe1)
passe3=Replace(passe,passe1(passe2),"")
ssturl=Request.ServerVariables("HTTP_HOST")&passe3

zqurl=request("zqurl")
mmvo="http://"&zqurl&"so/sou.asp?want=video&engine=video.baidu.com/v?&gword=word=&ctt2=class=buttons-active&search="
mmpic="http://"&zqurl&"so/sou.asp?want=photo&engine=pic.sogou.com/pics/pics?&gword=query=&ctt2=class=buttons-active&search="
Dim Agent
Agent=Request.ServerVariables("HTTP_USER_AGENT")
'Agent=Split(Agent,";")

If InStr(Agent,"MSIE")>0 and (request("sovip")="" or request("vipie")="1") Then
if request.Cookies("szzy")=""  then
vipmmvo="onclick=""document.getElementById('setdp').style.display='block'"" href=""#"
vipmmpic="onclick=""document.getElementById('setdp').style.display='block'"" href=""#"

else
vipmmvo="target='_blank' href=""http://"&zqurl&"so/sou.asp?want=video&engine=video.baidu.com/v?&gword=word=&ctt2=class=buttons-active&search="
vipmmpic="target='_blank' href=""http://"&zqurl&"so/sou.asp?want=photo&engine=pic.sogou.com/pics/pics?&gword=query=&ctt2=class=buttons-active&search="

end if
else
vipmmvo="target='_blank' href=""http://"&zqurl&"so/sou.asp?want=video&engine=video.baidu.com/v?&gword=word=&ctt2=class=buttons-active&search="
vipmmpic="target='_blank' href=""http://"&zqurl&"so/sou.asp?want=photo&engine=pic.sogou.com/pics/pics?&gword=query=&ctt2=class=buttons-active&search="
end if
%>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="gb2312">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������������,��վ����</title>
<meta name="Robots" content="all" />
<meta name="Generator" content="Dreamweaver,ASP" />
<meta name="description" content="������������,��վ����" />
<meta name="keywords" content="������������,��վ����" />
<meta http-equiv="x-ua-compatible" content="ie=7" /> 



<style type="text/css">
body{
  padding: 0;
  margin:auto;
  background:#FEFFED;
  font-size:12px;font-family:"����", "Arial", "sans-serif";text-align:center;color:#000000

}
a{font-size:12px;font-family:"����", "Arial", "sans-serif";text-align:center;color:#000000;text-decoration:none}





/* common styling */
.menuts {font-family: arial, sans-serif; width:300px; height:50px;  margin:0; font-size:14px;top:0px;margin:auto;}
.menuts ul li a, .menuts ul li a:visited {display:block; text-decoration:none; color:#000;width:38px; height:20px; text-align:center; line-height:20px; font-size:14px; overflow:hidden;padding-top:3px;}
.menuts ul {float:left;padding:0; margin:0;list-style-type: none;width:128px; height:30px;}
.menuts ul li {float:left; margin-right:1px; position:relative;}
.menuts ul li ul {display: none;}
/* specific to non IE browsers */
.menuts ul li:hover a {color:#fff; background:#999999;}
.menuts ul li:hover ul {display:block; position:absolute; top:0; left:89px; width:38px;}
.menuts ul li:hover ul li a.hide {background:#6a3; color:#fff;}
.menuts ul li:hover ul li:hover a.hide {background:#999999; color:#000;}
.menuts ul li:hover ul li ul {display: none;}
.menuts ul li:hover ul li a {display:block; background:#FFD870; color:#000;}
.menuts ul li:hover ul li a:hover {background:#3CA3CC; color:#fff;}
.menuts ul li:hover ul li:hover ul {display:block; position:absolute; left:105px; top:0;}
</style>



<!--[if lte IE 6]>
<style type="text/css">
.menuts ul li a.hide, .menuts ul li a:visited.hide {display:none;}
.menuts ul li a:hover ul li a.hide {display:none;}
.menuts ul li a:hover {color:#fff; background:#999999;}
.menuts ul li a:hover ul {display:block; position:absolute; top:0; left:89px; width:38px;}
.menuts ul li a:hover ul li a.sub {background:#999999; color:#fff;}
.menuts ul li a:hover ul li a {display:block; background:#FFD870; color:#000;}
.menuts ul li a:hover ul li a ul {visibility:hidden;}
.menuts ul li a:hover ul li a:hover {background:#3CA3CC; color:#fff;}
.menuts ul li a:hover ul li a:hover ul {visibility:visible; position:absolute; left:100px; top:0; color:#000;}
</style>
<![endif]-->
</head>


<body oncontextmenu="return false" onselectstart="return false">
 <script type="text/javascript">
function clickIE4(){
        if (event.button==2){
                return false;
        }//end if
}//end func
 
function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
                if (e.which==2||e.which==3){
                        return false;
                }//end if
        }//end if
}//end func
 
function OnDeny(){
        if(event.ctrlKey || event.keyCode==78 && event.ctrlKey || event.altKey || event.altKey && event.keyCode==115){
                return false;
        }//end if
}
 
if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS4;
        document.onkeydown=OnDeny();
}else if (document.all&&!document.getElementById){
        document.onmousedown=clickIE4;
        document.onkeydown=OnDeny();
}//end if
 
document.oncontextmenu=new Function("return false");
</script>

<script language="javascript" src="func.htm"></script>


<center>
<div style="width:640px;position:relative;">
<div id="setdp" style="position: absolute;top:100px;left:125px;visibility:visible;z-index:100;display:none;"><img src="swzy.gif" width="390" height="150" border="0" usemap="#Map2"></div>
<map name="Map2">
<area shape="rect" coords="300, 103, 199, 135" href="#"  onclick="document.getElementById('setdp').style.display='none';return false">
<area shape="rect" coords="91, 103, 190, 135" href="#"  onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://<%=zqurl%>');document.cookie='szzy=vb;expires =Fri, 31 Dec 2200 23:59:59 GMT';location.href='mvcsou.asp?pid=<%=request("web688zh")%>&zqurl=<%=request("zqurl")%>&sovip=<%=request("sovip")%>&sybb=<%=request("sybb")%>'">
</map>
<span class="menuts">


<ul>
<li><a class="hide" style="width:89px">��Ұ��ϣ</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">��Ұ��ϣ
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>��Ұ��ϣ">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>��Ұ��ϣ">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">�S�鰮</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">�S�鰮
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>�S�鰮">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>�S�鰮">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">��������</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">��������
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>��������">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">ϣ־��Ұ</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">ϣ־��Ұ
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>ϣ־��Ұ">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>ϣ־��Ұ">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">��������</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">��������
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>��������">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">���ǵ�ɣ</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">���ǵ�ɣ
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>���ǵ�ɣ">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>���ǵ�ɣ">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">С��������</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">С��������
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>С��������">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>С��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">ŮF4</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">ŮF4
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>ŮF4">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>ŮF4">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">����ľϣ</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">����ľϣ
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>����ľϣ">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>����ľϣ">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">ɼԭ����</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">ɼԭ����
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>ɼԭ����">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>ɼԭ����">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">��ɴ�</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">��ɴ�
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>��ɴ�">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>��ɴ�">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">��������</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">��������
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>��������">��Ƶ</a></li>
<li><a target="_blank" href="<%=mmpic%>��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ֵ���</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ֵ���
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>�ֵ���">��Ƶ</a></li>
<li><a <%=vipmmpic%>�ֵ���">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>


<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>ʸ������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>ʸ������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>ʸ������">��Ƶ</a></li>
<li><a <%=vipmmpic%>ʸ������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>��������">��Ƶ</a></li>
<li><a <%=vipmmpic%>��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>��������">��Ƶ</a></li>
<li><a <%=vipmmpic%>��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɽ���䤫</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɽ���䤫
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>�ɽ���䤫">��Ƶ</a></li>
<li><a <%=vipmmpic%>�ɽ���䤫">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>


<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>���">��Ƶ</a></li>
<li><a <%=vipmmpic%>���">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>S��������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>S��������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>S��������">��Ƶ</a></li>
<li><a <%=vipmmpic%>S��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɽ�褦��</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɽ�褦��
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>�ɽ�褦��">��Ƶ</a></li>
<li><a <%=vipmmpic%>�ɽ�褦��">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>������">��Ƶ</a></li>
<li><a <%=vipmmpic%>������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>������">��Ƶ</a></li>
<li><a <%=vipmmpic%>������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>���������">��Ƶ</a></li>
<li><a <%=vipmmpic%>���������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>СҰ�湭</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>СҰ�湭
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>СҰ�湭">��Ƶ</a></li>
<li><a <%=vipmmpic%>СҰ�湭">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>��������">��Ƶ</a></li>
<li><a <%=vipmmpic%>��������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��˪˪</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��˪˪
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>��˪˪">��Ƶ</a></li>
<li><a <%=vipmmpic%>��˪˪">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���˹�</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���˹�
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>���˹�">��Ƶ</a></li>
<li><a <%=vipmmpic%>���˹�">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɵ���</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɵ���
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>�ɵ���">��Ƶ</a></li>
<li><a <%=vipmmpic%>�ɵ���">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>
<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>������">��Ƶ</a></li>
<li><a <%=vipmmpic%>������">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>
<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�캣��</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�캣��
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>�캣��">��Ƶ</a></li>
<li><a <%=vipmmpic%>�캣��">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɱ����椭</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ɱ����椭
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>�ɱ����椭">��Ƶ</a></li>
<li><a <%=vipmmpic%>�ɱ����椭">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ٴ�ߤ�</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>�ٴ�ߤ�
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>�ٴ�ߤ�">��Ƶ</a></li>
<li><a <%=vipmmpic%>�ٴ�ߤ�">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���g����</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>���g����
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>���g����">��Ƶ</a></li>
<li><a <%=vipmmpic%>���g����">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������ϣ</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>������ϣ
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>������ϣ">��Ƶ</a></li>
<li><a <%=vipmmpic%>������ϣ">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>����ɴ��</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>����ɴ��
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>����ɴ��">��Ƶ</a></li>
<li><a <%=vipmmpic%>����ɴ��">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��ԭ����</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>��ԭ����
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>��ԭ����">��Ƶ</a></li>
<li><a <%=vipmmpic%>��ԭ����">ͼƬ</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>
</span>
</div>
<br/>
<b>ÿ��������һ��</b>
</center>

<script type="text/javascript" src="http://js.tongji.linezing.com/1318207/tongji.js"></script><noscript><a href="http://www.linezing.com"><img src="http://img.tongji.linezing.com/1318207/tongji.gif"/></a></noscript>
</body>