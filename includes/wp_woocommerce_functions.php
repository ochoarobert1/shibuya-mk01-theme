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
    echo '<section id="main" class="container-fluid p-0"><div class="row no-gutters"><div class="woocustom-main-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">';
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
        <?php $product = wc_get_product( get_the_ID() ); ?>
        <?php $avail_activate = get_post_meta(get_the_ID(), 'activate_availability', true); ?>
        <?php if ($avail_activate == 'yes') { ?>
        <?php $availability_start = get_post_meta(get_the_ID(), 'hour_start', true); ?>
        <?php $availability_end = get_post_meta(get_the_ID(), 'hour_end', true); ?>
        <?php $time = new DateTime('now', new DateTimeZone('-4')); ?>
        <?php $now = new DateTime(); ?>
        <?php $begin = new DateTime($availability_start); ?>
        <?php $end = new DateTime($availability_end); ?>
        <?php if ($time->format("Y-m-d H:i") >= $begin->format("Y-m-d H:i") && $time->format("Y-m-d H:i") <= $end->format("Y-m-d H:i")) { ?>
        <?php $disable_ajax_time = false; ?>
        <?php } else { ?>
        <?php $disable_ajax_time = true; ?>
        <?php } ?>
        <?php if( $product->get_stock_quantity() > 0 ) { ?>
        <?php $disable_ajax = false; ?>
        <?php } else { ?>
        <?php $disable_ajax = true; ?>
        <?php } ?>
        <?php } ?>

        <?php $comb_limit_act = get_post_meta(get_the_ID(), 'activate_limit', true); ?>
        <?php if ($comb_limit_act == 'yes') { ?>
        <?php $disable_ajax = true; ?>
        <?php } else { ?>
        <?php $disable_ajax = false; ?>
        <?php } ?>


        <a id="custom_ajax_add_to_cart" data-url="<?php echo the_permalink(); ?>" data-id="<?php echo get_the_ID(); ?>" data-sku="<?php echo get_post_meta(get_the_ID(), '_sku', true); ?>" class="btn btn-sm btn-product-loop <?php if ($disable_ajax == true) { echo 'disabled'; } ?> <?php if ($disable_ajax_time == true) { echo 'disabled'; } ?>"><i class="fa fa-shopping-cart"></i></a>
        <a data-productid="<?php echo get_the_ID(); ?>" class="btn btn-sm btn-product-loop btn-quickview"><i class="fa fa-search"></i></a>
    </div>
    <div class="response-ajax-container response-ajax-container-<?php echo get_the_ID(); ?>"></div>

</div>
<?php
    /* GET OB_CACHE CONTENT */
    $content = ob_get_clean();
    /* RETURN SHORTCODE */
    return $content;
}

/* WOOCOMMERCE - CUSTOM CONTENT PRODUCT - SHOP - END */

/* WOOCOMMERCE - CUSTOM ADD TO CART AJAX HANDLER - START */

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}

/* WOOCOMMERCE - CUSTOM ADD TO CART AJAX HANDLER - END */

/* WOOCOMMERCE - ARCHIVE PRODUCT - START */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_filter( 'woocommerce_pagination_args', 	'rocket_woo_pagination' );
function rocket_woo_pagination( $args ) {

    $args['prev_text'] = '<i class="fa fa-angle-left"></i>';
    $args['next_text'] = '<i class="fa fa-angle-right"></i>';

    return $args;
}

/* WOOCOMMERCE - ARCHIVE PRODUCT - END */


/* WOOCOMMERCE - SINGLE PRODUCT - START */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', 'custom_woocommerce_single_categories', 1);

function custom_woocommerce_single_categories() {
    $terms = get_the_terms(get_the_ID(), 'product_cat');
    if ( $terms && ! is_wp_error( $terms ) ) :
?>
<div class="custom-single-category-container">
    <?php foreach ( $terms as $term ) { ?>
    <a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a>
    <?php } ?>
</div>
<?php endif;

}

/* WOOCOMMERCE - SINGLE PRODUCT - END */

/* WOOCOMMERCE - CART WIDGET - START */
function woocommerce_custom_cart_widget() {
    global $woocommerce;
    $cart_quantity = $woocommerce->cart->cart_contents_count;
    $cart_amount = $woocommerce->cart->get_cart_total();

    return '<i class="fa fa-shopping-bag"></i><div class="header-cart-label">' . __('Your Cart:', 'shibuya') . '</div> ' . sprintf( _n( '%s item', '%s items', $cart_quantity, 'shibuya' ), $cart_quantity ) . ' - ' . $cart_amount;
}


add_filter( 'woocommerce_add_to_cart_fragments', 'shibuya_add_to_cart_fragment' );

