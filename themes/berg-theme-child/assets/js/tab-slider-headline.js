$(() => {
  const headlinePlacement = (sectionClass, helperClass) => {
    $(`${sectionClass} .bs-tab-slider .bs-slider-tabs ${helperClass}`).remove();
    $(`${sectionClass} ${helperClass}`)
      .clone()
      .prependTo(`${sectionClass} .bs-tab-slider .bs-slider-tabs`);
  };
  $(window).on("load", () => {
    headlinePlacement(
      ".bs-section--home-easy-to-use",
      ".bs-div--accordion-headline-dev"
    );
    headlinePlacement(
      ".bs-section--home-what-our-customer-achive",
      ".bs-div--home-slider-heading"
    );
  });

  // resize event fire on drag end
  window.addEventListener(
    "resize",
    debounce((e) => {
      // Image accordion function
      headlinePlacement(
        ".bs-section--home-easy-to-use",
        ".bs-div--accordion-headline-dev"
      );
      headlinePlacement(
        ".bs-section--home-what-our-customer-achive",
        ".bs-div--home-slider-heading"
      );
    })
  );

  // set resize event delay for drag
  function debounce(func) {
    var timer;
    return (event) => {
      if (timer) clearTimeout(timer);
      timer = setTimeout(func, 100, event);
    };
  }
});
