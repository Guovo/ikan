<div id="header">
  <div class="header-inner">
        <div class="logo">
            <a href="/" title="返回导航首页" target="_self"></a>
    </div>
    <div id="Tianqi">
</iframe>
    </div>
    
    <a class="header-ad" href="http://www.ai888.cn/"><img src="/Skins/mb/img/ad01.png"></a>
  </div> 
</div>

<div id="main-container">

<!--搜索代码-->
<script>
var PAGE_START_TIME = (new Date).getTime(),
WEBINDEXCK = "360WEBINDEXCK",
DEBUG = 0;
var THEME_CONF = {
    TAGKEYS: ["zuire", "zuixin", "star", "katongdongman"],
    RECENT: [],
    DEFAULT: {
        key: "default",
        snapshot: "213fce68"
    },
    DSTVER: "407"
},
API_VERSION = {
    "hotword": "1.0",
    "channeltop": "1.3",
    "channelOrder": "8",
    "channelView": "2.5",
    "guessdata": "5",
    "theme": "1.0",
    "locallist": "1.1",
    "localdata": "1.4",
    "activityView": "1.0",
    "dropdownhotsale": "1.0",
    "tonglandata": "1.1"
},
API_SNAPSHOTNUM = {
    "hotword": "6b1e06c4555281c7877f11f8b1fa2823",
    "channeltop": "cfffa4a59b6f7bfced9f56c992a07a2a",
    "dropdownhotsale": "427fc2f18cfb5d161e5420fa50669091",
    "tonglandata": "227ec849f11207d9d95bcb7a07a662be",
    "channelOrder": "bfd68f8f2f1e8f2488a4f53c049a5f8c"
};
var HAO_CONFIG = {
    version: 2.0,
    feedsConfig: {
        "hotword": {
            host: 'http://hao.h.qhimg.com/api.php',
            api: 'hotword',
            v: API_VERSION.hotword || "1.0",
            r: API_SNAPSHOTNUM.hotword || "",
            quietUpdateTime: 1800000,
            expires: 7200000
        },
        "channeltop": {
            host: 'http://hao.h.qhimg.com/api.php',
            api: 'channeltop',
            v: API_VERSION.channeltop || "1.0",
            r: API_SNAPSHOTNUM.channeltop || "",
            threshold: 300000,
            expires: 1800000
        },
        "dropdownhotsale": {
            host: 'http://hao.h.qhimg.com/api.php',
            api: 'dropdownhotsale',
            v: API_VERSION.dropdownhotsale || "1.0",
            r: API_SNAPSHOTNUM.dropdownhotsale || "",
            threshold: 300000,
            expires: 1800000
        },
        "tonglandata": {
            host: 'http://hao.h.qhimg.com/api.php',
            api: 'tonglandata',
            v: API_VERSION.tonglandata || "1.0",
            r: API_SNAPSHOTNUM.tonglandata || "",
            threshold: 300000,
            expires: 1800000
        }
    },
    themeConfig: {
        host: 'http://theme.h.qhimg.com/',
        cdn_host: 'http://cdn.theme.h.qhimg.com/',
        api: 'theme',
        v: API_VERSION.theme,
        threshold: 86400000
    },
    channelOrder: {
        host: 'http://tuijian.h.qhimg.com/index.php',
        api: 'channelOrder',
        v: API_VERSION.channelOrder || "",
        r: API_SNAPSHOTNUM.channelOrder || "entsportstech",
        expires: 3600000
    },
    pushServer: {
        host: 'http://tui.h.qhimg.com/msg/v1/all/{0}/{1}'
    },
    userChannel: {
        api: 'userChannel',
        v: "1",
        r: "apollo"
    },
    channelView: {
        host: 'http://hao.h.qhimg.com/channelview.php',
        d_host: 'http://d.hao.h.qhimg.com/channelview.php',
        v: API_VERSION.channelView
    },
    iguess: {
        host: 'http://guess.h.qhimg.com/index.php',
        v: API_VERSION.guessdata
    },
    mysite: {
        host: "http://hao.h.qhimg.com/sitelist.php",
        api: 'mysite',
        v: '1.0',
        r: '1'
    },
    mysiteTweet: {
        host: 'http://navsite.tf.360.cn/siteRec',
        api: 'tweetsite',
        v: '1.0',
        r: 'tweet123'
    },
    weather: {
        host: 'http://weather.hao.360.cn/',
        cnd_host: 'http://cdn.weather.hao.360.cn/',
        weather: {
            path: 'sed_api_weather_info.php',
            api: 'weather',
            v: '2',
            r: 'so',
            quietUpdateTime: 7200000,
            expires: 14400000
        },
        area: {
            path: 'sed_api_area_query.php',
            api: 'area',
            v: '1.1',
            r: 'www'
        }
    },
    pm25: {
        host: 'http://cdn.weather.hao.360.cn/sed_api_weather_info.php',
        api: 'pm25',
        v: '1',
        r: 'pm25_1',
        quietUpdateTime: 7200000,
        expires: 14400000
    },
    widget: {
        host: 'http://hao.h.qhimg.com/widget.php',
        threshold: 50000,
        v: 1
    },
    search: {
        api: 'search',
        v: '1',
        r: 'aaa'
    },
    loulouView: {
        host: 'http://hao.h.qhimg.com/loulouview.php',
        v: '1'
    },
    loulouAD: {
        host: 'http://guess.h.qhimg.com/index.php',
        v: '1'
    }
};
</script>
<script type="text/javascript" src="/Skins/mb/search/js/so01.js"></script>
<style type="text/css">
fieldset, img {border: none}
.g-toggle {	overflow: hidden;position: absolute;cursor: pointer;background-image: url(/Skins/mb/search/images/soico.png);background-repeat: no-repeat;}
#search{position:relative;height:90px;clear:both}
#search .search-hd{z-index:2;position:relative;padding:20px 0 0 0;margin-left:143px;width:550px;height:24px}
#search .tab li{float:left;position:relative;margin-right:6px; width:40px;height:25px;line-height:25px;font-size:14px;text-align:center;cursor:pointer;border-radius:3px;background-color:#e8e8e8;}
#search .tab li.hover a{
	color: #069;
}
#search .tab li.on{
	height: 29px;
	cursor: default;
	background-image: url(/Skins/mb/search/images/nobg.png);
	background-repeat: no-repeat;
	color: #FFF;
	background-color: transparent;
}
#search .tab li.on a{text-decoration:none;cursor:default;color:#FFF;cursor: pointer;}
#search .tab li.on a.link:hover{
	cursor: pointer;
}
.ie6 #search .tab li .radius1,.ie7 #search .tab li .radius1,.ie8 #search .tab li .radius1{display:none}
.ie6 #search .tab li.on .radius1,.ie7 #search .tab li.on .radius1,.ie8 #search .tab li.on .radius1{display:block}
#search .search-bd{z-index:1;position:relative;height:40px}
#search .form-group{position:relative;margin-top:5px;height:42px}
#search .form-group legend{display:none}
#search .widget-group{display:none;position:relative;height:42px; margin-top:10px; font-size:12px}
.search-bg{position:absolute;top:0;left:0;display:block;width:1000px;height:88px}
#search .form-group .shadowtop{z-index:1;overflow:hidden;position:absolute;top:0;left:1px;width:99.8%;height:0;border-top:1px solid #dedede;border-bottom:1px solid #f4f4f4}
#search .form-group .shadowleft{overflow:hidden;position:absolute;top:0;left:0;width:0;height:39px;border-left:1px solid #dedede;border-right:1px solid #f4f4f4}
#search-input{display:inline;float:left;margin-left:8px;position:relative;width:504px;height:35px;border-width:1px;border-style:solid;border-color:#09C;background:#fff;-moz-box-shadow:inset 1px 1px 1px #dedede;-webkit-box-shadow:inset 1px 1px 1px #dedede;box-shadow:inset 1px 1px 1px #dedede}
#search-input input{margin-top:6px;padding:0 6px;width:458px;height:22px;line-height:22px;font-size:16px;border:0;background:none;outline:0;-webkit-appearance:none}
.ie6 #search-input input{margin-top:8px}
#search-btn{
	overflow: hidden;
	float: left;
	width: 100px;
	height: 37px;
	font-size: 14px;
	border: 0;
	cursor: pointer;
	background-color: #09C;
	color: #FFF;
	background-image: url(/Skins/mb/search/images/so.png);
	background-repeat: no-repeat;
	text-indent: 20px;
	font-weight: bold;
}
#search-btn.mousedown{background-position:0 -82px}
#search-engine{position:relative;top:4px;float:left;margin:0 5px 1px 30px;width:100px;height:30px;}
#search-engine #eng-logo{overflow:hidden;position:absolute;top:-5px;left:-4px;width:95px;height:35px;text-indent:-1000px;outline:0;background-repeat:no-repeat}
#search-engine .eng-list{display:none;position:absolute;top:33px;left:0;width:97px;border:1px solid #d2d2d2;border-bottom:none;background:#fff; z-index:9999;}
#search-engine .eng-list a{display:block;overflow:hidden;width:97px;height:35px;text-indent:-1000px;border-bottom:1px solid #cecece;background-repeat:no-repeat}
#search-engine .eng-list a:hover{background-color:#f6f6f6}
#search-engine .g-toggle{top:6px;right:-7px;width:13px;height:19px;background-position:0 -22px}
#search-engine.open .g-toggle{background-position:0 -43px}
#search-engine.open .eng-list{display:block}
#search-engine.single .eng-list{display:none}
#search-engine.single .g-toggle{display:none}

