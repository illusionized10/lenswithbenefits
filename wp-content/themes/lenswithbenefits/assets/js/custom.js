$( document ).ready(function() {
    
    // Check to see if we are on the front page by checking the body class 
	if ($("body").hasClass("page-template-tp-front-page")) {
		// We are on the front page, start the owl carousel
		$(".owl-carousel").owlCarousel({
			video: true,
			items: 1,
			lazyLoad: true,
			loop: true,
		});
	}

	// Add border divs to active menu item after page has been loaded
	var activeMenuItem = $(".site-header ul").find('li.current_page_item');
	activeMenuItem.prepend(
		'<span class="corner TL"></span>' +
    	'<span class="corner TR"></span>' +
    	'<span class="corner BL"></span>' +
    	'<span class="corner BR"></span>'
	);

});