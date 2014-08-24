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
/*
$(window)
	.resize(function() {
		var menu = $($('nav ul')[0]);
		var w = $(window)
			.width();
		if (w > 320 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});
*/	
$(document)
	.ready(function() {
		
		var counter = 0;
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
			});
		//}).change();
	});