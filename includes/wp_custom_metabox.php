<?php
function be_metabox_show_on_slug( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'], $meta_box['show_on']['value'] ) ) {
        return $display;
    }

    if ( 'slug' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return $display;
    }

    $slug = get_post( $post_id )->post_name;

    // See if there's a match
    return in_array( $slug, (array) $meta_box['show_on']['value']);
}

add_filter( 'cmb2_show_on', 'be_metabox_show_on_slug', 10, 2 );


function ed_metabox_include_front_page( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'] ) ) {
        return $display;
    }

    if ( 'front-page' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return false;
    }

    // Get ID of page set as front page, 0 if there isn't one
    $front_page = get_option( 'page_on_front' );

    // there is a front page set and we're on it!
    return $post_id == $front_page;
}
add_filter( 'cmb2_show_on', 'ed_metabox_include_front_page', 10, 2 );

add_action( 'cmb2_admin_init', 'shibuya_register_custom_metabox' );
function shibuya_register_custom_metabox() {
    $prefix = 'sby_';

    $cmb_page_metabox = new_cmb2_box( array(
        'id'            => $prefix . 'page_metabox',
        'title'         => esc_html__( 'Page - Extra Info', 'shibuya' ),
        'object_types'  => array( 'page' ), // Post type
        // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
        // 'context'    => 'normal',
        // 'priority'   => 'high',
        // 'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // true to keep the metabox closed by default
        // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
        // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
    ) );

    $cmb_page_metabox->add_field( array(
        'id'   => $prefix . 'page_banner',
        'name' => __( 'Banner Image', 'shibuya' ),
        'desc' => __( 'Descriptive image for this page', 'shibuya' ),
        'type' => 'file',
        'preview_size' => array( 200, 200 ),
        'query_args' => array( 'type' => 'image' )
    ) );

    $cmb_locations_metabox = new_cmb2_box( array(
        'id'            => $prefix . 'locations_metabox',
        'title'         => esc_html__( 'Locations - Extra Info', 'shibuya' ),
        'object_types'  => array( 'locations' ), // Post type
        // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
        // 'context'    => 'normal',
        // 'priority'   => 'high',
        // 'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // true to keep the metabox closed by default
        // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
        // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Address', 'cmb2' ),
        'desc'       => esc_html__( 'Enter an Address to this location', 'shibuya' ),
        'id'         => $prefix . 'address',
        'type'       => 'text'
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Phone', 'cmb2' ),
        'desc'       => esc_html__( 'Enter a Phone to this location', 'shibuya' ),
        'id'         => $prefix . 'phone',
        'type'       => 'text'
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Email', 'cmb2' ),
        'desc'       => esc_html__( 'Enter an Email to this location', 'shibuya' ),
        'id'         => $prefix . 'email',
        'type'       => 'text_email'
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Open Hours', 'cmb2' ),
        'desc'       => esc_html__( 'Enter Open Hours of this location', 'shibuya' ),
        'id'         => $prefix . 'open_hours',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => get_option('default_post_edit_rows', 4),
            'teeny' => false
        )
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Google Maps Code', 'cmb2' ),
        'desc'       => esc_html__( 'Enter Google Maps URL', 'shibuya' ),
        'id'         => $prefix . 'maps',
        'type'       => 'text'
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Google Maps Embed Code', 'cmb2' ),
        'desc'       => esc_html__( 'Enter Google Maps Embed', 'shibuya' ),
        'id'         => $prefix . 'maps_embed',
        'type'       => 'textarea_code'
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Additional Info', 'cmb2' ),
        'desc'       => esc_html__( 'Enter Additional Info of this location', 'shibuya' ),
        'id'         => $prefix . 'additional_info',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => get_option('default_post_edit_rows', 4),
            'teeny' => false
        )
    ) );

    $cmb_locations_metabox->add_field( array(
        'name'       => esc_html__( 'Stripe Endpoint', 'cmb2' ),
        'desc'       => esc_html__( 'Enter Stripe endpoint for this location', 'shibuya' ),
        'id'         => $prefix . 'stripe_endpoint',
        'type'       => 'text'
    ) );
}
