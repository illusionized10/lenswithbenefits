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

var mobx_woo_gallery = function() {

	var woo_images = document.querySelectorAll( '.woocommerce-product-gallery__image:not(.clone) a' );

	for ( var i = 0, il = woo_images.length; i < il; i++ ) {

		var woo_image = woo_images[i],
			woo_thumb = woo_image.parentNode;

		mobx.addAttr( woo_image, {
			rel    : 'woo-gallery',
			thumb  : woo_thumb ?  woo_thumb.getAttribute( 'data-thumb' ) : '',
		});

	}

};
	
var wooTrigger = document.querySelector( '.woocommerce-product-gallery__trigger' );

if ( wooTrigger ) {

	jQuery( wooTrigger ).off( 'click' );

	wooTrigger.addEventListener( 'click', function( event ) {

		event.preventDefault();
		event.stopPropagation();
		mobx.open( 'woo-gallery', 0 );

	});

}

jQuery( document ).ready(function(){
	mobx_woo_gallery();
});

SCRIPT;
