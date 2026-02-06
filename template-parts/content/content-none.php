<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Logopaedie_Langenau
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nichts gefunden', 'logopaedie-langenau'); ?></h1>
    </header>

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :

            printf(
                '<p>' . wp_kses(
                    __('Bereit, Ihren ersten Beitrag zu veröffentlichen? <a href="%1$s">Hier starten</a>.', 'logopaedie-langenau'),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url(admin_url('post-new.php'))
            );

        elseif (is_search()) :
        ?>

            <p><?php esc_html_e('Es wurden keine Ergebnisse für Ihre Suche gefunden. Versuchen Sie es mit anderen Suchbegriffen.', 'logopaedie-langenau'); ?></p>
            <?php
            get_search_form();

        else :
        ?>

            <p><?php esc_html_e('Es scheint, dass wir nicht finden können, wonach Sie suchen. Vielleicht hilft Ihnen die Suche weiter.', 'logopaedie-langenau'); ?></p>
            <?php
            get_search_form();

        endif;
        ?>
    </div>
</section>
