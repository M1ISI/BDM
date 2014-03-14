<%Response.AddHeader "P3P", "CP=CAO PSA OUR"%>
<%

	search=request("search")
	want=request("want")


engine=request("engine")
gword=request("gword")
ctt="class=buttons-active"
bttc="class=prefered-active"



if want="" then


if request.QueryString("swbr")<>"" then
response.Cookies("sswbr")=Request.QueryString("swbr")
Response.Cookies("sswbr").Expires=DateAdd("d",365,now())
end if

swbrname="设为默认"
swbrname1="设为默认"
bswbr="1"
bswbr1="3"
swbrurl="so.123412.cn/so/baidugoogle.asp?"
swbrurl1="www.google.cn/custom?"
swbrword="p="
swbrword1=Server.URLEncode("sa=Google+%CB%D1%CB%F7||client=pub-1291838625141786||forid=1||ie=GB2312||oe=GB2312||hl=zh-CN||q=")
bbcttt="ctt3"
bbcttt1="ctt2"
bttc1=bttc


if request.Cookies("sswbr")="1" then    '如果默认为百度+google
swbrname="解除默认"                      '百度+google解除按钮显示
swbrname1="设为默认"			'google按钮显示

swbrurl="www.baidu.com/s?"        '百度+google按钮的连接
swbrword="tn=123412_pg||wd="      '百度+google按钮的连接
swbrurl1="www.google.cn/custom?"  'google按钮的连接
swbrword1=Server.URLEncode("sa=Google+%CB%D1%CB%F7||client=pub-1291838625141786||forid=1||ie=GB2312||oe=GB2312||hl=zh-CN||q=")   'google按钮的连接
bbcttt="ctt1"
bswbr="2"			'百度+google按钮设cookies值,2为解除
bswbr1="3"			'google按钮设cookies值,3为设Google为默认
end if

if request.Cookies("sswbr")="3" then  '如果默认为google
swbrname="设为默认"        '百度+google设为默认显示
swbrname1="解除默认"        'google解除按钮显示

swbrurl1="www.baidu.com/s?"     'google默认按钮的连接
swbrword1="tn=123412_pg||wd="     'google默认按钮的连接
swbrurl="so.123412.cn/so/baidugoogle.asp?"        '百度+google按钮的连接
swbrword="p="      '百度+google按钮的连接
bbcttt1="ctt1"
bswbr1="2"    'google按钮设cookies值,2为解除
bswbr="1"     'google按钮设cookies值,1为设百度+google为默认
end if




if request("engine")=""  then

engine="www.baidu.com/s?"
gword="tn=123412_pg||wd="
bctt1="class=buttons-active"


if request.Cookies("sswbr")="1" then
swbrname="解除默认"
swbrname1="设为默认"
engine="so.123412.cn/so/baidugoogle.asp?"
gword="p="
bctt3="class=buttons-active"
swbrurl="www.baidu.com/s?"
swbrword="tn=123412_pg||wd="
swbrurl1="www.google.cn/custom?"
swbrword1=Server.URLEncode("sa=Google+%CB%D1%CB%F7||client=pub-1291838625141786||forid=1||ie=GB2312||oe=GB2312||hl=zh-CN||q=")
bbcttt="ctt1"
bswbr="2"
bswbr1="3"
bctt1=""
end if

if request.Cookies("sswbr")="3" then
swbrname="设为默认"
swbrname1="解除默认"
engine="www.google.cn/custom?"
gword="sa=Google+%CB%D1%CB%F7||client=pub-1291838625141786||forid=1||ie=GB2312||oe=GB2312||hl=zh-CN||q="
bctt2="class=buttons-active"
swbrurl1="www.baidu.com/s?"
swbrword1="tn=123412_pg||wd="
swbrurl="so.123412.cn/so/baidugoogle.asp?"
swbrword="p="
bbcttt1="ctt1"
bswbr1="2"
bswbr="1"
bctt1=""
end if


