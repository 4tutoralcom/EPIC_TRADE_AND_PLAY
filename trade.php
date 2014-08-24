<?php
$upc = isset($_GET['upc']) ? (string)$_GET['upc'] : -1;
$GameTitle="";
$Platform="";
$front_image="";
$back_image="";
if($upc!==-1){
	$file = file_get_contents("http://localhost/includes/game.php?upc=".$upc);
	$jsonIterator = new RecursiveIteratorIterator(
		new RecursiveArrayIterator(json_decode($file, TRUE)),
		RecursiveIteratorIterator::SELF_FIRST);
	foreach ($jsonIterator as $key => $value) {
	if($key=="GameTitle")
		$GameTitle=$value;
	elseif($key=="Platform")
		$Platform=$value;
	elseif($key=="images"){
		if(isset($value["boxart"])){
			if(isset($value["boxart"]["front"]))
				$front_image=$value["boxart"]["front"];
			if(isset($value["boxart"]["back"]))
				$back_image=$value["boxart"]["back"];
		}
	}elseif($key=="error")
		if($value=="UPC"){
			echo("error");
		}
	}
}
require 'includes\part\header.php';
?>
	<div class="container bg-white main-content">
	
		<div class="coverArtContainer  col-xs-12 col-md-6">
			<?php if($upc!==-1):?>
				<img class="nentendo" src="<?php echo 'http://localhost/test.php?src='.urlencode($front_image).'&type='.urlencode($Platform)?>"></img>
			<?php else:?>
				<img class="nentendo" src="http://localhost/test.php"></img>
			<?php endif?>
			<div class="nentendo" id="title"><?php echo $GameTitle ?></div>
			<div class="nentendo" id="platform"><?php echo $Platform ?></div>
		</div>
		<div class="Pricing col-xs-12 col-md-6">

		</div>
	</div>
	
<?php
require 'includes\part\footer.php';
?>