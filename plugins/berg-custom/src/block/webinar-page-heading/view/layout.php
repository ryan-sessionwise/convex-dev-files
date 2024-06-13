<?php
if (!is_admin() && is_single() &&
	'resource' == get_post_type() &&
	has_term(['webinar', 'webinars', 'Webinar', 'Webinars'], 'resource-category')) {

	$webinar_status = get_post_meta($post->ID, 'webinar_settings_status', true);
	$webinar_date_time = get_post_meta($post->ID, 'webinar_settings_date_time', true);
	if ('upcoming' == $webinar_status) {
		$output = $webinar_date_time;
	} else {
		$output = $past_title;
	}
	echo "<$title_tag>$output</$title_tag>";

}

if (isset($_GET['isEditor']) && $_GET['isEditor']) {
	$webinar_status = get_post_meta($post->ID, 'webinar_settings_status', true);
	$webinar_date_time = get_post_meta($post->ID, 'webinar_settings_date_time', true);
	if ('upcoming' == $webinar_status) {
		$output = $webinar_date_time;
	} else {
		$output = $past_title;
	}
	echo "<$title_tag>$output</$title_tag>";
}
