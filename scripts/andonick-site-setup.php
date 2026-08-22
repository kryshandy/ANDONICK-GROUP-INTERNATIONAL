<?php
/**
 * Configuration éditoriale reproductible du site local ANDONICK.
 *
 * Exécution depuis la racine WordPress :
 * php wp-content/themes/andonick/scripts/andonick-site-setup.php
 */

$wp_load_candidates = array(
	dirname( __DIR__, 4 ) . '/wp-load.php',
	dirname( __DIR__ ) . '/wp-load.php',
);
$wp_load = '';
foreach ( $wp_load_candidates as $candidate ) {
	if ( is_readable( $candidate ) ) {
		$wp_load = $candidate;
		break;
	}
}
if ( ! $wp_load ) {
	fwrite( STDERR, "wp-load.php introuvable. Placez le dépôt dans wp-content/themes/andonick/.\n" );
	exit( 1 );
}
require $wp_load;

if ( ! function_exists( 'wp_insert_post' ) ) {
	fwrite( STDERR, "WordPress indisponible.\n" );
	exit( 1 );
}

/** Crée ou met à jour une page sans dupliquer son slug. */
function andonick_setup_page( $slug, $title, $content, $status = 'publish' ) {
	$existing = get_page_by_path( $slug, OBJECT, 'page' );
	$data = array(
		'post_type'    => 'page',
		'post_name'    => $slug,
		'post_title'   => $title,
		'post_content' => $content,
		'post_status'  => $status,
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);
	if ( $existing ) {
		$data['ID'] = $existing->ID;
	}
	$id = wp_insert_post( wp_slash( $data ), true );
	if ( is_wp_error( $id ) ) {
		throw new RuntimeException( $id->get_error_message() );
	}
	return (int) $id;
}

$home_id = andonick_setup_page(
	'accueil',
	'Accueil',
	'<!-- wp:paragraph --><p>La page d’accueil est composée par le thème ANDONICK. Ses contenus se modifient depuis <strong>Apparence → Personnaliser → ANDONICK — Contenu du site</strong> et <strong>Projets & preuves</strong>.</p><!-- /wp:paragraph -->'
);

$privacy_id = andonick_setup_page(
	'politique-de-confidentialite',
	'Politique de confidentialité',
	'<!-- wp:heading --><h2 class="wp-block-heading">Responsable du traitement</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>ANDONICK Group International, sis Quartier Sica 1, Rue du Languedoc, Bangui, République centrafricaine. Contact : <a href="mailto:contact@andonickgroup.com">contact@andonickgroup.com</a>.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Données collectées et finalités</h2><!-- /wp:heading -->
<!-- wp:list --><ul class="wp-block-list"><li>Formulaires de devis et de rappel : identité professionnelle, coordonnées et informations que vous fournissez sur votre besoin, afin de répondre à votre demande et préparer une éventuelle relation contractuelle.</li><li>Protection anti-abus : un identifiant technique non réversible dérivé de l’adresse IP est conservé temporairement, sans enregistrer l’adresse IP en clair, pour limiter les soumissions automatisées.</li><li>Journalisation technique de l’hébergement : elle peut être réalisée par l’hébergeur pour la sécurité et le maintien du service.</li></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">Base légale, destinataires et durée</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Le traitement repose sur les mesures précontractuelles demandées par le visiteur et, selon la demande, sur son consentement. Les données sont accessibles uniquement aux personnes autorisées d’ANDONICK Group et aux prestataires techniques indispensables (hébergement et messagerie) soumis à des obligations de confidentialité. Les demandes sont conservées par défaut pendant 365 jours, durée réglable par l’administrateur, puis supprimées automatiquement sauf obligation légale ou relation contractuelle en cours. Le compteur anti-abus expire par défaut après 15 minutes.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Services tiers et transferts</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>La carte externe n’est chargée qu’après une action explicite du visiteur. Si un service de messagerie, d’hébergement ou de cartographie traite des données hors du pays du visiteur, ses garanties contractuelles et sa politique de confidentialité s’appliquent. La présente page doit être actualisée lors de tout changement de prestataire.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Vos droits</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Vous pouvez demander l’accès, la rectification, l’effacement, la limitation ou l’opposition au traitement de vos données, ainsi que leur portabilité lorsqu’elle s’applique, en écrivant à <a href="mailto:contact@andonickgroup.com">contact@andonickgroup.com</a>. Une preuve d’identité peut être demandée uniquement lorsque cela est nécessaire pour sécuriser la demande.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p><em>Dernière mise à jour : 22 août 2026.</em></p><!-- /wp:paragraph -->'
);

