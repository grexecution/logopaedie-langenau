<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<div class="page-content">
    <div class="container container-narrow">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Seite nicht gefunden', 'logopaedie-langenau'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('Es sieht so aus, als ob an dieser Stelle nichts gefunden wurde. Vielleicht hilft Ihnen die Suche weiter.', 'logopaedie-langenau'); ?></p>

                <?php get_search_form(); ?>

                <div class="error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <?php esc_html_e('Zur Startseite', 'logopaedie-langenau'); ?>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();
