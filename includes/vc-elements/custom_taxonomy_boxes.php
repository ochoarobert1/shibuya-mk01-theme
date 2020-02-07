<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_taxonomy_boxes_map() {
    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Taxonomias en Cuadros', 'pahoy' ),
        'base'                    => 'vc_custom_taxonomy_boxes',
        'category'                => __( 'Elementos [PaHoy]', 'pahoy' ),
        'description'             => __( 'Agrega una sección de taxonomias en cuadros rectangulares y cuadrados.', 'pahoy' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Cantidad', 'pahoy'),
                'param_name' => 'quantity',
                'value' => '',
                'description' => __('Agregue la cantidad de elementos a mostrar', 'pahoy')
            ),
            array(
                'type' => 'dropdown',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Tipo de taxonomía', 'pahoy'),
                'description' => __('Seleccione el tipo de taxonomía a agregar.', 'pahoy'),
                'param_name' => 'type_category',
                'value' => array( 'Categorias', 'Categorías de Producto', 'Locaciones' )
            )
        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_taxonomy_boxes_map');
