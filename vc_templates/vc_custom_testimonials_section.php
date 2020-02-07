<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

/* GET ATTS FOR SHORTCODE  */
$quantity = $atts['quantity'];
ob_start();
/* SHORTCODE STRUCTURE  */
?>
<div class="custom-testimonials-section col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="container">
        <div class="row">
            <div class="custom-testimonials-content col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="custom-testimonials-slider owl-carousel owl-theme">
                    <?php $args = array('post_type' => 'testimonios', 'posts_per_page' => $quantity, 'order' => 'DESC', 'orderby' => 'date'); ?>
                    <?php $array_testimonials = new WP_Query($args); ?>
                    <?php if ($array_testimonials->have_posts()) : ?>
                    <?php while ($array_testimonials->have_posts()) : $array_testimonials->the_post(); ?>
                    <div class="custom-testimonials-item">
                        <div class="custom-testimonials-item-wrapper">
                            <div class="media">
                                <?php $img = get_the_post_thumbnail_url(get_the_ID(), 'avatar'); ?>
                                <img src="<?php echo $img; ?>" class="align-self-start mr-3" alt="<?php echo get_the_title(); ?>">
                                <div class="media-body">
                                    <h5 class="mt-0"><?php the_title(); ?></h5>
                                    <div class="test-star-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
/* GET OB_CACHE CONTENT */
$content = ob_get_clean();
/* RETURN SHORTCODE */
return $content;
