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

jQuery( document ).ajaxSuccess( function( event, xhr, settings ) {

    if ( settings && settings.data && settings.data.indexOf( 'the_grid_load_more' ) >= 0 ) {

        mobx.getGalleries();

    }

});

SCRIPT;
