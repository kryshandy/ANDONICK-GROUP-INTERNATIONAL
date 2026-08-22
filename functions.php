<?php
/**
 * ANDONICK Group International — Fonctions du thème.
 *
 * @package Andonick
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ANDONICK_VERSION', '4.0.0' );
define( 'ANDONICK_DIR', get_template_directory() );
define( 'ANDONICK_URI', get_template_directory_uri() );

require_once ANDONICK_DIR . '/inc/content.php';
require_once ANDONICK_DIR . '/inc/settings.php';
require_once ANDONICK_DIR . '/inc/sections.php';
require_once ANDONICK_DIR . '/inc/appearance.php';

/**
 * Enregistre la version livrée, sans jamais modifier le contenu du client.
 */
function andonick_on_version_change() {
	if ( get_option( 'andonick_version' ) !== ANDONICK_VERSION ) {
		update_option( 'andonick_version', ANDONICK_VERSION );
	}
}
add_action( 'init', 'andonick_on_version_change' );

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
		'primary_fr' => __( 'Navigation principale — français', 'andonick' ),
		'primary_en' => __( 'Navigation principale — anglais', 'andonick' ),
		'primary'    => __( 'Navigation principale — compatibilité', 'andonick' ),
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
		'toast'           => andonick_t( 'toast_msg' ),
		'formFeedback'    => andonick_form_feedback(),
		'counterDuration' => min( 5000, max( 500, absint( andonick_ap( 'counter_duration', '1600' ) ) ) ),
		'lang'            => andonick_lang(),
		'frontUrl'        => home_url( '/' ),
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
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}
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
	if ( ! is_front_page() ) {
		return $title;
	}

	$name = get_bloginfo( 'name' );
	$tag  = andonick_t( 'hero_tag' );
	if ( 'en' === andonick_lang() ) {
		return $name . ' — ' . $tag;
	}
	return $name . ' — ' . $tag;
}
add_filter( 'pre_get_document_title', 'andonick_document_title' );

/**
 * Renvoie l'URL canonique de la requête courante, sans le paramètre de langue.
 */
function andonick_current_url() {
	if ( is_singular() ) {
		$url = get_permalink();
	} elseif ( is_front_page() ) {
		$url = home_url( '/' );
	} else {
		$request = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
		$parsed  = wp_parse_url( $request );
		$path    = isset( $parsed['path'] ) ? $parsed['path'] : '/';
		$home_path = rtrim( (string) wp_parse_url( home_url(), PHP_URL_PATH ), '/' );
		if ( '' !== $home_path && 0 === strpos( $path, $home_path . '/' ) ) {
			$path = substr( $path, strlen( $home_path ) );
		}
		if ( '' === $path ) {
			$path = '/';
		}
		$query = isset( $parsed['query'] ) ? '?' . $parsed['query'] : '';
		$url   = home_url( $path . $query );
	}

	return remove_query_arg( 'lang', $url );
}

/**
 * Ajoute proprement la langue demandée à une URL du site.
 */
function andonick_url_in_language( $url, $lang ) {
	$url = remove_query_arg( 'lang', $url );
	return ( 'en' === $lang ) ? add_query_arg( 'lang', 'en', $url ) : $url;
}

/**
 * hreflang et canonical de la page réellement consultée.
 */
function andonick_seo_lang_links() {
	$base = andonick_current_url();
	$fr   = andonick_url_in_language( $base, 'fr' );
	$en   = andonick_url_in_language( $base, 'en' );
	$cur  = andonick_url_in_language( $base, andonick_lang() );
	echo '<link rel="canonical" href="' . esc_url( $cur ) . '">' . "\n";

	if ( is_singular() ) {
		$current_id = get_queried_object_id();
		$fr_id = absint( get_post_meta( $current_id, '_andonick_translation_fr', true ) );
		$en_id = absint( get_post_meta( $current_id, '_andonick_translation_en', true ) );
		if ( $fr_id && $en_id && 'publish' === get_post_status( $fr_id ) && 'publish' === get_post_status( $en_id ) ) {
			$fr = get_permalink( $fr_id );
			$en = add_query_arg( 'lang', 'en', get_permalink( $en_id ) );
			echo '<link rel="alternate" hreflang="fr" href="' . esc_url( $fr ) . '">' . "\n";
			echo '<link rel="alternate" hreflang="en" href="' . esc_url( $en ) . '">' . "\n";
			echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $fr ) . '">' . "\n";
			return;
		}
	}

	if ( is_front_page() ) {
		echo '<link rel="alternate" hreflang="fr" href="' . esc_url( $fr ) . '">' . "\n";
		echo '<link rel="alternate" hreflang="en" href="' . esc_url( $en ) . '">' . "\n";
		echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $fr ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'andonick_seo_lang_links', 1 );

