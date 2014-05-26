<!--#include File="../ccight.asp" -->
<%
if webopen="2" then
response.write("<br><br><br><br><center><b><a href=""../help.asp"" target=""_blank"">点击→查看程序使用教程</a></b></center>")
Response.End
end if

if webopen="1" then
response.write("<script>alert('本站正在维护中，请稍后再来，谢谢支持!');</script>")
Response.End
end if

%>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="search_blue.css" rel="stylesheet" type="text/css">

<title><%=request("search")%>-闪虎搜索</title>
<meta name="description" content="<%=keywords%>">
<meta name="keywords" content="<%=title%>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script type="text/javascript" src="images1/bs.js"></script>



</div>
<div> </HTML>
 
<SCRIPT language=javascript>
function index_search(){
var v=f.k.value
if(f.o[0].checked==true)
window.open("http://www.sharhoo.com/example1/result/so/?search="+v);
if(f.o[1].checked==true)
window.open("http://www.sharhoo.com/example1/result1/so/?search="+v);
if(f.o[2].checked==true)
window.open("http://www.sharhoo.com/example1/result2/so/?search="+v);
if(f.o[3].checked==true)
window.open("http://www.sharhoo.com/example1/result3/so/?search="+v);
if(f.o[4].checked==true)
window.open("http://www.sharhoo.com/example1/result4/so/?search="+v);
if(f.o[5].checked==true)
window.open("http://www.sharhoo.com/example1/result5/so/?search="+v);
if(f.o[6].checked==true)
window.open("http://www.sharhoo.com/example1/result6/so/?search="+v);
if(f.o[7].checked==true)
window.open("http://www.sharhoo.com/example1/result7/so/?search="+v);
return false;}
//-->
</SCRIPT></div>
<div><META content="MSHTML 5.00.3700.6699" name=GENERATOR>
<CENTER>
<div align="center">
<TABLE id=table938 border=0 cellspacing="0" cellpadding="0" width="671">
  <TBODY>
  <FORM name=f onsubmit=return(index_search())>
  <TR>
    <TD noWrap> <font color="#FF0000"><a target="_blank" href="http://www.sharhoo.com/">闪虎搜索</a></font>
 <INPUT class=input_box maxLength=64 size=19 value=<%=request("search")%>
      name=k> <INPUT type=submit value=闪虎一下 name=submit> <font color="#008000">
 <INPUT type=radio value=0 name=o>  网页 
 <INPUT type=radio value=2 name=o> 图片 
      <INPUT type=radio value=3 name=o> 视频 <INPUT type=radio value=4 name=o checked> 音乐 
      <INPUT type=radio value=58 name=o> 新闻 
    
    <INPUT type=radio value=59 name=o>软件
<INPUT type=radio value=510 name=o> 字典 
      
  <INPUT type=radio value=511 name=o> 知识 
 </tr>
 </tr>
 </TBODY></TABLE>
<HTML>
      </div>
</table></div>
<div>

<div style="margin:0px;padding-bottom:0px;border=0px;width:100%;height:100%;height:3000px;text-align:left;background:none;overflow:hidden;">  
      
<iframe rel="nofollow" src="http://www.sharhoo.com/blend/so/sou.asp?search=<%=request("search")%>&want=music&engine=mp3.sogou.com/music?&gword=query=&ctt4=class=buttons-active"width=1000 height=3000 frameborder="0" name="Result" scrolling="no" style="margin-top:-196px;"></iframe></div> 
 <div style='display:none;'><script src="http://s34.cnzz.com/stat.php?id=3016407&web_id=3016407" language="JavaScript" charset="gb2312"></script></div>
</body>

</html>