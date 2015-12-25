(function($) {
	$.fn.postsSlider = function(options) {
		options = $.extend({
			easing	: 'jswing',
			pages	: true,
			navs	: true,
			speed	: 'normal'
		}, options || {});
		
		// Common Functions
		// Build HTML Markup
		var buildHTML = function(target) {
			target.find("ul").wrap("<div class = 'pager-slides' />");
			target.find(".pager-slides").wrap("<div class = 'posts-pager' />");
			
			if(options.pages) {
				var pages = $("<div class = 'pager-pages'></div>");
				target.find(".posts-pager").append(pages);
				
				
				
				var containerW  = target.width(),
					slideW		= target.find(".pager-slides li:not(.posts-pager-clearfix)").outerWidth(true),
					slidesW		= target.find(".pager-slides li:not(.posts-pager-clearfix)").size()  * slideW,
					numPages 	= Math.ceil(slidesW / containerW ),
					pages		= $("<ul></ul>");
					
				if(numPages == 1)
					return ;
				pages.prepend("<li><a href = '#' title = 'first'></a></li>");
				for(var i = 0; i < numPages; i++) 
					pages.append("<li " + (i == 0 ? "class = 'active'" : "") + "><a href = '#' title = '" + i + "'></a></li>");
				pages.append("<li><a href = '#' title = 'last'></a></li>");	
				pages.append("<li class = 'posts-pager-clearfix'></li>");
				target.find(".pager-pages").append(pages);
			}
			
			if(options.navs) {
				target.find(".posts-pager").append("<a href = '#' class = 'prev-nav-link'></a>")
										   .append("<a href = '#' class = 'next-nav-link'></a>");
			}
			
			
		},
		// Go To Page
		paginate = function(target, page) {
			if(target.find(".pager-slides ul").is(":animated"))
				return;
		
				
			var containerW  = target.width(),
				slideW		= target.find(".pager-slides li:not(.posts-pager-clearfix)").outerWidth(true),
				slidesW		= target.find(".pager-slides li:not(.posts-pager-clearfix)").size()  * slideW,
				numPages 	= Math.ceil(slidesW / containerW );
			
			if(page == 'first')	
				page = 0;
				
			if(page == 'last') 
				page = numPages - 1;
			
			
			if(page == (numPages - 1))
				offsetX = containerW - slidesW;	
			else
				offsetX = -page * containerW;
				
			target.find(".pager-slides ul").animate({
				left: offsetX
			}, options.speed, options.easing);
		},
		
		// Navigate Width Navs
		navigate = function(target, direction) {
			if(target.find(".pager-slides ul").is(":animated"))
				return;
			var containerW  = target.width(),
				slideW		= target.find(".pager-slides li:not(.posts-pager-clearfix)").outerWidth(true),
				slidesW		= target.find(".pager-slides li:not(.posts-pager-clearfix)").size()  * slideW,
				numPages 	= Math.ceil(slidesW / containerW );
				
			
			
			var list = target.find(".pager-slides ul"),
				shift = (direction == 'prev' ? -1 : 1) * slideW;
			

			console.log(shift);			
			
			
			target.find(".pager-slides ul").animate({
				left: list.position().left + shift
			}, options.speed, options.easing, function() {
				if(list.position().left > 0)
					list.animate({left: 0});
				else if(list.position().left < containerW - slidesW )
					list.animate({left: containerW - slidesW});
			});
			
		},
			
		// Attach Behavior
		attachBehavior = function(target) {
			target.find('.pager-pages a').click(function(event) {
				var page = $(this).attr("title");
				paginate(target, page);
				$(this).parent().siblings().removeClass("active");
				$(this).parent().addClass('active');
				event.preventDefault();
			});
			
			target.find('.prev-nav-link').click(function(event) {
				navigate(target, 'next');
				event.preventDefault();
			});
			
			target.find('.next-nav-link').click(function(event) {
				navigate(target, 'prev');
				event.preventDefault();
			});
		};
			
			
		this.each(function(){
			var target = $(this);
			buildHTML(target);
			attachBehavior(target);
		});
	};
	
	
})(jQuery);