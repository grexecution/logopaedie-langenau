<?php
/**
 * Job Funnel Functionality
 *
 * Multi-step form with WordPress database storage and admin interface
 *
 * @package Logopaedie_Langenau
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create database table on theme activation
 */
function jobfunnel_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'jobfunnel_submissions';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        session_id varchar(64) NOT NULL,
        step_completed int(11) NOT NULL DEFAULT 0,
        step1_answer varchar(255) DEFAULT NULL,
        step1_timestamp datetime DEFAULT NULL,
        step2_answer varchar(255) DEFAULT NULL,
        step2_timestamp datetime DEFAULT NULL,
        step3_answer varchar(255) DEFAULT NULL,
        step3_timestamp datetime DEFAULT NULL,
        step4_reaction varchar(255) DEFAULT NULL,
        step4_timestamp datetime DEFAULT NULL,
        step5_role varchar(100) DEFAULT NULL,
        step5_timestamp datetime DEFAULT NULL,
        step6_reaction varchar(255) DEFAULT NULL,
        step6_timestamp datetime DEFAULT NULL,
        contact_name varchar(255) DEFAULT NULL,
        contact_email varchar(255) DEFAULT NULL,
        contact_phone varchar(100) DEFAULT NULL,
        contact_message text DEFAULT NULL,
        send_job_posting varchar(10) DEFAULT NULL,
        contact_timestamp datetime DEFAULT NULL,
        ip_address varchar(45) DEFAULT NULL,
        user_agent text DEFAULT NULL,
        referrer varchar(500) DEFAULT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        status varchar(50) DEFAULT 'in_progress',
        PRIMARY KEY (id),
        KEY session_id (session_id),
        KEY step_completed (step_completed),
        KEY status (status),
        KEY created_at (created_at)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Store version for future upgrades
    update_option('jobfunnel_db_version', '1.0.1');
}
add_action('after_switch_theme', 'jobfunnel_create_table');

// Also run on init to ensure table exists
function jobfunnel_maybe_create_table() {
    if (get_option('jobfunnel_db_version') !== '1.0.1') {
        jobfunnel_create_table();
    }
}
add_action('init', 'jobfunnel_maybe_create_table');

/**
 * Register Admin Menu
 */
function jobfunnel_admin_menu() {
    add_menu_page(
        'Jobfunnel',
        'Jobfunnel',
        'edit_posts',
        'jobfunnel',
        'jobfunnel_admin_page',
        'dashicons-filter',
        30
    );

    add_submenu_page(
        'jobfunnel',
        'Alle Einträge',
        'Alle Einträge',
        'edit_posts',
        'jobfunnel',
        'jobfunnel_admin_page'
    );

    add_submenu_page(
        'jobfunnel',
        'Statistiken',
        'Statistiken',
        'edit_posts',
        'jobfunnel-stats',
        'jobfunnel_stats_page'
    );
}
add_action('admin_menu', 'jobfunnel_admin_menu');

/**
 * Admin page - All submissions
 */
