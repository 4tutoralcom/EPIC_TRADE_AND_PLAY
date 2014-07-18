<?php
function getUserIp() {
	//$http_client_ip=$_SERVER['HTTP_CLIENT_IP'];
	//$http_x_forwarded_for=$_SERVER['HTTP_X_FORWARDED_FOR'];
	//$remote_addr=$_SERVER['REMOTE_ADDR'];
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
		$ip_address=$_SERVER['HTTP_CLIENT_IP'];
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip_address=$_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(!empty($_SERVER['REMOTE_ADDR']))
		$ip_address=$_SERVER['REMOTE_ADDR'];
	else
		die("Error User Access!");
	return $ip_address;
}
?>