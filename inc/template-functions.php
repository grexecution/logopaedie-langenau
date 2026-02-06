<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Logopaedie_Langenau
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function logopaedie_body_classes_additional($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'logopaedie_body_classes_additional');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function logopaedie_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'logopaedie_pingback_header');

/**
 * Change the excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int
 */
function logopaedie_excerpt_length($length) {
    if (is_admin()) {
        return $length;
    }
    return 30;
}
add_filter('excerpt_length', 'logopaedie_excerpt_length');

/**
 * Change the excerpt more text.
 *
 * @param string $more The current excerpt more text.
 * @return string
 */
function logopaedie_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    return '&hellip;';
}
add_filter('excerpt_more', 'logopaedie_excerpt_more');

/**
 * Get the page ID by slug.
 *
 * @param string $slug The page slug.
 * @return int|null
 */
function logopaedie_get_page_id_by_slug($slug) {
    $page = get_page_by_path($slug);
    if ($page) {
        return $page->ID;
    }
    return null;
}

/**
 * Add async/defer attributes to scripts.
 *
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function logopaedie_script_loader_tag($tag, $handle) {
    $async_scripts = array('logopaedie-main');

    if (in_array($handle, $async_scripts, true)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'logopaedie_script_loader_tag', 10, 2);

/**
 * Clean up the_excerpt()
 */
function logopaedie_excerpt_clean($text) {
    $raw_excerpt = $text;
    if ('' === $text) {
        $text = get_the_content('');
        $text = strip_shortcodes($text);
        $text = excerpt_remove_blocks($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
    }
    return $text;
}

/**
 * Custom archive title format.
 *
 * @param string $title Archive title.
 * @return string
 */
function logopaedie_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_year()) {
        $title = get_the_date(_x('Y', 'yearly archives date format', 'logopaedie-langenau'));
    } elseif (is_month()) {
        $title = get_the_date(_x('F Y', 'monthly archives date format', 'logopaedie-langenau'));
    } elseif (is_day()) {
        $title = get_the_date(_x('F j, Y', 'daily archives date format', 'logopaedie-langenau'));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}
add_filter('get_the_archive_title', 'logopaedie_archive_title');
