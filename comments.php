<?php
/**
 * The template for displaying comments
 *
 * @package Logopaedie_Langenau
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    if (have_comments()) :
    ?>
        <h2 class="comments-title">
            <?php
            $logopaedie_comment_count = get_comments_number();
            if ('1' === $logopaedie_comment_count) {
                printf(
                    esc_html__('Ein Kommentar zu &ldquo;%1$s&rdquo;', 'logopaedie-langenau'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx('%1$s Kommentar zu &ldquo;%2$s&rdquo;', '%1$s Kommentare zu &ldquo;%2$s&rdquo;', $logopaedie_comment_count, 'comments title', 'logopaedie-langenau')),
                    number_format_i18n($logopaedie_comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style' => 'ol',
                    'short_ping' => true,
                )
            );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
        ?>
            <p class="no-comments"><?php esc_html_e('Kommentare sind geschlossen.', 'logopaedie-langenau'); ?></p>
        <?php
        endif;

    endif;

    comment_form(
        array(
            'title_reply' => esc_html__('Kommentar hinterlassen', 'logopaedie-langenau'),
            'label_submit' => esc_html__('Kommentar absenden', 'logopaedie-langenau'),
        )
    );
    ?>

</div>
