
		<?php
		$title="Epic Game Play Trade";
		require 'includes\part\header.php';
		
		?>
<div class="container bg-white">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <div class="row">
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </div>
                </thead>
			</table>
					<?php //include "includes\shopping-cart.php"?>
                    <div class="row">
                        <div class="col-xs-5 col-md-8">   </div>
                        <div class="col-xs-4 col-md-2"><h5>Subtotal</h5></div>
                        <div class="col-xs-1" class="text-right"><h5><strong>$24.59</strong></h5></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-md-8">   </div>
                        <div class="col-xs-4 col-md-2"><h5>Estimated shipping</h5></div>
                        <div class="col-xs-1" class="text-right"><h5><strong>$6.94</strong></h5></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-md-8">   </div>
                        <div class="col-xs-4 col-md-2"><h3>Total</h3></div>
                        <div class="col-xs-1" class="text-right"><h3><strong>$31.53</strong></h3></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-md-8">   </div>
                        <div class="col-xs-4 col-md-2">
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button></div>
                        <div class="col-xs-1">
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></div>
                    </div>
        </div>
    </div>
</div>
		<?php
		require 'includes\part\footer.php';
		?>
