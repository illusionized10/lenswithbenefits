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
if("undefined"!==typeof mobx_svg_icons&&mobx_svg_icons){var ajax=new XMLHttpRequest;ajax.open("GET",mobx_svg_icons,!0);ajax.send();ajax.onload=function(){var a=document.createElement("DIV");a.style.display="none";a.innerHTML=ajax.responseText;document.body.insertBefore(a,document.body.childNodes[0])}}mobx.on("beforeAppendDOM.modulobox",function(a){for(var b in this.buttons)if(this.buttons.hasOwnProperty(b)){"undefined"!==typeof mobx_accessibility&&mobx_accessibility[b+"Label"]&&(this.buttons[b].setAttribute("aria-label",mobx_accessibility[b+"Label"]),mobx_accessibility.title&&this.buttons[b].setAttribute("title",mobx_accessibility[b+"Label"]));a=document.createElementNS("http://www.w3.org/2000/svg","svg");var d=document.createElementNS("http://www.w3.org/2000/svg","use");a.setAttribute("class","mobx-svg");d.setAttribute("class","mobx-use");a.appendChild(d).setAttributeNS("http://www.w3.org/1999/xlink","xlink:href","#mobx-svg-"+b.toLowerCase());this.buttons[b].appendChild(a);if(-1<["fullScreen","play","zoom"].indexOf(b)){var c;switch(b){case "fullScreen":c="unfullscreen";break;case "play":c="pause";break;case "zoom":c="zoom-out"}a=a.cloneNode(!0);a.firstElementChild.setAttributeNS("http://www.w3.org/1999/xlink","xlink:href","#mobx-svg-"+c);this.buttons[b].appendChild(a)}}});
SCRIPT;
