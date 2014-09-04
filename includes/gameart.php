<?php
include('simple_html_dom.php');
function getArt($console, $GameTitle){
$cons=str_replace(" ","-",$console);
$title=str_replace(" ","-",$GameTitle);;



$url = "http://videogames.pricecharting.com/game/$cons/$title";
echo($url);
$output=file_get_contents($url);
echo($output);
$dom = str_get_html(file_get_contents($url));
$tables = $dom->find('#product_details > div > img');
echo $tables[0]->getAttribute("src");
}
$console_name="Nintendo 64";
$product_name="1080 Snowboarding";
getArt($console_name,$product_name)
?>