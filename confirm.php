<?php
include_once '\includes\db_connect.php';
include_once '\includes\psl-config.php';
include_once '\includes\ip_lookup.php';
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
 $_GET['email'])) {
 $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))
 //The Activation key will always be 32 since it is MD5 Hash
 {
 $key = $_GET['key'];
}

if (isset($email) && isset($key)) {

	// Update the database to set the "activation" field to null
	$ip_address=getUserIp();
	
	$query_activate_account = "Update allowed_ip_adresses 
	INNER JOIN members  
	ON allowed_ip_adresses.id = members.id 
	AND `members`.`email` = ?
	AND `allowed_ip_adresses`.`uid` = ?
	SET `allowed_ip_adresses`.`ip_address`=?,
	`allowed_ip_adresses`.`allowed`=?;";
	$allowed=1;
	$stmt = $mysqli->prepare($query_activate_account);
	if ($stmt) {
		$stmt->bind_param('ssss', $email,$key,$ip_address,$allowed);
		$stmt->execute();
	}
	header('Location: ./register_success.php');
}
?>