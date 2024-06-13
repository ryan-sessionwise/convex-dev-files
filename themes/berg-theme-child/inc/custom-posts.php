<?php

function add_news_post_type()
{
    $args = array(
        'labels' => array(
            'name' => 'News',
            'singular_name' => 'News',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New',
            'edit' => 'Edit',
            'edit_item' => 'Edit',
            'new_item' => 'New',
            'view' => 'View',
            'view_item' => 'View',
            'search_items' => 'Search',
            'not_found' => 'No News found',
            'not_found_in_trash' => 'No News found in Trash'
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-media-document',
        'taxonomies' => array(),
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('with_front' => false, 'slug' => 'news'),
        'capability_type' => 'post',
        'has_archive' => false
    );
    register_post_type('news', $args);
    register_taxonomy(
        'news-category',
        array('news'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'News Category',
                'menu_name' => 'News Category',
                'singular_name' => 'News Category',
                'search_items' => 'Search News Category',
                'all_items' => 'All News Categories',
                'parent_item' => 'Parent News Category',
                'parent_item_colon' => 'Parent Category:',
                'edit_item' => 'Edit Category',
                'update_item' => 'Update Category',
                'add_new_item' => 'Add New Category',
                'new_item_name' => 'New Category',
            ),
            'public' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            //'rewrite' => array('slug' => 'resource-category')
        )
    );
    register_taxonomy(
        'news-year',
        array('news'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'News Year',
                'menu_name' => 'News Year',
                'singular_name' => 'News Year',
                'search_items' => 'Search News Year',
                'all_items' => 'All News Year',
                'parent_item' => 'Parent News Year',
                'parent_item_colon' => 'Parent Year:',
                'edit_item' => 'Edit Year',
                'update_item' => 'Update Year',
                'add_new_item' => 'Add New Year',
                'new_item_name' => 'New Year',
            ),
            'public' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            //'rewrite' => array('slug' => 'resource-category')
        )
    );
}

add_action('after_setup_theme', 'add_news_post_type');


function add_watch_post_type()
{
    $args = array(
        'label' => esc_html__('Videos', 'text-domain'),
        'labels' => array(
            'menu_name' => esc_html__('Videos', 'berg'),
            'name_admin_bar' => esc_html__('Video', 'berg'),
            'add_new' => esc_html__('Add Video', 'berg'),
            'add_new_item' => esc_html__('Add new Video', 'berg'),
            'new_item' => esc_html__('New Video', 'berg'),
            'edit_item' => esc_html__('Edit Video', 'berg'),
            'view_item' => esc_html__('View Video', 'berg'),
            'update_item' => esc_html__('View Video', 'berg'),
            'all_items' => esc_html__('All Videos', 'berg'),
            'search_items' => esc_html__('Search Videos', 'berg'),
            'parent_item_colon' => esc_html__('Parent Video', 'berg'),
            'not_found' => esc_html__('No Videos found', 'berg'),
            'not_found_in_trash' => esc_html__('No Videos found in Trash', 'berg'),
            'name' => esc_html__('Videos', 'berg'),
            'singular_name' => esc_html__('Video', 'berg'),
        ),
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite_no_front' => false,
        'show_in_menu' => true,
        'menu_position' => 10,
        'menu_icon' => 'dashicons-video-alt3',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'page-attributes',
        ),
        'rewrite' => array('slug' => 'watch')
        );

    register_post_type('watch', $args);
}

add_action('after_setup_theme', 'add_watch_post_type');

function add_thank_you_page_post_type()
{
    $args = array(
        'label' => esc_html__('Thank You Pages', 'text-domain'),
        'labels' => array(
            'menu_name' => esc_html__('Thank You Pages', 'berg'),
            'name_admin_bar' => esc_html__('Thank You Page', 'berg'),
            'add_new' => esc_html__('Add Thank You Page', 'berg'),
            'add_new_item' => esc_html__('Add new Thank You Page', 'berg'),
            'new_item' => esc_html__('New Thank You Page', 'berg'),
            'edit_item' => esc_html__('Edit Thank You Page', 'berg'),
            'view_item' => esc_html__('View Thank You Page', 'berg'),
            'update_item' => esc_html__('View Thank You Page', 'berg'),
            'all_items' => esc_html__('All Thank You Pages', 'berg'),
            'search_items' => esc_html__('Search Thank You Pages', 'berg'),
            'parent_item_colon' => esc_html__('Parent Thank You Page', 'berg'),
            'not_found' => esc_html__('No Thank You Pages found', 'berg'),
            'not_found_in_trash' => esc_html__('No Thank You Pages found in Trash', 'berg'),
            'name' => esc_html__('Thank You Pages', 'berg'),
            'singular_name' => esc_html__('Thank You Page', 'berg'),
        ),
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite_no_front' => false,
        'show_in_menu' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'page-attributes',
        ),
        'rewrite' => array('slug' => 'thankyou',  'with_front' => false, 'hierarchical' => true )
    );

    register_post_type('thank-you-page', $args);
}

add_action('init', 'add_thank_you_page_post_type');

// Register Custom Taxonomy

add_action('init', 'add_industry_blog_taxonomy');
function add_industry_blog_taxonomy()
{
    $args = [
        'label' => esc_html__('Industries', 'berg'),
        'labels' => [
            'menu_name' => esc_html__('Industries', 'berg'),
            'all_items' => esc_html__('All Industries', 'berg'),
            'edit_item' => esc_html__('Edit industry', 'berg'),
            'view_item' => esc_html__('View industry', 'berg'),
            'update_item' => esc_html__('Update industry', 'berg'),
            'add_new_item' => esc_html__('Add new industry', 'berg'),
            'new_item' => esc_html__('New industry', 'berg'),
            'parent_item' => esc_html__('Parent industry', 'berg'),
            'parent_item_colon' => esc_html__('Parent industry', 'berg'),
            'search_items' => esc_html__('Search Industries', 'berg'),
            'popular_items' => esc_html__('Popular Industries', 'berg'),
            'separate_items_with_commas' => esc_html__('Separate Industries with commas', 'berg'),
            'add_or_remove_items' => esc_html__('Add or remove Industries', 'berg'),
            'choose_from_most_used' => esc_html__('Choose most used Industries', 'berg'),
            'not_found' => esc_html__('No Industries found', 'berg'),
            'name' => esc_html__('Industries', 'berg'),
            'singular_name' => esc_html__('industry', 'berg'),
        ],
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_quick_edit' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
        'query_var' => true,
        'sort' => false,
        'rewrite_no_front' => false,
        'rewrite_hierarchical' => false,
        'rewrite' => true
    ];
    register_taxonomy('industry', ['post','resource'], $args);
}


