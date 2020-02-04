<?php

function portafolio() {

    $labels = array(
        'name'                  => _x( 'Portafolios', 'Post Type General Name', 'shibuya' ),
        'singular_name'         => _x( 'Portafolio', 'Post Type Singular Name', 'shibuya' ),
        'menu_name'             => __( 'Portafolio', 'shibuya' ),
        'name_admin_bar'        => __( 'Portafolio', 'shibuya' ),
        'archives'              => __( 'Archivo de Portafolio', 'shibuya' ),
        'attributes'            => __( 'Atributos de Portafolio', 'shibuya' ),
        'parent_item_colon'     => __( 'Portafolio Padre:', 'shibuya' ),
        'all_items'             => __( 'Todos los Items', 'shibuya' ),
        'add_new_item'          => __( 'Agregar Nuevo Item', 'shibuya' ),
        'add_new'               => __( 'Agregar Nuevo', 'shibuya' ),
        'new_item'              => __( 'Nuevo Item', 'shibuya' ),
        'edit_item'             => __( 'Editar Item', 'shibuya' ),
        'update_item'           => __( 'Actualizar Item', 'shibuya' ),
        'view_item'             => __( 'Ver Item', 'shibuya' ),
        'view_items'            => __( 'Ver Portafolio', 'shibuya' ),
        'search_items'          => __( 'Buscar en Portafolio', 'shibuya' ),
        'not_found'             => __( 'No hay Resultados', 'shibuya' ),
        'not_found_in_trash'    => __( 'No hay Resultados en la Papelera', 'shibuya' ),
        'featured_image'        => __( 'Imagen Destacada', 'shibuya' ),
        'set_featured_image'    => __( 'Colocar Imagen Destacada', 'shibuya' ),
        'remove_featured_image' => __( 'Remover Imagen Destacada', 'shibuya' ),
        'use_featured_image'    => __( 'Usar como Imagen Destacada', 'shibuya' ),
        'insert_into_item'      => __( 'Insertar dentro de Item', 'shibuya' ),
        'uploaded_to_this_item' => __( 'Cargado a este item', 'shibuya' ),
        'items_list'            => __( 'Listado del Portafolio', 'shibuya' ),
        'items_list_navigation' => __( 'Navegación de Listado del Portafolio', 'shibuya' ),
        'filter_items_list'     => __( 'Filtro de Listado del Portafolio', 'shibuya' ),
    );
    $args = array(
        'label'                 => __( 'Portafolio', 'shibuya' ),
        'description'           => __( 'Portafolio de Desarrollos', 'shibuya' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'trackbacks', 'custom-fields', ),
        'taxonomies'            => array( 'custom_portafolio' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-testimonial',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'portafolio', $args );

}
add_action( 'init', 'portafolio', 0 );
