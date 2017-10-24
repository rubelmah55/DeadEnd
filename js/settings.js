jQuery(function($){
	$('.cart_toggler').hover(function(){

		var data = {
	   	'action': 'mode_theme_update_mini_cart'
		 };
		 $.post(
		   woocommerce_params.ajax_url, // The AJAX URL
		   data, // Send our PHP function
		   function(response){
		     $('.header_shopping_cart_content').html(response); // Repopulate the specific element with the new content
		   }
		 );
	})
});
	/**
	 * Slider Slick
	 *
	 */
	$('.headline-wrap').on('init', function(e, slick) {
        var $firstAnimatingElements = $('.slide:first-child').find('[data-animation]');
        doAnimations($firstAnimatingElements);    
    });
    $('.headline-wrap').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
        var $animatingElements = $('.slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
        doAnimations($animatingElements);    
    });
    function doAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function() {
            var $this = $(this);
            var $animationDelay = $this.data('delay');
            var $animationType = 'animated ' + $this.data('animation');
            $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay
            });
            $this.addClass($animationType).one(animationEndEvents, function() {
                $this.removeClass($animationType);
            });
        });
    };
