
<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>
         " class="btn btn-md btn-floating"><?php _e('Order Now!', 'shibuya'); ?></a>

<a class="btn btn-md btn-opentable"><?php _e('Make a Reservation', 'shibuya'); ?></a>

<div class="opentable-container opentable-container-hidden">
    <?php $opentable = get_option('sy_opentable_settings'); ?>
    <?php echo $opentable['custom_js']; ?>
    <div class="btn-opentable-close"><i class="fa fa-chevron-up"></i></div>
</div>

<footer class="container-fluid p-0" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
    <div class="row no-gutters">
        <div class="the-footer col-12">
            <div class="container">
                <div class="row">
                    <div class="footer-logo col-12">
                        <a href="<?php echo home_url('/'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.png" alt="Logo" class="img-fluid img-logo" />
                        </a>
                    </div>
                    <div class="footer-menu col-12">
                        <?php
                        wp_nav_menu( array(
                            'container_class' => 'menu-footer',
                            'theme_location' => 'footer_menu',
                            'items_wrap'     => '<ul class="custom-nav">%3$s</ul>'
                        ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-social col-12">
            <?php $social_options = get_option('sy_social_settings'); ?>
            <?php if (isset($social_options['facebook'])) { ?>
            <?php if ($social_options['facebook'] != '' ) { ?>
            <a href="<?php echo esc_url($social_options['facebook']);?>" title="<?php _e('Visita nuestro Perfil en Facebook', 'shibuya'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            <?php } ?>
            <?php } ?>

            <?php if (isset($social_options['twitter'])) { ?>
            <?php if ($social_options['twitter'] != '') { ?>
            <a href="<?php echo esc_url($social_options['twitter']);?>" title="<?php _e('Visita nuestro Perfil en Twitter', 'shibuya'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <?php } ?>
            <?php } ?>

            <?php if (isset($social_options['instagram'])) { ?>
            <?php if ($social_options['instagram'] != '') { ?>
            <a href="<?php echo esc_url($social_options['instagram']);?>" title="<?php _e('Visita nuestro Perfil en Instagram', 'shibuya'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
            <?php } ?>
            <?php } ?>

            <?php if (isset($social_options['youtube'])) { ?>
            <?php if ($social_options['youtube'] != '') { ?>
            <a href="<?php echo esc_url($social_options['youtube']);?>" title="<?php _e('Visita nuestro Canal en YouTube', 'shibuya'); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a>
            <?php } ?>
            <?php } ?>

            <?php if (isset($social_options['linkedin'])) { ?>
            <?php if ($social_options['linkedin'] != '') { ?>
            <a href="<?php echo esc_url($social_options['linkedin']);?>" title="<?php _e('Visita nuestro Perfil en LinkedIn', 'shibuya'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            <?php } ?>
            <?php } ?>

            <?php if (isset($social_options['yelp'])) { ?>
            <?php if ($social_options['yelp'] != '') { ?>
            <a href="<?php echo esc_url($social_options['yelp']);?>" title="<?php _e('Visita nuestro Perfil en Yelp', 'shibuya'); ?>" target="_blank"><i class="fa fa-yelp"></i></a>
            <?php } ?>
            <?php } ?>
            <div class="go-top">
                <a href="#top" title="<?php _e('Go to top', 'shibuya'); ?>"><i class="fa fa-chevron-up"></i></a>
            </div>
        </div>
        <div class="footer-copy col-12">
            <h5><strong>2020 &copy; <?php _e('all rights reserved for', 'shibuya'); ?></strong> Shibuya Sushi Bar <strong><?php _e('Developed by', 'shibuya'); ?></strong> Cadestudio</h5>
        </div>
    </div>
</footer>
<div class="modal custom-modal fade" id="productModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<?php wp_footer() ?>
</body>

</html>
