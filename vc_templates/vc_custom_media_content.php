<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}


ob_start();
/* SHORTCODE STRUCTURE  */
?>

<div class="custom_boxed-element custom-media">
    <?php $image = wp_get_attachment_image_src( $atts['image'], 'avatar', false ); ?>
    <img src="<?php echo $image[0]; ?>" class="align-self-center mr-3" alt="<?php echo $atts['title']; ?>">
    <div class="media-body">
        <h5 class="mt-0"><?php echo $atts['title']; ?></h5>
        <?php echo $content; ?>
    </div>
</div>
<?php
/* GET OB_CACHE CONTENT */
$content = ob_get_clean();
/* RETURN SHORTCODE */
return $content;
