$(() => {
  const windowWidth = $(window).width()
  const navbar = $('.nav')[0];
  const notificationBannerHide = $('.mtsnb-hide');

  $(notificationBannerHide).on('click', () => {
    $(navbar).css({ 'top': '0' })
  });

  if ($('.home').length > 0) {
    let noticeBanner = $('.mtsnb-hidden');
    $(window).scroll(() => {
      if (windowWidth > 992) {
        if ((window.pageYOffset >= 45) && (noticeBanner.length != 1)) {
          $(navbar).addClass("sticky");
        } else if ((window.pageYOffset >= 45) && (noticeBanner.length == 1)) {
          $(navbar).addClass("sticky");
        } else {
          $(navbar).removeClass("sticky");
        }
      } else {
        if ((window.pageYOffset >= 50) && (noticeBanner.length != 1)) {
          $(navbar).addClass("sticky");
        } else if ((window.pageYOffset >= 50) && (noticeBanner.length == 1)) {
          $(navbar).addClass("sticky");
        } else {
          $(navbar).removeClass("sticky");
        }
      }
    });
  } else {
    $(navbar).addClass("sticky");
  }

  if ($('.mtsnb').length <= 0) {
    $('.nav').css({ "top": "0" })
  }
});