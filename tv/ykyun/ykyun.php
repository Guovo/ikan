<?php
/*
严重警告：
1，源码仅供学习交流使用。
2，禁止用于危害官方利益的行为。
3，禁止用于违反法律法规的行为。
4，由于无法对学习交流用户的权利信息进行甄别，如您学习交流过程中侵犯了官方的合法利益或存在违法行为，请立即删除本学习交流程序，遵循相关法律。
5，学习交流用户 应当保证其在学习交流过程中不应用于任何违法行为，并保证承担和赔偿有关违法行为造成的任何损失。

(交流学习)测试使用方法：
m3u8和mp4整段默认最高清晰度
m3u8
php?vid=CMzcxNTUzMg==&type=m3u8
mp4整段
php?vid=CMzcxNTUzMg==&type=mp4
分段
php?vid=CMzcxNTUzMg==
分段清晰度
php?vid=CMzcxNTUzMg==&qxd=gq

ckplayerXML分段调用配置方法
http://www.ckplayer.com/tool/#p_3_7_32

ckplayer单地址调用配置方法
http://www.ckplayer.com/tool/#p_3_7_30

ckplayer手机端调用配置方法
ckplayer下载：http://bbs.ckplayer.com/forum.php?mod=forumdisplay&fid=2
参考：demo2.htm
mp4整段
var video=['http://127.0.0.1/7/acfun87.php?vid=CMzcxNTUzMg==&type=mp4->video/mp4'];
m3u8
var video=['http://127.0.0.1/7/acfun87.php?vid=CMzcxNTUzMg==&type=m3u8->application/x-mpegurl'];

作者QQ：XXXXXXX
QQ群：XXXXXXXXXX
BBS：http://bbs.XXXXXXX.com/forum.php
转载请保留作者信息，谢谢合作！下个版本so方式！
*/
error_reporting(0);
header('Content-Type: application/json;charset=UTF-8');
$vid = $_GET['vid'];//'CMzcxNTUzMg==';
$qxd = $_GET['qxd'];//bq gq cq
$m3u8 = $_GET['type'];;//mp4 m3u8
if (is_numeric($vid)||!$vid){
exit('{"eo":"-1","vid":"参数错误"}');
}
$acfun = new AcfunAppfu___();
$acfun -> Acfun_qq1024031521($vid,$qxd,$m3u8);
$acfun -> Acfun_appfu_();
class AcfunAppfu___{
public $vid;
public $qxd;
public $m3u8;
function Appfu_results() {
$appfu_vip = self::Appfu_data();
if ($appfu_vip['results']->hd2[0]->url){
$appfu_a = 'hd2';
}
elseif($appfu_vip['results']->mp4hd[0]->url){
$appfu_a = 'mp4hd';
}
elseif($appfu_vip['results']->mp4[0]->url){
$appfu_a = 'mp4';
}
elseif($appfu_vip['results']->flvhd[0]->url){
$appfu_a = 'flvhd';
}
elseif($appfu_vip['results']->flv[0]->url){
$appfu_a = 'flv';
}
elseif($appfu_vip['results']->{'3gphd'}[0]->url){
$appfu_a = '3gphd';
}
if (($this->m3u8)=='m3u8'){
$Appfu_ep = $appfu_vip['sid'].'_'.($this->vid).'_'.$appfu_vip['token'];
$$Appfu_ep = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
$$$Appfu_ep = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, 'zx26mfbsuebv72ja', $Appfu_ep, MCRYPT_MODE_ECB, $$Appfu_ep);
$Appfu_m3u8 = 'http://pl.youku.com/partner/m3u8?vid='.($this->vid).'&type='.$appfu_a.'&ep='.urlencode(base64_encode($$$Appfu_ep)).'&sid='.$appfu_vip['sid'].'&token='.$appfu_vip['token'].'&ctype=87&ev=1&oip='.$appfu_vip['oip'].'&skuid=qq1024031521';
header('Content-Type: application/x-mpegurl;charset=UTF-8');
header('Location:'.$Appfu_m3u8);
exit();
}
else{
$Appfu_xml .= '<?xml version="1.0" encoding="UTF-8"?>';
$Appfu_xml .= '<xml_player t="'.time().'">';
$Appfu_xml .= '<flashvars>{h->3}{s->2}</flashvars>';
if (($this->qxd)=='bq'||($this->qxd)=='gq'||($this->qxd)=='cq'){
if (($this->qxd)=='gq'&&$appfu_vip['results']->mp4hd[0]->url){
$Appfu_sk = $appfu_vip['results']->mp4hd;
}
elseif(($this->qxd)=='gq'&&$appfu_vip['results']->mp4[0]->url){
$Appfu_sk = $appfu_vip['results']->mp4;
}
elseif(($this->qxd)=='bq'&&$appfu_vip['results']->flvhd[0]->url){
$Appfu_sk = $appfu_vip['results']->flvhd;
}
elseif(($this->qxd)=='bq'&&$appfu_vip['results']->flv[0]->url){
$Appfu_sk = $appfu_vip['results']->flv;
}
elseif(($this->qxd)=='cq'&&$appfu_vip['results']->hd2[0]->url){
$Appfu_sk = $appfu_vip['results']->hd2;
}
else{
$Appfu_sk = $appfu_vip['results']->$appfu_a;	
}
}else{
$Appfu_sk = $appfu_vip['results']->$appfu_a;
}
if (($this->m3u8)=='mp4'){
if($appfu_vip['results']->{'3gphd'}[0]->url){
$Appfu_sk = $appfu_vip['results']->{'3gphd'};
}else{
$Appfu_sk = $appfu_vip['results']->$appfu_a;	
}
}
foreach ($Appfu_sk AS $k=>$v){
$Appfu_Fileid_Ep = $appfu_vip['sid'].'_'.($v->fileid).'_'.$appfu_vip['token'];
$$Appfu_Fileid_Ep = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
$$$Appfu_Fileid_Ep = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, 'zx26mfbsuebv72ja', $Appfu_Fileid_Ep, MCRYPT_MODE_ECB, $$Appfu_Fileid_Ep);
$Appfu_url = ($v->url).'&oip='.$appfu_vip['oip'].'&sid='.$appfu_vip['sid'].'&token='.$appfu_vip['token'].'&did='.$appfu_vip['did'].'&ev=1&ctype=87&ep='.urlencode(base64_encode($$$Appfu_Fileid_Ep)).'&skuid=qq1024031521';
if (($this->m3u8)=='mp4'){
header('Location:'.$Appfu_url);
exit();
}
$Appfu_xml .= '<video>';
$Appfu_xml .= '<file>';
$Appfu_xml .= '<![CDATA['.$Appfu_url.']]>';
$Appfu_xml .= '</file>';
$Appfu_xml .='<size>'.$v->size.'</size>';
$Appfu_xml .='<seconds>'.$v->seconds.'</seconds>';
$Appfu_xml .= '</video>';
}
header('Content-Type: application/xml;charset=UTF-8');
$Appfu_xml .= '</xml_player>';
exit($Appfu_xml);
}
}
function Acfun_appfu_(){
self::Appfu_results();
}
function Appfu_data() {
$Appfu_Did = self::Appfu_did();
$appfu_a = 'http://acfun.api.mobile.youku.com/common/partner/play?point=1&id='.($this->vid).'&local_time=&local_vid=&format=1,2,3,4,5,6,7,8,9&language=guoyu&did='.$Appfu_Did.'&ctype=87&local_point=&audiolang=1&pid=528a34396e9040f3&guid=ac3e09d2d2485a2b52bedad890d9a151&mac=02:00:00:00:00:00&imei=99000693108561&ver=270&operator=中国电信_46003&network=WIFI&skuid=qq1024031521';
$appfu_b = json_decode(self::sk($appfu_a))->data;
$appfu_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
$appfu_c = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, 'qwer3as2jin4fdsa', base64_decode($appfu_b), MCRYPT_MODE_ECB, $appfu_iv);
$appfu_d = json_decode($appfu_c);
$appfu_results = $appfu_d->results;
$appfu_e = $appfu_d->sid_data;
$appfu_vip = $appfu_e->oip;
$$appfu_vip = $appfu_e->token;
$$$appfu_vip = $appfu_e->sid;
return array(
'results'=>$appfu_results,
'oip'=>$appfu_vip,
'token'=>$$appfu_vip,
'sid'=>$$$appfu_vip,
'did'=>$Appfu_Did
);
}	
function Appfu_did() {
return md5(time().($this->vid).time().'87qq1024031521');	
}
function Acfun_qq1024031521($vid,$qxd,$m3u8){
$this->vid = $vid;
$this->qxd = $qxd;
$this->m3u8 = $m3u8;
}
function sk($url) {
	$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl, CURLOPT_USERAGENT, 'yk_acfun;270;Android;6.0.1;MI 4LTE');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$_SERVER["REMOTE_ADDR"], 'CLIENT-IP:'.$_SERVER["REMOTE_ADDR"]));
	curl_setopt($curl, CURLOPT_REFERER, $url);  
	$AppfuSk = curl_exec($curl);
    curl_close($curl);
	return $AppfuSk;
}
}