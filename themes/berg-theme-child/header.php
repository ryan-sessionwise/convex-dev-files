<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Start cookieyes banner --> <script id="cookieyes" type="text/javascript" src="https://cdn-cookieyes.com/client_data/c94d7389ee00f5cc8d7f08db/script.js"></script> <!-- End cookieyes banner -->
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5GNLW39');</script>
    <!-- End Google Tag Manager -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5GNLW39"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="nav" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light ustify-content-end">
            <a class="navbar__logo" href="<?php echo get_home_url(); ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
                <!--  Primary Logo -->
				<?php
				$header_logo_id = get_theme_mod( 'custom_logo' );
				 if ( ! empty( $header_logo_id ) ) :?>
					<?php $logo_url = wp_get_attachment_url( $header_logo_id ); ?>
                    <img src="<?php echo $logo_url; ?>" alt='<?php echo get_bloginfo( 'name' ); ?>'
                         class="inactive-logo">
				<?php else: ?>
                    <h1><?php echo get_bloginfo( 'name' ); ?></h1>
				<?php endif; ?>

                <!-- Secondary Logo -->
				<?php
				$secondary_header_logo_url = get_theme_mod( 'secondary_logo' );
				if ( ! empty( $secondary_header_logo_url ) ) :?>
                    <img src="<?php echo $secondary_header_logo_url; ?>" alt='<?php echo get_bloginfo( 'name' ); ?>'
                         class="active-logo img-fluid">
				<?php endif; ?>
            </a>
            <div class="navbar__top">
                <!--  load top menu here -->
				<?php wp_nav_menu(array('theme_location' => 'top-menu', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'navbar-nav mr-auto mt-2 mt-lg-0')); ?>
            </div>
            <div class="navbar__main" id="navbarSupportedContent">
                <!--  load main menu here -->
				<?php wp_nav_menu(array('theme_location' => 'main-menu', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'navbar-nav mr-auto mt-2 mt-lg-0')); ?>
            </div>
        </nav>
    </div>
</header>
<main role="main">