/** Garantit que les pages anglaises dédiées sont servies avec la bonne locale. */
function andonick_redirect_translated_page_language() {
	if ( ! is_singular() ) {
		return;
	}
	$id = get_queried_object_id();
	$page_lang = get_post_meta( $id, '_andonick_page_lang', true );
	$current_lang = andonick_lang();
	if ( 'en' === $page_lang && 'en' !== $current_lang ) {
		wp_safe_redirect( add_query_arg( 'lang', 'en', get_permalink( $id ) ), 302 );
		exit;
	}
	if ( 'fr' === $page_lang && 'en' === $current_lang ) {
		$en_id = absint( get_post_meta( $id, '_andonick_translation_en', true ) );
		if ( $en_id && 'publish' === get_post_status( $en_id ) ) {
			wp_safe_redirect( add_query_arg( 'lang', 'en', get_permalink( $en_id ) ), 302 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'andonick_redirect_translated_page_language', -1 );

/* WordPress émet déjà une canonical sur les contenus unitaires. Le thème
 * fournit une canonical unique, compatible avec ?lang=en, pour toutes les
 * routes ; on retire donc celle du noyau pour éviter les contradictions. */
function andonick_remove_core_canonical() {
	remove_action( 'wp_head', 'rel_canonical' );
}
add_action( 'init', 'andonick_remove_core_canonical' );

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
 * Retourne le message de confirmation à afficher après un formulaire.
 * La logique métier vit dans le plugin ANDONICK Core ; ce relais garde le
 * thème compatible lorsque le plugin n'est pas encore activé.
 */
function andonick_form_feedback() {
	return function_exists( 'andonick_core_form_feedback' ) ? andonick_core_form_feedback() : '';
}

/** Formulaire à rouvrir après la redirection (devis par défaut). */
function andonick_form_active() {
	return function_exists( 'andonick_core_active_form' ) ? andonick_core_active_form() : 'devis';
}

/**
 * SEO — meta description + balises Open Graph / Twitter, réglées sans code
 * (champ « seo_desc » par langue + image « andonick_img_og »).
 */
function andonick_seo_meta() {
	$lang  = andonick_lang();
	$name  = get_bloginfo( 'name' );
	$is_article = is_singular( 'post' );
	$obj   = is_singular() ? get_queried_object() : null;
	$obj   = ( $obj instanceof WP_Post ) ? $obj : null;
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
	if ( '' === $img ) {
		$img = ANDONICK_URI . '/assets/img/hero.jpg';
	}
	$url    = andonick_url_in_language( andonick_current_url(), $lang );
	$locale = ( 'en' === $lang ) ? 'en_US' : 'fr_FR';

	if ( '' !== $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
	echo '<meta property="og:type" content="' . ( $is_article ? 'article' : 'website' ) . '">' . "\n";
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

/**
 * Données structurées limitées aux informations confirmées par les documents
 * client. Les implantations de Dakar et Bordeaux ne sont pas transformées en
 * adresses, faute d'adresse postale fournie.
 */
function andonick_organization_schema() {
	if ( ! is_front_page() ) {
		return;
	}

	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'@id'         => home_url( '/#organization' ),
		'name'        => get_bloginfo( 'name' ),
		'url'         => home_url( '/' ),
		'logo'        => array(
			'@type' => 'ImageObject',
			'url'   => ANDONICK_URI . '/assets/img/logo.png',
		),
		'image'       => ANDONICK_URI . '/assets/img/hero.jpg',
		'description' => trim( (string) andonick_t( 'seo_desc' ) ),
		'email'       => sanitize_email( andonick_t( 'contact_mail' ) ),
		'telephone'   => trim( (string) andonick_t( 'phone_rca1' ) ),
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Quartier Sica 1, Rue du Languedoc',
			'addressLocality' => 'Bangui',
			'addressCountry'  => 'CF',
		),
		'areaServed'  => array( 'République centrafricaine', 'Sénégal', 'France' ),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'andonick_organization_schema', 3 );

/** Routes machine lisibles et statut correct du sitemap avec une page statique. */
function andonick_machine_routes() {
	add_rewrite_rule( '^robots\.txt$', 'index.php?robots=1', 'top' );
}
add_action( 'init', 'andonick_machine_routes', 9 );

function andonick_sitemap_status_header() {
	if ( get_query_var( 'sitemap' ) ) {
		status_header( 200 );
	}
}
add_action( 'template_redirect', 'andonick_sitemap_status_header', 0 );
