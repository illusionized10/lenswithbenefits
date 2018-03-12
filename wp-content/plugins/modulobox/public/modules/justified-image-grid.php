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

var mobx_jig_gallery = function() {

	var jig_galleries = document.querySelectorAll( '.justified-image-grid' );

	for ( var g = 0, gl = jig_galleries.length; g < gl; g++ ) {

		var jig_links = jig_galleries[g].querySelectorAll( '.jig-imageContainer a.jig-link' );

		for ( var l = 0, ll = jig_links.length; l < ll; l++ ) {

			var jig_link  = jig_links[l],
				jig_image = jig_link.firstElementChild;

			mobx.addAttr( jig_link, {
				rel    : 'jig-gallery-' + ( g + 1 ),
				title  : jig_image.title || jig_image.alt,
				desc   : jig_link.title,
				poster : jig_image.src,
				thumb  : jig_image.src
			});

			// Unbind jQuery click event to prevent opening default lightbox
			jQuery( jig_link ).off( 'click' );

		}

	}

};

var mobx_jig_loadMore = function() {

	// Add a delay before to fetch newly appended item from JIG
	setTimeout(function(){

		mobx_jig_gallery();
		mobx.getGalleries();

	}, 100);

};

var jigLoadMore = document.querySelectorAll( '.jig-loadMoreButton' );

if ( jigLoadMore ) {

	for ( var j = 0, jt = jigLoadMore.length; j < jt; j++ ) {
		jigLoadMore[j].addEventListener( 'click', mobx_jig_loadMore );
	}

}

mobx_jig_gallery();

SCRIPT;
