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
 * Police personnalisée : nom de famille + fichier woff2.
 * Retourne [ nom => url ] ou [] si incomplet.
 */
function andonick_ap_font_custom() {
	$name = trim( str_replace( array( "'", '"', ';', "\n", "\r" ), '', (string) get_theme_mod( 'andonick_ap_font_custom_name', '' ) ) );
	$file = trim( (string) get_theme_mod( 'andonick_ap_font_custom_file', '' ) );
	return ( '' !== $name && '' !== $file ) ? array( $name => $file ) : array();
}

/**
 * Liste complète des polices proposées (personnalisée d'abord, puis 5 standard).
 */
function andonick_ap_font_choices() {
	$builtin = array(
		'Segoe UI, Arial, sans-serif'          => 'Segoe UI (par défaut)',
		'Georgia, "Times New Roman", serif'    => 'Georgia (serif élégant)',
		'"Trebuchet MS", Segoe UI, sans-serif' => 'Trebuchet MS',
		'Arial, Helvetica, sans-serif'         => 'Arial',
		'Verdana, Geneva, sans-serif'          => 'Verdana',
	);
	$choices = array();
	foreach ( andonick_ap_font_custom() as $name => $file ) {
		$choices[ $name ] = $name . ' (personnalisée)';
	}
	return $choices + $builtin;
}

/**
 * Autorise l'upload de polices (woff2 / woff) dans la bibliothèque.
 */
function andonick_ap_font_mimes( $mimes ) {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return $mimes;
	}
	$mimes['woff2'] = 'font/woff2';
	$mimes['woff']  = 'font/woff';
	return $mimes;
}
add_filter( 'upload_mimes', 'andonick_ap_font_mimes' );

/**
 * Feuille de style injectée : variables CSS + règles de positionnement.
 */