#search-engine #eng-logo,#search-engine .eng-list a{background-image:url(/Skins/mb/search/images/urllogo.png)}
.ie6 #search-engine #eng-logo,.ie6 #search-engine .eng-list a{background-image:url(/Skins/mb/search/images/urllogo.png)}
#daily-hotword{z-index:1;overflow:hidden;position:absolute;top:12px;right:0;width:130px;height:20px}
#search-hotword.attention{background-position:4px -373px}
#search-hotword.open{background-position:11px -40px}
#search-hotword{top:6px;right:2px;width:30px;height:26px;background-position:11px -19px}
.somulti{background-position:5px -510px}
#eng-logo.so360{background-position:1px -657px}
#eng-logo.qihoo{background-position:-2px -116px}
#eng-logo.sonews{background-position:-2px -839px}
.so360{background-position:4px -658px}
.bing{background-position:4px -560px}
.google{background-position:4px -160px}
.youdao{background-position:5px -33px}
.baidu{background-position:4px 1px}
.sonews{background-position:-1px -842px}
.souku{background-position:3px -308px}
.sogou{background-position:-1px -753px}
.weibo{background-position:4px -463px}
.gaode{background-position:0 -612px}
.qihoo{background-position:-2px -118px}
.taobao{background-position:0 -75px}
.buy360{background-position:2px -264px}
.amazon{background-position:0 -211px}
.vancl{background-position:4px -356px}
.dangdang{background-position:11px -800px}
.yihaodian{background-position:4px -708px}
#search .tabs li{line-height:22px \9}
.ie6 #search .form-group .g-input-text input .ie7 #search .form-group .g-input-text input{margin-top:3px}
.ie6 #search .search-bg,.ie7 #search .search-bg,.ie8 #search .search-bg{display:block}
#search-frame{height:110px}
.search-bg{height:108px}
.theme-search-bg{
	background-color: #fff;
    -moz-box-shadow: 0px 3px 4px #ddd;
    -webkit-box-shadow: 0px 3px 4px #ddd;
    box-shadow: 0px 3px 4px #ddd;
    /* For IE 8 */
    -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=180, Color='#dddddd')";
    /* For IE 5.5 - 7 */
    filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=180, Color='#dddddd');
		filter:alpha(opacity=50);
	-moz-opacity:0.5;
	-khtml-opacity: 0.5;
	opacity: 0.5;

		}
