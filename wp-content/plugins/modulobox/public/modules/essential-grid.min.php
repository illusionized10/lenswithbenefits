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
var mobx_ess_galleries=function(){for(var g=document.getElementsByClassName("esg-grid"),d=0,e=g.length;d<e;d++)for(var l=g[d].querySelectorAll(".esgbox"),h=0,m=l.length;h<m;h++){for(var b=l[h],a=b.parentNode,k=b.href,f=[];"LI"!==a.tagName;)a=a.parentNode;var c=(a=a.getElementsByClassName("esg-media-poster"))&&a[0]?a[0].getAttribute("data-src"):null,c=(c=a&&a[0]&&"undefined"===c?a[0].getAttribute("src"):c)&&"undefined"!==c?c:k;0<b.className.indexOf("esgboxhtml5")&&(f.push(b.getAttribute("data-mp4")),f.push(b.getAttribute("data-webm")),f.push(b.getAttribute("data-ogv")),b.setAttribute("data-src",f.filter(function(a){return a}).join(", ")||k));mobx.addAttr(b,{rel:"ess-gallery-"+(d+1),src:k,thumb:c,poster:c,title:b.getAttribute("lgtitle")})}};mobx_ess_galleries();jQuery(document).ajaxSuccess(function(g,d,e){e&&e.data&&0<=e.data.indexOf("Essential_Grid")&&(mobx_ess_galleries(),mobx.getGalleries())});
SCRIPT;
