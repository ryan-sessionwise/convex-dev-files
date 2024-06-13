$(() => {
    const debounce = (func, wait) => {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    };

    $('.footer-nav > .menu-item-has-children > .sub-menu').each((index, element) => {
        const $this = $(element);
        $this.wrapAll('<div class="sub-menu-wrapper"></div>');
    });

    $('footer .menu-item-has-children').each((index, element) => {
        const $this = $(element);
        if (!$this.parents('.menu-item-has-children').length) {
            $this.append("<span class='dropdown'></span>");
            if ($this.find('.current_page_item').length) {
                $this.addClass('expand');
            }
            $this.children('a:first-child').on("click", (e) => {
                e.preventDefault();
                const scrollH = $this.find('.sub-menu-wrapper')[0].scrollHeight;
                if ($(window).width() < 992) {
                    if ($this.hasClass('expand')) {
                        $this.removeClass('expand');
                        $this.find('.sub-menu-wrapper').removeAttr('style');
                    } else {
                        $this.addClass('expand');
                        $this.find('.sub-menu-wrapper').css({ maxHeight: scrollH });
                    }
                }
            });
        }
    });

    $('footer .clone-for-mobile').each((index, element) => {
        const $this = $(element);
        $this.clone().removeClass('hide-mobile').appendTo($('footer .appender-mobile .bs-column'))
    });

    const returnedFunction = debounce(() => {
        $('footer .expand').each((index, element) => {
            const $this = $(element);
            if ($(window).width() > 991) {
                $this.find('.sub-menu-wrapper').removeAttr('style');
            } else {
                if ($this.find('.sub-menu-wrapper').length) {
                    const scrollH = $this.find('.sub-menu-wrapper')[0].scrollHeight;
                    $this.find('.sub-menu-wrapper').css({ maxHeight: scrollH });
                }
            }
        });
    }, 400);
    returnedFunction();
    window.addEventListener('resize', returnedFunction);
});
