<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

/* GET ATTS FOR SHORTCODE  */
$text_alignment = $atts['text_alignment'];
ob_start();
/* SHORTCODE STRUCTURE  */
?>
<div class="custom-title-section col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 <?php echo $text_alignment; ?>">
    <h2><?php echo $content; ?></h2>
</div>
<?php
/* GET OB_CACHE CONTENT */
$content = ob_get_clean();
/* RETURN SHORTCODE */
return $content;
