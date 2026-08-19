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
			<a href="https://wa.me/<?php echo esc_attr( andonick_wa( 'phone_fr' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( andonick_t( 'wa_rca' ) ); ?> — <strong><?php echo esc_html( andonick_t( 'phone_fr' ) ); ?></strong></a>
			<span class="topbar-sep">|</span>
			<a href="tel:<?php echo esc_attr( andonick_tel( 'phone_rca1' ) ); ?>"><strong><?php echo esc_html( andonick_t( 'phone_rca1' ) ); ?></strong></a>
			<span class="topbar-sep">|</span>
			<a href="tel:<?php echo esc_attr( andonick_tel( 'phone_rca2' ) ); ?>"><strong><?php echo esc_html( andonick_t( 'phone_rca2' ) ); ?></strong></a>
		</div>
	</div>
</div>

<header class="site-header" id="siteHeader">
	<div class="container header-inner">
		<a class="brand" href="#accueil" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img src="<?php echo esc_url( andonick_logo() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="brand-logo">
		</a>

		<nav class="main-nav" id="mainNav" aria-label="<?php echo esc_attr( andonick_t( 'aria_nav' ) ); ?>">
			<a href="<?php echo esc_url( andonick_t( 'nav_group_href' ) ); ?>"><?php echo esc_html( andonick_t( 'nav_group' ) ); ?></a>
			<a href="<?php echo esc_url( andonick_t( 'nav_filiales_href' ) ); ?>"><?php echo esc_html( andonick_t( 'nav_filiales' ) ); ?></a>
			<a href="<?php echo esc_url( andonick_t( 'nav_impact_href' ) ); ?>"><?php echo esc_html( andonick_t( 'nav_impact' ) ); ?></a>
			<a href="<?php echo esc_url( andonick_t( 'nav_refs_href' ) ); ?>"><?php echo esc_html( andonick_t( 'nav_refs' ) ); ?></a>
			<a href="<?php echo esc_url( andonick_t( 'nav_contact_href' ) ); ?>"><?php echo esc_html( andonick_t( 'nav_contact' ) ); ?></a>
			<a href="<?php echo esc_url( andonick_t( 'nav_devis_href' ) ); ?>" class="btn btn-sm btn-white"><?php echo esc_html( andonick_t( 'nav_devis' ) ); ?></a>
		</nav>

		<div class="lang-switch" role="group" aria-label="<?php echo esc_attr( andonick_t( 'lang_fr' ) . ' / ' . andonick_t( 'lang_en' ) ); ?>">
			<?php if ( 'en' === andonick_lang() ) : ?>
				<a href="<?php echo esc_url( andonick_lang_url( 'fr' ) ); ?>" aria-label="Version française">FR</a>
				<span class="lang-slash" aria-hidden="true"></span>
				<span class="lang-active" aria-current="true">EN</span>
			<?php else : ?>
				<span class="lang-active" aria-current="true">FR</span>
				<span class="lang-slash" aria-hidden="true"></span>
				<a href="<?php echo esc_url( andonick_lang_url( 'en' ) ); ?>" aria-label="English version">EN</a>
			<?php endif; ?>
		</div>

		<button class="nav-toggle" id="navToggle" aria-label="<?php echo esc_attr( andonick_t( 'aria_menu' ) ); ?>" aria-expanded="false" aria-controls="mainNav">
			<span></span><span></span><span></span>
		</button>
	</div>
</header>

<div class="nav-overlay" id="navOverlay"></div>