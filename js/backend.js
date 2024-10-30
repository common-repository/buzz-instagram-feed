(function ($) {
    $(function () {
       $('.buzz-tabs-trigger').click(function(){
        $('.buzz-tabs-trigger').removeClass('buzz-active-tab');
        $(this).addClass('buzz-active-tab');
        var board_id = 'buzz-board-'+$(this).attr('id');
        $('.buzz-boards-tabs').hide();
        $('#'+board_id).show();
    }); 
    $('.buzz-sortable').sortable({containment: "parent"}); 

    function buzz_instagram_layout_options(layout){
  if(layout == 'thumbnails' || layout == 'masonry'){
            $('.hover_enable_desable').show();
            $('.num_columns').show();
            $('.hover_effect').show();
            $('.alternative').hide();
            $('.loadmore').show();
            $('.buzz_header').show();
          }else if(layout == 'instagram'){
            $('.hover_enable_desable').hide();
            $('.num_columns').show();
            $('.hover_effect').show();
            $('.alternative').hide();
            $('.loadmore').show();
            $('.buzz_header').show();
          }else if(layout == 'blog_style'){
            $('.alternative').show();
            $('.num_columns').hide();
            $('.hover_effect').hide();
            $('.loadmore').show();
            $('.buzz_header').show();
          }else if(layout == 'fancygallery'){
            $('.alternative').hide();
            $('.num_columns').hide();
            $('.hover_enable_desable').show();
            $('.hover_effect').show();
            $('.loadmore').show();
            $('.buzz_header').show();
          }else if(layout == 'carousel'){
            $('.alternative').hide();
            $('.num_columns').hide();
            $('.loadmore').hide();
            $('.hover_enable_desable').hide();
            $('.hover_effect').hide();
            $('.buzz_header').hide();
          }
}
    buzz_instagram_layout_options(buzz_layout_options.instagram_layout);

    $(".buzz-option-field input" ).on('click',function() {
      var layout = $(this).val();
      buzz_instagram_layout_options(layout);
    });
  });   
  
  
  // feed type inputs
  $(document).ready(function(){
    function feed_type_hide_show(val){
      if(val == "any_user") {
          $(".populartags").hide();
          $(".anyuser").show();
        } else if(val == 'tag'){
          $(".populartags").show();
          $(".anyuser").hide();
        }else{
          $(".populartags").hide();
          $(".anyuser").hide();
        }
    }
      jQuery("#feed_type").change(function(){
        var val = $(this).val();
        feed_type_hide_show(val);
      });
      
      // loading time 
      var current_val = jQuery("#feed_type").val();
      feed_type_hide_show(current_val);
  });
  
      
}(jQuery));
