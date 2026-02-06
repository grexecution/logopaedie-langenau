<?php
/**
 * SEO Functions for Logopädie Langenau Theme
 *
 * Handles meta tags, Open Graph, Twitter Cards, and Schema.org structured data
 *
 * @package Logopaedie_Langenau
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Site-wide SEO configuration
 */
function logopaedie_get_seo_config() {
    return array(
        'site_name'        => 'Logopädie Langenau',
        'site_description' => 'Professionelle logopädische Behandlung für Kinder, Jugendliche und Erwachsene in Langenau. Sprach-, Sprech-, Stimm- und Schlucktherapie mit wissenschaftlich fundiertem Ansatz.',
        'business_name'    => 'Logopädie Langenau',
        'street_address'   => 'Fischergasse 10',
        'postal_code'      => '89129',
        'city'             => 'Langenau',
        'region'           => 'Baden-Württemberg',
        'country'          => 'DE',
        'phone'            => '+49 7345 5022',
        'phone_display'    => '07345 5022',
        'email'            => 'info@logopaedie-langenau.de',
        'latitude'         => '48.4977',
        'longitude'        => '10.1208',
        'price_range'      => '€€',
        'opening_hours'    => array(
            'Mo-Fr 08:00-18:00'
        ),
        'social'           => array(
            'facebook'  => '',
            'instagram' => '',
            'linkedin'  => '',
        ),
        'locale'           => 'de_DE',
        'twitter_handle'   => '',
    );
}

/**
 * Get page-specific SEO data
 */
function logopaedie_get_page_seo($page_type = '') {
    $config = logopaedie_get_seo_config();

    $seo_data = array(
        'home' => array(
            'title'       => 'Logopädie Langenau | Sprach-, Sprech- & Stimmtherapie im Alb-Donau-Kreis',
            'description' => 'Professionelle logopädische Behandlung in Langenau. Sprach-, Sprech-, Stimm- und Schlucktherapie für alle Altersgruppen. MSc-geleitete Praxis mit über 25 Jahren Erfahrung.',
            'keywords'    => 'Logopädie, Langenau, Sprachtherapie, Stimmtherapie, Sprechtherapie, Schlucktherapie, Kinderlogopädie, Logopäde, Alb-Donau-Kreis, Ulm',
        ),
        'jobausschreibung' => array(
            'title'       => 'Stellenangebot Logopäde/in (m/w/d) | Logopädie Langenau',
            'description' => 'Wir suchen Logopäden (m/w/d) für unser Team in Langenau. Flexible Arbeitszeiten, überdurchschnittliche Vergütung, familiäres Team. Jetzt bewerben!',
            'keywords'    => 'Stellenangebot Logopäde, Job Logopädie, Logopäde Langenau, Logopädie Stelle, Therapeut gesucht',
        ),
        'fragebogen' => array(
            'title'       => 'Fragebogen | Logopädie Langenau',
            'description' => 'Starte deine Bewerbung bei Logopädie Langenau. Unkompliziert und persönlich – finde heraus, ob wir zusammenpassen.',
            'keywords'    => 'Bewerbung Logopädie, Fragebogen, Logopäde Bewerbung, Job Logopädie Langenau',
        ),
        'bewerbung' => array(
            'title'       => 'Jetzt bewerben | Logopädie Langenau',
            'description' => 'Bewirb dich jetzt bei Logopädie Langenau! Fülle unser Bewerbungsformular aus und werde Teil unseres Teams in Langenau.',
            'keywords'    => 'Bewerbung Logopädie, Logopäde bewerben, Job Logopädie Langenau, Bewerbungsformular',
        ),
    );

    return isset($seo_data[$page_type]) ? $seo_data[$page_type] : $seo_data['home'];
}

/**
 * Determine current page type
 */
function logopaedie_get_current_page_type() {
    if (is_front_page()) {
        return 'home';
    }

    if (is_page_template('page-jobausschreibung.php') || is_page('jobausschreibung')) {
        return 'jobausschreibung';
    }

    if (is_page_template('page-fragebogen.php') || is_page('fragebogen')) {
        return 'fragebogen';
    }

    if (is_page_template('page-bewerbung.php') || is_page('bewerbung')) {
        return 'bewerbung';
    }

    return 'home';
}

