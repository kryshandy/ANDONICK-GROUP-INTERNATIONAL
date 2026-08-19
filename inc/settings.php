<?php
/**
 * ANDONICK — Réglages du thème : tout le contenu éditable depuis
 * Apparence → Personnaliser, sans toucher au code.
 *
 * Deux langues (FR/EN), textes, listes, témoignages, images.
 * Les valeurs par défaut proviennent de inc/content.php.
 *
 * @package Andonick
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enregistre un champ texte simple dans le Customizer.
 */
function andonick_cz_text( $wp_customize, $lang, $key, $default, $section ) {
	$wp_customize->add_setting( "andonick_{$lang}_{$key}", array(
		'default'           => $default,
		'sanitize_callback' => 'wp_kses_post',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( "andonick_{$lang}_{$key}", array(
		'label'   => str_replace( '_', ' ', $key ),
		'section' => $section,
		'type'    => 'text',
	) );
}

/**
 * Enregistre un champ zone de texte (texte long ou liste 1 ligne = 1 élément).
 */
function andonick_cz_textarea( $wp_customize, $lang, $key, $default, $section, $label = '' ) {
	$wp_customize->add_setting( "andonick_{$lang}_{$key}", array(
		'default'           => $default,
		'sanitize_callback' => 'sanitize_textarea_field',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( "andonick_{$lang}_{$key}", array(
		'label'       => $label ? $label : str_replace( '_', ' ', $key ),
		'description' => 'Une ligne = un élément',
		'section'     => $section,
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 6 ),
	) );
}

/**
 * Enregistre un sélecteur d'image dans le Customizer.
 */
function andonick_cz_image( $wp_customize, $key, $default, $label, $section ) {
	$wp_customize->add_setting( "andonick_img_{$key}", array(
		'default'           => $default,
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "andonick_img_{$key}", array(
		'label'       => $label,
		'section'     => $section,
		'settings'    => "andonick_img_{$key}",
	) ) );
}

/**
 * Filet de sécurité pour l'ordre des sections : uniquement des noms connus,
 * uniques, sans doublon.
 */
function andonick_sanitize_section_order( $input ) {
	$allowed = array( 'hero', 'groupe', 'filiales', 'impact', 'actualites', 'realisations', 'references', 'contact' );
	$order   = array();
	foreach ( explode( "\n", $input ) as $line ) {
		$item = sanitize_key( trim( $line ) );
		if ( in_array( $item, $allowed, true ) && ! in_array( $item, $order, true ) ) {
			$order[] = $item;
		}
	}
	return empty( $order ) ? implode( "\n", $allowed ) : implode( "\n", $order );
}

/**
 * Enregistrement de tous les réglages.
 */
function andonick_customize_register( $wp_customize ) {
	$content = andonick_content();

	/* ---- Panneau principal ---- */
	$wp_customize->add_panel( 'andonick_panel', array(
		'title'       => 'ANDONICK — Contenu du site',
		'description' => 'Modifiez ici tout le contenu du site (textes, listes, images) sans toucher au code. Sauvegardez = publié.',
		'priority'    => 20,
	) );

	/* ---- Section structure & ordre (commune, pas par langue) ---- */
	$wp_customize->add_section( 'andonick_structure', array(
		'title'       => 'Structure & Ordre des sections',
		'description' => 'Ordre d\'affichage des sections de la page d\'accueil. Une ligne = une section. Retirez une ligne pour masquer la section.',
		'panel'       => 'andonick_panel',
	) );
	$wp_customize->add_setting( 'andonick_section_order', array(
		'default'           => "hero\ngroupe\nfiliales\nimpact\nactualites\nrealisations\nreferences\ncontact",
		'sanitize_callback' => 'andonick_sanitize_section_order',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_section_order', array(
		'label'       => 'Ordre des sections',
		'description' => 'Noms possibles : hero, groupe, filiales, impact, actualites, realisations, references, contact (la section actualites ne s\'affiche que si des articles existent)',
		'section'     => 'andonick_structure',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 9 ),
	) );

	/* ---- Section images (commune) ---- */
	$wp_customize->add_section( 'andonick_images', array(
		'title' => 'Images (photos du site)',
		'panel' => 'andonick_panel',
	) );
	andonick_cz_image( $wp_customize, 'hero', ANDONICK_URI . '/assets/img/hero.jpg', 'Photo du haut de page (hero)', 'andonick_images' );
	andonick_cz_image( $wp_customize, 'group', ANDONICK_URI . '/assets/img/domaines.jpg', 'Photo section « Le Groupe »', 'andonick_images' );
	andonick_cz_image( $wp_customize, 'impact', ANDONICK_URI . '/assets/img/impact.jpg', 'Photo fond section « Impact »', 'andonick_images' );
	$gallery_defaults = array( 'hero.jpg', 'photo-10.jpg', 'impact.jpg', 'photo-07.jpg', 'photo-08.jpg', 'photo-11.jpg' );
	foreach ( $gallery_defaults as $gi => $file ) {
		andonick_cz_image( $wp_customize, 'gallery_' . ( $gi + 1 ), ANDONICK_URI . '/assets/img/' . $file, 'Galerie — photo ' . ( $gi + 1 ), 'andonick_images' );
	}
	for ( $gi = 7; $gi <= 12; $gi++ ) {
		andonick_cz_image( $wp_customize, 'gallery_' . $gi, '', 'Galerie — photo ' . $gi . ' (vide = non affichée)', 'andonick_images' );
	}

	/* ---- Sections par langue ---- */
	foreach ( array( 'fr' => 'Français', 'en' => 'English' ) as $lang => $label ) {
		$sec_texts   = "andonick_texts_{$lang}";
		$sec_filiales = "andonick_filiales_{$lang}";
		$sec_testis  = "andonick_testis_{$lang}";
		$sec_struct  = "andonick_struct_{$lang}";

		$wp_customize->add_section( $sec_texts, array(
			'title' => "Textes principaux — $label",
			'panel' => 'andonick_panel',
		) );
		$wp_customize->add_section( $sec_filiales, array(
			'title' => "Les métiers — $label",
			'panel' => 'andonick_panel',
		) );
		$wp_customize->add_section( $sec_testis, array(
			'title' => "Témoignages & Références — $label",
			'panel' => 'andonick_panel',
		) );
		$wp_customize->add_section( $sec_struct, array(
			'title' => "Formulaires & listes — $label",
			'panel' => 'andonick_panel',
		) );

		/* Textes simples (scalaires) */
		$nice_labels = array(
			'hero_title_main'   => 'Héros — grand titre (partie principale)',
			'hero_title_tail'   => 'Héros — fin du grand titre (en violet)',
			'hero_cta1_href'    => 'Lien du 1er bouton du haut de page (ex. #devis)',
			'hero_cta2_href'    => 'Lien du 2e bouton du haut de page (ex. #filiales)',
			'nav_group_href'    => 'Lien du menu « Le Groupe » (ex. #groupe)',
			'nav_filiales_href' => 'Lien du menu « Filiales » (ex. #filiales)',
			'nav_impact_href'   => 'Lien du menu « Impact » (ex. #impact)',
			'nav_refs_href'     => 'Lien du menu « Références » (ex. #references)',
			'nav_contact_href'  => 'Lien du menu « Contact » (ex. #contact)',
			'nav_devis_href'    => 'Lien du bouton « Demander un devis » (ex. #devis)',
			'contact_mail'      => 'E-mail de contact (affiché + destinataire des demandes)',
		);
		foreach ( $content[ $lang ] as $key => $value ) {
			if ( is_array( $value ) || in_array( $key, array( 'filiales', 'services', 'impacts', 'testis', 'ref_headers', 'refs', 'partners', 'slots' ), true ) ) {
				continue;
			}
			$is_long = in_array( $key, array( 's2_body', 'hero_lead', 'impact_body', 'contact_sub', 'f_disc_devis', 'f_disc_rappel', 'foot_tag', 'contact_addr' ), true );
			if ( $is_long ) {
				andonick_cz_textarea( $wp_customize, $lang, $key, $value, $sec_texts );
			} else {
				andonick_cz_text( $wp_customize, $lang, $key, $value, $sec_texts );
			}
		}
		/* Libellés lisibles pour certains champs techniques. */
		foreach ( $nice_labels as $key => $label ) {
			$setting_id = "andonick_{$lang}_{$key}";
			$control    = $wp_customize->get_control( $setting_id );
			if ( $control ) {
				$control->label = $label;
			}
		}
		/* Listes : valeurs du Groupe et bandes du haut de page (1 ligne = 1 élément). */
		andonick_cz_textarea( $wp_customize, $lang, 'values', implode( "\n", $content[ $lang ]['values'] ), $sec_texts, 'Le Groupe — valeurs (1 par ligne)' );
		andonick_cz_textarea( $wp_customize, $lang, 'strip', implode( "\n", $content[ $lang ]['strip'] ), $sec_texts, 'Bandes du haut de page (1 par ligne)' );
		andonick_cz_textarea( $wp_customize, $lang, 'stats', implode( "\n", $content[ $lang ]['stats'] ), $sec_texts, 'Statistiques du haut de page (1 par ligne : Nombre|Libellé — vide = non affichée)' );
		andonick_cz_textarea( $wp_customize, $lang, 'socials', implode( "\n", $content[ $lang ]['socials'] ), $sec_texts, 'Réseaux sociaux (1 par ligne : Nom|URL — vide = aucun lien affiché)' );
		andonick_cz_textarea( $wp_customize, $lang, 'map_dir', $content[ $lang ]['map_dir'], $sec_texts, 'Adresse affichée sur la carte (bloc Contact)' );

		/* Les métiers — 12 emplacements (8 remplis par défaut, 4 vides pour la suite) */
		for ( $i = 0; $i < 12; $i++ ) {
			$f = isset( $content[ $lang ]['filiales'][ $i ] ) ? $content[ $lang ]['filiales'][ $i ] : array( 'num' => '', 'title' => '', 'desc' => '', 'tags' => array() );
			andonick_cz_text( $wp_customize, $lang, "filiales_{$i}_num", $f['num'], $sec_filiales );
			andonick_cz_text( $wp_customize, $lang, "filiales_{$i}_title", $f['title'], $sec_filiales );
			andonick_cz_textarea( $wp_customize, $lang, "filiales_{$i}_desc", $f['desc'], $sec_filiales, 'Métier ' . ( $i + 1 ) . ' — description' );
			andonick_cz_textarea( $wp_customize, $lang, "filiales_{$i}_tags", implode( "\n", $f['tags'] ), $sec_filiales, 'Métier ' . ( $i + 1 ) . ' — étiquettes' );
		}

		/* Témoignages — 6 emplacements */
		for ( $i = 0; $i < 6; $i++ ) {
			$t = isset( $content[ $lang ]['testis'][ $i ] ) ? $content[ $lang ]['testis'][ $i ] : array( '', '', '' );
			andonick_cz_textarea( $wp_customize, $lang, "testis_{$i}_quote", $t[0], $sec_testis, 'Témoignage ' . ( $i + 1 ) . ' — citation' );
			andonick_cz_text( $wp_customize, $lang, "testis_{$i}_name", $t[1], $sec_testis );
			andonick_cz_text( $wp_customize, $lang, "testis_{$i}_role", $t[2], $sec_testis );
		}

		/* Références : 1 ligne = Catégorie|Nom|Fonction|Téléphone */
		$refs_default = array();
		foreach ( $content[ $lang ]['refs'] as $r ) {
			$refs_default[] = implode( ' | ', $r );
		}
		andonick_cz_textarea( $wp_customize, $lang, 'refs_rows', implode( "\n", $refs_default ), $sec_testis, 'Références (1 par ligne : Catégorie | Nom | Fonction | Téléphone)' );
		andonick_cz_textarea( $wp_customize, $lang, 'ref_headers', implode( "\n", $content[ $lang ]['ref_headers'] ), $sec_testis, 'En-têtes du tableau références' );

		/* Impacts — 8 emplacements */
		for ( $i = 0; $i < 8; $i++ ) {
			$imp = isset( $content[ $lang ]['impacts'][ $i ] ) ? $content[ $lang ]['impacts'][ $i ] : array( '', '' );
			andonick_cz_text( $wp_customize, $lang, "impacts_{$i}_title", $imp[0], $sec_struct );
			andonick_cz_text( $wp_customize, $lang, "impacts_{$i}_desc", $imp[1], $sec_struct );
		}
		andonick_cz_textarea( $wp_customize, $lang, 'partners', implode( "\n", $content[ $lang ]['partners'] ), $sec_struct, 'Partenaires institutionnels' );
		andonick_cz_textarea( $wp_customize, $lang, 'services', implode( "\n", $content[ $lang ]['services'] ), $sec_struct, 'Liste déroulante « Filiale / service concerné »' );
		andonick_cz_textarea( $wp_customize, $lang, 'slots', implode( "\n", $content[ $lang ]['slots'] ), $sec_struct, 'Créneaux de rappel' );
	}

	/* ---- Pages légales du pied de page (communes) ---- */
	$wp_customize->add_section( 'andonick_legal', array(
		'title' => 'Pages légales & Actualités',
		'panel' => 'andonick_panel',
	) );
	$wp_customize->add_setting( 'andonick_news_enabled', array(
		'default'           => '1',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array( '1', '0' ), '1' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_news_enabled', array(
		'label'       => 'Afficher la section « Actualités » (articles WordPress)',
		'description' => 'La section n\'apparaît que si la case est activée ET si au moins un article est publié. Créez vos articles dans « Articles → Ajouter » (sans code, éditeur visuel).',
		'section'     => 'andonick_legal',
		'type'        => 'select',
		'choices'     => array( '1' => 'Activée', '0' => 'Désactivée' ),
	) ) ;
	for ( $n = 1; $n <= 3; $n++ ) {
		$wp_customize->add_setting( 'andonick_legal_page_' . $n, array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'type'              => 'theme_mod',
		) );
		$wp_customize->add_control( 'andonick_legal_page_' . $n, array(
			'label'       => 'Lien de pied de page n°' . $n . ' (page WordPress)',
			'description' => 'Choisissez « Aucune » pour ne pas afficher ce lien. Créez vos pages dans « Pages → Ajouter » (ex. Mentions légales, Politique de confidentialité).',
			'section'     => 'andonick_legal',
			'type'        => 'dropdown-pages',
		) );
	}

	/* Libellés lisibles supplémentaires (après boucle, toutes langues). */
	$nice_labels = array(
		'map_embed'     => 'Carte (lien d\'intégration Google Maps) — laisser vide pour masquer la carte',
		'map_url'       => 'Lien externe de la carte (optionnel)',
		'map_lien'      => 'Texte du bouton « Voir sur la carte »',
		'news_eyebrow'  => 'Actualités — petit titre',
		'news_title'    => 'Actualités — grand titre',
		'news_sub'      => 'Actualités — sous-titre (facultatif)',
		'news_more'     => 'Actualités — texte du lien « Lire la suite »',
		'news_count'    => 'Actualités — nombre d\'articles affichés',
	);
	foreach ( array( 'fr', 'en' ) as $lang ) {
		foreach ( $nice_labels as $key => $label ) {
			$control = $wp_customize->get_control( "andonick_{$lang}_{$key}" );
			if ( $control ) {
				$control->label = $label;
			}
		}
	}
}
add_action( 'customize_register', 'andonick_customize_register' );