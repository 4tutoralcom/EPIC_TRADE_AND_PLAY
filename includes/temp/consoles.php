<?php
include('simple_html_dom.php');

function getArt($console, $GameTitle){
	$cons=str_replace(" ","-",$console);
	$title=str_replace(" ","-",$GameTitle);
	$url = "http://videogames.pricecharting.com/game/$cons/$title";
	//$html = file_get_html("http://nimishprabhu.com");
	$dom = str_get_html(file_get_contents($url));
	$img = $dom->find('#product_details > div > img');
	if(is_array($img) && count ($img)>0 && is_object($img[0])){
	
		return $img[0]->getAttribute("src");
	}
	return "";
}


$row = 1;
$console_name = isset($_GET['console-name']) ? (string)$_GET['console-name'] : "";
$product_name = isset($_GET['product-name']) ? strtolower((string)$_GET['product-name']) : "";
$CellOrder=array();
$JSON_Array=array();
header("Content-Type: application/json");
if (($handle = fopen("price-guide.csv", "r")) !== FALSE) {
    if (($data = fgetcsv($handle, 10000000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />1\n";
			array_push($CellOrder,$data[$c]);
        }
    }
	$r=12;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$item=array();
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
			$item[$CellOrder[$c]]=$data[$c];
            //echo $CellOrder[$c].":".$data[$c] . "<br />\n";
        }
		
		if($console_name==="" || $item["console-name"]==$console_name){
			if($product_name==="" || strpos(strtolower($item["product-name"]),$product_name)){
			if($r>0 && !isset($item["image"])){
				$r--;
				$item["image"]=getArt($item["console-name"],$item["product-name"]);
				
			}
				array_push($JSON_Array,$item);
				
			}
			
		}
    }
	
    fclose($handle);
}

echo json_encode($JSON_Array);
?>

