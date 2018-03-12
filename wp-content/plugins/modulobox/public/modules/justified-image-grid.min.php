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
var mobx_jig_gallery=function(){for(var e=document.querySelectorAll(".justified-image-grid"),a=0,g=e.length;a<g;a++)for(var f=e[a].querySelectorAll(".jig-imageContainer a.jig-link"),d=0,h=f.length;d<h;d++){var b=f[d],c=b.firstElementChild;mobx.addAttr(b,{rel:"jig-gallery-"+(a+1),title:c.title||c.alt,desc:b.title,poster:c.src,thumb:c.src});jQuery(b).off("click")}},mobx_jig_loadMore=function(){setTimeout(function(){mobx_jig_gallery();mobx.getGalleries()},100)},jigLoadMore=document.querySelectorAll(".jig-loadMoreButton");if(jigLoadMore)for(var j=0,jt=jigLoadMore.length;j<jt;j++)jigLoadMore[j].addEventListener("click",mobx_jig_loadMore);mobx_jig_gallery();
SCRIPT;
