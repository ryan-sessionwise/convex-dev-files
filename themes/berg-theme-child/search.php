<?php
get_header();

/**
 * Get Link data
 * @param $_post_id
 * @return array
 */
function get_search_result_link_data($_post_id)
{
    if ($_post_id) {
        $_learn_more_type = get_post_meta($_post_id, 'learn_more_type', true);

        $_link = '';
        $_target = '_blank';
        $_attributes = '';
        switch ($_learn_more_type) {
            case 'in_link':
            case 'ex_link':
                $_learn_more_link = get_post_meta($_post_id, "learn_more_link", true);
                $_id = array_by_keys('id.0', $_learn_more_link);
                $_url = array_by_keys('url.0', $_learn_more_link);
                $_type = array_by_keys('type.0', $_learn_more_link);
                $_opensInNewTab = array_by_keys('opensInNewTab.0', $_learn_more_link);

                $_link = $_url;
                if ($_type !== "URL") {
                    if ($_id) {
                        $_link = get_the_permalink($_id);
                    }
                }

                if ($_opensInNewTab) {
                    $_target = "_blank";
                }
                break;
            case 'fi_link':
                $_learn_more_link_file = get_post_meta($_post_id, 'learn_more_link_file', true);
                $_gated_download = get_post_meta($_post_id, "gated_download", true);

                if ($_gated_download == 'yes') {
                    $_target = '_self';
                    $_link = "javascript:void(0)";
                } else {
                    $_target = '_blank';
                    $_attributes = 'download';
                    $_link = wp_get_attachment_url($_learn_more_link_file);
                }
                break;
            case 'none':
                $_link = "javascript:void(0)";
                $_attributes = 'data-none="none"';
                break;
            default:
                $_link = get_the_permalink($_post_id);
                break;
        }

        return array(
            'link' => "$_link",
            'target' => "$_target",
            'attributes' => "$_attributes",
        );
    }
    return array();
}

/**
 * Get Post Date
 * @param $post_type
 * @param $post_id
 * @return false|string
 */
function get_search_result_post_date($post_type, $post_id)
{
    $post_date = "";
    $date_required_post_types = ['post', 'resource', 'news-media'];
    if (in_array($post_type, $date_required_post_types)) {
        // Show custom date and Events date range display
        try {
            $event_date = get_post_meta($post_id, 'event_date', true);
            $event_start_date = get_post_meta($post_id, 'event_start_date', true);
            $event_end_date = get_post_meta($post_id, 'event_end_date', true);
            $show_custom_date = get_post_meta($post_id, 'show_custom_date', true);
            $custom_date = get_post_meta($post_id, 'custom_date', true);
            if ($event_date && (trim($event_start_date) || trim($event_end_date))) {
                $post_date = humanDateRanges($event_start_date, $event_end_date);
            } elseif ($show_custom_date) {
                $date = date_create($custom_date);
                $post_date = date_format($date, 'F j, Y');
            } else {
                $post_date = get_the_date('F j, Y', $post_id);
            }
        } catch (\Exception $e) {
            $post_date = get_the_date('F j, Y', $post_id);
        }
    }
    return $post_date;
}

?>
<section class="bs-section--search-result bs-section--scrolled-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <?php _e('Search Results', 'locale'); ?>: <?php the_search_query(); ?>
                </h1>
                <ul class="search-result-list">
                    <?php if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                        <?php
                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        if ($image_url) {
                            $row_image_class = '';
                            $image_div = '<div class="image">
                                                <figure>
                                                    <img src="' . set_url_scheme($image_url, 'https') . '"/>
                                                </figure>
                                            </div>';
                        } else {
                            $row_image_class = 'without-img';
                            $image_div = '<div class="image without-img"></div>';
                        }
                        $link_data = get_search_result_link_data(get_the_ID());
                        ?>
                        <li>
                            <div class="inner-row <?= $row_image_class ?>">
                                <a href="<?= $link_data["link"] ?>"
                                   target="<?= $link_data["target"] ?>" <?= $link_data["attributes"] ?>>
                                    <?= $image_div ?>
                                    <div class="post-inner">
                                      <div class="title"><h2><?= get_the_title() ?></h2></div>
                                        <div class="excerpt"><p><?= get_the_excerpt() ?></p></div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    <?php endwhile;
                    ?>
                </ul>
                <div class="pagination">
                    <?php
                    the_posts_pagination([
                        'type' => 'list',
                        'mid_size' => 1,
                        'prev_text' => __('<', 'textdomain'),
                        'next_text' => __('>', 'textdomain'),
                        'screen_reader_text' => __('&nbsp;'),
                    ]);
                    ?>
                </div>
                <?php
                else: ?>
                    <div class="col-lg-12 no-result">
                        <h3>Your search has no results.</h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php
// Search result page add page-with-mask
if (is_search()) {
    echo "<script>jQuery('body').addClass('page-with-mask');</script>";
}
get_footer();
?>
