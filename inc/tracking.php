<?php
/**
 * Analytics & Tracking Integration
 *
 * Adds Google Analytics and Hotjar support via Customizer settings.
 *
 * @package Logopaedie_Langenau
 * @since 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Customizer settings for tracking
 */
function logopaedie_tracking_customizer($wp_customize) {
    // Tracking Section
    $wp_customize->add_section(
        'logopaedie_tracking',
        array(
            'title'    => __('Analytics & Tracking', 'logopaedie-langenau'),
            'priority' => 160,
        )
    );

    // Google Analytics Measurement ID (GA4)
    $wp_customize->add_setting(
        'logopaedie_ga_id',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'logopaedie_ga_id',
        array(
            'label'       => __('Google Analytics Measurement ID', 'logopaedie-langenau'),
            'description' => __('Enter your GA4 Measurement ID (e.g., G-XXXXXXXXXX)', 'logopaedie-langenau'),
            'section'     => 'logopaedie_tracking',
            'type'        => 'text',
        )
    );

    // Hotjar Site ID
    $wp_customize->add_setting(
        'logopaedie_hotjar_id',
        array(
            'default'           => '',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'logopaedie_hotjar_id',
        array(
            'label'       => __('Hotjar Site ID', 'logopaedie-langenau'),
            'description' => __('Enter your Hotjar Site ID (numbers only)', 'logopaedie-langenau'),
            'section'     => 'logopaedie_tracking',
            'type'        => 'number',
        )
    );
}
add_action('customize_register', 'logopaedie_tracking_customizer');

/**
 * Output Google Analytics script
 */
function logopaedie_google_analytics() {
    $ga_id = get_theme_mod('logopaedie_ga_id', '');

    if (empty($ga_id)) {
        return;
    }

    // Don't track admin users or in admin area
    if (is_admin() || current_user_can('manage_options')) {
        return;
    }
    ?>
    <!-- Google Analytics (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_js($ga_id); ?>');
    </script>
    <?php
}
add_action('wp_head', 'logopaedie_google_analytics', 1);

/**
 * Output Hotjar script
 */
function logopaedie_hotjar() {
    $hotjar_id = get_theme_mod('logopaedie_hotjar_id', '');

    if (empty($hotjar_id)) {
        return;
    }

    // Don't track admin users or in admin area
    if (is_admin() || current_user_can('manage_options')) {
        return;
    }
    ?>
    <!-- Hotjar Tracking Code -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:<?php echo absint($hotjar_id); ?>,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <?php
}
add_action('wp_head', 'logopaedie_hotjar', 2);
