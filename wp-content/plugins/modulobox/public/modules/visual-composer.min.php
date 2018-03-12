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
var mobx_vc_galleries=function(){for(var e=document.querySelectorAll(".wpb_gallery, .vc_images_carousel, .vc_grid-container-wrapper"),b=0,g=e.length;b<g;b++)for(var d=-1<e[b].className.indexOf("vc_grid-container-wrapper"),d=e[b].querySelectorAll(d?".vc_grid-item.vc_visible-item a.vc_gitem-link":"a"),f=0,h=d.length;f<h;f++){var c=d[f],a=c.firstElementChild,k=a?(a.title||a.alt)&&mobx_options.autoCaption:"";jQuery(c).off("click");mobx.addAttr(c,{rel:"vc-gallery-"+(b+1),title:c.title||(k?a.title||a.alt:""),thumb:a?a.src:c.href})}};jQuery(window).on("grid:items:added",function(){mobx_vc_galleries();mobx.getGalleries()});
SCRIPT;
