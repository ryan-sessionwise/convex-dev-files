<?php
$author = get_user_by('ID', $authorID);
$author_meta = get_user_meta($authorID);
$designation = (!empty($author_meta['designation'][0])) ? $author_meta['designation'][0] : '';
?>

<div class="post-author-wrapper">
        <figure>
            <?php echo get_avatar(get_the_author_meta('ID'));?>
        </figure>
        <span><?php echo (!empty($prefix) ? $prefix : '')?></span><?php echo '<'.$titleTag.'>' ; echo $author->data->display_name;  echo '</'.$titleTag.'>'?>
        <p><?php echo $designation; ?></p>
</div>