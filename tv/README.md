## rpvideo
### 版本
v1.5  说明：http://v.rpsofts.com/app/doc/rpv.html
### 简介
http://v.rpsofts.com   /源码。。。。

![网站截图](http://ww3.sinaimg.cn/large/6ff5e63ajw1f47izvip94j211t0hxwhb.jpg)

支持youku，音乐台等国内一大批网站 不一一列举了。

### 单视频演示：
例如：http://v.rpsofts.com/v.php?url=http://v.youku.com/v_show/id_XMTI4NTY3MTY1Mg==.html

![](http://ww1.sinaimg.cn/large/6ff5e63ajw1f47j0hozdvj20z10hxwhx.jpg)

### 部署要求：
php解析国内视频站点解析源码。。。普通php空间即可运行，，无额外要求。。。  
### 皮肤说明：
播放器使用ckplayer，，皮肤是以前仿芒果台做的，，此外如需更换播放器logo，，及版权显示的话，，，请player\style.swf及播放器js文件
。。

## 站外调用：
  
	<iframe src="http://v.rpsofts.com/vip/v.php?url=你要调用的视频地址" frameborder="0" autoplay="1" scrolling="1" width="100%" height="100%" allowtransparency></iframe>

或者http://v.rpsofts.com/i.php?url=http://v.youku.com/v_show/id_XMTQyMTQ1ODE4NA==.html

## 版权：
你有权利使用、复制、修改、合并、出版发行、散布、再授权及贩售软件及软件的副本。
当然如果你使用时可以加上我们的源地址或者我的博客地址链接最好。不过既然开源发出了，就是为了更多人能方便使用，你加不加随便了。
## 后续计划：
v1.5 增加m3u8直播播放，，例如 CCTV5+ 演示 http://v.rpsofts.com/api/tv.php?url=http://cctv5plus.vtime.cntv.cloudcdn.net:8500/cache/257_/seg0/index.m3u8

战旗tv解析：(已经支持全部战旗tv解析（任意房间），，手机版采用m3u8，后续同斗鱼tv解析一起发布，你可以一键整合到你的app或者网站之中，让你的网站支持在线直播)

下一步会增加 国内主流网盘解析，，，  
例如：乐视云盘 ，，http://v.rpsofts.com/api/le.php?url=49788354   360，天翼等。