function shibuya_add_to_cart_fragment( $fragments ) {

    global $woocommerce;

    $fragments['.top-header-cart-container'] = '<a href="' . wc_get_cart_url() . '" class="top-header-cart-container"><i class="fa fa-shopping-bag"></i><div class="header-cart-label">' . __('Your Cart:', 'shibuya') . '</div> ' . sprintf( _n( '%s item', '%s items', $woocommerce->cart->cart_contents_count, 'shibuya' ), $woocommerce->cart->cart_contents_count ) . ' - ' . $woocommerce->cart->get_cart_total();
    return $fragments;

}
/* WOOCOMMERCE - CART WIDGET - END */
add_filter( 'woocommerce_before_calculate_totals', 'custom_cart_items_prices', 10, 1 );
function custom_cart_items_prices( $cart ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;


    foreach ( $cart->get_cart() as $cart_item ) {
        $product = $cart_item['data'];
        $product_id = $product->get_id();

        if( has_term( 'poke-bowls', 'product_cat', $product_id ) ) {
            $contador = 0;
            $addons_array = $cart_item['addons'];
            foreach ($addons_array as $item) {
                if ($item['name'] == 'Toppings') {
                    $contador = $contador + 1;
                }

            }
            if ($contador > 4) {
                $newaddons = $contador - 4;
                $price = $cart_item['data']->get_price();
                $new_price = $price + $newaddons;
                $cart_item['data']->set_price( $new_price );
            }
        }
    }
}


/*** Add a text field to each cart item */
function prefix_after_cart_item_name( $cart_item, $cart_item_key ) {
    $cat_check = false;
    $notes = isset( $cart_item['notes'] ) ? $cart_item['notes'] : '';
    $temp = isset( $cart_item['tempurize'] ) ? $cart_item['tempurize'] : '';

    printf(
        '<div><h6>Special Instructions</h6><textarea rows="1" cols="40" class="%s" id="cart_notes_%s" data-cart-id="%s">%s</textarea></div>',
        'prefix-cart-notes',
        $cart_item_key,
        $cart_item_key,
        $notes
    );

}
add_action( 'woocommerce_after_cart_item_name', 'prefix_after_cart_item_name', 10, 2 );

/*** Enqueue our JS file */
function prefix_enqueue_scripts() {
    wp_register_script( 'prefix-script', get_template_directory_uri() . '/js/update-cart-item-ajax.js', array( 'jquery-blockui' ), time(), true );
    wp_localize_script(
        'prefix-script',
        'prefix_vars',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        )
    );
    wp_enqueue_script( 'prefix-script' );
}
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_scripts' );


/**
 * Update cart item notes
 */
function prefix_update_cart_notes() {
    // Do a nonce check
    if( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'woocommerce-cart' ) ) {
        wp_send_json( array( 'nonce_fail' => 1 ) );
        exit;
    }
    // Save the notes to the cart meta
    $cart = WC()->cart->cart_contents;
    $cart_id = $_POST['cart_id'];
    $notes = $_POST['notes'];
    $temp = $_POST['tempurize'];
    $cart_item = $cart[$cart_id];
    $cart_item['notes'] = $notes;
    $cart_item['tempurize'] = $temp;
    WC()->cart->cart_contents[$cart_id] = $cart_item;
    WC()->cart->set_session();
    wp_send_json( array( 'success' => 1 ) );
    exit;
}
add_action( 'wp_ajax_prefix_update_cart_notes', 'prefix_update_cart_notes' );
add_action( 'wp_ajax_nopriv_prefix_update_cart_notes', 'prefix_update_cart_notes' );

function prefix_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    foreach( $item as $cart_item_key=>$cart_item ) {
        if( isset( $cart_item['notes'] ) ) {
            $item->add_meta_data( 'notes', $cart_item['notes'], true );
        }
        if( isset( $cart_item['tempurize'] ) ) {
            $item->add_meta_data( 'tempurize', $cart_item['tempurize'], true );
        }
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'prefix_checkout_create_order_line_item', 10, 4 );

/* add notes */

add_filter( 'woocommerce_product_data_tabs', 'wk_custom_product_tab', 10, 1 );

function wcpp_custom_style() {

?><style>
    #woocommerce-product-data ul.wc-tabs li.custom_tab a:before {
        content: "\f502" !important;
    }

</style><?php

}
add_action( 'admin_head', 'wcpp_custom_style' );

function wk_custom_product_tab( $default_tabs ) {
    $default_tabs['availability'] = array(
        'label'   =>  __( 'Availability', 'domain' ),
        'target'  =>  'sy_availability_data',
        'priority' => 50,
        'class'   => array( 'show_if_simple', 'show_if_variable'  ),
    );
    return $default_tabs;
}

add_action( 'woocommerce_product_options_general_product_data', 'sy_combination_limits' );

