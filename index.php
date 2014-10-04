
		<?php
		$title="Epic Game Play Trade";
		require 'includes\part\header.php';
		
		?>
		<div class="container">
			<!-- Slider Container and Images -->
			<div>
				<div class="flexslider">
					<ul class="slides">
						<li data-thumb="images/slide1.jpg">
							<img src="images/slide1.jpg" alt="img"/>
							<div class="flex-caption-bg"><a>New Conspiracy Boosters</a></div>
						</li>
						<li data-thumb="images/slide2.jpg">
							<img src="images/slide2.jpg" alt="img"/>
							<div class="flex-caption-bg"><a>New Games Workshop</a></div>
						</li>
						<li data-thumb="images/slide3.jpg">
							<img src="images/slide3.jpg" alt="img"/>
							<div class="flex-caption-bg"><a>?</a></div>
						</li>
						<li data-thumb="images/slide4.jpg">
							<a href="repairs.php"><img src="images/slide4.jpg" alt="img"/></a>
							
						</li>
					</ul>
				</div>
			</div>
			<div class="arrow"></div>
		</div>
		<!--<div class="container text-inter">
			<div class=" bg-white">
				<div class="row">
					<div class="col-md-4 col-xs-12">
						<div class="ca-hover">
							<div class="carousel-img">
								<img src="img/c01.jpg" alt="Carousel Img">
							</div>
							<div class="carousel-avatar av1">
							</div>
							<div class="carousel-content">
								<h3></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa.</p>
							</div>
							<div class="overlay"></div>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="ca-hover">
							<div class="carousel-img">
								<img src="img/c02.jpg" alt="Carousel Img">
							</div>
							<div class="carousel-avatar av2">
							</div>
							<div class="carousel-content">
								<h3>Lorem ipsum dolor sit amet consectetur</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa.</p>
							</div>
							<div class="overlay"></div>
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<div class="ca-hover">
							<div class="carousel-img">
								<img src="img/c03.jpg" alt="Carousel Img">
							</div>
							<div class="carousel-avatar av3">
							</div>
							<div class="carousel-content">

							</div>
							<div class="overlay"></div>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<div class="container text-inter ">
			<div class="container bg-white">
				<div class="row">
					<div class="col-md-8">
						<h3>About Us</h3>
						<p>Here at Epic Trading and Repair we specialize in iPhones and Samsung Galaxy repair. Anything from Screen to charge port on any phone. We also do console repairs on almost all consoles and almost any problem with the consoles. We accept video games and video game consoles from Atari on up for cash or in store credit. For pricing and any questions give us a call at <a href="tel:<?php print($phone) ?>">#<?php print($phone) ?></a>.</p>
					</div>
					<div class="col-md-4" style="height:40vh;">
					<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:100%;width:100%;"><div id="gmap_canvas" style="height:100%;width:100%;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.trivoo.net" id="get-map-data">trivoo.net2010</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(38.451547,-90.30710199999999),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(38.451547, -90.30710199999999)});infowindow = new google.maps.InfoWindow({content:"<b>Epic Game Play Trade</b><br/>6197 Telegraph Rd<br/>63129 st. Louis" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
					</div>
				</div>
			</div>
		</div>
		<!--
		<div class="container h2-wrap ">
			<div class="container">
				<div class="row ">
					<div class="col-md-12">
						<h2 class="standard-block">LATEST ARTICLES</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="container bg-white">
			<div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/01.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/02.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/03.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/04.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/05.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/06.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/07.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/08.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/09.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/10.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/11.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6 article-img">
					<a href="#">
						<img src="img/articles/12.jpg" alt="">
						<div class="article-overlay"></div>
					</a>
				</div>
			</div>
		</div>-->
		<?php
		require 'includes\part\footer.php';
		?>
		
		<?php if($RequestType=="c" || $RequestType=="a") : ?>
		<?php if($RegistrationSuccessful): ?>
		<meta http-equiv="refresh" content="5;url=/" />
		<?php endif;?>
		<script type="text/javascript">//<![CDATA[ 
		$(window).load(function(){
		$(document).ready(function(){
		  $('#ModalSignIn').modal('show')
		});
		});//]]>
		</script>
		<?php endif;?>