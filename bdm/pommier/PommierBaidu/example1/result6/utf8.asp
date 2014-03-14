<html>
<head>
<title></title>
<meta content="text/html; charset=gb2312" http-equiv="content-type" />
<meta name="Robots" content="all" />
<meta name="Generator" content="Dreamweaver,ASP" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<script>var location='';</script>
</head>



<script language="JAVASCRIPT" runat="server"> 
var ss; 
var dd; 
ss=decodeURIComponent("%E6%B1%89%E5%AD%97");  //UTF编码转为汉字
dd=encodeURIComponent(request("search"));  //汉字转为UTF编码

</script> 


<body leftMargin=0 topMargin=0 rightMargin=0 bottomMargin=0 style="overflow-x:hidden;overflow-y:hidden">

<%
language=request("yy")
language= Replace(language,";;","&")

Response.Status="301 Moved Permanently" 

Response.AddHeader "Location","http://"&request("webburl")&""&dd&"&"&language&"" 
Response.End
%>
</body>
</html>