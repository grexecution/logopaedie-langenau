<?php
/**
 * Template Name: Blank Canvas
 * Template Post Type: page
 *
 * A blank template for use with Elementor full-width designs.
 *
 * @package Logopaedie_Langenau
 */

get_header();

while (have_posts()) :
    the_post();
    the_content();
endwhile;

get_footer();
