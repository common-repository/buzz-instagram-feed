<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="buzz-fancygallery-wrap">
	<?php if(isset($ins_media['meta']['error_message'])){ ?>
	        <h1 class="widget-title-insta">
	        	<span><?php echo $ins_media['meta']['error_message']; ?></span>
	       	</h1>
	<?php } else if (is_array($ins_media['data']) || is_object($ins_media['data'])) {
			include("_fancygallery_item.php");
		 } ?>
</div>
<div class="clearfix"></div>

<!-- Load More Feeds -->
<div class='buzz_pagination clearfix'>			    
    <a href='javascript:void(0);' class='load-more-button buzz-feeds-load-more'
        data-pagination-link="<?php echo $ins_media['pagination']['next_url']; ?>"
        >Load more</a>
    <div id='buzz_wait_loader-grid_layout' class='buzz_wait_loader' style='display:none;'>
    	<img src='<?php echo IBUZZF_IMAGE_DIR; ?>/loader.gif' alt='Loading' />
    </div>
</div>