<?php
/**
 * Template Name: Fragebogen
 *
 * Job application funnel page
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

    <!-- Job Funnel Section -->
    <section class="jobfunnel-section" id="fragebogen">
        <div class="container">
            <div class="funnel-header">
                <h1 class="funnel-main-title">Ein Kurzer Dialog – zum gegenseitigen Kennenlernen</h1>
            </div>
            <div class="funnel-wrapper">
                <!-- Progress Bar -->
                <div class="funnel-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%;"></div>
                    </div>
                    <div class="progress-steps">
                        <span class="progress-step active" data-step="1">1</span>
                        <span class="progress-step" data-step="2">2</span>
                        <span class="progress-step" data-step="3">3</span>
                        <span class="progress-step" data-step="4">4</span>
                        <span class="progress-step" data-step="5">5</span>
                    </div>
                </div>

                <!-- Step 1: Ein Kurzer Dialog -->
                <div class="funnel-step active" data-step="1">
                    <div class="funnel-card">
                        <h2>Wie fühlt sich dein Arbeitsalltag im Moment eher an?</h2>
                        <div class="funnel-options">
                            <label class="funnel-option">
                                <input type="radio" name="step1" value="leeres_blatt">
                                <span class="option-content">
                                    <span class="option-icon">📄</span>
                                    <span class="option-text">Wie ein leeres Blatt – ich starte gerade rein.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step1" value="guter_text">
                                <span class="option-content">
                                    <span class="option-icon">📖</span>
                                    <span class="option-text">Wie ein guter Text, der noch Kapitel vertragen könnte.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step1" value="weiterschreiben">
                                <span class="option-content">
                                    <span class="option-icon">📚</span>
                                    <span class="option-text">Wie ein Buch, das ich weiterschreiben würde – nur anderswo.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step1" value="notizen">
                                <span class="option-content">
                                    <span class="option-icon">📝</span>
                                    <span class="option-text">Wie eine Sammlung von Notizen – ich sortiere mich noch.</span>
                                </span>
                            </label>
                        </div>
                        <div class="funnel-reaction" style="display: none;"></div>
                        <div class="funnel-buttons">
                            <button type="button" class="btn btn-white funnel-next" disabled>Weiter</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Was bringt dich zum Aufblühen? -->
                <div class="funnel-step" data-step="2">
                    <div class="funnel-card">
                        <h2>Was bringt dich im Arbeitsalltag eher zum Aufblühen als zum Rotieren?</h2>
                        <div class="funnel-options">
                            <label class="funnel-option">
                                <input type="radio" name="step2" value="struktur">
                                <span class="option-content">
                                    <span class="option-icon">📐</span>
                                    <span class="option-text">Struktur, die trägt – nicht fesselt.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step2" value="team">
                                <span class="option-content">
                                    <span class="option-icon">💬</span>
                                    <span class="option-text">Ein Team, das echt miteinander spricht.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step2" value="impulse">
                                <span class="option-content">
                                    <span class="option-icon">⚡</span>
                                    <span class="option-text">Fachliche Impulse, die mich kitzeln.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step2" value="ruhe">
                                <span class="option-content">
                                    <span class="option-icon">⏸️</span>
                                    <span class="option-text">Ruhe zum Arbeiten – kein Dauerstress.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step2" value="abwechslung">
                                <span class="option-content">
                                    <span class="option-icon">🎨</span>
                                    <span class="option-text">Abwechslung, damit's lebendig bleibt.</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step2" value="entwicklung">
                                <span class="option-content">
                                    <span class="option-icon">⬆️</span>
                                    <span class="option-text">Sichtbare Entwicklung – nicht nur Versprechen.</span>
                                </span>
                            </label>
                        </div>
                        <div class="funnel-reaction" style="display: none;"></div>
                        <div class="funnel-buttons">
                            <button type="button" class="btn btn-outline-white funnel-back">Zurück</button>
                            <button type="button" class="btn btn-white funnel-next" disabled>Weiter</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Work-Life-Balance -->
                <div class="funnel-step" data-step="3">
                    <div class="funnel-card">
                        <h2>Was brauchst du im Alltag, damit Beruf und Leben gut zusammenpassen?</h2>
                        <div class="funnel-options">
                            <label class="funnel-option">
                                <input type="radio" name="step3" value="zeit_fuer_mich">
                                <span class="option-content">
                                    <span class="option-icon">🧘</span>
                                    <span class="option-text">Mehr Zeit für mich selbst</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step3" value="weniger_hinher">
                                <span class="option-content">
                                    <span class="option-icon">⚖️</span>
                                    <span class="option-text">Weniger Hin-und-her zwischen Arbeit und Alltag</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step3" value="flexibilitaet">
                                <span class="option-content">
                                    <span class="option-icon">💻</span>
                                    <span class="option-text">Mehr Flexibilität (z. B. Homeoffice für Orga-Aufgaben)</span>
                                </span>
                            </label>
                            <label class="funnel-option">
                                <input type="radio" name="step3" value="leichte_arbeit">
                                <span class="option-content">
                                    <span class="option-icon">🌿</span>
                                    <span class="option-text">Eine Arbeit, die sich leicht anfühlt – nicht wie ein Dauerlauf</span>
                                </span>
                            </label>
                        </div>
                        <div class="funnel-reaction" style="display: none;"></div>
                        <div class="funnel-buttons">
                            <button type="button" class="btn btn-outline-white funnel-back">Zurück</button>
                            <button type="button" class="btn btn-white funnel-next" disabled>Wie wir damit umgehen</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3b: Transition -->
                <div class="funnel-step" data-step="3b">
                    <div class="funnel-card funnel-card-transition">
                        <p class="transition-text">Danke dir. Und jetzt zeigen wir dir, wie wir das in unserer Praxis leben.</p>
                        <div class="funnel-buttons">
                            <button type="button" class="btn btn-outline-white funnel-back">Zurück</button>
                            <button type="button" class="btn btn-white funnel-next">👉 Unsere Haltung ansehen</button>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Praxis Haltung -->
                <div class="funnel-step" data-step="4">
                    <div class="funnel-card funnel-card-info">
                        <h2>Unsere Haltung</h2>
                        <div class="info-content">
                            <p>Wir glauben, dass gute Arbeit nur möglich ist, wenn das Leben daneben auch Platz hat. Deshalb denken wir flexibel – bei Terminen, Stundenmodellen und Organisation. Ziel ist eine gute Work-Life-Balance.</p>
                            <p>Es ist völlig normal, wenn private Verpflichtungen mal Vorrang haben. Und ja, bestimmte Aufgaben (z. B. Organisation, Dokumentation oder Social Media) gehen bei uns auch im Homeoffice (technische Ausstattung inklusive: Laptop + ISDN-Anschluss, auch privat nutzbar, mit optionaler Übernahme privater Nummern.)</p>
                            <p class="highlight">Wenn du dich nach einem Alltag sehnst, der sich menschlich und machbar anfühlt – dann findest du sicherlich deinen Platz bei uns.</p>
                        </div>
                        <div class="funnel-buttons">
                            <button type="button" class="btn btn-outline-white funnel-back">Zurück</button>
                            <button type="button" class="btn btn-white funnel-next">Ja, das klingt nach mir</button>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Contact -->
                <div class="funnel-step" data-step="5">
                    <div class="funnel-card">
                        <h2>Lass uns kennenlernen!</h2>
                        <p class="funnel-intro">Du bist fast da. Hinterlasse uns deine Kontaktdaten und wir melden uns bei dir – ganz unverbindlich.</p>
                        <form class="funnel-contact-form" id="funnel-contact-form">
                            <div class="form-group">
                                <label for="funnel-name">Dein Name *</label>
                                <input type="text" id="funnel-name" name="name" required placeholder="Vor- und Nachname">
                            </div>
                            <div class="form-group">
                                <label for="funnel-email">E-Mail *</label>
                                <input type="email" id="funnel-email" name="email" required placeholder="deine@email.de">
                            </div>
                            <div class="form-group">
                                <label for="funnel-phone">Telefon (optional)</label>
                                <input type="tel" id="funnel-phone" name="phone" placeholder="0123 456789">
                            </div>
                            <div class="form-group">
                                <label for="funnel-message">Möchtest du uns noch etwas mitteilen?</label>
                                <textarea id="funnel-message" name="message" rows="4" placeholder="Optional: Erzähl uns kurz von dir..."></textarea>
                            </div>
                            <div class="form-group">
                                <label style="margin-bottom: 12px; display: block;">Schickt mir die vollständige Stellenausschreibung per E-Mail <span style="color: var(--color-primary);">*</span></label>
                                <div style="display: flex; gap: 24px;">
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="radio" name="send_job_posting" value="ja" required style="width: 18px; height: 18px; cursor: pointer;">
                                        <span>Ja</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <input type="radio" name="send_job_posting" value="nein" required style="width: 18px; height: 18px; cursor: pointer;">
                                        <span>Nein</span>
                                    </label>
                                </div>
                            </div>
                            <div class="funnel-buttons">
                                <button type="button" class="btn btn-outline-white funnel-back">Zurück</button>
                                <button type="submit" class="btn btn-white">Absenden</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Step 6: Thank You -->
                <div class="funnel-step" data-step="6">
                    <div class="funnel-card funnel-card-success">
                        <div class="success-icon">✓</div>
                        <h2>Vielen Dank!</h2>
                        <p>Wir haben deine Nachricht erhalten und melden uns in Kürze bei dir.</p>
                        <p>Wir freuen uns darauf, dich kennenzulernen!</p>
                        <div class="funnel-buttons">
                            <a href="<?php echo esc_url(home_url('/jobausschreibung/')); ?>" class="btn btn-white">Zur vollständigen Stellenanzeige</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
