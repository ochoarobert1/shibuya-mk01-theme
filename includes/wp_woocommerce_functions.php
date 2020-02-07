<?php
/* WOOCOMMERCE CUSTOM COMMANDS */

/* WOOCOMMERCE - DECLARE THEME SUPPORT - BEGIN */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
/* WOOCOMMERCE - DECLARE THEME SUPPORT - END */

/* WOOCOMMERCE - CUSTOM WRAPPER - BEGIN */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
    echo '<section id="main" class="container-fluid"><div class="row"><div class="woocustom-main-container col-12">';
}

function my_theme_wrapper_end() {
    echo '</div></div></section>';
}
/* WOOCOMMERCE - CUSTOM WRAPPER - END */


/* WOOCOMMERCE - CUSTOM CONTENT PRODUCT - SHOP - START */

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_shop_loop_item_category', 'woocoommerce_custom_shop_loop_categories', 15);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);


function woocoommerce_custom_shop_loop_categories() {
    $terms = get_the_terms(get_the_ID(), 'product_cat');
    if (!empty($terms)) {
        foreach ($terms as $term) { ?>
<a href="<?php echo get_term_link($term); ?>" title="<?php _e('View more', 'shibuya'); ?>" class="custom-product-loop-category" l><?php echo $term->name; ?></a>
<?php }
    }
}

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
}


/**
 * WooCommerce Product Thumbnail
 **/
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
        global $post, $woocommerce;

        $size = wc_get_image_size( 'shop_catalog' );

        if ( ! $placeholder_width )
            $placeholder_width = $size['width'];
        if ( ! $placeholder_height )
            $placeholder_height = $size['height'];

        $output = '<div class="custom-image-wrapper">';

        $output .= '<a href="'. get_permalink() .'" title="' . __('View More') . '">';
        if ( has_post_thumbnail() ) {

            $output .= get_the_post_thumbnail( $post->ID, 'shop_catalog' ); 

        } else {

            $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';

        }
        $output .= '</a>';

        $output .= woocommerce_custom_image_wrapper_handler();

        $output .= '</div>';

        return $output;
    }
}

function woocommerce_custom_image_wrapper_handler() {
    ob_start();
?>
<div class="custom-image-data-wrapper">
    <h2><?php echo get_the_title(); ?></h2>
    <div class="rating-container">
        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
    </div>
    <div class="buttons-container">
        <a href="?add_to_cart=<?php echo get_the_ID(); ?>" class="btn btn-sm btn-product-loop"><i class="fa fa-shopping-cart"></i></a>
        <a href="<?php echo get_permalink(); ?>" class="btn btn-sm btn-product-loop"><i class="fa fa-search"></i></a>
    </div>

</div>
<?php 
    /* GET OB_CACHE CONTENT */
    $content = ob_get_clean();
    /* RETURN SHORTCODE */
    return $content;
}
/* WOOCOMMERCE - CUSTOM CONTENT PRODUCT - SHOP - END */
