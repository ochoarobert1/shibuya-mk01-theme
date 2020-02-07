<?php

// Register Custom Post Type
function shibuya_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Locations', 'Post Type General Name', 'shibuya' ),
		'singular_name'         => _x( 'Location', 'Post Type Singular Name', 'shibuya' ),
		'menu_name'             => __( 'Locations', 'shibuya' ),
		'name_admin_bar'        => __( 'Locations', 'shibuya' ),
		'archives'              => __( 'Location Archives', 'shibuya' ),
		'attributes'            => __( 'Location Attributes', 'shibuya' ),
		'parent_item_colon'     => __( 'Parent Location:', 'shibuya' ),
		'all_items'             => __( 'All Locations', 'shibuya' ),
		'add_new_item'          => __( 'Add New Location', 'shibuya' ),
		'add_new'               => __( 'Add New', 'shibuya' ),
		'new_item'              => __( 'New Location', 'shibuya' ),
		'edit_item'             => __( 'Edit Location', 'shibuya' ),
		'update_item'           => __( 'Update Location', 'shibuya' ),
		'view_item'             => __( 'View Location', 'shibuya' ),
		'view_items'            => __( 'View Locations', 'shibuya' ),
		'search_items'          => __( 'Search Location', 'shibuya' ),
		'not_found'             => __( 'Not found', 'shibuya' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'shibuya' ),
		'featured_image'        => __( 'Featured Image', 'shibuya' ),
		'set_featured_image'    => __( 'Set featured image', 'shibuya' ),
		'remove_featured_image' => __( 'Remove featured image', 'shibuya' ),
		'use_featured_image'    => __( 'Use as featured image', 'shibuya' ),
		'insert_into_item'      => __( 'Insert into Location', 'shibuya' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Location', 'shibuya' ),
		'items_list'            => __( 'Locations list', 'shibuya' ),
		'items_list_navigation' => __( 'Locations list navigation', 'shibuya' ),
		'filter_items_list'     => __( 'Filter Locations list', 'shibuya' ),
	);
	$args = array(
		'label'                 => __( 'Location', 'shibuya' ),
		'description'           => __( 'Locations Available', 'shibuya' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-location',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'locations', $args );

}
add_action( 'init', 'shibuya_custom_post_type', 0 );