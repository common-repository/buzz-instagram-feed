<?php 
    defined('ABSPATH') or die("No script kiddies please!");
    $ibuzzf_settings = get_option( 'ibuzzf_settings' );
?>
<div class="wrap">
    <div class="buzz-add-set-wrapper clearfix">
        <div class="buzz-panel">
            <div class="buzz-settings-header">
                <div class="buzz-logo">
                    <img src="<?php echo IBUZZF_IMAGE_DIR; ?>/instagram.png" alt="<?php esc_attr_e('Instagram Buzz Feed', IBUZZF_TEXT_DOMAIN); ?>" />
                </div>               
                <div class="buzz-title"><?php _e('Buzz Instagram Feed', IBUZZF_TEXT_DOMAIN); ?></div>
            </div>
            <?php if(isset($_SESSION['ibuzzf_message'])){?><div class="buzz-success-message"><p><?php echo $_SESSION['ibuzzf_message']; unset($_SESSION['ibuzzf_message']);?></p></div><?php }?>

            <div class="buzz-boards-wrapper">
                <ul class="buzz-settings-tabs">
                    <li><a href="javascript:void(0)" id="buzz-instagram-settings" class="buzz-tabs-trigger buzz-active-tab"><?php _e('Instagram Profiles', IBUZZF_TEXT_DOMAIN) ?></a></li>

                    <li><a href="javascript:void(0)" id="display-settings" class="buzz-tabs-trigger"><?php _e('Display Layout Settings', IBUZZF_TEXT_DOMAIN); ?></a></li>
                    
                    <li><a href="javascript:void(0)" id="how_to_use-settings" class="buzz-tabs-trigger"><?php _e('How to use', IBUZZF_TEXT_DOMAIN); ?></a></li>

                    <li><a href="javascript:void(0)" id="about-settings" class="buzz-tabs-trigger"><?php _e('About Us', IBUZZF_TEXT_DOMAIN); ?></a></li>

                </ul>
                <div class="metabox-holder">
                    <div id="buzz" class="postbox" style="float: left;">
                        <form class="buzz-settings-form" method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
                            <input type="hidden" name="action" value="ibuzzf_settings_action"/>
                        <?php
                            include_once('boards/instagram-profiles.php');
                            include_once('boards/display-settings.php');
                            include_once('boards/how-to-use.php');
                            include_once('boards/about.php');
                            wp_nonce_field('ibuzzf_settings_action', 'ibuzzf_settings_nonce');
                        ?>
                            <div id="buzz-submit" class="buzz-settings-submit">
                                <input type="submit" class="button button-primary" value="Save all changes" name="buzz_settings_submit"/>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div><!--div class wrap-->