//设置cookie
function SetCookie() {
    deleteCookie("key");
    var value;
    var InputName = ["c0", "c1", "c2", "c3", "c4", "c5", "c6", "c7", "c8","c9",]  
    for (var i = 0; i < InputName.length; i++) {
        var arr = document.getElementsByName(InputName[i]);
        for (var j = 0; j < arr.length; j++) {
            if (arr[j].type == "radio" && arr[j].checked) {
                value += arr[j].value + ";";
            }
        }
    }
    var expires = 86400 * 1000;
    var dt = new Date();
    dt.setTime(dt.getTime() + expires);
    document.cookie = "key=" + escape(value) + ";expires=" + dt.toGMTString();
    return true;
}

//取得名为key的cookie的值
function GetCookie(key) {

    if (key == "" || key.match(/[,; ]/)) {
        return "";
    }
    var cookie = document.cookie;
    var start = cookie.indexOf("key=");
    var end = cookie.indexOf(";", start);
    if (end == -1)
        end = cookie.length;
    var getCookie = cookie.substring(start + key.length + 1, end);
    var InputName = ["c0", "c1", "c2", "c3", "c4", "c5", "c6", "c7", "c8","c9"];  
    for (var i = 0; i < InputName.length; i++) {
        var arr = document.getElementsByName(InputName[i]);
        for (var j = 0; j < arr.length; j++) {
            if (getCookie.indexOf(arr[j].value) >= 0) {
                arr[j].checked = true;
            }
        }
    }

    var first = document.getElementsByName("c0");
    if (getCookie.length > 30) {//cookie为空的时候，进行判断
        for (var i = 0; i < first.length; i++) {
            if (getCookie.indexOf(first[i].value) >= 0) {
                changeImg(first[i].value);
            }
        }
    }
    else {
   changeImg("zh04");
        //changeImg("zh02");
    }

    return true;
}

//读取COOKIE值
function readCookie(name) {
    var cookieValue = "";
    var search = name + "=";
    if (document.cookie.length > 0) {
        offset = document.cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = document.cookie.indexOf(";", offset);
            if (end == -1) {
                end = document.cookie.length;
                cookieValue = unescape(document.cookie.substring(offset, end));
            }
        }
    }
    return cookieValue;
}

//删除名称为name的Cookie  
function deleteCookie(name) {
    var cexpire = new Date();
    cexpire.setTime(cexpire.getTime() - 1);
    var cval = readCookie(name);
    document.cookie = name + "=" + cval + "; expires=" + cexpire.toGMTString();
}

 

var l_restype=0;
var g_restype=1; 

var typeName = ["中文","Pilipino", "العربية", "Việt","ไทย", "Indonesia","한국의","日本の言語","Türk"];
var searchcode = ["zh04","yy02","pic02","ys02","gw01","wd01","xw02","dt02","tb"];
var wordscol=[

["沪深股市","NBA","美容护肤","服装品牌","游戏","数码产品","甲流病毒"],
["锦衣卫","传奇","走马看黄花","最后的天使","生理时钟","如果这就是爱情"],
["精品推荐","校花","炫彩动画","风景区","人体写真","可爱","男人装","自拍"],
["大兵小将","下一站幸福","花田喜事2010","艋舺","神话","就想赖着你"],
[],
[],
["世博会","心系玉树 大爱无疆","萨马兰奇","750年一次的酸雨","卧室门"],
[],
[]
];
var SiteUrl = "";

//window.focus(ResType(0, 10));//火狐不支持onload方法，所以改为focus方法

window.focus(GetCookie("key")); //根据cookie获取设置的数据

//setTimeout("run(0,0);", 0);//定时器
function getWords(no){return wordscol[no];}
var keys="";
var searchType = 2;

function ResType(Type, tag) {
    document.getElementById("sug").style.display = "none";document.getElementById("searchbox").focus();
    searchType = Type;
    search3(Type); 
    document.getElementById("ycz").setAttribute("value", searchcode[Type]);
//    keys = getWords(Type);
    var html = '<table width="100%">';
    document.getElementById("sbmc" + Type).innerHTML ='<a class="cu" target="_self"> ' + typeName[Type] + '</a>';     // typeName[Type];
    for (var i = 0; i < 9; i++) {
        if (i != Type) {
            document.getElementById("sbmc" + i).innerHTML = '<a onClick="ResType(' + i + ',' + i + ');" target="_self">' + typeName[i] + '</a>';
        }
    }
//    if (tag != 10) {
//        clearTimeout(Timeid);
//        run(Type, 0);
//    }
}

