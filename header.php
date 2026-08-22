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

<a class="skip-link" href="#accueil">Aller au contenu principal</a>

<div class="topbar">
	<div class="container topbar-inner">
		<div class="topbar-links">
			<?php $topbar_links = andonick_topbar_links(); ?>
			<?php foreach ( $topbar_links as $ti => $tb ) : ?>
				<?php if ( $ti > 0 ) : ?><span class="topbar-sep">|</span><?php endif; ?>
				<?php if ( '' !== $tb[1] ) : ?>
					<a href="<?php echo esc_url( $tb[1] ); ?>"<?php echo ( 0 === strpos( $tb[1], 'http' ) ) ? ' target="_blank" rel="noopener"' : ''; ?>><strong><?php echo esc_html( $tb[0] ); ?></strong></a>
				<?php else : ?>
					<span><?php echo esc_html( $tb[0] ); ?></span>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<header class="site-header" id="siteHeader">
	<div class="container header-inner">
		<a class="brand" href="#accueil" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img src="<?php echo esc_url( andonick_logo() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="brand-logo">
		</a>

		<nav class="main-nav" id="mainNav" aria-label="<?php echo esc_attr( andonick_t( 'aria_nav' ) ); ?>">
			<button type="button" class="nav-close" id="navClose" aria-label="<?php echo esc_attr( andonick_t( 'aria_menu' ) ); ?>">×</button>
			<?php $menu_location = ( 'en' === andonick_lang() ) ? 'primary_en' : 'primary_fr'; ?>
			<?php if ( has_nav_menu( $menu_location ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => $menu_location, 'container' => false, 'menu_class' => 'main-nav-list', 'depth' => 1 ) ); ?>
			<?php elseif ( has_nav_menu( 'primary' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'main-nav-list', 'depth' => 1 ) ); ?>
			<?php else : ?>
				<?php foreach ( andonick_nav_links() as $nav_link ) : ?>
					<a href="<?php echo esc_url( $nav_link[1] ); ?>"><?php echo esc_html( $nav_link[0] ); ?></a>
				<?php endforeach; ?>
			<?php endif; ?>
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
