<?php

/** scoll on loaded only if pager is the change in facet **/
add_action('wp_head', function () { ?>

  <script>
    (function($) {
      $(document).on('facetwp-refresh', function() {
        if (FWP.soft_refresh == true) {
          FWP.enable_scroll = true;
        } else {
          FWP.enable_scroll = false;
        }
      });
      $(document).on('facetwp-loaded', function() {
        let TemplateHight = $('.facetwp-template').offset().top
        if (FWP.enable_scroll == true) {
          $('html, body').animate({
            scrollTop: (TemplateHight - 100)
          }, 500);
        }
      });
    })(jQuery);
  </script>

<?php });
