<?php
// create custom plugin settings menu
add_action('admin_menu', 'req_soft_create_menu');

function req_soft_create_menu() {
	//create new top-level menu
	add_submenu_page('edit.php?post_type=req_soft',__('Settings','req-soft'), __('Settings','req-soft'), 'manage_options', 'req_soft_settings_page','req_soft_settings_page' );
	//call register settings function
	add_action( 'admin_init', 'register_req_soft_settings' );
}

function register_req_soft_settings() {
	//register our settings
	register_setting( 'req-soft-settings-group', 'req_soft_title' );
	register_setting( 'req-soft-settings-group', 'req_soft_title_color' );
	register_setting( 'req-soft-settings-group', 'req_soft_title_border_color' );
	register_setting( 'req-soft-settings-group', 'req_soft_title_size' );
	register_setting( 'req-soft-settings-group', 'req_soft_img_display' );
	register_setting( 'req-soft-settings-group', 'count_req_soft' );
	register_setting( 'req-soft-settings-group', 'style_name_req_soft' );
	register_setting( 'req-soft-settings-group', 'link_target_req_soft' );
	register_setting( 'req-soft-settings-group', 'req_soft_show_date' );
}

function req_soft_wp_link() {
	wp_enqueue_script( 'wp-link' );
}
add_action( 'wp_enqueue_scripts', 'req_soft_wp_link' );

add_action( 'admin_enqueue_scripts', 'wp_enqueue_color_picker' );
function wp_enqueue_color_picker( $hook_suffix ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker');
}

function req_soft_settings_page() {
	global $post;
	$req_soft_img_display=esc_attr( get_option('req_soft_img_display') );
	$req_soft_show_date=esc_attr( get_option('req_soft_show_date') );
	$count_req_soft=esc_attr( get_option('count_req_soft') );
	$style_name_req_soft=esc_attr( get_option('style_name_req_soft') );
	$link_target_req_soft=esc_attr( get_option('link_target_req_soft') );
?>

<div class="wrap">
<h2><?php echo __('Settings Page','req-soft'); ?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'req-soft-settings-group' ); ?>
    <?php do_settings_sections( 'req-soft-settings-group' ); ?>
    <script>
	jQuery(document).ready(function($){
    jQuery('.req-soft-color-picker').wpColorPicker();
	jQuery(".btn-req-soft").click(function(){
        jQuery(".settins-title").toggle();
    });
});
	</script>

    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo __('Title Name','req-soft'); ?></th>
        <td><input type="text" name="req_soft_title" value="<?php echo esc_attr( get_option('req_soft_title') ); ?>" /></td>
        <td><div class="btn-req-soft"><?php echo __('Settings','req-soft'); ?></div></td>
        </tr>
        <tr class="settins-title" valign="top">
        <th scope="row"><?php echo __('Title Size(px)','req-soft'); ?></th>
        <td><input type="number" name="req_soft_title_size" value="<?php echo esc_attr( get_option('req_soft_title_size') ); ?>" /></td>
        </tr>
        <tr class="settins-title" valign="top">
        <th scope="row"><?php echo __('Title Color','req-soft'); ?></th>
        <td><input type="text" name="req_soft_title_color" value="<?php echo esc_attr( get_option('req_soft_title_color') ); ?>" class="req-soft-color-picker" /></td>
        </tr>
        <tr class="settins-title" valign="top">
        <th scope="row"><?php echo __('Title border-color','req-soft'); ?></th>
        <td><input type="text" name="req_soft_title_border_color" value="<?php echo esc_attr( get_option('req_soft_title_border_color') ); ?>" class="req-soft-color-picker" /></td>
        </tr>


        <tr valign="top">
        <th scope="row"><?php echo __('Show/Hide Image','req-soft'); ?></th>
        <td>
			<select name="req_soft_img_display" style="width: 100%;height:35px">
  			<option value="yes" <?php echo ($req_soft_img_display == 'yes' ? 'selected':'') ?>><?php _e('Yes','req-soft'); ?></option>
  			<option value="no" <?php echo ($req_soft_img_display == 'no' ? 'selected':'') ?>><?php _e('No','req-soft'); ?></option>
			</select></td>

        </tr>

				<tr valign="top">
        <th scope="row"><?php echo __('Show/Hide Date','req-soft'); ?></th>
        <td>
			<select name="req_soft_show_date" style="width: 100%;height:35px">
  			<option value="yes" <?php echo ($req_soft_show_date == 'yes' ? 'selected':'') ?>><?php _e('Yes','req-soft'); ?></option>
  			<option value="no" <?php echo ($req_soft_show_date == 'no' ? 'selected':'') ?>><?php _e('No','req-soft'); ?></option>
			</select></td>

        </tr>

        <tr valign="top">
        <th scope="row"><?php echo __('Number of software','req-soft'); ?></th>
        <td><input type="number" name="count_req_soft" value="<?php echo esc_attr( get_option('count_req_soft') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row"><?php echo __('Link Target','req-soft'); ?></th>
			<td>
			<select name="link_target_req_soft" style="width: 100%;height:35px">
  			<option value="_blank" <?php echo ($link_target_req_soft == '_blank' ? 'selected':'') ?>><?php _e('_blank','req-soft'); ?></option>
  			<option value="_self" <?php echo ($link_target_req_soft == '_self' ? 'selected':'') ?>><?php _e('_self','req-soft'); ?></option>
			</select></td>
		  </tr>

			<tr valign="top">
			<th scope="row"><?php echo __('Style','req-soft'); ?></th>
		<td>
		<select id="val_style" name="style_name_req_soft" style="width: 100%;height:35px">
			<option value="av_dark" <?php echo ($style_name_req_soft == 'av_dark' ? 'selected':'') ?>><?php _e('AV Dark','req-soft'); ?></option>
			<option value="av_gray" <?php echo ($style_name_req_soft == 'av_gray' ? 'selected':'') ?>><?php _e('AV Gray','req-soft'); ?></option>
			<option value="av_no_style" <?php echo ($style_name_req_soft == 'av_no_style' ? 'selected':'') ?>><?php _e('No Style','req-soft'); ?></option>
		</select></td>
		</tr>

    </table>

