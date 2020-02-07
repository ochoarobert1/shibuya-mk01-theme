<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

/* GET ATTS FOR SHORTCODE  */
$location_id = $atts['locations_selection'];

if (isset($atts['color_line'])) { $line_color = 'white-line'; } else { $line_color = ''; }

$location_post = get_post($location_id);

ob_start();
/* SHORTCODE STRUCTURE  */
?>
<div class="custom-locations-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="row">
        <div class="custom-location-logo col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.png" alt="Logo" class="img-fluid" />
        </div>
        <div class="custom-location-title col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 <?php echo $line_color; ?>">
            <div class="custom-title-section">
                <h2><?php echo $location_post->post_title; ?></h2>
            </div>
        </div>
        <div class="custom-location-address col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <i class="fa fa-map-marker"></i>
            <?php echo get_post_meta($location_id, 'sby_address', true); ?>
        </div>
        <div class="custom-location-open-hours col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h4><?php _e('Open Hours', 'shibuya'); ?></h4>
            <?php echo apply_filters('the_content', get_post_meta($location_id, 'sby_open_hours', true)); ?>
        </div>
        <div class="custom-location-buttons col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a href="<?php echo get_post_meta($location_id, 'sby_maps', true); ?>" class="btn btn-sm btn-location"><?php _e('Google Maps', 'shibuya'); ?></a>
            <a href="" class="btn btn-sm btn-location"><?php _e('Order Now', 'shibuya'); ?></a>
        </div>
        <div class="custom-location-additional col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <?php echo apply_filters('the_content', get_post_meta($location_id, 'sby_additional_info', true)); ?>
        </div>

    </div>

</div>

<?php
/* GET OB_CACHE CONTENT */
$content = ob_get_clean();
/* RETURN SHORTCODE */
return $content;
