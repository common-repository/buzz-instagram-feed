<?php defined('ABSPATH') or die("No script kiddies please!");
/***********************************************
 * Adds Buxzz Instagram Feed Widget           **
 ***********************************************/
class IBUZZF_SideWidget extends WP_Widget {

    /***********************************************
     * Register widget with WordPress             **
     ***********************************************/  
    function __construct() {
        parent::__construct(
                'ibuzzf_sidewidget', // Base ID
                __('Buzz : Instagram Feeds', IBUZZF_TEXT_DOMAIN), // Name
                array('description' => __('Instagram Buzz Feeds', IBUZZF_TEXT_DOMAIN)) // Args
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        if ( intval($instance['instance_lightbox']) ){        

            wp_enqueue_style( 'sc-prettyPhoto-css', IBUZZF_CSS_DIR . '/prettyPhoto.css', array(), IBUZZF_VERSION );
            wp_enqueue_script( 'sc-prettyPhoto-js', IBUZZF_JS_DIR . '/jquery.prettyPhoto.js', array('jquery'), IBUZZF_VERSION );
            ?>        
             
            <script type="text/javascript" charset="utf-8">
                jQuery(document).ready(function($){
                    $("a[rel^='prettyPhoto']").prettyPhoto({
                        wmode: 'opaque',
                        opacity: 0.80,
                        animation_speed:'normal',
                        theme:'light_square',
                        slideshow:6000,
                        autoplay_slideshow: true
                    });
                });
            </script>

    <?php
        } // if ligbhox enable (end if)

        
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        } 
        
    $instagram_num_img = isset($instance['instagram_num_img']) ? $instance['instagram_num_img']:'12';
    $instance_header = (isset($instance['instance_header']) && $instance['instance_header']==1)?'true':'false';
        
    global $ibuzzf_settings, $insta;
    $ibuzzf_settings = get_option( 'ibuzzf_settings' );
    $username = !empty($ibuzzf_settings['username']) ? $ibuzzf_settings['username'] : '';
    $user_id = !empty($ibuzzf_settings['user_id']) ? $ibuzzf_settings['user_id'] : '';
    $social_profile_url = 'https://instagram.com/' . $username;
    $access_token = !empty($ibuzzf_settings['access_token']) ? $ibuzzf_settings['access_token'] : '';
    $api_url = 'https://api.instagram.com/v1/users/' . $user_id . '?access_token=' . $access_token;
   
    $connection = wp_remote_get($api_url);  
    $response = json_decode($connection['body'], true);
     
    if(isset($response['meta']['error_message'])){
    ?><div class="instagram-header">
        <div class="profile profile-name">
            <h1><span><?php echo $response['meta']['error_message']; ?></span></h1>
        </div>
    </div>
    <?php  }else{
   if($instance_header == 'true'){
   ?>
    <div class="instagram-header">
        <div class="profile clearfix">
            <div class="profile-img">
                <img src="<?php echo $response['data']['profile_picture']; ?>"/>
            </div>
            <div class="profile-name">
                <?php echo $response['data']['full_name']; ?>
            </div>
        </div>
        <div class="profile-follow clearfix">
            <div class="post">                
                <?php echo $response['data']['counts']['media']; ?>
                <span><?php _e('post',IBUZZF_TEXT_DOMAIN); ?></span>
            </div>
            <div class="followers">                
                <?php echo $response['data']['counts']['followed_by']; ?>
                <span><?php _e('followers',IBUZZF_TEXT_DOMAIN); ?></span>
            </div>
            <div class="following">                
                <?php echo $response['data']['counts']['follows']; ?>
                <span><?php _e('following',IBUZZF_TEXT_DOMAIN); ?></span>
            </div>
            <div class="follow">
                <a href="https://instagram.com/<?php echo $ibuzzf_settings['username'];  ?>" target='_blank' title='Follow <?php echo $ibuzzf_settings['username'];  ?>' ><?php _e('follow',IBUZZF_TEXT_DOMAIN); ?></a>
            </div>
        </div>
    </div>
    <?php }
   }
        require_once(IBUZZF_INST_PATH . '/admin/frontend/instagram.php');
        $ins_media = $insta->userMedia($instagram_num_img);
       
        if(isset($ins_media['meta']['error_message'])){
    ?>
        <h1 class="widget-title-insta text-black"><span><?php echo $ins_media['meta']['error_message']; ?></span></h1> 
    <?php  } else if (is_array($ins_media['data']) || is_object($ins_media['data'])){
            
            echo '<ul class="instagram-widget clear">';
                    foreach ($ins_media['data'] as $buzz){
                       $img = $buzz['images']['thumbnail']['url'];
                       $img_link = $buzz['link'];
                       
                       if ( intval($instance['instance_lightbox']) ){ 
                            $big_img = $buzz['images']['standard_resolution']['url'];
                        ?>
                            <li><figure><a href="<?php echo esc_url($big_img); ?>" rel="prettyPhoto[instagram_gl]"><img src="<?php echo esc_url($img); ?>"></a></figure></li>

                       <?php }else{ ?>
                            <li><figure><a href="<?php echo esc_url($img_link); ?>" target="_blank"><img src="<?php echo esc_url($img); ?>"></a></figure></li>
                     <?php }
                    }
            echo '</ul>';
        }       
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = isset($instance['title'])?$instance['title']:'';
        $instagram_num_img = isset($instance['instagram_num_img'])?$instance['instagram_num_img']:'';
        $instance_header = isset($instance['instance_header'])?$instance['instance_header']:'';
        $instance_lightbox = intval($instance['instance_lightbox']);
        
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', IBUZZF_TEXT_DOMAIN); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('instance_header'); ?>"><?php _e('Check to Display Header Section :', IBUZZF_TEXT_DOMAIN); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('instance_header'); ?>" name="<?php echo $this->get_field_name('instance_header'); ?>" type="checkbox" value="1" <?php checked($instance_header,true);?>/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('instagram_num_img'); ?>"><?php _e('Select Number of Image:', IBUZZF_TEXT_DOMAIN); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('instagram_num_img'); ?>" name="<?php echo $this->get_field_name('instagram_num_img'); ?>" >
                <?php for($i=1; $i<=21; $i++){  ?>
                    <option value="<?php echo intval($i); ?>" <?php selected( $instagram_num_img,''.$i ); ?>><?php echo intval($i); ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('instance_lightbox'); ?>"><?php _e('Enable Lightbox :', IBUZZF_TEXT_DOMAIN); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('instance_lightbox'); ?>" name="<?php echo $this->get_field_name('instance_lightbox'); ?>" type="checkbox" value="1" <?php checked($instance_lightbox,true);?>/>
        </p>

    <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? sanitize_text_field($new_instance['title']) : '';
        $instance['instagram_num_img'] = (!empty($new_instance['instagram_num_img']) ) ? sanitize_text_field($new_instance['instagram_num_img']) : '';
        $instance['instance_header'] = (!empty($new_instance['instance_header']) ) ? sanitize_text_field($new_instance['instance_header']) : '';

        $instance['instance_lightbox'] = intval($new_instance['instance_lightbox']);

        return $instance;
    }
}