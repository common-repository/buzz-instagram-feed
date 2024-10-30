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
	$fancycount = 0;
    foreach($formated_array as $buzz) :				    	
    		$image = $buzz['images']['standard_resolution']['url'];
    		$lowimage = $buzz['images']['low_resolution']['url'];	    	
    	$likes = esc_attr($buzz['likes']['count']);
    	$comments = esc_attr($buzz['comments']['count']);
    	$description = esc_textarea($buzz['caption']['text']);
    	$profile_image = esc_url($buzz['caption']['from']['profile_picture']);
    	$profile_username = $buzz['user']['username'];
    	$img_link = $buzz['link'];
    if($fancycount < 1){        
?>
	<div class="buzz_feed_item <?php if(!empty($hover_enable_desable) && $hover_enable_desable ==1){ echo 'buzz-hover-fancygallery'; }else { echo 'no-buzz-hover-fancygallery'; } ?>">
		<div class="buzz_photo_wrap">
			<div class="buzz_photo_wrap_inner">
				<div class="buzz_photo_img">
					<div class="buzz_photo_img_inner">
						<img class="buzz_img" src="<?php echo esc_url($image); ?>">
						<div class="buzz_thumb_icon">
							<div class="table-outer">
								<div class="table-inner">
									<a href="<?php echo esc_url($img_link); ?>">
										<?php if($buzz['type'] == 'video'): ?>									
											<i class="fa fa-play-circle-o"></i>
										<?php else : ?>
											<i class="fa fa-arrows-alt"></i>
										<?php endif; ?>
									</a>
								</div>
							</div>
						</div>
						<div class="buzz_photo_overlay clearfix">
							<div class="table-outer">
								<div class="table-inner">
									<?php if(!empty($hover_enable_desable) && $hover_enable_desable ==1) : ?>
										<div class="hover_profile clearfix">
											<?php if(!empty($hover_profile_image) && $hover_profile_image ==1): ?>
												<div class="hover_profile_image"><img src="<?php echo $profile_image; ?>"/></div>
											<?php endif; if(!empty($hover_profile_username) && $hover_profile_username ==1): ?>
												<div class="hover_profile_image"><?php echo esc_attr($profile_username); ?></div>
											<?php endif; ?>
										</div>
										<div class="hover_info">
													<?php if(!empty($show_likes) && $show_likes == 1) : ?>
													<div class="buzz_thumb_likes">
														<i class="fa fa-heart-o"><?php echo $likes; ?></i>
													</div>
													<?php endif; if(!empty($show_comments) && $show_comments == 1) : ?>
														<div class="buzz_thumb_comments">
															<i class="fa fa-comment-o"><?php echo $comments; ?></i>
														</div>
													<?php endif; if(!empty($show_description) && $show_description == 1) : ?>
														<div class="clear"></div>
														<div class="buzz_photo_title"><?php echo $description; ?></div>
													<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
<?php }else{ ?>
	<div class="buzz_feed_item buzz_col_3 <?php if(!empty($hover_enable_desable) && $hover_enable_desable ==1){ echo 'buzz-hover-fancygallery'; }else { echo 'no-buzz-hover-fancygallery'; } ?>">
		<div class="buzz_photo_wrap">
			<div class="buzz_photo_wrap_inner">
				<div class="buzz_photo_img">
					<div class="buzz_photo_img_inner">
						<img class="buzz_img" src="<?php echo esc_url($lowimage); ?>">
						<div class="buzz_thumb_icon">
							<div class="table-outer">
								<div class="table-inner">
									<a href="<?php echo esc_url($img_link); ?>">
										<?php if(esc_attr($buzz['type']) == 'video'): ?>									
											<i class="fa fa-play-circle-o"></i>
										<?php else : ?>
											<i class="fa fa-arrows-alt"></i>
										<?php endif; ?>
									</a>
								</div>
							</div>
						</div>
						<div class="buzz_photo_overlay clearfix">
							<div class="table-outer">
								<div class="table-inner">
									<?php if(!empty($hover_enable_desable) && $hover_enable_desable ==1): ?>
										<div class="hover_profile clearfix">
											<?php if(!empty($hover_profile_image) && $hover_profile_image ==1): ?>
												<div class="hover_profile_image"><img src="<?php echo $profile_image; ?>"/></div>
											<?php endif; if(!empty($hover_profile_username) && $hover_profile_username ==1): ?>
												<div class="hover_profile_image"><?php echo esc_attr($profile_username); ?></div>
											<?php endif; ?>
										</div>
										<div class="hover_info">
											<?php if(!empty($show_likes) && $show_likes == 1) : ?>
											<div class="buzz_thumb_likes">
												<i class="fa fa-heart-o"><?php echo $likes; ?></i>
											</div>
											<?php endif; if(!empty($show_comments) && $show_comments == 1) : ?>
												<div class="buzz_thumb_comments">
													<i class="fa fa-comment-o"><?php echo $comments; ?></i>
												</div>
											<?php endif; if(!empty($show_description) && $show_description == 1) : ?>
												<div class="clear"></div>
												<div class="buzz_photo_title"><?php echo $description; ?></div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
<?php } $fancycount++; endforeach; ?>

<?php //<!-- next-page-link --> ?>
<i class='ajax-buzz-feeds-load-more hide' data-pagination-link="<?php echo $ins_media['pagination']['next_url']; ?>">Load more</i>