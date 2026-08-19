<?php
/**
 * ANDONICK — Apparence & Styles.
 *
 * Personnalisation VISUELLE du site depuis WordPress, sans code :
 * couleurs, polices, alignements, espacements, positions, arrière-plans.
 * Les valeurs sont injectées dans la page via wp_add_inline_style
 * (variables CSS + quelques règles ciblées), après la feuille de style.
 *
 * Panneau : Apparence → Personnaliser → ANDONICK — Apparence & Styles.
 * Tout reste dans la charte par défaut ; les réglages sont assainis
 * (couleurs hex valides, listes blanches, nombres bornés).
 *
 * @package Andonick
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Valeur d'un réglage d'apparence.
 */
function andonick_ap( $key, $default = '' ) {
	return get_theme_mod( 'andonick_ap_' . $key, $default );
}

/**
 * Assainit une couleur hexadécimale (vide si invalide).
 */
function andonick_ap_sanitize_hex( $value ) {
	return sanitize_hex_color( $value );
}

/**
 * Assainit une opacité (0.00 – 1.00).
 */
function andonick_ap_sanitize_opacity( $value ) {
	$f = (float) str_replace( ',', '.', $value );
	$f = max( 0.00, min( 1.00, $f ) );
	return sprintf( '%.2f', $f );
}

/**
 * Assainit un nombre entier borné.
 */
function andonick_ap_sanitize_int( $value, $min, $max, $default ) {
	$i = absint( $value );
	return ( $i >= $min && $i <= $max ) ? $i : $default;
}

/**
 * Assainit un choix parmi une liste blanche.
 */
function andonick_ap_sanitize_choice( $value, $choices, $default ) {
	return in_array( $value, $choices, true ) ? $value : $default;
}

/**
 * URL d'une image de fond de section (facultative).
 */
function andonick_ap_bg( $key ) {
	$mod = get_theme_mod( 'andonick_ap_bg_' . $key, '' );
	return ( '' !== $mod ) ? esc_url_raw( $mod ) : '';
}

/**
 * Feuille de style injectée : variables CSS + règles de positionnement.
 */
