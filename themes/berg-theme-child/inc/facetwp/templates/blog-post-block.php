<?php
$facetwp_column_count = esc_attr(get_option('facetwp_column_count'));
$facetwp_additional_classes_array = explode(",", esc_attr(get_option('facetwp_additional_class')));
$facetwp_additional_classes = implode(" ", $facetwp_additional_classes_array);
?>
<div class="bs-posts <?php echo $facetwp_additional_classes; ?>">
    <div class="bs-post__list row">
        <?php
        switch ($facetwp_column_count) {
            case "1":
                $facetwp_column_class = "col-md-12";
                break;
            case "2":
                $facetwp_column_class = "col-md-6";
                break;
            case "3":
                $facetwp_column_class = "col-md-4";
                break;
            case "4":
                $facetwp_column_class = "col-md-3";
                break;
            default:
                $facetwp_column_class = "col-md-4";
        }
        ?>
        <?php if ( have_posts() ) :  ?>
            <?php while (have_posts()) : the_post();
                $post_id = get_the_ID();
                $date_format = 'F d, Y';
                $show_custom_date        = get_post_meta($post_id, 'show_custom_date', true);
                $custom_date             = get_post_meta($post_id, 'custom_date', true);
                $event_date_status = get_post_meta($post_id, 'event_date', true);
                $event_start_date = get_post_meta($post_id, 'event_start_date', true);
                $event_end_date = get_post_meta($post_id, 'event_end_date', true);
                if (isset($event_start_date) && isset($event_end_date)) {
                    $event_date = date($date_format, strtotime($event_start_date)) . '-' . date($date_format, strtotime($event_end_date));
                }
                if ($show_custom_date == 1) {
                    $date = date($date_format, strtotime($custom_date));
                } else {
                    $date = get_the_date($date_format, $post_id);
                }
                $post_type = get_post_type($post_id);
                $categories = implode(" | ", wp_get_object_terms(get_the_ID(), 'category',  array("fields" => "names")));
                $image_url = get_the_post_thumbnail_url($post_id) ? get_the_post_thumbnail_url($post_id) : 'https://via.placeholder.com/400x200.png?text=Resource+Image';
                $image_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
                $read_more_text     = get_post_meta($post_id, 'learn_more_label', true);
                $read_more_text     = (trim($read_more_text)) ? $read_more_text : "Read More";
                $link_attributes    = get_post_link($post_id, 'full', $read_more_text);
                ?>
                <div class="bs-post bs-posts__column col-sm-12 <?php echo $facetwp_column_class; ?>">
                    <div class="bs-post__container">
                        <?php
                        echo render_link('open', $link_attributes);
                        ?>
                        <div class="bs-post__inner">
                            <?php
                            if (isset($display_order)) {
                                if (in_array('image', $display_order)) {
                                    echo '<div class="bs-post__image">
											<figure class="figure"> <img
													src="' . $image_url . '"
													class="img-fluid"
													alt="' . $image_alt . '"/>
											</figure>
										</div>';
                                }
                                echo '<div class="bs-post__details">';
                                foreach ($display_order as $order => $item) {
                                    switch ($item) {
                                        case 'category':
                                            if ($categories) {
                                                echo '<div class="bs-post__category bs-post-taxonomy_category"> <span>' . $categories . '</span></div>';
                                            }
                                            break;
                                        case 'date':
                                            echo '<div class="bs-post__date"> <span>' . $date . '</span></div>';
                                            break;
                                        case 'event-date':
                                            if ($event_date_status) {
                                                echo '<div class="bs-post__date bs-post__date--event"> <span>' . $event_date . '</span></div>';
                                            }
                                            break;
                                        case 'title':
                                            echo '<div class="bs-post__title"><h5>' . get_the_title($post_id) . '</h5></div>';
                                            break;
                                        case 'excerpt':
                                            echo '<div class="bs-post__description"><p>' . get_the_excerpt($post_id) . '</p></div>';
                                            break;
                                        case 'link':
                                            echo '<div class="bs-post__learn-more"><span>' . $read_more_text . '</span></div>';
                                            break;
                                        default:
                                            break;
                                    }
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <?php
                        echo render_link('close', $link_attributes);
                        ?>
                    </div>
                </div>
                <?php
                $learn_more_type = get_post_meta($post_id, 'learn_more_type', true);
                if ($learn_more_type == "po_link") { ?>
                    <div class="bs-post__target bs-post__target--popup-post " id="bs-post__popup--<?= $post_id; ?>" data-post-id="<?= $post_id; ?>" style="display: none;">
                        <p><?php echo the_content(); ?>
                    </div>
                <?php }
            endwhile; ?>
        <?php else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>
    </div>
</div>