<!--
cook=GetCookie('skintheme');if(cook) Ob('skintheme').href="/css/st_"+cook+".css"
function sst(a) { Ob('skintheme').href="/css/st_"+a+".css";s_cookie('skintheme',a,5184000,'/','.3456.cc') }


function Ob(o){
 var o=document.getElementById(o)?document.getElementById(o):o;
 return o;
}

function GetCookie(Name) {
 var search = Name + "=";
 var returnvalue = "";
 if (document.cookie.length > 0) {
  offset = document.cookie.indexOf(search);
  if (offset != -1) {      
   offset += search.length;
   end = document.cookie.indexOf(";", offset);                        
   if (end == -1)
   end = document.cookie.length;
   returnvalue=unescape(document.cookie.substring(offset,end));
  }
 }
 return returnvalue;
}
function s_cookie(name, value)
{var expdate = new Date();var argv = s_cookie.arguments;var argc = s_cookie.arguments.length
var expires = (argc > 2) ? argv[2] : null;var path = (argc > 3) ? argv[3] : null
var domain = (argc > 4) ? argv[4] : null;var secure = (argc > 5) ? argv[5] : false
if(expires!=null) expdate.setTime(expdate.getTime() + ( expires * 1000 ))
document.cookie = name + "=" + escape (value) +((expires == null) ? "" : ("; expires="+ expdate.toGMTString()))
+((path == null) ? "" : ("; path=" + path)) +((domain == null) ? "" : ("; domain=" + domain))
+((secure == true) ? "; secure" : "")}
-->