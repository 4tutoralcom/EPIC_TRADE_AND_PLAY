<?php
$apikey = "nqrlegzq81cg0zseyo3iqlp8";
$apiurl = "http://openapi.etsy.com/v2/listings/active?api_key=".$apikey."&limit=28&keywords=final%20fantasy";

$cachetime = @filemtime("cache.json");
$diff = time() - $cachetime;


if($diff <= 60*60) {
	// if the cache is less than 1hour we pull this data
	$results = json_decode(file_get_contents("cache.json"));
	$products = objectToArray($results);

} else {
	// otherwise pull new data from Etsy every hour
	// then write this new data into a cache.json file
	$products = array();
	$results = json_decode(file_get_contents($apiurl));
	
	$i = 0;
	
	foreach($results->results as $product){
		$products[$i]["pid"]      = $product->listing_id;
		$products[$i]["title"]    = $product->title;
		$products[$i]["url"]      = $product->url;
		$products[$i]["price"]    = $product->price;
		$products[$i]["quantity"] = $product->quantity;
		$products[$i]["endtime"]  = $product->ending_tsz;
		
		$imgs = json_decode(file_get_contents("http://openapi.etsy.com/v2/listings/".$product->listing_id."/images?api_key=".$apikey));
		
		$products[$i]["thumb"] = $imgs->results[0]->url_170x135;
		$products[$i]["image"] = $imgs->results[0]->url_570xN;
		
		$i++;
	}
	
	$jsonified = json_encode($products);
	
	$jsoncache = "cache.json";
	$fp = fopen($jsoncache, "w");
	fwrite($fp, $jsonified);
	fclose($fp);
	
	
} 


function objectToArray($d) {
	if (is_object($d)) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d);
	}

	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map(__FUNCTION__, $d);
	}
	else {
		// Return array
		return $d;
	}
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Etsy Products Search for 'Final Fantasy'</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Galindo">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>
	<div id="w">
		<h1>Custom Final Fantasy Etsy Shop</h1>
		
		<div id="products" class="clearfix">
		<?php
		
		foreach($products as $product) {
			echo "<div class=\"product\">\n";
			echo "<h2><a href=\"".$product['url']."\" target=\"_blank\">".$product['title']."</a></h2>\n";
			echo "<center><a href=\"".$product['url']."\" target=\"_blank\"><img src=\"".$product['thumb']."\" alt=\"".$product['title']." featured image\" class=\"thumb\"></a></center>\n";
			echo "<p>Price: <span class=\"price\">$".$product['price']."</span></p>\n";
			echo "<p>Quantity: ".$product['quantity']."</p>\n";
			echo "</div>\n";
		}
		?>
		
		</div>
	</div>
</body>
</html>