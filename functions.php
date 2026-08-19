<?php
/**
 * ANDONICK Group International — Fonctions du thème.
 *
 * @package Andonick
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ANDONICK_VERSION', '3.5.1' );
define( 'ANDONICK_DIR', get_template_directory() );
define( 'ANDONICK_URI', get_template_directory_uri() );

require_once ANDONICK_DIR . '/inc/content.php';
require_once ANDONICK_DIR . '/inc/settings.php';
require_once ANDONICK_DIR . '/inc/sections.php';
require_once ANDONICK_DIR . '/inc/appearance.php';

/**
 * Configuration de base du thème.
 */
function andonick_setup() {
	load_theme_textdomain( 'andonick', ANDONICK_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => __( 'Navigation principale', 'andonick' ),
	) );
}
add_action( 'after_setup_theme', 'andonick_setup' );

/**
 * Styles et scripts.
 */
function andonick_assets() {
	wp_enqueue_style( 'andonick-style', get_stylesheet_uri(), array(), ANDONICK_VERSION );
	wp_add_inline_style( 'andonick-style', andonick_appearance_css() );
	wp_enqueue_script( 'andonick-main', ANDONICK_URI . '/assets/js/main.js', array(), ANDONICK_VERSION, true );
	wp_localize_script( 'andonick-main', 'AndonickData', array(
		'ajaxUrl'         => admin_url( 'admin-post.php' ),
		'toast'           => andonick_t( 'toast_msg' ),
		'counterDuration' => min( 5000, max( 500, absint( andonick_ap( 'counter_duration', '1600' ) ) ) ),
	) );
}
add_action( 'wp_enqueue_scripts', 'andonick_assets' );

/**
 * ========================================================================
 * SERVICE DE LANGUES COMPLET
 * La langue active (?lang=fr|en) pilote TOUT WordPress :
 * locale, <html lang>, titre de l'onglet, hreflang, canonical, body class.
 * ========================================================================
 */

/**
 * Active la locale anglaise de WordPress quand ?lang=en
 * (dates, plugins, admin bar suivent l'anglais).
 */
function andonick_apply_locale() {
	if ( 'en' === andonick_lang() ) {
		switch_to_locale( 'en_US' );
	}
}
add_action( 'init', 'andonick_apply_locale', 1 );

/**
 * <html lang="en-US"> (ou fr-FR par défaut) sur la page EN.
 */
function andonick_html_language( $attr, $doctype ) {
	if ( 'en' === andonick_lang() ) {
		$attr = 'lang="en-US"';
	}
	return $attr;
}
add_filter( 'language_attributes', 'andonick_html_language', 10, 2 );

/**
 * Titre de l'onglet par langue — on voit immédiatement la langue active.
 */
function andonick_document_title( $title ) {
	$name = get_bloginfo( 'name' );
	$tag  = andonick_t( 'hero_tag' );
	if ( 'en' === andonick_lang() ) {
		return $name . ' — ' . $tag;
	}
	return $name . ' — ' . $tag;
}
add_filter( 'pre_get_document_title', 'andonick_document_title' );

/**
 * hreflang réciproques (fr, en, x-default) + canonical auto-référent.
 * URL FR = site, URL EN = site?lang=en.
 */
function andonick_seo_lang_links() {
	$home = home_url( '/' );
	$en   = $home . '?lang=en';
	$fr   = $home;
	$cur  = ( 'en' === andonick_lang() ) ? $en : $fr;
	echo '<link rel="canonical" href="' . esc_url( $cur ) . '">' . "\n";
	echo '<link rel="alternate" hreflang="fr" href="' . esc_url( $fr ) . '">' . "\n";
	echo '<link rel="alternate" hreflang="en" href="' . esc_url( $en ) . '">' . "\n";
	echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $fr ) . '">' . "\n";
}
add_action( 'wp_head', 'andonick_seo_lang_links', 1 );

/**
 * Classe CSS de langue sur <body> (lang-fr / lang-en).
 */
function andonick_body_lang_class( $classes ) {
	$classes[] = ( 'en' === andonick_lang() ) ? 'lang-en' : 'lang-fr';
	return $classes;
}
add_filter( 'body_class', 'andonick_body_lang_class' );

/**
 * Favicon du thème (logo officiel), sauf si l'utilisateur a défini
 * sa propre icône dans Réglages → Général → Icône du site.
 */
function andonick_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" type="image/png" href="' . esc_url( ANDONICK_URI . '/assets/img/favicon.png' ) . '" sizes="64x64">';
}
add_action( 'wp_head', 'andonick_favicon', 5 );

