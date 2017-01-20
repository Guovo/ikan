<?php
/**
 *	[KW.G] (C)2014-2112 kw.G Inc	.
 *	This is NOT a freeware, use is subject to license terms
 *
 *	GET THE URL INFO
 */
if(!defined('IN_GWIYOMI')){
	exit('Access Denied');
}

define('GWIYOMI_CORE_FUNCTION', true);
define('Region', $_config['Region']);
define('WEBPROVIDER', strtolower($_config['NetworkProvider']));

include_once('./config/config_player.php');
antiCheck($_config['Anti-hotlinking']);
proxySet($_config['PROXY']);

@list($hosturl, $end) = explode('?', $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);
define ("HOST_URL", 'http://'.$hosturl);

function getfile($url, $referer, $proxy,$user_agent){
	if(!function_exists('curl_init')){
		if(!function_exists('fsockopen')){
      $c = file_get_contents($url);
      return  $c;
		foreach ( $headers as $n => $v ) 
		{ 
		$headerArr[] = $n . ':' . $v; 
		} 
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArr);  
		curl_setopt($ch, CURLOPT_HEADER, 1); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
		$result = curl_exec($ch);  

			
			return $c;
		}else{
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$url = eregi_replace('^http://', '', $url);
			$temp = explode('/', $url);
			$host = array_shift($temp);
			$path = '/'.implode('/', $temp);
			$temp = explode(':', $host);
			$host = $temp[0];
			$port = isset($temp[1]) ? $temp[1] : 80;
			$fp = @fsockopen($host, $port, $errno, $errstr, 30);
			if ($fp){
				@fputs($fp, "GET $path HTTP/1.1\r\nHost: $host\r\nAccept: */*\r\nReferer:$url\r\nUser-Agent: $user_agent\r\nConnection: Close\r\n\r\n");
			}
			$content = '';
			while ($str = @fread($fp, 4096)){
				$content .= $str;
			}
			@fclose($fp);

			if(preg_match("/^HTTP\/\d.\d 301 Moved Permanently/is", $content)){
				if(preg_match("/Location:(.*?)\r\n/is", $content, $murl)){
					return getfile($murl[1]);
				}
			}

			if(preg_match("/^HTTP\/\d.\d 200 OK/is", $content)){
				preg_match("/Content-Type:(.*?)\r\n/is", $content, $murl);
				$contentType = trim($murl[1]);
				$content = explode("\r\n\r\n", $content, 2);
				$content = $content[1];
			}
			return $content;
		}
	}else{
    $ip=getIP();
		$ch = curl_init();
		$timeout = 30;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-FORWARDED-FOR:$ip", "CLIENT-IP:$ip"));  //构造IP
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);	
		@$ProxyAddress = !empty($proxy['Address']) ? $proxy['Address'] : PROXY_Address;
		if(!empty($ProxyAddress)){
			curl_setopt($ch, CURLOPT_PROXY, $ProxyAddress);
			@$ProxyPort = !empty($proxy['Address']) ? $proxy['PORT'] : PROXY_PORT;
			if(!empty($ProxyPort))curl_setopt($ch, CURLOPT_PROXYPORT, $ProxyPort);
			@$Proxy_USER = !empty($proxy['Address']) ? $proxy['USER'] : PROXY_USER;
			@$Proxy_PWD = !empty($proxy['Address']) ? $proxy['PWD'] : PROXY_PWD;
			if(!empty($Proxy_USER))curl_setopt($ch, CURLOPT_PROXYUSERPWD, $Proxy_USER.':'.$Proxy_PWD);
		}
		if(!empty($referer))curl_setopt($ch, CURLOPT_REFERER, $referer);
		$c = curl_exec($ch);
		curl_close($ch);
		return $c;
	}
}

function getIP() { 
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $realip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) { 
    $realip = $_SERVER['HTTP_CLIENT_IP']; 
    } else { 
    $realip = $_SERVER['REMOTE_ADDR']; 
    } 
    return $realip; 
} 

function proxySet($config){

	define('PROXY_Address', $config['Address']);
	define('PROXY_PORT', $config['Port']);
	define('PROXY_USER', $config['USER']);
	define('PROXY_PWD', $config['PWD']);
}

function getTimestamp($digits = false){
    $digits = $digits > 10 ? $digits : 10;
	$digits = $digits - 10;
    if((!$digits) || ($digits == 10)){
        return time();
    }else{
        return number_format(microtime(true), $digits, '', '');
    }
}

