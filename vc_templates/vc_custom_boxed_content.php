<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}


ob_start();
if (isset($atts['invert'])) { $inverted = 'custom-boxed-element-inverted '; } else { $inverted = ''; }
/* SHORTCODE STRUCTURE  */
?>
<div class="custom-boxed-element <?php echo $inverted; ?>">
    <?php $image = wp_get_attachment_image_src( $atts['image'], 'full', false ); ?>
    <img src="<?php echo $image[0]; ?>" class="img-fluid" alt="<?php echo $atts['title']; ?>" />
    <div class="custom-boxed-element-wrapper">
        <h2><?php echo $atts['title']; ?></h2>
        <h3><?php echo $content; ?></h3>
        <h5><?php echo $atts['third']; ?></h5>
        <a href="<?php echo $atts['button_link']; ?>" class="btn btn-sm btn-boxed" style="background-color: <?php echo $atts['button_color']; ?>;"><?php echo $atts['button_text']; ?></a>
    </div>
</div>
<?php
/* GET OB_CACHE CONTENT */
$content = ob_get_clean();
/* RETURN SHORTCODE */
return $content;
