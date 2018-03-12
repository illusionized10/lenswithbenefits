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

var mobx_ess_galleries = function() {

	var ess_galleries = document.getElementsByClassName( 'esg-grid' );

	for ( var g = 0, gl = ess_galleries.length; g < gl; g++ ) {

		var ess_links = ess_galleries[g].querySelectorAll( '.esgbox' );

		for ( var i = 0, il = ess_links.length; i < il; i++ ) {

			var ess_link = ess_links[i];
			var parent   = ess_link.parentNode;
			var source   = ess_link.href;
			var videos   = [];

			while ( parent.tagName !== 'LI' ) {
				parent = parent.parentNode;
			}

			var media = parent.getElementsByClassName( 'esg-media-poster' );
			var thumb = media && media[0] ? media[0].getAttribute( 'data-src' ) : null;
				thumb = media && media[0] && thumb === 'undefined' ? media[0].getAttribute( 'src' ) : thumb;
				thumb = ! thumb || thumb === 'undefined' ? source : thumb;
            
			if ( ess_link.className.indexOf( 'esgboxhtml5' ) > 0 ) {

				videos.push( ess_link.getAttribute( 'data-mp4' ) );
				videos.push( ess_link.getAttribute( 'data-webm' ) );
				videos.push( ess_link.getAttribute( 'data-ogv' ) );

				ess_link.setAttribute( 'data-src', videos.filter( function ( src ) {
					return src;
				} ).join( ', ' ) || source );

            }

			mobx.addAttr( ess_link, {
				rel    : 'ess-gallery-' + ( g + 1 ),
				src    : source,
				thumb  : thumb,
				poster : thumb,
				title  : ess_link.getAttribute( 'lgtitle' )
			});

		}

	}

};

mobx_ess_galleries();

jQuery( document ).ajaxSuccess( function( event, xhr, settings ) {

	if ( settings && settings.data && settings.data.indexOf( 'Essential_Grid' ) >= 0 ) {

		mobx_ess_galleries();
		mobx.getGalleries();

    }

});

SCRIPT;