end if
websou="<A "&request("ctt1")&" "&bctt1&" href=?search="&Server.URLEncode(search)&"&want=&engine=www.baidu.com/s?&gword=tn=123412_pg||wd=&ctt1="&ctt&">百度</A>  <A "&request("ctt2")&" "&bctt2&" href='?search="&Server.URLEncode(search)&"&want=&engine=www.google.cn/custom?&gword="&Server.URLEncode("sa=Google+%CB%D1%CB%F7||client=pub-1291838625141786||forid=1||ie=GB2312||oe=GB2312||hl=zh-CN||q=")&"&ctt2="&ctt&"'>Google(<input  style='MARGIN-BOTTOM: -1px; PADDING-TOP: 2px;width:60PX' onclick=javascript:location.href='?search="&Server.URLEncode(search)&"&want=&engine="&swbrurl1&"&gword="&swbrword1&"&swbr="&bswbr1&"&"&bbcttt1&"="&ctt&"' type='button' value='"&swbrname1&"' name='fanhui'>)</A>  <A "&request("ctt3")&" "&bctt3&" href='?search="&Server.URLEncode(search)&"&want=&engine=so.123412.cn/so/baidugoogle.asp?&gword=p=&ctt3="&ctt&"'>百度+google(<input  style='MARGIN-BOTTOM: -1px; PADDING-TOP: 2px;width:60PX' onclick=javascript:location.href='?search="&Server.URLEncode(search)&"&want=&engine="&swbrurl&"&gword="&swbrword&"&swbr="&bswbr&"&"&bbcttt&"="&ctt&"' type='button' value='"&swbrname&"' name='fanhui'>)</a></A>   <A "&request("ctt4")&" href='?search="&Server.URLEncode(search)&"&want=&engine=www.sogou.com/websearch/corp/search.jsp?&gword=query=&ctt4="&ctt&"'>搜狗</A>  <A "&request("ctt5")&" href='?search="&Server.URLEncode(search)&"&want=&engine=www.soso.com/q?&gword=w=&ctt5="&ctt&"'>搜搜</A>  <A "&request("ctt6")&" href='?search="&Server.URLEncode(search)&"&want=&engine=www.yodao.com/search?&gword=q=&ctt6="&ctt&"'>有道</A>  <A "&request("ctt7")&" href='?search="&Server.URLEncode(search)&"&want=&engine=p.zhongsou.com/p?&gword=w=&ctt7="&ctt&"'>中搜</A> <A "&request("ctt8")&" href='?search="&Server.URLEncode(search)&"&want=&engine=www.yisou.com/search:&gword=&ctt8="&ctt&"'>易搜</A> <A "&request("ctt9")&" href='?search="&Server.URLEncode(search)&"&want=&engine=so.123412.cn/so/utf8.asp?&gword=webburl=search.live.com/results.aspx?q=||search=&ctt9="&ctt&"'>Live</A> <A "&request("ctt10")&" href='?search="&Server.URLEncode(search)&"&want=&engine=one.cn.yahoo.com/s?&gword=p=&ctt10="&ctt&"'>雅虎</A><A "&request("ctt11")&" href='?search="&Server.URLEncode(search)&"&want=&engine=search.21cn.com/srhList_web.php?&gword=chid=www||keyword=&ctt11="&ctt&"'>21CN</A>"

else 

if want="photo" then
bttc2=bttc
if request("engine")="" then
engine="image.baidu.com/i?"
gword="ct=201326592||lm=-1||word="
bctt1="class=buttons-active"
end if
websou="<A "&request("ctt1")&" "&bctt1&"  href=?search="&Server.URLEncode(search)&"&want=photo&engine=image.baidu.com/i?&gword=ct=201326592||lm=-1||word=&ctt1="&ctt&">百度</A>  <A "&request("ctt2")&" href='?search="&Server.URLEncode(search)&"&want=photo&engine=images.google.cn/images?&gword=client=pub-1291838625141786||ie=GB2312||oe=GB2312||hl=zh-CN||gbv=2||aq=f||q=&ctt2="&ctt&"'>Google</A>     <A "&request("ctt4")&" href='?search="&Server.URLEncode(search)&"&want=photo&engine=pic.sogou.com/pics/pics?&gword=query=&ctt4="&ctt&"'>搜狗</A>  <A "&request("ctt5")&" href='?search="&Server.URLEncode(search)&"&want=photo&engine=image.soso.com/q?&gword=w=&ctt5="&ctt&"'>搜搜</A>  <A "&request("ctt6")&" href='?search="&Server.URLEncode(search)&"&want=photo&engine=image.yodao.com/search?&gword=q=&ctt6="&ctt&"'>有道</A>  <A "&request("ctt7")&" href='?search="&Server.URLEncode(search)&"&want=photo&engine=img.zhongsou.com/i?&gword=w=&ctt7="&ctt&"'>中搜</A>"

