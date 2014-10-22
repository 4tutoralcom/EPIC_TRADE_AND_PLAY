<?php
include_once 'psl-config.php';

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}
function login($email, $password, $mysqli,$ip_address) {
	$ShopName="Epic Game Play Trade";
	$error_msg = "";
	$stmt = $mysqli->prepare("SELECT id, username, password, salt, first_name, last_name 
        FROM members
		WHERE email = ?
        LIMIT 1");
	// Using prepared statements means that SQL injection is not possible.
    if ($stmt){
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username,$db_password, $salt, $first_name, $last_name);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                $error_msg="The Account is Locked For to many failed attempts! Check your email and try again.";
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Login successful.
					// Check if the user has allowed the ip address 
					// to access there account.
					$stmt = $mysqli->prepare("SELECT `ip_address`, `allowed` FROM `allowed_ip_adresses` WHERE member_id=?");
					if($stmt){
						$stmt->bind_param('i', $user_id);  // Bind "$user_id" to parameter.
						$stmt->execute();    // Execute the prepared query.
						$stmt->store_result();
						// get variables from result.
						$stmt->bind_result($db_ip, $allowed);
						$Check=true;
						
						    while ($stmt->fetch()) {
								if($allowed==1 &&  $db_ip==$ip_address ){
								
									// Password is correct and IP Address is allowed!
									// Get the user-agent string of the user.
									$user_browser = $_SERVER['HTTP_USER_AGENT'];
									// XSS protection as we might print this value
									$user_id = preg_replace("/[^0-9]+/", "", $user_id);
									$_SESSION['user_id'] = $user_id;
									// XSS protection as we might print this value
									$username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
																				"", 
																				$username);
									$_SESSION['username'] = $username;
									$_SESSION['login_string'] = hash('sha512', 
									$password . $user_browser);
									$_SESSION['email']= $email;
									$_SESSION['FirstName']= $first_name;
									$_SESSION['LastName']= $last_name;
									$Check=false;
									break;
								}
								
							}
							if($Check){
								if(isset($_POST['add'])){
									$add = filter_input(INPUT_POST, 'add', FILTER_SANITIZE_STRING);
									if($add=="true") {
										$uid = substr(md5(uniqid(mt_rand(1, mt_getrandmax()))), 0, 8);
										$stmt=$mysqli->prepare("SELECT `ip_address`, `uid` FROM `allowed_ip_adresses` WHERE  `uid`=? OR (`member_id`=? AND `ip_address`=?)");
										if($stmt) {
											$stmt->bind_param('iss',$uid,$user_id,$ip_address);
											if($stmt->execute()){
												$stmt->store_result();
												$breakLoop=false;
												$r_uid="";
												$msg="";
												while($stmt->num_rows!=0 && $breakLoop==false){
													$uid = substr(md5(uniqid(mt_rand(1, mt_getrandmax()))), 0, 8);
													$stmt->bind_param('iss',$uid,$user_id,$ip_address);
													$stmt->execute();
													$stmt->store_result();
													$stmt->bind_result($s_ip,$s_uid);
													while ($stmt->fetch()) {
														if($s_ip==$ip_address){
															$msg="An Email has been set before for this account on this IP Address! Only The most recent Access Code will work.<br>";
															$breakLoop=true;
															$r_uid=$s_uid;
														}
													}
												}
												
												if($breakLoop){
													$stmt=$mysqli->prepare("DELETE FROM `allowed_ip_adresses` WHERE `ip_address`=? AND `uid`=? AND `member_id`=?");
													if($stmt){
														$stmt->bind_param('ssi',$ip_address,$r_uid,$user_id);
														if(!$stmt->execute()){
															$error_msg.="FATAL ERROR 000";	
														}
													}else{
														$error_msg.="FATAL ERROR 000";
													}
												}
												if($error_msg==""){
													$stmt=$mysqli->prepare("INSERT INTO `allowed_ip_adresses` (`member_id`, `ip_address`, `allowed`, `uid`) VALUES (?,?,0,?)");
													if($stmt){
														$stmt->bind_param('iss',$user_id, $ip_address, $uid);
														if($stmt->execute()){
															$error_msg=$msg;
															$content="	Hi ".$username.",\r\n
																		Yor Access Code is \r\n
																		<h2>$uid</h2>
																		".$ShopName." Staff";
																		
																				mail($email,'Register '.$ShopName.' Account',$content,'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .'from: 4tutoralcom@gmail.com');
														}
													}
												}
											}
										}
									}
								}else{
									$error_msg="IP Address Error!";	
								}
							}
								
					}else{
						//unknown error
						$error_msg="FATAIL ERROR! #000";
					}
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    $error_msg="Username and/or Password Not Found2";
                }
            }
        } else {
            // No user exists.
            $error_msg="Username and/or Password Not Found1";
        }
    }else{
		$error_msg="FATAIL ERROR! #001";
	}
	return (!$error_msg=="")?$error_msg:false;
}
function register($first_name, $last_name, $username,$email,$password,$mysqli){
	$ShopName="Epic Game Play Trade";
	$error_msg = "";
	
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
		$uid='';
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
	$prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
		$stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
 
    // check existing username
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
		
		if ($stmt->num_rows == 1) {
				// A user with this username already exists
				$error_msg .= '<p class="error">A user with this username already exists</p>';
		}
		$stmt->close();
	} else {
			$error_msg .= '<p class="error">Database error line 55</p>';
			$stmt->close();
	}
	 if (empty($error_msg)) {
		
        // Create a random salt
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		
        $password = hash('sha512', $password . $random_salt);
 			
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (first_name, last_name, username, email, password, salt) VALUES (?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssss',$first_name, $last_name, $username, $email, $password, $random_salt);
            // Execute the prepared query.
            $insert_stmt->execute(); 
        }else{
			$error_msg+="ERROR 1D01";
		}
		
		$prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
		$stmt = $mysqli->prepare($prep_stmt);
	 
		if ($stmt) {
			$ip_address="0.0.0.0";
			//Create uid for ipaddress
			$uid = md5(uniqid(mt_rand(1, mt_getrandmax()), true));
			$allowed=0;
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id);
			$stmt->fetch();
			$content="Hi ".$username.",\r\n
			Thank you for registering an ".$ShopName." Account!\r\n
			Please click the following link to activate your Account.\r\n
			http://76.253.56.108/index.php?t=c&email=".$email."&key=".$uid."\r\n
			The above link is only valid for 72 hours.\r\n
			If you have received this email in error, please disregard it. No further emails will be sent.\r\n
			Sincerely,\r\n
			".$ShopName." Staff";
			
			if ($insert_stmt = $mysqli->prepare("INSERT INTO `allowed_ip_adresses` (`member_id`, `ip_address`, `allowed`, `uid`) VALUES (?,?,?,?)")) {
				$insert_stmt->bind_param('isis',$id, $ip_address, $allowed, $uid);
				// Execute the prepared query.
				if ($insert_stmt->execute()) {
					mail($email,'Register '.$ShopName.' Account',$content,'from: 4tutoralcom@gmail.com');
				} else {
				
				}
			}
			
			$stmt->close();
		} else {
			$error_msg .= '<p class="error">Database error Line 97</p>';
			$stmt->close();
		}
	}else{
		return $error_msg;
	}
	
	return false;
}
function forgot($userid,$mysqli){
	$ShopName="Epic Game Play Trade";
	$prep_stmt = "SELECT id,email,username FROM members WHERE email = ? LIMIT 1";
	$stmt = $mysqli->prepare($prep_stmt);
	$found=false;
	if ($stmt) {
		$stmt->bind_param('s', $userid);
		if($stmt->execute()){
			$stmt->store_result();
			if($stmt->num_rows==1){
				$found=true;
				$stmt->bind_result($id,$email);
				$stmt->fetch();
			}
		}
	}else{
		//die("Fatal Server Error!");
	}
	if($found==false){
		$prep_stmt = "SELECT id,email,username FROM members WHERE username = ? LIMIT 1";
		$stmt = $mysqli->prepare($prep_stmt);
		if ($stmt) {
			$stmt->bind_param('s', $userid);
			if($stmt->execute()){
				$stmt->store_result();
				if($stmt->num_rows==1){
					$found=true;
					$stmt->bind_result($id,$email,$username);
					$stmt->fetch();
				}
			}
		}else{
			die("Server Error!");
		}	
	}
	if($found==true){
		$uid = md5(uniqid(rand(), true));
		
		$prep_stmt = "INSERT INTO `password_recovery`(`id`, `uid`) VALUES (?,?)";
		$stmt = $mysqli->prepare($prep_stmt);
		$stmt->bind_param('ss', $id,$uid);
		if($stmt->execute()){
			$content="Hi ".$username.",\r\n
			You recently requested a new password for your ".$ShopName." Account!\r\n
			Please click the following link to reset the password on your Account.\r\n
			http://76.253.56.108/index.php?t=p&email=".$email."&key=".$uid."\r\n
			If you have received this email in error, please disregard it. and delete this email.\r\n
			Sincerely,\r\n
			".$ShopName." Staff";
			mail($email,'Password Reset:'.$ShopName.' Account',$content,'from: 4tutoralcom@gmail.com');
		}else{
			die("User Already Reseting Passowrd!");
		}
	}
	return $found;
}
function contactUs($name,$email,$subject,$message,$mysqli){
	$error_msg=true;
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= 'Email Error|The Email is not Valid';
    }else{
		$ShopName="Epic Game Play Trade";
		$content="$name message,
		$message
		Sincerely,\r\n".$ShopName." Automated System
		from: $email";
		mail("4tutoralcom@gmail.com",$subject,$content,'from: 4tutoralcom@gmail.com');
	}
	return $error_msg;
}
function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}
function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}