<?php
function shibuya_load_css() {
    $version_remove = NULL;
    if (!is_admin()){
        if ($_SERVER['REMOTE_ADDR'] == '::1') {

            /*- BOOTSTRAP CORE ON LOCAL -*/
            wp_register_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', false, '4.3.1', 'all');
            wp_enqueue_style('bootstrap-css');

            /*- ANIMATE CSS ON LOCAL -*/
            wp_register_style('animate-css', get_template_directory_uri() . '/css/animate.css', false, '3.7.2', 'all');
            wp_enqueue_style('animate-css');

            /*- FONT AWESOME ON LOCAL -*/
            wp_register_style('fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', false, '4.7.0', 'all');
            wp_enqueue_style('fontawesome-css');

            /*- FLICKITY ON LOCAL -*/
            //wp_register_style('flickity-css', get_template_directory_uri() . '/css/flickity.min.css', false, '2.2.0', 'all');
            //wp_enqueue_style('flickity-css');

            /*- OWL ON LOCAL -*/
            //wp_register_style('owl-css', get_template_directory_uri() . '/css/owl.carousel.min.css', false, '2.3.4', 'all');
            //wp_enqueue_style('owl-css');

            /*- OWL ON LOCAL - NORMAL THEME -*/
            //wp_register_style('owltheme-css', get_template_directory_uri() . '/css/owl.theme.default.min.css', false, '2.3.4', 'all');
            //wp_enqueue_style('owltheme-css');

            /*- AOS ON LOCAL -*/
            wp_register_style('aos-css', get_template_directory_uri() . '/css/aos.css', false, '3.0.0', 'all');
            wp_enqueue_style('aos-css');


        } else {

            /*- BOOTSTRAP CORE -*/
            wp_register_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, '4.3.1', 'all');
            wp_enqueue_style('bootstrap-css');

            /*- ANIMATE CSS -*/
            wp_register_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', false, '3.7.2', 'all');
            wp_enqueue_style('animate-css');

            /*- FONT AWESOME -*/
            wp_register_style('fontawesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0', 'all');
            wp_enqueue_style('fontawesome-css');

            /*- FLICKITY -*/
            //wp_register_style('flickity-css', 'https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.0/flickity.min.css', false, '2.2.0', 'all');
            //wp_enqueue_style('flickity-css');

            /*- OWL -*/
            //wp_register_style('owl-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', false, '2.3.4', 'all');
            //wp_enqueue_style('owl-css');

            /*- OWL - THEME DEFAULT -*/
            //wp_register_style('owltheme-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', false, '2.3.4', 'all');
            //wp_enqueue_style('owltheme-css');

            /*- AOS -*/
            wp_register_style('aos-css', 'https://unpkg.com/aos@next/dist/aos.css', false, '3.0.0', 'all');
            wp_enqueue_style('aos-css');
        }

        /*- GOOGLE FONTS -*/
        wp_register_style('google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900|Open+Sans:300,400,600,700,800|Quicksand:300,400,500,600,700&display=swap', false, $version_remove, 'all');
        wp_enqueue_style('google-fonts');

        if (is_page('checkout')) {
            wp_register_style('jquerytime-css', '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css', false, '1.3.5', 'all');
            wp_enqueue_style('jquerytime-css');
        }

        /*- MAIN STYLE -*/
        wp_register_style('main-style', get_template_directory_uri() . '/css/shibuya-style.css', false, $version_remove, 'all');
        wp_enqueue_style('main-style');

        /*- MAIN MEDIAQUERIES -*/
        wp_register_style('main-mediaqueries', get_template_directory_uri() . '/css/shibuya-mediaqueries.css', array('main-style'), $version_remove, 'all');
        wp_enqueue_style('main-mediaqueries');

        /*- WORDPRESS STYLE -*/
        wp_register_style('wp-initial-style', get_template_directory_uri() . '/style.css', false, $version_remove, 'all');
        wp_enqueue_style('wp-initial-style');
    }
}

add_action('wp_enqueue_scripts', 'shibuya_load_css');