else
if want="music" then
bttc3=bttc
if request("engine")="" then
engine="mp3.baidu.com/m?"
gword="ct=134217728||lm=-1||word="
bctt1="class=buttons-active"
end if
websou="<A "&request("ctt1")&" "&bctt1&" href=?search="&Server.URLEncode(search)&"&want=music&engine=mp3.baidu.com/m?&gword=ct=134217728||lm=-1||word=&ctt1="&ctt&">百度</A>   <A "&request("ctt3")&" href='?search="&Server.URLEncode(search)&"&want=music&engine=mp3.gougou.com/search?&gword=search=&ctt3="&ctt&"'>狗狗</A>   <A "&request("ctt4")&" href='?search="&Server.URLEncode(search)&"&want=music&engine=mp3.sogou.com/music?&gword=query=&ctt4="&ctt&"'>搜狗</A>  <A "&request("ctt5")&" href='?search="&Server.URLEncode(search)&"&want=music&engine=music.soso.com/music.cgi?&gword=w=&ctt5="&ctt&"'>搜搜</A>  <A "&request("ctt6")&" href='?search="&Server.URLEncode(search)&"&want=music&engine=m.iask.com/g?&gword=k=&ctt6="&ctt&"'>爱问</A>  <A "&request("ctt7")&" href='?search="&Server.URLEncode(search)&"&want=music&engine=mp3.gougou.com/search?&gword=mtv=1||search=&ctt7="&ctt&"'>MTV</A>"

else
if want="video" then
bttc4=bttc
if request("engine")="" then
engine="movie.gougou.com/search?"
gword="id=4008441||pattern=10100||search="
bctt1="class=buttons-active"
end if
websou="<A "&request("ctt1")&" "&bctt1&" href=?search="&Server.URLEncode(search)&"&want=video&engine=movie.gougou.com/search?&gword=id=4008441||pattern=0||search=&ctt1="&ctt&">免费电影</A>   <A "&request("ctt2")&" href='?search="&Server.URLEncode(search)&"&want=video&engine=video.baidu.com/v?&gword=word=&ctt2="&ctt&"'>百度视频</A>     <A "&request("ctt4")&" href='?search="&Server.URLEncode(search)&"&want=video&engine=v.sogou.com/v?&gword=query=&ctt4="&ctt&"'>搜狗视频</A>  <A "&request("ctt6")&" href='?search="&Server.URLEncode(search)&"&want=video&engine=video.soso.com/q?&gword=sc=vid||w=&ctt6="&ctt&"'>搜搜视频</A>  <A "&request("ctt7")&" href='?search="&Server.URLEncode(search)&"&want=video&engine=search.you.video.sina.com.cn/s?&gword=key=&ctt7="&ctt&"'>爱问视频</A>  <A "&request("ctt8")&" href='?search="&Server.URLEncode(search)&"&want=video&engine=so.youku.com/search_video/q_&gword=&ctt8="&ctt&"'>优酷视频</A>  <A "&request("ctt9")&" href=?search="&Server.URLEncode(search)&"&want=video&engine=so.tudou.com/isearch.do?&gword=kw=&ctt9="&ctt&">土豆视频</A>  <A "&request("ctt10")&" href=?search="&Server.URLEncode(search)&"&want=video&engine=www.bokecc.com/search/s?&gword=wd=&ctt10="&ctt&">CC视频</A>"

else
if want="game" then
bttc5=bttc
if request("engine")="" then
engine="game.gougou.com/search?"
gword="search="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=game&engine=game.gougou.com/search?&gword=search=>gougou游戏</A>  <A href='?search="&Server.URLEncode(search)&"&want=game&engine=search.17173.com/down.jsp?&gword=keyword='>17173游戏</A>   <A href='?search="&Server.URLEncode(search)&"&want=game&engine=ks.pcgames.com.cn/games_index.jsp?&gword=q='>太平洋游戏</A>   <A href='?search="&Server.URLEncode(search)&"&want=game&engine=s.kuaiche.com/s/search?&gword=t=0||f=0||r=3||s=0||sid=636||q='>快车游戏</A> <A href='?search="&Server.URLEncode(search)&"&want=game&engine=so.ali213.net/?&gword=c=1||s='>游侠补丁</A> <A href='?search="&Server.URLEncode(search)&"&want=game&engine=www.g365.net/gameol/search.asp?&gword=keyword='>Flash游戏</A>  <A href='?search="&Server.URLEncode(search)&"&want=game&engine=so.gamezero.cn/gamesearch.php?&gword=keyword='>手机游戏</A>  "

