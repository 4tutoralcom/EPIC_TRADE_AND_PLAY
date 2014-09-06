<?php
include('simple_html_dom.php');
$row = 1;
$console_name = isset($_GET['console-name']) ? (string)$_GET['console-name'] : "";
$product_name = isset($_GET['product-name']) ? strtolower((string)$_GET['product-name']) : "";
$page = isset($_GET['p']) ? intval((string)$_GET['p']) : "";
$CellOrder=array();
$JSON_Array=array();
$Console_pic=array();
$curentConsoleName="";
function getArt($id,$console, $GameTitle,&$Console_pic,&$curentConsoleName, &$grabFormWeb=1){	
	$found=false;
	$idUrlPair=array();
	$imgUrl="";
	$STOP=false;
	//echo(($curentConsoleName==$console)?count($Console_pic).",":"n");
	if (($handle = fopen("pic/".$console."_pic.csv", "r")) !== FALSE && $curentConsoleName==$console && count($Console_pic)==0) {		
		while (($data = fgetcsv($handle, 1000, ",")) !== False) {
			array_push($Console_pic, array($data[0]=>$data[1]));
		}
		fclose($handle);	
	}
	if(isset($Console_pic[$id])){
	echo("y");
		$imgUrl=$Console_pic[$id];
		$found=($imgUrl!=="");
	}else{
	$curentConsoleName=$console;
		if (($handle = fopen("pic/".$console."_pic.csv", "r")) !== FALSE) {		
			while (($data = fgetcsv($handle, 1000, ",")) !== False) {
				$item=array();
				$num = count($data);
				if($num==2 && $data[0]==$id){
					$imgUrl=$data[1];
					break;
				}
			}
			fclose($handle);
			$found=($imgUrl!=="");
		}
	}
	if(!$found && $grabFormWeb>0){
		$grabFormWeb--;
		$cons=str_replace(" ","-",$console);
		$title=str_replace(" ","-",$GameTitle);
		$title=str_replace("/","",$title);
		$title=str_replace(".","",$title);
		$title=str_replace("?","",$title);
		$title=str_replace("!","",$title);
		$title=str_replace(",","",$title);
		$title=str_replace(":","",$title);
		$url = "http://videogames.pricecharting.com/game/$cons/$title";
		//echo($id."|".$url."\n");
		//$html = file_get_html("http://nimishprabhu.com");
		$dom = str_get_html(file_get_contents($url));
		if(is_object($dom)){
			$img = $dom->find('#product_details > div > img');
			if(is_array($img) && count ($img)>0 && is_object($img[0])){
			
				$imgUrl=$img[0]->getAttribute("src");
				
				$fp = fopen("pic/".$console."_pic.csv", 'a');
				fputcsv($fp, array($id,$imgUrl));
				fclose($fp);
			}
		}else{
		die($url);
		}
	}
	return $imgUrl;
}
set_time_limit(600);
header("Content-Type: application/json");
if (($handle = fopen("price-guide.csv", "r")) !== FALSE) {
    if (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />1\n";
			array_push($CellOrder,$data[$c]);
        }
    }
	$r=200;
	$page-=1;
	$page*=24;
	$itemcounter=0;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE && $itemcounter < ($page+25)) {
	//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

		
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
					if($itemcounter>$page){
						if(!isset($item["image"])){
							$curentConsoleName=$item["console-name"];
							$item["image"]=getArt($item["id"],$item["console-name"],$item["product-name"],$Console_pic,$curentConsoleName,$r);
						}
				
						array_push($JSON_Array,$item);
						//echo($item["id"].",".$item["product-name"].",".$item["console-name"].",".$itemcounter.">=".$page."\n");
						
					}
					$itemcounter++;
				}
			}
		
		
    }
	
    fclose($handle);
}

echo json_encode($JSON_Array);
?>