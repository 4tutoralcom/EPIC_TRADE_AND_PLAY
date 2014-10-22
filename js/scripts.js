var counter=0;
var page=0;
var console_name="";
$(function() {
	$('.selectpicker').selectpicker({'selectedText': ''});
	var pull = $('#pull');
	var menu = $($('nav ul')[0]);

	$(pull)
		.on('click', function(e) {
			e.preventDefault();
			menu.slideToggle();
		});
});

$(window)
	.resize(function() {
		var menu = $($('nav ul')[0]);
		var w = $(window)
			.width();
		if (w > 320 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});

$(document)
	.ready(function() {
		
		counter = 0;
		load_auction_nudge_feedback();
		
		var showCurrent = function() {
			var $items = $("#auction-nudge-feedback tbody tr").not(":first-child");
			var numItems = ($items.length/2);

			var itemToShow = Math.abs(counter % numItems);
			$items.hide();
			$("#auction-nudge-feedback tbody tr").not(":first-child").slice(itemToShow*2,itemToShow*2+2).show()
		};
		showCurrent();
		var showCurrentifLoad =function(){
			var $items = $("#auction-nudge-feedback tbody tr").not(":first-child");
			if($items.length<0)
				setTimeout(showCurrentifLoad,2);
			else
				showCurrent();
		}
		var nextFeedbackItem =function(){
			counter++;
			showCurrent();
			setTimeout(nextFeedbackItem,4600);
		}
		setTimeout(showCurrentifLoad,10);
		setTimeout(nextFeedbackItem,4600);
		$('.quote-next')
			.on('click', function() {
				counter++;
				showCurrent();
			});

		$('.quote-prev')
			.on('click', function() {
				counter--;
				showCurrent();
			});
		
	});
$.fn.isSearchAble = function() {
	return !(this.attr("data-search") == undefined);
};
$.fn.hasSearchBox = function() {
	return !(this.attr("data-search-box") == undefined);
};
$.fn.initSearch = function() {
	if (this.isSearchAble() && this.hasSearchBox()) {
		var SearchBox = $(this)
			.attr("data-search-box");
		var SearchForm = $(this);
		$(SearchBox)
			.on("input", function() {
				SearchForm.Search()
			})
	}
}
$.fn.getInvisible = function(){
	 return this.filter( ":hidden" );
}
$.fn.getVisible = function(){
	return this.filter( ":visible" );
}
$.fn.isNotAnimated = function(){
	return this.filter(function(){
		var found=true;
		if($(this).parent().hasClass("ui-effects-wrapper")) 
			found=false;
		return found;
	});
}
$.fn.isAnimated = function(){
	return this.filter(function(){
		var found=false;
		if($(this).parent().hasClass("ui-effects-wrapper")) 
			found=true;
		return found;
	});
}
$.fn.Search = function(text, strict,drop) {
	drop=(drop!==undefined)? drop:true;
	var items=$();
	if (!strict) {
		if (this.isSearchAble() && text == null && this.hasSearchBox()) {
			var rex = new RegExp($($(this).attr("data-search-box")).val(), 'i');
		} else if (this.isSearchAble()) {
			var rex = new RegExp(text, 'i');
		}
		filterFunction = function(i) {found = found || (rex.test($(this).html()));};
	}else{
		filterFunction = function(i) {found = found || ($(this).html() == text);};
	}
	
	searchArea = this.attr("data-search");
	items = $(this)
		.find(".item")
		.filter(function() {
			found = false;
			$(this)
				.find(searchArea)
				.each(filterFunction);
			return found;
		});
	if(drop){
		items.isNotAnimated().getInvisible().show("slide", { direction: "down" }, 400);
		items.isAnimated().show();
	}else
		items.getInvisible().show();
	hiddingItems=$(this)
	.find(".item")
	.filter(function() {
		return !items.is($(this))
	})
	if(drop){
		hiddingItems.isNotAnimated().getVisible().hide("slide", { direction: "up" }, 400);
		hiddingItems.isAnimated().show();
	}else
		hiddingItems.getVisible().hide();
	
	return this;
};
$(window)
	.load(function() {
		$('#products')
			.initSearch();
		$(".productpicture")
			.on("click", function() {
				$(this)
					.parent()
					.find("button")
					.click()
			})
		$("button[data-toggle]")
			.on("click", function() {
				var toggle = $(this).attr("data-toggle");
				if (toggle.indexOf("fade") >= 0) {
					var frame = $(this).attr("frame-target");
					var group = $(this).attr("group-target");
					$(".frame" + frame + ">" + ".current").removeClass("current");
					if (group != "") {
						$(".frame" + frame + ">.group" + group).addClass("current");
					}
				}
				if (toggle.indexOf("setSearch") >= 0 || toggle.indexOf("setSearch-noDrop") >= 0) {
					drop=!(toggle.indexOf("setSearch-noDrop") >= 0)
					var target = $(this).attr("data-target");
					var text = $(this).attr("data-value");
					var strict = ($(target).attr("data-strict") == "true");
					if ($(target).isSearchAble()) {
						$(target).Search(text, strict, drop)
					}
				}
				if (toggle.indexOf("bindData") >= 0) {
					var text = $(this).attr("bind-data-value");
					obj = JSON.parse(text);
					for (var k in obj) {
						if (obj.hasOwnProperty(k)) {
							if (obj[k].indexOf("/v/") == 0)
								$(k).val(obj[k].slice(3, obj[k].length));
							else if (obj[k].indexOf("/i/") == 0)
								$(k).html(obj[k].slice(3, obj[k].length));
						}
					}
				}
			});
		$("select.selectpicker")
			.change(function() {
				
					var splitHash=location.hash.split("|");
					page=(splitHash.length==2)?parseInt(splitHash[1]):1;
					console_name=(splitHash.length==2)?splitHash[0].replace("#",""):"None";
				var toggle = $(this).find("option:selected").attr("data-toggle");

				if (toggle.indexOf("fade") >= 0) {
					var frame = $(this)
						.find("option:selected")
						.attr("frame-target");
					var group = $(this)
						.find("option:selected")
						.attr("group-target");
					$(".frame" + frame + ">" + ".current")
						.removeClass("current");
					if (group != "") {
						$(".frame" + frame + ">.group" + group)
							.addClass("current");
						$(".frame" + frame + ">.group" + group + " .selectpicker")
							.selectpicker("val", $(".frame" + frame + " " + ".group" + group + " .selectpicker option")
								.first()
								.val()
							)
							.selectpicker("refresh");
					}
				}
				if (toggle.indexOf("setSearch") >= 0) {
					var target = $(this)
						.find("option:selected")
						.attr("data-target");
					var text = $(this)
						.find("option:selected")
						.attr("data-value");
					if ($(target)
						.isSearchAble()) {
						$(target)
							.Search(text)
					}
				}
				if(toggle.indexOf("loadGamesFromJson") >= 0){
					page=location.hash.split("|");
					page=(page.length==2)?parseInt(page[1]):1;
					
					var frame = $(this)
						.find("option:selected")
						.attr("frame-target");
					var group = $(this)
						.find("option:selected")
						.attr("group-target");
					location.hash = "#" + group+"|"+page;
					var file="\\includes\\temp\\consoles.php?console-name=";
					file+=group;
					file+="&p="+page;
					//remove all product images and add a loading page
					$("#products .column").remove();
					/*
					var game='<div class="col-xs-12 column">';
					game+="<h1 id='updater' style='text-align: center;width: 100%;font-size: 8.2em;'>LOADING</h1>";
					game+='</div>';
					$( game).appendTo( "#products" );
					var c=0;
					var updater =function(){
						
						$("#updater").text("LOADING"+Array(c%6).join("."));
						c++;
						setTimeout(updater,900);
					}
					setTimeout(updater,100);
					*/
					var game='<div id="updater" style="margin-top:8em" class="col-xs-12 column"></div>';
					$( game).appendTo( "#products" );
					var opts = {
					  lines: 13, // The number of lines to draw
					  length: 0, // The length of each line
					  width: 30, // The line thickness
					  radius: 53, // The radius of the inner circle
					  corners: 0.6, // Corner roundness (0..1)
					  rotate: 0, // The rotation offset
					  direction: 1, // 1: clockwise, -1: counterclockwise
					  color: '#000', // #rgb or #rrggbb or array of colors
					  speed: 1.1, // Rounds per second
					  trail: 51, // Afterglow percentage
					  shadow: false, // Whether to render a shadow
					  hwaccel: false, // Whether to use hardware acceleration
					  className: 'spinner', // The CSS class to assign to the spinner
					  zIndex: 2e9, // The z-index (defaults to 2000000000)
					  top: '50%', // Top position relative to parent
					  left: '50%' // Left position relative to parent
					};
					var target = document.getElementById('updater');
					var spinner = new Spinner(opts).spin(target);
					$.getJSON( file, function( data ) {
						$("#products .column").remove()
						$(".pagination").children().remove();
						var items = {};
						var pages=0;
						$.each( data, function( k, v ) {
							$.each( v, function( key, val ) {
								items[key] = val;
							});
							if(items["id"]){
								var game='<div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3 column">';
								game+='<a style="width:300px;" href="/trade.php?id='+items["id"]+'"><img src="'+items["image"]+'" onerror="this.src='+"'/images/notfound.jpg';"+'" class="img-responsive productpicture"></a>';
								game+='<div class="producttitle">'+items["product-name"]+'</div>';
								game+='<div class="productprice">';
								game+='<div>';
								game+='<a href="trade.php?id='+items["id"]+'"class="btn btn-block btn-danger btn-sm">Sell This Game</a></div>';
								game+='</div>';
								game+='</div>';
								$( game).appendTo( "#products" );
								items = [];
							}else{
							
								pages=parseInt(items["pages"]);
								cpage=page;
								previous=0;
								pagesAfter=pages;
								var ext=1;
								if(pages>=12){
									pagesAfter=6;
									if(cpage>3){
										$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|"+(cpage-1)+"'>&laquo;</a></li>");
										$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|1'>1</a></li>");
										$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|"+pages+"'>...</a></li>");
									}else{
										cpage=1;
										pagesAfter+=3;
									}
								
									if(page<=pages && page >= pages-3)
										pagesAfter++
									
									if(page >= pages-3){
										cpage=pages-3;
									}
									cpage=(cpage>=pages-5)?cpage-5:cpage;
								}
								
								if(pages<12){
									ext=((pages-(pages%12))/12);
									var space= pages/6;
									ext=(ext==0)?1:ext;
									if(pages<=6){
										ext=(ext==1)?((pages<=6)?Math.floor(12/pages):1):ext;
									}
									$(".pagination").append("<li class='col-filler-"+((12-pages*ext)/2).toString().replace('.','_')+"'></li>");
								}else{
									$(".pagination").append("<li></li>");
								}
								firstPageTabNumber=(cpage-1+pagesAfter<=pages)?cpage:pagesAfter+1-pages;
								for (i = firstPageTabNumber; i < (firstPageTabNumber+pagesAfter); i++) {
									$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|"+i+"'>"+i+"</a></li>")
								}
								
								if(pages>=12){
									if(page>=pages-3){
										$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|"+(pages-1)+"'>"+(pages-1)+"</a></li>");
									}else
										$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|"+pages+"'>...</a></li>");
									$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|"+pages+"'>"+pages+"</a></li>");
									
									if(page < pages-3)
										$(".pagination").append("<li><a class='col-xs-"+ext+"' href='trade.php#"+group+"|"+(page+1)+"'>&raquo;</a></li>");
								}
							}
						});
						/*if(page<pages){
							location.hash="#"+console_name+"|"+(page+1);
						}*/
					});
				}
				
			//});
		}).change();
	});
	
	function locationHashChanged() {
		var curConsole_name=console_name;
		var splitHash=location.hash.split("|");
		var cpage=(splitHash.length==2)?parseInt(splitHash[1]):1;
		console_name=(splitHash.length==2)?splitHash[0].replace("#",""):"None";
		
		if(!($("select.selectpicker").val()==console_name)){
			$("select.selectpicker").val(console_name).change();
			
		}
		if(page!=cpage){
			$("select.selectpicker").val(console_name).change();
		}else{
			location.hash = "#" + console_name+"|"+1;
		}
}

window.onhashchange = locationHashChanged;
locationHashChanged();