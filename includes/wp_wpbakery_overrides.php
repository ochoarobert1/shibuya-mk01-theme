<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/* --------------------------------------------------------------
/* DEPENDENCIES AND MAPPING
-------------------------------------------------------------- */
function vc_shibuya_map_dependencies() {
    if ( ! defined( 'WPB_VC_VERSION' ) ) {
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/js_composer" target="_blank">WPBakery Page Builder</a></strong> plugin to be installed and activated on your site.', 'vc_extend'),  'shibuya').'</p>
        </div>';
    }
}

add_action( 'admin_notices', 'vc_shibuya_map_dependencies' );

/* MAPPING TEMPLATES */
function vc_shibuya_setup() {
    $dir = get_template_directory() . '/vc_templates';
    vc_set_shortcodes_templates_dir( $dir );
}

add_action( 'vc_before_init', 'vc_shibuya_setup' );

/* --------------------------------------------------------------
/* CALL FILE DEPENDENCIES (CSS / JS / AJAX HANDLER)
-------------------------------------------------------------- */
function vc_shibuya_frontend_scripts_caller() {
    $version_remove = NULL;
    

    wp_enqueue_script( 'vc-shibuya-frontend-script', get_template_directory_uri() . '/js/vc-shibuya-frontend-scripts.js', array( 'jquery'), false, false );

    wp_localize_script( 'vc-shibuya-frontend-script', 'shibuya_vc_admin_url', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}

add_action('wp_enqueue_scripts', 'vc_shibuya_frontend_scripts_caller', 99);

/* --------------------------------------------------------------
/* CUSTOM WPBAKERY FUNCTIONS
-------------------------------------------------------------- */
require_once('vc-elements/custom_product_categories.php');
require_once('vc-elements/custom_title_section.php');
require_once('vc-elements/custom_media_content.php');
require_once('vc-elements/custom_taxonomy_boxes.php');
require_once('vc-elements/custom_testimonials_section.php');
require_once('vc-elements/custom_boxed_content.php');
require_once('vc-elements/custom_double_title.php');
require_once('vc-elements/custom_locations_section.php');
require_once('vc-elements/custom_maps_section.php');
require_once('vc-elements/custom_contact_section.php');

function custom_vc_additional_params() {
    $attributes = array(
        'type' => 'dropdown',
        'heading' => __('Estilo del Texto', 'shibuya'),
        'description' => __('Seleccione el estilo que mejor se comporte con la zona', 'shibuya'),
        'param_name' => 'text_style',
        'value' => array( ' ' , 'claro', 'oscuro' )

    );
    vc_add_param( 'vc_column_text', $attributes ); // Note: 'vc_message' was used as a base for "Message box" element
}

add_action('vc_after_init', 'custom_vc_additional_params');
