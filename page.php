<?php
/**
 * The template for displaying all pages
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<?php
while (have_posts()) :
    the_post();

    // Check if this page is built with Elementor
    if (function_exists('logopaedie_is_elementor_page') && logopaedie_is_elementor_page()) :
        the_content();
    else :
    ?>
        <div class="page-content">
            <div class="container">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail('logopaedie-featured'); ?>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Seiten:', 'logopaedie-langenau'),
                            'after' => '</div>',
                        ));
                        ?>
                    </div>
                </article>

                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        </div>
    <?php
    endif;

endwhile;
?>

<?php
get_footer();
