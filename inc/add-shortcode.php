<?php
function display_req_soft_shortcode() {
	$tmp_query = $wp_query;
	wp_reset_postdata();
	wp_reset_query();
	$count_req_soft=esc_attr( get_option('count_req_soft') );
        $args1 = array(
        'post_type' => 'req_soft',
        'posts_per_page' => $count_req_soft
    		);
	$the_query = new WP_Query($args1);
	$out .='<div class="req-soft-title">'.esc_attr( get_option('req_soft_title') ).'</div>';
	if ($the_query->have_posts()) {
		$out .= '<div class="req-soft-wrap">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$text_aks_link = get_post_meta(get_the_ID(), 'req_soft-link', true);
			$text_aks_des  = get_post_meta(get_the_ID(), 'req_soft-des', true);
			$aks_link  = get_post_meta(get_the_ID(), 'req_soft-aks', true);
			$image_url=get_post_meta(get_the_ID(), 'req_soft_image_url', true);
			$req_soft_img_display=esc_attr( get_option('req_soft_img_display') );
			$req_soft_show_date=esc_attr( get_option('req_soft_show_date') );
			$link_target_req_soft=esc_attr( get_option('link_target_req_soft') );
			$req_soft_img_display=='yes'?$req_image= '<img src='.$image_url.' class="aks-req" width="57" height="57" />':'';
			$req_soft_show_date=='yes'?$time_of_req_soft= get_the_time('j F , Y'):'';
			
			$out .= '
			<a target="'.$link_target_req_soft.'" href="'. $text_aks_link .'" title="' . get_the_title() . '">
			<ul>
			'. $req_image.'
			<div class="req-soft-name-desc">
			<li class="req-soft-name">' . get_the_title() . '</li>
			<li class="req-soft-desc">' . $text_aks_des . '</li>
			<li class="req-soft-time">'.$time_of_req_soft.'</li>
			</div>
				</ul>
			</a>
			';

		}

	} else {
		$out .= '
		<p>
		'.__("No Information","req-soft").'
		</p>
		';
	}
	$out .= '</div>';
	return $out;
	wp_reset_postdata();
	wp_reset_query();
	$wp_query = $tmp_query;
}

add_shortcode('WPreq_soft', 'display_req_soft_shortcode');

?>
