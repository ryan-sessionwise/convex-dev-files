<?php

function change_event_date_format($result, $startTime, $endTime)
{
    $startTime = date('g:i A', $startTime);
    $endTime = date('g:i A', $endTime);

    return $result.'<span>'.$startTime.' - '.$endTime.'</span>';
}

add_filter('berg_event_posts_human_date_range_filter', 'change_event_date_format', 10, 3);

//Page Slug Body Class
function add_slug_body_class($classes)
{
  global $post;
  if (isset($post)) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter('body_class', 'add_slug_body_class');

// To fix affecting 'Post Types Order' plugin query params to Post block
function alter_post_type_order_plugin_query_params($ignore)
{
    // Ignore 'Post Types Order' plugin query params when firing post block ajax requests
    if (isset($_POST) && isset($_POST['action']) && $_POST['action'] == "get_post_block_data") {
        $ignore = true;
    }
    return $ignore;
}
add_filter('pto/posts_orderby/ignore', 'alter_post_type_order_plugin_query_params', 11, 1);

//Add Class to Front Page
function home_body_class($classes) {
    if ( is_front_page() ) {
        $classes[] = 'front-page';
    }

    return $classes;
}
add_filter( 'body_class', 'home_body_class' );

/**
 * Hide berg related plugins from the plugin list view page
 */
function hide_berg_related_plugins()
{
    global $wp_list_table;
    $hidePlugins = ['berg/plugin.php', 'berg-custom/plugin.php', 'block-navigation/block-navigation.php', 'sassy-social-share/sassy-social-share.php'];
    $plugins = $wp_list_table->items;
    foreach ($plugins as $key => $val) {
        if (is_plugin_active($key)) {
            if (in_array($key, $hidePlugins)) {
                unset($wp_list_table->items[$key]);
            }
        }
    }
}
add_action('pre_current_active_plugins', 'hide_berg_related_plugins');

add_filter('facetwp_is_main_query', function () {
    //This will prevent using facetwp query as the default query
    return false;
}, 10);

//add seo press theme slug setup
function seopress_theme_slug_setup() {
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'seopress_theme_slug_setup' );