		<header class="clearfix">
			<div class="logo col-sm-3">
				<h2 class="logo-text">EPIC</h2>
				<div class="logo-dec">Game &#8901; Trade &#8901; Repair</div>
			</div>
			<?php //If The user is logged in include modal.
			if ($loggedOut){
				require 'includes\part\modal.html';
			}
			?>

			<nav class="clearfix">
				<ul>
					<li>
						<a data-toggle="modal" data-target="#ModalSignIn" class="inline hidden-lg hidden-md signin-button">Sign In</a>
					</li>
					<li><a href="#" class="active">Home</a></li>
					<li><a href="#">Sell Game</a></li>
					<li><a href="#">Repairs</a></li>
					<li><a href="#">Schedule</a></li>
					<li><a href="#" class="last">Contact Us</a></li>
				</ul>
			</nav>
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
								<li><a href="#"><span class="badge pull-right"> 42 </span>Messages</a></li>
								<li class="divider"></li>
								<li><a href="#"><span class="glyphicon glyphicon-heart pull-right"></span>Favourites Snippets</a></li>
								<li class="divider"></li>
								<li><a href="includes/logout.php"><span class="glyphicon glyphicon-log-out pull-right"></span>Sign Out</a></li>
							  </ul>
							</li>
						  </ul>
					<?php endif; ?>
				</div>
			</div>
			<div class="pullcontainer">
				<a href="#" id="pull"><i class="fa fa-bars fa-2x"></i></a>
			</div>
		</header>