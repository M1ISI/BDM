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
<title>超级搜索引擎,网站搜索</title>
<meta name="Robots" content="all" />
<meta name="Generator" content="Dreamweaver,ASP" />
<meta name="description" content="超级搜索引擎,网站搜索" />
<meta name="keywords" content="超级搜索引擎,网站搜索" />
<meta http-equiv="x-ua-compatible" content="ie=7" /> 



<style type="text/css">
body{
  padding: 0;
  margin:auto;
  background:#FEFFED;
  font-size:12px;font-family:"宋体", "Arial", "sans-serif";text-align:center;color:#000000

}
a{font-size:12px;font-family:"宋体", "Arial", "sans-serif";text-align:center;color:#000000;text-decoration:none}





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
<li><a class="hide" style="width:89px">星野亚希</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">星野亚希
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>星野亚希">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>星野亚希">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">篠崎爱</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">篠崎爱
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>篠崎爱">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>篠崎爱">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">西田麻衣</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">西田麻衣
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>西田麻衣">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>西田麻衣">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">希志爱野</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">希志爱野
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>希志爱野">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>希志爱野">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">朝美惠香</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">朝美惠香
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>朝美惠香">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>朝美惠香">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">莉亚迪桑</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">莉亚迪桑
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>莉亚迪桑">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>莉亚迪桑">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">小泽玛利亚</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">小泽玛利亚
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>小泽玛利亚">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>小泽玛利亚">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">女F4</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">女F4
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>女F4">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>女F4">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">佐佐木希</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">佐佐木希
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>佐佐木希">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>佐佐木希">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">杉原杏璃</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">杉原杏璃
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>杉原杏璃">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>杉原杏璃">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">江纱绫</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">江纱绫
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>江纱绫">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>江纱绫">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px">长崎莉奈</a>
<!--[if lte IE 6]>
<a  href="javaScript:void(0);" style="width:89px">长崎莉奈
<table><tr><td>
<![endif]-->
<ul>
<li><a target="_blank" href="<%=mmvo%>长崎莉奈">视频</a></li>
<li><a target="_blank" href="<%=mmpic%>长崎莉奈">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>手岛优</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>手岛优
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>手岛优">视频</a></li>
<li><a <%=vipmmpic%>手岛优">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>


<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>矢吹春奈</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>矢吹春奈
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>矢吹春奈">视频</a></li>
<li><a <%=vipmmpic%>矢吹春奈">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>瀬戸早妃</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>瀬戸早妃
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>瀬戸早妃">视频</a></li>
<li><a <%=vipmmpic%>瀬戸早妃">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>二宫步美</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>二宫步美
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>二宫步美">视频</a></li>
<li><a <%=vipmmpic%>二宫步美">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>矶山さやか</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>矶山さやか
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>矶山さやか">视频</a></li>
<li><a <%=vipmmpic%>矶山さやか">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>


<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>王李丹</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>王李丹
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>王李丹">视频</a></li>
<li><a <%=vipmmpic%>王李丹">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>S田麻里子</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>S田麻里子
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>S田麻里子">视频</a></li>
<li><a <%=vipmmpic%>S田麻里子">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>松金ようこ</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>松金ようこ
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>松金ようこ">视频</a></li>
<li><a <%=vipmmpic%>松金ようこ">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>黄美姬</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>黄美姬
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>黄美姬">视频</a></li>
<li><a <%=vipmmpic%>黄美姬">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>李智友</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>李智友
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>李智友">视频</a></li>
<li><a <%=vipmmpic%>李智友">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>泽尻绘里香</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>泽尻绘里香
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>泽尻绘里香">视频</a></li>
<li><a <%=vipmmpic%>泽尻绘里香">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>小野真弓</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>小野真弓
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>小野真弓">视频</a></li>
<li><a <%=vipmmpic%>小野真弓">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>长泽奈央</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>长泽奈央
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>长泽奈央">视频</a></li>
<li><a <%=vipmmpic%>长泽奈央">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>潘霜霜</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>潘霜霜
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>潘霜霜">视频</a></li>
<li><a <%=vipmmpic%>潘霜霜">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>若菜光</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>若菜光
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>若菜光">视频</a></li>
<li><a <%=vipmmpic%>若菜光">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>松岛枫</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>松岛枫
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>松岛枫">视频</a></li>
<li><a <%=vipmmpic%>松岛枫">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>
<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>周秀娜</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>周秀娜
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>周秀娜">视频</a></li>
<li><a <%=vipmmpic%>周秀娜">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>
<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>天海翼</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>天海翼
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>天海翼">视频</a></li>
<li><a <%=vipmmpic%>天海翼">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>松本さゆき</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>松本さゆき
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>松本さゆき">视频</a></li>
<li><a <%=vipmmpic%>松本さゆき">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>仲村みう</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>仲村みう
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>仲村みう">视频</a></li>
<li><a <%=vipmmpic%>仲村みう">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>滝沢乃南</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>滝沢乃南
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>滝沢乃南">视频</a></li>
<li><a <%=vipmmpic%>滝沢乃南">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>池田夏希</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>池田夏希
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>池田夏希">视频</a></li>
<li><a <%=vipmmpic%>池田夏希">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>相武纱季</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>相武纱季
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>相武纱季">视频</a></li>
<li><a <%=vipmmpic%>相武纱季">图片</a></li>
</ul>
<!--[if lte IE 6]>
</td></tr></table>
</a>
<![endif]-->
</li>
</ul>

<ul>
<li><a class="hide" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>次原加奈</a>
<!--[if lte IE 6]>
<a href="javaScript:void(0);" style="width:89px"><img src="vip.gif" style="border:0;margin-top: -4px;"/>次原加奈
<table><tr><td>
<![endif]-->
<ul>
<li><a <%=vipmmvo%>次原加奈">视频</a></li>
<li><a <%=vipmmpic%>次原加奈">图片</a></li>
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
<b>每星期增加一次</b>
</center>

<script type="text/javascript" src="http://js.tongji.linezing.com/1318207/tongji.js"></script><noscript><a href="http://www.linezing.com"><img src="http://img.tongji.linezing.com/1318207/tongji.gif"/></a></noscript>
</body>