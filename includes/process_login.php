<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'ip_lookup.php';
sec_session_start(); // Our custom secure way of starting a PHP session.
$ip_address=getUserIp();
if (isset($_POST['userid'], $_POST['p'])) {
    $userid = $_POST['userid'];
    $password = $_POST['p']; // The hashed password.
	if (login($userid, $password, $mysqli,$ip_address) == true) {
        // Login success
        echo "Success";
    }else{
        // Login failed 
        echo "Username or Password Not Found.";
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
	header('Location: ../index.php');
}