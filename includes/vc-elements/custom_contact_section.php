<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_contact_section_map() {
    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Sección de Contacto', 'pahoy' ),
        'base'                    => 'vc_custom_contact_section',
        'category'                => __( 'Elementos [PaHoy]', 'pahoy' ),
        'description'             => __( 'Agrega una Locaciones del Restaurante.', 'pahoy' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'attach_image',
                'class' => '',
                'admin_label' => false,
                'heading' => __('Fondo de Sección', 'pahoy'),
                'param_name' => 'image',
                'value' => '',
                'description' => __('Agregar la imagen que describa este bloque', 'pahoy')
            ),
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
                'type' => 'textfield',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Subtitulo', 'pahoy'),
                'param_name' => 'subtitle',
                'value' => '',
                'description' => __('Agregar el texto del título', 'pahoy')
            ),
        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_contact_section_map');
