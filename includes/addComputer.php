<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'ip_lookup.php';
sec_session_start();
$dre="112";
if (isset($_POST['access'],$_POST['userid'],$_POST['p'])){
	if (preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_POST['userid'])) {
		$email = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_EMAIL);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$dre="Not a valid email";
		}else if((strlen($_POST['access']) == 8)){
			$access = filter_input(INPUT_POST, 'access', FILTER_SANITIZE_STRING);
		}else{
		$dre="Invalid access Code";
		}
		if (isset($email) && isset($access)) {
			$query_activate_account = "Update allowed_ip_adresses 
			INNER JOIN members  
			ON allowed_ip_adresses.member_id = members.id 
			AND `members`.`email` = ?
			AND `allowed_ip_adresses`.`uid` = ?
			AND `allowed_ip_adresses`.`uid` <> '0'
			SET `allowed_ip_adresses`.`ip_address`=?,
			`allowed_ip_adresses`.`allowed`='1',
			`allowed_ip_adresses`.`uid`='0';";
			$stmt = $mysqli->prepare($query_activate_account);
			if ($stmt) {
				$ip_address=getUserIp();
				$stmt->bind_param('sss', $email,$access,$ip_address);
				if($stmt->execute()){
					if($stmt->affected_rows=="1"){
						$dre= login($email, $password, $mysqli,$ip_address);
						if (!$dre) {
							echo "Success";
						}
						else{
							$dre=0;
						}
					}else{
						$dre= 1;
					}
				}else{
					$dre= "2";
				}
			}else{
				$dre= "3";
			}
		}
	}
}
echo $dre;
?>