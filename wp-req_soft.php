<?php

/*
Plugin Name: Software Requirements
Plugin URI: http://www.alivazirinia.ir
Description: With this plugin you can add to your site software requirements
Author: Ali Vaziri
Author URI: http://www.alivazirinia.ir
Version: 1.3
License:GPL 2.0
*/

// Define Plugin Main URL
define ( 'wp_req_soft_URL', plugin_dir_url(__FILE__) );

function req_soft_text_domain() {
	// Load the default language files
	load_plugin_textdomain( 'req-soft', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'req_soft_text_domain' );

include ('inc/setting.php');

// Enqueue Styles
function req_soft_style_enqueue() {
	include ('inc/add-styles.php');
}
add_action( 'init', 'req_soft_style_enqueue');

// Set Custom Post Type For wp req
function add_req_soft_posts() {
	include ('inc/add-post-type.php');
}
add_action('init', 'add_req_soft_posts' );


// Set req soft Meta Boxes
include ('inc/add-meta-boxes.php');

// Set Shortcode And Make Them Work In Widget
function display_req_soft_list(){
	include ('inc/add-shortcode.php');
}
add_action( 'init', 'display_req_soft_list');
add_filter('widget_text', 'do_shortcode');

include('css/wpreq_soft.php');
?>
