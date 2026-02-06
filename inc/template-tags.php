<?php
/**
 * Custom template tags for this theme
 *
 * @package Logopaedie_Langenau
 */

if (!function_exists('logopaedie_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function logopaedie_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html_x('%s', 'post date', 'logopaedie-langenau'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>';
    }
endif;

if (!function_exists('logopaedie_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function logopaedie_posted_by() {
        $byline = sprintf(
            esc_html_x('von %s', 'post author', 'logopaedie-langenau'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>';
    }
endif;

if (!function_exists('logopaedie_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function logopaedie_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            $categories_list = get_the_category_list(esc_html__(', ', 'logopaedie-langenau'));
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Kategorien: %1$s', 'logopaedie-langenau') . '</span>', $categories_list);
            }

            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'logopaedie-langenau'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tags: %1$s', 'logopaedie-langenau') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        __('Kommentar hinterlassen<span class="screen-reader-text"> zu %s</span>', 'logopaedie-langenau'),
                        array('span' => array('class' => array()))
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    __('Bearbeiten <span class="screen-reader-text">%s</span>', 'logopaedie-langenau'),
                    array('span' => array('class' => array()))
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('logopaedie_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     */
    function logopaedie_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
        ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail('logopaedie-featured'); ?>
            </div>

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'logopaedie-thumbnail',
                    array(
                        'alt' => the_title_attribute(array('echo' => false)),
                    )
                );
                ?>
            </a>

        <?php
        endif;
    }
endif;

if (!function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     */
    function wp_body_open() {
        do_action('wp_body_open');
    }
endif;
