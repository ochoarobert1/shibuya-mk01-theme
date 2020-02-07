<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_title_section_map() {
    /* CALL ALL CATEGORIES */


    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Título con linea Personalizada', 'pahoy' ),
        'base'                    => 'vc_custom_title_section',
        'category'                => __( 'Elementos [PaHoy]', 'pahoy' ),
        'description'             => __( 'Agrega una barra con las categorias de productos en cuadrados.', 'pahoy' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Título', 'pahoy'),
                'param_name' => 'content',
                'value' => '',
                'description' => __('Agregar el texto del título', 'pahoy')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Alineación del Texto', 'pahoy'),
                'description' => __('Seleccione la alineación del texto.', 'pahoy'),
                'param_name' => 'text_alignment',
                'value' => array( 'centro', 'izquierda', 'derecha' )
            )
        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_title_section_map');
