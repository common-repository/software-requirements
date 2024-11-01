<?php
add_filter('query_vars','req_soft_add_trigger');
function req_soft_add_trigger($vars) {
  $vars[] = 'req';
  $vars[] = 'style';
    return $vars;
}

add_action('template_redirect', 'req_soft_trigger_check');
function req_soft_trigger_check() {
    if((string)get_query_var('req') == 'apply') {
header("Content-type: text/css; charset: UTF-8");
				$style= get_query_var('style');

  $req_soft_title_border_color= esc_attr( get_option('req_soft_title_border_color') );
	$req_soft_title_color=esc_attr( get_option('req_soft_title_color') );
	$req_soft_title_size=esc_attr( get_option('req_soft_title_size') );

	    echo '
		.req-soft-title{
	border-bottom: 1px solid '.$req_soft_title_border_color.' ;
	color: '.$req_soft_title_color.' ;
	font-size: '.$req_soft_title_size.'px ;
	margin-right: 0px;
	padding-right: 3px;
	padding-bottom: 8px;
	margin-bottom: 8px;
}


		';

      exit;
    }
}
?>