function kms_iconv($str, $charset_b, $charset_f){
	if(!$charset_b || !$charset_f || !$str)return false;

	$charset_b = strtolower($charset_b);
	$charset_f = strtolower($charset_f);

	if($charset_b == $charset_f){
		return $str;
	}else{
		$charset_b = $charset_b == 'gbk' ? 'GB18030' : $charset_b;
		$charset_f = $charset_f == 'gbk' ? 'GB18030' : $charset_f;
		$str = iconv($charset_b, $charset_f, $str);
		return $str;
	}
}

function get_ckplayer_xml($video, $url, $key, $type, $_player){
	
	foreach($_player['ckplayer'] as $config){
		$video['flashvars'] = '';
		if(isset($config['Proportion']))$video['flashvars'] .= '{wh->'.$config['Proportion'].'}';
		if(empty($config['Live']))$video['flashvars'] .= '{lv->'.$config['Live'].'}';
		if(isset($config['Volume']))$video['flashvars'] .= '{v->'.$config['Volume'].'}';
		if(isset($config['StartSeconds']))$video['flashvars'] .= '{g->'.$config['StartSeconds'].'}';
		if(isset($config['EndSeconds']))$video['flashvars'] .= '{j->'.$config['EndSeconds'].'}';
		if(isset($config['CuePoints_TIME']))$video['flashvars'] .= '{k->'.$config['CuePoints_TIME'].'}';
		if(!empty($config['CuePoints_TEXT']))$video['flashvars'] .= '{n->'.$config['CuePoints_TEXT'].'}';
		if(!empty($config['PauseAD_SRC']))$video['flashvars'] .= '{d->'.$config['PauseAD_SRC'].'}';
		if(!empty($config['PauseAD_IMGURL']))$video['flashvars'] .= '{u->'.$config['PauseAD_IMGURL'].'}';
		if(!empty($config['BufferAD']))$video['flashvars'] .= '{z->'.$config['BufferAD'].'}';
		if(isset($config['EndAction']))$video['flashvars']	.= '{e->'.$config['EndAction'].'}';
		if(isset($config['DefaultAction']))$video['flashvars']	.= '{p->'.$config['DefaultAction'].'}';
		if(!empty($config['DefaultAction_MASK']))$video['flashvars'] .= '{i->'.$config['DefaultAction_MASK'].'}';
		$config['VideoDragStr'] = !empty($video['VideoDragStr']) ? $video['VideoDragStr'] : $config['VideoDragStr'];
		if(isset($config['VideoDragStr']))$video['flashvars'] .= '{q->'.$config['VideoDragStr'].'}';
		$config['DragMethod'] = !empty($video['DragMethod']) ? $video['DragMethod'] : $config['DragMethod'];
		if(isset($config['DragMethod']))$video['flashvars'] .= '{h->'.$config['DragMethod'].'}';
		if($config['Plugins']['hds']['IO'] == 1){
			if(!isset($video['Nowhds']))$video['Nowhds'] = 3;
			if(!isset($video['mixhds']))$video['mixhds'] = 3;
			$video['Nowhds'] = min($video['Nowhds'], $video['mixhds']);
			$video['mixhds'] = min($video['mixhds'],4);
			if(!empty($key)){
				if($config['Plugins']['hds']['Developer'] == 2){
					$video['flashvars']	.= '{f->'.HOST_URL.'?v=[$pat]}';
				}else{
					$video['flashvars']	.= '{f->'.HOST_URL.'?v=[$pat'.$video['Nowhds'].']}';
				}

				switch($video['mixhds']){
					
					case '1':
						$a = $key.'_'.$type.'.0';
						break;
					case '2':
						$a = $key.'_'.$type.'.0|'.$key.'_'.$type.'.1';
						break;
					case '3':
						$a = $key.'_'.$type.'.0|'.$key.'_'.$type.'.1|'.$key.'_'.$type.'.2';
						break;
					case '4':
						$a = $key.'_'.$type.'.0|'.$key.'_'.$type.'.1|'.$key.'_'.$type.'.2|'.$key.'_'.$type.'.3';
						break; 
					default:
						$a = $key.'_'.$type;
						break;
				}
			}else{
				if($config['Plugins']['hds']['Developer'] == 2){
					$video['flashvars']	.= '{f->'.HOST_URL.'?v=[$pat]}';
				}else{
					$video['flashvars']	.= '{f->'.HOST_URL.'?v=[$pat'.$video['Nowhds'].']}';
				}
				switch($video['mixhds']){
					case '1':
						$a = base64_encode($url).'&hdstyle=0';
						break;
					case '2':
						$a = base64_encode($url).'&hdstyle=0|'.base64_encode($url).'&hdstyle=1';
						break;
					case '3':
						$a = base64_encode($url).'&hdstyle=0|'.base64_encode($url).'&hdstyle=1|'.base64_encode($url).'&hdstyle=2';
						break;
					case '4':
						$a = base64_encode($url).'&hdstyle=0|'.base64_encode($url).'&hdstyle=1|'.base64_encode($url).'&hdstyle=2|'.base64_encode($url).'&hdstyle=3';
						break; 
					default:
						$a = base64_encode($url);
						break;
						
				}
			}
		}else{
			$video['flashvars']	.= '{f->'.HOST_URL.'?v=[$pat]}'; 
			
			$a = !empty($key) ? $key.'_'.$type : base64_encode($url);
		}
		if($config['Plugins']['hds']['Developer'] == 2){
			if(!empty($key)){
				$ra = $key.'_'.$type.'.'.$video['Nowhds'];
			}else{
				$ra = base64_encode($url).'&hdstyle='.$video['Nowhds'];
			}
			$Tcount = min(count($config['Plugins']['hds']['name']), $video['mixhds']);
			switch($Tcount){
				case '1':
					$deft = base64_decode($config['Plugins']['hds']['name'][0]);
					break;
				case '2':
					$deft = base64_decode($config['Plugins']['hds']['name'][0]).'|'.base64_decode($config['Plugins']['hds']['name'][1]);
					break;
				case '3':
					$deft =base64_decode($config['Plugins']['hds']['name'][0]).'|'.base64_decode($config['Plugins']['hds']['name'][1]).'|'.base64_decode($config['Plugins']['hds']['name'][2]);
					break;
				case 4:
					$deft = base64_decode($config['Plugins']['hds']['name'][0]).'|'.base64_decode($config['Plugins']['hds']['name'][1]).'|'.base64_decode($config['Plugins']['hds']['name'][2]).'|'.base64_decode($config['Plugins']['hds']['name'][3]);
					break; 
				default:
					$deft = base64_decode($config['Plugins']['hds']['name'][0]);
					break;
			}
			$video['flashvars']	.= '{a->'.$ra.'}{defa->'.$a.'}{deft->'.$deft.'}';
		}else{
			$video['flashvars']	.= '{a->'.$a.'}';
		}
	}
	$xml .= '<?xml version="1.0" encoding="utf-8"?>'.chr(13);
	$xml .= '	<ckplayer>'.chr(13);
	if(!empty($video['name']))$xml .= '		<name><![CDATA['.$video['name'].']]></name>'.chr(13);
	$xml .= '	<data>'.chr(13);
	if(!empty($video['subject']))$xml .= '		<title><![CDATA['.$video['subject'].']]></title>'.chr(13);
	if(!empty($video['videourl']))$xml .= '		<videourl><![CDATA['.$video['videourl'].']]></videourl>'.chr(13);
	$xml .= '	</data>'.chr(13);
	$xml .= '	<flashvars><![CDATA['.chr(13);
	$xml .= '		'.$video['flashvars'].chr(13);
	$xml .= '	]]></flashvars>'.chr(13);
	$xml .= '	<video>'.chr(13);
	foreach($video['data'] as $value){
		@$xml .= '		<file><![CDATA['.$value['src'].']]></file>'.chr(13);
		if(!empty($value['bytes']))$xml .= '		<size>'.$value['bytes'].'</size>'.chr(13);
		if(!empty($value['duration']))$xml .= '		<seconds>'.$value['duration'].'</seconds>'.chr(13);
	}
	$xml .= '	</video>'.chr(13);
	$xml .= '	</ckplayer>';
	
	return $xml;
}

