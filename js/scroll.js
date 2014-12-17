jQuery (function($) {
var offset = $('#main-nav').offset();
$(window).scroll(function(){
   //$('#mine').text($(document).scrollTop());
  $('#main-nav').addClass('fixed-nav');
  if($(document).scrollTop() < 150){
         $('#main-nav').removeClass('fixed-nav');
  }
});
  });