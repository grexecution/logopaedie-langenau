<?php
/**
 * The template for displaying the front page (Landing Page)
 *
 * Simple landing page with hero and footer
 *
 * @package Logopaedie_Langenau
 */

get_header();
?>

    <!-- Hero Section -->
    <section class="landing-hero">
        <div class="landing-hero-bg"></div>
        <div class="landing-hero-content">
            <h1>
                Dein Job ist wichtig – <span class="text-dark-blue">und du bist es auch.</span>
            </h1>
            <p class="landing-hero-subtitle">
                Sag uns, was dir im Alltag wichtig ist – und wir zeigen dir, wie wir das in der Praxis leben.
            </p>
            <div class="landing-hero-buttons-wrapper">
                <div class="landing-hero-buttons">
                    <a href="<?php echo esc_url(home_url('/fragebogen/')); ?>" class="btn btn-white">
                        Kurzdialog starten →
                    </a>
                    <a href="<?php echo esc_url(home_url('/jobausschreibung/')); ?>" class="btn btn-outline-white">
                        Zum Jobangebot
                    </a>
                    <a href="https://www.logopaedie-langenau.de/" class="btn btn-white-silent">
                        Logopädische Praxis →
                    </a>
                </div>
                <p class="button-subtitle">Dauert nur 1 Minute. Anonym. Keine Bewerbung. Keine Verpflichtung.</p>
            </div>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="intro-section">
        <div class="container">
            <div class="intro-content">
                <h2>Logopädie Langenau – Wissenschaftlich fundiert & mit Herz</h2>
                <p class="intro-lead">Sprach-, Sprech-, Stimm- und Schlucktherapie im Alb-Donau-Kreis – individuell, empathisch und modern.</p>
                <p>Unsere Praxis in Langenau verbindet fundierte wissenschaftliche Expertise mit persönlicher Betreuung und modernen Therapiekonzepten.</p>
            </div>
        </div>
    </section>

    <!-- Unsere Praxis Section -->
    <section class="praxis-section">
        <div class="container">
            <h2>Unsere Praxis: Kompetenz trifft Leidenschaft</h2>
            <div class="praxis-content">
                <p>Seit über 25 Jahren steht unsere Praxis für hochwertige, ganzheitliche Logopädie in Langenau. Die Inhaberin (MSc Logopädie, Donau-Universität Krems) vereint wissenschaftliches Know-how mit langjähriger Praxiserfahrung und mehr als 70 Fortbildungen.</p>
                <p>Während ihrer Tätigkeit an der phoniatrischen Ambulanz der Universitätsklinik Ulm war sie an Diagnostik und Beratung bei Sprachentwicklungs- und auditiven Verarbeitungsstörungen beteiligt – ein Erfahrungsschatz, der bis heute in die Arbeit des Teams einfließt.</p>
                <p>Wir behandeln Kinder, Jugendliche und Erwachsene in allen logopädischen Störungsbildern – individuell, alltagsnah und mit Freude an Fortschritten. Besonders am Herzen liegt uns die Arbeit mit Kindern und in der Stimmtherapie.</p>
                <p>Digitale Abläufe ermöglichen eine reibungslose Organisation und flexible Terminplanung, damit mehr Zeit für das Wesentliche bleibt: Ihre Stimme, Sprache und Lebensqualität.</p>
            </div>

            <div class="auf-einen-blick">
                <h3>Auf einen Blick</h3>
                <ul class="blick-list">
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>MSc-geleitete Praxis mit wissenschaftlich fundiertem Ansatz</span>
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Logopädie für Kinder, Jugendliche & Erwachsene</span>
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Erfahrung aus der phoniatrischen Ambulanz der Uni Ulm</span>
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Besondere Expertise in Kinder- & Stimmtherapie</span>
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Hausbesuche & digitale Organisation</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Schwerpunkte Section -->
    <section class="schwerpunkte-section">
        <div class="container">
            <h2>Unsere Schwerpunkte</h2>
            <div class="schwerpunkte-grid">
                <div class="schwerpunkt-card">
                    <div class="schwerpunkt-icon">👶</div>
                    <h3>Kinderlogopädie</h3>
                    <p>Mit viel Erfahrung und Einfühlungsvermögen begleiten wir Kinder auf ihrem Weg zur Sprache. Wir fördern Lautbildung, Wortschatz und Grammatik spielerisch und gezielt – abgestimmt auf Entwicklungsstand, Alltag und Bedürfnisse.</p>
                    <p>Frühzeitige Unterstützung sorgt für mehr Sprachsicherheit und stärkt das Selbstvertrauen.</p>
                </div>
                <div class="schwerpunkt-card">
                    <div class="schwerpunkt-icon">🎤</div>
                    <h3>Stimmtherapie</h3>
                    <p>Eine gesunde Stimme ist Ausdruck von Wohlbefinden und Persönlichkeit. Wir behandeln funktionelle und organisch bedingte Stimmstörungen – häufig bei Lehrkräften, Vielsprecher:innen oder nach Operationen.</p>
                    <p>Individuelle Übungen und Stimmtechniken helfen, Belastbarkeit und Tragfähigkeit der Stimme zu verbessern.</p>
                </div>
                <div class="schwerpunkt-card">
                    <div class="schwerpunkt-icon">🏠</div>
                    <h3>Weitere Behandlungsbereiche & Hausbesuche</h3>
                    <p>Neben der Kinder- und Stimmtherapie behandeln wir alle logopädischen Störungsbilder – bei Kindern, Jugendlichen und Erwachsenen. Dazu gehören Sprach-, Sprech- und Schluckstörungen ebenso wie myofunktionelle oder neurologisch bedingte Beeinträchtigungen.</p>
                    <p>Hausbesuche und die logopädische Versorgung in Pflegeeinrichtungen gehören selbstverständlich zu unserem Angebot.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Wissenschaft Section -->
    <section class="wissenschaft-section">
        <div class="container">
            <h2>Wissenschaft & Qualität – Evidenzbasierte Logopädie</h2>
            <div class="wissenschaft-content">
                <p>Qualität bedeutet für uns ständige Weiterentwicklung. Wir möchten, dass unsere Patientinnen und Patienten von aktuellen Erkenntnissen und bewährten Methoden gleichermaßen profitieren.</p>
                <p>Darum arbeiten wir nach anerkannten Leitlinien und auf Grundlage neuester Forschungsergebnisse aus Sprach-, Sprech- und Stimmwissenschaft. Regelmäßige Fort- und Weiterbildungen sichern den hohen Standard unserer Arbeit und gewährleisten, dass wissenschaftliche Erkenntnisse praxisnah umgesetzt werden.</p>
                <p>Unser Ziel ist eine evidenzbasierte, wirksame und alltagstaugliche Logopädie, die individuell auf die Bedürfnisse jedes Menschen abgestimmt ist.</p>
            </div>

            <div class="fortbildungen-box">
                <h3>Beispielhafte Fortbildungen (Auswahl):</h3>
                <ul class="fortbildungen-list">
                    <li>Heidelberger Elterntraining bei Late Talkern (Buschmann A. et al., 2011/2012)</li>
                    <li>P.O.P.T – Psycholinguistisch orientierte Phonologie-Therapie (Fox-Boyer, A.)</li>
                    <li>PLAN – Patholinguistische Therapie bei Sprachentwicklungsstörungen (Siegmüller, J. / Kauschke, C.)</li>
                    <li>Verbale Entwicklungsdyspraxie: VediT & KoArt (Dr. Schulte-Mäder, A. / Becker-Redding, U.)</li>
                    <li>Akzentmethode (Thyme-Frøkjær, K. / Prof. Dr. Frøkjær-Jensen, B.)</li>
                    <li>LSVT LOUD® – Stimm- und Sprechtherapie bei neurologischen Störungen (Dr. Ramig, L. / Fox, C.)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Erfolgsbeispiele Section -->
    <section class="erfolge-section">
        <div class="container">
            <h2>Erfolgsbeispiele aus der Praxis</h2>
            <p class="erfolge-intro">In unserer Logopädiepraxis in Langenau entstehen Fortschritte durch Geduld, fachliches Wissen und die enge Zusammenarbeit mit unseren Patientinnen, Patienten und deren Angehörigen. Jede Entwicklung ist individuell – manchmal sind es kleine Schritte, die große Veränderungen im Alltag bewirken.</p>

            <div class="erfolge-grid">
                <div class="erfolg-card">
                    <div class="erfolg-label">Kinderlogopädie</div>
                    <p>Ein fünfjähriges Kind mit Lautbildungsstörung konnte im Verlauf der Therapie immer deutlicher sprechen. Die Eltern berichten, dass ihr Kind nun wieder mehr Freude am Erzählen hat und sich selbstbewusster ausdrückt – ein schöner Erfolg unserer gemeinsamen Arbeit.</p>
                </div>
                <div class="erfolg-card">
                    <div class="erfolg-label">Stimmtherapie</div>
                    <p>Eine Lehrerin mit chronischer Heiserkeit lernte, ihre Stimme gezielter einzusetzen und zu schonen. Im Schulalltag fällt ihr das Sprechen nun deutlich leichter – die Stimme klingt klarer, kräftiger und hält den Unterricht besser durch.</p>
                </div>
                <div class="erfolg-card">
                    <div class="erfolg-label">Schlucktherapie</div>
                    <p>Ein Patient nach einem Schlaganfall erhielt Unterstützung beim sicheren Schlucken und Essen. Mit gezielten Übungen und Angehörigenberatung konnte das Essen wieder entspannter und sicherer gestaltet werden – ein wichtiger Schritt hin zu mehr Lebensqualität.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2>Häufige Fragen zur logopädischen Therapie</h2>

            <div class="faq-grid">
                <div class="faq-item">
                    <h3>Wie bekomme ich eine logopädische Behandlung?</h3>
                    <p>Für eine logopädische Therapie benötigen Sie eine ärztliche Heilmittelverordnung – zum Beispiel von Kinderärzt:innen, HNO-Ärzt:innen, Hausärzt:innen, Neurolog:innen oder Phoniater:innen.</p>
                    <p>Die Kosten werden in der Regel von gesetzlichen und privaten Krankenkassen übernommen. Kinder sind von der Zuzahlung befreit. Erwachsene leisten nach gesetzlichen Vorgaben eine Eigenbeteiligung von 10 % des Verordnungswertes sowie eine Pauschale von 10 € je Verordnung.</p>
                    <p>Bei entsprechender medizinischer oder sozialer Begründung kann eine Zuzahlungsbefreiung über die Krankenkasse beantragt werden.</p>
                </div>
                <div class="faq-item">
                    <h3>Wie spreche ich mit dem Arzt über meine Beobachtungen?</h3>
                    <p>Wenn Sie sich Gedanken über die sprachliche Entwicklung Ihres Kindes oder über anhaltende Stimmprobleme machen, hilft es, Ihre Beobachtungen konkret zu beschreiben – etwa typische Alltagssituationen oder Veränderungen im Sprechverhalten.</p>
                    <p>Auch Rückmeldungen aus Kindergarten oder Schule können wertvolle Hinweise geben und die Einschätzung ergänzen. Viele Ärztinnen und Ärzte reagieren offen, wenn Eltern ihre Wahrnehmungen teilen und sich Unterstützung für ihr Kind wünschen.</p>
                    <p>Unsere Praxis unterstützt Sie dabei gerne – mit Informationsmaterial für Ärzt:innen oder einer unverbindlichen telefonischen Beratung, um das weitere Vorgehen zu besprechen.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertenwissen Section -->
    <section class="experten-section">
        <div class="container">
            <h2>Expertenwissen & fachlicher Austausch</h2>
            <div class="experten-content">
                <p>Als akademisch geleitete Praxis legen wir großen Wert auf kontinuierliche Weiterbildung und wissenschaftlichen Austausch. Über Fachliteratur und wissenschaftliche Portale holen wir uns regelmäßig neue Impulse aus der Forschung und integrieren sie in unsere therapeutische Arbeit.</p>
                <p>Darüber hinaus nehmen wir an Symposien der Phoniatrie der Universität Ulm teil und sind Mitglied bei LOGO Deutschland e. V. sowie im regionalen Netzwerk Therapeuten Ulm/Neu-Ulm e. V., das mehrmals im Jahr den fachübergreifenden Dialog fördert.</p>
                <p class="experten-highlight">Diese Vernetzung hält unser Team auf dem neuesten Stand der Logopädie – und stärkt die Qualität unserer Arbeit.</p>
            </div>
        </div>
    </section>

    <!-- Kontakt Section -->
    <section class="kontakt-section">
        <div class="container">
            <h2>Kontakt & Lage</h2>
            <div class="kontakt-grid">
                <div class="kontakt-info">
                    <h3>Logopädie Langenau</h3>
                    <p class="kontakt-address">Fischergasse 10<br>89129 Langenau</p>

                    <div class="kontakt-details">
                        <div class="kontakt-item">
                            <span class="kontakt-icon">📞</span>
                            <a href="tel:073455022">07345 5022</a>
                        </div>
                        <div class="kontakt-item">
                            <span class="kontakt-icon">✉️</span>
                            <a href="mailto:info@logopaedie-langenau.de">info@logopaedie-langenau.de</a>
                        </div>
                    </div>

                    <p class="kontakt-hours">Öffnungszeiten: Termine nach Vereinbarung · Hausbesuche möglich</p>
                    <p class="kontakt-cta">Wir freuen uns auf Ihre Anfrage – telefonisch, per E-Mail oder WhatsApp.</p>

                    <div class="kontakt-buttons">
                        <a href="https://wa.me/4973459282283?text=Spannend%20eure%20Jobanzeige.%20Nehmt%20Kontakt%20mit%20mir%20auf." class="btn btn-white" target="_blank" rel="noopener">WhatsApp</a>
                        <a href="https://www.google.com/maps/search/?api=1&query=Fischergasse+10+89129+Langenau" class="btn btn-outline-white" target="_blank" rel="noopener">Google Maps</a>
                    </div>
                </div>
            </div>
            <p class="rechtliches-note">Logopädische Behandlungen sind ärztlich verordnungsfähig. Die Kosten werden von allen gesetzlichen und privaten Krankenkassen übernommen.</p>
        </div>
    </section>

<?php
get_footer();
