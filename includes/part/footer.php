	
<footer>
	<div class="quote-container">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-10 col-md-offset-1">
						<div class="quote-slideshow">							
							<div id="auction-nudge-feedback" class="auction-nudge">
								<a href="http://www.auctionnudge.com/your-ebay-feedback">Auction Nudge eBay Feedback Loading ...</a>
							</div>
						</div>
						<span class="quote-prev circle"><i class="fa fa-angle-left fa-2x"></i></span>
						<span class="quote-next circle"><i class="fa fa-angle-right fa-2x"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="shadow"></div>
		
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-3">
						<a href="/">
							<div class="logo no-border">
								<h2 class="logo-text">EPIC</h2>
								<div class="logo-dec">Game &#8901; Trade &#8901; Repair</div>
							</div>
						</a>
					</div>
					<div class="col-sm-4">
						<p>Nam mi enim, auctor non ultricies a, fringilla eu risus. Praesent vitae lorem et elit tincidunt accumsan suscipit eu libero. Maecenas diam est, venenatis vitae dui in, vestibulum mollis arcu. Donec eu nibh tincidunt, dapibus sem eu, aliquam dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur commodo eros, vitae laoreet lectus aliq</p>
					</div>
					<div class="col-sm-4 col-md-3">
						<p>aliquam dolor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur commodo eros, vitae laoreet lectus aliq</p>
					</div>
					<div class="col-sm-4 col-md-2">
						<ul class="footer-links">
							<li><a href="/scheduled.php">Scheduled</a></li>
							<li><a href="#">Page Two</a></li>
							<li><a href="#">Design</a></li>
							<li><a href="#">Work</a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		
		<script type="text/JavaScript" src="js/sha512.js"></script> 
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.core.js"></script>
		<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.slide.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/bootstrap-select.js"></script>
		<script type="text/javascript" src="/includes/auctionudge.php"></script>
		<script src="js/scripts.js"></script>
		
		<script type="text/JavaScript" src="js/labelFloat.js"></script>
		<script type="text/JavaScript" src="js/userForm.js"></script>
		
				<!-- Flexslider JS -->
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
            // $('.selectpicker').selectpicker('hide');
        });
		</script>
		<!--calander-->
		<script src='js/moment.min.js'></script>
		<script src='js/fullcalendar.js'></script>
		<script src='js/gcal.js'></script>
		<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			events: 'https://www.google.com/calendar/feeds/0mnpe92s8c1igvu0b1eis9fac0%40group.calendar.google.com/public/basic',
			
			eventClick: function(event) {
				// opens events in a popup window
				window.open(event.url, 'gcalevent', 'width=700,height=600');
				return false;
			},
			
			loading: function(bool) {
				//$('#loading').toggle(bool);
			}
			
		});
		
	});

</script>
<style>		
	#loading {
		display: none;
		position: absolute;
		top:0;
		right:0;
		height:100%;
		width:100%;
		z-index:3;
	}
</style>
		<!--calander-->
		
	</body>
</html>