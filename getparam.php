<?php
/**
 * Plugin Name: Contact Form 7 Get and Show Parameter from URL
 * Plugin URI: http://elementdesignllc.com/2011/11/contact-form-7-get-parameter-from-url-into-form-plugin/
 * Description: Get and Show Parameter from URL Contact Form 7 Plugin
 * Version: 2.0.0
 * Author: Chad Huntley, mzm
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */

/*  Copyright 2013  Chad Huntley  (email : chad@elementdesignllc.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action( 'wpcf7_init', 'wpcf7_add_shortcode_getparam' );

function wpcf7_add_shortcode_getparam() {
    if ( function_exists( 'wpcf7_add_shortcode' ) ) {
        wpcf7_add_shortcode( 'getparam', 'wpcf7_getparam_shortcode_handler', true );
        wpcf7_add_shortcode( 'showparam', 'wpcf7_showparam_shortcode_handler', true );
    }
}

// [getparam ordernum]
function wpcf7_getparam_shortcode_handler($tag) {

    if (!isset($tag['name'])) {
        return '<b>wpcf7_getparam_shortcode_handler: display-get-param requires a name attribute</b>';
    }
    $name = $tag['name'];
    //$default = isset($tag['default']) ? $tag['default'] : '<blank value>';
    $value = $_GET[$name];
    if ($value == "") {
        $value = "(NA)";
    }
    $html = '<input type="hidden" name="' . $name . '" value="'. htmlentities( $value ) . '" />';
    return $html;
}

// [showparam ordernum]
function wpcf7_showparam_shortcode_handler($tag) {

    if (!isset($tag['name'])) {
        return '<b>wpcf7_showparam_shortcode_handler: display-get-param requires a name attribute</b>';
    }
    $name = $tag['name'];
    $default = isset($tag['default']) ? $tag['default'] : '(NA)';
    return htmlentities(isset($_GET[$name]) ? $_GET[$name] : $default); 
}
