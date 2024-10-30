<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
extract($ibuzzf_settings); 
if (!function_exists("buzzSortByLikesOrder") ){
	function buzzSortByLikesOrder($a, $b) {
	    return $b['likes_count'] - $a['likes_count'];
	}

	function buzzSortByCommentOrder($a, $b) {
	    return $b['comment_count'] - $a['comment_count'];
	}

	function buzzSortByDateOrder($a, $b) {
	    return $b['created_time'] - $a['created_time'];
	}
}
	
    $formated_array = array();
	foreach($ins_media['data'] as $key=>$data) {
		$likes = esc_attr($data['likes']['count']);
    	$comments = esc_attr($data['comments']['count']);
		$formated_array[$key] = $data;
		$formated_array[$key]['likes_count'] = $likes;
		$formated_array[$key]['comment_count'] = $comments;
	};

	if(!empty($sort_images_by) && $sort_images_by =='random') {
		shuffle($formated_array);
	}else if(!empty($sort_images_by) && $sort_images_by == 'likes') {
		if($formated_array){
			usort($formated_array, 'buzzSortByLikesOrder');
		}
	}else if(!empty($sort_images_by) && $sort_images_by == 'comments') {
		if($formated_array){
			usort($formated_array, 'buzzSortByCommentOrder');
		}
	}else if(!empty($sort_images_by) && $sort_images_by == 'date') {
		 if($formated_array){
			usort($formated_array, 'buzzSortByDateOrder');
		}   
	}
	
    foreach ($formated_array as $buzz) :				    	
    	if($number_of_columns == 2 || $number_of_columns == 1 ){
    		$image = $buzz['images']['standard_resolution']['url'];
    	} else if($number_of_columns == 3 || $number_of_columns == 4)
    	{
    		$image = $buzz['images']['low_resolution']['url'];
    	} else if($number_of_columns == 5){
    		$image = $buzz['images']['thumbnail']['url'];
    	}
    	$likes = esc_attr($buzz['likes']['count']);
    	$comments = esc_attr($buzz['comments']['count']);
    	$description = esc_textarea($buzz['caption']['text']);
    	$profile_image = esc_url($buzz['caption']['from']['profile_picture']);
    	$profile_username = $buzz['user']['username'];
    	$img_link = $buzz['link'];
    	
    	$divClass = '';

    	if(!empty($hover_enable_desable) && $hover_enable_desable ==1){
			$divClass = 'buzz-hover-effect';
		} else {
			$divClass = 'no-buzz-hover-effect';
		}
		if(!empty($instagram_layout) && $instagram_layout == "masonry") {
			$divClass = " buzz_masonry_item";
		}
?>
	<div class='buzz_feed_item <?php echo $divClass;?>'>
		<div class="buzz_feed_item_inner">
			<div class="buzz_photo_wrap">
			<div class="buzz_photo_wrap_inner">
				<div class="buzz_photo_img">
					<img class="buzz_img" src="<?php echo esc_url($image); ?>">
						<div class="buzz_photo_overlay">										
							<div class="buzz_thumb_icon">
								<a href="<?php echo esc_url($img_link); ?>">
									<?php if($buzz['type'] == 'video'): ?>									
										<i class="fa fa-play-circle-o"></i>
									<?php else : ?>
										<i class="fa fa-arrows-alt"></i>
									<?php endif; ?>
								</a>
							</div>
							<?php if(!empty($hover_enable_desable) && $hover_enable_desable ==1): ?>
								<div class="hover_profile clearfix">
									<?php if(!empty($hover_profile_image) && $hover_profile_image ==1): ?>
										<div class="hover_profile_image"><img src="<?php echo $profile_image; ?>"/></div>
									<?php endif; if(!empty($hover_profile_username) && $hover_profile_username ==1): ?>
										<div class="hover_profile_image"><?php echo esc_attr($profile_username); ?></div>
									<?php endif; ?>
								</div>
								<div class="hover_info clearfix">
									<?php if(!empty($show_likes) && $show_likes == 1) : ?>
									<div class="buzz_thumb_likes">
										<i class="fa fa-heart-o"><?php echo $likes; ?></i>
									</div>
									<?php endif; if(!empty($show_comments) && $show_comments == 1) : ?>
										<div class="buzz_thumb_comments">
											<i class="fa fa-comment"><?php echo $comments; ?></i>
										</div>
									<?php endif; if(!empty($show_description) && $show_description == 1) : ?>
										<div class="clearfix"></div>
										<div class="buzz_photo_title"><?php echo $description; ?></div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
				</div>
			</div>
		</div>
		<?php if(empty($hover_enable_desable)) : ?>
			<div class="buzz_photo_meta clearfix">
				<?php if(!empty($show_likes) && $show_likes == 1) : ?>
					<div class="buzz_thumb_likes">
						<i class="fa fa-heart-o"><?php echo $likes; ?></i>
					</div>
				<?php endif; if(!empty($show_comments) && $show_comments == 1) : ?>
					<div class="buzz_thumb_comments">
						<i class="fa fa-comment-o"><?php echo $comments; ?></i>
					</div>
				<?php endif; if(!empty($show_description) && $show_description == 1) : ?>
					<div class="clearfix"></div>
					<div class="buzz_photo_title"><?php echo $description; ?></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	</div>
		
<?php endforeach; ?>
<?php //<!-- next-page-link --> ?>
<i class='ajax-buzz-feeds-load-more' data-pagination-link="<?php echo $ins_media['pagination']['next_url']; ?>">Load more</i>