<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

if (isset($atts['image'])) {
    $bg_hero = wp_get_attachment_image_src($atts['image'], 'full', false);
}

ob_start();

/* SHORTCODE STRUCTURE  */
?>
<div class="custom-contact-section col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="background: url(<?php echo $bg_hero[0]; ?>);">
    <div class="row no-gutters">
        <div class="custom-contact-content col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row justify-content-center">
                <div class="custom-contact-form-content col-xl-8 col-lg-8 col-md-11 col-sm-12 col-12">
                    <h2><?php echo $content; ?></h2>
                    <h4><?php echo $atts['subtitle']; ?></h4>
                    <?php get_template_part('templates/contact-form'); ?>
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