else
if want="know" then
bttc6=bttc
if request("engine")="" then
engine="zhidao.baidu.com/q?"
gword="ct=17||pn=0||tn=ikunionaslist||rn=10||pt=123412_ik||ref=unionct=17||word="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=know&engine=zhidao.baidu.com/q?&gword=ct=17||pn=0||tn=ikunionaslist||rn=10||pt=123412_ik||ref=unionct=17||word=>百度</A>  <A href='?search="&Server.URLEncode(search)&"&want=know&engine=scholar.google.cn/scholar?&gword=hl=zh-CN||ie=GB2312||client=pub-1291838625141786||q='>google</A>   <A href='?search="&Server.URLEncode(search)&"&want=know&engine=www.qihoo.com/search.html?&gword=kw='>奇虎</A>   <A href='?search="&Server.URLEncode(search)&"&want=know&engine=iask.sina.com.cn/search_engine/search_knowledge_engine.php?&gword=key='>爱问</A>  <A href='?search="&Server.URLEncode(search)&"&want=know&engine=bk.baidu.com/list-php/dispose/searchword.php?&gword=pic=1||word='>百科</A>  <A href='?search="&Server.URLEncode(search)&"&want=know&engine=www.120so.com/search.php?&gword=key='>医疗</A>"

else
if want="software" then
bttc7=bttc
if request("engine")="" then
engine="soft.gougou.com/search?"
gword="id=4008441||restype=2||search="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=software&engine=soft.gougou.com/search?&gword=id=4008441||restype=2||search=>狗狗</A>  <A href='?search="&Server.URLEncode(search)&"&want=software&engine=search.newhua.com/search.asp?&gword=Keyword='>华军</A>   <A href='?search="&Server.URLEncode(search)&"&want=software&engine=www.skycn.com/search.php?&gword=sor=00||ss_name='>天空</A>   <A href='?search="&Server.URLEncode(search)&"&want=software&engine=www.duote.com/search.php?&gword=so='>多特</A>  <A href='?search="&Server.URLEncode(search)&"&want=software&engine=search.crsky.com/search.asp?&gword=sType=ResName||action=s||keyword='>霏凡</A>  <A href='?search="&Server.URLEncode(search)&"&want=software&engine=search1.fixdown.com/fixdown/query.asp?&gword=keyword='>全方位</A> <A href='?search="&Server.URLEncode(search)&"&want=software&engine=www.greendown.cn/search.asp?&gword=action=s||sType=ResName||keyword='>绿色软件下载</A>  <A href='?search="&Server.URLEncode(search)&"&want=software&engine=so.mydrivers.com/drivers.aspx?&gword=q='>驱动下载</A> "

else
if want="news" then
bttc8=bttc
if request("engine")="" then
engine="news.baidu.com/ns?"
gword="tn=1234110_pg||word="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=news&engine=news.baidu.com/ns?&gword=tn=1234110_pg||word=>百度</A>  <A href='?search="&Server.URLEncode(search)&"&want=news&engine=news.google.cn/news?&gword=hl=zh-CN||ie=GB2312||client=pub-1291838625141786||q='>google</A>      <A href='?search="&Server.URLEncode(search)&"&want=news&engine=news.sogou.com/news?&gword=pid=luojianhui110||searchtype=1||query='>搜狗</A>  <A href='?search="&Server.URLEncode(search)&"&want=news&engine=news.soso.com/n.q?&gword=w='>搜搜</A>  <A href='?search="&Server.URLEncode(search)&"&want=news&engine=so.news.qikoo.com/index.html?&gword=kw='>奇虎</A> <A href='?search="&Server.URLEncode(search)&"&want=news&engine=news.yodao.com/search?&gword=q='>有道</A>  <A href='?search="&Server.URLEncode(search)&"&want=news&engine=iask.com/n?&gword=k='>爱问</A> <A href='?search="&Server.URLEncode(search)&"&want=news&engine=z.zhongsou.com/n?&gword=w='>中搜</A>"

