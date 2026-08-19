<?php
/**
 * Header du thème ANDONICK.
 *
 * @package Andonick
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar">
	<div class="container topbar-inner">
		<div class="topbar-links">
			<a href="https://wa.me/33605564373" target="_blank" rel="noopener"><?php echo esc_html( andonick_t( 'wa_rca' ) ); ?> — <strong>+33 6 05 56 43 73</strong></a>
			<span class="topbar-sep">|</span>
			<a href="tel:+23675000649"><strong>+236 75 00 06 49</strong></a>
			<span class="topbar-sep">|</span>
			<a href="tel:+23670286601"><strong>+236 70 28 66 01</strong></a>
		</div>
		<div class="topbar-lang">
			<?php if ( 'en' === andonick_lang() ) : ?>
				<a href="<?php echo esc_url( andonick_lang_url( 'fr' ) ); ?>">Français</a>
			<?php else : ?>
				<a href="<?php echo esc_url( andonick_lang_url( 'en' ) ); ?>">English</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<header class="site-header" id="siteHeader">
	<div class="container header-inner">
		<a class="brand" href="#accueil" aria-label="ANDONICK Group International">
			<img src="<?php echo esc_url( ANDONICK_URI . '/assets/img/logo.png' ); ?>" alt="Logo ANDONICK Group" class="brand-logo">
		</a>

		<nav class="main-nav" id="mainNav" aria-label="Navigation principale">
			<a href="#groupe"><?php echo esc_html( andonick_t( 'nav_group' ) ); ?></a>
			<a href="#filiales"><?php echo esc_html( andonick_t( 'nav_filiales' ) ); ?></a>
			<a href="#impact"><?php echo esc_html( andonick_t( 'nav_impact' ) ); ?></a>
			<a href="#references"><?php echo esc_html( andonick_t( 'nav_refs' ) ); ?></a>
			<a href="#contact"><?php echo esc_html( andonick_t( 'nav_contact' ) ); ?></a>
			<a href="#devis" class="btn btn-sm btn-white"><?php echo esc_html( andonick_t( 'nav_devis' ) ); ?></a>
		</nav>

		<button class="nav-toggle" id="navToggle" aria-label="Menu" aria-expanded="false" aria-controls="mainNav">
			<span></span><span></span><span></span>
		</button>
	</div>
</header>

<div class="nav-overlay" id="navOverlay"></div>