<?php

//Featuerd Image
add_theme_support( 'post-thumbnails' );

//Editor Styles
add_theme_support( 'editor-styles' );

$post_id = isset($_REQUEST["post"])? $_REQUEST["post"]: null;
if ($post_id != null) {
    $db_value = get_post_meta($post_id, 'berg_classic_theme_post_option', true);
    if ($db_value === '1') {
        add_editor_style('/dist/css/vendor.css');
    } else {
        add_editor_style('/dist/css/vendor.css');
        add_editor_style('/dist/css/style.css');
    }
} else {
    add_editor_style('/dist/css/vendor.css');
    add_editor_style('/dist/css/style.css');
}

/**
 * @param $data
 * @param $limit
 * @param bool $wpAutoP
 *
 * @return string
 */
function charLimit( $data, $limit, $wpAutoP = true ) {
	if ( $wpAutoP ) {
		return wpautop( html_cut( $data, $limit ) );
	} else {
		return html_cut( $data, $limit );
	}
}

/**
 * @param $text
 * @param $max_length
 *
 * @return string
 */
function html_cut( $text, $max_length ) {
	if ( strlen( $text ) > $max_length ) {
		$endStr = '...';
	} else {
		$endStr = '';
	}

	$tags   = array();
	$result = "";

	$is_open          = false;
	$grab_open        = false;
	$is_close         = false;
	$in_double_quotes = false;
	$in_single_quotes = false;
	$tag              = "";

	$i        = 0;
	$stripped = 0;

	$stripped_text = strip_tags( $text );

	while ( $i < strlen( $text ) && $stripped < strlen( $stripped_text ) && $stripped < $max_length ) {
		$symbol = $text[ $i ];
		$result .= $symbol;

		switch ( $symbol ) {
			case '<':
				$is_open   = true;
				$grab_open = true;
				break;
			case '"':
				if ( $in_double_quotes ) {
					$in_double_quotes = false;
				} else {
					$in_double_quotes = true;
				}
				break;
			case "'":
				if ( $in_single_quotes ) {
					$in_single_quotes = false;
				} else {
					$in_single_quotes = true;
				}
				break;
			case '/':
				if ( $is_open && ! $in_double_quotes && ! $in_single_quotes ) {
					$is_close  = true;
					$is_open   = false;
					$grab_open = false;
				}
				break;
			case ' ':
				if ( $is_open ) {
					$grab_open = false;
				} else {
					$stripped ++;
				}
				break;
			case '>':
				if ( $is_open ) {
					$is_open   = false;
					$grab_open = false;
					array_push( $tags, $tag );
					$tag = "";
				} else if ( $is_close ) {
					$is_close = false;
					array_pop( $tags );
					$tag = "";
				}
				break;
			default:
				if ( $grab_open || $is_close ) {
					$tag .= $symbol;
				}
				if ( ! $is_open && ! $is_close ) {
					$stripped ++;
				}
		}
		$i ++;
	}

	$tagCount = count( $tags );
	$i        = 1;
	if ( $tags ) {
		while ( $tags ) {
			if ( $i < $tagCount ) {
				$result .= "</" . array_pop( $tags ) . ">";
			} else {
				$result .= $endStr . "</" . array_pop( $tags ) . ">";
			}
			$i ++;
		}
	} else {
		$result .= $endStr;
	}

	return $result;
}

// Reusable Menu
function add_reusable_blocks_menu_to_admin_navigation() {
	add_menu_page( 'Reusable Blocks', 
	'Reusable Blocks', 
	'edit_posts', 
	'edit.php?post_type=wp_block',
	'',
	'dashicons-editor-table'
	 ,20);
}
add_action( 'admin_menu', 'add_reusable_blocks_menu_to_admin_navigation' );