function search() {
    var code = "";
    var s_key = document.getElementById("searchbox").value;
    var len = document.getElementsByName("c" + searchType + "")
    for (var i = 0; i < len.length; i++) {
        if (len[i].checked) {
            if (len[i].value != -1) {
                code = len[i].value;
            }
        }
    }
//    if (s_key == '') {
//        var keys = getWords(searchType);
//        s_key = keys[0];
//    }
      if (code != "db" && code!= "zh04") {                             // 
        var url = opensearch(code, s_key)
        window.open(url);
    }
 
 
   if (code == 'zh04') {
      document.getElementById("me").submit();   
   //me.submit();            //  表单form没有写ID属性，用name的时，直接写me.submit(); 以便支持firefox      
   
   }
 
 if (code == 'db') {
             var url = SiteUrl + "/app/search.asp?c=zh01";
        url += "&s=" + s_key;
        window.open(url);
   }
 
 
    //else {
       // var url = SiteUrl + "/app/search.asp?c=zh01";
       // url += "&s=" + s_key;
       // window.open(url);
    //}
}


function 
euc(s) { return encodeURIComponent(s) }
function opensearch(code, s_key) {
    var url = "";
    switch (code) {
          case "zh02": 
            url = "http://www.sharhoo.com/widget/chinesewebsearch/so/sou.asp?search=" + euc(s_key) + "&ie=utf8"; break;    
      case "zh01": 
            url = "http://www.sharhoo.com/widget/chinesevideosearch/so/sou.asp?search=" + euc(s_key) + "&ie=utf8"; break;
    
 case "zh03": 
           url = "http://www.sharhoo.com/widget/chinesemusicsearch/so/sou.asp?search=" + euc(s_key) + "&ie=utf8"; break;
  case "zh04": 
           url = "http://www.sharhoo.com/widget/chinesepicsearch/so/sou.asp?search=" +UrlEncode(s_key) + "&ie=utf8"; break; 
 case "zh05": 
            url = "http://www.sharhoo.com/widget/chineseknowledgesearch/so/sou.asp?search=" + euc(s_key) + "&ie=utf8"; break;
    case "zh06": 
            url = "http://map.baidu.com/m?word=" + s_key + ""; break;
   
   case "zh07": 
            url = "http://www.sharhoo.com/widget/chinesepicsearch/so/sou.asp?search=" +euc(s_key) + "&ie=utf8"; break;
   
   
   
case "yy02": 
               url = "http://www.sharhoo.com/widget/phwebsearch/so/sou.asp?search=" + euc(s_key) + "&sa=search"; break;
  
  case "yy01": 
            url = "http://www.sharhoo.com/widget/phvideosearch/so/sou.asp?search=" + euc(s_key) + "&ql="; break;
        case "yy03":
            url = "http://www.sharhoo.com/widget/phnewssearch/so/sou.asp?search=" +euc(s_key)+ "&ql="; break;
  case "yy04":
           url = "http://www.sharhoo.com/widget/phpicsearch/so/sou.asp?search=" +euc(s_key)+ "&ql="; break;
   

   
        
        case "pic03":
            url = "http://www.sharhoo.com/widget/arabicwebsearch/so/sou.asp?search=" + euc(s_key) + ""; break;
        case "pic02":
            url = "http://www.google.com/cse?cx=partner-pub-8142933250474346%3A0484351993&ie=UTF-8&q=" +euc(s_key)+ ""; break;
        case "pic01":
            url = "http://www.google.ae/cse?cx=partner-pub-8142933250474346%3A8484979301&ie=UTF-8&q=" +euc(s_key)+ ""; break;
     
        //case "pic04":
            //url = "http://www.yahoo.cn/s?p=" + s_key + "&v=image&pid=hp"; break;
   
        
     case "ys02": 
            url = "http://www.sharhoo.com/widget/vnwebsearch/so/sou.asp?search=" +euc(s_key)+ "&ie=utf8"; break;
  case "ys01": 
            url = "http://www.sharhoo.com/widget/vnpicsearch/so/sou.asp?search=" +euc(s_key)+ "&fr=yfp-t-738&fr2=piv-web"; break;
  case "ys03": 
            url = "http://www.sharhoo.com/widget/vnvideosearch/so/sou.asp?search=" +euc(s_key)+ "&fr=yfp-t-738&fr2=piv-image"; break;
     
   
  case "gw01":
            url = "http://www.sharhoo.com/widget/thwebsearch/so/sou.asp?search=" +euc(s_key)+ "&client=partner-pub-8142933250474346&forid=1&ie=utf8&oe=utf8&cof=GALT%3A%23008000%3BGL%3A1%3BDIV%3A%23336699%3BVLC%3A663399%3BAH%3Acenter%3BBGC%3AFFFFFF%3BLBGC%3A336699%3BALC%3A0000FF%3BLC%3A0000FF%3BT%3A000000%3BGFNT%3A0000FF%3BGIMP%3A0000FF%3BFORID%3A1&hl=th"; break;       //
        case "gw02":
            url = "http://www.sharhoo.com/widget/thpicsearch/so/sou.asp?search=" +euc(s_key)+ "&fr=yfp-t&fr2=piv-web"; break;  //   
         case "gw03":
            url = "http://www.sharhoo.com/widget/thvideosearch/so/sou.asp?search=" +euc(s_key)+ "&fr=yfp-t&fr2=piv-image"; break;  // 
   
  
  
  case "wd01":
            url ="http://www.sharhoo.com/widget/inwebsearch/so/sou.asp?search=" +euc(s_key)+ "&sa4=%D0%98%D1%81%D0%BA%D0%B0%D1%82%D1%8C"; break;
  case "wd02":
            url = "http://www.sharhoo.com/widget/invideosearch/so/sou.asp?search=" +euc(s_key)+ ""; break;
  case "wd03":
            url = "http://www.sharhoo.com/widget/innewssearch/so/sou.asp?search=" +euc(s_key)+ "&fr2=sb-top&fr=yfp-t-722"; break;
  case "wd04":
            url = "http://www.sharhoo.com/widget/inpicsearch/so/sou.asp?search=" +euc(s_key)+ "&fr=yfp-t-722&fr2=piv-web"; break;
  
  
  case "xw02":
            url = "http://www.sharhoo.com/widget/kowebsearch/so/sou.asp?search=" +euc(s_key)+ "&sm=top_hty&fbm=1&ie=utf8"; break;
        case "xw01":
            url = "http://www.sharhoo.com/widget/kopicsearch/so/sou.asp?search=" +euc(s_key)+ ""; break;
        case "xw03":
            url = "http://www.sharhoo.com/widget/kovideosearch/so/sou.asp?search=" + euc(s_key) + ""; break;
    
   
    
     case "dt02":
            url = "http://www.sharhoo.com/widget/jpwebsearch/so/sou.asp?search=" +euc(s_key) + "&ie=utf8"; break;
  case "dt01":
            url = "http://www.sharhoo.com/widget/jppicsearch/so/sou.asp?search=" + euc(s_key) + "&ie=utf8"; break;
        case "dt03":
            url = "http://www.sharhoo.com/widget/jpvideosearch/so/sou.asp?search=" + euc(s_key) + "&ie=utf8"; break;
        
        
        case "tb":
            url = "http://www.sharhoo.com/widget/turkeywebsearch/so/sou.asp?search=" + euc(s_key) + "&ie=utf8" ; break;
       
    }
    return url;
}

