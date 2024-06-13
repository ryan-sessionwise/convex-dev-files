require('./vendor/slick');
(function ($) {
    $(function () {
        if ($("[data-slick]").length) {
            $("[data-slick]").not('.slick-initialized').slick();
        }
    });
})(jQuery);
