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
var mobx_woo_gallery=function(){for(var a=document.querySelectorAll(".woocommerce-product-gallery__image:not(.clone) a"),b=0,e=a.length;b<e;b++){var c=a[b],d=c.parentNode;mobx.addAttr(c,{rel:"woo-gallery",thumb:d?d.getAttribute("data-thumb"):""})}},wooTrigger=document.querySelector(".woocommerce-product-gallery__trigger");wooTrigger&&(jQuery(wooTrigger).off("click"),wooTrigger.addEventListener("click",function(a){a.preventDefault();a.stopPropagation();mobx.open("woo-gallery",0)}));jQuery(document).ready(function(){mobx_woo_gallery()});
SCRIPT;
