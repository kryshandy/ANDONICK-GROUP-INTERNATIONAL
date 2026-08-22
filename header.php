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

<?php
$andonick_is_front   = is_front_page();
$andonick_home_url   = andonick_url_in_language( home_url( '/' ), andonick_lang() );
$andonick_home_link  = $andonick_is_front ? '#accueil' : $andonick_home_url . '#accueil';
$andonick_skip_label = ( 'en' === andonick_lang() ) ? 'Skip to main content' : 'Aller au contenu principal';
$andonick_open_menu  = ( 'en' === andonick_lang() ) ? 'Open menu' : 'Ouvrir le menu';
$andonick_close_menu = ( 'en' === andonick_lang() ) ? 'Close menu' : 'Fermer le menu';
?>

<a class="skip-link" href="<?php echo esc_url( $andonick_is_front ? '#accueil' : '#main-content' ); ?>"><?php echo esc_html( $andonick_skip_label ); ?></a>

<aside class="topbar" aria-label="<?php echo esc_attr( ( 'en' === andonick_lang() ) ? 'Quick contact' : 'Contact rapide' ); ?>">
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
</aside>

<header class="site-header" id="siteHeader">
	<div class="container header-inner">
		<a class="brand" href="<?php echo esc_url( $andonick_home_link ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img src="<?php echo esc_url( andonick_logo() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="brand-logo">
		</a>

		<nav class="main-nav" id="mainNav" aria-label="<?php echo esc_attr( andonick_t( 'aria_nav' ) ); ?>">
			<button type="button" class="nav-close" id="navClose" aria-label="<?php echo esc_attr( $andonick_close_menu ); ?>">×</button>
			<?php $menu_location = ( 'en' === andonick_lang() ) ? 'primary_en' : 'primary_fr'; ?>
			<?php if ( has_nav_menu( $menu_location ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => $menu_location, 'container' => false, 'menu_class' => 'main-nav-list', 'depth' => 1 ) ); ?>
			<?php elseif ( has_nav_menu( 'primary' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'main-nav-list', 'depth' => 1 ) ); ?>
			<?php else : ?>
				<ul class="main-nav-list">
					<?php foreach ( andonick_nav_links() as $nav_link ) : ?>
						<li class="menu-item"><a href="<?php echo esc_url( $nav_link[1] ); ?>"><?php echo esc_html( $nav_link[0] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<a href="<?php echo esc_url( andonick_section_url( andonick_t( 'nav_devis_href' ) ) ); ?>" class="btn btn-sm btn-white"><?php echo esc_html( andonick_t( 'nav_devis' ) ); ?></a>
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

		<button type="button" class="nav-toggle" id="navToggle" aria-label="<?php echo esc_attr( $andonick_open_menu ); ?>" aria-expanded="false" aria-controls="mainNav" data-open-label="<?php echo esc_attr( $andonick_open_menu ); ?>" data-close-label="<?php echo esc_attr( $andonick_close_menu ); ?>">
			<span></span><span></span><span></span>
		</button>
	</div>
</header>

<div class="nav-overlay" id="navOverlay" aria-hidden="true"></div>
