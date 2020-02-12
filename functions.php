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
    add_image_size('logo', 9999, 100, false);
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
<div class="container-fluid">
    <div class="row">
        <div class="product-quickview-image col-6">
            <?php echo get_the_post_thumbnail($product_post, 'full', array('class' => 'img-fluid' )); ?>
        </div>
        <div class="product-quickview-content col-6">
            <h2><?php echo $product_post->post_title; ?></h2>
            <div class="product-quickview-price">
                <?php echo $product->get_price_html(); ?>
            </div>
            <div class="product-quickview-info">
                <?php echo apply_filters('the_content', $product->description); ?>
            </div>
            <a href="<?php echo get_permalink($product_post); ?>" class="btn btn-sm btn-modal"><?php _e('Add to Cart', 'shibuya'); ?></a>
        </div>
    </div>
</div>

<?php 
    wp_die();
}
