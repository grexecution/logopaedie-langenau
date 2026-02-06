<?php
/**
 * The template for displaying search results pages
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<div class="page-content">
    <div class="container">
        <?php if (have_posts()) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__('Suchergebnisse für: %s', 'logopaedie-langenau'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header>

            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', 'search');
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
