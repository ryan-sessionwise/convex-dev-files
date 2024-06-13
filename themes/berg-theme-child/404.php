<?php get_header(); ?>
    <main id="content">
        <section
                class="wp-block-e25m-section bs-section---default bs-section--page-not-found bs-section--page-not-found-pixel-perfect">
            <div class="container-fluid">
                <div class="wp-block-e25m-row bs-row row  bs-row---default bs-row--fluid-container-normal-row-left">
                    <div class=" bs-column col-sm-12 col-md-4 col-lg-4 bs-column---default bs-column--column-left d-flex flex-column justify-content-center">
                        <h1 class="entry-title">404</h1>
                        <div class="entry-content">
                            <p><?php esc_html_e('Sorry, but the page you were looking for could not be found.', 'berg'); ?></p>
                            <span class="bs-pro-button bs-pro-button---default bs-pro-button--blue-fill-right-arrow-button bs-pro-button--btn-primary">
                              <a href="<?= home_url(); ?>" class="bs-pro-button__container">Go back to home</a>
                            </span>
                        </div>
                    </div>
                    <div class=" bs-column col-sm-12 col-md-8 col-lg-8 bs-column---default bs-column--media-block bs-column--column-right">
                        <div class="media-elements">
                            <div class="bs-common-mask">
                                <div class="bs-common-mask__wrap"><div class="bs-common-image">
                                        <figure class="figure justify-content-start d-flex">
                                            <picture>
                                                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/page-not-found.png' ?>" class="img-fluid" alt="" loading="lazy" title="">
                                            </picture>
                                        </figure>
                                    </div>
                                    <div class="bs-common-mask__layer"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>