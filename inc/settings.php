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

	/* ---- Section images (commune) ---- */
	$wp_customize->add_section( 'andonick_images', array(
		'title' => 'Images (photos du site)',
		'panel' => 'andonick_panel',
	) );
	andonick_cz_image( $wp_customize, 'hero', ANDONICK_URI . '/assets/img/hero.jpg', 'Photo du haut de page (hero)', 'andonick_images' );
	andonick_cz_image( $wp_customize, 'group', ANDONICK_URI . '/assets/img/domaines.jpg', 'Photo section « Le Groupe »', 'andonick_images' );
	andonick_cz_image( $wp_customize, 'impact', ANDONICK_URI . '/assets/img/impact.jpg', 'Photo fond section « Impact »', 'andonick_images' );
	$gallery_defaults = array( 'hero.jpg', 'domaines.jpg', 'impact.jpg', 'photo-07.jpg', 'photo-08.jpg', 'photo-11.jpg' );
	foreach ( $gallery_defaults as $gi => $file ) {
		andonick_cz_image( $wp_customize, 'gallery_' . ( $gi + 1 ), ANDONICK_URI . '/assets/img/' . $file, 'Galerie — photo ' . ( $gi + 1 ), 'andonick_images' );
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
			'title' => "Les 8 métiers — $label",
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

		/* Les 8 métiers */
		foreach ( $content[ $lang ]['filiales'] as $i => $f ) {
			andonick_cz_text( $wp_customize, $lang, "filiales_{$i}_num", $f['num'], $sec_filiales );
			andonick_cz_text( $wp_customize, $lang, "filiales_{$i}_title", $f['title'], $sec_filiales );
			andonick_cz_textarea( $wp_customize, $lang, "filiales_{$i}_desc", $f['desc'], $sec_filiales, "Métier " . ( $i + 1 ) . ' — description' );
			andonick_cz_textarea( $wp_customize, $lang, "filiales_{$i}_tags", implode( "\n", $f['tags'] ), $sec_filiales, "Métier " . ( $i + 1 ) . ' — étiquettes' );
		}

		/* Témoignages */
		foreach ( $content[ $lang ]['testis'] as $i => $t ) {
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

		/* Impacts et listes */
		foreach ( $content[ $lang ]['impacts'] as $i => $imp ) {
			andonick_cz_text( $wp_customize, $lang, "impacts_{$i}_title", $imp[0], $sec_struct );
			andonick_cz_text( $wp_customize, $lang, "impacts_{$i}_desc", $imp[1], $sec_struct );
		}
		andonick_cz_textarea( $wp_customize, $lang, 'partners', implode( "\n", $content[ $lang ]['partners'] ), $sec_struct, 'Partenaires institutionnels' );
		andonick_cz_textarea( $wp_customize, $lang, 'services', implode( "\n", $content[ $lang ]['services'] ), $sec_struct, 'Liste déroulante « Filiale / service concerné »' );
		andonick_cz_textarea( $wp_customize, $lang, 'slots', implode( "\n", $content[ $lang ]['slots'] ), $sec_struct, 'Créneaux de rappel' );

		/* Les statistiques (numéros) sont enregistrées comme textes simples
		   via la boucle des scalaires (stat1_num, stat2_num, stat3_num). */
	}
}
add_action( 'customize_register', 'andonick_customize_register' );