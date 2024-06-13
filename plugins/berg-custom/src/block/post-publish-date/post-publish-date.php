<?php

function register_post_publish_date()
{
    register_block_type('e25m-custom/post-publish-date', array(
        'editor_script' => 'berg-block-js-vendor',
        'editor_style' => 'berg-block-editor-css',
        'style' => 'e25m-style-css',
        'render_callback' => 'post_publish_date_render_callback',
        'attributes' => array(
            'titleTag' => array(
                'type' => 'string',
                'default'=> "h1",
            ),
            'dateFormat' => array(
                'type' => 'string',
                'default'=> "M j, Y",
            ),
        )
    ));
}

add_action('init', 'register_post_publish_date');


function post_publish_date_render_callback($block_attributes)
{

    $titleTag = $block_attributes['titleTag'];
    $dateFormat = $block_attributes['dateFormat'];
   
    ob_start();

    include 'view/layout.php';

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}