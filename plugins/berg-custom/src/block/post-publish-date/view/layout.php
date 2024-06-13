<?php
$show_custom_date = get_post_meta(get_the_ID(), 'show_custom_date', true);
$post_date = '';

if ($show_custom_date == true) {
    $post_date = date($dateFormat, strtotime(get_post_meta(get_the_ID(), 'custom_date', true)));
} else {
    $post_date = get_the_date($dateFormat);
}
$post_modified_date = get_the_modified_date($dateFormat);
?>

<div class="post-publish-date-wrapper">
	<?php echo '<' . $titleTag . '>';
	echo 'Originally published on ' . $post_date;
	?>
	<span></span>
	<?php
	echo 'Updated on ' . $post_modified_date;
	echo '</' . $titleTag . '>' ?>
</div>
