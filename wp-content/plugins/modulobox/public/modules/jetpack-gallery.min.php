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
var mobx_jetpack_galleries=function(){for(var d=document.getElementsByClassName("tiled-gallery"),b=0,k=d.length;b<k;b++){d[b].removeAttribute("data-carousel-extra");for(var g=d[b].querySelectorAll(".tiled-gallery-item img"),e=0,l=g.length;e<l;e++){var a=g[e],f=a.parentElement,h=a.getAttribute("data-image-description"),c=f.nextElementSibling,c=c?c.innerHTML:"";f.href=a.getAttribute("data-large-file");mobx.addAttr(f,{rel:"wp-gallery-"+(b+1),src:a.getAttribute("data-large-file"),title:a.title,desc:h?h.replace(/(<p[^>]*>|<\/p>)/g,""):c,thumb:a.getAttribute("data-medium-file")})}}};jQuery(document).ready(function(){mobx_jetpack_galleries()});
SCRIPT;