/**
 * Output meta tags in head
 */
function logopaedie_output_meta_tags() {
    $config = logopaedie_get_seo_config();
    $page_type = logopaedie_get_current_page_type();
    $seo = logopaedie_get_page_seo($page_type);

    $current_url = home_url(add_query_arg(array(), $GLOBALS['wp']->request));
    $og_image = LOGOPAEDIE_THEME_URI . '/assets/images/og-image.jpg';

    // Check for custom OG image
    if (is_singular() && has_post_thumbnail()) {
        $og_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
    }
    ?>

    <!-- Primary Meta Tags -->
    <meta name="description" content="<?php echo esc_attr($seo['description']); ?>">
    <meta name="keywords" content="<?php echo esc_attr($seo['keywords']); ?>">
    <meta name="author" content="<?php echo esc_attr($config['business_name']); ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url($current_url); ?>">

    <!-- Geographic Meta Tags -->
    <meta name="geo.region" content="<?php echo esc_attr($config['country'] . '-' . $config['region']); ?>">
    <meta name="geo.placename" content="<?php echo esc_attr($config['city']); ?>">
    <meta name="geo.position" content="<?php echo esc_attr($config['latitude'] . ';' . $config['longitude']); ?>">
    <meta name="ICBM" content="<?php echo esc_attr($config['latitude'] . ', ' . $config['longitude']); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo is_front_page() ? 'website' : 'article'; ?>">
    <meta property="og:url" content="<?php echo esc_url($current_url); ?>">
    <meta property="og:title" content="<?php echo esc_attr($seo['title']); ?>">
    <meta property="og:description" content="<?php echo esc_attr($seo['description']); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr($config['site_name']); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($config['site_name']); ?>">
    <meta property="og:locale" content="<?php echo esc_attr($config['locale']); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo esc_url($current_url); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr($seo['title']); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($seo['description']); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    <?php if (!empty($config['twitter_handle'])) : ?>
    <meta name="twitter:site" content="@<?php echo esc_attr($config['twitter_handle']); ?>">
    <meta name="twitter:creator" content="@<?php echo esc_attr($config['twitter_handle']); ?>">
    <?php endif; ?>

    <!-- Additional Meta Tags -->
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-color" content="#ff6b4e">
    <meta name="msapplication-TileColor" content="#ff6b4e">

    <?php
}
add_action('wp_head', 'logopaedie_output_meta_tags', 1);

/**
 * Custom document title
 */
function logopaedie_custom_document_title($title) {
    $page_type = logopaedie_get_current_page_type();
    $seo = logopaedie_get_page_seo($page_type);

    return $seo['title'];
}
add_filter('pre_get_document_title', 'logopaedie_custom_document_title', 10);

/**
 * Output Schema.org JSON-LD structured data
 */
