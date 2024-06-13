<?php
$author = get_the_author_meta('ID', $authorID);
$author_meta = get_user_meta($author);
$nickname = (!empty($author_meta['nickname'][0])) ? $author_meta['nickname'][0] : '';
$first_name = (!empty($author_meta['first_name'][0])) ? $author_meta['first_name'][0] : '';
$last_name = (!empty($author_meta['last_name'][0])) ? $author_meta['last_name'][0] : '';
$name = ($first_name && $last_name) ? $first_name . ' ' . $last_name : $nickname;
$designation = (!empty($author_meta['designation'][0])) ? $author_meta['designation'][0] : '';
$description = (!empty($author_meta['description'][0])) ? $author_meta['description'][0] : '';
$fb_url = (!empty($author_meta['fb_url'][0])) ? $author_meta['fb_url'][0] : '';
$twitter_url = (!empty($author_meta['twitter_url'][0])) ? $author_meta['twitter_url'][0] : '';
$linkedin_url = (!empty($author_meta['linkedin_url'][0])) ? $author_meta['linkedin_url'][0] : '';
?>

<div class="post__author-bio">
    <div class="post__author-bio-left">
        <figure>
            <?php echo get_avatar(get_the_author_meta('ID')); ?>
        </figure>
    </div>
    <div class="post__author-bio-right">
        <div class="post__author-details">
            <div class="post__author-name">
            <h5><?php echo $name; ?></h5>
         <h6><?php echo $designation; ?></h6>
            </div>
        <div class="post__author-bio-right-social">
                <?php if ($fb_url) :
                    ?> <a href="<?php echo $fb_url; ?>" target="_blank" class="facebook"></a> <?php
                endif; ?>
                <?php if ($linkedin_url) :
                    ?> <a href="<?php echo $linkedin_url; ?>" target="_blank" class="linkedin"></a> <?php
                endif; ?>
                <?php if ($twitter_url) :
                    ?> <a href="<?php echo $twitter_url; ?>" target="_blank" class="twitter"></a> <?php
                endif; ?>
            </div>
            </div>
            <p><?php echo $description; ?></p>        
    </div>
</div>
