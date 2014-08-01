
$(function() {
	$('.selectpicker').selectpicker({
		'selectedText': 'cat'
	});
  var pull = $('#pull');
  var menu = $('nav ul');
        
          $(pull).on('click', function(e) {
              e.preventDefault();
              menu.slideToggle();
          });
      });
$(window).resize(function(){
  var menu = $('nav ul');
  var w = $(window).width();
    if(w > 320 && menu.is(':hidden')) {
          menu.removeAttr('style');
        }
      });

$(document).ready(function(){
 
var counter = 0,
$items = $('.slideshow figure'),
numItems = $items.length;
 
var showCurrent = function(){
var itemToShow = Math.abs(counter%numItems);
$items.removeClass('show');
$items.eq(itemToShow).addClass('show');
};
 
$('.next').on('click', function(){
counter++;
showCurrent();
});
 
$('.prev').on('click', function(){
counter--;
showCurrent();
});
 
});

$(document).ready(function(){
 
var counter = 0,
$items = $('.quote-slideshow figure'),
numItems = $items.length;
 
var showCurrent = function(){
var itemToShow = Math.abs(counter%numItems);
$items.removeClass('show');
$items.eq(itemToShow).addClass('show');
};
 
$('.quote-next').on('click', function(){
counter++;
showCurrent();
});
 
$('.quote-prev').on('click', function(){
counter--;
showCurrent();
});
 
});

$(window).load(function() {
	$( "select.selectpicker" )
	.change(function () {
		if(this.used ) {
			var toggle = $(this).find("option:selected").attr("data-toggle");
			var frame = $(this).find("option:selected").attr("frame-target");
			var group = $(this).find("option:selected").attr("group-target");
			if(toggle=="fade"){
				$(".frame"+frame+" "+".current").removeClass("current")
				if(group != "")
					$(".frame"+frame+" "+".group"+group).addClass("current")
			}
		}
	this.used=true;
	})
	.change();
	
});