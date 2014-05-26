<%''On Error Resume Next '容错声明 
response.buffer=true 
dim connstr,dbpath,conn

sub dblink()
dim sdbs
sdbs="data/# data.asp" '数据库地址
set Conn = server.CreateObject("ADODB.Connection")
connstr="Provider = Microsoft.Jet.OLEDB.4.0;Data Source = "& server.MapPath(dbpath&sdbs)
conn.Open connstr
end sub%>
