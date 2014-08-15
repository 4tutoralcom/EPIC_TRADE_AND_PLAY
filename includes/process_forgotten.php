<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'ip_lookup.php';
sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['user'])) {
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
	if (forgot($user,$mysqli) == true) {
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