function logopaedie_output_schema_markup() {
    $config = logopaedie_get_seo_config();
    $page_type = logopaedie_get_current_page_type();
    $seo = logopaedie_get_page_seo($page_type);
    $current_url = home_url(add_query_arg(array(), $GLOBALS['wp']->request));
    $logo_url = LOGOPAEDIE_THEME_URI . '/assets/images/logo.png';
    $og_image = LOGOPAEDIE_THEME_URI . '/assets/images/og-image.jpg';

    // Organization Schema
    $organization = array(
        '@type'       => 'Organization',
        '@id'         => home_url('/#organization'),
        'name'        => $config['business_name'],
        'url'         => home_url('/'),
        'logo'        => array(
            '@type'  => 'ImageObject',
            '@id'    => home_url('/#logo'),
            'url'    => $logo_url,
            'width'  => 200,
            'height' => 60,
        ),
        'contactPoint' => array(
            '@type'             => 'ContactPoint',
            'telephone'         => $config['phone'],
            'contactType'       => 'customer service',
            'availableLanguage' => array('German'),
        ),
        'sameAs' => array_filter(array_values($config['social'])),
    );

    // LocalBusiness Schema (MedicalBusiness - SpeechPathology)
    $local_business = array(
        '@type'            => array('LocalBusiness', 'MedicalBusiness'),
        '@id'              => home_url('/#localbusiness'),
        'name'             => $config['business_name'],
        'description'      => $config['site_description'],
        'url'              => home_url('/'),
        'telephone'        => $config['phone'],
        'email'            => $config['email'],
        'priceRange'       => $config['price_range'],
        'image'            => $og_image,
        'logo'             => $logo_url,
        'address'          => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $config['street_address'],
            'addressLocality' => $config['city'],
            'addressRegion'   => $config['region'],
            'postalCode'      => $config['postal_code'],
            'addressCountry'  => $config['country'],
        ),
        'geo'              => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => $config['latitude'],
            'longitude' => $config['longitude'],
        ),
        'openingHoursSpecification' => array(
            array(
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
                'opens'     => '08:00',
                'closes'    => '18:00',
            ),
        ),
        'areaServed' => array(
            array(
                '@type' => 'City',
                'name'  => 'Langenau',
            ),
            array(
                '@type' => 'City',
                'name'  => 'Ulm',
            ),
            array(
                '@type' => 'City',
                'name'  => 'Heidenheim',
            ),
        ),
        'hasOfferCatalog' => array(
            '@type' => 'OfferCatalog',
            'name'  => 'Logopädische Leistungen',
            'itemListElement' => array(
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name'  => 'Kinderlogopädie',
                        'description' => 'Sprachtherapie für Kinder mit Lautbildungsstörungen, Sprachentwicklungsverzögerungen und mehr.',
                    ),
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name'  => 'Stimmtherapie',
                        'description' => 'Behandlung von funktionellen und organisch bedingten Stimmstörungen.',
                    ),
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name'  => 'Schlucktherapie',
                        'description' => 'Therapie bei Schluckstörungen (Dysphagie) für Erwachsene.',
                    ),
                ),
                array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name'  => 'Hausbesuche',
                        'description' => 'Logopädische Behandlung bei Ihnen zu Hause oder in Pflegeeinrichtungen.',
                    ),
                ),
            ),
        ),
    );

    // WebSite Schema
    $website = array(
        '@type'           => 'WebSite',
        '@id'             => home_url('/#website'),
        'url'             => home_url('/'),
        'name'            => $config['site_name'],
        'description'     => $config['site_description'],
        'publisher'       => array('@id' => home_url('/#organization')),
        'inLanguage'      => 'de-DE',
    );

    // WebPage Schema
    $webpage = array(
        '@type'           => 'WebPage',
        '@id'             => $current_url . '#webpage',
        'url'             => $current_url,
        'name'            => $seo['title'],
        'description'     => $seo['description'],
        'isPartOf'        => array('@id' => home_url('/#website')),
        'about'           => array('@id' => home_url('/#localbusiness')),
        'inLanguage'      => 'de-DE',
        'datePublished'   => get_the_date('c'),
        'dateModified'    => get_the_modified_date('c'),
    );

    // BreadcrumbList Schema
    $breadcrumbs = array(
        '@type'           => 'BreadcrumbList',
        'itemListElement' => array(),
    );

    $breadcrumbs['itemListElement'][] = array(
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => 'Startseite',
        'item'     => home_url('/'),
    );

    if ($page_type === 'jobausschreibung') {
        $breadcrumbs['itemListElement'][] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Stellenangebot',
            'item'     => home_url('/jobausschreibung/'),
        );
    } elseif ($page_type === 'fragebogen') {
        $breadcrumbs['itemListElement'][] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Fragebogen',
            'item'     => home_url('/fragebogen/'),
        );
    } elseif ($page_type === 'bewerbung') {
        $breadcrumbs['itemListElement'][] = array(
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => 'Bewerbung',
            'item'     => home_url('/bewerbung/'),
        );
    }

    // JobPosting Schema (for job page)
    $job_posting = null;
    if ($page_type === 'jobausschreibung') {
        $job_posting = array(
            '@type'            => 'JobPosting',
            '@id'              => home_url('/jobausschreibung/#jobposting'),
            'title'            => 'Logopäde/in (m/w/d)',
            'description'      => '<p>Wir suchen eine/n engagierte/n Logopäden/in für unser Team in Langenau. Wir bieten flexible Arbeitszeiten, überdurchschnittliche Vergütung und ein familiäres Arbeitsumfeld.</p><p>Aufgaben: Individuelle logopädische Therapie, Diagnostik, Beratung, Dokumentation und interdisziplinäre Zusammenarbeit.</p>',
            'datePosted'       => date('Y-m-d'),
            'validThrough'     => date('Y-m-d', strtotime('+6 months')),
            'employmentType'   => array('FULL_TIME', 'PART_TIME'),
            'hiringOrganization' => array(
                '@type'   => 'Organization',
                'name'    => $config['business_name'],
                'sameAs'  => home_url('/'),
                'logo'    => $logo_url,
            ),
            'jobLocation'      => array(
                '@type'   => 'Place',
                'address' => array(
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => $config['street_address'],
                    'addressLocality' => $config['city'],
                    'addressRegion'   => $config['region'],
                    'postalCode'      => $config['postal_code'],
                    'addressCountry'  => $config['country'],
                ),
            ),
            'baseSalary'       => array(
                '@type'    => 'MonetaryAmount',
                'currency' => 'EUR',
                'value'    => array(
                    '@type'    => 'QuantitativeValue',
                    'minValue' => 3500,
                    'maxValue' => 4500,
                    'unitText' => 'MONTH',
                ),
            ),
            'qualifications'   => 'Abgeschlossene Ausbildung als Logopäde/in, Empathie und Geduld, Teamfähigkeit',
            'responsibilities' => 'Individuelle logopädische Therapie, Diagnostik und Befunderhebung, Beratung von Patienten und Angehörigen',
            'skills'           => 'Logopädie, Sprachtherapie, Stimmtherapie, Kinderlogopädie',
            'industry'         => 'Gesundheitswesen',
            'occupationalCategory' => '29-1127.00',
            'jobBenefits'      => 'Flexible Arbeitszeiten, überdurchschnittliche Vergütung, Fortbildungsmöglichkeiten, familiäres Team',
        );
    }

    // Build the complete schema
    $schema = array(
        '@context' => 'https://schema.org',
        '@graph'   => array(
            $organization,
            $local_business,
            $website,
            $webpage,
            $breadcrumbs,
        ),
    );

    if ($job_posting) {
        $schema['@graph'][] = $job_posting;
    }

    ?>
    <script type="application/ld+json">
    <?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
    </script>
    <?php
}
add_action('wp_head', 'logopaedie_output_schema_markup', 2);

