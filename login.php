<?php
		include_once('db.php');
		if(isset($_POST["username"]) && isset($_POST["password"])){
		if(empty($_POST["username"]))
			die("Empty Username!");
		if(empty($_POST["password"]))
			die("Empty Password!");
			$username = mysql_real_escape_string( $_POST["username"] );
			$password = mysql_real_escape_string( md5($_POST["password"]));
			
		}else{
			die("404");
		}
		$sql = "SELECT count(*) 
				FROM Users 
				WHERE(username='$username' AND password='$password')";

			$result=mysql_query($sql);
			if($result === FALSE) {
				die(mysql_error()); // TODO: better error handling
			}
			$row= mysql_fetch_array($result);
			
			if ( $row[0]==1 )
				echo "Success";
			else
				echo "Username or Password Not Found.";

?>