$cookies_id = andonick_setup_page(
	'politique-de-cookies',
	'Politique de cookies et services tiers',
	'<!-- wp:paragraph --><p>Dans sa configuration livrée, ce site n’utilise aucun cookie publicitaire ni outil de mesure d’audience. Le bandeau générique de consentement est donc désactivé.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Fonctions strictement nécessaires</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>WordPress peut utiliser des cookies techniques pour les administrateurs connectés. Ils servent à la sécurité de la session et à l’administration du site, pas au suivi publicitaire. Si le bandeau d’information optionnel est activé, son choix est mémorisé localement dans le navigateur sous la clé <code>andonick_cookies</code>.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Carte externe</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Une carte intégrée, si elle est configurée, reste bloquée jusqu’au clic sur « Charger la carte ». À ce moment, le fournisseur de cartographie peut recevoir des données techniques et déposer ses propres traceurs. Vous pouvez utiliser l’adresse textuelle sans charger la carte.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Évolution du site</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Avant d’ajouter des statistiques, vidéos, pixels publicitaires ou widgets sociaux, l’administrateur doit mettre à jour cette politique et installer une solution de consentement qui empêche réellement le chargement des services facultatifs avant le choix du visiteur.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p><em>Dernière mise à jour : 22 août 2026.</em></p><!-- /wp:paragraph -->'
);

$accessibility_id = andonick_setup_page(
	'accessibilite',
	'Accessibilité',
	'<!-- wp:paragraph --><p>ANDONICK Group International souhaite rendre ce site utilisable par le plus grand nombre, notamment au clavier, sur mobile et avec des technologies d’assistance.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">État de conformité</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Le thème a fait l’objet d’une recette technique interne fondée sur les principes WCAG 2.2 de niveau AA : structure sémantique, contraste, focus visible, navigation au clavier, réduction des animations et libellés de formulaires. En l’absence d’un audit indépendant complet sur les contenus définitifs de production, le site est déclaré <strong>partiellement conforme</strong>.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Limites connues</h2><!-- /wp:heading -->
<!-- wp:list --><ul class="wp-block-list"><li>les contenus, textes alternatifs et documents ajoutés ultérieurement doivent être vérifiés par leur auteur ;</li><li>une carte ou un autre service tiers peut présenter ses propres limites ;</li><li>la conformité doit être réévaluée après une modification importante du design ou des extensions.</li></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">Signaler une difficulté</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Décrivez la page concernée, l’appareil et la difficulté rencontrée à <a href="mailto:contact@andonickgroup.com">contact@andonickgroup.com</a>. Une solution accessible ou un autre format sera recherché.</p><!-- /wp:paragraph -->'
);

$privacy_en_id = andonick_setup_page(
	'privacy-policy',
	'Privacy policy',
	'<!-- wp:heading --><h2 class="wp-block-heading">Data controller</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>ANDONICK Group International, Quartier Sica 1, Rue du Languedoc, Bangui, Central African Republic. Contact: <a href="mailto:contact@andonickgroup.com">contact@andonickgroup.com</a>.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Data and purposes</h2><!-- /wp:heading -->
<!-- wp:list --><ul class="wp-block-list"><li>Quote and callback forms: professional identity, contact details and information supplied about the request, so that ANDONICK can answer and prepare a potential contractual relationship.</li><li>Abuse prevention: a non-reversible technical identifier derived from the IP address is kept temporarily, without storing the clear IP address, to limit automated submissions.</li><li>Hosting security logs may be processed by the hosting provider to maintain and secure the service.</li></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">Legal basis, recipients and retention</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Processing is based on pre-contractual steps requested by the visitor and, depending on the request, consent. Data is available only to authorised ANDONICK staff and essential technical providers. Requests are kept for 365 days by default, a period configurable by the administrator, then automatically deleted unless a legal obligation or active contractual relationship requires otherwise. The anti-abuse counter expires after 15 minutes by default.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Third-party services and your rights</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>An external map loads only after an explicit action. Hosting, email or map providers may apply their own privacy terms. You may request access, correction, deletion, restriction, objection or portability where applicable by emailing <a href="mailto:contact@andonickgroup.com">contact@andonickgroup.com</a>.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p><em>Last updated: 22 August 2026.</em></p><!-- /wp:paragraph -->'
);

$cookies_en_id = andonick_setup_page(
	'cookie-policy',
	'Cookie and third-party services policy',
	'<!-- wp:paragraph --><p>As delivered, this site uses no advertising cookies or audience measurement tool. The generic consent banner is therefore disabled.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Strictly necessary functions</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>WordPress may use technical cookies for signed-in administrators. They secure the administration session and are not used for advertising. If the optional notice is enabled, its choice is stored locally under <code>andonick_cookies</code>.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">External map</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>A configured embedded map remains blocked until the visitor clicks “Load map”. The map provider may then receive technical data and set its own trackers. The textual address remains available without loading it.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Future services</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Before adding analytics, advertising pixels, videos or social widgets, update this policy and deploy a consent platform that actually blocks optional services before consent.</p><!-- /wp:paragraph -->'
);

