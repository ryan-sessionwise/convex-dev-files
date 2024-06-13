<?php

/** calling for child theme stylesheets and scripts **/
function e25b_child_assests()
{
    // common styles
    wp_enqueue_style('child-common-styles', get_stylesheet_directory_uri() . '/dist/css/style.css', array());
    // main
    wp_enqueue_script('child-main-js', get_stylesheet_directory_uri() . '/dist/js/main.js', array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'e25b_child_assests', 9999);