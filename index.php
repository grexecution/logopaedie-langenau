<?php
/**
 * The main template file
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<div class="page-content">
    <div class="container">
        <?php
        if (have_posts()) :

            if (is_home() && !is_front_page()) :
            ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            <?php
            endif;

            echo '<div class="posts-grid">';

            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', get_post_type());
            endwhile;

            echo '</div>';

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
