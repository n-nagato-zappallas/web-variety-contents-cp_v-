$(function() {

  $('#q_2').hide();
  $('#q_3').hide();
  $('#q_4').hide();
  $("#frm_btn .btn.q_btn").hide();
  
  /* 設問クリック時 */
  $('input:radio').click( function() {
    let element = $(this).attr('name');
    let index = element.slice( -1 );
    $('.q_box_wrapper [id^=q_]').fadeOut();
    if( index == '1' ) {
      $('#q_2').fadeIn();
    } else if ( index == '2' ) {
      $('#q_3').fadeIn();
    } else if ( index == '3' ) {
      $('#q_4').fadeIn();
      const position = $('.q_box_wrapper').offset().top;
      $('body,html').animate({ scrollTop: position }, 400, 'swing');
      $('.telling').fadeIn();
      setTimeout(function(){
        $("#frm_btn .btn.q_btn").fadeIn();
      }, 5000 );
    }
  });
  
  /* 戻るボタン */
  $('.back_link').click( function() {
    let b_id = $(this).parent().parent().parent().attr('id');
    let b_index = '';
    if(!b_id) {
      b_index = '4';
    } else {
      b_index = b_id.slice( -1 );
    }
    $('.q_box_wrapper [id^=q_]').fadeOut();
    $('.telling').fadeOut();
    $("#frm_btn .btn.q_btn").hide();
    if ( b_index == '2' ) {
      $('#q_1').fadeIn();
    } else if ( b_index == '3' ) {
      $('#q_2').fadeIn();
    } else if ( b_index == '4' ) {
      $('#q_3').fadeIn();
    } 
  });
  
});
