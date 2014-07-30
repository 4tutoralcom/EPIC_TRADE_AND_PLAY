<?php
							if(isset($_POST['add'])){
								$add = filter_input(INPUT_POST, 'add', FILTER_SANITIZE_STRING);
								if($add=="true") {
									$uid = substr(md5(uniqid(mt_rand(1, mt_getrandmax()))), 0, 8);
									$stmt=$mysqli->prepare("SELECT `ip_address`, `uid` FROM `allowed_ip_adresses` WHERE  `uid`=? OR (`id`=? AND `ip_address`=?)");
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
												$stmt=$mysqli->prepare("DELETE FROM `allowed_ip_adresses` WHERE `ip_address`=? AND `uid`=? AND `id`=?");
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
												$stmt=$mysqli->prepare("INSERT INTO `allowed_ip_adresses` (`id`, `ip_address`, `allowed`, `uid`) VALUES (?,?,0,?)");
												if($stmt){
													$stmt->bind_param('iss',$user_id, $ip_address, $uid);
													if($stmt->execute()){
														$error_msg="
														<div class='tab-pane fade active in' id='add'>
															<fieldset>
																<form id='addForm' class='omb_loginForm' action='includes/addComputer.php' autocomplete='off' method='POST'>
																	<div class='row'>
																		<div class='col-xs-12' id='info'>
																			You need to allow this IP Address to Continue. <br> 
																			Check your email for a 8 digit 'Access Code. Input that 'Access Code into the box below.<br>
																			$msg<br>
																		</div>
																		<div class='col-xs-12' id='errmsg'><br></div>
																		<div class='col-xs-12'>
																			<div class='form-group bs-float-label'>
																				<label for='access' class='float-label'>Access Code</label>
																				<div class='input-group'>
																					<span class='input-group-addon'><i class='fa fa-user'></i></span>
																					<input type='text' class='form-control float-input' name='access' id='access' placeholder='Access Code' autocomplete='off'>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class='row'>
																		<div class='col-xs-12 col-sm-6'>
																			<div class='padding-15'>
																				<button data-target='#signin' data-toggle='tab' onclick='".'$("#add").remove()'."' type='button' class='btn btn-default' 'tabindex='7'>Back</button>
																				<button  id='submit' class='btn btn-primary' type='submit'>Recover Password</button>
																			</div>
																		</div>
																	</div>
																</form>
															</fieldset>
														</div>";
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
?>