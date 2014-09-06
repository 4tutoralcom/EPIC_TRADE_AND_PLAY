<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'ip_lookup.php';
sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
	$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
	$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
	$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
	$message.="$type #$phone";
	if (contactUs($name,$email,$subject,$message,$mysqli) == true) {
        // Login success
        echo "Success";
    }else{
        // Login failed 
        echo "Username or Email Not Found.";
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
	//header('Location: ../index.php');
}