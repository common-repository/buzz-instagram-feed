<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/*
Plugin name: Buzz Instagram Feed
Plugin URI: http://demo.spiderbuzz.com/plugins/instagram-buzz-feed/
Description: Display beautifully clean, customizable, and responsive feeds with Thumbnails, Masonry, Instagram, Blog, Fancy Gallery and Grid Rotator Layout
Version: 1.0.3
Author: spiderbuzz
Author URI: http://spiderbuzz.com
Text Domain:buzz-instagram-feed
Domain Path: /languages/
License: GPLv2 or later
*/

//Decleration of the necessary constants for plugin

if( !defined( 'IBUZZF_VERSION' ) ) {
    define( 'IBUZZF_VERSION', '1.0.3' );
}

if( !defined( 'IBUZZF_IMAGE_DIR' ) ) {
    define( 'IBUZZF_IMAGE_DIR', plugin_dir_url( __FILE__ ) . 'images' );
}

if( !defined( 'IBUZZF_JS_DIR' ) ) {
    define( 'IBUZZF_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );
}

if( !defined( 'IBUZZF_CSS_DIR' ) ) {
    define( 'IBUZZF_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' );
}

if( !defined( 'IBUZZF_INST_PATH' ) ) {
    define( 'IBUZZF_INST_PATH', plugin_dir_path( __FILE__ ) );
}

if( !defined( 'IBUZZF_LANG_DIR' ) ) {
    define( 'IBUZZF_LANG_DIR', basename( dirname( __FILE__ ) ) . '/languages/' );
}

if( !defined( 'IBUZZF_TEXT_DOMAIN' ) ) {
    define( 'IBUZZF_TEXT_DOMAIN', 'buzz-instagram-feed' );
}
/***********************************************
 * Register of widgets                        **
 ***********************************************/
include_once( 'admin/frontend/widgetside.php' );

if( !class_exists( 'IBUZZF_Class' ) ) {    
    class IBUZZF_Class {        
        var $ibuzzf_settings;
        function __construct() {
            $this->ibuzzf_settings = get_option( 'ibuzzf_settings' );
            register_activation_hook( __FILE__, array($this, 'load_default_settings') ); //loads default settings for the plugin while activating the plugin
            add_action( 'init', array($this, 'plugin_text_domain') ); //loads text domain for translation ready
            add_action( 'init', array($this, 'session_init') ); //starts the session
            add_action( 'admin_menu', array($this, 'add_instagram_menu') ); //adds plugin menu in wp-admin
            add_action( 'admin_enqueue_scripts', array($this, 'register_admin_assets') ); //registers admin assests such as js and css
            add_action( 'wp_enqueue_scripts', array($this, 'register_frontend_assets') ); //registers js and css for frontend
            add_action( 'admin_post_ibuzzf_settings_action', array($this, 'ibuzzf_settings_action') ); //recieves the posted values from settings form
            add_action( 'admin_post_ibuzzf_restore_default', array($this, 'ibuzzf_restore_default') ); //restores default settings;
            
            add_shortcode( 'buzz_instagram_feed', array($this, 'buzz_instagram_feed') );
            add_action( 'widgets_init', array($this, 'register_ibuzzf_widget') ); //registers the widget            
            
            // Call Ajax Loads More Instagram Feeds Function
            add_action( 'wp_ajax_buzz_loads_more_feeds', array($this, 'buzz_loads_more_feeds') );
            add_action( 'wp_ajax_nopriv_buzz_loads_more_feeds', array($this, 'buzz_loads_more_feeds') );
        }
        /***********************************************
         * Plugin Translation                         **
         ***********************************************/       
        function plugin_text_domain() {
            load_plugin_textdomain( IBUZZF_TEXT_DOMAIN, false, basename( dirname( __FILE__ ) ) . '/languages/' );
        }
        /***********************************************
         * Load Default Settings                      **
         ***********************************************/       
        function load_default_settings() {
            if( !get_option( 'ibuzzf_settings' ) ) {
                $ibuzzf_settings = $this->get_instagram_settings();
                update_option( 'ibuzzf_settings', $ibuzzf_settings );
            }
        }
        /***********************************************
         * Plugin Admin Menu                          **
         ***********************************************/ 
        function add_instagram_menu() {
            add_menu_page( __( 'Buzz Instagram Feed', IBUZZF_TEXT_DOMAIN ), __( 'Buzz Instagram Feed', IBUZZF_TEXT_DOMAIN ), 'manage_options', IBUZZF_TEXT_DOMAIN, array($this, 'instagram_main_page'), IBUZZF_IMAGE_DIR . '/instagram-icon.png' );
        }

        //plugins backend admin page
        function instagram_main_page() {
            include( 'admin/backend/main-page.php' );
        }
        /***********************************************
         * Loads More Instagram Feeds                 **
         ***********************************************/        
        function buzz_loads_more_feeds() 
        {
            if( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'buzz-ajax-nonce' ) )
            {
                include( 'admin/buzz-feeds-ajax.php');
                wp_die();
            }
        }

        /***********************************************
         * Starts the session                         **
         ***********************************************/
        function session_init() {
            if( !session_id() && !headers_sent() ) {
                session_start();
            }
        }
        /***********************************************
         * Returns Default Settings                   **
         ***********************************************/
        function get_instagram_settings() {
            $ibuzzf_settings = array(
                'username' => '', 
                'access_token' => '', 
                'user_id' => '',
                'instagram_layout' => 'thumbnails',
                'display_insta_blog_feeds' => '',
                'feed_type' => 'self',
                'any_user_username' => '',
                'tag_name' => '',
                'feed_display_type' => 'loadmore',
                'sort_images_by' => 'date',
                'number_of_photos' => 12,
                'number_of_columns' => 3,
                'show_likes' => 1,
                'show_comments' => 1,
                'show_description' => 1,
                'hover_enable_desable' => '',
                'hover_profile_image' => 1,
                'hover_profile_username' => 1
            );
            return $ibuzzf_settings;
        }

        /***********************************************
         * Saves settings to database                 **
         ***********************************************/      
        function ibuzzf_settings_action() {
            if( !empty( $_POST ) && wp_verify_nonce( $_POST['ibuzzf_settings_nonce'], 'ibuzzf_settings_action' ) ) {
                
                include( 'admin/backend/save-settings.php' );
            }
        }
        
        /***********************************************
         * Registering of backend js and css          **
         ***********************************************/        
        function register_admin_assets() {
            if( isset( $_GET['page'] ) && $_GET['page'] == 'buzz-instagram-feed' ) {
                wp_enqueue_style( 'sc-admin-css', IBUZZF_CSS_DIR . '/backend.css', array(), IBUZZF_VERSION );
                wp_enqueue_script( 'sc-admin-js', IBUZZF_JS_DIR . '/backend.js', array('jquery', 'jquery-ui-sortable'), IBUZZF_VERSION );
                $ibuzzf_settings = get_option( 'ibuzzf_settings' );
                $instagram_layout = esc_attr($ibuzzf_settings['instagram_layout']);
                wp_localize_script('sc-admin-js', 'buzz_layout_options', array('instagram_layout' => $instagram_layout));
            }
        }

        /***********************************************
         * Registers Frontend Assets                  **
         ***********************************************/       
        function register_frontend_assets() {
          
            wp_enqueue_style( 'buzz-frontend-css', IBUZZF_CSS_DIR . '/frontend.css', array(), IBUZZF_VERSION );
            wp_enqueue_style( 'buzz-font-awesome', IBUZZF_CSS_DIR . '/font-awesome.min.css', array(), IBUZZF_VERSION );
            wp_enqueue_style( 'buzz-gridrotator', IBUZZF_CSS_DIR . '/gridrotator.css', IBUZZF_VERSION );

            wp_enqueue_script('jquery-masonry');
            wp_enqueue_script( 'buzz-modernizr', IBUZZF_JS_DIR . '/modernizr.custom.26633.js', '', IBUZZF_VERSION );
            wp_enqueue_script( 'buzz-gridrotator', IBUZZF_JS_DIR . '/jquery.gridrotator.js', array('jquery', 'buzz-modernizr'), IBUZZF_VERSION );
            wp_enqueue_script( 'buzz-frontend-js', IBUZZF_JS_DIR . '/frontend.js', array('jquery'), IBUZZF_VERSION );
            // Call Ajax Function for Instagram Loads More Feeds
            $ajax_nonce = wp_create_nonce( 'buzz-ajax-nonce' );
            $ibuzzf_settings = get_option( 'ibuzzf_settings' );
            $feed_pagination_type = esc_attr($ibuzzf_settings['feed_display_type']);
            $instagram_layout = esc_attr($ibuzzf_settings['instagram_layout']);
            wp_localize_script( 'buzz-frontend-js', 'feed_ajax_object', array('ajax_url' => admin_url() . 'admin-ajax.php', 'ajax_nonce' => $ajax_nonce, 'instgram_pagination_type' => $feed_pagination_type, 'instagram_layout' => $instagram_layout) );
        }

        /***********************************************
         * Instagram feed shortcode                   **
         ***********************************************/
        function buzz_instagram_feed() {
            ob_start();
            include( 'admin/frontend/instagram-feed.php' );
            $html = ob_get_contents();
            ob_get_clean();
            return $html;            
        }
        /***********************************************
         * Buzz Instagram Feed Widget                 **
         ***********************************************/       
        function register_ibuzzf_widget() {
            register_widget( 'IBUZZF_SideWidget' );
        }
    }
    $sc_object = new IBUZZF_Class(); //initialization of plugin    
}