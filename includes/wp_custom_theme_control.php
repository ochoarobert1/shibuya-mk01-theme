<?php
/* --------------------------------------------------------------
CUSTOM AREA FOR OPTIONS DATA - SANTIAGO DUARTE
-------------------------------------------------------------- */

add_action( 'customize_register', 'shibuya_customize_register' );

function shibuya_customize_register( $wp_customize ) {
    
    $wp_customize->add_section('sy_giftcard_section', array(
        'title'    => __('Gift Cards Settings', 'shibuya'),
        'description' => '',
        'priority' => 125,
    ));

    $wp_customize->add_setting('sy_giftcard_section[giftcard_link]', array(
        'default'        => ' ',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'     => 'edit_theme_options',
        'type'           => 'option'
    ));

    $wp_customize->add_control('giftcard_link', array(
        'label'      => __('Link to Gift Card', 'shibuya'),
        'section'    => 'sy_giftcard_section',
        'settings'   => 'sy_giftcard_section[giftcard_link]',
    ));

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

/* --------------------------------------------------------------
CUSTOM CONTROL PANEL
-------------------------------------------------------------- */

function register_shibuya_settings() {
    register_setting( 'shibuya-settings-group', 'monday_start' );
    register_setting( 'shibuya-settings-group', 'monday_end' );
    register_setting( 'shibuya-settings-group', 'monday_all' );

    register_setting( 'shibuya-settings-group', 'tuesday_start' );
    register_setting( 'shibuya-settings-group', 'tuesday_end' );
    register_setting( 'shibuya-settings-group', 'tuesday_all' );

    register_setting( 'shibuya-settings-group', 'wednesday_start' );
    register_setting( 'shibuya-settings-group', 'wednesday_end' );
    register_setting( 'shibuya-settings-group', 'wednesday_all' );

    register_setting( 'shibuya-settings-group', 'thursday_start' );
    register_setting( 'shibuya-settings-group', 'thursday_end' );
    register_setting( 'shibuya-settings-group', 'thursday_all' );

    register_setting( 'shibuya-settings-group', 'friday_start' );
    register_setting( 'shibuya-settings-group', 'friday_end' );
    register_setting( 'shibuya-settings-group', 'friday_all' );

    register_setting( 'shibuya-settings-group', 'saturday_start' );
    register_setting( 'shibuya-settings-group', 'saturday_end' );
    register_setting( 'shibuya-settings-group', 'saturday_all' );

    register_setting( 'shibuya-settings-group', 'sunday_start' );
    register_setting( 'shibuya-settings-group', 'sunday_end' );
    register_setting( 'shibuya-settings-group', 'sunday_all' );
}

add_action('admin_menu', 'shibuya_custom_panel_control');

function shibuya_custom_panel_control() {
    add_menu_page(
        __( 'Control Panel', 'textdomain' ),
        __( 'Control Panel','textdomain' ),
        'manage_options',
        'shibuya-control-panel',
        'shibuya_control_panel_callback',
        'none',
        0
    );
    add_action( 'admin_init', 'register_shibuya_settings' );
}

function shibuya_control_panel_callback() {
    ob_start();
?>
<div class="shibuya-admin-header-container">
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white.png" alt="Shibuya" />
    <h1><?php _e('Control Panel', 'shibuya') ?></h1>
</div>
<form method="post" action="options.php" class="shibuya-admin-content-container">
    <?php settings_fields( 'shibuya-settings-group' ); ?>
    <?php do_settings_sections( 'shibuya-settings-group' ); ?>
    <div class="shibuya-admin-content-title">
        <h2><?php _e('Closing hours', 'shibuya'); ?></h2>
        <small><?php _e('Time between hours where the store will be receiving orders or not.', 'shibuya'); ?></small>
    </div>
    <br>
    <div class="shibuya-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Monday', 'shibuya'); ?></th>
                <td>
                    <label for="monday_start">Starting Hour: <input type="time" name="monday_start" value="<?php echo esc_attr( get_option('monday_start') ); ?>"></label>
                    <label for="monday_end">Ending Hour: <input type="time" name="monday_end" value="<?php echo esc_attr( get_option('monday_end') ); ?>"></label>
                    <label for="monday_all">All Day: <input type="checkbox" name="monday_all" value="1" <?php checked( get_option('monday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="shibuya-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Tuesday', 'shibuya'); ?></th>
                <td>
                    <label for="tuesday_start">Starting Hour: <input type="time" name="tuesday_start" value="<?php echo esc_attr( get_option('tuesday_start') ); ?>"></label>
                    <label for="tuesday_end">Ending Hour: <input type="time" name="tuesday_end" value="<?php echo esc_attr( get_option('tuesday_end') ); ?>"></label>
                    <label for="tuesday_all">All Day: <input type="checkbox" name="tuesday_all" value="1" <?php checked( get_option('tuesday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="shibuya-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Wednesday', 'shibuya'); ?></th>
                <td>
                    <label for="wednesday_start">Starting Hour: <input type="time" name="wednesday_start" value="<?php echo esc_attr( get_option('wednesday_start') ); ?>"></label>
                    <label for="wednesday_end">Ending Hour: <input type="time" name="wednesday_end" value="<?php echo esc_attr( get_option('wednesday_end') ); ?>"></label>
                    <label for="wednesday_all">All Day: <input type="checkbox" name="wednesday_all" value="1" <?php checked( get_option('wednesday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="shibuya-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Thursday', 'shibuya'); ?></th>
                <td>
                    <label for="thursday_start">Starting Hour: <input type="time" name="thursday_start" value="<?php echo esc_attr( get_option('thursday_start') ); ?>"></label>
                    <label for="thursday_end">Ending Hour: <input type="time" name="thursday_end" value="<?php echo esc_attr( get_option('thursday_end') ); ?>"></label>
                    <label for="thursday_all">All Day: <input type="checkbox" name="thursday_all" value="1" <?php checked( get_option('thursday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="shibuya-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Friday', 'shibuya'); ?></th>
                <td>
                    <label for="friday_start">Starting Hour: <input type="time" name="friday_start" value="<?php echo esc_attr( get_option('friday_start') ); ?>"></label>
                    <label for="friday_end">Ending Hour: <input type="time" name="friday_end" value="<?php echo esc_attr( get_option('friday_end') ); ?>"></label>
                    <label for="friday_all">All Day: <input type="checkbox" name="friday_all" value="1" <?php checked( get_option('friday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="shibuya-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Saturday', 'shibuya'); ?></th>
                <td>
                    <label for="saturday_start">Starting Hour: <input type="time" name="saturday_start" value="<?php echo esc_attr( get_option('saturday_start') ); ?>"></label>
                    <label for="saturday_end">Ending Hour: <input type="time" name="saturday_end" value="<?php echo esc_attr( get_option('saturday_end') ); ?>"></label>
                    <label for="saturday_all">All Day: <input type="checkbox" name="saturday_all" value="1" <?php checked( get_option('saturday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="shibuya-admin-content-item">
        <table class="form-table">
            <tr valign="center">
                <th scope="row"><?php _e('Sunday', 'shibuya'); ?></th>
                <td>
                    <label for="sunday_start">Starting Hour: <input type="time" name="sunday_start" value="<?php echo esc_attr( get_option('sunday_start') ); ?>"></label>
                    <label for="sunday_end">Ending Hour: <input type="time" name="sunday_end" value="<?php echo esc_attr( get_option('sunday_end') ); ?>"></label>
                    <label for="sunday_all">All Day: <input type="checkbox" name="sunday_all" value="1" <?php checked( get_option('sunday_all'), 1 ); ?>></label>
                </td>
            </tr>
        </table>
    </div>
    <div class="shibuya-admin-content-submit">
        <?php submit_button(); ?>
    </div>
</form>
<?php 
    $content = ob_get_clean();
    echo $content;
}