<script type="text/javascript">
jQuery(document).ready(function() {
	 jQuery("#val_style").change(function(event) {
		var select_style = jQuery("#val_style").val();
		if(select_style == "av_gray"){
			jQuery(".av_gray").show();
		}else {
			jQuery(".av_gray").hide();
		}
		if(select_style=="av_dark"){
			jQuery(".av_dark").show();
		}else {
				jQuery(".av_dark").hide();
		}
	 });
	 var select_style = jQuery("#val_style").val();
	 if(select_style == "av_gray"){
	 	jQuery(".av_gray").show();
	 	};
		if(select_style=="av_dark"){
			jQuery(".av_dark").show();
		}else {
				jQuery(".av_dark").hide();
		}
});
</script>

<img class="av_gray perview_style_req_soft" src="<?php echo plugins_url('img/gray_style.PNG', dirname(__FILE__) ) ?>" alt="AV GRAY" style="display:none;" />
<img class="av_dark perview_style_req_soft" src="<?php echo plugins_url('img/dark_style.PNG', dirname(__FILE__) ) ?>" alt="AV DARK" style="display:none;" />


    <?php submit_button(); ?>
<?php settings_errors(); ?>

<?php add_thickbox(); ?>
<div id="help-req-soft" style="display:none;">
  <div class="content-help-req-soft">

<h3><?php _e('Shortcode','req-soft') ?></h3>
<p><?php _e('Insert in your theme :','req-soft') ?></p>
<div class="shortcode_code">
	&lt;?php echo do_shortcode('[WPreq_soft]'); ?&gt;
</div>
<p><?php _e('OR','req-soft') ?></p>
<p><?php _e('Insert in your widget :','req-soft') ?></p>
<div class="shortcode_code">
	[WPreq_soft]
</div>
<hr>

<h3><?php echo __('Number of software','req-soft'); ?></h3>
<p><?php echo __('use value 0 like number of post show in your site.','req-soft'); ?> </p>
<p><?php echo __('use value -1 you can show all of software','req-soft'); ?> </p>
<p><?php echo __('use other value in number of software you can limite them','req-soft'); ?></p>


	</div>
</div>
<a href="#TB_inline?width=600&height=550&inlineId=help-req-soft" class="thickbox thickbox-req-soft"><?php  _e('Help','req-soft') ?></a>

</form>
</div>
<?php } ?>
