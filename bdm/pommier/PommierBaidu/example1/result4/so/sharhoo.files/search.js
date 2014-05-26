<!--
function 
euc(s) { return encodeURIComponent(s) }
function soso(){document.getElementById("form2").submit()}
function search4()
{
	if(document.form2.abc[0].checked) window.open("http://www.baidu.com/s?tn=3456cc_pg&ie=utf-8&wd="+euc(form2.w.value),"mspg6");
	if(document.form2.abc[1].checked) window.open("http://mp3.baidu.com/m?f=ms&rn=&tn=baidump3&ct=134217728&lm=-1&ie=utf-8&word="+euc(form2.w.value),"mspg4");
	if(document.form2.abc[2].checked) window.open("http://image.baidu.com/i?ct=201326592&cl=2&lm=-1&tn=baiduimage&pv=&z=0&ie=utf-8&word="+euc(form2.w.value),"mspg7");
	if(document.form2.abc[3].checked) window.open("http://video.baidu.com/v?ct=301989888&rn=20&pn=0&db=0&s=0&ie=utf-8&word="+form2.w.value,"mspg9");
	if(document.form2.abc[4].checked) window.open("http://news.baidu.com/ns?cl=2&rn=20&tn=news&ie=utf8&word="+euc(form2.w.value),"mspg11");
	if(document.form2.abc[5].checked) window.open("http://tieba.baidu.com/f?ie=utf-8&kw="+euc(form2.w.value),"mspg0");
	if(document.form2.abc[6].checked) window.open("http://zhidao.baidu.com/q?ct=17&pn=0&tn=ikaslist&rn=10&word="+UrlEncode(form2.w.value),"mspg5");
	if(document.form2.abc[7].checked) window.open("http://bk.baidu.com/?kw="+UrlEncode(form2.w.value),"mspg15");
	if(document.form2.abc[8].checked) window.open("http://map.baidu.com/m?word="+form2.w.value,"mspg12");
	if(document.form2.abc[9].checked) window.open("http://www.baidu.com/baidu?ft=all&q1="+UrlEncode(form2.w.value),"mspg3");
	if(document.form2.abc[10].checked) window.open("http://dict.baidu.com/baidu?bs=&sr=&z=&cl=3&f=8&word="+UrlEncode(form2.w.value),"mspg14");
	if(document.form2.abc[11].checked) window.open("http://mp3.baidu.com/m?f=ms&rn=10&tn=baidump3lyric&ct=150994944&lm=-1&word="+UrlEncode(form2.w.value),"mspg10");
	if(document.form2.abc[12].checked) window.open("http://search.newhua.com/search.asp?Keyword="+UrlEncode(form2.w.value)+"&submit=search","mspg13");
	if(document.form2.abc[13].checked) window.open("http://search.xunlei.com/search.php?id=23030195&keyword="+form2.w.value,"mspg16");
	if(document.form2.abc[14].checked) window.open("http://www.google.com.hk/search?hl=zh-CN&client=&channel=&forid=1&prog=aff&source=sdo_cts_html&q="+euc(form2.w.value),"mspg2");
	//if(document.form2.abc[14].checked) window.open("http://www.google.com.hk/cse?cx=partner-pub-6316708423255468:kx8tss9t39p&ie=utf-8&q="+euc(form2.w.value),"mspg2");
	
	if(document.form2.abc[15].checked) window.open("http://www.sogou.com/sogou?query="+euc(form2.w.value)+"&pid=","mspg1");
	if(document.form2.abc[16].checked) window.open("http://www.yahoo.cn/s?v=web&pid=hp&p="+form2.w.value,"mspg17");
	if(document.form2.abc[17].checked) soso(); 
	//if(document.form2.abc[17].checked) window.open("http://www.soso.com/q?unc=y400141&cid=union.s.wh&ie=utf-8&w="+euc(form2.w.value),"mspg18"); 
	if(document.form2.abc[18].checked) window.open("http://cn.bing.com/search?q="+euc(form2.w.value),"mspg19");	
	if(document.form2.abc[19].checked) window.open("http://www.youdao.com/search?ue=utf8&q="+euc(form2.w.value),"mspg20");
	
	
	return false
}
//-->

<!--

function search8()
{
	if(form8.abc0.checked) window.open("http://tieba.baidu.com/f?ie=utf-8&kw="+euc(form8.key.value),"mspg0");
	if(form8.abc1.checked) window.open("http://www.sogou.com/sogou?query="+euc(form8.key.value)+"&pid=","mspg1");
	if(form8.abc2.checked) window.open("http://www.yahoo.cn/s?v=image&pid=hp&p="+form8.key.value,"mspg2");
	if(form8.abc3.checked) window.open("http://video.baidu.com/v?ct=301989888&rn=20&pn=0&db=0&s=0&ie=utf-8&word="+form8.key.value,"mspg3");
	if(form8.abc4.checked) window.open("http://www.google.com.hk/search?hl=zh-CN&client=&channel=&forid=1&prog=aff&source=sdo_cts_html&q="+euc(form8.key.value),"mspg4");
	if(form8.abc5.checked) window.open("http://zhidao.baidu.com/q?ct=17&pn=0&tn=ikaslist&rn=10&word="+UrlEncode(form8.key.value),"mspg5");
	if(form8.abc6.checked) window.open("http://www.baidu.com/s?tn=3456cc_pg&ie=utf-8&wd="+euc(form8.key.value),"mspg6");
	if(form8.abc7.checked) window.open("http://mp3.baidu.com/m?f=ms&rn=&tn=baidump3&ct=134217728&lm=-1&ie=utf-8&word="+euc(form8.key.value),"mspg7");
	if(form8.abc9.checked) window.open("http://mp3.baidu.com/m?f=ms&rn=10&tn=baidump3lyric&ct=150994944&lm=-1&word="+UrlEncode(form8.key.value),"mspg9");
	if(form8.abc10.checked) window.open("http://www.baidu.com/baidu?ft=all&q1="+UrlEncode(form8.key.value),"mspg10");
	if(form8.abc11.checked) window.open("http://image.baidu.com/i?ct=201326592&cl=2&lm=-1&tn=baiduimage&pv=&z=0&ie=utf-8&word="+euc(form8.key.value),"mspg11");
	if(form8.abc12.checked) window.open("http://www.youdao.com/search?ue=utf8&q="+euc(form8.key.value),"mspg12");
	if(form8.abc13.checked) window.open("http://bk.baidu.com/?kw="+UrlEncode(form8.key.value),"mspg13");
	if(form8.abc14.checked) window.open("http://map.baidu.com/m?word="+form8.key.value,"mspg14");
	if(form8.abc15.checked) window.open("http://news.baidu.com/ns?cl=2&rn=20&tn=news&ie=utf8&word="+euc(form8.key.value),"mspg15");
	if(form8.abc16.checked) window.open("http://dict.baidu.com/baidu?bs=&sr=&z=&cl=3&f=8&word="+UrlEncode(form8.key.value),"mspg16");
	if(form8.abc17.checked) window.open("http://search.newhua.com/search.asp?Keyword="+UrlEncode(form8.key.value),"mspg17");
	if(form8.abc18.checked) window.open("http://search.xunlei.com/search.php?id=23030195&keyword="+form8.key.value,"mspg18");
	
	return false
}
//-->

