$(() => {

    //active 'All' checkbox when reset button click
    $('.reset-filters').on('click', function () {
        $('.facet-checkbox-select-all').addClass('checked');
    });

    //on page load hide the reset button
    if ($('.facetwp-selection-value').length <= 0) {
        $('.reset-selection').hide();
    }

    //handle 'All' check box functionality when click on sub checkboxes
    $(document).on('click', '.facetwp-type-checkboxes .facetwp-checkbox:not(.disabled)', () => {
        const facet = $(event.target).parent().data('name');
        const allCheckboxElement = $(`.facetwp-all-${facet}`);
        if (facet) {
            let isChecked = !$(event.target).hasClass('checked');
            if (isChecked) {
                if (!$(event.target).siblings().hasClass('checked')) {
                    allCheckboxElement.addClass('checked');
                }
            } else {
                if (allCheckboxElement.hasClass('checked')) {
                    allCheckboxElement.removeClass('checked');
                }
            }
        }
    });

    //'All' check box on click action
    $(document).on('click', '.facet-checkbox-select-all', () => {
        $(event.target).addClass('checked')
    });

    //hide reset button when facet items are not selected
    $(document).on('facetwp-loaded', () => {
        let queryString = FWP.buildQueryString();
        if ('' === queryString) { // no facets are selected
            $('.reset-selection').hide();
        } else {
            $('.reset-selection').show();
        }
    });

    if (typeof FWP != "undefined") {
        const facets = FWP.facets;
        //on page reload, when facet filter items applied, uncheck the relavent facet 'All' checkbox
        $.each(facets, (key, facet) => {
            if (facets[key].length) {
                $(`.facetwp-all-${key}`).removeClass('checked');
            }
        });
    }

});