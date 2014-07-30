<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['email'])) {

    // Sanitize and validate the data passed in
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	
    // check existing email
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
		if ($stmt->num_rows == 1) {
			echo("Email Found");
		}else
			echo("No Email Found");
	}else
		echo("ERROR");
	$stmt->close();
	//header('Location: ./register_success.php');
}else{
echo("ERROR");
}