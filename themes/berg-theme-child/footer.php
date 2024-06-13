</main>
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__wrapper">
                    <a class="footer-logo" href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                        <?php
                        $footer_logo_url = get_theme_mod('footer_logo');
                        if (!empty($footer_logo_url)) : ?>
                            <img src="<?php echo $footer_logo_url; ?>" alt='<?php echo get_bloginfo('name'); ?>' class="footer-logo">
                        <?php else : ?>
                            <h1><?php echo get_bloginfo('name'); ?></h1>
                        <?php endif; ?>
                    </a>
                    <div class="footer-menus">
                        <div>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-1', 'menu_class' => 'footer-nav')); ?>
                        </div>
                        <div>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-2', 'menu_class' => 'footer-nav footer-nav-direct')); ?>
                        </div>
                        <div>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-3', 'menu_class' => 'footer-nav')); ?>
                        </div>
                        <div>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-4', 'menu_class' => 'footer-nav footer-nav-direct')); ?>
                        </div>
                        <div>
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu-5', 'menu_class' => 'footer-nav footer-nav-direct')); ?>
                        </div>
                    </div>
                    <div class="footer-social">
                        <?php
                        // Social Icons
                        global $theme_social_data;
                        foreach ($theme_social_data as $key => $name) {
                            $footer_social_link = get_theme_mod("footer_social_${key}");
                            $footer_social_logo = get_theme_mod("footer_social_${key}_logo");

                            if ($footer_social_link) {
                                echo '<a href="' . $footer_social_link . '" target="_blank" class="social-icon ' . $key . '-social">';
                                if (!empty($footer_social_logo)) {
                                    echo '<img src="' . $footer_social_logo . '" alt="' . $name . '-logo" class="img-fluid ' . $key . '-logo default-img">';
                                }
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                    <div class="footer-bottom" style="flex-direction: column;">
						<div class="footer-badge">
							<a href="http://aicpa.org/" target="_blank"><img src="https://www.convex.com/wp-content/uploads/2022/03/SOC_80x80@2x.png" alt="AICPA Logo" width="80" height="80" target="_self" /></a>
						</div>
						<br />
						
                        <!--  Footer Copyright -->
						<div class="footer-text" style="flex-direction: row;">
                        <?php
                        $copyright = get_theme_mod('copyright');
                        if (!empty($copyright)) : ?>
                            <p>&copy; <?php echo date('Y') . ' ' . $copyright ?></p>
                        <?php else : ?>
                            <p>&copy; <?php echo date('Y') ?> <?php echo get_bloginfo('name'); ?></p>
                        <?php endif; ?>
                        <?php wp_nav_menu(array('theme_location' => 'footer-bottom-menu', 'menu_class' => '')); ?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>