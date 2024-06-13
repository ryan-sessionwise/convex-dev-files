$(() => {
  $('.leadership').on('click', () => {
    $('.bs-post > .wp-block-social-links').remove();
    $($('.bs-post')).append($('.fancybox-slide .bs-post__description .wp-block-social-links').clone());
  });
});