<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_locations_section_map() {
    /* CALL ALL CATEGORIES */
    $locations_array = array();
    $locations = new WP_Query(array('post_type' => 'locations', 'posts_per_page' => -1));

    if ($locations->have_posts()) :
    while ($locations->have_posts()) : $locations->the_post();
    $locations_array[get_the_title()] = get_the_ID();
    endwhile;
    endif;
    wp_reset_query();

    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Locaciones del Restaurante', 'pahoy' ),
        'base'                    => 'vc_custom_locations_section',
        'category'                => __( 'Elementos [PaHoy]', 'pahoy' ),
        'description'             => __( 'Agrega una Locaciones del Restaurante.', 'pahoy' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'checkbox',
                'heading' => __('Locaciones', 'pahoy'),
                'description' => __('Selecciona las categorias que quieres mostrar en este elemento', 'pahoy'),
                'param_name' => 'locations_selection',
                'admin_label' => true,
                'value' => $locations_array,
                'std' => ' ',
            ),
               array(
                'type' => 'dropdown',
                'class' => '',
                'admin_label' => true,
                'heading' => __('Color de Linea', 'pahoy'),
                'description' => __('Seleccione el Color de Linea del texto.', 'pahoy'),
                'param_name' => 'color_line',
                'value' => array( 'orange', 'white' )
            )
        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_locations_section_map');
