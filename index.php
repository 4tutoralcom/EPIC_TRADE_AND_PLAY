<!DOCTYPE html>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
$loggedOut = !login_check($mysqli);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Infusion WP Theme</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/queries.css">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Flexslider CSS-->
		<link rel="stylesheet" href="css/flexslider.css" type="text/css">
		<link rel="stylesheet" href="css/labelFloat.css" type="text/css">
		<link href="css/userDropDownMenu.css" rel="stylesheet">
	</head>
	<body>
		<?php
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
							<img src="images/slide4.jpg" alt="img"/>
							<div class="flex-caption-bg"><a>?</a></div>
						</li>
					</ul>
				</div>
			</div>
			<div class="arrow"></div>
		</div>
		<div class="container text-inter">
			<div class=" bg-white">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="ca-hover">
							<div class="carousel-img">
								<img src="img/c01.jpg" alt="Carousel Img">
							</div>
							<div class="carousel-avatar av1">
							</div>
							<div class="carousel-content">
								<h3>Lorem ipsum dolor sit amet consectetur</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa.</p>
							</div>
							<div class="overlay"></div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
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
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="ca-hover">
							<div class="carousel-img">
								<img src="img/c03.jpg" alt="Carousel Img">
							</div>
							<div class="carousel-avatar av3">
							</div>
							<div class="carousel-content">
								<h3>Lorem ipsum dolor sit amet consectetur</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa.</p>
							</div>
							<div class="overlay"></div>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="ca-hover">
							<div class="carousel-img">
								<img src="img/c04.jpg" alt="Carousel Img">
							</div>
							<div class="carousel-avatar av4">
							</div>
							<div class="carousel-content">
								<h3>Lorem ipsum dolor sit amet consectetur</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa.</p>
							</div>
							<div class="overlay"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container text-inter ">
			<div class="container bg-white">
				<div class="row">
					<div class="col-md-6">
						<h3>Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed.</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa. Nullam condimentum mauris et rhoncus sagittis. Sed eu metus in diam tincidunt egestas non at odio. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
						<div class="divider"></div>
						<a href="#" class="button solid-color col-xs-12">BUTTON</a>
						<a href="#" class="button extra-color col-xs-12">BUTTON</a>
					</div>
					<div class="col-md-6">
						<h3>Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed.</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa. Nullam condimentum mauris et rhoncus sagittis. Sed eu metus in diam tincidunt egestas non at odio.</p>
						<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean vitae lectus erat. Duis consequat laoreet velit. Mauris convallis, sapien sit amet scelerisque accumsan, felis urna aliquet nunc, viverra mollis odio tellus a nisl. Nulla lobortis lectus non rutrum viverra. Sed et molestie libero. Sed ut ultrices dui.</p>
					</div>
				</div>
			</div>
		</div>
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
		</div>
		<div class="container quote-container">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-10 col-md-offset-1">
							<div class="quote-slideshow">
								<figure class="show">
									<h2>Nam mi enim, auctor non ultricies a, fringilla eu risus. Praesent vitae lorem et elit tincidunt accumsan suscipit eu libero. </h2>
									<figcaption>
										Nam mi enim, auctor non ultricies.
									</figcaption>
								</figure>
								<figure>
									<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris mattis suscipit est, ut imperdiet tortor. Proin sed molestie massa.</h2>
									<figcaption>
										Nam mi enim, auctor.
									</figcaption>
								</figure>
							</div>
						</div>
						<span class="quote-prev circle"><i class="fa fa-angle-left fa-2x"></i></span>
						<span class="quote-next circle"><i class="fa fa-angle-right fa-2x"></i></span>
					</div>
				</div>
			</div>
		</div>
		<div class="container shadow"></div>
		<footer class="container">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-2">
						<h2>INFUSION</h2>
					</div>
					<div class="col-sm-4 col-md-5">
						<p>Nam mi enim, auctor non ultricies a, fringilla eu risus. Praesent vitae lorem et elit tincidunt accumsan suscipit eu libero. Maecenas diam est, venenatis vitae dui in, vestibulum mollis arcu. Donec eu nibh tincidunt, dapibus sem eu, aliquam dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur commodo eros, vitae laoreet lectus aliq</p>
					</div>
					<div class="col-sm-4 col-md-3">
						<p>aliquam dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur commodo eros, vitae laoreet lectus aliq</p>
					</div>
					<div class="col-sm-4 col-md-2">
						<ul class="footer-links">
							<li><a href="#">List One</a></li>
							<li><a href="#">Page Two</a></li>
							<li><a href="#">Design</a></li>
							<li><a href="#">Work</a></li>
							<li><a href="#">Contact Me</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<!--
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		-->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Flexslider JS --> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/jquery.flexslider.js"></script>
		<!-- Load the flexslider -->
		<script type="text/javascript">
			//fix for signin button
			//$(".signin").css("float","right");
			$(window).load(function() {
			$('.flexslider').flexslider({
			  animation: "fade",  // slide or fade
			  controlNav: "thumbnails",
			  controlsContainer: ".flex-container" // the container that holds the flexslider
			});
			});
		</script>
		<script type="text/JavaScript" src="js/labelFloat.js"></script>
		<script type="text/JavaScript" src="js/sha512.js"></script> 
		<script type="text/JavaScript" src="js/userForm.js"></script>
		<script type="text/JavaScript" src="js/signinMenu.js"></script>
	</body>
</html>