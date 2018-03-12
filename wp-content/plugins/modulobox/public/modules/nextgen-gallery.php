<?php
/**
 * @package   ModuloBox
 * @author    Themeone <themeone.master@gmail.com>
 * @copyright 2017 Themeone
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return <<<'SCRIPT'

var mobx_ngg_galleries = function() {

	var ngg_galleries = document.getElementsByClassName( 'ngg-galleryoverview' );

	for ( var g = 0, gl = ngg_galleries.length; g < gl; g++ ) {

		var ngg_links = ngg_galleries[g].querySelectorAll( '.ngg-gallery-thumbnail a' );

		for ( var l = 0, ll = ngg_links.length; l< ll; l++ ) {

			var ngg_link  = ngg_links[l];

			if ( ngg_link ) {

				mobx.addAttr( ngg_link, {
					rel    : 'ngg-gallery-' + ( g + 1 ),
					title  : ngg_link.getAttribute( 'data-title' ),
					desc   : ngg_link.getAttribute( 'data-description' ),
					thumb  : ngg_link.getAttribute( 'data-thumbnail' )
				});

			}

		}

	}

};

var mobx_ngg_images = function() {
	
	var ngg_images = document.querySelectorAll( '.ngg-imagebrowser [id^="ngg-image"] a' );

	for ( var i = 0, il = ngg_images.length; i < il; i++ ) {
	
		var ngg_link  = ngg_images[i];

		if ( ngg_link ) {

			mobx.addAttr( ngg_link, {
				rel    : 'ngg-image-' + ( i + 1 ),
				title  : ngg_link.getAttribute( 'data-title' ),
				desc   : ngg_link.getAttribute( 'data-description' ),
				thumb  : ngg_link.getAttribute( 'data-thumbnail' )
			});

		}
	
	}

};

var mobx_ngg_links = function() {

	// Unbind jQuery click event to prevent opening default lightbox
	jQuery( '.ngg-gallery-thumbnail a' ).off( 'click' );
	jQuery( '.ngg-imagebrowser [id^="ngg-image"] a' ).off( 'click' );

}

jQuery( document ).ready( function() {
	mobx_ngg_links();
});

jQuery( document ).ajaxSuccess( function( event, xhr, settings ) {

    if ( settings && settings.url && settings.url.indexOf( 'nggallery' ) >= 0 ) {

		// small delay to be sure to run code after nextgen
		setTimeout(function(){

			mobx_ngg_links();
			mobx_ngg_galleries();
			mobx_ngg_images();
			mobx.getGalleries();

		}, 50);

    }

});

mobx_ngg_galleries();
mobx_ngg_images();

SCRIPT;
