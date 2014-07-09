<?php
	$TITLE = "Shop";
	$MAINTAGS= array();
	require_once('./php-class/template.php');
	require_once('./header.php'); //add header and head class
	$tags = array(); $unTags = array(); $subtags = array(); $temp = new Template('');//declares default VARS
	//OUT OF DATE
	$file = file_get_contents('./php-properties/items_sales.json'); //gets items data
	$jsonIterator = new RecursiveIteratorIterator(
	new RecursiveArrayIterator(json_decode($file, TRUE)),
	RecursiveIteratorIterator::SELF_FIRST);	
	
	
	foreach ($jsonIterator as $key => $val) {
		if(!is_array($val) && "$key"=="class") { //if is a tab and tag is a calss?
			$tags = array_unique(array_merge((array)$tags,(array)explode(" ","$val")));
		}
	}
	//OUT OF DATE
	foreach ($tags as $tag) {
		if( strstr("$tag","_") != "") {
			$d=strstr("$tag","_",true);
			array_push($unTags, "$d");
		}else{
			array_push($unTags,"$tag");
		}
	}
	$unTags=array_unique($unTags);
		echo '<!-- MAIN -->
		<div id="main">
			<div class="wrapper cf">
			
			<!-- portfolio content-->
        	<div id="portfolio-content" class="cf">
			
				<ul id="filter-buttons">
					<li><a href="#" data-filter="*" class="selected">show all</a></li>
					';
					foreach ($unTags as $utag) {		
						echo "<li><a href='#' data-filter='.$utag'>$utag</a>";	
						$subtags = array();
						foreach ($tags as $tag) {
							echo(strstr("$tag","web_") != "");
							if( strstr("$tag","$utag"."_") != ""){
								array_push($subtags,"<li><a href='#' data-filter='.$tag'>" . ltrim(strstr("$tag","_"),"_") . "</a></li>");
							}
						}
						if (count($subtags) > 0) {
						array_push($MAINTAGS,$utag);
							echo "<ul>";
							foreach ($subtags as $stag){
								echo $stag . "\n";
							}
							echo "</ul>";
						}
						echo "";
					}
					
				echo '</ul>
				<!-- Filter container -->
				<div id="filter-container" class="cf">';
				function replaceList($tag,$file_c,$MAINTAGS){
					//$tags = array();
					$file = file_get_contents($file_c); //gets items data
					$jsonIterator = new RecursiveIteratorIterator(
					new RecursiveArrayIterator(json_decode($file, TRUE)),
					RecursiveIteratorIterator::SELF_FIRST);	
					$id=""; $color=""; $text="";
					foreach ($jsonIterator as $key => $val) {
						if(is_array($val) ) {
						$id=$key;
						}else if(!is_array($val) && "$key"=="color") { //if is a tab and tag is a calss?
							$color=$val;
						}else if(!is_array($val) && "$key"=="text") { //if is a tab and tag is a calss?
							$text=$val;
							$tag=str_replace("$id","<spawn style='[c]:$color;'>$text</span>",$tag);//adds a [c] to use later as color attribute. so repalce funciton dose not remove it.
							$id=""; $color=""; $text="";
						}		
					}
					$tag=str_replace($MAINTAGS,"",$tag);
					$tag=str_replace("[c]","color",$tag);
					return $tag;
					
				}
					foreach ($jsonIterator as $key => $val) {
						if(!is_array($val) ) { //if is a tab?
							if("$key"=="class"){
								$temp->setTag("TAGS",$val);
								$tags = array_unique((array)explode(" ","$val"));
								$usTags = array();
								foreach ($tags as $tag) {
									array_push($usTags, replaceList($tag,"./php-properties/tag_colors.json",$MAINTAGS));
								}
								$usTags=array_filter(array_map('trim', $usTags));
								$temp->setTag("TAGTEXT",'<a href="#" >'.implode("</a>, ".'<a href="#" >' ,$usTags));
								

							} else if("$key"=="href"){
								$temp->setTag("ID","$val");
							} else if("$key"=="image"){
								$temp->setTag("IMG","$val");
							}
						}else{
						$temp->setTag("NAME","$key");
						echo $temp->output();
						$temp = new Template('./php-template/item.tpl');
						}
					}
				?>
				</div><!-- ENDS Filter container -->
			</div>
			<!-- ENDS featured -->
			</div><!-- ENDS WRAPPER -->
		</div>
		<!-- ENDS MAIN -->
		<?php
			require_once('./footer.php');
		?>
</body>
