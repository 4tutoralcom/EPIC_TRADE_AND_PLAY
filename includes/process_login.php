<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'ip_lookup.php';
sec_session_start(); // Our custom secure way of starting a PHP session.
$ip_address=getUserIp();
$error_msg="";
if (isset($_POST['userid'], $_POST['p'])) {
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	$error_msg=login($userid, $password, $mysqli,$ip_address);
	if (!$error_msg) {
        // Login success
        echo "Success";
    }else{
        // Login failed
        echo $error_msg;
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
	header('Location: ../index.php');
}