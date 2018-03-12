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
var mobx_ngg_galleries=function(){for(var d=document.getElementsByClassName("ngg-galleryoverview"),a=0,c=d.length;a<c;a++)for(var b=d[a].querySelectorAll(".ngg-gallery-thumbnail a"),f=0,g=b.length;f<g;f++){var e=b[f];e&&mobx.addAttr(e,{rel:"ngg-gallery-"+(a+1),title:e.getAttribute("data-title"),desc:e.getAttribute("data-description"),thumb:e.getAttribute("data-thumbnail")})}},mobx_ngg_images=function(){for(var d=document.querySelectorAll('.ngg-imagebrowser [id^="ngg-image"] a'),a=0,c=d.length;a<c;a++){var b=d[a];b&&mobx.addAttr(b,{rel:"ngg-image-"+(a+1),title:b.getAttribute("data-title"),desc:b.getAttribute("data-description"),thumb:b.getAttribute("data-thumbnail")})}},mobx_ngg_links=function(){jQuery(".ngg-gallery-thumbnail a").off("click");jQuery('.ngg-imagebrowser [id^="ngg-image"] a').off("click")};jQuery(document).ready(function(){mobx_ngg_links()});jQuery(document).ajaxSuccess(function(d,a,c){c&&c.url&&0<=c.url.indexOf("nggallery")&&setTimeout(function(){mobx_ngg_links();mobx_ngg_galleries();mobx_ngg_images();mobx.getGalleries()},50)});mobx_ngg_galleries();mobx_ngg_images();
SCRIPT;
