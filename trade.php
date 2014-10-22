<?php
	
	
	$id = isset($_GET['id']) ? (string) $_GET['id'] : -1;
	
	$GameTitle = "";
	$Platform  = "";
	$image     = "";
	$UPC	   = "";
	$uid = 0;
	$title="Trade in : Menu";
	
	if ($id !== -1) {
	    $file         = file_get_contents("http://localhost/includes/temp/consoles.php?id=" . $id);
	    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($file, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
	    foreach ($jsonIterator as $key => $value) {
	        if ($key == "product-name")
	            $GameTitle = $value;
	        elseif ($key == "upc")
	            $UPC = $value;
	        elseif ($key == "console-name")
	            $Platform = $value;
	        elseif ($key == "image") {
	            $image = $value;
	        } elseif ($key == "error")
	            if ($value == "id") {
	                echo ("error");
	            }
	    }
		if($GameTitle==""){
			$id =-1;
			
		}else{
		$title="Trade in : $Platform-$GameTitle";
		}
	}
	
	require 'includes\part\header.php';
	
	if($id === -1)	{
		require_once('includes/template.php');
	    $file         = file_get_contents('includes/temp/consoles.json');
	    $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($file, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
	    
	    $tempShop      = new Template('includes/temp/SearchItem.tpl');
	    $typeTempplate = '<option data-toggle="loadGamesFromJson" frame-target="#Second" group-target="[name]">[name]</option>';
	    $tempType      = new Template($typeTempplate);
	    
	    $groupTemplate       = '
	<div class="group" id="[Type]">
	    <select class="selectpicker">
	        <option data-toggle="setSearch" data-target="#products" data-value="[Type]">All</option>
	        [optionGroup]
	    </select>
	</div>';
	    $optionGroupTempalte = '<optgroup label="[companyName]" data-subtext="" data-icon="icon-ok">[items]</optgroup>';
	    $optionTemplate      = '<option data-toggle="setSearch" data-target="#products" data-value="[name]">[name]</option>';
	}
	
	
	?>
<div class="container bg-white main-content">
	<?php if ($id !== -1): ?>
	<div class="row button-row">
		<div class="col-xs-1"></div>
			<div class="col-xs-5 col-sm-4 col-md-3">
			<a href="/trade.php#<?php echo $Platform;?>|1" class="btn btn-block btn-xs btn-default"><span class="glyphicon glyphicon-arrow-left"></span>Shop in <?php echo $Platform;?></a>
		</div>
	</div>
	<div class="col-xs-6 col-sm-5 col-md-4">
		<div class="coverArtContainer ">
			<img class="gameContainer" src="<?php echo $image; ?>"></img>
			<div class="gameContainer" id="title"><?php echo $GameTitle;?></div>
			<div class="gameContainer" id="platform"><?php echo $Platform;?></div>
		</div>
	</div>
	<div class="Pricing col-xs-6 col-sm-7 col-md-8">
	<form id="addToCart" class="omb_loginForm" action="includes/add_to_cart.php" autocomplete="off" method="GET">
	<hidden name="game_id" id="game_id" value="<?php echo $id ?>">
		<div id="errmsg"><br></div>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<label for="first_name">Quantity:</label>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="input-group number-spinner">
						<span class="input-group-btn">
							<button class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
						</span>
						<input type="text" class="form-control text-center" value="1">
						<span class="input-group-btn">
							<button class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
						</span>
					</div>
				</div>
			</div>
			<div class="lower row">
				<?php if($UPC!="none"):?>
				<div class="col-xs-4">
					<label>UPC:</label>
				</div>
				
				<div class="col-xs-8">
					<div class="label-text"><?php echo $UPC;?></div>
				</div>
				<?php endif;?>
			</div>
			<div class="lower row">
				<div class="col-xs-12 col-md-4"><label>Do You Have The Origional:</label></div>
				<div class="btn-block btn-group" data-toggle="buttons-checkbox">
					<div class="col-xs-12 col-md-4 ">
						<button type="button" class="btn btn-block btn-default" name="has_case" id="has_case">Artwork and Case</button>
					</div>
					<div class="col-xs-12 col-md-4 ">
						<button type="button" class="btn btn-block btn-default" name="has_book" id="has_book">Instruction Booklet</button>
					</div>
					<div class="col-xs-12 col-md-4 ">
						<button type="button" class="btn btn-block btn-default" name="has_game" id="has_game">Working Game</button>
					</div>		
				</div>
			</div>
			<div class="lower row">
				<div class="col-xs-4 col-md-1"><label>Price:</label></div>
				<div class="col-xs-8 col-md-2"><label>$Price</label></div>
				<div class="col-xs-12  col-md-8">
				
					<button id="submit" class="btn btn-md btn-primary btn-block" type="submit">Add To Cart</button>	
				</div>
			</div>
		</form>
	</div>
	<?php else: ?>
	<div class="frame" id="Shop">
		<div class="group current" id="Search">
			<h1 id="tittle">Select Game</h1>
			<div class="row">
				<div class="col-xs-12">
					<label for="first_sortBY">Search By : </label>
				</div>
				<div class="col-md-6 col-xs-6 frame">
					<div class="group current">
						<select class="selectpicker">
							<option selected data-toggle="fade setSearch" data-target="#products" data-value="" frame-target="#Second" group-target="">None</option>
							<optgroup label="Type" data-subtext="" data-icon="icon-ok">
								<?php
									$tempSet      = false;
									$values       = array();
									$types        = array();
									$producttitle = "";
									$company      = "Games";
									foreach ($jsonIterator as $key => $val) {
									    if (!is_array($val)) {
									        if ($key == "name") {
									            $tempType->setTag($key, $val);
									            $tempSet = true;
									        }
									    } elseif ($tempSet) {
									        echo $tempType->output();
									        $tempType = new Template($typeTempplate);
									        $tempSet  = false;
									    }
									    
									}
									if ($tempSet)
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
						foreach ($values as $type => $TypeArray) {
						    $tempGroup = new Template($groupTemplate);
						    $tempGroup->setTag("Type", $type);
						    $optionGroup = "";
						    foreach ($TypeArray as $companyName => $itemsArray) {
						        $tempOptionGroup = new Template($optionGroupTempalte);
						        $tempOptionGroup->setTag("companyName", $companyName);
						        $items = "";
						        foreach ($itemsArray as &$name) {
						            $tempOption = new Template($optionTemplate);
						            $tempOption->setTag("name", $name);
						            
						            $items .= $tempOption->output();
						        }
						        $tempOptionGroup->setTag("items", $items);
						        $optionGroup .= $tempOptionGroup->output();
						    }
						    
						    $tempGroup->setTag("optionGroup", $optionGroup);
						    echo $tempGroup->output();
						}
						?>
					<div id="Text">
						<div class="bs-float-label">
							<label for="search" class="float-label">Search Name</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-search" id="search button"></i></span>
								<input type="text" class="form-control float-input" name="SearchName" id="SearchName" placeholder="Search Name" autocomplete="off">
							</div>
						</div>
					</div>
				</div>
			</div>
			<ul class="pagination">
			</ul>
			<div class="gamesList" id="products" class="row list-group">
			</div>
			<ul class="pagination">
			</ul>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php require 'includes\part\footer.php'; ?>