<?php
/**
 * Template part for displaying posts
 *
 * @package Logopaedie_Langenau
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('logopaedie-thumbnail'); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="post-content">
        <header class="entry-header">
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;
            ?>

            <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php
                logopaedie_posted_on();
                ?>
            </div>
            <?php endif; ?>
        </header>

        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>

        <footer class="entry-footer">
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e('Weiterlesen', 'logopaedie-langenau'); ?> &rarr;
            </a>
        </footer>
    </div>
</article>
