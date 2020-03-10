<?php

/* --------------------------------------------------------------
    ENQUEUE AND REGISTER CSS
-------------------------------------------------------------- */

require_once('includes/wp_enqueue_styles.php');

/* --------------------------------------------------------------
    ENQUEUE AND REGISTER JS
-------------------------------------------------------------- */

if (!is_admin()) add_action('wp_enqueue_scripts', 'my_jquery_enqueue');
function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
    if ($_SERVER['REMOTE_ADDR'] == '::1') {
        /*- JQUERY ON LOCAL  -*/
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '3.4.1', false);
        /*- JQUERY MIGRATE ON LOCAL  -*/
        wp_register_script( 'jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate.min.js',  array('jquery'), '3.0.1', false);
    } else {
        /*- JQUERY ON WEB  -*/
        wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', false, '3.4.1', false);
        /*- JQUERY MIGRATE ON WEB  -*/
        wp_register_script( 'jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.0.1.min.js', array('jquery'), '3.0.1', true);
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-migrate');
}

/* NOW ALL THE JS FILES */
require_once('includes/wp_enqueue_scripts.php');

/* --------------------------------------------------------------
    ADD CUSTOM WALKER BOOTSTRAP
-------------------------------------------------------------- */

// WALKER COMPLETO TOMADO DESDE EL NAVBAR COLLAPSE
require_once('includes/class-wp-bootstrap-navwalker.php');

/* --------------------------------------------------------------
    ADD CUSTOM WORDPRESS FUNCTIONS
-------------------------------------------------------------- */

require_once('includes/wp_custom_functions.php');

/* --------------------------------------------------------------
    ADD REQUIRED WORDPRESS PLUGINS
-------------------------------------------------------------- */

require_once('includes/class-tgm-plugin-activation.php');
require_once('includes/class-required-plugins.php');

/* --------------------------------------------------------------
    ADD CUSTOM WOOCOMMERCE OVERRIDES
-------------------------------------------------------------- */
if ( class_exists( 'WooCommerce' ) ) {
    require_once('includes/wp_woocommerce_functions.php');
}

/* --------------------------------------------------------------
    ADD JETPACK COMPATIBILITY
-------------------------------------------------------------- */
if ( defined( 'JETPACK__VERSION' ) ) {
    require_once('includes/wp_jetpack_functions.php');
}

/* --------------------------------------------------------------
    ADD THEME SUPPORT
-------------------------------------------------------------- */

load_theme_textdomain( 'shibuya', get_template_directory() . '/languages' );
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ));
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_theme_support( 'customize-selective-refresh-widgets' );
add_theme_support( 'custom-background',
                  array(
                      'default-image' => '',    // background image default
                      'default-color' => 'ffffff',    // background color default (dont add the #)
                      'wp-head-callback' => '_custom_background_cb',
                      'admin-head-callback' => '',
                      'admin-preview-callback' => ''
                  )
                 );
add_theme_support( 'custom-logo', array(
    'height'      => 250,
    'width'       => 250,
    'flex-width'  => true,
    'flex-height' => true,
) );


add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );

/* --------------------------------------------------------------
    ADD NAV MENUS LOCATIONS
-------------------------------------------------------------- */

register_nav_menus( array(
    'header_menu' => __( 'Menu Header - Principal', 'shibuya' ),
    'footer_menu' => __( 'Menu Footer - Principal', 'shibuya' ),
) );

/* --------------------------------------------------------------
    ADD DYNAMIC SIDEBAR SUPPORT
-------------------------------------------------------------- */

add_action( 'widgets_init', 'shibuya_widgets_init' );
function shibuya_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar Principal', 'shibuya' ),
        'id' => 'main_sidebar',
        'description' => __( 'Estos widgets seran vistos en las entradas y páginas del sitio', 'shibuya' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'Shop Sidebar', 'shibuya' ),
        'id' => 'shop_sidebar',
        'description' => __( 'Estos widgets seran vistos en Tienda y Categorias de Producto', 'shibuya' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ) );
}

/* --------------------------------------------------------------
    CUSTOM ADMIN LOGIN
-------------------------------------------------------------- */