else
if want="dict" then
bttc14=bttc
if request("engine")="" then
engine="dict.yodao.com/search?"
gword="ue=gb2312||q="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=dict&engine=dict.yodao.com/search?&gword=ue=gb2312||q=>有道</A>  <A href='?search="&Server.URLEncode(search)&"&want=dict&engine=www.iciba.com/search?&gword=s='>词霸</A>   <A href='?search="&Server.URLEncode(search)&"&want=dict&engine=www.dict.cn/search/?&gword=q='>海词</A>  <A href=#>中文解释→</A> <A href='?search="&search&"&want=dict&engine=www.cshu.org/c/&gword='>C书</A>  <A href='?search="&Server.URLEncode(search)&"&want=dict&engine=xh.5156edu.com/index.php?&gword=f_key='>新华字典</A>  <A href='?search="&Server.URLEncode(search)&"&want=dict&engine=bk.baidu.com/list-php/dispose/searchword.php?&gword=pic=1||word='>百科词典</A> <A href='?search="&Server.URLEncode(search)&"&want=dict&engine=cy.5156edu.com/serach.php?&gword=f_type=chengyu||f_key='>成语</A>  <A href='?search="&Server.URLEncode(search)&"&want=dict&engine=www.ishici.com/search.asp?&gword=tt='>诗词</A> <A href=#>翻译→</A> <A href='?search="&Server.URLEncode(search)&"&want=dict&engine=fanyi.cn.yahoo.com/translate_txt?&gword=more=1||trtext='>多国语言翻译</A> "

else
if want="flash" then
bttc9=bttc
if request("engine")="" then
engine="mp3.baidu.com/m?"
gword="tn=1234110t_pg||lm=6||ct=134217728||word="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=flash&engine=mp3.baidu.com/m?&gword=tn=1234110t_pg||lm=6||ct=134217728||word=>百度</A>   <A href='?search="&Server.URLEncode(search)&"&want=flash&engine=music.soso.com/music.cgi?&gword=clz=swf||w='>搜搜</A>   <A href='?search="&Server.URLEncode(search)&"&want=flash&engine=so.mp3.qihoo.com/?&gword=type=4||kw='>奇虎</A>  <A href='?search="&Server.URLEncode(search)&"&want=flash&engine=mp3.zhongsou.com/m?&gword=ty=19||k=1234110||w='>中搜</A>  <A href='?search="&Server.URLEncode(search)&"&want=flash&engine=s.xiaoyouxi.com/?&gword=k='>Flash游戏</A> "


else
if want="bbs" then
bttc10=bttc
if request("engine")="" then
engine="bbs.soso.com/q?"
gword="sc=forum||w="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=bbs&engine=bbs.soso.com/q?&gword=sc=forum||w=>搜搜</A>   <A href='?search="&Server.URLEncode(search)&"&want=bbs&engine=bbs.zhongsou.com/b?&gword=k=1234110||w='>中搜</A>  <A href='?search="&Server.URLEncode(search)&"&want=bbs&engine=bbs.114.vnet.cn/search_bbs.html?&gword=kw='>114</A>  <A href='?search="&Server.URLEncode(search)&"&want=bbs&engine=tieba.baidu.com/f?&gword=kw='>百度贴吧</A> <A href='?search="&Server.URLEncode(search)&"&want=bbs&engine=post.soso.com/sobar.q?&gword=op=enterbar||bn='>SOSO搜吧</A> <A href='?search="&Server.URLEncode(search)&"&want=bbs&engine=bbs.sogou.com/searchIn.do?&gword=pid=1234110||query='>搜狗说吧</A> <A href='?search="&Server.URLEncode(search)&"&want=bbs&engine=b.zhongsou.com/l.dll?&gword=dorequest_z||pn=||id=||m=||s=||e=||p=||ts=||url=||default=||word='>中搜社区</A>"

