
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="search_blue.css" rel="stylesheet" type="text/css">

<title><%=request("search")%>-<%=title%></title>
<meta name="description" content="<%=keywords%>">
<meta name="keywords" content="<%=title%>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script type="text/javascript" src="images1/bs.js"></script>



</head>
<body leftMargin=0 topMargin=0 rightMargin=0 bottomMargin=0 style="overflow-x:hidden;overflow-y:hidden" onmouseover="self.status='1';return true">

<!--#include file="gg4.asp"-->


<div id=viewbtn style="position:absolute; left:10px; top:0px; display:none;"><a href="#" onclick="document.getElementById('dfffd').style.display='block';var viewwrapper=document.getElementById('wrapper');viewwrapper.style.display=(viewwrapper.style.display=='none'?'':'none');var changeifrm=document.getElementById('ifrm');changeifrm.style.height=(changeifrm.style.height=='100%'?'':'86%');var hidebtn=document.getElementById('viewbtn');viewbtn.style.display=(viewbtn.style.display=='none'?'':'none');return false;" style="cursor:hand;text-decoration:none;">显示 ↓</a></div>

<DIV class=wrapper id=wrapper style="display:yes;position:relative; ">


<div id="dfffd" style="position: absolute; width: 50px;left: 20px; top: 63px;">

<a href="#" onclick="document.getElementById('dfffd').style.display='none';var hidewrapper=document.getElementById('wrapper');hidewrapper.style.display=(hidewrapper.style.display=='none'?'':'none');var changeifrm=document.getElementById('ifrm');changeifrm.style.height=(changeifrm.style.height=='86%'?'':'100%');var viewbtn=document.getElementById('viewbtn');viewbtn.style.display=(viewbtn.style.display=='none'?'':'none');return false;" style="cursor:hand;text-decoration:none;">收起 ↑</a>

</div>





<div class="bsddd" id="bsddd" >


<ul>
<li><a href="javaScript:void(0);"  id="sx" >手写</a></li>
<li><a href="#" onclick="javascript:(function(q){!!q?q.toggle():(function(d,j){j=d.createElement('script');j.src='//ime.qq.com/fcgi-bin/getjs';j.setAttribute('ime-cfg','lt=2');d.getElementsByTagName('head')[0].appendChild(j)})(document)})(window.QQWebIME);document.getElementById('bsddd').style.display='none';return false;">拼音/五笔</a></li>
<li><a href="#" onclick="javascript:(function(q){!!q?q.toggle():(function(d,j){j=d.createElement('script');j.src='//ime.qq.com/fcgi-bin/getjs';j.setAttribute('ime-cfg','lt=2&im=212');d.getElementsByTagName('head')[0].appendChild(j)})(document)})(window.QQWebIME);document.getElementById('bsddd').style.display='none';return false;">五笔/拼音</a></li>
<li><a href="#" onclick="document.getElementById('bsddd').style.display='none';return false;">关闭</a></li>
</ul>
</div>

<a href="#" onclick="document.getElementById('bsddd').style.display='inline';return false;" style="cursor:hand;text-decoration:none;position: absolute; width: 50PX;left: 515px; top: 32px;font-size:14px;">手写<span><img src="../images/arr.gif" style="border:0;margin-top: -2px;"></span></a>




<DIV class=header>



<DIV class=innerHeader id=header>



<DIV class=title>

<a href="../"><IMG  src="<%=soupic%>" ></a>


</DIV>
<DIV class=title-ad></DIV>
<DIV class=search>
<DIV class=categories>
<SPAN id=categories>

 
<%
dfd=request.QueryString
dfd=Replace(dfd,"%26","&")
dfd=Replace(dfd,"%3D","=")
%>


<%
pasx=Request.ServerVariables("Script_Name")
pasx1=split(pasx,"/")
pasx2=UBound(pasx1)-1
pasx3=Replace(pasx,pasx1(pasx2)&"/"&pasx1(UBound(pasx1)),"")
szqurl=Request.ServerVariables("HTTP_HOST")&pasx3
%>


<script type="text/javascript" src="unsou.aspx?<%=dfd%>&web688zh=<%=web688zh%>&baiduzh=<%=baiduzh%>&googlezh=<%=googlezh%>&xunleizh=<%=xunleizh%>&taskcn=<%=taskcn%>&zhubajie=<%=zhubajie%>&sogouzh=<%=sogouzh%>&alimamazh=<%=alimamazh%>&dangdangzh=<%=dangdangzh%>&amazonzh=<%=amazonzh%>&zhongsouzh=<%=zhongsouzh%>&zqurl=<%=szqurl%>&sybb=a081&sovip=<%=sfvip%>"></script>


<script type="text/javascript" src="hwInput.js"  language="JavaScript"></script>






<div style="display:none">
<!--#include file="ccount.asp"-->
</div>
</body>

</html>