function custom_admin_styles() {
    $version_remove = NULL;
    wp_register_style('wp-admin-style', get_template_directory_uri() . '/css/custom-wordpress-admin-style.css', false, $version_remove, 'all');
    wp_enqueue_style('wp-admin-style');
}
add_action('login_head', 'custom_admin_styles');
add_action('admin_init', 'custom_admin_styles');


function dashboard_footer() {
    echo '<span id="footer-thankyou">';
    _e ('Gracias por crear con ', 'shibuya' );
    echo '<a href="http://wordpress.org/" target="_blank">WordPress.</a> - ';
    _e ('Tema desarrollado por ', 'shibuya' );
    echo '<a href="http://robertochoa.com.ve/?utm_source=footer_admin&utm_medium=link&utm_content=shibuya" target="_blank">Robert Ochoa</a></span>';
}
add_filter('admin_footer_text', 'dashboard_footer');

/* --------------------------------------------------------------
    ADD CUSTOM METABOX
-------------------------------------------------------------- */

require_once('includes/wp_custom_metabox.php');

/* --------------------------------------------------------------
    ADD CUSTOM POST TYPE
-------------------------------------------------------------- */

require_once('includes/wp_custom_post_type.php');

/* --------------------------------------------------------------
    ADD CUSTOM THEME CONTROLS
-------------------------------------------------------------- */

require_once('includes/wp_custom_theme_control.php');


/* --------------------------------------------------------------
    ADD WPBAKERY OVERRIDES
-------------------------------------------------------------- */

require_once('includes/wp_wpbakery_overrides.php');

/* --------------------------------------------------------------
    ADD CUSTOM IMAGE SIZE
-------------------------------------------------------------- */
if ( function_exists('add_theme_support') ) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size( 9999, 400, true);
}
if ( function_exists('add_image_size') ) {
    add_image_size('avatar', 100, 100, true);
    add_image_size('logo', 9999, 150, false);
    add_image_size('blog_img', 276, 217, true);
    add_image_size('shop_catalog', 300, 300, array('center', 'center'));
    add_image_size('single_img', 636, 297, true );
}

/* --------------------------------------------------------------
    ADD AJAX PRODUCT QUICKVIEW
-------------------------------------------------------------- */
add_action('wp_ajax_nopriv_ajax_product_quickview', 'ajax_product_quickview_handler');
add_action('wp_ajax_ajax_product_quickview', 'ajax_product_quickview_handler');

function ajax_product_quickview_handler() {
    $product_id = $_POST['product_id'];
    $product_post = get_post($product_id);
    $product = wc_get_product($product_id);
?>
<?php $comb_limit_act = get_post_meta($product_id, 'activate_limit', true); ?>
<?php if ($comb_limit_act == 'yes') { ?>
<?php $hidden_input = '<input type="hidden" name="limit_combinations" value="'. get_post_meta($product_id, 'limit_combinations', true).'" />'; ?>
<?php } else { ?>
<?php $hidden_input = ''; ?>
<?php } ?>
<div class="container-fluid">
    <div class="row">
        <div class="product-quickview-image col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <?php echo get_the_post_thumbnail($product_post, 'full', array('class' => 'img-fluid' )); ?>
        </div>
        <div class="product-quickview-content col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h2><?php echo $product_post->post_title; ?></h2>
            <div class="product-quickview-price">
                <?php echo $product->get_price_html(); ?>
            </div>
            <div class="product-quickview-info">
                <?php echo apply_filters('the_content', $product->description); ?>
            </div>
            <div class="product-quickview-add-button">
                <?php if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) { ?>
                <?php $avail_activate = get_post_meta($product_id, 'activate_availability', true); ?>
                <?php if ($avail_activate == 'yes') { ?>
                <?php $availability_start = get_post_meta($product_id, 'hour_start', true); ?>
                <?php $availability_end = get_post_meta($product_id, 'hour_end', true); ?>
                <?php $time = new DateTime('now', new DateTimeZone('-4')); ?>
                <?php $now = new DateTime(); ?>
                <?php $begin = new DateTime($availability_start); ?>
                <?php $end = new DateTime($availability_end); ?>
                <?php if ($time->format("Y-m-d H:i") >= $begin->format("Y-m-d H:i") && $time->format("Y-m-d H:i") <= $end->format("Y-m-d H:i")) { ?>
                <?php $html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">'; ?>
                <?php $html .= woocommerce_quantity_input( array(), $product, false );?>
                <?php $html .= '<button type="submit" class="button alt btn btn-sm btn-modal">' . esc_html( $product->add_to_cart_text() ) . '</button>'; ?>
                <?php $html .= '</form>'; ?>
                <?php } else { ?>
                <h3 class="product-not-available"><?php printf( __('This product is available only between %s and %s hours', 'shibuya'), $availability_start, $availability_end); ?></h3>
                <?php } ?>
                <?php } else { ?>
                <?php if ($comb_limit_act == 'yes') { ?>
                <a href="<?php echo get_permalink($product_id); ?>" class="btn btn-sm btn-modal"><?php _e('Choose your options here', 'shibuya'); ?></a>
                <?php } else { ?>
                <?php $html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">'; ?>
                <?php $html .= woocommerce_quantity_input( array(), $product, false );?>
                <?php $html .= '<button type="submit" class="button alt btn btn-sm btn-add-cart">' . esc_html( $product->add_to_cart_text() ) . '</button>'; ?>
                <?php $html .= '</form>'; ?>
                <?php } ?>
                <?php } ?>
                <?php echo $html; ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php  wp_die(); }

