<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_boxed_content_map() {
    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Contenido en Box', 'shibuya' ),
        'base'                    => 'vc_custom_boxed_content',
        'category'                => __( 'Elementos [shibuya]', 'shibuya' ),
        'description'             => __( 'Agrega una barra con las categorias de productos en cuadrados.', 'shibuya' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'checkbox',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Contenido a la izquierda?', 'shibuya'),
                'param_name' => 'invert',
                'value' => '',
                'description' => __('Agregar el texto del contenido', 'shibuya')
            ),
            array(
                'type' => 'attach_image',
                'class' => '',
                'admin_label' => false,
                'heading' => __('Imagen', 'shibuya'),
                'param_name' => 'image',
                'value' => '',
                'description' => __('Agregar la imagen que describa este bloque', 'shibuya')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Título', 'shibuya'),
                'param_name' => 'title',
                'value' => '',
                'description' => __('Agregar el texto del título', 'shibuya')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Contenido', 'shibuya'),
                'param_name' => 'content',
                'value' => '',
                'description' => __('Agregar el texto del contenido', 'shibuya')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('3era Linea', 'shibuya'),
                'param_name' => 'third',
                'value' => '',
                'description' => __('Agregar el texto del contenido', 'shibuya')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Texto del Boton', 'shibuya'),
                'param_name' => 'button_text',
                'value' => '',
                'description' => __('Agregar el texto del contenido', 'shibuya')
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Color del Boton', 'shibuya'),
                'param_name' => 'button_color',
                'value' => '',
                'description' => __('Agregar el texto del contenido', 'shibuya')
            ),
            array(
                'type' => 'vc_link',
                'class' => '',
                'admin_label' => true,
                'heading' => __('URL del Boton', 'shibuya'),
                'param_name' => 'button_link',
                'value' => '',
                'description' => __('Agregar el texto del contenido', 'shibuya')
            )

        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_boxed_content_map');
