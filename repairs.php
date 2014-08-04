<?php
require 'includes\part\header.php';
require_once('includes/template.php');

$file = file_get_contents('includes/temp/shopItem.json');
$jsonIterator = new RecursiveIteratorIterator(
	new RecursiveArrayIterator(json_decode($file, TRUE)),
	RecursiveIteratorIterator::SELF_FIRST);
$tempShop = new Template('includes/temp/shopItem.tpl');
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
	<div class="container bg-white">
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
											$producttitle="123";
											foreach ($jsonIterator as $key => $val) {
												if(!is_array($val)) {
														if($key=="type"){
															if(!in_array($val,$types)){
																$values[$val]= array();
																$tempType->setTag($key,$val);
																array_push($types,$val);
																$tempSet=true;
															}
															
															if(!is_array($values[$val][$company])){
																$values[$val][$company]= array();
															}
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
				foreach ($jsonIterator as $key => $val) {
					if(!is_array($val)) {
							//print_r($key." | ".$val."\n");
							$tempShop->setTag($key,$val);
					}elseif($firstTemp){
						echo $tempShop->output();
						$tempShop = new Template('includes/temp/shopItem.tpl');
					}
					$firstTemp=true;
				}
				echo $tempShop->output();
			?>
		</div>
	</div>
		<?php
		require 'includes\part\footer.php';
		?>