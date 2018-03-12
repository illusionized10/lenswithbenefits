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

// Get/Append Inline SVG
if ( typeof mobx_svg_icons !== 'undefined' && mobx_svg_icons ) {

	var ajax = new XMLHttpRequest();

	ajax.open( 'GET', mobx_svg_icons, true );
	ajax.send();

	ajax.onload = function() {	

		var div = document.createElement( 'DIV' );
		div.style.display = 'none';
		div.innerHTML = ajax.responseText;
		document.body.insertBefore( div, document.body.childNodes[0] );

	};

}

// Inline SVG use and accessibility
mobx.on( 'beforeAppendDOM.modulobox', function( DOM ) {

	var svgns = 'http://www.w3.org/2000/svg',
		xlink = 'http://www.w3.org/1999/xlink';

	for ( var type in this.buttons ) {

		if ( this.buttons.hasOwnProperty( type ) ) {

			if ( typeof mobx_accessibility !== 'undefined' && mobx_accessibility[ type + 'Label'] ) {

				this.buttons[type].setAttribute( 'aria-label', mobx_accessibility[ type + 'Label'] );

				if ( mobx_accessibility.title ) {

					this.buttons[type].setAttribute( 'title', mobx_accessibility[ type + 'Label'] );

				}

			}

			var svg = document.createElementNS( svgns, 'svg' );
			var use = document.createElementNS( svgns, 'use' );

			svg.setAttribute( 'class', 'mobx-svg' );
			use.setAttribute( 'class', 'mobx-use' );
			svg.appendChild( use ).setAttributeNS( xlink, 'xlink:href', '#mobx-svg-' + type.toLowerCase() );
			this.buttons[type].appendChild( svg );

			if ( ['fullScreen', 'play', 'zoom'].indexOf( type ) > -1 ) {

				var href;

				switch( type ) {
					case 'fullScreen':
						href = 'unfullscreen';
						break;
					case 'play':
						href = 'pause';
						break;
					case 'zoom':
						href = 'zoom-out';
						break;
				}

				svg = svg.cloneNode( true );
				svg.firstElementChild.setAttributeNS( xlink, 'xlink:href', '#mobx-svg-' + href );
				this.buttons[type].appendChild( svg );

			}

		}

	}

});

SCRIPT;
