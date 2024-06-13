//  News & Press filter
$(document).ready(() => {
  const newsCategory = $('#news-category');
  const newsYear = $('#news-year');
  if (newsCategory.length && newsYear.length) {
    $('#news-category option:contains("All")').text('Filter by Category');
    $('#news-year option:contains("All")').text('Filter by Year');

  }
  $('.bs-posts.bs-post-block---default .form-group .select-wrapper select').css('visibility', 'visible');

  const currentUrl = $(location).attr('href');
  const currentUrlArr = currentUrl.split('/');
  const paginationPostBlock = $('.bs-posts .bs-posts__pagination');
  if(paginationPostBlock.length > 0){
    let TemplateHight = $(paginationPostBlock.closest('.bs-section')).offset().top
    if(currentUrlArr.includes("page")){
      $('html, body').animate({
        scrollTop: (TemplateHight)
      }, 500);
    }
  }
});