.theme-search-tab a{color:#323232}
.theme-search-tab .hover a{color:#fff}
.theme-search-tab .hover{background:#91CE79;}
.ie6 .theme-search-tab .hover,.ie7 .theme-search-tab .hover,.ie8 .theme-search-tab .hover{background-color:#91CE79}
.theme-search-tab .on a{color:#fff}
.theme-search-tab .on{background:#3EAF0E}
.ie6 .theme-search-tab .on,.ie7 .theme-search-tab .on,.ie8 .theme-search-tab .on{background-color:#3EAF0E}
.theme-search-tab .radius1{background-color:#fff}
</style>
<div id="doc-main">
<div id="search-frame">
<div id="search">
<div class="search-hd">
<ul class="tab gclearfix theme-search-tab">
<li data-cate="webpage" class="on"> <a href="" onClick="return false;">网页</a></li>
<li data-cate="news"> <a href="http://sh.qihoo.com/" class="link">新闻</a></li>
<li data-cate="video"> <a href="http://video.haosou.com/" class="link">视频</a></li>
<li data-cate="image"> <a href="http://image.haosou.com/?&src=hao_360so_tu" class="link">图片</a></li>
<li data-cate="music"> <a href="http://music.haosou.com/" class="link">音乐</a></li>
<li data-cate="map"> <a href="http://map.haosou.com/?ie=utf-8&src=hao_360so_d&t=map&k=" class="link">地图</a></li>
<li data-cate="wenda"> <a href="http://wenda.haosou.com/" class="link">问答</a></li>
<li data-cate="shopping"> <a href="http://gouwu.360.cn/" class="link">购物</a></li>
<li data-widget="flytrip"> <a href="http://go.360.cn/flight?src=homesearch" class="link">机票</a></li>
<li data-widget="car"> <a href="http://car.bitauto.com/?WT.mc_id=360ss" class="link">汽车</a></li>
</ul>
</div>
<div class="search-bd">
<div class="form-group">
<form id="search-form" target="_blank" action="http://www.baidu.com/s">
<div class="others-params webpage-somulti types-webpage" style="display:none">
<input type="hidden" name="ie" value="utf-8">
<input type="hidden" name="src" value="hao_search">
<input type="hidden" name="shb" value="1">
</div>
<fieldset>
<legend>百度搜索</legend>
<div id="search-engine">
<div class="eng-list"><a class="baidu" title="百度搜索" data-site="somulti" data-cate="webpage">baidu</a><a class="so360" title="好搜，不做坏事" data-site="so360" data-cate="webpage">so360</a><a class="bing" title="必应" data-site="bing" data-cate="webpage">bing</a><a class="google" title="谷歌" data-site="google" data-cate="webpage">google</a><a class="youdao" title="有道" data-site="youdao" data-cate="webpage">youdao</a><a class="baidu" title="百度" data-site="baidu" data-cate="webpage">baidu</a></div>
<a id="eng-logo" class="baidu" title="综合搜索" hidefocus="true" href="http://www.haosou.com/?src=zh"></a>
<div class="g-toggle"></div>
</div>

<div id="search-input"> 
<input type="text" name="q" autocomplete="off" id="search-kw" qsuginited="1">
</div>
<button id="search-btn" type="submit">好搜一下</button>
</fieldset>
</form>
</div>
<script type="text/javascript">
var SRC_HAO_SEARCH = "hao_search";
if (hao360.channel != "") {
    SRC_HAO_SEARCH += "_" + hao360.channel;
    setTimeout(function() {
        document.getElementById("search-form")["src"].value = SRC_HAO_SEARCH;
    },
    0);
}
var HAO_DATA = {
    searchTabData: {
        defaultByCate: {
            news: "baidu",
            webpage: "baidu",
            weibo: "weibo",
            music: "baidu",
            video: "baidu",
            image: "baidu",
            wenda: "baidu",
            map: "baidu",
            shopping: "taobao"
        },
        searchEngConf: {
            "webpage": {
                baidu: ["http://www.baidu.com/s", "wd", "\u767e\u5ea6", "http://www.baidu.com/", "ie:GB2312"],
                somulti: ["http://www.haosou.com/s", "q", "\u7efc\u5408\u641c\u7d22", "http://www.haosou.com/?src=zh", "ie:utf-8;src:" + SRC_HAO_SEARCH + ";shb:1", "好搜一下"],
                youdao: ["http://www.youdao.com/search", "q", "\u6709\u9053", "http://www.youdao.com/?keyfrom=360dh_01", "keyfrom:360dh_01;ue:GB2312;vendor:360dh_01"],
                google: ["http://www.google.com.hk/search", "q", "\u8c37\u6b4c", "http://www.google.com.hk/webhp?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN;ie:utf-8;newwindow:1"]
            },
            "music": {
                baidu: ["http://mp3.baidu.com/m", "word", "\u767e\u5ea6", "http://mp3.baidu.com/", "f:ms;ct:134217728;ie:utf-8"],
                so360: ["http://s.music.haosou.com/s", "q", "好搜音乐", "http://music.haosou.com/", "ie:utf-8;src:hao_360so", "好搜音乐"],
                sogou: ["http://mp3.sogou.com/music", "query", "\u641c\u72d7", "http://mp3.sogou.com/", "ie:GB2312"]
            },
            "video": {
                baidu: ["http://video.baidu.com/v", "word", "\u767e\u5ea6", "http://video.baidu.com/", "ie:utf-8"],
                google: ["http://www.google.com.hk/search", "q", "\u8c37\u6b4c", "http://www.google.com.hk/search", "tbo:p;tbm:vid;source:vgc;tbs:vid;client:aff-360daohang;hl:zh-CN;ie:utf-8"]
            },
            "image": {
                baidu: ["http://image.baidu.com/i", "word", "\u767e\u5ea6", "http://image.baidu.com/", "ie:utf-8;tn:baiduimage"],
                so360: ["http://image.haosou.com/i", "q", "好搜图片", "http://image.haosou.com/?src=hao_360so", "ie:utf-8;src:hao_360so", "好搜图片"],
                youdao: ["http://image.youdao.com/search?keyfrom=360dh_01", "q", "\u6709\u9053", "http://image.youdao.com/search", "keyfrom:360dh_01;ue:GB2312"],
                google: ["http://images.google.com.hk/images", "q", "\u8c37\u6b4c", "http://images.google.com.hk/imghp?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN;ie:utf-8"]
            },
            "weibo": {
                weibo: ["http://s.weibo.com/weibo/", "", "微博", "http://s.weibo.com/", "ie:utf-8;refer:360"]
            },
            "news": {
                baidu: ["http://news.baidu.com/ns", "word", "\u767e\u5ea6", "http://news.baidu.com/", "ie:GB2312"],
                sonews: ["http://news.haosou.com/ns", "q", "360新闻搜索", "http://news.haosou.com/", "ie:utf-8;tn:news;src:" + SRC_HAO_SEARCH, "360新闻"],
                youdao: ["http://news.youdao.com/search?keyfrom=360dh_01", "q", "\u6709\u9053", "http://news.youdao.com/search", "ue:GB2312;keyfrom:360dh_01"],
                google: ["http://news.google.com.hk/news/search", "q", "\u8c37\u6b4c", "http://news.google.com.hk/?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN;ie:utf-8"]
            },
            "map": {
                baidu: ["http://map.baidu.com/m", "word", "\u767e\u5ea6", "http://map.baidu.com/", "ie:utf-8"],
                so360: ["http://map.haosou.com/", "", "好搜地图", "http://map.haosou.com/?src=hao_tablogo", "ie:utf-8;src:hao_360so;t:map", "好搜地图"],
                gaode: ["http://www.amap.com", "k", "高德", "http://www.amap.com", "t:map"]
            },
            "wenda": {
                baidu: ["http://zhidao.baidu.com/q", "word", "\u767e\u5ea6", "http://zhidao.baidu.com", "ct:17;pt:360se_ik;tn:ikaslist;ie:GB2312;"]
            },
            "shopping": {
                taobao: ["http://s8.taobao.com/search", "q", "\u6dd8\u5b9d", "http://www.taobao.com/?pid=mm_15144495_2216478_8873469", "unid:;pid:mm_15144495_2216478_8873469;search_type:auction;commend:all;at_topsearch:1;user_action:initiative;spercent:0;f:D9_5_1;ie:utf-8"],
                buy360: ['http://open.union.360.cn/go', 'k', "京东", "http://open.union.360.cn/go?bid=2000801&qihoo_id=36100&fname=hao_search_logo", "bid:2000801;qihoo_id:36100;flag:hao_cps;fname:hao_search"],
                amazon: ["http://open.union.360.cn/go", "k", "\u4E9A\u9A6C\u900A", "http://open.union.360.cn/go?bid=2000292&qihoo_id=36100&fname=hao_search_logo", "bid:2000292;qihoo_id:36100;flag:hao_cps;fname:hao_search"],
                dangdang: ["http://open.union.360.cn/go", "k", "当当", "http://open.union.360.cn/go?bid=2000319&qihoo_id=36100&fname=hao_search_logo", "bid:2000319;qihoo_id:36100;flag:hao_cps;fname:hao_search"],
                yihaodian: ["http://open.union.360.cn/go", "", "一号店", "http://open.union.360.cn/go?bid=2000519&qihoo_id=36100&fname=hao_search_logo", "bid:2000519;qihoo_id:36100;flag:hao_cps;fname:hao_search"]
            }
        }
    }
};
</script> 
<div id="widget-flytrip" class="widget-group"></div>
<div id="widget-car" class="widget-group"></div>
</div>
<div class="search-bg theme-search-bg"></div>
</div>
</div>
</div>
<script type="text/javascript" src="/Skins/mb/search/js/so02.js"></script>
<script type="text/javascript" src="/Skins/mb/search/js/so03.js"></script> 
<script type="text/javascript" src="/Skins/mb/search/js/so04.js"></script> 
<script type="text/javascript" src="/Skins/mb/search/js/so05.js"></script> 
<!--搜索代码结束-->
</div>