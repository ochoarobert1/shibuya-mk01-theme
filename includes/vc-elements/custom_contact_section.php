<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_contact_section_map() {
    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Sección de Contacto', 'shibuya' ),
        'base'                    => 'vc_custom_contact_section',
        'category'                => __( 'Elementos [shibuya]', 'shibuya' ),
        'description'             => __( 'Agrega una Locaciones del Restaurante.', 'shibuya' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'attach_image',
                'class' => '',
                'admin_label' => false,
                'heading' => __('Fondo de Sección', 'shibuya'),
                'param_name' => 'image',
                'value' => '',
                'description' => __('Agregar la imagen que describa este bloque', 'shibuya')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Título', 'shibuya'),
                'param_name' => 'content',
                'value' => '',
                'description' => __('Agregar el texto del título', 'shibuya')
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Subtitulo', 'shibuya'),
                'param_name' => 'subtitle',
                'value' => '',
                'description' => __('Agregar el texto del título', 'shibuya')
            ),
        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_contact_section_map');
