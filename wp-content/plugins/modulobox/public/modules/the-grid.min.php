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
jQuery(document).ajaxSuccess(function(b,c,a){a&&a.data&&0<=a.data.indexOf("the_grid_load_more")&&mobx.getGalleries()});
SCRIPT;