/* --------------------------------------------------------------
    AJAX SEND CONTACT FORM
-------------------------------------------------------------- */
add_action('wp_ajax_ajax_send_contact_form', 'ajax_send_contact_form_handler');
add_action('wp_ajax_nopriv_ajax_send_contact_form', 'ajax_send_contact_form_handler');

function ajax_send_contact_form_handler() {
    $google_settings = get_option('sy_google_settings');

    parse_str($_POST['info'], $submit);

    if ($submit["g-recaptcha-response"]) {
        $post_data = http_build_query(
            array(
                'secret' => $google_settings['google_secret'],
                'response' => $submit['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ), '', '&');
        $opts = array('http' =>
                      array(
                          'method'  => 'POST',
                          'header'  => 'Content-type: application/x-www-form-urlencoded',
                          'content' => $post_data
                      )
                     );
        $context  = stream_context_create($opts);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $result = json_decode($response);
    }
    if($result->success == true) {

        $contact_fields  = array(
            'fullname' => __('Name', 'shibuya'),
            'email' => __('Email', 'shibuya'),
            'subject' => __('Subject', 'shibuya'),
            'message' => __('Message', 'shibuya'),
            'g-recaptcha-response' => ''
        );



        global $title;
        $title = __('Shibuya Sushi Art - Contact Message', 'shibuya');

        ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php global $title ?>
        <title><?php echo $title ?></title>
    </head>

    <body>

        <div style="color:#444; max-width: 600px; border: 1px solid #cccccc; padding: 15px; box-shadow: 0 0 2px #999999; margin: auto; font-family:Open-sans, sans-serif;">
            <h2 style="margin-bottom: 2px; margin-top: 2px;"><?php echo $title ?></h2>
            <p style="margin-top: 2px; margin-bottom: 2px"><?php _e('Sent', 'shibuya'); ?>: <?php echo date("Y/m/d h:i") ?></p>
            <hr style="border: solid 2px #444">
            <div style="border: solid 1px #cccccc; background-color: #eeeeee; padding: 15px; margin-top: 15px;">
                <?php
            foreach ($contact_fields as $key => $field) {
                if ($key != 'g-recaptcha-response') {
                    $field_value = apply_filters('mailto', $submit[$key]);
                    printf('<p style="margin: 5px 0;"><strong>%s</strong>: %s</p>', $field, $field_value);
                }
            }
                ?>
            </div>
        </div>
    </body>

</html>
<?php
        $content = ob_get_clean();

        require_once ABSPATH . WPINC . '/class-phpmailer.php';
        $mail = new PHPMailer();
        $email = 'ochoa.robert1@gmail.com';
        $mail->AddAddress($email);
        //    $mail->AddAddress("nefasdrain@gmail.com");
        $mail->From = 'noreply@' . $_SERVER['SERVER_NAME'];
        $mail->FromName = get_option('blogname');
        $mail->Subject = $title;
        $mail->Body = $content;
        $mail->IsHTML();
        $mail->CharSet = 'utf-8';

        $result = $mail->Send();

        if ($result) {
            echo 'true';
        } else {
            echo 'false';
        }

    } else {
        echo 'false';
    }

    wp_die();
}
