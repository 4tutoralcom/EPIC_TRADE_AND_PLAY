<?php
require 'includes\part\header.php';
require_once('includes/template.php');
$uid=0;
$file = file_get_contents('includes/temp/shopItem.json');
$jsonIterator = new RecursiveIteratorIterator(
	new RecursiveArrayIterator(json_decode($file, TRUE)),
	RecursiveIteratorIterator::SELF_FIRST);
$tempShop = new Template('includes/temp/SearchItem.tpl');
$typeTempplate='<option data-toggle="fade" frame-target="#Second" group-target="#[type]">[type]</option>';
$tempType = new Template($typeTempplate);

$groupTemplate='
<div class="group" id="[Type]">
	<select class="selectpicker">
		<option selected="selected" data-toggle="setSearch" data-target="#products" data-value="[Type]">All</option>
		[optionGroup]
	</select>
</div>';
$optionGroupTempalte='<optgroup label="[companyName]" data-subtext="" data-icon="icon-ok">[items]</optgroup>';
$optionTemplate='<option data-toggle="setSearch" data-target="#products" data-value="[name]">[name]</option>';



?>
	<div class="frame container bg-white" id="Shop">
		<div class="group current" id="Search">
			<h1 id="tittle">Select Device</h1>
			<div class="row">
			<div class="col-xs-12">
				<label for="first_sortBY">Search By : </label>
			</div>
				<div class="col-md-6 col-xs-6 frame">
					<div class="group current">
						<select class="selectpicker">
							<option selected="selected" data-toggle="fade setSearch" data-target="#products" data-value="" frame-target="#Second" group-target="">None</option>
							<optgroup label="Type" data-subtext="" data-icon="icon-ok">
										<?php
											$tempSet=false;
												$values= array();
												$types = array();
												$producttitle="";
												foreach ($jsonIterator as $key => $val) {
													if(!is_array($val)) {
															if($key=="type"){
																if(!in_array($val,$types)){
																	$values[$val]= array();
																	echo $tempType->getTag("producttitle");
																	if($tempType->getTag($key)==null)
																		$tempType->setTag($key,$val);
																	
																	array_push($types,$val);
																	$tempSet=true;
																}
																if(!isset($values[$val]))
																		$values[$val]= array();
																		
																if(!isset($values[$val][$company]))
																	$values[$val][$company]= array();
																
																//print('$values['.$val.']['.$company.'],'.$producttitle);
																array_push($values[$val][$company],$producttitle);
															}elseif($key=="producttitle"){
																$producttitle=$val;
																//print("\r\nproducttitle:".$val."|");
															}elseif($key=="company"){
																$company=$val;
																//print("company:".$val."|");
															}
													}elseif($tempSet){
														echo $tempType->output();
														$tempType = new Template($typeTempplate);
														$tempSet=false;
													}
													
												}
												if($tempSet)
												echo $tempType->output();
											?>
							</optgroup>
							<optgroup label="Attributes" data-subtext="" data-icon="icon-ok">
								<option data-toggle="fade" frame-target="#Second" group-target="#Text">Text</option>
							</optgroup>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-xs-6 frame" id="Second">
					<?php
						foreach ($values as $type=>$TypeArray) {
							$tempGroup = new Template($groupTemplate);
							$tempGroup->setTag("Type",$type);
							$optionGroup="";
							foreach ($TypeArray as $companyName=>$itemsArray) {
								$tempOptionGroup = new Template($optionGroupTempalte);
								$tempOptionGroup->setTag("companyName",$companyName);
								$items="";
								foreach ($itemsArray as &$name) {
									$tempOption = new Template($optionTemplate);
									$tempOption->setTag("name",$name);
									$items.=$tempOption->output();
								}
								$tempOptionGroup->setTag("items",$items);
								$optionGroup.=$tempOptionGroup->output();
							}
							
							$tempGroup->setTag("optionGroup",$optionGroup);
							echo $tempGroup->output();
						}
					?>
					<div class="group" id="Text">
							<div class="bs-float-label">
								<label for="search" class="float-label">Search Text</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-search"></i></span>
									<input type="text" class="form-control float-input" name="search" id="search" placeholder="Search Text" autocomplete="off">
								</div>
							</div>
					</div>
				</div>
			</div>
			<div id="products" class="row list-group" data-search-box="#search" data-search=".type, .producttitle">
				<?php
				$firstTemp=false;
				$skip=0;
					foreach ($jsonIterator as $key => $val) {
						if(!is_array($val)) {
								//print_r($key." | ".$val."\n");
								if($tempShop->getTag($key)==null)
									$tempShop->setTag($key,$val);
						}elseif($firstTemp && $key!=="repair" && $skip===0){
							$tempShop->setTag("uid",$uid++);
							echo $tempShop->output();
							$tempShop = new Template('includes/temp/SearchItem.tpl');
						}elseif($key==="repair"){
							$skip=count($val);
						}elseif($skip!==0 ){
							$skip= ($skip > 0 ? $skip-1 : 0);
						}
						$firstTemp=true;
					}
					$tempShop->setTag("uid",$uid++);
					echo $tempShop->output();
				?>
			</div>
		</div>
		<div class="group" id="Repair">
			<h1>Select Repair</h1>
			<button data-toggle="fade" data-value="" frame-target="#Shop" group-target="#Search" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
			<div class="row list-group" data-search="#uid" data-strict="true">
				<?php
				$firstTemp=false;
				$skip=0;
				$skipStart=0;
				$uid=-1;
				$productTittle="";
				$email=(!$loggedOut) ? $_SESSION['email'] : "";
				$FirstName=(!$loggedOut) ? $_SESSION['FirstName'] : "";
				$LastName=(!$loggedOut) ? $_SESSION['LastName'] : "";
				
				$tempShop = new Template('includes/temp/ShopItem.tpl');
					foreach ($jsonIterator as $key => $val) {
						if(!is_array($val)) {
								//print_r($key." | ".$val."\n");
								$tempShop->setTag($key,$val);
								if($key=="producttitle"){
									$productTittle=$val;
								}
						}elseif($firstTemp && $key!=="repair" && $skip===0){
						}elseif($firstTemp && $key!=="repair" && $skip!=0){
							$tempShop->setTag("uid",$uid);
							if($skipStart!=$skip){
								$tempShop->setTag("producttitle",$productTittle);
								$tempShop->setTag("FirstName",$FirstName);
								$tempShop->setTag("LastName",$LastName);
								$tempShop->setTag("email",$email);
								if($tempShop->getTag("image")==null)
									$tempShop->setTag("image","http://placehold.it/460x250/0040ff/eeeeee&text=");
								echo $tempShop->output();
							}
							$tempShop = new Template('includes/temp/ShopItem.tpl');
							$skip= ($skip > 0 ? $skip-1 : 0);
						}elseif($key==="repair"){
							$uid++;
							$skip=count($val)+1;
							$skipStart=$skip;
						}
						$firstTemp=true;
					}
				?>
			</div>
		</div>
		<div class="group" id="Contact">
			<h1 id="tittle">Tittle</h1>
			<button data-toggle="fade" frame-target="#Shop" group-target="#Repair" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
			<p>
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
							Contact us by phone.
						</div>
						<div class="col-sm-4">
							<h2><a href="tel:555-555-5555">#555-555-5555</a></h2>
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
												<input type="text" class="form-control" name="name" id="name" placeholder="Enter name"/>
											</div>
											<div class="form-group">
												<label for="email">Email Address</label>
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
													</span>
													<input type="email" class="form-control" name="email" id="email" placeholder="Enter email"/></div>
											</div>
											<div class="form-group popover-dismiss" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
												<label  for="subject">Subject</label>
												<select id="subject" name="subject" class="form-control" >
													<option value="na" selected>Choose One:</option>
													<option value="Question">Questions</option>
													<option value="Repair">Set Up</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="name">Message</label>
												<textarea name="message" id="message" class="form-control" rows="9" cols="25" 
													placeholder="Message"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<button type="submit" id="submit" name="submit" class="btn btn-primary pull-right" id="btnContactUs">
												Send Message</button>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					  </div>
					</div>
				  </div>
				  <?php if(!$loggedOut) : ?>
				  <div class="panel panel-default">
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
				  </div>
				
				<?php endif; ?>
				</div>
			</p>
		</div>
	</div>
		<?php
		require 'includes\part\footer.php';
		?>