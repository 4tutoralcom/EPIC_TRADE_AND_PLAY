<?php
require 'includes\part\header.php';
$umsg = isset($_GET['umsg']) ? (string)$_GET['umsg'] : "";
$sub = isset($_GET['sub']) ? (string)$_GET['sub'] : "";
$repairInfo = array("","");
if($sub="Repair"){
	$umsg = explode ("_",$umsg);
	$pricing = array('I4' => array('Screen' => '','Charger' => ''),
				    'I4s' => array('Screen' => '','Charger' => ''),
				     'I5' => array('Screen' => '','Charger' => ''),
				    'I5c' => array('Screen' => '','Charger' => ''),
				    'I5s' => array('Screen' => '','Charger' => ''));

	if (isset($pricing[$umsg[0]]) && isset($pricing[$umsg[0]][$umsg[1]]))
	{
		$repairInfo=$umsg;
		$repairInfo[0]=str_replace("I","Iphone ",$repairInfo[0]);
	}		   
}
?>
<div class="container h2-wrap ">
	<div class="container">
		<div class="row ">
			<div class="col-md-12">
				<h2 class="standard-block">Select a Device to Repair</h2>
			</div>
		</div>
	</div>
</div>
<div class="container bg-white main-content" id="Shop">
		 <?php if($repairInfo[0]!=="")echo("<h2>Contact us know to fix your ".$repairInfo[0]." ".$repairInfo[1]."</h2>")?>
		<div class="group" style="min-height:491px"id="Contact">
		
			<div class="panel-group" id="contact_us">
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#contact_us" href="#collapseOne">
					  Contact Us By Phone
					</a>
				  </h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in">
				  <div class="panel-body">
					<div class="col-sm-8">
						Contact us by Phone you will be a employee currently working at the store if we are open.
					</div>
					<div class="col-sm-4">
						<h2><a href="tel:<?php print($phone) ?>">#<?php print($phone) ?></a></h2>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#contact_us" href="#collapseTwo">
					  Contact us by Email
					</a>
				  </h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse">
				  <div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="well well-sm">
								<form id="ContactUs" action="includes/ContactUs.php" autocomplete="off" method="POST">
								<div class="row">
									<div class="col-sm-12">
										<div class="alert">
										   <span class="glyphicon "></span> <strong></strong>
											<hr class="message-inner-separator">
											<p></p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Name</label>
											<input type="text" value="<?php echo("")?>" class="form-control" name="name" id="name" placeholder="Enter name"/>
										</div>
										<div class="form-group">
											<label for="email">Email Address</label>
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
												</span>
												<input value="<?php echo("")?>"  type="email" class="form-control" name="email" id="email" placeholder="Enter email"/></div>
										</div>
										<div class="form-group">
											<label for="phone">Phone Number</label>
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span>
												</span>
												<input value="<?php echo("")?>"  type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number"/></div>
										</div>
										<div class="form-group popover-dismiss" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
											<label  for="subject">Subject</label>
											<select id="subject" name="subject" class="form-control" >
												<option value="na"<?php echo(($sub=="na")?"selected":"")?>>Choose One:</option>
												<option value="Question"<?php echo(($sub=="Question")?"selected":"")?>>Questions</option>
												<option value="Repair"<?php echo(($sub=="Repair")?"selected":"")?>>Repair</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Message</label>
											<textarea name="message" id="message" class="form-control" rows="12" cols="25" 
												placeholder="Message"></textarea>
										</div>
									</div>
									

									<div class="col-md-12">
										<button type="submit" id="submit" name="submit" class="btn btn-primary pull-right" id="btnContactUs">
											Send Message</button>
									</div>
								</div>
								<input type="hidden" name="type" value="<?php if($repairInfo[0]!="") echo($repairInfo[0]." ".$repairInfo[1])?>">
								</form>
							</div>
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  <?php if(!$loggedOut) : ?>
			  <!--<div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#contact_us" href="#collapseThree">
						Contact Us By Instant Messaging
					</a>
				  </h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse">
				  <div class="panel-body">
					<p>
						For a quick response, contact us by messaging a employee at our store over our websites Instant Message System.<br>
						If no employee responds this will also also email us your Question or Purchase. So we can get back with you as quickly as possible.
					</p>
				  </div>
				</div>
			  </div>-->
			
			<?php endif; ?>
			</div>
		</div>
	</div>
		<?php
		require 'includes\part\footer.php';
		?>