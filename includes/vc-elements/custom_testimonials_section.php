<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_testimonials_section_map() {
    /* CALL ALL CATEGORIES */


    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Slider de Testimonios', 'shibuya' ),
        'base'                    => 'vc_custom_testimonials_section',
        'category'                => __( 'Elementos [shibuya]', 'shibuya' ),
        'description'             => __( 'Agrega una sliders con los Testimonios cargados dentro del sitio.', 'shibuya' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Cantidad', 'shibuya'),
                'param_name' => 'quantity',
                'value' => '',
                'description' => __('Agregar la cantidad de testimonios', 'shibuya')
            ),

        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_testimonials_section_map');
