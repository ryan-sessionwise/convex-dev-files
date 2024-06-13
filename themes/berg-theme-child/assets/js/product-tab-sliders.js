require('slick-carousel');

$(() => {
  const appendMultipleDataSourceInDesktop = () => {
    $(".bs-section--product-multiple-data-source .bs-slider-tabs .bs-column--product-multiple-data-source").remove();
    $(".bs-section--product-multiple-data-source .bs-column--product-multiple-data-source")
      .each((_index, element) => {
        const $this = $(element);
        $prnt = $this.parents(".bs-section--product-multiple-data-source");
        const tabSlider = $prnt.find('.bs-slider-tabs');
        const prependBeforeSlider = () => {
          $this.clone().prependTo($prnt.find('.bs-slider-tabs'));
        }
        if (!tabSlider.hasClass('slick-initialized')) {
          tabSlider.on('init', prependBeforeSlider);
          tabSlider.slick();
        } else {
          prependBeforeSlider();
        }
      })
  }


  if ($('.bs-section--product-multiple-data-source').length) {
    appendMultipleDataSourceInDesktop();
  }


  // resize event fire on drag end
  window.addEventListener(
    "resize",
    debounce((e) => {
      if ($('.bs-section--product-multiple-data-source').length) {
        appendMultipleDataSourceInDesktop();
      }
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
