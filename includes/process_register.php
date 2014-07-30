<?php

include_once 'db_connect.php';
include_once 'functions.php';
include_once 'ip_lookup.php';
sec_session_start();
$ip_address=getUserIp();
if (isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $_POST['t_and_c'], $_POST['p'])) {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $aggreeToTerms = filter_input(INPUT_POST, 't_and_c', FILTER_SANITIZE_STRING);
	
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$uid='';
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	if($aggreeToTerms=="1") {
		if (($error_msg=register($first_name, $last_name, $username,$email,$password,$mysqli)) == false) {
			// Login success
			echo "Success";
		}else{
			// Login failed 
			echo $error_msg;
		}
	}
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
	//header('Location: ../index.php');
}