$accessibility_en_id = andonick_setup_page(
	'accessibility-statement',
	'Accessibility statement',
	'<!-- wp:paragraph --><p>ANDONICK Group International aims to make this site usable by as many people as possible, including keyboard, mobile and assistive-technology users.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Conformance status</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>The theme underwent an internal technical review based on WCAG 2.2 level AA principles: semantic structure, contrast, visible focus, keyboard operation, reduced motion and labelled forms. Because no complete independent audit has yet been conducted on the final production content, the site is declared <strong>partially conformant</strong>.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Known limits and feedback</h2><!-- /wp:heading -->
<!-- wp:list --><ul class="wp-block-list"><li>content, alternative text and documents added later must be checked by their author;</li><li>third-party maps or services may have their own limitations;</li><li>conformance must be reassessed after significant changes.</li></ul><!-- /wp:list -->
<!-- wp:paragraph --><p>Report a difficulty, with the page, device and issue, to <a href="mailto:contact@andonickgroup.com">contact@andonickgroup.com</a>. We will seek an accessible alternative.</p><!-- /wp:paragraph -->'
);

foreach ( array(
	array( $privacy_id, $privacy_en_id ),
	array( $cookies_id, $cookies_en_id ),
	array( $accessibility_id, $accessibility_en_id ),
) as $pair ) {
	update_post_meta( $pair[0], '_andonick_page_lang', 'fr' );
	update_post_meta( $pair[0], '_andonick_translation_fr', $pair[0] );
	update_post_meta( $pair[0], '_andonick_translation_en', $pair[1] );
	update_post_meta( $pair[1], '_andonick_page_lang', 'en' );
	update_post_meta( $pair[1], '_andonick_translation_fr', $pair[0] );
	update_post_meta( $pair[1], '_andonick_translation_en', $pair[1] );
}

/* Le brouillon balise volontairement les informations juridiques manquantes :
 * il ne doit pas être publié avant validation du client et de l'hébergeur. */
andonick_setup_page(
	'mentions-legales',
	'Mentions légales — À compléter avant publication',
	'<!-- wp:paragraph --><p><strong>NE PAS PUBLIER AVANT COMPLÉTION.</strong></p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Éditeur</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>ANDONICK Group International — Quartier Sica 1, Rue du Languedoc, Bangui, République centrafricaine — contact@andonickgroup.com — +236 75 00 06 49.</p><!-- /wp:paragraph -->
<!-- wp:list --><ul class="wp-block-list"><li>Forme juridique : À FOURNIR</li><li>Capital social : À FOURNIR</li><li>RCCM / numéro d’immatriculation : À FOURNIR</li><li>NIF / identifiant fiscal : À FOURNIR</li><li>Directeur ou directrice de publication : À VALIDER</li></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">Hébergement</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Raison sociale, adresse et contact de l’hébergeur : À FOURNIR APRÈS CHOIX DE L’HÉBERGEMENT.</p><!-- /wp:paragraph -->',
	'draft'
);

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home_id );
update_option( 'wp_page_for_privacy_policy', $privacy_id );
update_option( 'timezone_string', 'Africa/Bangui' );
update_option( 'date_format', 'j F Y' );
update_option( 'time_format', 'H:i' );
update_option( 'users_can_register', 0 );
update_option( 'default_comment_status', 'closed' );
update_option( 'default_ping_status', 'closed' );
update_option( 'permalink_structure', '/actualites/%postname%/' );

set_theme_mod( 'andonick_legal_page_1', $privacy_id );
set_theme_mod( 'andonick_legal_page_2', $cookies_id );
set_theme_mod( 'andonick_legal_page_3', $accessibility_id );
set_theme_mod( 'andonick_legal_page_1_en', $privacy_en_id );
set_theme_mod( 'andonick_legal_page_2_en', $cookies_en_id );
set_theme_mod( 'andonick_legal_page_3_en', $accessibility_en_id );
set_theme_mod( 'andonick_privacy_page', $privacy_id );
set_theme_mod( 'andonick_privacy_page_en', $privacy_en_id );
set_theme_mod( 'andonick_cookies_enabled', '0' );
set_theme_mod( 'andonick_form_consent_enabled', '1' );

flush_rewrite_rules();

echo 'Accueil=' . $home_id . PHP_EOL;
echo 'Confidentialite=' . $privacy_id . PHP_EOL;
echo 'Cookies=' . $cookies_id . PHP_EOL;
echo 'Accessibilite=' . $accessibility_id . PHP_EOL;
echo 'PrivacyEN=' . $privacy_en_id . PHP_EOL;
echo 'CookiesEN=' . $cookies_en_id . PHP_EOL;
echo 'AccessibilityEN=' . $accessibility_en_id . PHP_EOL;
