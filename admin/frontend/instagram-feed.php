<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
 global $ibuzzf_settings, $insta;
    $ibuzzf_settings = get_option( 'ibuzzf_settings' );   
    $username = !empty($ibuzzf_settings['username']) ? $ibuzzf_settings['username'] : ''; // your username
    $access_token = !empty($ibuzzf_settings['access_token']) ? $ibuzzf_settings['access_token'] : '';
    extract($ibuzzf_settings);
    require_once('instagram.php');
    $username_attr = isset($any_user_username) ? $any_user_username : '' ;
    $tag_name = isset($tag_name) ? $tag_name : 'followmeto' ;

    switch ($feed_type) {
            case 'self':
                // get the self user feed
                $ins_media = $insta->userFeed($number_of_photos);
                break;
            
            case 'recent_media':
                //get the recent media uploaded by user
                $ins_media = $insta->userMedia($number_of_photos);
                break;

            case 'likes':
                //for user likes feed
                $ins_media = $insta->userLiked($number_of_photos);
                break;

            case 'popular_feeds':
                // for the instagram popular feeds
                $ins_media = $insta->instagramPopular($number_of_photos);
                break;
            
            case 'any_user':
                //for any user
                $username  = $username_attr; //'namrataashrestha';
                $ins_media = $insta->anyUserFeed($username, $number_of_photos);
                break;
            
            case 'tag':
                // for recent tag media
                $tag_name = $tag_name;
                $ins_media = $insta->getTagRecentMedia($tag_name, $number_of_photos);
                break;

            default:
                // get the self user feed
                $ins_media = $insta->userFeed($number_of_photos);
                break;
        }

    if ($instagram_layout == 'thumbnails' || $instagram_layout == 'masonry'){
        include('thumbnails-layout.php');
    }else if( $instagram_layout == 'instagram' ){
        include('instagram-layout.php');
    }else if($instagram_layout == 'blog_style'){
        include('blogstyle-layout.php');
    }else if($instagram_layout == 'fancygallery'){
        include('fancygallery.php');
    }else if($instagram_layout == 'carousel'){
        include('layout/carousel-layout.php');            
    }