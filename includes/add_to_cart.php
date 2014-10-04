<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'ip_lookup.php';
sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['quantity']) &&isset($_POST['has_case']) && isset($_POST['has_book']) && isset($_POST['has_game'])) {
$has_case = filter_input(INPUT_POST, 'has_case', FILTER_SANITIZE_STRING)=="true"?1:0;
$has_book = filter_input(INPUT_POST, 'has_book', FILTER_SANITIZE_STRING)=="true"?1:0;
$has_game = filter_input(INPUT_POST, 'has_game', FILTER_SANITIZE_STRING)=="true"?1:0;

echo '$id$has_case';
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
	//header('Location: ../index.php');
}