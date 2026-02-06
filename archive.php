<?php
/**
 * The template for displaying archive pages
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<div class="page-content">
    <div class="container">
        <?php if (have_posts()) : ?>

            <header class="page-header">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header>

            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', get_post_type());
                endwhile;
                ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('&larr; Zurück', 'logopaedie-langenau'),
                'next_text' => __('Weiter &rarr;', 'logopaedie-langenau'),
            ));

        else :

            get_template_part('template-parts/content/content', 'none');

        endif;
        ?>
    </div>
</div>

<?php
get_footer();
