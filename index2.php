<?php
// get JSON file with "console-name","id", and "product-name";
$upc = isset($_GET['upc']) ? (string)$_GET['upc'] : -1;
$file = file_get_contents("http://localhost/includes/game.php?upc=".$upc);
$jsonIterator = new RecursiveIteratorIterator(
	new RecursiveArrayIterator(json_decode($file, TRUE)),
	RecursiveIteratorIterator::SELF_FIRST);
//go through key {"console-name","id", and "product-name"} and get each valueue
foreach ($jsonIterator as $key => $value) {
if($key=="GameTitle")
	$GameTitle=$value;
elseif($key=="Platform")
	$Platform=$value;
elseif($key=="images")
	$image=$value;
elseif($key=="error")
	if($value=="UPC"){
?>
<?php
echo "404";
die();
	}
}
?>
<h1><?php echo $GameTitle ?></h1>
<h2><?php echo $Platform ?></h2>
<img src="<?php echo 'http://localhost/test.php?src='.urlencode($image["boxart"]["front"]).'&type='.urlencode($Platform)?>"></img>