function sy_combination_limits() {
    ob_start();
?>

<div class="options_group">
    <?php
    woocommerce_wp_checkbox(
        array(
            'id'        => 'activate_limit',
            'label'     => __( 'Activate limit for Combinations', 'tpwcp' ),
            'desc_tip'  => __( 'Select this option to set a limit for Combinations', 'tpwcp' )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'        => 'limit_combinations',
            'label'     => __( 'Set a limit for combinations for this Product', 'tpwcp' ),
            'type'      => 'number',
            'desc_tip'  => __( 'Set a limit for combinations for this Product', 'tpwcp' )
        )
    );


    ?>
</div>

<?php
    $content = ob_get_clean();
    echo $content;
}



add_action( 'woocommerce_product_data_panels', 'sy_availability_data' );

function sy_availability_data() {
    ob_start();
?>
<div id="sy_availability_data" class="panel woocommerce_options_panel hidden">
    <div class="options_group">
        <?php
    woocommerce_wp_checkbox(
        array(
            'id'        => 'activate_availability',
            'label'     => __( 'Activate availability by hours (Only works with add-ons)', 'tpwcp' ),
            'desc_tip'  => __( 'Select this option to set hours of availability or this product', 'tpwcp' )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'        => 'hour_start',
            'label'     => __( 'Start Hour for Product', 'tpwcp' ),
            'type'      => 'time',
            'desc_tip'  => __( 'Select the starting hour for availability', 'tpwcp' )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'        => 'hour_end',
            'label'     => __( 'End Hour for product', 'tpwcp' ),
            'type'      => 'time',
            'desc_tip'  => __( 'Select the ending hour for availability', 'tpwcp' )
        )
    );

        ?>
    </div>
</div>
<?php
    $content = ob_get_clean();
    echo $content;
}

add_action( 'woocommerce_process_product_meta', 'shibuya_product_custom_save_fields' );

function shibuya_product_custom_save_fields( $post_id ) {

    $product = wc_get_product( $post_id );

    /* ADDONS LIMIT */
    $activate_limit = isset( $_POST['activate_limit'] ) ? 'yes' : 'no';
    $product->update_meta_data( 'activate_limit', sanitize_text_field( $activate_limit ) );

    if (isset( $_POST['limit_combinations'] )) {
        $limit_combinations = $_POST['limit_combinations'];
        $product->update_meta_data( 'limit_combinations', $limit_combinations);
    }

    /* AVAILABILITY */
    $activate_availability = isset( $_POST['activate_availability'] ) ? 'yes' : 'no';
    $product->update_meta_data( 'activate_availability', sanitize_text_field( $activate_availability ) );

    if (isset( $_POST['hour_start'] )) {
        $availability_start = $_POST['hour_start'];
        $product->update_meta_data( 'hour_start', $availability_start);

    }

    if (isset( $_POST['hour_end'] )) {
        $availability_end = $_POST['hour_end'];
        $product->update_meta_data( 'hour_end', $availability_end);
    }


    $product->save();

}

/**
 * Add the field to the checkout
 */
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    woocommerce_form_field( 'time_takeout', array(
        'type'          => 'time',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Time for takeout [Elegible only for Pickup]'),
        'placeholder'   => __('Enter an hour where you can come for your order'),
    ), $checkout->get_value( 'time_takeout' ));
}

/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    $shipping_custom = $_POST['shipping_method'];
    $shipping_selected = $shipping_custom[0];
    if (( ! $_POST['time_takeout'] && (strpos($shipping_selected, 'pickup') !== false) )) {
        wc_add_notice( __( '<strong>Error:</strong> Pickup is Selected, we will need a time for takeout.' ), 'error' );
    }
}

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['time_takeout'] ) ) {
        update_post_meta( $order_id, 'time_takeout', sanitize_text_field( $_POST['time_takeout'] ) );
    }
}

/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Time for Takeout').':</strong> ' . get_post_meta( $order->id, 'time_takeout', true ) . '</p>';
}


function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }

    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );

add_action( 'woocommerce_cart_totals_before_order_total', 'display_cart_volume_total', 20 );
function display_cart_volume_total() {
//   $delivery_zones = WC_Shipping_Zones::get_zones();
//
//foreach ((array) $delivery_zones as $key => $the_zone ) {
//
//  $dev_zones[] = $the_zone['shipping_methods'];
//
//}
//foreach ($dev_zones as $item => $value) {
//    print_r($value);
//    echo '<br></br>';
//}
?>

<tr class="cart-total-custom-shipping">
    <th><?php _e( "Shipping", "woocommerce" ); ?></th>
    <td data-title="Shipping" class="cart-total-custom-shipping-methods">
        <label for="shipping_custom1"><input type="radio" name="shipping_custom_method_false" id="shipping_custom1" /> $ 0.00 | Pickup</label>
        <small>We will ask for the time that you can come and get your order.</small>
        <label for="shipping_custom2"><input type="radio" name="shipping_custom_method_false" id="shipping_custom2" /> $ 4.00 | Delivery</label>
        <small>We will need to validate your address in order to know if you are elegible for delivery.</small>
        <p>(These options will be calculated on Checkout.)</p>
    </td>
</tr>
<?php
}
