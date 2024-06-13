<?php
$term_list = wp_get_post_terms($_post_id, str_replace('taxonomy_', '', $display), array("fields" => "names"));
if (count($term_list)) { ?>
    <div class="bs-post__category bs-post-<?php echo $display; ?>">
        <span><?php echo implode(', ', $term_list); ?></span>
    </div>
<?php } ?>