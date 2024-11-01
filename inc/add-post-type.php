<?php
$labelss = array(
	'name' => __('Software Requirements','req-soft'),
	'singular_name' => __('Software Requirements','req-soft'),
	'add_new' => __('Add New','req-soft'),
	'add_new_item' => __('Add New','req-soft'),
	'edit_item' => __('Edit','req-soft'),
	'new_item' => __('Add','req-soft'),
	'view_item' => __('View','req-soft'),
	'search_items' => __('Search','req-soft'),
	'not_found' => __('Not Found','req-soft'),
	'not_found_in_trash' => __('Not Found In Trash','req-soft'),
	'parent_item_colon' => 'software',
	'menu_name' => __('Software Requirements','req-soft'),
);
$argss = array(
	'labels' => $labelss,
	'label' => __('Software Requirements','req-soft'),
	'description' => __('Software Requirements','req-soft'),
	'supports' => array( 'title', 'custom-fields' ),
	'show_ui' => true,
	'show_in_menu' => true,
	'menu_position' => 90,
	'menu_icon' => plugins_url('img/av-team.png', dirname(__FILE__) ),
);
register_post_type( 'req_soft', $argss );
?>
