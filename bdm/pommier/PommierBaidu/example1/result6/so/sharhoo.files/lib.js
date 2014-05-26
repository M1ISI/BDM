function showHotTab(n1,n2){
	var h=document.getElementById("tab"+n1).getElementsByTagName("h3");
	var d=document.getElementById("tab"+n1).getElementsByTagName("div");
	for(var i=0;i<h.length;i++){
		if(n2-1==i){
			h[i].className+=" up";
			d[i].className+=" block";
		}
		else {
			h[i].className=" ";
			d[i].className=" ";
		}
	}
}
function showDiv(i) 
{ 
for(j=0;j<=3;j++) 
{ 
document.getElementById('div'+j).style.display='none'; 

} 
document.getElementById('div'+i).style.display='block'; 
} 


function fsshow(tid){
	if (tid== '0'){
     document.getElementById("fs").style.display = "";
	}
	else{ 
	document.getElementById("fs").style.display = "none";
	}
}



function SetHome(obj, vrl){
    try {
        obj.style.behavior = 'url(#default#homepage)';
        obj.setHomePage(vrl);
    } 
    catch (e) {
        if (window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            } 
            catch (e) {
                alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将[signed.applets.codebase_principal_support]设置为'true'");
            }
            var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
            prefs.setCharPref('browser.startup.homepage', vrl);
        }
    }
}


function addBookmark(name,url){
	 if (window.sidebar) { // Mozilla Firefox
	    window.sidebar.addPanel(name, url, "");
		}else if (window.external) { // IE
		    window.external.AddFavorite(url, name);
		}else if (window.opera && window.print) {
		    window.external.AddFavorite(url, name);
		}else {
		    alert('not supported');
		}
}



function selclick(){
	document.getElementById("tool_selmenu").style.display = document.getElementById("tool_selmenu").style.display == "none"? "inline" : "none";
}
function selc(selcid){
	document.getElementById("tool_selmenu").style.display = "none";
	
	if (selcid== '0'){
     document.getElementById("tool_sel").innerHTML = "实用工具";
   
     document.getElementById("sytool").style.display = "";
     document.getElementById("bmfw").style.display = "none";
     document.getElementById("ggrs").style.display = "none";
	 
	 document.getElementById("more7").style.display = "";
	}
	
	
	else if (selcid== '1'){
     document.getElementById("tool_sel").innerHTML = "便民服务";
   
    document.getElementById("sytool").style.display = "none";
     document.getElementById("bmfw").style.display = "";
     document.getElementById("ggrs").style.display = "none";
	 
	 document.getElementById("more7").style.display = "none";
	}
	
	else{ 
	document.getElementById("tool_sel").innerHTML = "谷歌热搜";
	
	document.getElementById("sytool").style.display = "none";
	document.getElementById("bmfw").style.display = "none";
	document.getElementById("ggrs").style.display = "";
	
	 document.getElementById("more7").style.display = "none";
	
	}
	
}

function selmouseover(){isover = 1;}
function selmouseout(){isover = 0;}
function clickspace(eve){
	if (isover == 0){
		document.getElementById("tool_selmenu").style.display = "none";
	}
}
var isover = 0;
if (document.attachEvent){
	document.attachEvent("ondragstart", clickspace);
	document.attachEvent("onclick", clickspace);
}
else {
	document.addEventListener("click", clickspace, false);
}
