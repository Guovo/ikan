<?php
function hostmd5key(){
	
      $host = $_SERVER['SERVER_NAME'];  
      $MD5 = md5(md5($host.'lyhaoyu.cn'.'304543200'));
      $MD5 = base64_encode(base64_encode($MD5));
      $MD5 = md5(md5($MD5));
      $MD5 = base64_encode(base64_encode($MD5));
      $MD5 = md5(md5($MD5));
      
      return $MD5;
}
print_r(hostmd5key());
?>