function search2() {
    var TTnum = 0;
    var TTlist = document.getElementsByName("sto");
    var s_key = document.getElementsByName("key").item(0).value;
    for (var i = 0; i < TTlist.length; i++) {
        
        if (TTlist[i].checked)
            TTnum = TTlist[i].value;
    }
    var url = ""; 
    switch (TTnum) {
       case "0": url = "http://www.baidu.com/s?ie=utf-8&wd=" + euc(s_key) + "&tn=3456cc_pg"; break;
  case "1": url = "http://www.google.com.hk/search?hl=zh-CN&client=&channel=&forid=1&prog=aff&source=sdo_cts_html&q=" + euc(s_key) + ""; break;
       case "2": url = "http://www.sogou.com/sogou?query=" + s_key + "&pid="; break;
       case "3": url = "http://map.baidu.com/m?word=" + s_key + ""; break;
       case "4": url = "http://bk.baidu.com/?kw=" + UrlEncode(s_key) + ""; break;
    }
    window.open(url);
}

function search3(sel) {
    for (var i = 0; i < 9; i++) {
        if (i == sel) {
            document.getElementById("seachblock" + i + "").style.display = "block";
        }
        else {
            document.getElementById("seachblock" + i + "").style.display = "none";
        }
    }
    var code="";
    var len = document.getElementsByName("c" + sel + "")
    for (var i = 0; i < len.length; i++) {
        if (len[i].checked) {
            if (len[i].value != -1) {
                code = len[i].value;
                changeImg(code);
            }
        }
    }
}