function get_cmp4_merge($video, $key, $type){
	
	$starttype = 0;
		
	$xml = '<?xml version="1.0" encoding="utf-8"?>'.chr(13);
	
	@$xml .= '<m starttype="'.$starttype.'" label="'.$video['title'].'" type="'.$video['type'].'" bytes="'.$video['bytes'].'" duration="'.$video['duration'].'" bg_video="'.$bg_video.'">'.chr(13);
	foreach($video['data'] as $value){
	@$xml .= '	<u duration="'.$value['duration'].'"  bytes="'.$value['bytes'].'" src="'.$value['src'].'" />'.chr(13);
	}
	$xml .= '</m>';
	
	return $xml;
}

function kms_matchs($haystack, $needle){
	if(is_array($needle)){
		foreach($needle as $need){
			if($haystack === $need)return true;
         }
     }else{
          if($haystack === $needle)return true;
     }
	 
     return false;
}


function kms_strpos($haystack, $needle){
	if(is_array($needle)){
		foreach($needle as $need){
			if(strpos($haystack, $need) !== false)return true;
         }
     }else{
          if(strpos($haystack, $needle) !== false)return true;
     }
	 
     return false;
}

function timedtos($val){
	
	$timelongarr = array_reverse(explode(":", $val));
	
	$cx = array(1,60,3600);
	for($i=0; $i<count($cx); $i++){
		@$sec += $timelongarr[$i]*$cx[$i];
	}

	return $sec;
}

