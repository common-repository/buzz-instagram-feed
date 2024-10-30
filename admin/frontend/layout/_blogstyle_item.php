<?php
    defined( 'ABSPATH' ) or die( "No script kiddies please!" );
    if (!function_exists("buzzTimeAgo") ){
        function buzzTimeAgo ($tm, $rcs = 0) {
            $cur_tm = time(); 
            $dif = $cur_tm-$tm;
            $pds = array('second','minute','hour','day','week','month','year','decade');
            $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);
        
            for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);
                $no = floor($no);
                if($no <> 1)
                    $pds[$v] .='s';
                $x = sprintf("%d %s ",$no,$pds[$v]);
                if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0))
                    $x .= time_ago($_tm);
                return $x. 'ago';
        }
    }
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
    $buzz_count = 1;        
    foreach ($formated_array as $buzz) :                        
        $image = $buzz['images']['low_resolution']['url'];           
        $likes = esc_attr($buzz['likes']['count']);
        $comments = esc_attr($buzz['comments']['count']);
        $description = esc_textarea($buzz['caption']['text']);
        $profile_image = esc_url($buzz['caption']['from']['profile_picture']);
        $profile_username = $buzz['user']['username'];
        $img_link = $buzz['link'];

        $divClass = '';
        if(!empty($display_insta_blog_feeds) && $display_insta_blog_feeds == 1) {
            if($buzz_count%2 == 1){
                $divClass= 'buzz_odd';
            } else {
                $divClass= 'buzz_even';
            }
        }
?>
    <div class="buzz_feed_item clearfix <?php echo $divClass; ?>">
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
                            </div><!-- Overlay Image Type -->
                        </div>
                    <div class="buzz_post_time">
                        <?php
                            $timeAgo = $buzz['created_time'];
                            echo buzzTimeAgo($timeAgo);
                        ?>
                    </div> <!-- Image Post Type -->
                </div>
            </div>
        </div>
        <div class="buzz_general_meta">
            <div class="table-outer">
                <div class="table-inner">
                    <div class="buzz_title"><?php echo esc_attr($profile_username); ?></div>
                    <div class="buzz_desc">
                        <?php if(!empty($show_description) && $show_description == 1) : ?>
                            <div class="buzz_description"><?php echo $description; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="buzz_comment_like clearfix">
                        <?php if(!empty($show_likes) && $show_likes == 1) : ?>
                            <div class="buzz_thumb_likes">
                                <?php echo $likes; ?> <?php _e('Likes',IBUZZF_TEXT_DOMAIN) ?>
                            </div>
                        <?php endif; if(!empty($show_comments) && $show_comments == 1) : ?>
                        <div class="buzz_thumb_comments">
                            <?php echo $comments; ?> <?php _e('Comments',IBUZZF_TEXT_DOMAIN) ?>
                        </div>
                        <?php endif; ?>
                    </div> 
                    <div class="buzz_view_more"><a href="<?php echo esc_url($img_link); ?>"><?php _e('Details',IBUZZF_TEXT_DOMAIN) ?></a><i class="fa fa-angle-double-right"></i></div>
                </div>
            </div>
        </div>
    </div>
<?php $buzz_count++; endforeach; ?>
<?php //<!-- next-page-link --> ?>
<i class='ajax-buzz-feeds-load-more hide' data-pagination-link="<?php echo $ins_media['pagination']['next_url']; ?>">Load more</i>