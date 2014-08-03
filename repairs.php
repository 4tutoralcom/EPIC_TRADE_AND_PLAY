<!--<html><head>
                                <meta charset="utf-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                <title>Snippet - Bootsnipp.com</title>
                                <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
                                <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
                                <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                                <script type="text/javascript">$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});</script>
                            </head>
                            <body>-->
									<?php
		require 'includes\part\header.php';
		?>
		
	<div class="container bg-white">
	<div class="col-xs-12">
		<label for="first_sortBY">Search By : </label>
	</div>
	<div class="col-md-3 col-xs-6 frame">
		<div class="group current">
			<select class="selectpicker">
				<option selected="selected" data-toggle="fade" frame-target="#Second" group-target="">None</option>
				<optgroup label="Type" data-subtext="" data-icon="icon-ok">
					<option data-toggle="fade" frame-target="#Second" group-target="#Phone">Phone</option>
					<option data-toggle="fade" frame-target="#Second" group-target="#Tablet">Tablet</option>
					<option data-toggle="fade" frame-target="#Second" group-target="#Console">Console</option>
				</optgroup>
				<optgroup label="Attributes" data-subtext="" data-icon="icon-ok">
				<option data-toggle="fade" frame-target="#Second" group-target="#Name">Name</option>
				<option data-toggle="fade" frame-target="#Second" group-target="#Date">Date</option>
				</optgroup>
			</select>
		</div>
	</div>
	<div class="col-md-3 col-xs-6 frame" id="Second">
		<div class="group" id="Phone">
			<select class="selectpicker">
				<option selected="selected" data-toggle="fade" frame-target="#Third" group-target="">All</option>
				<optgroup label="Apple" data-subtext="" data-icon="icon-ok">
					<option>All Apple iPhones</option>
					<option data-toggle="setSearch" data-value="iPhone">iPhone</option>
					<option>iPhone 3G</option>
					<option>iPhone 3GS</option>
					<option>iPhone 4</option>
					<option>iPhone 4s</option>
					<option>iPhone 5</option>
					<option>iPhone 5c</option>
					<option>iPhone 5s</option>
				</optgroup>
				
			</select>
		</div>
		<div class="group" id="Tablet">
			<select class="selectpicker">
				<option selected="selected" data-toggle="fade" frame-target="#Third" group-target="">All</option>
				<optgroup label="Apple" data-subtext="" data-icon="icon-ok">
					<option>All Apple iPads</option>
					<option>iPad</option>
					<option>iPad 2</option>
					<option>iPad 3</option>
					<option>iPad 4</option>
					<option>iPad mini</option>
				</optgroup>
			</select>
		</div>
	</div>
	<div class="col-md-3 col-xs-6 frame">
		<div class="group">
			<select class="selectpicker">
				<optgroup label="test" data-subtext="another test" data-icon="icon-ok">
					<option>ASD</option>
					<option>Bla</option>
					<option>Ble</option>
				</optgroup>
				<optgroup label="test" data-subtext="another test" data-icon="icon-ok">
					<option>ASD</option>
					<option>Bla</option>
					<option>Ble</option>
				</optgroup>
			</select>
		</div>	
	</div>
	<div class="col-md-3 col-xs-6 frame">
		<div class="group">
			<select class="selectpicker">
				<optgroup label="test" data-subtext="another test" data-icon="icon-ok">
					<option>ASD</option>
					<option>Bla</option>
					<option>Ble</option>
				</optgroup>
				<optgroup label="test" data-subtext="another test" data-icon="icon-ok">
					<option>ASD</option>
					<option>Bla</option>
					<option>Ble</option>
				</optgroup>
			</select>
		</div>	
	</div>
		<div id="products" class="row list-group">
			<div class="item col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Iphone" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<tag id="">
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item  col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Iphone 3g" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item  col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Playstationf" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item  col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Playstation" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item  col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Playstation" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item  col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Playstation" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item  col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Playstation" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item  col-xs-6 col-md-4 col-lg-3">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/460x250/0040ff/eeeeee&amp;text=Playstation" alt="">
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							Product title</h4>
						<p class="group inner list-group-item-text">
							Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
							sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<p class="lead">
									$21.00</p>
							</div>
							<div class="col-xs-12 col-md-6">
								<a class="btn btn-success" href="http://www.jquery2dotnet.com">Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php
		require 'includes\part\footer.php';
		?>