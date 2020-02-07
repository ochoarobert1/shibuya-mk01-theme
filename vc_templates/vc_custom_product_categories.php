<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

/* GET ATTS FOR SHORTCODE  */
$category_selected = explode(',', $atts['category_selection']);
ob_start();
/* SHORTCODE STRUCTURE  */
?>
<div class="custom-category-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-xl-block d-lg-block d-md-none d-sm-none d-none">
    <div class="row align-items-center justify-content-between">
        <?php foreach ($category_selected as $category_item) { ?>
        <?php $category_element = get_term_by('id', $category_item, 'product_cat'); ?>
        <?php $product_array = new WP_Query(array('post_type' => 'product', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $category_item ))));  ?>
        <?php $product_count = $product_array->found_posts; ?>
        <?php wp_reset_query(); ?>
        <div class="custom-category-item col-xl col-lg col-md-3 col-sm-3 col-3">
            <div class="custom-category-item-wrapper">
                <a href="<?php echo get_term_link($category_element); ?>">
                    <i class="fa fa-envelope-o"></i>
                    <h3><?php echo $category_element->name; ?></h3>
                </a>
                <div class="custom-category-counter-elements">
                    <a href="<?php echo get_term_link($category_element); ?>">
                        <i class="fa fa-envelope-o"></i>
                        <h3><?php printf( esc_html( _n( '%d elemento', '%d elementos', $product_count, 'pahoy' ) ), $product_count );
                            ?></h3>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<div class="custom-category-container-mobile col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-xl-none d-lg-none d-md-block d-sm-block d-block">
    <div class="row align-items-center justify-content-between">
        <div class="custom-category-slider col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 owl-carousel owl-theme">
            <?php foreach ($category_selected as $category_item) { ?>
            <?php $category_element = get_term_by('id', $category_item, 'product_cat'); ?>
            <?php $product_array = new WP_Query(array('post_type' => 'product', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $category_item ))));  ?>
            <?php $product_count = $product_array->found_posts; ?>
            <?php wp_reset_query(); ?>
            <div class="custom-category-item item">
                <div class="custom-category-item-wrapper">
                    <a href="<?php echo get_term_link($category_element); ?>">
                        <i class="fa fa-envelope-o"></i>
                        <h3><?php echo $category_element->name; ?></h3>
                    </a>
                    <div class="custom-category-counter-elements">
                        <a href="<?php echo get_term_link($category_element); ?>">
                            <i class="fa fa-envelope-o"></i>
                            <h3><?php printf( esc_html( _n( '%d elemento', '%d elementos', $product_count, 'pahoy' ) ), $product_count );
                                ?></h3>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
/* GET OB_CACHE CONTENT */
$content = ob_get_clean();
/* RETURN SHORTCODE */
return $content;
