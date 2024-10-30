<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="buzz-boards-tabs" id="buzz-board-display-settings" style="display: none">
    <div class="buzz-tab-wrapper">
        <div class="buzz-option-inner-wrapper">
            <div class="buzz-sub-title"><?php _e('Choose Instagram Themes Layout', IBUZZF_TEXT_DOMAIN); ?></div>
            <div class="buzz-option-field">
                <label>
                    <input type="radio" name="instagram[instagram_layout]" value="thumbnails" <?php if($ibuzzf_settings['instagram_layout']=='thumbnails'){?>checked="checked"<?php }?>/><?php _e('Thumbnails', IBUZZF_TEXT_DOMAIN); ?>
                    <div class="buzz-theme-image"><img src="<?php echo IBUZZF_IMAGE_DIR.'/themes/thumbinal.png';?>"/></div>
                </label>
                <label>
                    <input type="radio" name="instagram[instagram_layout]" value="masonry" <?php if($ibuzzf_settings['instagram_layout']=='masonry'){?>checked="checked"<?php }?>/><?php _e('Masonry', IBUZZF_TEXT_DOMAIN); ?>
                    <div class="buzz-theme-image"><img src="<?php echo IBUZZF_IMAGE_DIR.'/themes/masonry.png';?>"/></div>
                </label>
                <label>
                    <input type="radio" name="instagram[instagram_layout]" value="instagram" <?php if($ibuzzf_settings['instagram_layout']=='instagram'){?>checked="checked"<?php }?>/><?php _e('Instagram', IBUZZF_TEXT_DOMAIN); ?>
                    <div class="buzz-theme-image"><img src="<?php echo IBUZZF_IMAGE_DIR.'/themes/instagram.png';?>"/></div>
                </label>
                <label>
                    <input type="radio" name="instagram[instagram_layout]" value="blog_style" <?php if($ibuzzf_settings['instagram_layout']=='blog_style'){?>checked="checked"<?php }?>/><?php _e('Blog Style', IBUZZF_TEXT_DOMAIN); ?>
                    <div class="buzz-theme-image"><img src="<?php echo IBUZZF_IMAGE_DIR.'/themes/blogstyle.png';?>"/></div>
                </label>
                <label>
                    <input type="radio" name="instagram[instagram_layout]" value="fancygallery" <?php if($ibuzzf_settings['instagram_layout']=='fancygallery'){?>checked="checked"<?php }?>/><?php _e('Fancy Gallery', IBUZZF_TEXT_DOMAIN); ?>
                    <div class="buzz-theme-image"><img src="<?php echo IBUZZF_IMAGE_DIR.'/themes/fancygallery.png';?>"/></div>
                </label>
                <label>
                    <input type="radio" name="instagram[instagram_layout]" value="carousel" <?php if($ibuzzf_settings['instagram_layout']=='carousel'){?>checked="checked"<?php }?>/><?php _e('Grid Rotator', IBUZZF_TEXT_DOMAIN); ?>
                    <div class="buzz-theme-image"><img src="<?php echo IBUZZF_IMAGE_DIR.'/themes/gridrotator.png';?>"/></div>
                </label>                
            </div>
            <div class="buzz-sub-title"><?php _e('Instagram Feed Settings', IBUZZF_TEXT_DOMAIN); ?></div>
        </div>

        <div class="buzz-instagram-settings" id="createuser">
            <table class="form-table">
                <tbody>                    
                    <tr class="form-field alternative">
                        <th><label for="display_insta_blog_feeds"><?php _e('Display Feeds Alternative :', IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[display_insta_blog_feeds]" type="checkbox" id="display_insta_blog_feeds" value="1" <?php checked( $ibuzzf_settings['display_insta_blog_feeds'],'1'); ?>/></td>
                    </tr>                
                    <tr class="form-field">
                        <th><label for="feed_type"><?php _e('Instagram Feed Type :', IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td>
                            <select name="instagram[feed_type]" id='feed_type'>
                                <!-- <option value='self' <?php selected( $ibuzzf_settings['feed_type'], 'self' ); ?> ><?php _e('My Feeds',IBUZZF_TEXT_DOMAIN); ?></option> -->
                                <option value='recent_media' <?php selected( $ibuzzf_settings['feed_type'], 'recent_media' ); ?> ><?php _e('My recent Media',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='likes' <?php selected( $ibuzzf_settings['feed_type'], 'likes' ); ?>><?php _e('Likes',IBUZZF_TEXT_DOMAIN); ?></option>
                                <!-- <option value='popular_feeds' <?php selected( $ibuzzf_settings['feed_type'], 'popular_feeds' ); ?>><?php _e('Popular feeds',IBUZZF_TEXT_DOMAIN); ?></option> -->
                                <option value='any_user' <?php selected( $ibuzzf_settings['feed_type'], 'any_user' ); ?>><?php _e('Any User',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='tag' <?php selected( $ibuzzf_settings['feed_type'], 'tag' ); ?>><?php _e('Popular Tags',IBUZZF_TEXT_DOMAIN); ?></option>                               
                            </select>
                        </td>
                    </tr>
                    <tr class="form-field anyuser hide">
                        <th><label for="any_user_username"><?php _e('Usernames :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[any_user_username]" type="text" id="any_user_username" value="<?php echo esc_attr($ibuzzf_settings['any_user_username']);?>"/></td>
                    </tr>
                    <tr class="form-field populartags hide">
                        <th><label for="tag_name"><?php _e('Tags :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[tag_name]" type="text" id="tag_name" value="<?php echo esc_attr($ibuzzf_settings['tag_name']);?>"/></td>
                    </tr>
                    <tr class="form-field loadmore">
                        <th><label for="feed_display_type"><?php _e('Pagination Type :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td>
                            <input type="radio" name="instagram[feed_display_type]" value="loadmore" <?php if($ibuzzf_settings['feed_display_type']=='loadmore'){?>checked="checked"<?php }?>/><?php _e('Load More Button', IBUZZF_TEXT_DOMAIN); ?>
                            <input type="radio" name="instagram[feed_display_type]" value="infinitescroll" <?php if($ibuzzf_settings['feed_display_type']=='infinitescroll'){?>checked="checked"<?php }?>/><?php _e('Infinite Scroll', IBUZZF_TEXT_DOMAIN); ?>
                        </td>
                    </tr>
                    <tr class="form-field">
                        <th><label for="sort_images_by"><?php _e('Sort Images By :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td>
                            <select name="instagram[sort_images_by]" id='sort_images_by'>
                                <option value='date' <?php selected( $ibuzzf_settings['sort_images_by'], 'date' ); ?> ><?php _e('Date',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='likes' <?php selected( $ibuzzf_settings['sort_images_by'], 'likes' ); ?> ><?php _e('Likes',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='comments' <?php selected( $ibuzzf_settings['sort_images_by'], 'comments' ); ?>><?php _e('Comments',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='random' <?php selected( $ibuzzf_settings['sort_images_by'], 'random' ); ?>><?php _e('Random',IBUZZF_TEXT_DOMAIN); ?></option>                                
                            </select>
                        </td>
                    </tr>                                      
                   <!-- <tr class="form-field buzz_header">
                        <th><label for="display_header"><?php //_e('Display Header :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[display_header]" type="checkbox" id="display_header" value="1" <?php //checked( $ibuzzf_settings['display_header']); ?>/></td>
                    </tr>-->            

                    <tr class="form-field">
                        <th><label for="number_of_photos"><?php _e('Number of Feeds to Display :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[number_of_photos]" type="number" id="number_of_photos" value="<?php echo esc_attr($ibuzzf_settings['number_of_photos']);?>"/></td>
                    </tr>
                  
                    <tr class="form-field num_columns">
                        <th><label for="number_of_columns"><?php _e('Number of Columns :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td>
                            <select name="instagram[number_of_columns]" id='number_of_columns'>
                                <option value='1' <?php selected( $ibuzzf_settings['number_of_columns'], '1' ); ?> ><?php _e('1',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='2' <?php selected( $ibuzzf_settings['number_of_columns'], '2' ); ?> ><?php _e('2',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='3' <?php selected( $ibuzzf_settings['number_of_columns'], '3' ); ?> ><?php _e('3',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='4' <?php selected( $ibuzzf_settings['number_of_columns'], '4' ); ?> ><?php _e('4',IBUZZF_TEXT_DOMAIN); ?></option>
                                <option value='5' <?php selected( $ibuzzf_settings['number_of_columns'], '5' ); ?> ><?php _e('5',IBUZZF_TEXT_DOMAIN); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="form-field">
                        <th><label for="show_likes"><?php _e('Show Likes :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[show_likes]" type="checkbox" id="show_likes" value="1" <?php checked( $ibuzzf_settings['show_likes'],'1'); ?>/></td>
                    </tr>                    
                    <tr class="form-field">
                        <th><label for="show_comments"><?php _e('Show Comments :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[show_comments]" type="checkbox" id="show_comments" value="1" <?php checked( $ibuzzf_settings['show_comments'],'1'); ?>/></td>
                    </tr>
                    <tr class="form-field">
                        <th><label for="show_description"><?php _e('Show Description :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[show_description]" type="checkbox" id="show_description" value="1" <?php checked( $ibuzzf_settings['show_description'],'1'); ?>/></td>
                    </tr>
                </tbody>
            </table>
        </div>        
        <div class="buzz-instagram-settings hover_effect" id="createuser">
            <div class="buzz-option-inner-wrapper">
                <div class="buzz-sub-title"><?php _e('Hover Data Display Options', IBUZZF_TEXT_DOMAIN); ?></div>
            </div>
            <table class="form-table">
                <tbody>
                    <tr class="form-field hover_enable_desable">
                        <th><label for="hover_enable_desable"><?php _e('Enable/Desable Hover Data :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[hover_enable_desable]" type="checkbox" id="hover_enable_desable" value="1" <?php checked( $ibuzzf_settings['hover_enable_desable']); ?>/></td>
                    </tr>

                    <tr class="form-field">
                        <th><label for="hover_profile_image"><?php _e('Profile Image :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[hover_profile_image]" type="checkbox" id="hover_profile_image" value="1" <?php checked( $ibuzzf_settings['hover_profile_image']); ?>/></td>
                    </tr>
                    <tr class="form-field">
                        <th><label for="hover_profile_username"><?php _e('Profile UserName :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td><input name="instagram[hover_profile_username]" type="checkbox" id="hover_profile_username" value="1" <?php checked( $ibuzzf_settings['hover_profile_username']); ?>/></td>
                    </tr>                 
                </tbody>
            </table>
        </div>

        <?php /*<div class="buzz-instagram-settings" id="createuser">
            <div class="buzz-option-inner-wrapper">
                <div class="buzz-sub-title"><?php _e('LightBox Options', IBUZZF_TEXT_DOMAIN); ?></div>
            </div>
            <table class="form-table">
                <tbody>
                    <tr class="form-field">
                        <th><label for="feed_item_onclick"><?php _e('Image Onclick :',IBUZZF_TEXT_DOMAIN); ?></label></th>
                        <td>
                            <input type="radio" name="instagram[feed_item_onclick]" value="lightbox" <?php if($ibuzzf_settings['feed_item_onclick']=='lightbox'){?>checked="checked"<?php }?>/><?php _e('Open Lightbox', IBUZZF_TEXT_DOMAIN); ?>
                            <input type="radio" name="instagram[feed_item_onclick]" value="reinstagram" <?php if($ibuzzf_settings['feed_item_onclick']=='reinstagram'){?>checked="checked"<?php }?>/><?php _e('Redirect To Instagram', IBUZZF_TEXT_DOMAIN); ?>
                            <input type="radio" name="instagram[feed_item_onclick]" value="none" <?php if($ibuzzf_settings['feed_item_onclick']=='none'){?>checked="checked"<?php }?>/><?php _e('Do Nothing', IBUZZF_TEXT_DOMAIN); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>*/ ?>
    </div>
</div>
