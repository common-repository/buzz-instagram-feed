jQuery(document).ready(function($) {

function buzz_instagram_feed_masonry(){
  // Masonry Layout Short Scripts
  if(feed_ajax_object.instagram_layout == 'masonry'){
  	$('div').find('.buzz_masonry').masonry({
      itemSelector: '.buzz_masonry_item',
    });
  }
}
buzz_instagram_feed_masonry();
  
var loaded = true;
if ( feed_ajax_object.instgram_pagination_type == 'infinitescroll') {
  $(window).scroll(function() {
    var offset = $( '.buzz-feeds-load-more' ).offset();
    var scrollTop = $(window).scrollTop();
    try{
      var top = offset.top;
      var abc = parseFloat(scrollTop) + 300;
      var top = parseFloat(top);
      if(  top  <= abc  && loaded ) {
        $(".buzz-feeds-load-more").trigger("click");
      }
    }catch(e){
      console.log(e);
    }
  });
}
// Ajax Loads More Feeds 
    $(document.body).on('click', '.buzz-feeds-load-more' ,function(){
      var selector = $(this);
      var link = selector.attr('data-pagination-link');
      var layout = selector.attr('data-layout-name');
      var random_no = selector.attr('data-random-num');
      
      $.ajax({
        type: 'POST',
        url: feed_ajax_object.ajax_url,
        data: {
                'action': 'buzz_loads_more_feeds',
                'pagination_link': link,
                '_wpnonce' : feed_ajax_object.ajax_nonce,
        },
        beforeSend: function() {
          selector.closest('.buzz_pagination').find('.buzz_wait_loader').show();
          selector.hide();
          loaded = false;
        },
        success: function( response ){
          selector.closest('.buzz_pagination').find('.buzz_wait_loader').hide();
          selector.show();
          var $boxHtml = $(response);
          selector.parents('.buzz_feed_wrapper').addClass("ABCD");
          var $content = selector.parents('.buzz_feed_wrapper').children().first().append($boxHtml);
          
          var next_page = jQuery('i.ajax-buzz-feeds-load-more:last')
          var next_link = next_page.attr('data-pagination-link');
          next_page.remove();
          selector.attr('data-pagination-link', next_link );
          loaded = true;
          
          
          // for masonry view only
          if(feed_ajax_object.instagram_layout == 'masonry'){
            setTimeout(function(){
              $content.masonry('appended', $boxHtml);
            }, 5000)
          }
          
        } // sucess end
      });
    });
  
});