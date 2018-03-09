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

});