function mbtobytes($val){

	$bytes = $val*pow(1024,2);
	
	return $bytes;
};



function _LoadOder($mode, $url, $type, $key, $hds, $_extractor, $mobile){
	
	
	if(empty($type))return false;
	
	if($mode == 'local'){

	if(!empty($key) && !empty($type)){
			
	$_extractorFile_local = './resource/local/TV_'.strtoupper($type).'.php';
			
	if(file_exists($_extractorFile_local))include_once($_extractorFile_local);
	
  }
  
  if($mobile == 0){
			
		if(!empty($key) && function_exists('GetVideo_FLASH'))$data = GetVideo_FLASH($key, $hds);
			
	}else{
			
		if(!empty($key) && function_exists('GetVideo_HTML5'))$data = GetVideo_HTML5($key, $hds);
							
	}
      
      
	}elseif($mode == 'api'){
		
		$_extractorApi = './resource/net/GET_API.php';
		
		if(file_exists($_extractorApi))include_once($_extractorApi);
		
		$data = Get_API($url, $type, $key, $hds, $mobile);
		
	}elseif($mode == 'flvcd'){
		
		if($mobile == 1)return false;
		
		$_extractorFlvcd = './resource/net/GET_FLVCD.php';
		
		if(file_exists($_extractorFlvcd))include_once($_extractorFlvcd);
		
		$data = Get_FLVCD($url, $hds);
		
	}else{
		
		echo 'Sorry This Config is Setting ERROR Please Chexk The Config Files';die();
		
	  }
	
	if(empty($data))return false;
	
	return $data;
}

function antiCheck($config){
	if(!empty($config['IO'])){
		@$refer = $_SERVER['HTTP_REFERER'];	
		if(!empty($refer)){
			$Access = 0;
			//黑名单
			$Blacklist = explode(',', $config['Blacklist']);
			//白名单
			$Whitelist = explode(',', $config['Whitelist']);
			//如果白名单不为空
			if(!empty($config['Whitelist'])){
				if(kms_strpos($refer, $Whitelist) === true)$Access = 1;
			}
			if(!empty($config['Blacklist'])){
				if(kms_strpos($refer, $Blacklist) === true)$Access = 0;
			}
		}
		if(empty($Access)){
			if(!empty($config['Url']) && isset($config['Time'])){
			header('Refresh: '.$config['Time'].'; url='.$config['Url']);exit($config['TexT']);
			}
    }
   } 
}

function CreateMobile($video, $_player){
	if(empty($video['data'][0]['src']) && empty($video['data'][0]['bpsrc']))die();
	$backup = !empty($video['data'][0]['bpsrc']) ? $video['data'][0]['bpsrc'] : null;
	if(!empty($backup))$backup = !empty($video['data'][0]['src']) ? $backup.',' : $backup;
	if(strpos($video['data'][0]['src'], '.m3u8') === false)$video['data'][0]['src'] = $video['data'][0]['src'].'->video/mp4';
	$list = $backup.$video['data'][0]['src'];
	return $list;
}

function CreateMp4($video, $_player){
	if(empty($video['data'][0]['src']) && empty($video['data'][0]['bpsrc']))die();
	$backup = !empty($video['data'][0]['bpsrc']) ? $video['data'][0]['bpsrc'] : null;
	if(!empty($backup))$backup = !empty($video['data'][0]['src']) ? $backup.',' : $backup;
	if(strpos($video['data'][0]['src'], '.m3u8') === false)$video['data'][0]['src'] = $video['data'][0]['src'];
	$list = $backup.$video['data'][0]['src'];
	return $list;
}

function b64UrlCheck($url){
	$check = parse_url(base64_decode($url));
	if(empty($check['host']) || empty($check['path']))$ckeck = parse_url('http://'.base64_decode($url));	
	if(!empty($check['host']) && !empty($check['path']))return true;
	return false;
}

function isMobile(){    
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';    
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';      
    function CheckSubstrs($substrs,$text){    
        foreach($substrs as $substr)    
            if(false!==strpos($text,$substr)){    
                return true;    
            }    
            return false;    
    }  
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');  
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');    
                
    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||    
              CheckSubstrs($mobile_token_list,$useragent);    
                
    if ($found_mobile){    
        return true;    
    }else{    
        return false;    
    }    
}  

?>