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

var mobx_jetpack_galleries = function() {

	var jp_galleries = document.getElementsByClassName( 'tiled-gallery' );

	for ( var g = 0, gl = jp_galleries.length; g < gl; g++ ) {

		// Remove data carousel attr to prevent opening lightbox
		jp_galleries[g].removeAttribute( 'data-carousel-extra' );

		var jp_images = jp_galleries[g].querySelectorAll( '.tiled-gallery-item img' );

		for ( var i = 0, il = jp_images.length; i < il; i++ ) {

			var jp_image = jp_images[i],
				jp_link  = jp_image.parentElement,
				desc     = jp_image.getAttribute( 'data-image-description' ),
				caption  = jp_link.nextElementSibling;
				caption  = caption ? caption.innerHTML : '';
				

			jp_link.href = jp_image.getAttribute( 'data-large-file' );

			mobx.addAttr( jp_link, {
				rel    : 'wp-gallery-' + ( g + 1 ),
				src    : jp_image.getAttribute( 'data-large-file' ),
				title  : jp_image.title,
				desc   : desc ? desc.replace( /(<p[^>]*>|<\/p>)/g, '' ) : caption,
				thumb  : jp_image.getAttribute( 'data-medium-file' )
			});

		}

	}

};

jQuery( document ).ready(function(){
	mobx_jetpack_galleries();
});

SCRIPT;
