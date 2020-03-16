<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

$shop_id = get_option( 'woocommerce_shop_page_id' );

if (is_tax('product_cat')) {
    $image_id = get_term_meta(get_queried_object_id(), 'thumbnail_id', true);
} else {
    $image_id = get_post_meta($shop_id, 'sby_page_banner_id', true);
}

$bg_hero = wp_get_attachment_image_src($image_id, 'full', false);

?>
<?php if (is_shop()) { $collapsed = true; } else { $collapsed = false; } ?>
<div class="accordion custom-accordion d-xl-none d-lg-none d-md-none d-sm-block d-block" id="accordionMobile">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0 <?php if ($collapsed == false) { echo 'collapsed'; } ?>" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <button class="btn btn-link" type="button">
                    <?php _e('Menu', 'shibuya'); ?>

                    <div class="custom-caret"><i class="fa fa-chevron-down"></i></div>
                </button>
            </h2>
        </div>
        <div id="collapseOne" class="collapse <?php if ($collapsed == true) { echo 'show'; } ?>" aria-labelledby="headingOne" data-parent="#accordionMobile">
            <div class="card-body">
                <div class="custom-category-mobile-container">
                    <?php $product_cat = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => false, 'order' => 'ASC', 'orderby' => 'menu_order')); ?>
                    <?php if (!empty($product_cat)) { ?>
                    <ul>
                        <?php foreach ($product_cat as $product_item) { ?>
                        <?php if ($product_item->name != 'Products') { ?>
                        <?php if ($product_item->term_id == get_queried_object_id()) { ?>
                        <?php $active = 'active'; ?>
                        <?php } else { ?>
                        <?php $active = ''; ?>
                        <?php } ?>
                        <li class="<?php echo $active; ?>">
                            <a href="<?php echo get_term_link($product_item); ?>"><?php echo $product_item->name; ?></a>
                        </li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-woocommerce-title-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="background: url(<?php echo $bg_hero[0]; ?>);">
    <header class="woocommerce-products-header">
        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
        /**
     * Hook: woocommerce_archive_description.
     *
     * @hooked woocommerce_taxonomy_archive_description - 10
     * @hooked woocommerce_product_archive_description - 10
     */
        do_action( 'woocommerce_archive_description' );
        ?>
    </header>
</div>
<div class="container">
    <div class="row">
        <div class="main-woocommerce-custom-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="row">
                <div class="woocommerce-custom-sidebar col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">

                    <?php
                    /**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
                    do_action( 'woocommerce_sidebar' );
                    ?>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">

                    <?php
                    if ( woocommerce_product_loop() ) {

                        /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked woocommerce_output_all_notices - 10
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
                        do_action( 'woocommerce_before_shop_loop' );

                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();

                                /**
             * Hook: woocommerce_shop_loop.
             */
                                do_action( 'woocommerce_shop_loop' );

                                wc_get_template_part( 'content', 'product' );
                            }
                        }

                        woocommerce_product_loop_end();

                        /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked woocommerce_pagination - 10
     */
                        do_action( 'woocommerce_after_shop_loop' );
                    } else {
                        /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
                        do_action( 'woocommerce_no_products_found' );
                    }

                    /**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
                    do_action( 'woocommerce_after_main_content' );

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer( 'shop' );
