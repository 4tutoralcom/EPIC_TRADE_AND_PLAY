<?php
require 'ip_lookup.php';
$RegistrationSuccessful =false;
$RequestType="";
if (isset($_GET['email'],$_GET['key'],$_GET['t'])){
	$RequestType = filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING);
	if($RequestType=="c"){
		if (preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])) {
			
			$userid = filter_input(INPUT_POST, 'userid_f', FILTER_SANITIZE_STRING);
			$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// Not a valid email
			}else if((strlen($_GET['key']) == 32)){
			 $key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING);
			}
			if (isset($email) && isset($key)) {
			
				$query_activate_account = "Update allowed_ip_adresses 
				INNER JOIN members  
				ON allowed_ip_adresses.member_id = members.id 
				AND `members`.`email` = ?
				AND `allowed_ip_adresses`.`allowed`=0
				AND `allowed_ip_adresses`.`uid` = ?
				AND `allowed_ip_adresses`.`uid` <> '0'
				SET `allowed_ip_adresses`.`ip_address`=?,
				`allowed_ip_adresses`.`allowed`=1,`allowed_ip_adresses`.`uid`='0';";
				$ip_address=getUserIp();
				$stmt = $mysqli->prepare($query_activate_account);
				if ($stmt) {
				
					$ip_address=getUserIp();
					$stmt->bind_param('sss', $email,$key,$ip_address);
					if($stmt->execute()){
					
						if($stmt->affected_rows=="1"){
							$RegistrationSuccessful=true;
						}
					}
				}
			}
		}
	}
}

?>