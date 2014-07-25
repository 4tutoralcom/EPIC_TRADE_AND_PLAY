			<!-- Sign In Modal -->
			<div class="modal fade" id="ModalSignIn" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="bs-example bs-example-tabs">
							<ul id="myTab" class="nav nav-tabs">
								<li class="active"><a  href="#signin" data-toggle="tab">Sign In</a></li>
								<li class=""><a  href="#register" data-toggle="tab">Register</a></li>
							</ul>
						</div>
						<div class="modal-body">
							<div id="myTabContent" class="tab-content">						
								<div class="tab-pane fade in" id="forgot">
									<fieldset>
										<form id="FormForgot" class="omb_loginForm" action="includes/forgotPassword.php" autocomplete="off" method="POST">
											<div class="row">
												<div class="col-xs-12">
													<div class="form-group bs-float-label">
														<label for="userid_f" class="float-label">Username or Email</label>
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user"></i></span>
															<input type="text" class="form-control float-input" name="userid_f" id="userid_f" placeholder="Username or Email" autocomplete="off">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-sm-6">
													<div class="padding-15">
														<button data-target="#signin" data-toggle="tab" type="button" class="btn btn-default" "tabindex="7">Back</button>
													</div>
												</div>
											</div>
										</form>
									</fieldset>
								</div>
								<div class="tab-pane fade in" id="terms">
									<h2>Terms and Conditions</h2>
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dolor enim, tempus sed sapien a, feugiat tempor tortor. Proin dapibus ut sem quis rhoncus. Donec dapibus sagittis dictum. Fusce dictum viverra justo. Nullam ornare varius erat a ullamcorper. Fusce ornare diam volutpat mi fermentum, nec venenatis libero faucibus. Nullam blandit sapien at congue fringilla. Phasellus id porta lacus, ut vestibulum felis. Vivamus cursus lorem vel ultrices lobortis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam convallis placerat purus, vitae rutrum nisi eleifend in. Nullam tempus metus tempus augue bibendum varius. Morbi posuere eget lorem in sagittis. Duis tempus lacinia libero nec eleifend.
									</p>
									<p>
										<a class="btn btn-default" href="">Printed Version</a>
										<button data-target="#signup" data-toggle="tab" type="button" class="btn btn-default" "tabindex="7">Back</button>
									</p>
								</div>
								<div class="tab-pane fade active in" id="signin">
									<fieldset>
										 <div class="omb_login">
											<div class="row omb_socialButtons">
												<div class="col-xs-4 col-sm-4">
													<a href="#" class="btn btn-lg btn-block omb_btn-facebook">
														<i class="fa fa-facebook visible-xs"></i>
														<span class="hidden-xs">Facebook</span>
													</a>
												</div>
												<div class="col-xs-4 col-sm-4">
													<a href="#" class="btn btn-lg btn-block omb_btn-twitter">
														<i class="fa fa-twitter visible-xs"></i>
														<span class="hidden-xs">Twitter</span>
													</a>
												</div>	
												<div class="col-xs-4 col-sm-4">
													<a href="#" class="btn btn-lg btn-block omb_btn-google">
														<i class="fa fa-google-plus visible-xs"></i>
														<span class="hidden-xs">Google+</span>
													</a>
												</div>	
											</div>
											<div class="row omb_loginOr">
												<div class="col-xs-12">
													<hr>
													<span>or</span>
												</div>
											</div>
											<div id="errmsg"><br></div>
											<form id="signinForm" class="omb_loginForm" action="includes/process_login.php" autocomplete="off" method="POST">
												<div class="col-xs-12">
													<div class="form-group bs-float-label">
														<label for="userid" class="float-label">Username or Email</label>
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-user"></i></span>
															<input type="text" class="form-control float-input" name="userid" id="userid" placeholder="Username or Email">
														</div>
													</div>		
													<div class="form-group bs-float-label">
														<label for="password" class="float-label">Password</label>
														<div class="input-group">
															<span class="input-group-addon"><i class="fa fa-lock"></i></span>
															<input type="password" class="form-control float-input" name="password" id="password" placeholder="Password">
														</div>
													</div>
													<button  id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
												</div>
											</form>
											<div class="row">
												<div class="col-xs-12 col-sm-6">
													<p>
														<span class="button-checkbox">
															<button type="button" class="btn" data-color="info" tabindex="7">Remember Me</button>
															<input type="checkbox" class="hidden" value="1">
														</span>
													</p>
												</div>
												<div class="col-xs-12 col-sm-6">
													<p class="omb_forgotPwd">
														<button data-target="#forgot" data-toggle="tab" type="button" class="btn btn-default" "tabindex="7">Forgot Password</button>
													</p>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
								<div class="tab-pane fade in" id="register">
									<fieldset>
									<form id="registerForm" class="omb_loginForm" action="register.php" autocomplete="off" method="POST">
										<div class="row">
											<div class="col-xs-12 col-sm-6 col-md-6">
												<div class="form-group bs-float-label">
													<label for="first_name" class="float-label">First Name</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
														<input type="text" class="form-control float-input" name="first_name" id="first_name" placeholder="First Name">
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6">
												<div class="form-group bs-float-label">
													<label for="last_name" class="float-label">Last Name</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
														<input type="text" class="form-control float-input" name="last_name" id="last_name" placeholder="Last Name">
													</div>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group bs-float-label">
													<label for="username" class="float-label">Username</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
														<input type="text" class="form-control float-input" name="username" id="username" placeholder="Username">
													</div>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group bs-float-label">
													<label for="email" class="float-label">Email Address</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
														<input type="text" class="form-control float-input" name="email" id="email" placeholder="Email Address">
													</div>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group bs-float-label">
													<label for="password_r" class="float-label">Password</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
														<input type="password" class="form-control float-input" name="password_r" id="password_r" placeholder="Password">
													</div>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group bs-float-label">
													<label for="password_confirmation" class="float-label">Confirm Password</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
														<input type="password" class="form-control float-input" name="password_confirmation" id="password_confirmation"  placeholder="Confirm Password">
													</div>
												</div>
											</div>
											<div class="padding-15">
												<div class="col-xs-3 col-sm-2 col-md-2">
													<span class="button-checkbox">
														<button type="button" class="btn" data-color="info" tabindex="7">I Agree</button>
														<input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
													</span>
												</div>
												<div class="col-xs-9 col-sm-10 col-md-10">
													By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-target="#terms" data-toggle="tab">Terms and Conditions</a> set out by this site, 	including our Cookie Use.<br/><br/>
												</div>
											</div>
											<div class="col-xs-12">
												<button id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Register</button>	
											</div>
										</div>
									</form>
									</fieldset>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<center>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</center>
						</div>
					</div>
				</div>
			</div>