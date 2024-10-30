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
?>
<?php if(isset($ins_media['meta']['error_message'])){ ?>
        <h1 class="widget-title-insta">
            <span><?php echo $ins_media['meta']['error_message']; ?></span>
        </h1>
<?php } else if (is_array($ins_media['data']) || is_object($ins_media['data'])) {
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
     $buzz_rand_number = rand();
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
            $( '.ri-grid-<?php echo $buzz_rand_number; ?>' ).gridrotator({
                rows : '2',
                columns : '6',
                maxStep : 2,
                interval : 2000,
                preventClick : false,
                w1024 : {
                    rows : '2',
                    columns : '6'
                },
                w768 : {
                    rows : '3',
                    columns : '4'
                },
                w480 : {
                    rows : '5',
                    columns : '4'
                },
                w320 : {
                    rows : '5',
                    columns : '3'
                },
                w240 : {
                    rows : '5',
                    columns : '2'
                }
            });

        });
</script>
    
    
    <div class="ri-grid ri-grid-<?php echo $buzz_rand_number; ?> buzz-rotatorgrid">
        <ul>
            <?php
                foreach ($formated_array as $buzz) :                        
                $image = $buzz['images']['standard_resolution']['url'];
                $img_link = $buzz['link'];
            ?>
            <li>
                <a href="<?php echo esc_url($img_link); ?>">
                    <img src="<?php echo esc_url($image); ?>" alt='<?php echo strip_tags(substr($buzz['caption']['text'], 0, 20)); ?>'>
                </a>
            </li>
            <?php endforeach; ?> 
        </ul>
    </div>
<?php } ?>