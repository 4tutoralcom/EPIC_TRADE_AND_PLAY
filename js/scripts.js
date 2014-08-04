
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
$.fn.isSearchAble = function() {
    return !(this.attr("data-search")==undefined);
};
$.fn.hasSearchBox = function() {
    return !(this.attr("data-search-box")==undefined);
};
$.fn.initSearch = function() {
	if(this.isSearchAble() && this.hasSearchBox()){
		var SearchBox = $(this).attr("data-search-box");
		var SearchForm=$(this);
		$(SearchBox).on("input",function(){
			SearchForm.Search()
		})
	}
}
$.fn.Search = function(text) {
	$(this).find(".item").hide();
	
	if(this.isSearchAble() && text==null && this.hasSearchBox() ){
		var rex = new RegExp($($(this).attr("data-search-box")).val(), 'i');
	}
    else if ( this.isSearchAble()) {
		var rex = new RegExp(text, 'i');
	}
	searchArea=this.attr("data-search");
	$(this).find(".item").filter(function() {
	found=false;
	$(this).find(searchArea).each(function( i ){
	if(rex.test($(this).html()))
		found=true;
	});
	return found;
	}).show()
	return this;
};
$(window).load(function() {
	$('#products').initSearch();
	$("button[data-toggle]").on("click",function(){
			var toggle = $(this).attr("data-toggle");

			if(toggle.indexOf("fade")>=0) {
				var frame = $(this).find("option:selected").attr("frame-target");
				var group = $(this).find("option:selected").attr("group-target");
				$(".frame"+frame+" "+".current").removeClass("current");
				if(group != ""){
					$(".frame"+frame+" .group"+group).addClass("current");
				}
			}
			if(toggle.indexOf("bindData")>=0){
				var uid=$(this).attr("data-value");
				alert(uid);
			}
	});
	$( "select.selectpicker" )
	.change(function () {
		if(this.used ) {
			var toggle = $(this).find("option:selected").attr("data-toggle");

			if(toggle.indexOf("fade")>=0) {
				var frame = $(this).find("option:selected").attr("frame-target");
				var group = $(this).find("option:selected").attr("group-target");
				$(".frame"+frame+" "+".current").removeClass("current");
				if(group != ""){
					$(".frame"+frame+" .group"+group).addClass("current");
					$(".frame"+frame+" .group"+group+" .selectpicker").selectpicker("val",$(".frame"+frame+" "+".group"+group + " .selectpicker option").first().val()).selectpicker("refresh");
				}
			}
			if(toggle.indexOf("setSearch")>=0){
				var target=$(this).find("option:selected").attr("data-target");
				var text=$(this).find("option:selected").attr("data-value");
				if( $(target).isSearchAble() ) {
					$(target).Search(text)
				}
			}
		}
	this.used=true;
	})
	.change();
	
});


