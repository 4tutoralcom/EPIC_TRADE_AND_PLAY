<?php
function toPrice($value){
	$pos=-2;
	$valuedolar = substr($value, 0,-2);
	$valuecent = substr($value, -2);
	$value=$valuedolar.".".$valuecent;
	return $value;
}
//HEADER JSON
//--Search Variables
//url To convert upc to a game name
$upcToNameURL="https://ae.pricecharting.com/api/product?t=%1&upc=%2";//used to convert The name to an gameDB.net id;
$NameToIdURL="http://thegamesdb.net/api/GetGamesList.php?name=%1&platform=%2";
//used to convert gameDB.net id to Picture URL Information.
$IdToImage="http://thegamesdb.net/api/GetArt.php?id=%1";
// Your Unique Identifier for pricecharting.com
$uid="bc61a3b01cee207a8a1c85a42c57e7b9bcc71dfe";
//upc Obtained by GET error is thrown if this is -1
$upc = isset($_GET['upc']) ? (string)$_GET['upc'] : -1;
//GameTitle
$GameTitle="";
//ID of the game based on GameDB.net information;
$GameDataBaseId="";
//URL of Pictures "Front","Back";
$pictureURL= array();
//check to make sure the game has been found
$GameFound=False;
//The Output Array
$JSON_Array = array();
//replace%1 with the Unique Identifier  and %2 with upc of the game
$upcToNameURL=str_replace("%1",$uid,$upcToNameURL);
$upcToNameURL=str_replace("%2",$upc,$upcToNameURL);
// get JSON file with "console-name","id", and "product-name";
if($file = @file_get_contents($upcToNameURL)){
$jsonIterator = new RecursiveIteratorIterator(
	new RecursiveArrayIterator(json_decode($file, TRUE)),
	RecursiveIteratorIterator::SELF_FIRST);
}else{
	$JSON_Array["error"]="UPC";
	echo json_encode($JSON_Array);
	die();
}
//go through key {"console-name","id", and "product-name"} and get each valueue
foreach ($jsonIterator as $key => $value) {
	if((string)$key=="console-name"){
		//set Platform Name
		$Platform=$value;
		//replace spaces with + for searching
		$Platform=str_replace(" ","+",$Platform);
		//Replace "PlayStation" with "Sony+Playstation"
		if (strstr($Platform, "PlayStation") !== FALSE){
			$Platform=str_replace("PlayStation","Sony+Playstation",$Platform);
		}
		//Replace "Playstation" with "Sony+Playstation"
		elseif (strstr($Platform, "Playstation") !== FALSE){
			$Platform=str_replace("Playstation","Sony+Playstation",$Platform);
		//Add +(SNES) to the end  of Super Nintendo
		}elseif ($Platform=="Super+Nintendo"){
			$Platform.="+(SNES)";
		}elseif ($Platform=="Gamecube"){
			$Platform="Nintendo+"."GameCube";
		}elseif ($Platform=="PC+Games"){
			$Platform="PC";
		}elseif (strstr($Platform, "Xbox") !== FALSE){
			$Platform=str_replace("Xbox","Microsoft+Xbox",$Platform);
		}
		$JSON_Array["Platform"]=str_replace("+"," ",$Platform);
	}elseif((string)$key=="product-name"){
		$GameTitle=$value;
		//pricecharting.com uses "&", gamedb.net uses "and" replace "&" with "and" in the game title.
		$GameTitle=str_replace("&","and",$GameTitle);
		$JSON_Array["GameTitle"]=$value;
	}elseif((string)$key=="retail-cib-buy" ||(string)$key=="retail-loose-buy"){
		$JSON_Array[$key]=toPrice($value);
	}elseif((string)$key=="gamestop-price"){
		$JSON_Array[$key]=substr($value, 1);
	}
}
//replace %1 with the [Game's Tittle] encoded to be safe for a URL and replace %2 with the [Platform Name]
$NameToIdURL=str_replace("%2",$Platform,$NameToIdURL);
$NameToIdURL=str_replace("%1",rawurlencode($GameTitle),$NameToIdURL);

//print($NameToIdURL);

//load XML form GameDB.net to the id of the game;
$xml = new DOMDocument();
$xml->load($NameToIdURL); // path of your XML file ,make sure path is correct
$Games = $xml->getElementsByTagName( "Game" );
foreach( $Games as $game){

	$name=strtoLower($game->getElementsByTagName( "GameTitle" )->item(0)->nodeValue);
	
	if($name===strtoLower($GameTitle)){
		$GameDataBaseId= (string)$game->getElementsByTagName( "id" )->item(0)->nodeValue;
		$GameTitle = (string)$game->getElementsByTagName( "GameTitle" )->item(0)->nodeValue;
		$GameFound=True;			
		$JSON_Array['GameTitle'] = (string)$GameTitle;

		$IdToImage=str_replace("%1",$GameDataBaseId,$IdToImage);
		$xml = new DOMDocument();
		$xml->load($IdToImage); // path of your XML file ,make sure path is correct
		$base_Image_URL=$xml->getElementsByTagName( "baseImgUrl" )->item(0)->nodeValue;
		$imageTypes = array(array("boxart","side"),"banner",array("fanart","#",array("original","thumb")));
		foreach( $imageTypes as $imageType){
			if(is_array($imageType)){
				$artData = $xml->getElementsByTagName( "Images" )->item(0)->getElementsByTagName($imageType[0]);
				$pictureURL[$imageType[0]]=array();
				foreach( $artData as $art){
					if($imageType[1]=="#"){
						foreach($imageType[2] as $type){
							$pictureURL[$imageType[0]][$type]=$base_Image_URL.$art->getElementsByTagName($type)->item(0)->nodeValue;
						}
					}else{
						$pictureURL[$imageType[0]][$art->getAttribute($imageType[1])]=$base_Image_URL.$art->nodeValue;
					}
				}
			}
		}
	}
}

if($GameFound==False){

}
$JSON_Array["images"]=$pictureURL;
header("Content-Type: application/json");
echo json_encode($JSON_Array);
?> 