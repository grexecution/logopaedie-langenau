<?php
/**
 * Logopädie Langenau Theme Functions
 *
 * @package Logopaedie_Langenau
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define theme constants
 */
define('LOGOPAEDIE_THEME_VERSION', '1.0.0');
define('LOGOPAEDIE_THEME_DIR', get_template_directory());
define('LOGOPAEDIE_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function logopaedie_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain('logopaedie-langenau', LOGOPAEDIE_THEME_DIR . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Custom image sizes
    add_image_size('logopaedie-hero', 1920, 1080, true);
    add_image_size('logopaedie-featured', 800, 600, true);
    add_image_size('logopaedie-thumbnail', 400, 300, true);
    add_image_size('logopaedie-og-image', 1200, 630, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'logopaedie-langenau'),
        'footer' => esc_html__('Footer Menu', 'logopaedie-langenau'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 300,
        'flex-width' => true,
        'flex-height' => true,
    ));

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for wide and full alignment
    add_theme_support('align-wide');

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    // Editor color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name' => esc_html__('Primary', 'logopaedie-langenau'),
            'slug' => 'primary',
            'color' => '#ff6b4e',
        ),
        array(
            'name' => esc_html__('Primary Dark', 'logopaedie-langenau'),
            'slug' => 'primary-dark',
            'color' => '#ea590d',
        ),
        array(
            'name' => esc_html__('Dark Blue', 'logopaedie-langenau'),
            'slug' => 'dark-blue',
            'color' => '#002844',
        ),
        array(
            'name' => esc_html__('White', 'logopaedie-langenau'),
            'slug' => 'white',
            'color' => '#ffffff',
        ),
    ));

    // Disable custom colors in block editor
    add_theme_support('disable-custom-colors');

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'logopaedie_theme_setup');

/**
 * Set the content width
 */
function logopaedie_content_width() {
    $GLOBALS['content_width'] = apply_filters('logopaedie_content_width', 1200);
}
add_action('after_setup_theme', 'logopaedie_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function logopaedie_scripts() {
    // Google Fonts - Poppins and PT Sans
    wp_enqueue_style(
        'logopaedie-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=PT+Sans:wght@400;700&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'logopaedie-style',
        get_stylesheet_uri(),
        array(),
        LOGOPAEDIE_THEME_VERSION
    );

    // Additional styles
    wp_enqueue_style(
        'logopaedie-additional',
        LOGOPAEDIE_THEME_URI . '/assets/css/additional.css',
        array('logopaedie-style'),
        LOGOPAEDIE_THEME_VERSION
    );

    // Main JavaScript
    wp_enqueue_script(
        'logopaedie-main',
        LOGOPAEDIE_THEME_URI . '/assets/js/main.js',
        array(),
        LOGOPAEDIE_THEME_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script('logopaedie-main', 'logopaedie_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('logopaedie_nonce'),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'logopaedie_scripts');

/**
 * Register widget areas
 */
function logopaedie_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'logopaedie-langenau'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'logopaedie-langenau'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'logopaedie-langenau'),
        'id' => 'footer-1',
        'description' => esc_html__('First footer widget area.', 'logopaedie-langenau'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'logopaedie-langenau'),
        'id' => 'footer-2',
        'description' => esc_html__('Second footer widget area.', 'logopaedie-langenau'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'logopaedie-langenau'),
        'id' => 'footer-3',
        'description' => esc_html__('Third footer widget area.', 'logopaedie-langenau'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'logopaedie-langenau'),
        'id' => 'footer-4',
        'description' => esc_html__('Fourth footer widget area.', 'logopaedie-langenau'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'logopaedie_widgets_init');

/**
 * Elementor Pro Support
 */
function logopaedie_elementor_support() {
    // Add Elementor support
    add_theme_support('elementor');

    // Add Elementor Pro support
    add_theme_support('elementor-pro');
}
add_action('after_setup_theme', 'logopaedie_elementor_support');

/**
 * Register Elementor locations
 */
function logopaedie_register_elementor_locations($elementor_theme_manager) {
    $elementor_theme_manager->register_all_core_location();
}
add_action('elementor/theme/register_locations', 'logopaedie_register_elementor_locations');

/**
 * Check if Elementor is active
 */
function logopaedie_is_elementor_active() {
    return did_action('elementor/loaded');
}

/**
 * Check if current page is built with Elementor
 */
function logopaedie_is_elementor_page() {
    if (!logopaedie_is_elementor_active()) {
        return false;
    }

    global $post;

    if (!$post) {
        return false;
    }

    return \Elementor\Plugin::$instance->documents->get($post->ID)->is_built_with_elementor();
}

/**
 * Add body classes
 */
function logopaedie_body_classes($classes) {
    // Add class if no sidebar
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Add class for Elementor pages
    if (function_exists('logopaedie_is_elementor_page') && logopaedie_is_elementor_page()) {
        $classes[] = 'elementor-page';
    }

    // Add class for singular pages
    if (is_singular()) {
        $classes[] = 'singular';
    }

    return $classes;
}
add_filter('body_class', 'logopaedie_body_classes');

/**
 * Add preconnect for Google Fonts
 */
function logopaedie_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'logopaedie_resource_hints', 10, 2);

/**
 * Remove WordPress version from scripts and styles
 */
function logopaedie_remove_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'logopaedie_remove_version', 9999);
add_filter('script_loader_src', 'logopaedie_remove_version', 9999);

/**
 * Disable emojis for performance
 */
function logopaedie_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'logopaedie_disable_emojis');

/**
 * Add custom image sizes to media library
 */
function logopaedie_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'logopaedie-hero' => __('Hero Image', 'logopaedie-langenau'),
        'logopaedie-featured' => __('Featured Image', 'logopaedie-langenau'),
        'logopaedie-thumbnail' => __('Thumbnail', 'logopaedie-langenau'),
    ));
}
add_filter('image_size_names_choose', 'logopaedie_custom_image_sizes');

/**
 * Allow SVG uploads
 */
function logopaedie_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'logopaedie_mime_types');

/**
 * Custom login logo
 */
function logopaedie_login_logo() {
    $custom_logo_id = get_theme_mod('custom_logo');

    if ($custom_logo_id) {
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($logo[0]); ?>);
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                width: 100%;
                height: 80px;
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'logopaedie_login_logo');

/**
 * Custom login URL
 */
function logopaedie_login_url() {
    return home_url();
}
add_filter('login_headerurl', 'logopaedie_login_url');

/**
 * Include template functions
 */
require_once LOGOPAEDIE_THEME_DIR . '/inc/template-functions.php';
require_once LOGOPAEDIE_THEME_DIR . '/inc/template-tags.php';

/**
 * Include customizer options
 */
require_once LOGOPAEDIE_THEME_DIR . '/inc/customizer.php';

/**
 * Include Job Funnel functionality
 */
require_once LOGOPAEDIE_THEME_DIR . '/inc/jobfunnel.php';

/**
 * Include SEO functionality
 */
require_once LOGOPAEDIE_THEME_DIR . '/inc/seo.php';

/**
 * Include Bewerbung page meta box
 */
require_once LOGOPAEDIE_THEME_DIR . '/inc/bewerbung-meta.php';

/**
 * Include Analytics & Tracking functionality
 */
require_once LOGOPAEDIE_THEME_DIR . '/inc/tracking.php';

/**
 * Add favicon support
 */
function logopaedie_favicon() {
    $favicon_url = LOGOPAEDIE_THEME_URI . '/assets/images/favicon.png';
    ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url($favicon_url); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url($favicon_url); ?>">
    <?php
}
add_action('wp_head', 'logopaedie_favicon', 1);
