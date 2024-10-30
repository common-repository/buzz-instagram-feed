<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="buzz-boards-tabs" id="buzz-board-buzz-instagram-settings">
    <div class="buzz-tab-wrapper"> 
        <!--Instagram-->
        <div class="buzz-option-outer-wrapper">
            <div class="buzz-sub-title"><?php _e('Instagram Feed', IBUZZF_TEXT_DOMAIN) ?></div>
            <div class="buzz-option-extra">
                <div class="buzz-option-inner-wrapper">
                    <label><?php _e('Instagram Username', IBUZZF_TEXT_DOMAIN); ?></label>
                    <div class="buzz-option-field">
                        <input type="text" name="instagram[username]" value="<?php echo esc_attr($ibuzzf_settings['username']);?>"/>
                        <div class="buzz-option-note"><?php _e('Please enter the instagram username', IBUZZF_TEXT_DOMAIN); ?></div>
                    </div>
                </div>
                <div class="buzz-option-inner-wrapper">
                    <label><?php _e('Instagram User ID', IBUZZF_TEXT_DOMAIN); ?></label>
                    <div class="buzz-option-field">
                        <input type="text" name="instagram[user_id]" value="<?php  echo esc_attr($ibuzzf_settings['user_id']);?>"/>
                        <div class="buzz-option-note"><?php _e('Please enter the instagram user ID.You can get this information from <a href="http://www.pinceladasdaweb.com.br/instagram/access-token/" target="_blank">http://www.pinceladasdaweb.com.br/instagram/access-token/</a>', IBUZZF_TEXT_DOMAIN); ?></div>
                    </div>
                </div>
                <div class="buzz-option-inner-wrapper">
                    <label><?php _e('Instagram Access Token', IBUZZF_TEXT_DOMAIN); ?></label>
                    <div class="buzz-option-field">
                        <?php
                            if(isset($_GET['access_token'])){
                                $access_token = $_GET['access_token'];
                            }else if(isset($ibuzzf_settings['access_token']) && $ibuzzf_settings['access_token'] !=''){
                                $access_token = $ibuzzf_settings['access_token'];
                            }else{
                                $access_token = '';
                            }
                        ?>
                        <input type="text" name="instagram[access_token]" value="<?php echo $access_token; ?>"/>
                        <div class="buzz-option-note"><?php _e('Please ', IBUZZF_TEXT_DOMAIN); ?></div>
                        <?php $new_url = urlencode(admin_url('admin.php?page=buzz-instagram-feed')) . '&response_type=token'; ?>
                        <span id="buzz-access-token-generator">
                                <a href="https://api.instagram.com/oauth/authorize/?client_id=54da896cf80343ecb0e356ac5479d9ec&scope=basic+public_content&redirect_uri=http://api.web-dorado.com/instagram/?return_url=<?php echo $new_url;?>">Get Access Token</a>
                        </span>
                        <span>here.</span>
                    </div>
                </div>
            </div>
        </div>
        <!--Instagram-->          
      </div>
</div>