function jobfunnel_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'jobfunnel_submissions';

    // Handle deletion
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        if (wp_verify_nonce($_GET['_wpnonce'], 'delete_submission_' . $_GET['id'])) {
            $wpdb->delete($table_name, array('id' => intval($_GET['id'])));
            echo '<div class="notice notice-success"><p>Eintrag gelöscht.</p></div>';
        }
    }

    // Get submissions with pagination
    $per_page = 20;
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $offset = ($current_page - 1) * $per_page;

    // Filter by status
    $status_filter = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    $where_clause = $status_filter ? $wpdb->prepare(" WHERE status = %s", $status_filter) : "";

    $total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name $where_clause");
    $submissions = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name $where_clause ORDER BY created_at DESC LIMIT %d OFFSET %d",
        $per_page,
        $offset
    ));

    $total_pages = ceil($total_items / $per_page);

    // Answer mappings for display
    $step1_options = array(
        'druck_aerzte' => 'Zu viel Druck durch Ärzte oder Krankenkassen',
        'familie_alltag' => 'Zu viele Baustellen rund um Familie & Alltag',
        'wenig_zeit' => 'Zu wenig Zeit für gute Therapie',
        'muede' => 'Eigentlich mag ich meinen Job – aber ich bin müde'
    );

    $step2_options = array(
        'verstaendnis' => 'Mehr Verständnis, wenn das Leben mal dazwischenkommt',
        'weniger_druck' => 'Weniger Druck, mehr Freiheit',
        'mehr_zeit' => 'Mehr Zeit, um Patient:innen wirklich zu sehen',
        'menschlichkeit' => 'Ein Umfeld, das an Menschlichkeit glaubt'
    );

    $step3_options = array(
        'zeit_fuer_mich' => 'Mehr Zeit für mich selbst',
        'weniger_spagat' => 'Weniger Spagat zwischen Beruf und Familie',
        'flexibilitaet' => 'Mehr Flexibilität (z. B. Homeoffice)',
        'leichte_arbeit' => 'Arbeit, die sich leicht anfühlt'
    );

    $step5_options = array(
        'therapeutisch' => 'In der direkten Arbeit mit Patient:innen',
        'organisatorisch' => 'Im organisatorischen / kreativen Bereich'
    );

    ?>
    <div class="wrap">
        <h1>Jobfunnel - Einträge</h1>

        <div class="tablenav top">
            <div class="alignleft actions">
                <form method="get">
                    <input type="hidden" name="page" value="jobfunnel">
                    <select name="status">
                        <option value="">Alle Status</option>
                        <option value="in_progress" <?php selected($status_filter, 'in_progress'); ?>>In Bearbeitung</option>
                        <option value="completed" <?php selected($status_filter, 'completed'); ?>>Abgeschlossen</option>
                        <option value="dropped" <?php selected($status_filter, 'dropped'); ?>>Abgebrochen</option>
                    </select>
                    <input type="submit" class="button" value="Filtern">
                </form>
            </div>
            <div class="tablenav-pages">
                <span class="displaying-num"><?php echo $total_items; ?> Einträge</span>
                <?php if ($total_pages > 1): ?>
                    <span class="pagination-links">
                        <?php if ($current_page > 1): ?>
                            <a class="prev-page button" href="<?php echo add_query_arg('paged', $current_page - 1); ?>">‹</a>
                        <?php endif; ?>
                        <span class="paging-input"><?php echo $current_page; ?> von <?php echo $total_pages; ?></span>
                        <?php if ($current_page < $total_pages): ?>
                            <a class="next-page button" href="<?php echo add_query_arg('paged', $current_page + 1); ?>">›</a>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th style="width: 120px;">Datum</th>
                    <th style="width: 80px;">Schritt</th>
                    <th>Frage 1</th>
                    <th>Frage 2</th>
                    <th>Frage 3</th>
                    <th>Rolle</th>
                    <th style="width: 150px;">Kontakt</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 80px;">Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($submissions)): ?>
                    <tr>
                        <td colspan="10">Keine Einträge gefunden.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($submissions as $sub): ?>
                        <tr>
                            <td><?php echo esc_html($sub->id); ?></td>
                            <td><?php echo esc_html(date_i18n('d.m.Y H:i', strtotime($sub->created_at))); ?></td>
                            <td>
                                <span class="step-badge step-<?php echo $sub->step_completed; ?>">
                                    <?php echo $sub->step_completed; ?>/6
                                </span>
                            </td>
                            <td title="<?php echo esc_attr($step1_options[$sub->step1_answer] ?? ''); ?>">
                                <?php echo $sub->step1_answer ? esc_html(mb_substr($step1_options[$sub->step1_answer] ?? $sub->step1_answer, 0, 30)) . '...' : '-'; ?>
                            </td>
                            <td title="<?php echo esc_attr($step2_options[$sub->step2_answer] ?? ''); ?>">
                                <?php echo $sub->step2_answer ? esc_html(mb_substr($step2_options[$sub->step2_answer] ?? $sub->step2_answer, 0, 30)) . '...' : '-'; ?>
                            </td>
                            <td title="<?php echo esc_attr($step3_options[$sub->step3_answer] ?? ''); ?>">
                                <?php echo $sub->step3_answer ? esc_html(mb_substr($step3_options[$sub->step3_answer] ?? $sub->step3_answer, 0, 30)) . '...' : '-'; ?>
                            </td>
                            <td>
                                <?php
                                if ($sub->step5_role) {
                                    echo $sub->step5_role === 'therapeutisch' ? '👩‍⚕️ Therapeut' : '📋 Organisation';
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($sub->contact_name): ?>
                                    <strong><?php echo esc_html($sub->contact_name); ?></strong><br>
                                    <small><?php echo esc_html($sub->contact_email); ?></small>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $status_labels = array(
                                    'in_progress' => '<span class="status-badge status-progress">In Bearbeitung</span>',
                                    'completed' => '<span class="status-badge status-completed">Abgeschlossen</span>',
                                    'dropped' => '<span class="status-badge status-dropped">Abgebrochen</span>'
                                );
                                echo $status_labels[$sub->status] ?? $sub->status;
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo admin_url('admin.php?page=jobfunnel&action=view&id=' . $sub->id); ?>" class="button button-small">Details</a>
                                <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=jobfunnel&action=delete&id=' . $sub->id), 'delete_submission_' . $sub->id); ?>" class="button button-small" onclick="return confirm('Wirklich löschen?');">×</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <style>
        .step-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .step-0, .step-1 { background: #fce4ec; color: #c62828; }
        .step-2, .step-3 { background: #fff3e0; color: #ef6c00; }
        .step-4, .step-5 { background: #e3f2fd; color: #1565c0; }
        .step-6 { background: #e8f5e9; color: #2e7d32; }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        .status-progress { background: #fff3e0; color: #ef6c00; }
        .status-completed { background: #e8f5e9; color: #2e7d32; }
        .status-dropped { background: #fce4ec; color: #c62828; }
    </style>
    <?php

    // Detail view
    if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
        $sub = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", intval($_GET['id'])));
        if ($sub) {
            ?>
            <div class="wrap" style="margin-top: 30px; background: #fff; padding: 20px; border: 1px solid #ccd0d4;">
                <h2>Detail-Ansicht #<?php echo $sub->id; ?></h2>

                <table class="form-table">
                    <tr>
                        <th>Session ID</th>
                        <td><code><?php echo esc_html($sub->session_id); ?></code></td>
                    </tr>
                    <tr>
                        <th>Erstellt am</th>
                        <td><?php echo esc_html(date_i18n('d.m.Y H:i:s', strtotime($sub->created_at))); ?></td>
                    </tr>
                    <tr>
                        <th>Letztes Update</th>
                        <td><?php echo esc_html(date_i18n('d.m.Y H:i:s', strtotime($sub->updated_at))); ?></td>
                    </tr>
                    <tr>
                        <th>IP-Adresse</th>
                        <td><?php echo esc_html($sub->ip_address); ?></td>
                    </tr>
                    <tr>
                        <th>Referrer</th>
                        <td><?php echo esc_html($sub->referrer); ?></td>
                    </tr>
                </table>

                <h3>Funnel-Fortschritt</h3>
                <div class="funnel-timeline">
                    <?php
                    $steps = array(
                        1 => array('label' => 'Was belastet dich?', 'answer' => $sub->step1_answer, 'time' => $sub->step1_timestamp, 'options' => $step1_options),
                        2 => array('label' => 'Was wünschst du dir?', 'answer' => $sub->step2_answer, 'time' => $sub->step2_timestamp, 'options' => $step2_options),
                        3 => array('label' => 'Work-Life-Balance', 'answer' => $sub->step3_answer, 'time' => $sub->step3_timestamp, 'options' => $step3_options),
                        4 => array('label' => 'Reaktion auf Praxis-Info', 'answer' => $sub->step4_reaction, 'time' => $sub->step4_timestamp, 'options' => array()),
                        5 => array('label' => 'Rollenwahl', 'answer' => $sub->step5_role, 'time' => $sub->step5_timestamp, 'options' => $step5_options),
                        6 => array('label' => 'Kontaktdaten', 'answer' => $sub->contact_name ? 'Ausgefüllt' : null, 'time' => $sub->contact_timestamp, 'options' => array()),
                    );

                    foreach ($steps as $num => $step): ?>
                        <div class="timeline-step <?php echo $step['answer'] ? 'completed' : ($num <= $sub->step_completed + 1 ? 'current' : 'pending'); ?>">
                            <div class="step-number"><?php echo $num; ?></div>
                            <div class="step-content">
                                <strong><?php echo esc_html($step['label']); ?></strong>
                                <?php if ($step['answer']): ?>
                                    <p><?php echo esc_html($step['options'][$step['answer']] ?? $step['answer']); ?></p>
                                    <small><?php echo $step['time'] ? date_i18n('d.m.Y H:i', strtotime($step['time'])) : ''; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($sub->contact_name): ?>
                <h3>Kontaktdaten</h3>
                <table class="form-table">
                    <tr><th>Name</th><td><?php echo esc_html($sub->contact_name); ?></td></tr>
                    <tr><th>E-Mail</th><td><a href="mailto:<?php echo esc_attr($sub->contact_email); ?>"><?php echo esc_html($sub->contact_email); ?></a></td></tr>
                    <tr><th>Telefon</th><td><a href="tel:<?php echo esc_attr($sub->contact_phone); ?>"><?php echo esc_html($sub->contact_phone); ?></a></td></tr>
                    <tr><th>Nachricht</th><td><?php echo nl2br(esc_html($sub->contact_message)); ?></td></tr>
                    <tr><th>Stellenausschreibung per E-Mail</th><td><strong><?php echo $sub->send_job_posting === 'ja' ? '✓ Ja' : '✗ Nein'; ?></strong></td></tr>
                </table>
                <?php endif; ?>
            </div>

            <style>
                .funnel-timeline {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                    margin: 20px 0;
                }
                .timeline-step {
                    display: flex;
                    align-items: flex-start;
                    gap: 15px;
                    padding: 15px;
                    border-radius: 8px;
                    background: #f9f9f9;
                }
                .timeline-step.completed { background: #e8f5e9; }
                .timeline-step.current { background: #fff3e0; }
                .timeline-step.pending { background: #f5f5f5; opacity: 0.6; }
                .step-number {
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    background: #ccc;
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    flex-shrink: 0;
                }
                .completed .step-number { background: #4caf50; }
                .current .step-number { background: #ff9800; }
                .step-content { flex: 1; }
                .step-content p { margin: 5px 0; }
                .step-content small { color: #666; }
            </style>
            <?php
        }
    }
}

/**
 * Statistics page
 */
function jobfunnel_stats_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'jobfunnel_submissions';

    // Get overall stats
    $total = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    $completed = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'completed'");
    $in_progress = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'in_progress'");

    // Drop-off per step
    $dropoff_stats = array();
    for ($i = 0; $i <= 6; $i++) {
        $count = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE step_completed = %d",
            $i
        ));
        $dropoff_stats[$i] = $count;
    }

    // Get stats by answer for each question
    $step1_stats = $wpdb->get_results("SELECT step1_answer, COUNT(*) as count FROM $table_name WHERE step1_answer IS NOT NULL GROUP BY step1_answer ORDER BY count DESC");
    $step2_stats = $wpdb->get_results("SELECT step2_answer, COUNT(*) as count FROM $table_name WHERE step2_answer IS NOT NULL GROUP BY step2_answer ORDER BY count DESC");
    $step3_stats = $wpdb->get_results("SELECT step3_answer, COUNT(*) as count FROM $table_name WHERE step3_answer IS NOT NULL GROUP BY step3_answer ORDER BY count DESC");
    $step5_stats = $wpdb->get_results("SELECT step5_role, COUNT(*) as count FROM $table_name WHERE step5_role IS NOT NULL GROUP BY step5_role ORDER BY count DESC");

    // Last 30 days
    $last30days = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
    $last7days = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");

    // Answer labels
    $step1_labels = array(
        'druck_aerzte' => 'Druck durch Ärzte/Kassen',
        'familie_alltag' => 'Familie & Alltag',
        'wenig_zeit' => 'Zu wenig Zeit',
        'muede' => 'Müde'
    );
    $step2_labels = array(
        'verstaendnis' => 'Mehr Verständnis',
        'weniger_druck' => 'Weniger Druck',
        'mehr_zeit' => 'Mehr Zeit für Patienten',
        'menschlichkeit' => 'Menschlichkeit'
    );
    $step3_labels = array(
        'zeit_fuer_mich' => 'Zeit für mich',
        'weniger_spagat' => 'Weniger Spagat',
        'flexibilitaet' => 'Flexibilität',
        'leichte_arbeit' => 'Leichte Arbeit'
    );
    $step5_labels = array(
        'therapeutisch' => 'Therapeutisch',
        'organisatorisch' => 'Organisation/Kreativ'
    );

    ?>
    <div class="wrap">
        <h1>Jobfunnel - Statistiken</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $total; ?></div>
                <div class="stat-label">Gesamt Einträge</div>
            </div>
            <div class="stat-card stat-success">
                <div class="stat-number"><?php echo $completed; ?></div>
                <div class="stat-label">Abgeschlossen</div>
            </div>
            <div class="stat-card stat-warning">
                <div class="stat-number"><?php echo $in_progress; ?></div>
                <div class="stat-label">In Bearbeitung</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $total > 0 ? round(($completed / $total) * 100) : 0; ?>%</div>
                <div class="stat-label">Conversion Rate</div>
            </div>
        </div>

        <div class="stats-grid" style="margin-top: 20px;">
            <div class="stat-card stat-small">
                <div class="stat-number"><?php echo $last7days; ?></div>
                <div class="stat-label">Letzte 7 Tage</div>
            </div>
            <div class="stat-card stat-small">
                <div class="stat-number"><?php echo $last30days; ?></div>
                <div class="stat-label">Letzte 30 Tage</div>
            </div>
        </div>

        <h2 style="margin-top: 40px;">Funnel Drop-off Analyse</h2>
        <div class="funnel-chart">
            <?php
            $max = max($dropoff_stats) ?: 1;
            $step_labels = array(
                0 => 'Gestartet',
                1 => 'Frage 1',
                2 => 'Frage 2',
                3 => 'Frage 3',
                4 => 'Praxis-Info',
                5 => 'Rollenwahl',
                6 => 'Kontakt'
            );

            $running_total = $total;
            foreach ($dropoff_stats as $step => $count):
                $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
                $reached = $total;
                for ($i = 0; $i < $step; $i++) {
                    $reached -= $dropoff_stats[$i];
                }
            ?>
                <div class="funnel-bar-container">
                    <div class="funnel-label"><?php echo $step_labels[$step]; ?></div>
                    <div class="funnel-bar-wrapper">
                        <div class="funnel-bar" style="width: <?php echo ($count / $max) * 100; ?>%;">
                            <?php echo $count; ?>
                        </div>
                    </div>
                    <div class="funnel-percentage"><?php echo $percentage; ?>% abgebrochen</div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="stats-columns">
            <div class="stats-column">
                <h3>Frage 1: Was belastet dich?</h3>
                <?php foreach ($step1_stats as $stat): ?>
                    <div class="answer-stat">
                        <span class="answer-label"><?php echo esc_html($step1_labels[$stat->step1_answer] ?? $stat->step1_answer); ?></span>
                        <span class="answer-count"><?php echo $stat->count; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="stats-column">
                <h3>Frage 2: Was wünschst du dir?</h3>
                <?php foreach ($step2_stats as $stat): ?>
                    <div class="answer-stat">
                        <span class="answer-label"><?php echo esc_html($step2_labels[$stat->step2_answer] ?? $stat->step2_answer); ?></span>
                        <span class="answer-count"><?php echo $stat->count; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="stats-column">
                <h3>Frage 3: Work-Life-Balance</h3>
                <?php foreach ($step3_stats as $stat): ?>
                    <div class="answer-stat">
                        <span class="answer-label"><?php echo esc_html($step3_labels[$stat->step3_answer] ?? $stat->step3_answer); ?></span>
                        <span class="answer-count"><?php echo $stat->count; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="stats-column">
                <h3>Rollenwahl</h3>
                <?php foreach ($step5_stats as $stat): ?>
                    <div class="answer-stat">
                        <span class="answer-label"><?php echo esc_html($step5_labels[$stat->step5_role] ?? $stat->step5_role); ?></span>
                        <span class="answer-count"><?php echo $stat->count; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .stat-card {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
        }
        .stat-card.stat-success { border-left: 4px solid #4caf50; }
        .stat-card.stat-warning { border-left: 4px solid #ff9800; }
        .stat-card.stat-small { padding: 15px; }
        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #1d2327;
        }
        .stat-small .stat-number { font-size: 28px; }
        .stat-label {
            font-size: 14px;
            color: #646970;
            margin-top: 5px;
        }

        .funnel-chart {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 8px;
            padding: 20px;
            margin-top: 15px;
        }
        .funnel-bar-container {
            display: grid;
            grid-template-columns: 120px 1fr 120px;
            gap: 15px;
            align-items: center;
            margin-bottom: 10px;
        }
        .funnel-label {
            font-weight: 600;
            text-align: right;
        }
        .funnel-bar-wrapper {
            background: #f0f0f1;
            border-radius: 4px;
            height: 30px;
        }
        .funnel-bar {
            background: linear-gradient(to right, #ff6b4e, #ea590d);
            height: 100%;
            border-radius: 4px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            min-width: 30px;
        }
        .funnel-percentage {
            font-size: 12px;
            color: #646970;
        }

        .stats-columns {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .stats-column {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 8px;
            padding: 20px;
        }
        .stats-column h3 {
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .answer-stat {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f1;
        }
        .answer-count {
            font-weight: 600;
            color: #ff6b4e;
        }
    </style>
    <?php
}

/**
 * AJAX handler for saving funnel steps
 */
function jobfunnel_save_step() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'logopaedie_nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce'));
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'jobfunnel_submissions';

    $session_id = sanitize_text_field($_POST['session_id'] ?? '');
    $step = intval($_POST['step'] ?? 0);
    $answer = sanitize_text_field($_POST['answer'] ?? '');

    if (empty($session_id)) {
        wp_send_json_error(array('message' => 'Missing session ID'));
    }

    // Check if session exists
    $existing = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_name WHERE session_id = %s",
        $session_id
    ));

    $current_time = current_time('mysql');

    if ($existing) {
        // Update existing record
        $update_data = array('updated_at' => $current_time);

        switch ($step) {
            case 1:
                $update_data['step1_answer'] = $answer;
                $update_data['step1_timestamp'] = $current_time;
                $update_data['step_completed'] = max($existing->step_completed, 1);
                break;
            case 2:
                $update_data['step2_answer'] = $answer;
                $update_data['step2_timestamp'] = $current_time;
                $update_data['step_completed'] = max($existing->step_completed, 2);
                break;
            case 3:
                $update_data['step3_answer'] = $answer;
                $update_data['step3_timestamp'] = $current_time;
                $update_data['step_completed'] = max($existing->step_completed, 3);
                break;
            case 4:
                $update_data['step4_reaction'] = $answer;
                $update_data['step4_timestamp'] = $current_time;
                $update_data['step_completed'] = max($existing->step_completed, 4);
                break;
            case 5:
                $update_data['step5_role'] = $answer;
                $update_data['step5_timestamp'] = $current_time;
                $update_data['step_completed'] = max($existing->step_completed, 5);
                break;
            case 6:
                // Contact form
                $update_data['contact_name'] = sanitize_text_field($_POST['name'] ?? '');
                $update_data['contact_email'] = sanitize_email($_POST['email'] ?? '');
                $update_data['contact_phone'] = sanitize_text_field($_POST['phone'] ?? '');
                $update_data['contact_message'] = sanitize_textarea_field($_POST['message'] ?? '');
                $update_data['send_job_posting'] = sanitize_text_field($_POST['send_job_posting'] ?? '');
                $update_data['contact_timestamp'] = $current_time;
                $update_data['step_completed'] = 6;
                $update_data['status'] = 'completed';
                $update_data['step6_reaction'] = $answer;

                // Send notification email
                $wpdb->update($table_name, $update_data, array('id' => $existing->id));
                jobfunnel_send_notification($existing->id);
                $update_data = array(); // Clear to prevent double update
                break;
        }

        if (!empty($update_data)) {
            $wpdb->update($table_name, $update_data, array('id' => $existing->id));
        }
    } else {
        // Create new record
        $insert_data = array(
            'session_id' => $session_id,
            'step_completed' => $step,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'referrer' => $_SERVER['HTTP_REFERER'] ?? '',
            'created_at' => $current_time,
            'updated_at' => $current_time,
            'status' => 'in_progress'
        );

        // Add step-specific data
        if ($step === 1) {
            $insert_data['step1_answer'] = $answer;
            $insert_data['step1_timestamp'] = $current_time;
        }

        $wpdb->insert($table_name, $insert_data);
    }

    // Get reaction message based on answer
    $reactions = jobfunnel_get_reactions($step, $answer);

    wp_send_json_success(array(
        'message' => 'Step saved',
        'reactions' => $reactions
    ));
}
add_action('wp_ajax_jobfunnel_save_step', 'jobfunnel_save_step');
add_action('wp_ajax_nopriv_jobfunnel_save_step', 'jobfunnel_save_step');

/**
 * Get reaction messages for answers
 */
function jobfunnel_get_reactions($step, $answer) {
    $reactions = array(
        1 => array(
            'druck_aerzte' => 'Das kennen wir gut – man will\'s allen recht machen und bleibt selbst irgendwo dazwischen.',
            'familie_alltag' => 'Dieser Druck macht vieles kaputt, was eigentlich Freude machen sollte.',
            'wenig_zeit' => 'So vielen geht\'s gerade ähnlich – und niemand redet offen darüber.',
            'muede' => 'Manchmal braucht\'s einfach ein anderes Umfeld, damit man wieder Luft bekommt.'
        ),
        2 => array(
            'verstaendnis' => 'Das wünschen sich viele – und es ist völlig berechtigt.',
            'weniger_druck' => 'Genau das versuchen wir bei uns anders zu leben – mit Struktur, aber ohne Druck.',
            'mehr_zeit' => 'Klingt, als wüsstest du ziemlich genau, was dir wichtig ist. Das ist ein guter Anfang.',
            'menschlichkeit' => 'Bei uns kann jede selbst entscheiden, wie viel sie arbeiten möchte – von 25 % bis 100 %, je nach Lebensphase und Energie.'
        ),
        3 => array(
            'zeit_fuer_mich' => 'Ja, das beschreibt\'s ziemlich gut – dieser Spagat kostet Kraft.',
            'weniger_spagat' => 'Flexibilität klingt banal, ist aber Gold wert, wenn man Verantwortung trägt.',
            'flexibilitaet' => 'Flexibilität klingt banal, ist aber Gold wert, wenn man Verantwortung trägt.',
            'leichte_arbeit' => 'Genau das wünsche ich mir – nicht mehr dauernd das Gefühl zu haben, hinterherzulaufen.'
        )
    );

    return $reactions[$step][$answer] ?? '';
}

/**
 * Send notification email on completion
 */
function jobfunnel_send_notification($submission_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'jobfunnel_submissions';

    $sub = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $submission_id));

    if (!$sub || !$sub->contact_email) {
        return;
    }

    $admin_email = get_option('admin_email');
    $subject = 'Neue Jobfunnel Bewerbung: ' . $sub->contact_name;

    $message = "Neue Bewerbung über den Jobfunnel:\n\n";
    $message .= "Name: " . $sub->contact_name . "\n";
    $message .= "E-Mail: " . $sub->contact_email . "\n";
    $message .= "Telefon: " . $sub->contact_phone . "\n\n";
    $message .= "Nachricht:\n" . $sub->contact_message . "\n\n";
    $message .= "Gewählte Rolle: " . ($sub->step5_role === 'therapeutisch' ? 'Therapeutische Arbeit' : 'Organisation/Kreativ') . "\n";
    $message .= "Stellenausschreibung per E-Mail: " . ($sub->send_job_posting === 'ja' ? 'Ja' : 'Nein') . "\n\n";
    $message .= "Details ansehen: " . admin_url('admin.php?page=jobfunnel&action=view&id=' . $sub->id);

    wp_mail($admin_email, $subject, $message);
}

/**
 * Mark abandoned sessions as dropped (run via cron)
 */
function jobfunnel_mark_abandoned() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'jobfunnel_submissions';

    // Mark as dropped if in_progress and no update in 24 hours
    $wpdb->query(
        "UPDATE $table_name
         SET status = 'dropped'
         WHERE status = 'in_progress'
         AND updated_at < DATE_SUB(NOW(), INTERVAL 24 HOUR)"
    );
}

// Schedule cron job
if (!wp_next_scheduled('jobfunnel_cleanup_cron')) {
    wp_schedule_event(time(), 'daily', 'jobfunnel_cleanup_cron');
}
add_action('jobfunnel_cleanup_cron', 'jobfunnel_mark_abandoned');