/**
 * Add preconnect for performance
 */
function logopaedie_add_preconnect() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action('wp_head', 'logopaedie_add_preconnect', 0);

/**
 * Add sitemap link to head
 */
function logopaedie_add_sitemap_link() {
    if (get_option('blog_public')) {
        ?>
        <link rel="sitemap" type="application/xml" href="<?php echo esc_url(home_url('/wp-sitemap.xml')); ?>">
        <?php
    }
}
add_action('wp_head', 'logopaedie_add_sitemap_link', 3);

/**
 * Modify robots.txt
 */
function logopaedie_robots_txt($output, $public) {
    if ($public) {
        $output .= "\n# Logopädie Langenau\n";
        $output .= "Sitemap: " . home_url('/wp-sitemap.xml') . "\n";
    }
    return $output;
}
add_filter('robots_txt', 'logopaedie_robots_txt', 10, 2);

/**
 * Remove WordPress version for security
 */
function logopaedie_remove_wp_version() {
    return '';
}
add_filter('the_generator', 'logopaedie_remove_wp_version');

/**
 * Add hreflang tag (for potential multi-language support)
 */
function logopaedie_add_hreflang() {
    $current_url = home_url(add_query_arg(array(), $GLOBALS['wp']->request));
    ?>
    <link rel="alternate" hreflang="de" href="<?php echo esc_url($current_url); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo esc_url($current_url); ?>">
    <?php
}
add_action('wp_head', 'logopaedie_add_hreflang', 1);
