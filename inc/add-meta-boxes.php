<?php
function req_main_meta_box_function() {
	add_meta_box('wp-req-meta', __('Specifications','req-soft'), 'add_req_meta_box', 'req_soft', 'normal', 'high');

	function add_req_meta_box() {
		global $post;
		$aks_link  = get_post_meta($post->ID, 'aks_link', true);
		$text_aks_link = get_post_meta($post->ID, 'req_soft-link', true);
		$text_aks_des  = get_post_meta($post->ID, 'req_soft-des', true);
		$aks_link  = get_post_meta($post->ID, 'req_soft-aks', true);
		$image_url  = get_post_meta($post->ID, 'req_soft_image_url', true);
		$test = get_post_meta($post->ID, 'test', true);
		?>

		<div class="req_soft-main">

		<script>
jQuery('body').on('click', '.link-address', function(event) {
            wpActiveEditor = true; //we need to override this var as the link dialogue is expecting an actual wp_editor instance
            wpLink.open(); //open the link popup
            return false;
        });
jQuery('body').on('click', '#wp-link-submit', function(event) {
            var linkAtts = wpLink.getAttrs();//the links attributes (href, target) are stored in an object, which can be access via  wpLink.getAttrs()
            jQuery('.link-address').val(linkAtts.href);//get the href attribute and add to a textfield, or use as you see fit
            wpLink.textarea = jQuery('body'); //to close the link dialogue, it is again expecting an wp_editor instance, so you need to give it something to set focus back to. In this case, I'm using body, but the textfield with the URL would be fine
            wpLink.close();//close the dialogue
//trap any events
            event.preventDefault ? event.preventDefault() : event.returnValue = false;
            event.stopPropagation();
            return false;
        });
    jQuery('body').on('click', '#wp-link-cancel, #wp-link-close', function(event) {
        wpLink.textarea = jQuery('body');
        wpLink.close();
        event.preventDefault ? event.preventDefault() : event.returnValue = false;
        event.stopPropagation();
        return false;
    });
</script>

<?php
//for use wp-link
$content = '';
$editor_id = 'req-soft-tiny-custom';
wp_editor( $content, $editor_id );
?>

			<label for="req_soft-link"><?php echo __( 'Link Address :', 'req-soft' ); ?></label><br>
			<input class="link-address" type="text" dir="ltr" name="req_soft-link" value="<?php echo $text_aks_link; ?>" style="width: 100%;"/>

			<br><br>

			<label for="req_soft-link-des"><?php echo __( 'Description :', 'req-soft' ); ?></label><br>
			<input type="text" name="req_soft-des" value="<?php echo $text_aks_des; ?>" style="width: 100%;"/>

			<br><br>

<?php
// jQuery
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>

    <label for="image_url"><?php echo __( 'Icon Software :', 'req-soft' ); ?></label><br>

    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary button-primary" value="<?php echo __( 'Upload', 'req-soft' ); ?>" style="height: 35px;width: 100px;">
    <input type="text" name="req_soft_image_url" id="image_url" class="regular-text" value="<?php echo $image_url; ?>" style="width: 90%;">
    <br><br>
   <?php echo __( 'Preview :', 'req-soft' ); ?>
    <br>
    <?php if ($image_url==NULL) {
    	echo __( 'Please Insert Software Icon', 'req-soft' );;
    } else {
		echo '<img class="pre_image_old" src="'.$image_url.'" style="width: 80px;height: 80px;border-radius: 3px;border: 5px solid #0073AA;padding: 1px;" />';
		}
    ?>
<img class="pre_image" src="" />


<script type="text/javascript">
jQuery(document).ready(function($){
	jQuery('#upload-btn').click(function(event) {
			 jQuery('.pre_image').show();
			 jQuery(".pre_image_old").hide();
	});
    jQuery('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: '<?php echo __( 'Upload Image', 'req-soft' ); ?>',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            jQuery('#image_url').val(image_url);
						jQuery('.pre_image').attr('src',image_url);
        });
    });
});
</script>


		</div>

		<?php

	}

}

add_action( 'add_meta_boxes', 'req_main_meta_box_function' );

//add column to post type req-soft
function image_post_column($defaults){
    $defaults['image_post'] =__( 'Images', 'req-soft' );
    return $defaults;
}
add_filter('manage_req_soft_posts_columns', 'image_post_column');

//add value to column of post type req-soft
function image_post_column_value($column_name, $post_id = 0){
    if($column_name === 'image_post'){
      global $post;
      $image_url = get_post_meta( $post->ID, 'req_soft_image_url', true );
      if ($image_url != NULL){
             echo '<img src="'.$image_url.'" style="width: 50px;height: 50px;border-radius: 3px;border: 5px solid #0073AA;padding: 1px;" />';
	}
	else{
		echo _e('No Image','req-soft');

	}
    }
}
add_action('manage_req_soft_posts_custom_column', 'image_post_column_value',5,2);

function save_req_req_meta() {
	global $post;

	if( isset($_POST['post_type']) && ($_POST['post_type'] == "req_soft") ) {

		if( isset($_POST['req_soft-link']) && $_POST['req_soft-link'] !=get_post_meta($post->ID, 'req_soft-link', true) ) {
			  $save_req_soft_link = sanitize_text_field( $_POST['req_soft-link'] );
			  update_post_meta($post->ID, 'req_soft-link',$save_req_soft_link );
		}
		if( isset($_POST['req_soft-des']) && $_POST['req_soft-des'] != get_post_meta($post->ID, 'req_soft-des', true)) {
			  $save_req_soft_des = sanitize_text_field( $_POST['req_soft-des'] );
			  update_post_meta($post->ID, 'req_soft-des', $save_req_soft_des);
		}
		if( isset($_POST['req_soft-aks']) && $_POST['req_soft-aks'] != get_post_meta($post->ID, 'req_soft-aks', true)) {
	      $save_req_soft_aks = sanitize_text_field( $_POST['req_soft-aks'] );
			  update_post_meta($post->ID, 'req_soft-aks',$save_req_soft_aks);
		}
		if( isset($_POST['req_soft_image_url']) && $_POST['req_soft_image_url'] != get_post_meta($post->ID, 'req_soft_image_url', true)) {
	      $save_req_soft_image_url = sanitize_text_field( $_POST['req_soft_image_url'] );
			  update_post_meta($post->ID, 'req_soft_image_url', $save_req_soft_image_url);
		}

  }
}
add_action('save_post', 'save_req_req_meta');
?>
