$(function() {
	$('.selectpicker').selectpicker({'selectedText': ''});
	var pull = $('#pull');
	var menu = $('nav ul');

	$(pull)
		.on('click', function(e) {
			e.preventDefault();
			menu.slideToggle();
		});
});
$(window)
	.resize(function() {
		var menu = $('nav ul');
		var w = $(window)
			.width();
		if (w > 320 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});
/*
$(document)
	.ready(function() {

		var counter = 0,
			$items = $('.slideshow figure'),
			numItems = $items.length;

		var showCurrent = function() {
			var itemToShow = Math.abs(counter % numItems);
			$items.removeClass('show');
			$items.eq(itemToShow)
				.addClass('show');
		};

		$('.next')
			.on('click', function() {
				counter++;
				showCurrent();
			});

		$('.prev')
			.on('click', function() {
				counter--;
				showCurrent();
			});

	});

$(document)
	.ready(function() {

		var counter = 0,
			$items = $('.quote-slideshow figure'),
			numItems = $items.length;

		var showCurrent = function() {
			var itemToShow = Math.abs(counter % numItems);
			$items.removeClass('show');
			$items.eq(itemToShow)
				.addClass('show');
		};

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
	*/
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
$.fn.Search = function(text, strict) {
	$(this)
		.find(".item")
		.hide();
	if (!strict) {
		if (this.isSearchAble() && text == null && this.hasSearchBox()) {
			var rex = new RegExp($($(this)
					.attr("data-search-box"))
				.val(), 'i');
		} else if (this.isSearchAble()) {
			var rex = new RegExp(text, 'i');
		}
		searchArea = this.attr("data-search");
		$(this)
			.find(".item")
			.filter(function() {
				found = false;
				$(this)
					.find(searchArea)
					.each(function(i) {
						if (rex.test($(this)
							.html()))
							found = true;
					});
				return found;
			})
			.show()
	} else {
		searchArea = this.attr("data-search");
		$(this)
			.find(".item")
			.filter(function() {
				found = false;
				$(this)
					.find(searchArea)
					.each(function(i) {
						if ($(this)
							.html() == text)
							found = true;
					});
				return found;
			})
			.show()
	}
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
				var toggle = $(this)
					.attr("data-toggle");
				if (toggle.indexOf("setSearch") >= 0) {
					var target = $(this)
						.attr("data-target");
					var text = $(this)
						.attr("data-value");
					var strict = ($(target)
						.attr("data-strict") == "true");
					if ($(target)
						.isSearchAble()) {
						$(target)
							.Search(text, strict)
					}
				}
				if (toggle.indexOf("bindData") >= 0) {
					var text = $(this)
						.attr("data-value");
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
				if (toggle.indexOf("fade") >= 0) {
					var frame = $(this)
						.attr("frame-target");
					var group = $(this)
						.attr("group-target");
					$(".frame" + frame + ">" + ".current")
						.removeClass("current");
					if (group != "") {
						$(".frame" + frame + ">.group" + group)
							.addClass("current");
					}
				}
			});
		$("select.selectpicker")
			.change(function() {
				var toggle = $(this)
					.find("option:selected")
					.attr("data-toggle");

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