<?php
/**
 *	[KW.G] (C)2014-2112 kw.G Sdo.
 *	This is NOT a freeware, use is subject to license terms
 *
 *	[Important{2*}] To Control The CKPLAYER SETTING.
 */

$_plsyer = array();

// ---------------------------------  CONFIG Player  -------------------------------- //
// *** HDS 清晰度相关项。 ***//

// 是否打开 HDS(清晰度) 输出的功能，暂时只支援ckplayer6.3下有使用清晰度切换插件的用家 [0=关 , 1=开]
$_player['ckplayer'][0]['Plugins']['hds']['IO']					= '1';

// 1.冰冷聚星 (http://www.ckplayer.com/bbs/forum.php?mod=viewthread&tid=2486) 支持ckplayer6.3使用
// 2.niandeng (http://www.ckplayer.com/bbs/forum.php?mod=viewthread&tid=10067) 支持ckplayer6.4-6.5使用
$_player['ckplayer'][0]['Plugins']['hds']['Developer']			= '2';

// 当使用 niandeng 的清晰度相关东西时 必须先定义下列名称项目 (BASE64_ENCODE) 由低至高对应的名称
$_player['ckplayer'][0]['Plugins']['hds']['name'][0] 			= '5qCH5riF';
$_player['ckplayer'][0]['Plugins']['hds']['name'][1] 			= '6auY5riF';
$_player['ckplayer'][0]['Plugins']['hds']['name'][2] 			= '6LaF5riF';
$_player['ckplayer'][0]['Plugins']['hds']['name'][3] 			= 'MTA4MFA=';

// 自定义默认清晰度可选值暂时提供[0,1,2]三种
$_player['ckplayer'][0]['Plugins']['hds']['Default_FLASH']		= '1';
$_player['ckplayer'][0]['Plugins']['hds']['Default_HTML5']		= '0';

// *** ADS 播放器广告相关项。 ***//

// 暂停时播放的广告，swf/图片,多个用竖线(|)隔开，没有的时候留空就行。如：http://xxx.com/xx.swf 或 http://xxx.com/xx.jpg 需留意图片大小
$_player['ckplayer'][0]['PauseAD_SRC']			= '';
// 如上方 PauseAD_SRC 是图片可以加入链接地址，没有的时候留空就行。 如：http://xxx.com/
$_player['ckplayer'][0]['PauseAD_IMGURL']		= '';

// 缓冲广告地址，只能是一个swf文件。
$_player['ckplayer'][0]['BufferAD']				= '';

// *** Function 播放器设定相关项。 ***//

// 默认音量，0-100之间 
// 如果不设定就 = null;
$_player['ckplayer'][0]['Volume']				= '80';

// 播放http视频流时采用何种拖动方法，(0=>不使用任意拖动,1=>按关键帧进行拖动,2=>是按关键时间点进行拖动,3=>是自动判断(如果视频格式是.mp4就按关键时间点，.flv就按关键帧),4=>是自动判断(只要包含字符mp4就按关键时间点，只要包含字符flv就按关键帧)) 
// 如果不设定就 = null;
$_player['ckplayer'][0]['DragMethod']			= '3'; 

// 视频结束后的动作 (0=>调用js函数function playerstop(),1=>循环播放,2=>暂停播放并且不调用暂停广告,3=>调用视频推荐列表的插件,4=>是清除视频流并调用js、功能和0差不多,5=>暂停并且同时调用暂停广告,6=>调用js函数（参考=0时），并且会退出全屏)
// 如果不设定就 = null;
$_player['ckplayer'][0]['EndAction']			= '0'; 

// 视频默认播放/暂停/不加载 (0=>暂停,1=>自动播放,2=>默认不加载视频，点击时才加载视频)
// 如果不设定就 = null;
$_player['ckplayer'][0]['DefaultAction']		= '1';
// 初始图片地址，就是在播放器默认是暂停(DefaultAction = 0)或默认不加载(DefaultAction = 2)的情况下先给一张图片遮在播放器前面，让其看起来不会一片黑。 如：http://xxx.com/xx.jpg
$_player['ckplayer'][0]['DefaultAction_MASK']	= '';

// 视频直接g秒开始播放，这个功能类似跳过片头的功能。
// 如果不设定就 = null;
$_player['ckplayer'][0]['StartSeconds']			= null;
// 视频提前j秒结束，跳过片尾的功能 (>0时，视频大于j秒时跳转至结束, <0时，视频大于（总时间-j秒）时跳转)
// 如果不设定就 = null;
$_player['ckplayer'][0]['EndSeconds']			= null;

// 提示点时间 如 30|60鼠标经过进度栏30秒，60秒会提示CuePoints_TEXT指定的相应的文字
// 如果不设定就 = null;
$_player['ckplayer'][0]['CuePoints_TIME']		= null; 
// 提示点文字 如：提示点1|提示点2
$_player['ckplayer'][0]['CuePoints_TEXT']		= '';

// 是否是直播视频流。 0不是，1是，当=1时，播放器会自动锁定进度栏和快进快退按钮
$_player['ckplayer'][0]['Live']					= '0';

//固定视频比例，比如wh:'16:9'，则视频将会以16:9的比例进行计算
$_player['ckplayer'][0]['Proportion']			= null;

// 视频拖动所需的文字定义值
$_player['ckplayer'][0]['VideoDragStr']			= 'start';
?>