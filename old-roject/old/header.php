<?php
function startsWith($haystack, $needle){
    return !strncmp($haystack, $needle, strlen($needle));
}

function endsWith($haystack, $needle){
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

require_once('./php-class/template.php');
$temp = new Template('./php-template/header.tpl');
$file = file_get_contents('./php-properties/header.json');
$menu_links = array();$tab=0;$i=0;

if(!isset($TITLE)){
	$TITLE="";
}

$nav="<ul id='nav' class='sf-menu'>\n";//begining of the navigation menu.

$jsonIterator = new RecursiveIteratorIterator(
	new RecursiveArrayIterator(json_decode($file, TRUE)),
	RecursiveIteratorIterator::SELF_FIRST);	

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) { //if is a tab?
		if(startsWith($key,"|list")){ //and if is a list inside of a tab?
			$nav=$nav."\n<ul>\n";
			$tab++;
		}else{//or if is a  main tab 
			if(startsWith($key,"|")){ //main tabs use | infront
			$key = substr($key, strlen('|'));
				$tab--;
				if($tab < 0){
					$tab=0;
				}else{
				$nav=$nav."</ul>\n</li>\n"; //ending ul; and li for break
				}
				$nav=$nav."</li>\n<li[s".$i."]><a href='[href".$i."]'><span> $key </span></a>"; // [s] checks to see if the item is selected. href sets the link to be replaced later
				$i++;
			}else{// else the item is a dropdown list link.
				$nav=$nav."<li><a href='[href".$i."]'><span> $key </span></a></li>\n"; // href sets the link to be replaced later. 
				$i++;
			}
		}
    } else { //else the item is an arrtibute
		if("$key" == "href"){ //if the item is a href
			array_push($menu_links,"$val"); //save it in a array for later.
		}
    }
}
unset($key); unset($val); //unset key and val.


$nav=$nav . "</ul>\n"; // end the navigatin menu.
$temp->setTag("nav",$nav); // sets [nav] tag in template to navigation menu.
$i=0; //reset counter 'i'
foreach ($menu_links as &$value) { // for each link that was saved to an array.
	if (basename($_SERVER['REQUEST_URI']) == basename("$value")){ // if the link is the page the user is currently on then 
		$temp->setTag("s". $i,' class="current-menu-item"'); //set the item as current-menu-item. this will add a bar over the tab to signify it is selected.
	}else{ 
		$temp->setTag("s". $i,""); //else set the item to blank to remove the [s#] tag
	}
	$temp->setTag("href". $i,"$value"); //set the link locaton of all the tabs.
	$i++;
}
unset($i); unset($value); //unset i and value

 $temp->setTag("logo","img/logo.png"); // change logo the logo of the website.
 $temp->setTag("title","$TITLE"); // set title of the page.
 echo $temp->output();
?>