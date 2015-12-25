
(function($) {

	$.fn.cycler = function ( options ) {
	
		options = $.extend({delay: 1000, speed: 1000, 'easing': 'easeInQuad', height: "100%", "width": "33.33%"}, options || {});
		
		this.each(function( index, element ) {
			
			var target 		= $(this),
				items 		= target.find("li"),
				itemWidth 	= items.width(),
				itemHeight  = items.height(),
				itemsCount	= items.size(),
				itemsWidth	= itemWidth * itemsCount,
				
				scrollLeft	= function ( complete ) {
					
					complete = complete || function () { /* Nothing */ };
					
					items.each(function(index) {
						
						var left = $(this).position().left;
						
						$(this).animate({
							left: left - itemWidth
						}, {
							easing	: options.easing,
							duration: options.speed,
							complete: index == itemsCount - 1 ? complete : function() { },
							step: function(now, tween) {
							
								if( now < -itemWidth  )
									tween.now = tween.now + itemsWidth;
							}
						})
					});
					
				};
				
			// Recalculate Item Positions
			items.each(function(index) {
				$(this).css( {"left": index * itemWidth + "px", height: options.height , "width": options.width } );
			});
			
			
			// Start Animation
			var step = function () {
			
				var next = function () { window.setTimeout(step, options.delay); };
				
				scrollLeft( next );
				
			};
			
			step();
			
			
		});
	}

})(jQuery);