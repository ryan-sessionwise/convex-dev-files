<?php
$GLOBALS["theme_social_data"] = ['in' => 'LinkedIn', 'tw' => 'Twitter'];

function berg_theme_child_customizer_setting($wp_customize)
{
    global $theme_social_data;

    // Footer Social Settings
    $wp_customize->add_section('convex_footer_social', [
        'title' => __('Footer Social Settings', 'berg'),
        'description' => '',
        'priority' => 120,
    ]);

    // Social Icons
    foreach ($theme_social_data as $key => $name) {
        $wp_customize->add_setting("footer_social_${key}_logo");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "footer_social_${key}_logo", [
            'label' => "Footer Social ${name} Logo",
            'section' => "convex_footer_social", //this is the section where the custom-logo from WordPress is
            'settings' => "footer_social_${key}_logo"
        ]));
        $wp_customize->add_setting("footer_social_${key}");
        $wp_customize->add_control("footer_social_${key}", [
            'type' => "text",
            'section' => "convex_footer_social",
            'label' => __("Footer Social ${name} URL"),
            'settings' => "footer_social_${key}",
            'description' => __("Add footer social ${name} url from here."),
        ]);
    }

}
add_action('customize_register', 'berg_theme_child_customizer_setting');

/**
 * add user profile custom field
 * @param $user
 */
function berg_user_profile_custom_fields($user)
{
    $designation = get_the_author_meta('designation', $user->ID);
    ?>

    <table class="form-table">
        <tr>
            <th><label for="user_designation">Designation</label></th>
            <td>
                <input type="text" name="designation" value="<?php echo $designation; ?>">
            </td>
        </tr>
    </table>
    <?php
}

add_action('show_user_profile', 'berg_user_profile_custom_fields');
add_action('edit_user_profile', 'berg_user_profile_custom_fields');

/**
 * update user action callback function
 * @param $user_id
 */
function berg_user_profile_update_action($user_id)
{
    update_user_meta($user_id, 'designation', $_POST['designation']);
}

add_action('personal_options_update', 'berg_user_profile_update_action');
add_action('edit_user_profile_update', 'berg_user_profile_update_action');