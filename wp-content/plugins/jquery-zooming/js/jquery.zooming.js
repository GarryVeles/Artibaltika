jQuery(function() {
	var $ = jQuery;
	jQuery.fn.zooming = function(options) {
		var options = $.extend({
			"min-width": 200,
			"max-width": 300
		}, options || {});
		
		var counter = 1;
		this.each(function(index, element) {
			var target = $(this);
			if(!target.parent().is("a[href]")) return;
			
			var preloadImage = function(url, completeCallback) {
				var img = new Image();
				img.onload = function() { completeCallback.call(); };
				img.src = url;
			};
			
			$(this).attr("data-for", counter++);
			
			
			var calculatePos = function($img) {	
				var id = $img.attr("data-for"),
					top = $img.offset().top,
					left = $img.offset().left;
					width = $img.width(),
					height = $img.height(),
					$zooming = $(".zooming-container[data-for=" + id + "]"),
					wndWidth = $(window).width(),
					wndHeight = $(window).height(),
					wndScrollY = $(window).scrollTop(),
					wndScrollX = $(window).scrollLeft();
				
				
				// Y Coordinate	
				var zTop = top - 10;
				if(wndHeight < top - wndScrollY + $zooming.outerHeight(false))
					zTop = wndScrollY + wndHeight - $zooming.outerHeight(true);
				if(top - wndScrollY < 0)
					zTop = wndScrollY;
				
				// X Coordinate
				var zLeft = left + width;
				if(wndWidth < left - wndScrollX + width + $zooming.outerWidth(true))
					zLeft =  left - $zooming.outerWidth(true);
					
				$zooming.css({
					top: zTop,
					left: zLeft
				});
			};
			
			target.hover(function(event){
				if(!$(this).hasClass('preloaded')) {
					var zoomContainer = $("<div class = 'zooming-container loading' style = 'display:none'><div class = 'preloader'></div></div>");
					zoomContainer.attr("data-for", $(this).attr("data-for") );
					
					$(this).addClass("preloaded");
					var that = this;
					preloadImage($(this).parent().attr("href"), function() {	
						var img = $("<img />");
						img.attr({"src": $(that).parent().attr("href")});
						img.css(options);
						zoomContainer.css(options);
						zoomContainer.find(".preloader").remove().end().removeClass("loading").append(img);
						
						calculatePos($(that));						
					});
					
					zoomContainer.appendTo("body");
					var id = $(this).attr("data-for");
					$(".zooming-container[data-for=" + id + "]").show();
					calculatePos($(this));
					
				}
				else {
					var id = $(this).attr("data-for");
					$(".zooming-container[data-for=" + id + "]").show();
					calculatePos($(this));
				}
			},
			function(event) {
				var id = $(this).attr("data-for");
				$(".zooming-container[data-for=" + id + "]").hide();
			});
		});
	};
});