else
if want="blog" then
bttc11=bttc
if request("engine")="" then
engine="blogsearch.baidu.com/s?"
gword="tn=1234110_pg||wd="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=blog&engine=blogsearch.baidu.com/s?&gword=tn=1234110_pg||wd=>百度</A>  <A href='?search="&Server.URLEncode(search)&"&want=blog&engine=blogsearch.google.cn/blogsearch?&gword=client=pub-1291838625141786||q='>google</A>   <A href='?search="&Server.URLEncode(search)&"&want=blog&engine=blogsearch.sogou.com/blog?&gword=pid=1234110||query='>搜狗</A>  <A href='?search="&Server.URLEncode(search)&"&want=blog&engine=so.blog.qikoo.com/index.html?&gword=kw='>奇虎</A>  <A href='?search="&Server.URLEncode(search)&"&want=blog&engine=blog.yodao.com/search?&gword=q='>有道</A> <A href='?search="&Server.URLEncode(search)&"&want=blog&engine=blog.iask.com/b?&gword=q='>爱问</A> <A href='?search="&Server.URLEncode(search)&"&want=blog&engine=www.souyo.com/blogs?&gword=q='>Souyo</A> <A href='?search="&Server.URLEncode(search)&"&want=blog&engine=qzone.soso.com/qz.q?&gword=w='>QQ空间</A>"

else
if want="novel" then
bttc12=bttc
if request("engine")="" then
engine="sosu.cmfu.com/Result.aspx?"
gword="k="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=novel&engine=sosu.cmfu.com/Result.aspx?&gword=k=>起点</A>     <A href='?search="&Server.URLEncode(search)&"&want=novel&engine=www.jjwxc.net/search.php?&gword=t=1||kw='>晋江</A>   <A href='?search="&Server.URLEncode(search)&"&want=novel&engine=www.hongxiu.com/novel/searchmore.asp?&gword=keyword='>红袖添香</A>  <A href='?search="&Server.URLEncode(search)&"&want=novel&engine=wind.yinsha.com/letters/search.php?&gword=type=title||title='>且听风吟</A>  <A href='?search="&Server.URLEncode(search)&"&want=novel&engine=www.d9cn.com/modules/article/search.php?&gword=searchkey='>第九中文网</A> <A href='?search="&Server.URLEncode(search)&"&want=novel&engine=oklink.net/deer/newpage.asp?&gword=from=1||choose=1||matching=2||search='>白鹿书院</A> <A href='?search="&Server.URLEncode(search)&"&want=novel&engine=club.book.sina.com.cn/booksearch/booksearch.php?&gword=c=112||col=%B6%C1%CA%E9||area=title||kw='>新浪小说</A> <A href='?search="&Server.URLEncode(search)&"&want=novel&engine=lz.book.sohu.com/slist.php?&gword=submit=%CB%D1%CB%F7||select=1||text='>搜狐小说</A>"

else
if want="book" then
bttc13=bttc
if request("engine")="" then
engine="book.baidu.com/s?"
gword="tn=baidubook||ct=2097152||si=book.baidu.com||cl=3||wd="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=book&engine=book.baidu.com/s?&gword=tn=baidubook||ct=2097152||si=book.baidu.com||cl=3||wd=>百度图书</A>     <A href='?search="&Server.URLEncode(search)&"&want=book&engine=books.google.cn/books?&gword=hl=zh-CN||ie=GB2312||client=pub-1291838625141786||q='>google图书</A>   <A href='?search="&Server.URLEncode(search)&"&want=book&engine=search.dangdang.com/search.aspx?&gword=key='>当当</A>  <A href='?search="&Server.URLEncode(search)&"&want=book&engine=www.amazon.cn/search/search.asp?&gword=source=||searchType=1||searchWord='>卓越</A>  <A href='?search="&Server.URLEncode(search)&"&want=book&engine=guoxue.baidu.com/s?&gword=tn=baiduguoxue||si=guoxue.baidu.com||ct=2097152||wd='>百度国学</A> <A href=>电子书→</A> <A href='?search="&Server.URLEncode(search)&"&want=book&engine=book.gougou.com/search?&gword=restype=3||id=08342||search='>狗狗</A> <A href='?search="&Server.URLEncode(search)&"&want=book&engine=club.book.sina.com.cn/booksearch/booksearch.php?&gword=c=112||col=%B6%C1%CA%E9||area=title||kw='>新浪小说</A> <A href='?search="&Server.URLEncode(search)&"&want=book&engine=lz.book.sohu.com/slist.php?&gword=submit=%CB%D1%CB%F7||select=1||text='>搜狐小说</A>"

