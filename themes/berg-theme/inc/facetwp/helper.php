<?php

/**
 * To exclude featured posts from all the templates
 */
add_filter('facetwp_query_args', function ($query_args, $class) {
    $facetwp_exclude_featured = esc_attr(get_option('facetwp_exclude_featured'));
    if ($facetwp_exclude_featured == "on") {         // Excluding featured posts
        $featured_q = array(
            'relation' => 'OR',
            array(
                'key' => 'featured',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key' => 'featured',
                'value' => "",
                'compare' => '=',
            ),
        );
        $query_args['meta_query'] = $featured_q;
    }
    return $query_args;
}, 10, 2);

/**
 * Facetwp clear filters shortcode
 * @param $atts
 * @return string
 */
function create_facetwp_reset_button_shortcode($atts)
{
    $attributes = shortcode_atts(array(
        'label' => 'CLEAR FILTERS',
        'class' => 'facetwp-reset-button',
        'autohide' => 'true',
    ), $atts);

    $autohide_class = ($attributes['autohide'] == 'true') ? ' reset-selection' : '';

    $attributes['class'] .= $autohide_class;

    return "<button class='" . $attributes['class'] . " reset-filters'  onclick='FWP.reset()'>" . $attributes['label'] . "</button>";
}

add_shortcode('facetwp_reset', 'create_facetwp_reset_button_shortcode');

/**
 * Add 'All' checkbox for all checkbox facets type
 * @param $output
 * @param $atts
 * @return mixed|string
 */
function add_select_all_checkbox($output, $atts)
{
    if (isset($atts['facet'])) {
        $facet = FWP()->helper->get_facet_by_name($atts['facet']);

        if ($facet && $facet['type'] == 'checkboxes') {
            $facet_name = $facet['name'];
            $class = 'facetwp-all-' . $facet_name;
            $original_output = $output;
            $output = '<div class="facetwp-checkbox checked type-select-all facet-checkbox-select-all ' . $class . '"  data-name="' . $facet_name . '" onclick="FWP.reset(' . "'$facet_name'" . ')">All</div>' . $original_output;
        }
    }
    return $output;
}

add_filter('facetwp_shortcode_html', 'add_select_all_checkbox', 10, 2);
