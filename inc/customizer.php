<?php
/**
 * Theme Customizer
 *
 * @package Logopaedie_Langenau
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function logopaedie_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector' => '.site-title a',
                'render_callback' => 'logopaedie_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector' => '.site-description',
                'render_callback' => 'logopaedie_customize_partial_blogdescription',
            )
        );
    }

    // Theme Colors Section
    $wp_customize->add_section(
        'logopaedie_colors',
        array(
            'title' => __('Theme Colors', 'logopaedie-langenau'),
            'priority' => 30,
        )
    );

    // Primary Color
    $wp_customize->add_setting(
        'logopaedie_primary_color',
        array(
            'default' => '#2D7D9A',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'logopaedie_primary_color',
            array(
                'label' => __('Primary Color', 'logopaedie-langenau'),
                'section' => 'logopaedie_colors',
            )
        )
    );

    // Secondary Color
    $wp_customize->add_setting(
        'logopaedie_secondary_color',
        array(
            'default' => '#7CB342',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'logopaedie_secondary_color',
            array(
                'label' => __('Secondary Color', 'logopaedie-langenau'),
                'section' => 'logopaedie_colors',
            )
        )
    );

    // Contact Information Section
    $wp_customize->add_section(
        'logopaedie_contact',
        array(
            'title' => __('Contact Information', 'logopaedie-langenau'),
            'priority' => 35,
        )
    );

    // Phone Number
    $wp_customize->add_setting(
        'logopaedie_phone',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'logopaedie_phone',
        array(
            'label' => __('Phone Number', 'logopaedie-langenau'),
            'section' => 'logopaedie_contact',
            'type' => 'text',
        )
    );

    // Email Address
    $wp_customize->add_setting(
        'logopaedie_email',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_email',
        )
    );

    $wp_customize->add_control(
        'logopaedie_email',
        array(
            'label' => __('Email Address', 'logopaedie-langenau'),
            'section' => 'logopaedie_contact',
            'type' => 'email',
        )
    );

    // Address
    $wp_customize->add_setting(
        'logopaedie_address',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_control(
        'logopaedie_address',
        array(
            'label' => __('Address', 'logopaedie-langenau'),
            'section' => 'logopaedie_contact',
            'type' => 'textarea',
        )
    );

    // Opening Hours
    $wp_customize->add_setting(
        'logopaedie_hours',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_control(
        'logopaedie_hours',
        array(
            'label' => __('Opening Hours', 'logopaedie-langenau'),
            'section' => 'logopaedie_contact',
            'type' => 'textarea',
        )
    );

}
add_action('customize_register', 'logopaedie_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function logopaedie_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function logopaedie_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function logopaedie_customize_preview_js() {
    wp_enqueue_script(
        'logopaedie-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('customize-preview'),
        LOGOPAEDIE_THEME_VERSION,
        true
    );
}
add_action('customize_preview_init', 'logopaedie_customize_preview_js');

/**
 * Output custom colors CSS.
 */
function logopaedie_customizer_css() {
    $primary_color = get_theme_mod('logopaedie_primary_color', '#2D7D9A');
    $secondary_color = get_theme_mod('logopaedie_secondary_color', '#7CB342');

    // Only output if colors have been changed from defaults
    if ($primary_color !== '#2D7D9A' || $secondary_color !== '#7CB342') {
        ?>
        <style type="text/css">
            :root {
                <?php if ($primary_color !== '#2D7D9A') : ?>
                --color-primary: <?php echo esc_attr($primary_color); ?>;
                <?php endif; ?>
                <?php if ($secondary_color !== '#7CB342') : ?>
                --color-secondary: <?php echo esc_attr($secondary_color); ?>;
                <?php endif; ?>
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'logopaedie_customizer_css');
