<?php
$_title = get_the_title();
if (trim($_title)) :
    ?>
    <div class="bs-post__title">
        <<?php echo $title_tag; ?>><?php echo $_title; ?></<?php echo $title_tag; ?>>
    </div>
<?php endif; ?>
