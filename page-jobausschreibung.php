<?php
/**
 * Template Name: Jobausschreibung
 *
 * The job posting page template
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section" id="jobausschreibung">
    <div class="hero-background"></div>
    <div class="hero-content">
        <div class="hero-text">
            <h1>Logopäde/in (m/w/d) gesucht</h1>
            <p>Wir glauben, dass Arbeit sich gut anfühlen darf – strukturiert, menschlich, ehrlich. Werde Teil unseres Teams in Langenau</p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url(home_url('/bewerbung/')); ?>" class="btn btn-secondary btn-lg">
                    Jetzt bewerben
                    <span>👉</span>
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="<?php echo esc_url(LOGOPAEDIE_THEME_URI . '/assets/images/hero-team.png'); ?>" alt="Team bei der Arbeit">
        </div>
    </div>
</section>

<!-- Info Cards Section -->
<section class="info-cards-section">
    <div class="info-cards-grid">
        <!-- Aufgaben Card -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon">📋</div>
                <h3>Was sind die Aufgaben?</h3>
            </div>
            <div class="info-card-list">
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Individuelle logopädische Therapie für alle Altersgruppen</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Diagnostik und Befunderhebung</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Beratung von Patienten und Angehörigen</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Dokumentation und Behandlungsplanung</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Interdisziplinäre Zusammenarbeit</span>
                </div>
            </div>
        </div>

        <!-- Alltag Card -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon">📅</div>
                <h3>Wie sieht der Alltag aus?</h3>
            </div>
            <div class="info-card-list">
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Moderne Praxis mit neuester Ausstattung</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Flexible Arbeitszeiten und Work-Life-Balance</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Überdurchschnittliche Vergütung</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Fortbildungsmöglichkeiten</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Familiäres Team mit flachen Hierarchien</span>
                </div>
            </div>
        </div>

        <!-- Mitbringen Card -->
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon">🎓</div>
                <h3>Was solltest du mitbringen?</h3>
            </div>
            <div class="info-card-list">
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Abgeschlossene Ausbildung als Logopäde/in</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Empathie und Geduld im Umgang mit Patienten</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Teamfähigkeit und Kommunikationsstärke</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Bereitschaft zur Weiterbildung</span>
                </div>
                <div class="info-card-item">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <span>Zuverlässigkeit und Verantwortungsbewusstsein</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="map-grid">
        <!-- Map Image -->
        <div class="map-image-container">
            <img src="<?php echo esc_url(LOGOPAEDIE_THEME_URI . '/assets/images/map-langenau.png'); ?>" alt="Karte von Langenau">
            <div class="map-marker">
                <div class="map-marker-center">
                    <svg width="15" height="20" viewBox="0 0 12 16" fill="currentColor">
                        <path d="M6 0C2.69 0 0 2.69 0 6c0 4.5 6 10 6 10s6-5.5 6-10c0-3.31-2.69-6-6-6zm0 8.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                </div>
                <div class="map-marker-label">
                    <span>Langenau</span>
                </div>
            </div>
        </div>

        <!-- Fahrzeiten Card -->
        <div class="fahrzeiten-card">
            <div class="fahrzeiten-header">
                <h4>Fahrzeiten</h4>
            </div>
            <div class="fahrzeiten-locations">
                <h5>🚙 Mit dem Auto:</h5>
                <ul>
                    <li>• Ulm (15 Min)</li>
                    <li>• Heidenheim (20 Min)</li>
                    <li>• Giengen (12 Min)</li>
                    <li>• Herbrechtingen (18 Min)</li>
                </ul>
            </div>
            <div class="fahrzeiten-locations" style="margin-top: 16px;">
                <h5>🚆 Mit dem Zug:</h5>
                <ul>
                    <li>• Ulm (10 Min)</li>
                    <li>• Heidenheim (20 Min)</li>
                    <li>• Giengen (12 Min)</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- WhatsApp CTA Section -->
<section class="whatsapp-section" id="kontakt">
    <div class="whatsapp-card">
        <div class="whatsapp-header">
            <h2>Lass uns einfach kurz schreiben! <a href="https://wa.me/4973459282283?text=Spannend%20eure%20Jobanzeige.%20Nehmt%20Kontakt%20mit%20mir%20auf." target="_blank" rel="noopener noreferrer" style="display: inline-block; vertical-align: middle; color: inherit;"><svg width="40" height="40" viewBox="0 0 448 512" fill="currentColor" style="margin-bottom: 4px; vertical-align: middle;">
                            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                        </svg></a></h2>
            <p>Wenn du magst, schreib mir direkt auf WhatsApp.</p>
            <p class="subtitle">Ich antworte persönlich – keine Bots, kein Formular-Stress.</p>
        </div>

        <div class="whatsapp-buttons">
            <a href="/fragebogen" rel="noopener" class="btn btn-gradient btn-lg">
                Kurz checken, ob es passt
                <span>👉</span>
            </a>
            <a href="<?php echo esc_url(home_url('/bewerbung/')); ?>" class="btn btn-secondary btn-lg" style="background: white; color: var(--color-primary);">
                Zum Bewerbungsformular
                <span>🖊️</span>
            </a>
        </div>

        <!--<div class="whatsapp-reactions">
            <h3>Mögliche Reaktionen:</h3>
            <div class="whatsapp-reactions-grid">
                <div class="whatsapp-reaction">
                    <div class="whatsapp-reaction-icon">😊</div>
                    <p>Ich freu mich, wenn wir kurz schreiben. Ganz unkompliziert – ohne Bewerbungsmappe.</p>
                </div>
                <div class="whatsapp-reaction">
                    <a href="https://wa.me/4973459282283?text=Spannend%20eure%20Jobanzeige.%20Nehmt%20Kontakt%20mit%20mir%20auf." target="_blank" rel="noopener noreferrer" class="whatsapp-reaction-icon">
                        <svg width="40" height="40" viewBox="0 0 448 512" fill="currentColor">
                            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                        </svg>
                    </a>
                    <p>Lass uns einfach kurz austauschen, dann merkst du schnell, ob's passt.</p>
                </div>
            </div>
        </div>-->
    </div>
</section>

<!-- Philosophy Section -->
<section class="philosophy-section">
    <div class="philosophy-content">
        <div class="philosophy-quote-icon">❝</div>
        <h2>Philosophie</h2>
        <p class="main-text">Wir glauben, dass Arbeit sich gut anfühlen darf – strukturiert, menschlich, ehrlich.</p>
        <div class="philosophy-divider"></div>
        <p class="sub-text">Im Team entwickeln wir die Therapie. Der beste Therapeut für dein Kind.</p>
        <div class="philosophy-icons">
            <div class="philosophy-icon">❤️</div>
            <div class="philosophy-icon">👥</div>
            <div class="philosophy-icon">⭐</div>
        </div>
    </div>
</section>

<?php
get_footer();
