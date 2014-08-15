		<?php
		require 'includes\part\header.php';
		?>
	<div class="container bg-white">
		<div class="page-header">

			<div class="pull-right form-inline">
				<div class="btn-group">
					<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
					<button class="btn btn-default" data-calendar-nav="today">Today</button>
					<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
				</div>
				<div class="btn-group">
					<button class="btn btn-warning" data-calendar-view="year">Year</button>
					<button class="btn btn-warning active" data-calendar-view="month">Month</button>
					<button class="btn btn-warning" data-calendar-view="week">Week</button>
					<button class="btn btn-warning" data-calendar-view="day">Day</button>
				</div>
			</div>

			<h3></h3>
			<small>Find Date To Game</small>
		</div>

		<div class="row">
			<div class="col-md-9">
				<div id="calendar"></div>
			</div>
			<div class="col-md-3">
				<h4>Events</h4>
				<small>Current Events</small>
				<ul id="eventlist" class="nav nav-list"></ul>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
		<?php
		require 'includes\part\footer.php';
		?>
