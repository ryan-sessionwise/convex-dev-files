$(() => {
  $('.bs-section--product-how-does-work-single .bs-blurb').click(function(){
    $('.bs-section--product-how-does-work-single .bs-blurb').removeClass("active-flip");
    $(this).addClass("active-flip");
  });
});