else
if want="file" then
bttc15=bttc
if request("engine")="" then
engine="www.baidu.com/baidu?"
gword="tn=1234110_pg||ft=all||q1="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=file&engine=www.baidu.com/baidu?&gword=tn=1234110_pg||ft=all||q1=>百度</A>   <A href='?search="&Server.URLEncode(search)&"&want=file&engine=www.sogou.com/web?&gword=pid=1234110||query=filetype%3Aall+'>搜狗</A>  <A href='?search="&Server.URLEncode(search)&"&want=file&engine=ishare.iask.sina.com.cn/search.php?&gword=key='>爱问</A> "

else
if want="map" then
bttc16=bttc
if request("engine")="" then
engine="ditu.google.com/local?"
gword="hl=zh-CN||ie=GB2312||client=pub-1291838625141786||q="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=map&engine=ditu.google.com/local?&gword=hl=zh-CN||ie=GB2312||client=pub-1291838625141786||q=>google</A>     <A href='?search="&Server.URLEncode(search)&"&want=map&engine=www.51ditu.com/maps?&gword=wd='>我要地图</A>  "

else
if want="shop" then
bttc17=bttc
if request("engine")="" then
engine="list.taobao.com/browse/search_auction.htm?"
gword="q="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=shop&engine=list.taobao.com/browse/search_auction.htm?&gword=q=>淘宝</A>     <A href='?search="&Server.URLEncode(search)&"&want=shop&engine=www.eachnet.com/?adid=bjmt_mta_01_0_hp_53220&gword=satitle='>易趣</A> <A href=?search="&Server.URLEncode(search)&"&want=shop&engine=search.dangdang.com/search.aspx?&gword=key=>当当</A> <A href=?search="&Server.URLEncode(search)&"&want=shop&engine=www.amazon.cn/search/search.asp?&gword=source=||searchWord=>卓越</A> <A href=?search="&Server.URLEncode(search)&"&want=shop&engine=www.chinaec.com/SearchEngine/?&gword=key=>中商</A>  "

else
if want="busi" then
bttc18=bttc
if request("engine")="" then
engine="search.china.alibaba.com/search/offer_search.htm?"
gword="do=true||doSearchNews=true||catcount=10||keywords="
end if
websou="<A href=?search="&Server.URLEncode(search)&"&want=busi&engine=search.china.alibaba.com/search/offer_search.htm?&gword=do=true||doSearchNews=true||catcount=10||keywords=>阿里巴巴</A>     <A href='?search="&Server.URLEncode(search)&"&want=busi&engine=www.search.hc360.com/cgi-bin/ls?&gword=w='>聪慧网</A> <A href=?search="&Server.URLEncode(search)&"&want=busi&engine=search.china.alibaba.com/search/company_search.htm?&gword=keywords=>公司库</A> <A href=?search="&Server.URLEncode(search)&"&want=busi&engine=search.china.alibaba.com/search/offer_search.htm?&gword=keywords=>供应信息</A> <A href=?search="&Server.URLEncode(search)&"&want=busi&engine=search.china.alibaba.com/search/search.htm?&gword=keywords=>求购信息</A>  <A href=?search="&Server.URLEncode(search)&"&want=busi&engine=info.china.alibaba.com/news/search?&gword=do=1||keywords=>商业资讯</A> <A href=?search="&Server.URLEncode(search)&"&want=busi&engine=yp.baidu.com/m?&gword=tn=1234110_pg||ct=553648128||lm=-1||z=-1||word=>百度黄页</A>"


end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
end if
%>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link href="search_blue.css" rel="stylesheet" type="text/css">
<%
Agent = Request.ServerVariables("HTTP_USER_AGENT")
Agent = Split(Agent,";")
If InStr(Agent(1),"MSIE") > 0 Then
Response.Write "<script type='text/JavaScript'>var location='';</script>"
end if
%>
<title><%=search%></title>
<SCRIPT language=JavaScript>
{
window.status="<%=search%>";
}
</script>

</head>
<body leftMargin=0 topMargin=0 rightMargin=0 bottomMargin=0 style="overflow-x:hidden;overflow-y:hidden" onmouseover="self.status='<%=search%>';return true"><div>
<DIV class=wrapper>
<DIV class=header>
<DIV class=innerHeader id=header>
<DIV class=title><IMG  src="images/logo_glass.gif" /></DIV>
<DIV class=title-ad></DIV>
<DIV class=search>
<DIV class=categories>
<SPAN id=categories>


