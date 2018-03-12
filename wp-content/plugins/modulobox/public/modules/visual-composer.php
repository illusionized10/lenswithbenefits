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

var mobx_vc_galleries = function() {

	var vc_galleries = document.querySelectorAll( '.wpb_gallery, .vc_images_carousel, .vc_grid-container-wrapper' );

	for ( var g = 0, gl = vc_galleries.length; g < gl; g++ ) {

		var selector = vc_galleries[g].className.indexOf( 'vc_grid-container-wrapper' ) > -1;
		var vc_links = vc_galleries[g].querySelectorAll( selector ? '.vc_grid-item.vc_visible-item a.vc_gitem-link' : 'a' );

		for ( var l = 0, ll = vc_links.length; l < ll; l++ ) {

			var vc_link  = vc_links[l],
				vc_image = vc_link.firstElementChild,
				isAuto   = vc_image ? ( vc_image.title || vc_image.alt ) && mobx_options.autoCaption : '';

			jQuery( vc_link ).off( 'click' );

			mobx.addAttr( vc_link, {
				rel    : 'vc-gallery-' + ( g + 1),
				title  : vc_link.title || ( isAuto ? vc_image.title || vc_image.alt  : '' ),
				thumb  : vc_image ? vc_image.src : vc_link.href
			});

		}

	}

};

// Detect VC event attached to window when new items are added in grid/gallery
jQuery( window ).on( 'grid:items:added', function() {

	mobx_vc_galleries();
	mobx.getGalleries();

});

SCRIPT;
