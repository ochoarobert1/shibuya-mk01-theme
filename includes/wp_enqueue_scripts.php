<?php
function shibuya_load_js() {
    $version_remove = NULL;
    if (!is_admin()){
        if ($_SERVER['REMOTE_ADDR'] == '::1') {

            /*- MODERNIZR ON LOCAL  -*/
            wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'), '2.8.3', true);
            wp_enqueue_script('modernizr');

            /*- POPPER ON LOCAL  -*/
            wp_register_script('bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '4.3.1', true);
            wp_enqueue_script('bootstrap-bundle');

            /*- BOOTSTRAP ON LOCAL  -*/
            wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
            wp_enqueue_script('bootstrap');

            /*- JQUERY STICKY ON LOCAL  -*/
            //wp_register_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '1.0.4', true);
            //wp_enqueue_script('sticky');

            /*- JQUERY NICESCROLL ON LOCAL  -*/
            wp_register_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'), '3.7.6', true);
            wp_enqueue_script('nicescroll');

            /*- LETTERING  -*/
            //wp_register_script('lettering', get_template_directory_uri() . '/js/jquery.lettering.js', array('jquery'), '0.7.0', true);
            //wp_enqueue_script('lettering');

            /*- SMOOTH SCROLL -*/
            wp_register_script('smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.min.js', array('jquery'), '16.0.3', true);
            wp_enqueue_script('smooth-scroll');

            /*- SMOOTH SCROLL | POLYFILLS -*/
            wp_register_script('smooth-scroll-polyfills', get_template_directory_uri() . '/js/smooth-scroll.polyfills.min.js', array('jquery', 'smooth-scroll'), '16.0.3', true);
            wp_enqueue_script('smooth-scroll-polyfills');

            /*- IMAGESLOADED ON LOCAL  -*/
            //wp_register_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array('jquery'), '4.1.4', true);
            //wp_enqueue_script('imagesloaded');

            /*- ISOTOPE ON LOCAL  -*/
            //wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
            //wp_enqueue_script('isotope');

            /*- FLICKITY ON LOCAL  -*/
            //wp_register_script('flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array('jquery'), '2.2.0', true);
            //wp_enqueue_script('flickity');

            /*- MASONRY ON LOCAL  -*/
            //wp_register_script('masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), '4.2.2', true);
            //wp_enqueue_script('masonry');

            /*- OWL ON LOCAL -*/
            //wp_register_script('owl-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
            //wp_enqueue_script('owl-js');

            /*- WOW ON LOCAL -*/
            //wp_register_script('wow-js', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), '1.1.3', true);
            //wp_enqueue_script('wow-js');

            /*- AOS ON LOCAL -*/
            wp_register_script('aos-js', get_template_directory_uri() . '/js/aos.js', array('jquery'), '3.0.0', true);
            wp_enqueue_script('aos-js');

        } else {

            /*- MODERNIZR -*/
            wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), '2.8.3', true);
            wp_enqueue_script('modernizr');

            /*- POPPER -*/
            wp_register_script('bootstrap-bundle', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '4.3.1', true);
            wp_enqueue_script('bootstrap-bundle');

            /*- BOOTSTRAP -*/
            wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
            wp_enqueue_script('bootstrap');

            /*- JQUERY STICKY -*/
            //wp_register_script('sticky', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js', array('jquery'), '1.0.4', true);
            //wp_enqueue_script('sticky');

            /*- JQUERY NICESCROLL -*/
            wp_register_script('nicescroll', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js', array('jquery'), '3.7.6', true);
            wp_enqueue_script('nicescroll');

            /*- LETTERING  -*/
            //wp_register_script('lettering', 'https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.7.0/jquery.lettering.min.js', array('jquery'), '0.7.0', true);
            //wp_enqueue_script('lettering');

            /*- SMOOTH SCROLL -*/
            wp_register_script('smooth-scroll', 'https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.0.3/smooth-scroll.min.js', array('jquery'), '16.0.3', true);
            wp_enqueue_script('smooth-scroll');

            /*- SMOOTH SCROLL | POLYFILLS -*/
            wp_register_script('smooth-scroll-polyfills', 'https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.0.3/smooth-scroll.polyfills.min.js', array('jquery', 'smooth-scroll'), '16.0.3', true);
            wp_enqueue_script('smooth-scroll-polyfills');

            /*- IMAGESLOADED -*/
            //wp_register_script('imagesloaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array('jquery'), '4.1.4', true);
            //wp_enqueue_script('imagesloaded');

            /*- ISOTOPE -*/
            //wp_register_script('isotope', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
            //wp_enqueue_script('isotope');

            /*- FLICKITY -*/
            //wp_register_script('flickity', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array('jquery'), '2.2.0', true);
            //wp_enqueue_script('flickity');

            /*- MASONRY -*/
            //wp_register_script('masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery'), '4.2.2', true);
            //wp_enqueue_script('masonry');

            /*- OWL CAROUSEL -*/
            //wp_register_script('owl-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '2.3.4', true);
            //wp_enqueue_script('owl-js');

            /*- WOW -*/
            //wp_register_script('wow-js', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array('jquery'), '1.1.2', true);
            //wp_enqueue_script('wow-js');

            /*- AOS -*/
            wp_register_script('aos-js', 'https://unpkg.com/aos@next/dist/aos.js', array('jquery'), '3.0.0', true);
            wp_enqueue_script('aos-js');

        }

        $google_settings = get_option('sy_google_settings');

        /*- RECAPTCHA -*/
        wp_register_script('recaptcha-js', 'https://www.google.com/recaptcha/api.js?render=' . $google_settings['google_api'], array('jquery'), '3.0.0', true);
        wp_enqueue_script('recaptcha-js');

        if (is_page('checkout')) {
            wp_register_script('jquerytime-js', 'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js', array('jquery'), '1.3.5', true);
            wp_enqueue_script('jquerytime-js');
        }

        /*- MAIN FUNCTIONS -*/
        wp_register_script('main-functions', get_template_directory_uri() . '/js/functions.js', array('jquery', 'recaptcha-js'), $version_remove, true);
        wp_enqueue_script('main-functions');

        if ( class_exists( 'WooCommerce' ) ) {
            $url_id = wc_get_page_id( 'cart' );
        } else {
            $url_id = '';
        }

        /* LOCALIZE MAIN SHORTCODE SCRIPT */
        wp_localize_script( 'main-functions', 'admin_url', array(
            'ajax_custom_url' => admin_url('admin-ajax.php'),
            'google_site_key' => $google_settings['google_api'],
            'cart_custom_url' => esc_url(get_permalink($url_id)),
            'error_name' => __('Error: Name must not be empty', 'shibuya'),
            'invalid_name' => __('Error: Name must be valid', 'shibuya'),
            'error_email' => __('Error: Email must not be empty', 'shibuya'),
            'invalid_email' => __('Error: Email has an invalid format', 'shibuya'),
            'error_subject' => __('Error: Subject must not be empty', 'shibuya'),
            'invalid_subject' => __('Error: Subject must be valid', 'shibuya'),
            'error_message' => __('Error: Message must not be empty', 'shibuya'),
            'success_form' => __('Thanks for your message, we will confirm your schedule shortly.', 'shibuya'),
            'error_form' => __('Error: Try again later.', 'shibuya')
        ));

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}

add_action('wp_enqueue_scripts', 'shibuya_load_js');