<A <%=bttc1%> href="?search=<%=search%>">网页</A>
<A <%=bttc2%> href="?search=<%=Server.URLEncode(search)%>&want=photo">图片</A>
<A <%=bttc3%> href="?search=<%=Server.URLEncode(search)%>&want=music">音乐</A>
<A <%=bttc4%> href="?search=<%=Server.URLEncode(search)%>&want=video">影视</A>
<A <%=bttc5%> href="?search=<%=Server.URLEncode(search)%>&want=game">游戏</A>
<A <%=bttc6%> href="?search=<%=Server.URLEncode(search)%>&want=know">知识</A>
<A <%=bttc7%> href="?search=<%=Server.URLEncode(search)%>&want=soft">软件</A>
<A <%=bttc8%> href="?search=<%=Server.URLEncode(search)%>&want=news">新闻</A>
<A <%=bttc9%> href="?search=<%=Server.URLEncode(search)%>&want=flash">Flash</A>
<A <%=bttc10%> href="?search=<%=Server.URLEncode(search)%>&want=bbs">论坛</A>
<A <%=bttc11%> href="?search=<%=Server.URLEncode(search)%>&want=blog">博客</A>
<A <%=bttc12%> href="?search=<%=Server.URLEncode(search)%>&want=novel">小说</A>
<A <%=bttc13%> href="?search=<%=Server.URLEncode(search)%>&want=book">图书</A>
<A <%=bttc14%> href="?search=<%=Server.URLEncode(search)%>&want=dict">字典</A>
<A <%=bttc15%> href="?search=<%=Server.URLEncode(search)%>&want=file">文档</A>
<A <%=bttc16%> href="?search=<%=Server.URLEncode(search)%>&want=map">地图</A>
<A <%=bttc17%> href="?search=<%=Server.URLEncode(search)%>&want=shop">购物</A>
<A <%=bttc18%> href="?search=<%=Server.URLEncode(search)%>&want=busi">商业</A>

</SPAN>
</DIV>

<%

if Request("ccttaa3") <>"" then
ccttaa2="=class%3Dbuttons-active"

else
ccttaa2="=class=buttons-active"
end if
tcbc1=Request.ServerVariables("QUERY_STRING")
if instr(tcbc1,ccttaa2) > 0 then
tcbc2=split(trim(tcbc1),ccttaa2)
if instr(right(tcbc2(0),4),"ctt") > 0 then
tcbc3=right(tcbc2(0),4)
else
tcbc3=right(tcbc2(0),5)
end if
end if


%>

<DIV><form action="?" method="get" name="search"><INPUT class="text searchBox" name="search" type="text" value="<%=search%>" onmouseover="this.focus();this.className='texthover searchBox'" onMouseOut="this.className='text searchBox'" onblur="if (value ==''){value='<%=search%>'}" onfocus="this.select()"><INPUT type=hidden name=want value=<%=want%>><INPUT type=hidden name=engine value="<%=request("engine")%>"><INPUT type=hidden name=gword value="<%=request("gword")%>"> <INPUT type=hidden name=<%=tcbc3%> value="class=buttons-active"><INPUT type=hidden name=ccttaa3 value="class=buttons-active"><input type="submit" value="" class="searchBtn" onMouseOut="this.className='searchBtn'" onMouseOver="this.className='searchBtn_hover'"
>&nbsp;&nbsp;<SPAN style="DISPLAY: inline"></SPAN></DIV>
</DIV>
</DIV>
</DIV>
<DIV class=navPanel>
<DIV class=innerNavPanel>
<DIV class=buttons>


<%=websou%>

</DIV>
</DIV>
</DIV>
</DIV>
</DIV>
<%


gword = Replace(gword,"||","&")
%>
<iframe name=ifrm id=ifrm src="http://<%=engine%><%=gword%><%=search%>" frameSpacing=100 frameborder="NO" style="overflow-x:hidden" scrolling="yes" width=100% height=83% noresize></iframe>
<script type="text/javascript" src="http://js.tongji.cn.yahoo.com/728336/ystat.js"></script>
</body>
</html>