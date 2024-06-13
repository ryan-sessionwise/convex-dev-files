$(() => {
  //appending social share to mid section
  $(".single .heateor_sss_sharing_container").wrap(
    '<div class="social-share"></div>'
  );
  if ($(".bs-section--sassy-social-share .social-share").length < 1) {
    $(".single .bs-section--sassy-social-share .container").prepend(
      $(".single .social-share")[0]
    );
    $(".single main > .social-share").remove();
  }

  // Display in inner pages
  if ($(".bs-section--sassy-social-share").length > 0) {
    $(".bs-section--sassy-social-share .heateor_sss_sharing_container").css({
      display: "block",
    });
  }
});
