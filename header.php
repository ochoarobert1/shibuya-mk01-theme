<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <?php /* MAIN STUFF */ ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset') ?>" />
    <meta name="robots" content="NOODP, INDEX, FOLLOW" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="dns-prefetch" href="//connect.facebook.net" />
    <link rel="dns-prefetch" href="//facebook.com" />
    <link rel="dns-prefetch" href="//googleads.g.doubleclick.net" />
    <link rel="dns-prefetch" href="//pagead2.googlesyndication.com" />
    <link rel="dns-prefetch" href="//google-analytics.com" />
    <?php /* FAVICONS */ ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
    <?php /* THEME NAVBAR COLOR */ ?>
    <meta name="msapplication-TileColor" content="#B27900" />
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png" />
    <meta name="theme-color" content="#B27900" />
    <?php /* AUTHOR INFORMATION */ ?>
    <meta name="language" content="<?php echo get_bloginfo('language'); ?>" />
    <meta name="author" content="Shibuya Sushi Art" />
    <meta name="copyright" content="https://www.shibuya.us/" />
    <meta name="geo.position" content="26.2869426,-80.2801419" />
    <meta name="ICBM" content="26.2869426,-80.2801419" />
    <meta name="geo.region" content="US" />
    <meta name="geo.placename" content="11346 Wiles Rd, Coral Springs, FL 33076" />
    <meta name="DC.title" content="<?php if (is_home()) { echo get_bloginfo('name') . ' | ' . get_bloginfo('description'); } else { echo get_the_title() . ' | ' . get_bloginfo('name'); } ?>" />
    <?php /* MAIN TITLE - CALL HEADER MAIN FUNCTIONS */ ?>
    <?php wp_title('|', false, 'right'); ?>
    <?php wp_head() ?>
    <?php /* OPEN GRAPHS INFO - COMMENTS SCRIPTS */ ?>
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php /* IE COMPATIBILITIES */ ?>
    <!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7" /><![endif]-->
    <!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8" /><![endif]-->
    <!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9" /><![endif]-->
    <!--[if gt IE 8]><!-->
    <html <?php language_attributes(); ?> class="no-js" />
    <!--<![endif]-->
    <!--[if IE]> <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script> <![endif]-->
    <!--[if IE]> <script type="text/javascript" src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script> <![endif]-->
    <!--[if IE]> <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" /> <![endif]-->
    <?php get_template_part('includes/fb-script'); ?>
    <?php get_template_part('includes/ga-script'); ?>
</head>

<body class="the-main-body <?php echo join(' ', get_body_class()); ?>" itemscope itemtype="http://schema.org/WebPage">
    <div id="fb-root"></div>
    <header class="container-fluid p-0" role="banner" itemscope itemtype="http://schema.org/WPHeader">
        <div class="row no-gutters">
            <div id="top" class="top-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container">
                    <div class="row">
                        <div class="top-left col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 d-xl-block d-lg-block d-md-block d-sm-none d-none"></div>

                        <div class="top-center col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                            <?php $social_options = get_option('sy_social_settings'); ?>
                            <?php if (isset($social_options['facebook'])) { ?>
                            <?php if ($social_options['facebook'] != '' ) { ?>
                            <a href="<?php echo esc_url($social_options['facebook']);?>" title="<?php _e('Visita nuestro Perfil en Facebook', 'shibuya'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <?php } ?>
                            <?php } ?>

                            <?php if (isset($social_options['twitter'])) { ?>
                            <?php if ($social_options['twitter'] != '') { ?>
                            <a href="<?php echo esc_url($social_options['twitter']);?>" title="<?php _e('Visita nuestro Perfil en Twitter', 'shibuya'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <?php } ?>
                            <?php } ?>

                            <?php if (isset($social_options['instagram'])) { ?>
                            <?php if ($social_options['instagram'] != '') { ?>
                            <a href="<?php echo esc_url($social_options['instagram']);?>" title="<?php _e('Visita nuestro Perfil en Instagram', 'shibuya'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                            <?php } ?>
                            <?php } ?>

                            <?php if (isset($social_options['youtube'])) { ?>
                            <?php if ($social_options['youtube'] != '') { ?>
                            <a href="<?php echo esc_url($social_options['youtube']);?>" title="<?php _e('Visita nuestro Canal en YouTube', 'shibuya'); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a>
                            <?php } ?>
                            <?php } ?>

                            <?php if (isset($social_options['linkedin'])) { ?>
                            <?php if ($social_options['linkedin'] != '') { ?>
                            <a href="<?php echo esc_url($social_options['linkedin']);?>" title="<?php _e('Visita nuestro Perfil en LinkedIn', 'shibuya'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                            <?php } ?>
                            <?php } ?>

                            <?php if (isset($social_options['yelp'])) { ?>
                            <?php if ($social_options['yelp'] != '') { ?>
                            <a href="<?php echo esc_url($social_options['yelp']);?>" title="<?php _e('Visita nuestro Perfil en Yelp', 'shibuya'); ?>" target="_blank"><i class="fa fa-yelp"></i></a>
                            <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="top-right col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">

                            <a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" class="top-header-cart-container">
                                <?php echo woocommerce_custom_cart_widget(); ?>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="the-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                <div class="container">
                    <div class="row">
                        <div class="logo-container col-12">
                            <a href="<?php echo home_url('/');?>" title="<?php echo get_bloginfo('name'); ?>">
                                <?php ?> <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                                <?php $image = wp_get_attachment_image_src( $custom_logo_id , 'logo' ); ?>
                                <?php if (!empty($image)) { ?>
                                <img src="<?php echo $image[0];?>" alt="<?php echo get_bloginfo('name'); ?>" class="img-fluid img-logo" />
                                <?php } ?>
                            </a>
                        </div>
                        <div class="navbar-container col-12">
                            <nav class="navbar navbar-expand-md navbar-light" role="navigation">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location'    => 'header_menu',
                                        'depth'             => 1, // 1 = with dropdowns, 0 = no dropdowns.
                                        'container'         => 'div',
                                        'container_class'   => 'collapse navbar-collapse',
                                        'container_id'      => 'bs-example-navbar-collapse-1',
                                        'menu_class'        => 'navbar-nav ml-auto mr-auto',
                                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker'            => new WP_Bootstrap_Navwalker()
                                    ) );
                                    ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mobile col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-xl-none d-lg-none d-md-block d-sm-block d-block">
                <div class="container">
                    <div class="row">
                        <div class="logo-mobile-container col-xl-6 col-lg-6 col-md-6 col-sm-8 col-8">
                            <a href="<?php echo home_url('/');?>" title="<?php echo get_bloginfo('name'); ?>">
                                <?php ?> <?php $custom_logo_id = get_theme_mod( 'custom_logo' ); ?>
                                <?php $image = wp_get_attachment_image_src( $custom_logo_id , 'logo' ); ?>
                                <?php if (!empty($image)) { ?>
                                <img src="<?php echo $image[0];?>" alt="<?php echo get_bloginfo('name'); ?>" class="img-fluid img-logo" />
                                <?php } ?>
                            </a>
                        </div>
                        <div class="navbar-mobile-container col-xl-6 col-lg-6 col-md-6 col-sm-4 col-4">
                            <div class="menu-mobile-button">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-mobile-content menu-mobile-hidden col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'header_menu',
                            'depth'             => 1, // 1 = with dropdowns, 0 = no dropdowns.
                            'container'         => 'div'
                        ) );
                        ?>
                </div>
            </div>
        </div>
    </header>
