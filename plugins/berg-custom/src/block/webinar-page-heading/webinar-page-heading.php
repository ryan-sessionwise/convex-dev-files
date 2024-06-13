<?php

function register_webinar_page_heading()
{
    register_block_type('e25m-custom/webinar-page-heading', array(
        'editor_script' => 'berg-block-js-vendor',
        'editor_style' => 'berg-block-editor-css',
        'style' => 'e25m-style-css',
        'render_callback' => 'webinar_page_heading_render_callback',
		'attributes' => array(
			'pastTitle' => array(
				'type' => 'string',
				'default'=> "On-Demand",
			),
			'titleTag' => array(
				'type' => 'string',
				'default'=> "h4",
			),
		)
    ));
}

add_action('init', 'register_webinar_page_heading');


function webinar_page_heading_render_callback($block_attributes)
{
	$title_tag = $block_attributes['titleTag'];
	$past_title = $block_attributes['pastTitle'];
	global $post;
    ob_start();

    include 'view/layout.php';

    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}
