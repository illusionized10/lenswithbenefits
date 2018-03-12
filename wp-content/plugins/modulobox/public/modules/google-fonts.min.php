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
if("undefined"!==typeof mobx_google_fonts&&mobx_google_fonts){var head=document.head,link=document.createElement("link");link.type="text/css";link.rel="stylesheet";link.href=mobx_google_fonts;head.appendChild(link)};
SCRIPT;
