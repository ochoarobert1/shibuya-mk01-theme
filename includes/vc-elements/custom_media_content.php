<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_media_content_map() {
    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Contenido con Imagen', 'pahoy' ),
        'base'                    => 'vc_custom_media_content',
        'category'                => __( 'Elementos [PaHoy]', 'pahoy' ),
        'description'             => __( 'Agrega una barra con las categorias de productos en cuadrados.', 'pahoy' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'attach_image',
                'class' => '',
                'admin_label' => false,
                'heading' => __('Imagen', 'pahoy'),
                'param_name' => 'image',
                'value' => '',
                'description' => __('Agregar la imagen que describa este bloque', 'pahoy')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Título', 'pahoy'),
                'param_name' => 'title',
                'value' => '',
                'description' => __('Agregar el texto del título', 'pahoy')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Contenido', 'pahoy'),
                'param_name' => 'content',
                'value' => '',
                'description' => __('Agregar el texto del contenido', 'pahoy')
            )
        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_media_content_map');
