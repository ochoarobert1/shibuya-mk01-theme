<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}


ob_start();
/* SHORTCODE STRUCTURE  */
?>

<div class="custom-maps-section col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="row no-gutters">
        <?php $args = array('post_type' => 'locations', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'); ?>
        <?php $array_locations = new WP_Query($args); ?>
        <div class="custom-map-item col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <?php $i = 1; ?>
            <?php if ($array_locations->have_posts()) : ?>
            <?php while ($array_locations->have_posts()) : $array_locations->the_post(); ?>
            <?php if ($i == 1) { ?>
            <div class="embed-responsive embed-responsive-1by1">
                <?php echo get_post_meta(get_the_ID(), 'sby_maps_embed', true); ?>
            </div>
            <?php } ?>
            <?php $i++; endwhile; ?>
            <?php endif; ?>

        </div>
        <div class="custom-map-info col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="custom-map-info-title">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logotrazoblanco.png" alt="logo" class="img-fluid" />
                <?php echo $content; ?>
            </div>
            <div class="row">
                <?php if ($array_locations->have_posts()) : ?>
                <?php while ($array_locations->have_posts()) : $array_locations->the_post(); ?>
                <div class="custom-map-info-item col-6">
                    <h3><?php the_title(); ?></h3>
                    <div class="custom-map-info-item-meta">
                        <i class="fa fa-map-marker"></i> <strong><span><?php echo get_post_meta(get_the_ID(), 'sby_address', true); ?></span></strong>
                    </div>
                    <div class="custom-map-info-item-meta">
                        <i class="fa fa-phone"></i> <span><?php echo get_post_meta(get_the_ID(), 'sby_phone', true); ?></span>
                    </div>
                    <div class="custom-map-info-item-meta">
                        <i class="fa fa-envelope-o"></i> <span><?php echo get_post_meta(get_the_ID(), 'sby_email', true); ?></span>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="custom-map-item col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <?php $i = 1; ?>
            <?php if ($array_locations->have_posts()) : ?>
            <?php while ($array_locations->have_posts()) : $array_locations->the_post(); ?>
            <?php if ($i > 1) { ?>
            <div class="embed-responsive embed-responsive-1by1">
                <?php echo get_post_meta(get_the_ID(), 'sby_maps_embed', true); ?>
            </div>
            <?php } ?>
            <?php if ($i > 2) { break; } ?>
            <?php $i++; endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>

    </div>

</div>
<?php
/* GET OB_CACHE CONTENT */
$content = ob_get_clean();
/* RETURN SHORTCODE */
return $content;
