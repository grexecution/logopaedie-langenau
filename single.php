<?php
/**
 * The template for displaying all single posts
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<div class="page-content">
    <div class="container container-narrow">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="entry-title">', '</h1>');
                    else :
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif;
                    ?>

                    <div class="entry-meta">
                        <?php
                        logopaedie_posted_on();
                        logopaedie_posted_by();
                        ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail('logopaedie-featured'); ?>
                </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content(sprintf(
                        wp_kses(
                            __('Weiterlesen<span class="screen-reader-text"> "%s"</span>', 'logopaedie-langenau'),
                            array('span' => array('class' => array()))
                        ),
                        wp_kses_post(get_the_title())
                    ));

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Seiten:', 'logopaedie-langenau'),
                        'after' => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php logopaedie_entry_footer(); ?>
                </footer>
            </article>

            <?php
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Vorheriger:', 'logopaedie-langenau') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Nächster:', 'logopaedie-langenau') . '</span> <span class="nav-title">%title</span>',
            ));

            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</div>

<?php
get_footer();