/**
 * Gestion des formulaires (devis / rappel) — admin-post.
 * Les champs sont définis sans code : « Formulaires & listes » dans le
 * Customizer. Le nom de chaque champ est andonick_f{index} ; la validation
 * porte sur les lignes marquées obligatoires (|1).
 */
function andonick_handle_form() {
	$nonce_ok = isset( $_POST['andonick_nonce'] ) && wp_verify_nonce( sanitize_key( wp_unslash( $_POST['andonick_nonce'] ) ), 'andonick_contact' );
	if ( ! $nonce_ok ) {
		wp_safe_redirect( wp_get_referer() . '#devis' );
		exit;
	}

	// Honeypot anti-spam : si rempli, on ignore silencieusement.
	if ( ! empty( $_POST['andonick_website'] ) ) {
		exit;
	}

	$lang = ( isset( $_POST['andonick_lang'] ) && 'en' === $_POST['andonick_lang'] ) ? 'en' : 'fr';
	$type = ( isset( $_POST['andonick_form_type'] ) && 'rappel' === $_POST['andonick_form_type'] ) ? 'rappel' : 'devis';
	$config = andonick_form_fields( $type, $lang );

	$labels = array( 'fr' => 'FR', 'en' => 'EN' );
	$kind   = ( 'rappel' === $type ) ? 'RAPPEL' : 'DEVIS';
	$lines  = array();
	$ok     = true;

	if ( empty( $config ) ) {
		$ok = false;
	}
	foreach ( $config as $i => $field ) {
		$key = 'andonick_f' . $i;
		if ( 'email' === $field['type'] ) {
			$value = isset( $_POST[ $key ] ) ? sanitize_email( wp_unslash( $_POST[ $key ] ) ) : '';
		} elseif ( 'textarea' === $field['type'] ) {
			$value = isset( $_POST[ $key ] ) ? sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) : '';
		} else {
			$value = isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '';
		}
		$value = trim( $value );
		if ( $field['required'] && '' === $value ) {
			$ok = false;
			continue;
		}
		if ( '' !== $value ) {
			$lines[] = $field['label'] . ' : ' . $value;
		}
	}

	if ( ! $ok ) {
		wp_safe_redirect( wp_get_referer() . '#devis' );
		exit;
	}

	$body  = 'Demande [' . $kind . '] — Site web (langue ' . $labels[ $lang ] . ')' . "\n\n";
	$body .= implode( "\n", $lines );
	$body .= "\n\nEnvoyé depuis : " . esc_url_raw( wp_get_referer() );

	wp_mail(
		andonick_t( 'contact_mail' ),
		'[ANDONICK] Nouvelle demande ' . $kind . ' (' . $labels[ $lang ] . ')',
		$body
	);

	wp_safe_redirect( wp_get_referer() );
	exit;
}
add_action( 'admin_post_nopriv_andonick_contact', 'andonick_handle_form' );
add_action( 'admin_post_andonick_contact', 'andonick_handle_form' );

/**
 * SEO — meta description + balises Open Graph / Twitter, réglées sans code
 * (champ « seo_desc » par langue + image « andonick_img_og »).
 */
function andonick_seo_meta() {
	$lang  = andonick_lang();
	$name  = get_bloginfo( 'name' );
	$is_article = is_singular( 'post' );
	$obj   = $is_article ? get_post() : null;
	$title = $obj ? get_the_title( $obj ) : $name . ' — ' . andonick_t( 'hero_tag' );
	$desc  = trim( (string) andonick_t( 'seo_desc' ) );
	if ( $obj ) {
		$excerpt = trim( wp_strip_all_tags( get_the_excerpt( $obj ) ) );
		if ( '' !== $excerpt ) {
			$desc = $excerpt;
		}
	}
	$img    = trim( (string) get_theme_mod( 'andonick_img_og', '' ) );
	if ( $obj && has_post_thumbnail( $obj ) ) {
		$img = get_the_post_thumbnail_url( $obj, 'full' );
	}
	$url    = $obj ? get_permalink( $obj ) : ( ( 'en' === $lang ) ? home_url( '/?lang=en' ) : home_url( '/' ) );
	$locale = ( 'en' === $lang ) ? 'en_US' : 'fr_FR';

	if ( '' !== $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $name ) . '">' . "\n";
	echo '<meta property="og:locale" content="' . esc_attr( $locale ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( '' !== $desc ) {
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	if ( '' !== $img ) {
		echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
		echo '<meta property="og:image:alt" content="' . esc_attr( $name ) . '">' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
		if ( '' !== $desc ) {
			echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
		}
		echo '<meta name="twitter:image" content="' . esc_url( $img ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'andonick_seo_meta', 2 );