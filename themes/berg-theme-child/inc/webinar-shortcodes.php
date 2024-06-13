<?php

function display_webinar_dynamic_form_title($atts)
{
    if (is_single() && 'resource' == get_post_type() &&
        has_term(['webinar', 'webinars', 'Webinar', 'Webinars'], 'resource-category')) {
        $output = '';
        $upcoming_title = (isset($atts['upcoming'])) ? $atts['upcoming'] : 'Attend This Webinar';
        $past_title = (isset($atts['past'])) ? $atts['past'] : 'Watch On-Demand';
        $title_tag = (isset($atts['tag'])) ? $atts['tag'] : 'h5';
        $webinar_status = get_post_meta(get_the_ID(), 'webinar_settings_status', true);
        if ('upcoming' == $webinar_status) {
            $output = $upcoming_title;
        } else {
            $output = $past_title;
        }
        return "<$title_tag>$output</$title_tag>";
    }
}

add_shortcode('webinar_form_title', 'display_webinar_dynamic_form_title');


