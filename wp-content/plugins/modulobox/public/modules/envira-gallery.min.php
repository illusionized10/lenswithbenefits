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
var mobx_env_galleries=function(){for(var d=document.getElementsByClassName("envira-gallery-wrap"),b=0,a=d.length;b<a;b++)for(var c=d[b].querySelectorAll('.envira-gallery-item a[class^="envira-gallery-"]'),e=0,h=c.length;e<h;e++){var f=c[e],g=f.firstElementChild;mobx.addAttr(f,{rel:"envira-gallery-"+(b+1),title:f.getAttribute("data-envira-caption"),thumb:f.getAttribute("data-thumbnail")||g.getAttribute("data-envira-src"),poster:g.src});jQuery(f).off("click")}},mobx_env_album=function(d,b){d.addEventListener("click",function(a){a.preventDefault();a.stopPropagation();mobx.open(b,0)})},mobx_env_albums=function(d,b){if("undefined"!==typeof envira_albums_galleries_images)for(b in envira_albums_galleries_images)if(envira_albums_galleries_images.hasOwnProperty(b)){for(var a=envira_albums_galleries_images[b],c=0,e=a.length;c<e;c++)a[c].src=a[c].href,a[c].desc=a[c].caption,a[c].thumb=a[c].thumbnail,a[c].type="iframe"===a[c].type?"":a[c].type;if(a=document.querySelector(".envira-album-gallery-"+b))jQuery(a).off("click"),mobx_env_album(a,"envira-gallery-"+b)}};mobx.on("updateGalleries.modulobox",function(d){if("undefined"!==typeof envira_albums_galleries_images)for(var b in envira_albums_galleries_images)mobx.addMedia("envira-gallery-"+b,envira_albums_galleries_images[b])});jQuery(document).ajaxSuccess(function(d,b,a){a&&a.data&&0<=a.data.indexOf("envira_pagination")&&(mobx_env_albums(),mobx_env_galleries(),mobx.getGalleries())});mobx_env_galleries();mobx_env_albums();
SCRIPT;