function andonick_appearance_css() {
	$font_choices  = array_keys( andonick_ap_font_choices() );
	$font          = andonick_ap_sanitize_choice( andonick_ap( 'font', $font_choices[0] ), $font_choices, $font_choices[0] );
	$font_heading  = andonick_ap( 'font_heading', '' );
	if ( '' !== $font_heading && ! in_array( $font_heading, $font_choices, true ) ) {
		$font_heading = '';
	}
	$heading = ( '' !== $font_heading ) ? $font_heading : $font;
	$size          = andonick_ap_sanitize_int( andonick_ap( 'font_size', '16' ), 14, 18, 16 );
	/* Charte ANDONICK verrouillée : seuls les quatre tons officiels sont
	 * utilisés. Les transparences servent uniquement aux bordures et fonds. */
	$primary       = '#461491';
	$primary_dark  = '#2A0A63';
	$text          = '#333333';
	$page_bg       = '#FFFFFF';
	$tint          = 'rgba(70,20,145,0.07)';
	$topbar_bg     = '#2A0A63';
	$footer_bg     = '#2A0A63';
	$titles        = '#461491';
	$width         = andonick_ap_sanitize_int( andonick_ap( 'container_width', '1200' ), 1100, 1280, 1200 );
	$pad           = andonick_ap_sanitize_int( andonick_ap( 'section_pad', '96' ), 60, 120, 96 );
	$gal           = andonick_ap_sanitize_int( andonick_ap( 'gallery_cols', '3' ), 2, 4, 3 );
	$metiers_cols  = andonick_ap_sanitize_int( andonick_ap( 'metiers_cols', '3' ), 1, 4, 3 );
	$testis_cols   = andonick_ap_sanitize_int( andonick_ap( 'testis_cols', '3' ), 1, 4, 3 );
	$radius        = andonick_ap_sanitize_int( andonick_ap( 'radius', '6' ), 4, 8, 6 );
	$hero_h        = andonick_ap_sanitize_int( andonick_ap( 'hero_height', '90' ), 80, 100, 90 );
	$hero_align    = andonick_ap_sanitize_choice( andonick_ap( 'hero_align', 'center' ), array( 'center', 'left', 'right' ), 'center' );
	$header_fixed  = andonick_ap_sanitize_choice( andonick_ap( 'header_fixed', '1' ), array( '1', '0' ), '1' );
	$header_h      = andonick_ap_sanitize_int( andonick_ap( 'header_height', '76' ), 60, 96, 76 );
	$btn_size      = andonick_ap_sanitize_choice( andonick_ap( 'btn_size', 'medium' ), array( 'small', 'medium', 'large' ), 'medium' );
	$btn_pad       = array( 'small' => '8px 18px', 'medium' => '12px 26px', 'large' => '16px 34px' );
	$hero_op       = andonick_ap_sanitize_opacity( andonick_ap( 'hero_opacity', '0.24' ) );
	$impact_op     = andonick_ap_sanitize_opacity( andonick_ap( 'impact_opacity', '0.16' ) );
	$hero_pad      = array( '80' => '72px', '90' => '92px', '100' => '120px' );
	$justify       = array( 'center' => 'center', 'left' => 'flex-start', 'right' => 'flex-end' );

	$css  = '';
	foreach ( andonick_ap_font_custom() as $fname => $furl ) {
		$css .= "@font-face{font-family:'" . $fname . "';src:url('" . esc_url( $furl ) . "') format('woff2');font-display:swap;}";
	}
	$css .= ':root{';
	$css .= '--violet:' . $primary . ';';
	$css .= '--violet-dark:' . $primary_dark . ';';
	$css .= '--grey:' . $text . ';';
	$css .= '--white:' . $page_bg . ';';
	$css .= '--violet-tint:' . $tint . ';';
	$css .= '--titles:' . $titles . ';';
	$css .= '--radius:' . $radius . 'px;';
	$css .= '--radius-sm:' . $radius . 'px;';
	$css .= '--font:' . $font . ';';
	$css .= '--font-heading:' . $heading . ';';
	$css .= '--container-w:' . $width . 'px;';
	$css .= '--section-pad:' . $pad . 'px;';
	$css .= '--gal-col:' . $gal . ';';
	$css .= '--metiers-cols:' . $metiers_cols . ';';
	$css .= '--testis-cols:' . $testis_cols . ';';
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
	$css .= ':root{--header-h:' . $header_h . 'px;}';
	$css .= '@media(max-width:768px){:root{--header-h:66px;}}';
	$css .= '.btn,.btn-outline,.btn-outline-light,.btn-whatsapp{padding:' . $btn_pad[ $btn_size ] . ';}';
	if ( '0' === andonick_ap( 'reveal', '1' ) ) {
		$css .= '.reveal{opacity:1 !important;transform:none !important;}';
	}

	// Images de fond facultatives des sections (fine surimpression blanche).
	$bg_sections = array(
		'groupe'    => '.section-group',
		'filiales'  => '.section-filiales',
		'projets'   => '.section-projects',
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

	/* ---------------- Charte ---------------- */
	$wp_customize->add_section( 'andonick_ap_colors', array(
		'title'       => 'Charte graphique',
		'description' => 'Les couleurs officielles sont volontairement verrouillées : violet #461491, violet foncé #2A0A63, blanc #FFFFFF et gris #333333.',
		'panel' => 'andonick_appearance',
	) );

	/* ---------------- Typographie & alignements ---------------- */
	$wp_customize->add_section( 'andonick_ap_typo', array(
		'title' => 'Polices & alignements',
		'panel' => 'andonick_appearance',
	) );
	$fonts = andonick_ap_font_choices();
	$wp_customize->add_setting( 'andonick_ap_font', array(
		'default'           => 'Segoe UI, Arial, sans-serif',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array_keys( andonick_ap_font_choices() ), 'Segoe UI, Arial, sans-serif' );
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
			return andonick_ap_sanitize_choice( $v, array( '' ) + array_keys( andonick_ap_font_choices() ), '' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_font_heading', array(
		'label'   => 'Police des titres (vide = même que la générale)',
		'section' => 'andonick_ap_typo',
		'type'    => 'select',
		'choices' => array( '' => 'Comme la police générale' ) + $fonts,
	) );
	$wp_customize->add_setting( 'andonick_ap_font_custom_name', array(
		'default'           => '',
		'sanitize_callback' => function ( $v ) {
			return sanitize_text_field( str_replace( array( "'", '"', ';', "\n", "\r" ), '', wp_unslash( $v ) ) );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_font_custom_name', array(
		'label'       => 'Police personnalisée — nom de la famille',
		'description' => 'Exemple : Montserrat. Sera proposée en tête de liste dès le fichier chargé.',
		'section'     => 'andonick_ap_typo',
		'type'        => 'text',
	) );
	$wp_customize->add_setting( 'andonick_ap_font_custom_file', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'andonick_ap_font_custom_file', array(
		'label'       => 'Police personnalisée — fichier (.woff2)',
		'description' => 'Téléversez votre fichier .woff2 (ou .woff) depuis la bibliothèque, puis choisissez le fichier. Vide = police non utilisée.',
		'section'     => 'andonick_ap_typo',
		'settings'    => 'andonick_ap_font_custom_file',
	) ) );
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
		'default'           => '6',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 4, 8, 6 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_radius', array(
		'label'   => 'Coins arrondis des cartes',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '4' => '4 px', '6' => '6 px (par défaut)', '8' => '8 px' ),
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
	$wp_customize->add_setting( 'andonick_ap_header_height', array(
		'default'           => '76',
		'sanitize_callback' => function ( $v ) {
			return (string) andonick_ap_sanitize_int( $v, 60, 96, 76 );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_header_height', array(
		'label'   => 'Hauteur du menu (barre du haut)',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( '60' => '60 px (compact)', '76' => '76 px (par défaut)', '88' => '88 px (haut)', '96' => '96 px (très haut)' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_btn_size', array(
		'default'           => 'medium',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array( 'small', 'medium', 'large' ), 'medium' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_btn_size', array(
		'label'   => 'Taille des boutons',
		'section' => 'andonick_ap_layout',
		'type'    => 'select',
		'choices' => array( 'small' => 'Petits', 'medium' => 'Moyens (par défaut)', 'large' => 'Grands' ),
	) );

	/* ---------------- Fonds des sections & grilles ---------------- */
	$wp_customize->add_section( 'andonick_ap_secbg', array(
		'title' => 'Fonds des sections & grilles',
		'panel' => 'andonick_appearance',
	) );
	$secbg_defaults = array(
		'groupe'      => 'light',
		'filiales'    => 'tint',
		'projets'     => 'light',
		'actualites'  => 'light',
		'realisations'=> 'light',
		'references'  => 'light',
		'contact'     => 'tint',
	);
	foreach ( $secbg_defaults as $secbg_key => $secbg_default ) {
		$wp_customize->add_setting( 'andonick_ap_secbg_' . $secbg_key, array(
			'default'           => $secbg_default,
			'sanitize_callback' => function ( $v ) {
				return andonick_ap_sanitize_choice( $v, array( 'light', 'tint', 'dark' ), 'light' );
			},
			'type'              => 'theme_mod',
		) );
		$wp_customize->add_control( 'andonick_ap_secbg_' . $secbg_key, array(
			'label'   => 'Fond de « ' . $secbg_key . ' »',
			'section' => 'andonick_ap_secbg',
			'type'    => 'select',
			'choices' => array( 'light' => 'Clair (blanc)', 'tint' => 'Teinté (violet clair)', 'dark' => 'Violet foncé (texte blanc)' ),
		) );
	}
	foreach ( array( 'metiers' => 'Nombre de colonnes des cartes « Les métiers » (1 à 4)', 'testis' => 'Nombre de colonnes des témoignages (1 à 4)' ) as $cols_key => $cols_label ) {
		$wp_customize->add_setting( 'andonick_ap_' . $cols_key . '_cols', array(
			'default'           => '3',
			'sanitize_callback' => function ( $v ) {
				return min( 4, max( 1, absint( $v ) ) );
			},
			'type'              => 'theme_mod',
		) );
		$wp_customize->add_control( 'andonick_ap_' . $cols_key . '_cols', array(
			'label'   => $cols_label,
			'section' => 'andonick_ap_secbg',
			'type'    => 'number',
			'input_attrs' => array( 'min' => 1, 'max' => 4, 'step' => 1 ),
		) );
	}

	/* ---------------- Comportement & animations ---------------- */
	$wp_customize->add_section( 'andonick_ap_motion', array(
		'title' => 'Animations & transitions',
		'panel' => 'andonick_appearance',
	) );
	$wp_customize->add_setting( 'andonick_ap_reveal', array(
		'default'           => '1',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array( '1', '0' ), '1' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_reveal', array(
		'label'   => 'Apparition douce des blocs au défilement',
		'section' => 'andonick_ap_motion',
		'type'    => 'select',
		'choices' => array( '1' => 'Activée (par défaut)', '0' => 'Désactivée — tout est visible immédiatement' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_counter', array(
		'default'           => '1',
		'sanitize_callback' => function ( $v ) {
			return andonick_ap_sanitize_choice( $v, array( '1', '0' ), '1' );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_counter', array(
		'label'   => 'Animation de comptage des statistiques',
		'section' => 'andonick_ap_motion',
		'type'    => 'select',
		'choices' => array( '1' => 'Activée (par défaut)', '0' => 'Désactivée — les chiffres s\'affichent tels quels' ),
	) );
	$wp_customize->add_setting( 'andonick_ap_counter_duration', array(
		'default'           => '1600',
		'sanitize_callback' => function ( $v ) {
			return min( 5000, max( 500, absint( $v ) ) );
		},
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( 'andonick_ap_counter_duration', array(
		'label'       => 'Durée de l\'animation de comptage (500 à 5000 ms)',
		'description' => '1600 ms = rythme actuel. 500 ms = décompte quasi instantané.',
		'section'     => 'andonick_ap_motion',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 500, 'max' => 5000, 'step' => 100 ),
	) );

	/* ---------------- Réinitialisation ---------------- */
	$wp_customize->add_section( 'andonick_ap_reset', array(
		'title' => 'Réinitialisation',
		'panel' => 'andonick_appearance',
	) );
	if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Andonick_Reset_Control' ) ) {
		class Andonick_Reset_Control extends WP_Customize_Control {
			public $type = 'andonick_reset';
			public function render_content() {
				?>
				<label>
					<span class="customize-control-title">Réinitialiser tous les réglages ANDONICK</span>
					<span class="description customize-control-description">Restaure la charte, les textes, les listes et les images d'origine — sans toucher aux articles et pages WordPress.</span>
				</label>
				<button type="button" class="button button-secondary" id="andonick-reset-btn" style="margin-top:8px;">Réinitialiser maintenant</button>
				<span id="andonick-reset-msg" class="description" style="display:block;margin-top:8px;"></span>
				<?php
			}
		}
	}
	$wp_customize->add_setting( 'andonick_ap_reset_trigger', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
	) );
	$wp_customize->add_control( new Andonick_Reset_Control( $wp_customize, 'andonick_ap_reset_trigger', array(
		'section'     => 'andonick_ap_reset',
		'settings'    => 'andonick_ap_reset_trigger',
	) ) );

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
		'banniere1'  => 'Image de fond de la bannière libre n°1 (facultative)',
		'banniere2'  => 'Image de fond de la bannière libre n°2 (facultative)',
		'banniere3'  => 'Image de fond de la bannière libre n°3 (facultative)',
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

/**
 * JavaScript du bouton « Réinitialiser » (panneau Apparence & Styles).
 * Remet chaque réglage ANDONICK à sa valeur par défaut enregistrée.
 */
function andonick_reset_control_js() {
	global $wp_customize;
	if ( ! $wp_customize ) {
		return;
	}
	$defaults = array();
	foreach ( $wp_customize->settings() as $id => $setting ) {
		if ( 0 === strpos( $id, 'andonick_' ) ) {
			$defaults[ $id ] = $setting->default;
		}
	}
	wp_register_script( 'andonick-reset', '', array( 'customize-controls' ), ANDONICK_VERSION, true );
	wp_localize_script( 'andonick-reset', 'andonickDefaults', $defaults );
	wp_enqueue_script( 'andonick-reset' );
	wp_add_inline_script( 'andonick-reset', '
		document.addEventListener("click", function (e) {
			if (e.target && e.target.id === "andonick-reset-btn") {
				var msg = document.getElementById("andonick-reset-msg");
				var n = 0;
				Object.keys(andonickDefaults).forEach(function (id) {
					wp.customize(id, function (s) {
						var d = andonickDefaults[id];
						if (String(s.get()) !== String(d)) { s.set(d); n++; }
					});
				});
				setTimeout(function () {
					msg.textContent = n + " r\u00e9glage(s) restaur\u00e9(s). Cliquez maintenant sur \u00ab Publier \u00bb pour appliquer.";
				}, 400);
			}
		});
	' );
}
add_action( 'customize_controls_enqueue_scripts', 'andonick_reset_control_js' );
