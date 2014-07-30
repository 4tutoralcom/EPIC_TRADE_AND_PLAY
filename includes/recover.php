<?php
include_once '\includes\db_connect.php';
include_once '\includes\psl-config.php';
include_once '\includes\part\header.php';
?>
<?php
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])) {
	$userid = filter_input(INPUT_POST, 'userid_f', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Not a valid email
	}else if (isset($_GET['key']) && (strlen($_GET['key']) == 32)){
	 $key = filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING);
	}
	if (isset($email) && isset($key)) {
		// Update the database to set the "activation" field to null
		$query_activate_account = "SELECT members.username
									FROM `password_recovery`,`members`
									WHERE `password_recovery`.id = `members`.id AND
									`members`.email=? And `password_recovery`.uid=?";
		$stmt = $mysqli->prepare($query_activate_account);
		if ($stmt) {
			$stmt->bind_param('ss', $email,$key);
			$stmt->execute();
			$stmt->bind_result($username);
			$stmt->fetch();
		}
	}
}
if($username) : ?>
	<div class="container text-inter ">
		<div class="container bg-white no-padding-top">
			<div class="row">
				<div class="col-md-12">
					<h1>Change Password</h1>
					<h2 class="floatup"><?php echo $username;?></h2>
				</div>
			</div>
			<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
			<p class="text-center">Use the form below to change your password. Your password cannot be the same as your username.</p>
			<form method="post" id="passwordForm">
			<input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="New Password" autocomplete="off">
			<div class="row">
			<div class="col-sm-6">
			<span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 Characters Long<br>
			<span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Uppercase Letter
			</div>
			<div class="col-sm-6">
			<span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Lowercase Letter<br>
			<span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Number
			</div>
			</div>
			<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repeat Password" autocomplete="off">
			<div class="row">
			<div class="col-sm-12">
			<span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Passwords Match
			</div>
			</div>
			<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">
			</form>
			</div><!--/col-sm-6-->
			</div><!--/row-->
		</div>
	</div>
<?php else:?>
<?php 
endif;
include_once '\includes\part\footer.php';
?>