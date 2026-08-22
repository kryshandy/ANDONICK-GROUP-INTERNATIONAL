<?php
/**
 * ANDONICK Group International — Fonctions du thème.
 *
 * @package Andonick
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ANDONICK_VERSION', '3.9.0' );
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

	/* Le site ne possède pas encore de paires de traductions pour les pages
	 * et articles. Déclarer des hreflang sur ces contenus serait trompeur :
	 * seul l'accueil existe réellement dans les deux langues. */
	if ( is_front_page() ) {
		echo '<link rel="alternate" hreflang="fr" href="' . esc_url( $fr ) . '">' . "\n";
		echo '<link rel="alternate" hreflang="en" href="' . esc_url( $en ) . '">' . "\n";
		echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $fr ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'andonick_seo_lang_links', 1 );

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
 * Registre privé des demandes : une demande reste visible dans WordPress
 * même lorsqu'un service SMTP est indisponible.
 */
function andonick_register_leads() {
	register_post_type( 'andonick_lead', array(
		'labels' => array(
			'name'          => 'Demandes du site',
			'singular_name' => 'Demande du site',
			'menu_name'     => 'Demandes',
		),
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'exclude_from_search' => true,
		'supports'           => array( 'title', 'editor' ),
		'menu_icon'          => 'dashicons-email-alt',
		/* Les demandes peuvent contenir des données personnelles : elles sont
		 * réservées aux administrateurs, pas aux auteurs et éditeurs. */
		'capabilities'       => array(
			'edit_post'          => 'manage_options',
			'read_post'          => 'manage_options',
			'delete_post'        => 'manage_options',
			'edit_posts'         => 'manage_options',
			'edit_others_posts'  => 'manage_options',
			'delete_posts'       => 'manage_options',
			'delete_private_posts' => 'manage_options',
			'edit_private_posts' => 'manage_options',
			'read_private_posts' => 'manage_options',
			'publish_posts'      => 'manage_options',
			'create_posts'       => 'do_not_allow',
		),
		'map_meta_cap'       => false,
	) );
}
add_action( 'init', 'andonick_register_leads' );

/**
 * Retourne le message de confirmation à afficher après un formulaire.
 */
function andonick_form_feedback() {
	$status = isset( $_GET['andonick_form'] ) ? sanitize_key( wp_unslash( $_GET['andonick_form'] ) ) : '';
	if ( 'saved' === $status ) {
		return andonick_t( 'form_saved_msg' );
	}
	if ( 'error' === $status ) {
		return andonick_t( 'form_error_msg' );
	}
	if ( 'sent' === $status ) {
		return andonick_t( 'toast_msg' );
	}
	return '';
}

/**
 * Redirige le visiteur vers le formulaire, avec un état lisible.
 */
function andonick_form_redirect( $status ) {
	$referer = wp_get_referer();
	$url     = $referer ? $referer : home_url( '/' );
	$url     = strtok( $url, '#' );
	$url     = add_query_arg( 'andonick_form', sanitize_key( $status ), remove_query_arg( 'andonick_form', $url ) );
	wp_safe_redirect( $url . '#devis' );
	exit;
}

/**
 * Gestion des formulaires (devis / rappel) — admin-post.
 * Les champs sont définis sans code : « Formulaires & listes » dans le
 * Customizer. Le nom de chaque champ est andonick_f{index} ; la validation
 * porte sur les lignes marquées obligatoires (|1).
 */
function andonick_handle_form() {
	$nonce_ok = isset( $_POST['andonick_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['andonick_nonce'] ) ), 'andonick_contact' );
	if ( ! $nonce_ok ) {
		andonick_form_redirect( 'error' );
	}

	// Honeypot anti-spam : si rempli, on ignore silencieusement.
	if ( ! empty( $_POST['andonick_website'] ) ) {
		andonick_form_redirect( 'sent' );
	}

	$lang = ( isset( $_POST['andonick_lang'] ) && 'en' === sanitize_key( wp_unslash( $_POST['andonick_lang'] ) ) ) ? 'en' : 'fr';
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
		if ( strlen( $value ) > 3000 || ( 'email' === $field['type'] && '' !== $value && ! is_email( $value ) ) ) {
			$ok = false;
			continue;
		}
		if ( 'select' === $field['type'] && '' !== $value ) {
			$options = ( 'slots' === $field['options'] ) ? andonick_slots() : andonick_services();
			if ( ! in_array( $value, $options, true ) ) {
				$ok = false;
				continue;
			}
		}
		if ( $field['required'] && '' === $value ) {
			$ok = false;
			continue;
		}
		if ( '' !== $value ) {
			$lines[] = $field['label'] . ' : ' . $value;
		}
	}

	if ( ! $ok ) {
		andonick_form_redirect( 'error' );
	}

	$body  = 'Demande [' . $kind . '] — Site web (langue ' . $labels[ $lang ] . ')' . "\n\n";
	$body .= implode( "\n", $lines );
	$body .= "\n\nEnvoyé depuis : " . esc_url_raw( wp_get_referer() );

	$lead_id = wp_insert_post( array(
		'post_type'    => 'andonick_lead',
		'post_status'  => 'private',
		'post_title'   => sprintf( '%s — %s', $kind, current_time( 'Y-m-d H:i' ) ),
		'post_content' => $body,
	) );
	if ( ! is_wp_error( $lead_id ) && $lead_id ) {
		update_post_meta( $lead_id, '_andonick_lead_language', $lang );
		update_post_meta( $lead_id, '_andonick_lead_type', $type );
	}

	$mail_sent = wp_mail(
		andonick_t_lang( 'contact_mail', $lang ),
		'[ANDONICK] Nouvelle demande ' . $kind . ' (' . $labels[ $lang ] . ')',
		$body
	);

	/* Copie de confirmation au visiteur (si activé ET une adresse e-mail valide
	 * a été saisie dans un champ de type email). */
	if ( '1' === get_theme_mod( 'andonick_forms_copy', '0' ) ) {
		$visitor_email = '';
		foreach ( $config as $i => $field ) {
			if ( 'email' === $field['type'] && ! empty( $_POST[ 'andonick_f' . $i ] ) ) {
				$visitor_email = sanitize_email( wp_unslash( $_POST[ 'andonick_f' . $i ] ) );
				if ( '' !== $visitor_email ) {
					break;
				}
			}
		}
		if ( '' !== $visitor_email ) {
			wp_mail(
				$visitor_email,
				andonick_t_lang( 'form_copy_subject', $lang ),
				andonick_t_lang( 'form_copy_body', $lang ) . "\n\n" . implode( "\n", $lines )
			);
		}
	}

	andonick_form_redirect( ( ! is_wp_error( $lead_id ) && $lead_id ) ? ( $mail_sent ? 'sent' : 'saved' ) : 'error' );
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
