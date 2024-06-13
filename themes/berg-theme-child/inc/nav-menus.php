<?php

function register_child_theme_menus()
{
    register_nav_menus(
        array(
            'top-menu' => __('Top Menu'),
            'main-menu' => __('Main Menu'),
            'footer-menu-1' => __('Footer Menu 1'),
            'footer-menu-2' => __('Footer Menu 2'),
            'footer-menu-3' => __('Footer Menu 3'),
            'footer-menu-4' => __('Footer Menu 4'),
            'footer-menu-5' => __('Footer Menu 5'),
            'footer-bottom-menu' => __('Footer Bottom Menu')
        )
    );
}

add_action('init', 'register_child_theme_menus');


function print_menu_shortcode($atts, $content = null)
{
    $name = (isset($atts['name'])) ? $atts['name'] : '';
    $class = (isset($atts['class'])) ? $atts['class'] : '';
    return wp_nav_menu(array('menu' => $name, 'menu_class' => $class, 'echo' => false));
}

add_shortcode('menu', 'print_menu_shortcode');

