<?php defined('ABSPATH') or die("No script kiddies please!");
	foreach($_POST['instagram'] as $key=>$val){
		$$key = sanitize_text_field($val);
	}

	$ibuzzf_settings = array();
	$ibuzzf_settings['username'] = $username;
	$ibuzzf_settings['user_id'] = $user_id;
	$ibuzzf_settings['access_token'] = $access_token;

	$ibuzzf_settings['instagram_layout'] = isset($instagram_layout)?$instagram_layout:'thumbnails';
	$ibuzzf_settings['feed_name'] = $feed_name;
	$ibuzzf_settings['display_insta_blog_feeds'] = isset($display_insta_blog_feeds) ? $display_insta_blog_feeds : '';
	$ibuzzf_settings['feed_type'] = isset($feed_type)?$feed_type:'self';
	$ibuzzf_settings['any_user_username'] = $any_user_username;
	$ibuzzf_settings['tag_name'] = $tag_name;
	$ibuzzf_settings['feed_display_type'] = isset($feed_display_type)?$feed_display_type:'loadmore';
	$ibuzzf_settings['sort_images_by'] = isset($sort_images_by)?$sort_images_by:'date';
	$ibuzzf_settings['display_header'] = isset($display_header) ? $display_header : '';
	$ibuzzf_settings['number_of_photos'] = isset($number_of_photos) ? $number_of_photos : 0;
	$ibuzzf_settings['number_of_columns'] = isset($number_of_columns)?$number_of_columns: 3;
	$ibuzzf_settings['show_likes'] = isset($show_likes) ? $show_likes : '';
	$ibuzzf_settings['show_description'] = isset($show_description) ? $show_description : '';
	$ibuzzf_settings['show_comments'] = isset($show_comments) ? $show_comments : '';	
	$ibuzzf_settings['feed_item_onclick'] = isset($feed_item_onclick)?$feed_item_onclick:'lightbox';
	// Hover Data Display Options
	$ibuzzf_settings['hover_enable_desable'] = isset($hover_enable_desable) ? $hover_enable_desable : '';
	$ibuzzf_settings['hover_profile_image'] = isset($hover_profile_image) ? $hover_profile_image : '';
	$ibuzzf_settings['hover_profile_username'] = isset($hover_profile_username) ? $hover_profile_username : '';
	update_option('ibuzzf_settings', $ibuzzf_settings);
	$_SESSION['ibuzzf_message'] = __('Settings Saved Successfully',IBUZZF_TEXT_DOMAIN);
	wp_redirect(admin_url().'admin.php?page=buzz-instagram-feed');
exit();