function andonick_appearance_css() {
	$font_choices  = array(
		'Segoe UI, Arial, sans-serif',
		'Georgia, "Times New Roman", serif',
		'"Trebuchet MS", Segoe UI, sans-serif',
		'Arial, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif',
	);
	$font          = andonick_ap( 'font', $font_choices[0] );
	$font_heading  = andonick_ap( 'font_heading', $font );
	$size          = andonick_ap_sanitize_int( andonick_ap( 'font_size', '16' ), 14, 18, 16 );
	$primary       = andonick_ap_sanitize_hex( andonick_ap( 'color_primary', '#461491' ) );
	$primary_dark  = andonick_ap_sanitize_hex( andonick_ap( 'color_primary_dark', '#2A0A63' ) );
	$text          = andonick_ap_sanitize_hex( andonick_ap( 'color_text', '#333333' ) );
	$page_bg       = andonick_ap_sanitize_hex( andonick_ap( 'color_page_bg', '#FFFFFF' ) );
	$tint          = andonick_ap_sanitize_hex( andonick_ap( 'color_tint', '#F5F1FB' ) );
	$topbar_bg     = andonick_ap_sanitize_hex( andonick_ap( 'color_topbar_bg', '#2A0A63' ) );
	$footer_bg     = andonick_ap_sanitize_hex( andonick_ap( 'color_footer_bg', '#2A0A63' ) );
	$titles        = andonick_ap_sanitize_hex( andonick_ap( 'color_titles', '#461491' ) );
	$width         = andonick_ap_sanitize_int( andonick_ap( 'container_width', '1200' ), 1100, 1280, 1200 );
	$pad           = andonick_ap_sanitize_int( andonick_ap( 'section_pad', '96' ), 60, 120, 96 );
	$gal           = andonick_ap_sanitize_int( andonick_ap( 'gallery_cols', '3' ), 2, 4, 3 );
	$radius        = andonick_ap_sanitize_int( andonick_ap( 'radius', '12' ), 0, 16, 12 );
	$hero_h        = andonick_ap_sanitize_int( andonick_ap( 'hero_height', '90' ), 80, 100, 90 );
	$hero_align    = andonick_ap_sanitize_choice( andonick_ap( 'hero_align', 'center' ), array( 'center', 'left', 'right' ), 'center' );
	$header_fixed  = andonick_ap_sanitize_choice( andonick_ap( 'header_fixed', '1' ), array( '1', '0' ), '1' );
	$hero_op       = andonick_ap_sanitize_opacity( andonick_ap( 'hero_opacity', '0.24' ) );
	$impact_op     = andonick_ap_sanitize_opacity( andonick_ap( 'impact_opacity', '0.16' ) );
	$hero_pad      = array( '80' => '72px', '90' => '92px', '100' => '120px' );
	$justify       = array( 'center' => 'center', 'left' => 'flex-start', 'right' => 'flex-end' );

	$css  = ':root{';
	$css .= '--violet:' . $primary . ';';
	$css .= '--violet-dark:' . $primary_dark . ';';
	$css .= '--grey:' . $text . ';';
	$css .= '--white:' . $page_bg . ';';
	$css .= '--violet-tint:' . $tint . ';';
	$css .= '--titles:' . $titles . ';';
	$css .= '--radius:' . $radius . 'px;';
	$css .= '--radius-sm:' . $radius . 'px;';
	$css .= '--font:' . $font . ';';
	$css .= '--font-heading:' . $font_heading . ';';
	$css .= '--container-w:' . $width . 'px;';
	$css .= '--section-pad:' . $pad . 'px;';
	$css .= '--gal-col:' . $gal . ';';
	$css .= '}';

	$css .= 'body{font-size:' . $size . 'px;}';
	$css .= 'h1,h2,h3,h4,h5,.eyebrow{font-family:var(--font-heading);}';
	$css .= 'h2,h3,h4{color:var(--titles);}';
	$css .= '.container{max-width:var(--container-w);}';
	$css .= '.section{padding-top:var(--section-pad);padding-bottom:var(--section-pad);}';
	$css .= '.gallery-grid{columns:var(--gal-col);}';
	$css .= '.topbar{background:' . $topbar_bg . ';}';
	$css .= '.site-footer{background:' . $footer_bg . ';}';
	$css .= '.hero{min-height:' . $hero_h . 'vh;}';
	$css .= '.hero-inner{padding-top:' . $hero_pad[ $hero_h ] . ';padding-bottom:' . $hero_pad[ $hero_h ] . ';text-align:' . $hero_align . ';}';
	$css .= '.hero-cta{justify-content:' . $justify[ $hero_align ] . ';}';
	$css .= '.hero-bg{opacity:' . $hero_op . ';}';
	$css .= '.impact-bg{opacity:' . $impact_op . ';}';
	if ( '0' === $header_fixed ) {
		$css .= '.site-header{position:static;}';
	}

	// Images de fond facultatives des sections (fine surimpression blanche).
	$bg_sections = array(
		'groupe'    => '.section-group',
		'filiales'  => '.section-filiales',
		'references'=> '.section-refs',
		'contact'   => '.section-contact',
	);
	foreach ( $bg_sections as $key => $selector ) {
		$url = andonick_ap_bg( $key );
		if ( '' !== $url ) {
			$css .= $selector . '{background-image:linear-gradient(rgba(255,255,255,0.94),rgba(255,255,255,0.94)),url("' . $url . '");background-size:cover;background-position:center;}';
		}
	}
	return $css;
}

/**
 * Enregistrement du panneau « Apparence & Styles ».
 */
