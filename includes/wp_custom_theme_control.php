<?php
/* --------------------------------------------------------------
CUSTOM AREA FOR OPTIONS DATA - SANTIAGO DUARTE
-------------------------------------------------------------- */

add_action( 'customize_register', 'shibuya_customize_register' );

function shibuya_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'sy_opentable_settings', array(
        'title'    => __( 'Open Table', 'shibuya' ),
        'priority' => 190,
    ) );

    $wp_customize->add_setting( 'sy_opentable_settings[custom_js]', array(
        'type' => 'option',
    ) );

    $wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'custom_html', array(
        'label'     => 'Additional JS',
        'type'      => 'textarea',
        'settings'  => 'sy_opentable_settings[custom_js]',
        'section'   => 'sy_opentable_settings',
    ) ) );

    $wp_customize->add_section('sy_google_section', array(
        'title'    => __('Google Settings', 'shibuya'),
        'description' => '',
        'priority' => 120,
    ));

    $wp_customize->add_setting('sy_google_settings[google_api]', array(
        'default'        => ' ',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));

    $wp_customize->add_setting('sy_google_settings[google_secret]', array(
        'default'        => ' ',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));

    $wp_customize->add_control('sy_google_api', array(
        'label'      => __('API Key', 'shibuya'),
        'section'    => 'sy_google_section',
        'settings'   => 'sy_google_settings[google_api]',
    ));

    $wp_customize->add_control('sy_google_secret', array(
        'label'      => __('API Secret', 'shibuya'),
        'section'    => 'sy_google_section',
        'settings'   => 'sy_google_settings[google_secret]',
    ));

    /* SOCIAL */
    $wp_customize->add_section('sy_social_settings', array(
        'title'    => __('Redes Sociales', 'shibuya'),
        'description' => __('Agregue aqui las redes sociales de la página, serán usadas globalmente', 'shibuya'),
        'priority' => 175,
    ));

    $wp_customize->add_setting('sy_social_settings[facebook]', array(
        'default'           => '',
        'sanitize_callback' => 'shibuya_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'facebook', array(
        'type' => 'url',
        'section' => 'sy_social_settings',
        'settings' => 'sy_social_settings[facebook]',
        'label' => __( 'Facebook', 'shibuya' ),
    ) );

    $wp_customize->add_setting('sy_social_settings[twitter]', array(
        'default'           => '',
        'sanitize_callback' => 'shibuya_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'twitter', array(
        'type' => 'url',
        'section' => 'sy_social_settings',
        'settings' => 'sy_social_settings[twitter]',
        'label' => __( 'Twitter', 'shibuya' ),
    ) );

    $wp_customize->add_setting('sy_social_settings[instagram]', array(
        'default'           => '',
        'sanitize_callback' => 'shibuya_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'instagram', array(
        'type' => 'url',
        'section' => 'sy_social_settings',
        'settings' => 'sy_social_settings[instagram]',
        'label' => __( 'Instagram', 'shibuya' ),
    ) );

    $wp_customize->add_setting('sy_social_settings[linkedin]', array(
        'default'           => '',
        'sanitize_callback' => 'shibuya_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'linkedin', array(
        'type' => 'url',
        'section' => 'sy_social_settings',
        'settings' => 'sy_social_settings[linkedin]',
        'label' => __( 'LinkedIn', 'shibuya' ),
    ) );

    $wp_customize->add_setting('sy_social_settings[youtube]', array(
        'default'           => '',
        'sanitize_callback' => 'shibuya_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'youtube', array(
        'type' => 'url',
        'section' => 'sy_social_settings',
        'settings' => 'sy_social_settings[youtube]',
        'label' => __( 'YouTube', 'shibuya' ),
    ) );

    $wp_customize->add_setting('sy_social_settings[yelp]', array(
        'default'           => '',
        'sanitize_callback' => 'shibuya_sanitize_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'yelp', array(
        'type' => 'url',
        'section' => 'sy_social_settings',
        'settings' => 'sy_social_settings[yelp]',
        'label' => __( 'Yelp', 'shibuya' ),
    ) );


    $wp_customize->add_section('sy_cookie_settings', array(
        'title'    => __('Cookies', 'shibuya'),
        'description' => __('Opciones de Cookies', 'shibuya'),
        'priority' => 176,
    ));

    $wp_customize->add_setting('sy_cookie_settings[cookie_text]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           => 'option'

    ));

    $wp_customize->add_control( 'cookie_text', array(
        'type' => 'textarea',
        'label'    => __('Cookie consent', 'shibuya'),
        'description' => __( 'Texto del Cookie consent.' ),
        'section'  => 'sy_cookie_settings',
        'settings' => 'sy_cookie_settings[cookie_text]'
    ));

    $wp_customize->add_setting('sy_cookie_settings[cookie_link]', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'cookie_link', array(
        'type'     => 'dropdown-pages',
        'section' => 'sy_cookie_settings',
        'settings' => 'sy_cookie_settings[cookie_link]',
        'label' => __( 'Link de Cookies', 'shibuya' ),
    ) );

    /* YOUTUBE */
    $wp_customize->add_section('sy_youtube_settings', array(
        'title'    => __('YouTube', 'shibuya'),
        'description' => __('Opciones de YouTube', 'shibuya'),
        'priority' => 176,
    ));

    $wp_customize->add_setting('sy_youtube_settings[apikey]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
        'type'           => 'option'

    ));

    $wp_customize->add_control( 'apikey', array(
        'type' => 'password',
        'label'    => __('Cookie consent', 'shibuya'),
        'description' => __( 'ApiKey para YouTube API V3.' ),
        'section'  => 'sy_youtube_settings',
        'settings' => 'sy_youtube_settings[apikey]'
    ));

    /* FORMULARIO */
    $wp_customize->add_section('sy_modalform_settings', array(
        'title'    => __('Formulario Modal', 'shibuya'),
        'description' => __('Opciones del formulario', 'shibuya'),
        'priority' => 176,
    ));

    $wp_customize->add_setting('sy_modalform_settings[thanks_link]', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( 'thanks_link', array(
        'type'     => 'dropdown-pages',
        'section' => 'sy_modalform_settings',
        'settings' => 'sy_modalform_settings[thanks_link]',
        'label' => __( 'Link de Agradecimiento', 'shibuya' )
    ) );


}

function shibuya_sanitize_url( $url ) {
    return esc_url_raw( $url );
}
