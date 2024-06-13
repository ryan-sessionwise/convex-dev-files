<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

if (!function_exists('berg_block_assets_custom')) {

	function berg_block_assets_custom()
	{
		$enqueue_styles_in_frontend = apply_filters('berg_enqueue_styles_custom', !is_admin());
		$enqueue_scripts_in_frontend = apply_filters('berg_enqueue_scripts_custom', !is_admin());

		// Frontend block styles.
		if (is_admin() || $enqueue_styles_in_frontend) {
			wp_enqueue_style(
				'e25m-style-css-custom',
				plugins_url('dist/frontend_blocks.css', BERG_CUSTOM_FILE),
				array(),
				BERG_CUSTOM_VERSION
			);
		}

		// Frontend only scripts.
		if ($enqueue_scripts_in_frontend) {
			wp_enqueue_script(
				'e25m-block-frontend-js-custom',
				plugins_url('dist/frontend_blocks_custom.js', BERG_CUSTOM_FILE),
				array(),
				BERG_CUSTOM_VERSION
			);

			/*  wp_localize_script('e25m-block-frontend-js-custom', 'berg', array(
				 'restUrl' => get_rest_url(),
			 )); */
		}
	}

	add_action('enqueue_block_assets', 'berg_block_assets_custom');
}

if (!function_exists('berg_block_editor_assets_custom')) {
	/**
	 * Enqueue block assets for backend editor
	 */
	function berg_block_editor_assets_custom()
	{
		// Backend editor scripts: common vendor files.
		wp_enqueue_script(
			'berg-block-js-vendor-custom',
			plugins_url('dist/editor_vendor_custom.js', BERG_CUSTOM_FILE),
			array(),
			BERG_CUSTOM_VERSION
		);

		// Backend editor scripts: blocks.
		$dependencies = array('berg-block-js-vendor', 'code-editor', 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor', 'wp-util', 'wp-plugins', 'wp-edit-post', 'wp-i18n', 'wp-api', 'wp-polyfill', 'wp-server-side-render');
		wp_enqueue_script(
			'berg-block-js-custom',
			plugins_url('dist/editor_blocks_custom.js', BERG_CUSTOM_FILE),
			// wp-util for wp.ajax.
			// wp-plugins & wp-edit-post for Gutenberg plugins.
			apply_filters('berg__custom_editor_blocks_dependencies', $dependencies),
			BERG_CUSTOM_VERSION
		);

		// Backend editor only styles.
		wp_enqueue_style(
			'berg-block-editor-css-custom',
			plugins_url('dist/editor_blocks.css', BERG_CUSTOM_FILE),
			array('wp-edit-blocks'),
			BERG_CUSTOM_VERSION
		);
	}

	add_action('enqueue_block_editor_assets', 'berg_block_editor_assets_custom');
}


/**
 * Block Initializer.
 */

if (file_exists(plugin_dir_path(__FILE__) . 'src/block/single-post-pro/single-post-pro.php')) {
	require_once plugin_dir_path(__FILE__) . 'src/block/single-post-pro/single-post-pro.php';
}
if (file_exists(plugin_dir_path(__FILE__) . 'src/block/author/author.php')) {
	require_once plugin_dir_path(__FILE__) . 'src/block/author/author.php';
}
if (file_exists(plugin_dir_path(__FILE__) . 'src/block/post-publish-date/post-publish-date.php')) {
	require_once plugin_dir_path(__FILE__) . 'src/block/post-publish-date/post-publish-date.php';
}
if (file_exists(plugin_dir_path(__FILE__) . 'src/block/post-category/post-category.php')) {
	require_once plugin_dir_path(__FILE__) . 'src/block/post-category/post-category.php';
}
if (file_exists(plugin_dir_path(__FILE__) . 'src/block/webinar-form-heading/webinar-form-heading.php')) {
	require_once plugin_dir_path(__FILE__) . 'src/block/webinar-form-heading/webinar-form-heading.php';
}
if (file_exists(plugin_dir_path(__FILE__) . 'src/block/webinar-page-heading/webinar-page-heading.php')) {
	require_once plugin_dir_path(__FILE__) . 'src/block/webinar-page-heading/webinar-page-heading.php';
}

