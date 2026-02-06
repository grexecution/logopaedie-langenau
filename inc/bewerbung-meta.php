<?php
/**
 * Bewerbung Page Meta Box
 *
 * Adds a simple meta box to edit JotForm URL on the Bewerbung page
 *
 * @package Logopaedie_Langenau
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register meta box
 */
function logopaedie_bewerbung_meta_box() {
    add_meta_box(
        'bewerbung_settings',
        'Bewerbung Einstellungen',
        'logopaedie_bewerbung_meta_box_html',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'logopaedie_bewerbung_meta_box');

/**
 * Only show meta box on Bewerbung template
 */
function logopaedie_bewerbung_meta_box_html($post) {
    // Check if this page uses the Bewerbung template
    $template = get_page_template_slug($post->ID);
    if ($template !== 'page-bewerbung.php') {
        echo '<p style="color: #666;">Diese Einstellungen sind nur für Seiten mit der Vorlage "Bewerbung" verfügbar.</p>';
        return;
    }

    $jotform_url = get_post_meta($post->ID, '_bewerbung_jotform_url', true);
    $page_subtitle = get_post_meta($post->ID, '_bewerbung_subtitle', true);

    // Defaults
    if (empty($jotform_url)) {
        $jotform_url = 'https://eu.jotform.com/form/253174501663353';
    }
    if (empty($page_subtitle)) {
        $page_subtitle = 'Fülle das Formular aus und wir melden uns bei dir!';
    }

    wp_nonce_field('bewerbung_meta_box', 'bewerbung_meta_box_nonce');
    ?>
    <table class="form-table">
        <tr>
            <th><label for="bewerbung_jotform_url">JotForm URL</label></th>
            <td>
                <input type="url" id="bewerbung_jotform_url" name="bewerbung_jotform_url"
                       value="<?php echo esc_attr($jotform_url); ?>"
                       class="large-text"
                       placeholder="https://eu.jotform.com/form/123456789">
                <p class="description">Die vollständige URL zum JotForm Formular</p>
            </td>
        </tr>
        <tr>
            <th><label for="bewerbung_subtitle">Untertitel</label></th>
            <td>
                <input type="text" id="bewerbung_subtitle" name="bewerbung_subtitle"
                       value="<?php echo esc_attr($page_subtitle); ?>"
                       class="large-text">
                <p class="description">Der Text unter der Überschrift</p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save meta box data
 */
function logopaedie_save_bewerbung_meta($post_id) {
    // Security checks
    if (!isset($_POST['bewerbung_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['bewerbung_meta_box_nonce'], 'bewerbung_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save JotForm URL
    if (isset($_POST['bewerbung_jotform_url'])) {
        update_post_meta($post_id, '_bewerbung_jotform_url', esc_url_raw($_POST['bewerbung_jotform_url']));
    }

    // Save subtitle
    if (isset($_POST['bewerbung_subtitle'])) {
        update_post_meta($post_id, '_bewerbung_subtitle', sanitize_text_field($_POST['bewerbung_subtitle']));
    }
}
add_action('save_post', 'logopaedie_save_bewerbung_meta');
