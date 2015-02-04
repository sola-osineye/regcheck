<?php
/*
 * Created on 20 Jan 2015
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
 function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


?>