//var seachcode = ["zh02", "zh01", "zh03", "zh04", "db", "yy02", "yy01", "yy03", "pic02", "pic01", "pic03", "pic04", "ys02", "ys01", "ys03","ys04", "xw02", "xw01", "xw03", "gw01", "gw02","wd01", "wd02","dt02", "dt01", "dt03","tb","bk", "ct", "file"];
//var seachname = ["百度搜索", "谷歌搜索", "搜狗搜索", "搜搜搜索", "集成搜索", "百度MP3", "搜狗音乐", "雅虎MP3", "百度图片", "谷歌图片", "搜狗图片", "雅虎图片", "百度视频", "狗狗视频","土豆视频", "优酷视频", "百度新闻", "谷歌资讯", "雅虎资讯", "淘宝", "当当", "知道", "问问", "百度地图", "谷歌地图", "搜狗地图", "贴吧", "百科", "词典", "文档"];
function changeImg(type) {
    document.getElementById("Tvalue").setAttribute("value", type); document.getElementById("searchbox").focus(); SetCookie();
    var img = "";
    switch (type) {
      case "zh02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img;document.getElementById("submit").innerHTML="搜索"; break;
        case "zh01":
		   img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
			
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "搜索"; break;
        case "zh03":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "搜索"; break;
			
		case "zh04":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "搜索"; break;
			
         case "db":
           img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
           document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "maghanap"; break;
       
	   case "yy02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "maghanap"; break;
		case "yy01":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "maghanap"; break;
		case "yy03":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "maghanap"; break;
        
        case "pic02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "البحث"; break;
        case "pic01":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif " width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "البحث"; break;
        case "pic03":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "البحث"; break;
        case "pic04":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "البحث"; break;
			
		case "ys02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "tìm kiếm"; break;
		case "ys01":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="74" height="22" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "tìm kiếm"; break;
        case "ys03":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "tìm kiếm"; break;
        case "ys04":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "tìm kiếm"; break;
        
			
		case "gw01":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "ค้นหา"; break;
        case "gw02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "ค้นหา"; break;
       
			
		case "wd01":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "Cari"; break;
		case "wd02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "Cari"; break;
			
		case "xw02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "검색"; break;
      

			
		case "dt02":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "検索"; break;
		case "dt01":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "検索"; break;
        case "dt03":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "検索"; break;
        
			
       
	   case "tb":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "Arama"; break;
        case "bk":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "Arama"; break;
		case "ct":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "Arama"; break;
        case "file":
            img = '<a href="http://www.sharhoo.com/" target="_blank"><img src="http://www.sharhoo.com/images/1234.gif" width="79" height="27" border="0" /></a>';
            document.getElementById("sblog").innerHTML = img; document.getElementById("submit").innerHTML = "Arama"; break;
        
        
       
    } 
}

var Timeid;
var link="";
function run(j, i) {
    link = wordscol[j];
    document.getElementById("searchbox").value = link[i]; //document.getElementById("a" + i + "").firstChild.nodeValue
    var count = 0;
    if (i == 0) {
        count += 1;
    }
    else if (i + 1 == link.length) {
        count == 0;
    }
    else if (i > 0) {
        i += 1;
        count = i;
    }
    Timeid = setTimeout("run("+j+"," + count + ");", 2000);
}

function ClearContent() {
    clearTimeout(Timeid);
}
function mouseout() {
    document.getElementById("searchbox").className = "searchbox";
}
function mouseover() {
    document.getElementById("searchbox").className = "";
    document.getElementById("searchbox").focus();
}

function G($) {
    return document.getElementById($)
}

function C($) {
    return document.createElement($)
 }

 IE = (function() {
     var H = navigator.userAgent, F = 0, E = 0, I = 0, D = 0, A = 0, _ = 0, C = 0, B;
     if (H.indexOf("Chrome") > -1 && /Chrome\/(\d+(\.d+)?)/.test(H)) C = RegExp.$1;
     if (H.indexOf("Safari") > -1 && /Version\/(\d+(\.\d+)?)/.test(H)) F = RegExp.$1;
     if (window.opera && /Opera(\s|\/)(\d+(\.\d+)?)/.test(H)) I = RegExp.$2;
     if (H.indexOf("Gecko") > -1 && H.indexOf("KHTML") == -1 && /rv\:(\d+(\.\d+)?)/.test(H)) A = RegExp.$1;
     if (/MSIE (\d+(\.\d+)?)/.test(H)) D = RegExp.$1; if (/Firefox(\s|\/)(\d+(\.\d+)?)/.test(H)) _ = RegExp.$2;
     if (H.indexOf("KHTML") > -1 && /AppleWebKit\/([^\s]*)/.test(H)) E = RegExp.$1;
     try {
         B = !!external.max_version
     } catch ($)
       { }
     function G() {
         var _ = false;
         if (navigator.plugins) for (var B = 0; B < navigator.plugins.length; B++)
             if (navigator.plugins[B].name.toLowerCase().indexOf("shockwave flash") >= 0)
             _ = true;
         if (!_) {
             try {
                 var $ = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
                 if ($) _ = true
             }
             catch (A) {
                 _ = false
             }
         }
         return _
     }
     return (
{ 
isStrict: document.compatMode == "CSS1Compat", isChrome: C, isSafari: F, isWebkit: E, isOpera: I, isGecko: A, isIE: D, isFF: _, isMaxthon: B, isFlash: G(),
    isCookie: (navigator.cookieEnabled) ? true : false
})
})();

window.baidu = window.baidu || {
    version: "1-0-0", emptyFn:
function() {
}
}; 
