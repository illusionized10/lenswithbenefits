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

var mobx_env_galleries = function() {

	var env_galleries = document.getElementsByClassName( 'envira-gallery-wrap' );

	for ( var g = 0, gl = env_galleries.length; g < gl; g++ ) {

		var env_links = env_galleries[g].querySelectorAll( '.envira-gallery-item a[class^="envira-gallery-"]' );

		for ( var l = 0, ll = env_links.length; l < ll; l++ ) {

			var env_link  = env_links[l],
				env_image = env_link.firstElementChild;

			mobx.addAttr( env_link, {
				rel    : 'envira-gallery-' + ( g + 1 ),
				title  : env_link.getAttribute( 'data-envira-caption' ),
				thumb  : env_link.getAttribute( 'data-thumbnail' ) || env_image.getAttribute( 'data-envira-src' ),
				poster : env_image.src
			});

			// Unbind jQuery click event to prevent opening default lightbox
			jQuery( env_link ).off( 'click' );

		}

	}

};

var mobx_env_album = function( el, album ) {

	el.addEventListener( 'click', function( event ) {

		event.preventDefault();
		event.stopPropagation();
		mobx.open( album, 0 );

	});

};

var mobx_env_albums = function( el, album ) {

	if ( typeof envira_albums_galleries_images !== 'undefined' ) {

		for ( var album in envira_albums_galleries_images ) {

			if ( envira_albums_galleries_images.hasOwnProperty( album ) ) {

				var images = envira_albums_galleries_images[album];

				for ( var i = 0, il = images.length; i < il; i++ ) {

					images[i].src   = images[i].href;
					images[i].desc  = images[i].caption;
					images[i].thumb = images[i].thumbnail;
					images[i].type  = images[i].type === 'iframe' ? '' : images[i].type;

				}

				var DOM = document.querySelector( '.envira-album-gallery-' + album );

				if ( DOM ) {

					// Unbind jQuery click event to prevent opening default lightbox
					jQuery( DOM ).off( 'click' );
					// Add new event listener to open album lightbox on click
					mobx_env_album( DOM, 'envira-gallery-' + album );

				}

			}

		}
		
	}

};

mobx.on( 'updateGalleries.modulobox', function( galleries ) {

	if ( typeof envira_albums_galleries_images !== 'undefined' ) {

		for ( var album in envira_albums_galleries_images ) {

			var images = envira_albums_galleries_images[album];
			mobx.addMedia( 'envira-gallery-' + album, images );

		}

	}

});

jQuery( document ).ajaxSuccess( function( event, xhr, settings ) {

    if ( settings && settings.data && settings.data.indexOf( 'envira_pagination' ) >= 0 ) {

		mobx_env_albums();
		mobx_env_galleries();
        mobx.getGalleries();

    }

});

mobx_env_galleries();
mobx_env_albums();

SCRIPT;
