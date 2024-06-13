<?php

function register_es5_author()
{
    register_block_type('e25m-custom/author', array(
        'editor_script' => 'berg-block-js-vendor',
        'editor_style' => 'berg-block-editor-css',
        'style' => 'e25m-style-css',
        'render_callback' => 'es5_author_render_callback',
        'attributes' => array(
            'selectedTemplate' => array(
                'type' => 'string',
                'default' => "basic"
            ),
            'titleTag' => array(
                'type' => 'string',
                'default'=> "p",
            ),
            'prefix' => array(
                'type' => 'string',
                'default'=> "By",
            ),
        )
    ));
}

add_action('init', 'register_es5_author');


function es5_author_render_callback($block_attributes)
{
    $selectedTemplate = $block_attributes['selectedTemplate'];
    $titleTag = $block_attributes['titleTag'];
    $prefix = $block_attributes['prefix'];
    global $post;
    $author_id = $post->post_author;
    $authorID = $author_id;
    
    ob_start();

    include 'layouts/'.$selectedTemplate.'.php';

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}