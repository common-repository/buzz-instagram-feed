<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
class InstaWCD{
    
    function userID($username) {
        $token = $this->access_token;
        $username = strtolower( $username ); // sanitization
        if( !empty( $username ) && !empty( $token ) ) {
            $url = "https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=" . $token;
            $get = wp_remote_get( $url );
            $response = wp_remote_retrieve_body( $get );
            $json = json_decode( $response );
            
            foreach( $json->data as $user ) {
                if( $user->username == $username ) {
                    return $user->id;
                }
            }
            return '00000000'; // return this if nothing is found
        }
    }

    //function to get the recent media uploaded by user
    function userMedia($number_of_photos) {
        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $this->access_token.'&count='.$number_of_photos;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        $json = json_decode( $response, true );
        return $json;
    }
    
    function anyUserFeed($username, $number_of_photos){
        $user_id = $this->userID($username);
        $url = 'https://api.instagram.com/v1/users/' . $user_id . '/media/recent/?access_token=' . $this->access_token.'&count='.$number_of_photos;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );
    }
    
    //function to get the user's instagram feeds
    function userFeed($number_of_photos){
        $url = 'https://api.instagram.com/v1/users/self/feed?access_token=' . $this->access_token.'&count='.$number_of_photos;
        $json = self:: get_remote_data_from_instagram_in_json($url);
        return $json;
    }

    function get_remote_data_from_instagram_in_json($url){
        $content = wp_remote_get( $url );
        if(isset($content->errors)){
            echo $content->errors['http_request_failed']['0'];
            die();
        }else{
            $response = wp_remote_retrieve_body( $content );
            $json = json_decode( $response, true );
            return $json;
        }
    }

    //function to get the recent media liked by user
    function userLiked($number_of_photos){
        $url = 'https://api.instagram.com/v1/users/self/media/liked?access_token=' . $this->access_token.'&count='.$number_of_photos;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );
    }

    //function to get the user's instagram feeds using ajax
    function ajaxuserFeed($url){
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );
    }

    //function that Gets a list of what media is most popular at the moment. Can return mix of image and video types.
    function instagramPopular($number_of_photos){
        $url = 'https://api.instagram.com/v1/media/popular?access_token=' . $this->access_token.'&count='.$number_of_photos;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );
    }

    //function to get the recent comment of the specified media object.
    function getComments($media_id){
        $url = "https://api.instagram.com/v1/media/{$media_id}/comments?access_token=" . $this->access_token;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );

    }

    static function displayComments($media_comments, $limit){
         $i=1;
        echo "<div class='comments'>";
        foreach ($media_comments['data'] as $comments){
            echo "<div class='each-comment'>";
                        echo "<div class='user-link'>";
                        echo "<a href='https://instagram.com/{$comments['from']['username']}'>{$comments['from']['full_name']}</a>";
                        echo "</div>";

                        echo "<div class='comment-text'>";
                        echo $comments['text'];
                        echo "</div>";

            echo "</div>";
            if ($i++ >= $limit) break;
        }
        echo "</div>";
    }


    function getTagInfo($tag_name){
        $url = "https://api.instagram.com/v1/tags/{$tag_name}?access_token=" . $this->access_token;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );
    }

    function getTagRecentMedia($tag_name, $number_of_photos){
        $url = "https://api.instagram.com/v1/tags/{$tag_name}/media/recent?access_token=" . $this->access_token.'&count='.$number_of_photos;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );
    }

    function paginationData($max_min_id, $tag_name, $number_of_photos) {
        $url = "https://api.instagram.com/v1/tags/{$tag_name}/media/recent?access_token=". $this->access_token. '&count='.$number_of_photos.'&max_tag_id='.$max_min_id;
        $content = wp_remote_get( $url );
        $response = wp_remote_retrieve_body( $content );
        return $json = json_decode( $response, true );
    }
    
}
$insta = new InstaWCD();
$insta->username = $username;
$insta->access_token = $access_token;

function buzzSortByLikesOrder($a, $b) {
    return $b['likes_count'] - $a['likes_count'];
}

function buzzSortByCommentOrder($a, $b) {
    return $b['comment_count'] - $a['comment_count'];
}

function buzzSortByDateOrder($a, $b) {
    return $b['created_time'] - $a['created_time'];
}