function andonick_customize_appearance( $wp_customize ) {

	$wp_customize->add_panel( 'andonick_appearance', array(
		'title'       => 'ANDONICK — Apparence & Styles',
		'description' => 'Couleurs, polices, alignements, espacements, positions et arrière-plans du site — sans toucher au code. Les valeurs par défaut respectent la charte officielle.',
		'priority'    => 21,
	) );

	/* ---------------- Couleurs ---------------- */
	$wp_customize->add_section( 'andonick_ap_colors', array(
		'title' => 'Couleurs (charte)',
		'panel' => 'andonick_appearance',
	) );
	$colors = array(
		'color_primary'     => array( '#461491', 'Couleur principale (boutons, liens, titres)' ),
		'color_primary_dark'=> array( '#2A0A63', 'Couleur principale foncée (fond topbar, pied de page, survols)' ),
		'color_text'        => array( '#333333', 'Couleur du texte courant' ),
		'color_titles'      => array( '#461491', 'Couleur des titres de sections' ),
		'color_page_bg'     => array( '#FFFFFF', 'Fond de la page' ),
		'color_tint'        => array( '#F5F1FB', 'Fond des encadrés (puces, cartes claires)' ),
		'color_topbar_bg'   => array( '#2A0A63', 'Fond de la barre du haut' ),
		'color_footer_bg'   => array( '#2A0A63', 'Fond du pied de page' ),
	);
	foreach ( $colors as $key => $data ) {
		$wp_customize->add_setting( 'andonick_ap_' . $key, array(
			'default'           => $data[0],
			'sanitize_callback' => 'andonick_ap_sanitize_hex',
			'type'              => 'theme_mod',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'andonick_ap_' . $key, array(
			'label'   => $data[1],
			'section' => 'andonick_ap_colors',
			'settings'=> 'andonick_ap_' . $key,
		) ) );
	}

	/* ---------------- Typographie & alignements ---------------- */
	$wp_customize->add_section( 'andonick_ap_typo', array(
		'title' => 'Polices & alignements',
		'panel' => 'andonick_appearance',
	) );
	$fonts = array(
		'Segoe UI, Arial, sans-serif'                       => 'Segoe UI (par défaut)',
		'Georgia, "Times New Roman", serif'                 => 'Georgia (serif élégant)',
		'"Trebuchet MS", Segoe UI, sans-serif'              => 'Trebuchet MS',
		'Arial, Helvetica, sans-serif'                      => 'Arial',
		'Verdana, Geneva, sans-serif'                       => 'Verdana',
	);
	$wp_customize->add_setting( 'andonick_ap_font', array(
		'default'           => 'Segoe UI, Arial, sans-serif',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array_keys( array(
				'Segoe UI, Arial, sans-serif' => 1, 'Georgia, "Times New Roman", serif' => 1,
				'"Trebuchet MS", Segoe UI, sans-serif' => 1, 'Arial, Helvetica, sans-serif' => 1,
				'Verdana, Geneva, sans-serif' => 1,
			) ), 'Segoe UI, Arial, sans-serif' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_font', array(
		'label'   => 'Police générale du site',
		'section' => 'andonick_ap_typo',
		'type'    => 'select',
		'choices' => $fonts,
	) );
	$wp_customize->add_setting( 'andonick_ap_font_heading', array(
		'default'           => '',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array(
				'', 'Segoe UI, Arial, sans-serif', 'Georgia, "Times New Roman", serif',
				'"Trebuchet MS", Segoe UI, sans-serif', 'Arial, Helvetica, sans-serif',
				'Verdana, Geneva, sans-serif',
			), '' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_font_heading', array(
		'label'   => 'Police des titres (vide = même que la générale)',
		'section' => 'andonick_ap_typo',
		'type'    => 'select',
		'choices' => array( '' => 'Comme la police générale' ) + $fonts,
	) );
	$wp_customize->add_setting( 'andonick_ap_font_size', array(
		'default'           => '16',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 14, 18, 16 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_font_size', array(
		'label'   => 'Taille de base du texte',
		'section' => 'andonick_ap_typo',
		'type'    => 'select',
		'choices' => array( '14' => '14 px (compact)', '15' => '15 px', '16' => '16 px (par défaut)', '17' => '17 px', '18' => '18 px (confortable)' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_hero_align', array(
		'default'           => 'center',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array( 'center', 'left', 'right' ), 'center' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_hero_align', array(
		'label'   => 'Alignement du haut de page (texte + boutons)',
		'section' => 'andonick_ap_typo',
		'type'    => 'select',
		'choices' => array( 'center' => 'Centré', 'left' => 'À gauche', 'right' => 'À droite' ),
	) );

	/* ---------------- Mise en page & positions ---------------- */
	$wp_customize->add_section( 'andonick_ap_layout', array(
		'title' => 'Mise en page & positions',
		'panel' => 'andonick_appearance',
	) );
	$wp_customize->add_setting( 'andonick_ap_container_width', array(
		'default'           => '1200',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 1100, 1280, 1200 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_container_width', array(
		'label'   => 'Largeur du contenu',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '1100' => '1100 px (étroit)', '1200' => '1200 px (par défaut)', '1280' => '1280 px (large)' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_section_pad', array(
		'default'           => '96',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 60, 120, 96 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_section_pad', array(
		'label'   => 'Espacement vertical entre les sections',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '60' => '60 px (compact)', '80' => '80 px', '96' => '96 px (par défaut)', '120' => '120 px (aéré)' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_hero_height', array(
		'default'           => '90',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 80, 100, 90 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_hero_height', array(
		'label'   => 'Hauteur du haut de page',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '80' => '80 % écran', '90' => '90 % écran (par défaut)', '100' => '100 % écran' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_gallery_cols', array(
		'default'           => '3',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 2, 4, 3 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_gallery_cols', array(
		'label'   => 'Nombre de colonnes de la galerie',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '2' => '2 colonnes', '3' => '3 colonnes (par défaut)', '4' => '4 colonnes' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_radius', array(
		'default'           => '12',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 0, 16, 12 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_radius', array(
		'label'   => 'Coins arrondis des cartes',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '0' => 'Angles droits', '8' => '8 px', '12' => '12 px (par défaut)', '16' => '16 px (très arrondi)' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_header_fixed', array(
		'default'           => '1',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array( '1', '0' ), '1' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_header_fixed', array(
		'label'   => 'Menu fixe en haut de l\'écran',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '1' => 'Oui — menu fixe (par défaut)', '0' => 'Non — menu qui défile avec la page' ),
	) );

	/* ---------------- Arrière-plans ---------------- */
	$wp_customize->add_section( 'andonick_ap_bg', array(
		'title' => 'Arrière-plans & images de fond',
		'panel' => 'andonick_appearance',
	) );
	$wp_customize->add_setting( 'andonick_ap_hero_opacity', array(
		'default'           => '0.24',
		'sanitize_callback' => 'andonick_ap_sanitize_opacity',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_hero_opacity', array(
		'label'       => 'Visibilité de la photo du haut de page',
		'section'     => 'andonick_ap_bg',
		'type'        => 'range',
		'input_attrs' => array( 'min' => 0.05, 'max' => 0.5, 'step' => 0.01 ),
	) );
	$wp_customize->add_setting( 'andonick_ap_impact_opacity', array(
		'default'           => '0.16',
		'sanitize_callback' => 'andonick_ap_sanitize_opacity',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_impact_opacity', array(
		'label'       => 'Visibilité de la photo de la section Impact',
		'section'     => 'andonick_ap_bg',
		'type'        => 'range',
		'input_attrs' => array( 'min' => 0.05, 'max' => 0.35, 'step' => 0.01 ),
	) );
	$bg_labels = array(
		'groupe'     => 'Image de fond de la section « Le Groupe » (facultative)',
		'filiales'   => 'Image de fond de la section « Les métiers » (facultative)',
		'references' => 'Image de fond de la section « Références » (facultative)',
		'contact'    => 'Image de fond de la section « Contact » (facultative)',
	);
	foreach ( $bg_labels as $key => $label ) {
		$wp_customize->add_setting( 'andonick_ap_bg_' . $key, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'type'              => 'theme_mod',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'andonick_ap_bg_' . $key, array(
			'label'       => $label,
			'description' => 'Laisser vide pour un fond uni.',
			'section'     => 'andonick_ap_bg',
			'settings'    => 'andonick_ap_bg_' . $key,
		) ) );
	}
}
add_action( 'customize_register', 'andonick_customize_appearance' );
