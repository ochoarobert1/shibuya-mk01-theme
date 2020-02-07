<?php
/* PREVENTS DIRECT ACCESS */
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Silence is Golden' );
}

function custom_product_categories_map() {
    /* CALL ALL CATEGORIES */
    $categories_array = array();
    $categories = get_categories(array('taxonomy' => 'product_cat', 'hide_empty' => false));
    foreach( $categories as $category ) {
        $categories_array[$category->name] = $category->term_id;
    }

    /* PREPARE SETTINGS FOR VC_MAP */
    $settings = array(
        'name'                    => __( 'Categorias de Productos Personalizado', 'pahoy' ),
        'base'                    => 'vc_custom_product_categories',
        'category'                => __( 'Elementos [PaHoy]', 'pahoy' ),
        'description'             => __( 'Agrega una barra con las categorias de productos en cuadrados.', 'pahoy' ),
        'show_settings_on_create' => true,
        'weight'                  => -5,
        'params'                  => array(
            array(
                'type' => 'checkbox',
                'heading' => __('Categoría / Categorias', 'pahoy'),
                'description' => __('Selecciona las categorias que quieres mostrar en este elemento', 'pahoy'),
                'param_name' => 'category_selection',
                'admin_label' => true,
                'value' => $categories_array,
                'std' => ' ',
            )
        )
    );

    /* ADD NEW ELEMENT TO VC_MAP */
    vc_map( $settings );

}

add_action('vc_after_init', 'custom_product_categories_map');
