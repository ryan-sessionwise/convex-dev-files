<?php
//enable custom logo upload
add_theme_support('custom-logo');

function berg_customizer_setting($wp_customize)
{
	// Add a setting
	$wp_customize->add_setting('secondary_logo');
	// Add a control to upload the secondary logo
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'secondary_logo', array(
		'label' => 'Secondary Logo',
		'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
		'settings' => 'secondary_logo',
		'priority' => 8 // show it just below the custom-logo
	)));

	$wp_customize->add_setting('footer_logo');
	// Add a control to upload the footer logo
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
		'label' => 'Footer Logo',
		'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
		'settings' => 'footer_logo',
		'priority' => 8 // show it just below the custom-logo
	)));

	$wp_customize->add_setting('copyright');
	// Add a control to upload the footer logo
	$wp_customize->add_control( 'title_tagline', array(
		'type' => 'text',
		'section' => 'title_tagline', // Add a default or your own section
		'label' => __( 'Copyright' ),
		'settings' => 'copyright',
		'description' => __( 'Add copyright text from here. *without &copy; year' ),
	) );

}
add_action('customize_register', 'berg_customizer_setting');
