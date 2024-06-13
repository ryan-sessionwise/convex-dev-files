<?php

function register_post_category()
{
    register_block_type('e25m-custom/post-category', array(
        'editor_script' => 'berg-block-js-vendor',
        'editor_style' => 'berg-block-editor-css',
        'style' => 'e25m-style-css',
        'render_callback' => 'post_category_render_callback',
        'attributes' => array(
        )
    ));
}

add_action('init', 'register_post_category');


function post_category_render_callback($block_attributes)
{
    ob_start();

    include 'view/layout.php';

    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}
