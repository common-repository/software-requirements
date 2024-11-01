<?php
if( is_admin() ) {
		wp_enqueue_style( 'wp-req_soft-panel', plugins_url('css/wpreq_softPanel.css', dirname(__FILE__)) );
}
else{
  wp_enqueue_style( 'wp-req_soft-style','/?req=apply&style=req_soft_style');
}
if (is_admin() && is_rtl() ) {
	wp_enqueue_style( 'wp-req_soft-panel-rtl', plugins_url('css/wpreq_softPanel-rtl.css', dirname(__FILE__)) );
}
	$style_name_req_soft = esc_attr( get_option('style_name_req_soft') );
	if ($style_name_req_soft=="av_dark"){
		wp_enqueue_style( 'wp-req_soft_av_dark', plugins_url('css/av_dark.css', dirname(__FILE__)) );
	}
	elseif($style_name_req_soft=="av_gray"){
		wp_enqueue_style( 'wp-req_soft_av_dark', plugins_url('css/av_gray.css', dirname(__FILE__)) );
	}
	elseif ($style_name_req_soft=="av_no_style") {
// echo NULL
	}
?>
