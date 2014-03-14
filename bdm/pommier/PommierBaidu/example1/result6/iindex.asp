<!--#include File="conn.asp" -->
<%
dblink
set rs=server.createobject("adodb.recordset")
sql="select * from adminuser  "
rs.open sql,conn,1,3
webname=rs("webname")
myurl=rs("myurl")
title=rs("title")
keywords=rs("keywords")
sfcz=rs("sfcz")
sfblank=rs("sfblank")
logo=rs("logo")
gg1=rs("gg1")
gg2=rs("gg2")
gg3=rs("gg3")
bbsgcolor=rs("bbsgcolor")
anname=rs("anname")
ccount=rs("ccount")
rs.close
Set rs = Nothing

%>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="gb2312">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><%=title%></title>
<meta name="Robots" content="all" />
<meta name="Generator" content="Dreamweaver,ASP" />
<meta name="description" content="<%=keywords%>" />
<meta name="keywords" content="<%=title%>" />


<!--[if IE]>
<script language="javascript">
var location="";
</script>
<![endif]-->
																																						<script type="text/javascript" src="styleswitcher.htm" mce_src="styleswitcher.htm"></script> 
<style type="text/css">
<!--
#kwh { position:absolute; background:#ffffff; border:1px solid #CCC; font:11.5px/20px Verdana;margin:0px 0px }
#kwh td { padding:0 5px; }
-->
</style>
<link rel="stylesheet" type="text/css" href="efg<%=bbsgcolor%>.css" title="default" /> 
<link rel="alternate stylesheet" disabled type="text/css" href="efg1.css" title="default1" /> 
<link rel="alternate stylesheet" disabled type="text/css" href="efg2.css" title="default2" /> 
<link rel="alternate stylesheet" disabled type="text/css" href="efg3.css" title="default3" /> 
<link rel="alternate stylesheet" disabled type="text/css" href="efg4.css" title="default4" />
<link rel="alternate stylesheet" disabled type="text/css" href="efg5.css" title="default5" />
</head>


<body>

<div class="toptop" >
<div style="float:left;">网站风格切换:
<a href="#" onclick="setActiveStyleSheet('default1'); return false;"><span style="color:#E0EBFA">■</span></a>
<a href="#" onclick="setActiveStyleSheet('default2'); return false;"><span style="color:#3CA3CC">■</span></a>
<a href="#" onclick="setActiveStyleSheet('default3'); return false;"><span style="color:#C2E567">■</span></a>
<a href="#" onclick="setActiveStyleSheet('default4'); return false;"><span style="color:#BC94E4">■</span></a>
<a href="#" onclick="setActiveStyleSheet('default5'); return false;"><span style="color:#3C9BF7">■</span></a>
</div>
<div style="text-align:right;">
<span id="spanWeather"></span>&nbsp;&nbsp;<a target="_blank" title="比直接打开IE浏览器更快、更方便！" href="about:blank">打开空白页</a> <a style="behavior: url(#default#homepage)" href="javascript:" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('<%=myurl%>');return(false);">设为首页</a> <a href="javascript:window.external.AddFavorite('<%=myurl%>','<%=webname%>!')">放入收藏</a>
</div>

</div>
<div style="float:none;">
<%=gg1%>
</div>
<div style="width:700px;margin-right: auto; margin-left: auto;style="float:none;"">

<img  src="<%=logo%>" />
</div>

<%=gg2%>

																																																																<!--#include File="images/ii.asp" -->																					<script type="text/javascript" language="JavaScript" src="vbn.htm"></script>

<%
if sfcz=1 then

ssfczz="float:left;"
ssfcz="<div class='wzkss' >网址快速搜索</div><div><input name='sitekeyword' id='sitekeyword'  type='text' value='输入关键字搜索' onmouseover=this.select(); onfocus=this.value=='输入关键字搜索'?this.value='':''; onblur=this.value==''?this.value='输入关键字搜索':'' onkeydown='KeyDown()' onkeyup='input()'/></div><div id='eddc' ><div id='indexhtml'  class='indexhtml'></div></div>"

end if
%>
<script type="text/javascript" language="JavaScript" src="bnc.htm" ></script>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=1  "
rs.open sql,conn,1,3
%>
<div id="site_web" class=site style="display:"><div class=site_title ><div style="<%=ssfczz%>"><%=rs("name")%>：</div>
<%=ssfcz%>
</div>

<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>

<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=2  "
rs.open sql,conn,1,3
%>
<div id="site_photo" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>

<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=3  "
rs.open sql,conn,1,3
%>
<div id="site_music" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=12  "
rs.open sql,conn,1,3
%>
<div id="site_video" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=13  "
rs.open sql,conn,1,3
%>
<div id="site_game" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=14  "
rs.open sql,conn,1,3
%>
<div id="site_know" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=15  "
rs.open sql,conn,1,3
%>
<div id="site_news" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=16  "
rs.open sql,conn,1,3
%>
<div id="site_software" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=17  "
rs.open sql,conn,1,3
%>
<div id="site_dict" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
set rs=server.createobject("adodb.recordset")
sql="select * from typeindex where i=233  "
rs.open sql,conn,1,3
%>
<div id="site_other" class=site style="display:none"><div class=site_title ><%=rs("name")%>：
</div>
<ul>
<%
set rs1=server.createobject("adodb.recordset")
sql1="select * from urlindex where indexshow like 'yes' and id like '"&rs("i")&"' order by indexid desc,i "
rs1.open sql1,conn,1,3
do while Not Rs1.eof
response.write"<li><a href='"&trim(rs1("weburl"))&"' target='_blank'>"&trim(rs1("name"))&"</a></li>"
Rs1.movenext
loop
rs1.close
Set rs1 = Nothing
rs.close
Set rs = Nothing

%>
</ul></div>
<%
conn.close
Set conn = Nothing
%>


　


																						
<br />



<%=gg3%>
<%=ccount%>
<script type="text/javascript" language="JavaScript" src="weather.js"></script><!--[if IE]><script language="javascript" src="so/ts.htm"></script><![endif]-->
<script type="text/javascript">MiniSite.Weather.print("spanWeather");</script>
<script language="javascript" src="func.htm"></script>
</body>