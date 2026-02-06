<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 *
 * A full-width template without container constraints.
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<?php
while (have_posts()) :
    the_post();

    if (function_exists('logopaedie_is_elementor_page') && logopaedie_is_elementor_page()) :
        the_content();
    else :
    ?>
        <div class="page-content">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header container">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    <?php
    endif;

endwhile;
?>

<?php
get_footer();
