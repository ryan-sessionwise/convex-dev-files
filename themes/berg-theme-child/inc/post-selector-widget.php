<?php
/*
Plugin Name: Post Selector Widget
Author: Anusha Priyamal
Modify By : D.K. Himas Khan
Version: 1.0
*/

// register widget
add_action('widgets_init', function () {
    register_widget('Post_Selector_Widget');
});
class Post_Selector_Widget extends WP_Widget
{
    // class constructor
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'post_selector_widget',
            'description' => 'A plugin for display selected posts',
        );
        parent::__construct('post_selector_widget', 'Post Selector Widget', $widget_ops);
    }

    // output the widget content on the front-end
    public function widget($args, $instance)
    {
        if (!empty($instance['selected_post'])) {
            $selected_post = get_post($instance['selected_post']);
            $read_more_text = get_post_meta($selected_post->ID, 'learn_more_label', true);
            $read_more_text = (trim($read_more_text)) ? $read_more_text : "Read More";
            $_link_attributes = get_post_link($selected_post->ID,'');
            //Post Image setup
            $image_url = '';
            if (has_post_thumbnail($instance['selected_post'])) {
                $image_url = get_the_post_thumbnail_url($instance['selected_post']);
            }
            $terms = wp_get_post_terms($selected_post->ID, array('category', 'resource-category', 'news-category' ) ,array( 'fields' => 'names' ));
            $term = implode('  |  ', $terms);
            ?>
            <div class="nav-content-block">
                <?php if($image_url){ ?>
                    <img src="<?php echo $image_url; ?>" alt="post-image" />
                <?php } ?>
                    <p><?php echo $term; ?></p>
                    <h4><?php echo $selected_post->post_title; ?></h4>
                </div>
            <a class="read-more" href="<?php echo $_link_attributes['link']; ?>">
            <span><?php echo $read_more_text; ?></span>
             </a>
            <?php
        } else {
            echo esc_html__('No posts selected!', 'text_domain');
        }
    }

    // output the option form field in admin Widgets screen
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Title', 'text_domain'); ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'text_domain'); ?>
            </label>
            <input
                    class="widefat"
                    id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                    type="text"
                    value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
        $selected_post = !empty($instance['selected_post']) ? $instance['selected_post'] : '';

        // query for your post type
        $post_type_query = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => array('resource', 'post'),
                'orderby' => 'post_type',
                'post_status' => 'publish',
            )
        );
        // we need the array of posts
        $posts_array = $post_type_query->posts;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('selected_post'); ?>"><?php _e('Select Post'); ?></label>
            <select name="<?php echo $this->get_field_name('selected_post'); ?>"
                    id="<?php echo $this->get_field_id('selected_post'); ?>" class="widefat">
                <?php
                $post_type = '';
                foreach ($posts_array AS $post) : ?>
                    <?php if ($post_type != $post->post_type) : ?>
                        <optgroup label="<?php echo $post->post_type; ?>">
                    <?php endif; ?>
                    <option value="<?php echo $post->ID; ?>"
                            id="<?php echo $post->ID; ?>" <?php selected($selected_post, $post->ID, true); ?>><?php echo $post->post_title ?></option>
                    <?php $post_type = $post->post_type;
                    if ($post_type != $post->post_type) : ?>
                        </optgroup>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

        </p>

    <?php }

    // save options
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['selected_post'] = (!empty ($new_instance['selected_post'])) ? $new_instance['selected_post'] : '';

        return $instance;
    }
}
