<?php
	defined( 'ABSPATH' ) or die( "No script kiddies please!" );
	$url = esc_url_raw($_POST['pagination_link']);
	$content = wp_remote_get( $url );
	$response = wp_remote_retrieve_body( $content );
	$ins_media = json_decode( $response, true );
	$ibuzzf_settings = get_option( 'ibuzzf_settings' );
	$instagram_layout = esc_attr($ibuzzf_settings['instagram_layout']);
	if((!empty($instagram_layout) && $instagram_layout == 'thumbnails') || (!empty($instagram_layout) && $instagram_layout == 'masonry')){
		include("frontend/layout/_thumbnail_item.php");
	}else if(!empty($instagram_layout) && $instagram_layout == 'instagram'){
		include_once('frontend/layout/_instagram_item.php');
	}else if(!empty($instagram_layout) && $instagram_layout == 'blog_style'){
		include_once('frontend/layout/_blogstyle_item.php');
	}else if(!empty($instagram_layout) && $instagram_layout == 'fancygallery'){
		include_once('frontend/layout/_fancygallery_item.php');
	}
?>