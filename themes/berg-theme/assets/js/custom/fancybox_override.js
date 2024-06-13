$(() => { 
  fancyBoxJquery("[data-fancybox]").fancybox({
    video: {
      tpl:
        '<video class="fancybox-video" controls controlsList="nodownload">' +
        '<source src="{{src}}" type="{{format}}" />' +
        'Sorry, your browser doesn\'t support embedded videos, <a href="{{src}}">download</a> and watch with your favorite video player!' +
        "</video>",
    },
  });
})
