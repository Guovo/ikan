<?php
/**
 *	[KW.G] (C)2014-2112 kw.G Sdo.
 *	This is NOT a freeware, use is subject to license terms
 *
 *	[Important{5*}] To Control This Systems.
 */

$_config = array();
// 设定主机所在的地区 帮助解析更有效率 解析系统所在主机网络是否在中国境内(不包括 香港 澳门 台湾) {0=是 , 1=否}
$_config['Region']							= '0';

// 针对flvxz的设定 暂时只对letv需而设 telecom other 基本不用更动这里 如果letv无效可以试试变换此值 
$_config['NetworkProvider']					= 'telecom';

// 定义默认使用的播放器 现时可填项 (cmp4 , ckplayer) 必填
$_config['player']['Default']				= 'ckplayer';

// 使用解析系统的次序 [flvxzurl,flvxzapi,flvcd,local local->flvxzapi->flvxzurl->flvcd->local]
$_config['extractor']['order']				= 'local->api';

// 程序容可通过的视频原档解析 只要URL包含以下字眼便会立即输出
$_config['Passage']							= '.flv,.m3u8,.mp4,.m4v';

// PROXY Setting - Auto 等于自动获取代理

$_config['PROXY']['Address']			= '';
$_config['PROXY']['Port']					= '';
$_config['PROXY']['USER']					= '';
$_config['PROXY']['PWD']					= '';

// 是否打开PHP简单防盗连  [0=关 , 1=开]
$_config['Anti-hotlinking']['IO']			= '0';

// 防盗连 - 黑名单
$_config['Anti-hotlinking']['Blacklist']	= '';
// 防盗连 - 白名单
$_config['Anti-hotlinking']['Whitelist']	= '127.0.0.1,http://qtzr.net';


// 禁止进入 - 文字
$_config['Anti-hotlinking']['TexT']			= "Access Denied . I'm sorry";
// 禁止进入时进行网页转跳 - 时间
$_config['Anti-hotlinking']['Time']			= '1';
// 禁止进入时进行网页转跳 - 网址/路径
$_config['Anti-hotlinking']['Url']			= 'http://72blog.com';


?>