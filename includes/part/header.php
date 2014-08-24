<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
$phone="314-293-2727";
$loggedOut = !login_check($mysqli);
$RequestType="";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta name="description" content="Full view calendar component for twitter bootstrap with year, month, week, day views.">
	<meta name="keywords" content="jQuery,Bootstrap,Calendar,HTML,CSS,JavaScript,responsive,month,week,year,day">
	<meta name="author" content="Serhioromano">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title></title>
				<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/queries.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">	
		
		<!-- Flexslider CSS-->
		<link rel="stylesheet" href="css/flexslider.css" type="text/css">
		<link rel="stylesheet" href="css/labelFloat.css" type="text/css">
		<link href="css/userDropDownMenu.css" rel="stylesheet">
		<link href="css/shop.css" rel="stylesheet">
		
	
		<!-- Fonts -->
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<!--Calander-->
		<link href='css/fullcalendar.css' rel='stylesheet' />
		<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
		<!--Calander-->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="modal-open" style="padding-right: 0px;">
		<header class="clearfix">
			<a href="/">
			<div class="logo col-sm-3">
				<h2 class="logo-text">EPIC</h2>
				<div class="logo-dec">Game &#8901; Trade &#8901; Repair</div>
			</div>
			</a>
			<?php if(false) :?> 
			<?php//If The user is logged in include modal.
			if ($loggedOut)
				require 'includes\part\modal.php';?>
			<?php endif;?>
			
			<nav class="clearfix">
				<ul>
			<?php if(false) :?>
					<?php if($loggedOut) :?>
						<li><a data-toggle="modal" data-target="#ModalSignIn" class="inline hidden-lg hidden-md signin-button">Sign In</a></li>
					<?php else:?>
						<li>
							<ul class="nav navbar-nav user-nav">
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo htmlentities($_SESSION['username']); ?><span class="glyphicon glyphicon-user pull-right"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#"><span class="glyphicon glyphicon-cog pull-right"></span>Account Settings </a></li>
									<li class="divider"></li>
									<li><a href="#"><span class="glyphicon glyphicon-stats pull-right"></span>User stats</a></li>
									<li class="divider"></li>
									<li><a href="#"><span class="badge pull-right"> 0 </span>Messages</a></li>
									<li class="divider"></li>
									<li><a href="#"><span class="glyphicon glyphicon-heart pull-right"></span>Purchase History</a></li>
									<li class="divider"></li>
									<li><a href="includes/logout.php"><span class="glyphicon glyphicon-log-out pull-right"></span>Sign Out</a></li>
									<li class="divider"></li>
								</ul>
								</li>
							</ul>
						</li>
					<?php endif;?>
			<?php endif;?>
					<li><a href="/game.php">Game</a></li>
					<li><a href="/trade.php">Trade</a></li>
					<li><a href="/repairs.php">Repair</a></li>
					<li><div class="contact_us"><a href="contact.php" class="last">Contact Us</a></div><div><?php print($phone) ?></div></li>
				</ul>
			</nav>
			<?php if(false) :?>
			<div class="hidden-xs hidden-sm signinContainer">
				<div class="signin">
				
					<?php if($loggedOut) : ?>
						<ul class="nav navbar-nav user-nav">
							<li class="dropdown">
								<a href="#" id="signinButton" class="dropdown-toggle" data-toggle="modal" data-target="#ModalSignIn" class="button">Sign In <span class="glyphicon glyphicon-user pull-right"></span></a>
							</li>
						</ul>
					<?php else:?>
						  <ul class="nav navbar-nav user-nav">
							<li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo htmlentities($_SESSION['username']); ?><span class="glyphicon glyphicon-user pull-right"></span></a>
							  <ul class="dropdown-menu">
								<li><a href="#"><span class="glyphicon glyphicon-cog pull-right"></span>Account Settings </a></li>
								<li class="divider"></li>
								<li><a href="#"><span class="glyphicon glyphicon-stats pull-right"></span>User stats</a></li>
								<li class="divider"></li>
								<li><a href="#"><span class="badge pull-right"> 0 </span>Messages</a></li>
								<li class="divider"></li>
								<li><a href="#"><span class="glyphicon glyphicon-heart pull-right"></span>Purchase History</a></li>
								<li class="divider"></li>
								<li><a href="includes/logout.php"><span class="glyphicon glyphicon-log-out pull-right"></span>Sign Out</a></li>
							  </ul>
							</li>
						  </ul>
					<?php endif; ?>
				</div>
			</div>
			<?php endif;?>
			<div class="pullcontainer">
				<a href="#" id="pull"><i class="fa fa-bars fa-2x"></i></a>
			</div>
			
		</header>