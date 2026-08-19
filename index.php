<?php
/**
 * Gabarit général — pages légales, articles du blog et 404.
 *
 * La page d'accueil (one page) est gérée par front-page.php.
 * Ici : les pages WordPress (Mentions légales…), les articles
 * du blog et les autres requêtes, affichés avec le habillage du thème.
 *
 * @package Andonick
 */

if ( is_front_page() ) {
	get_template_part( 'front-page' );
	return;
}

get_header();
?>

<main class="page-main">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'legal-article' ); ?>>
					<header class="page-head">
						<h1 class="page-title"><?php the_title(); ?></h1>
						<?php if ( is_single() && 'post' === get_post_type() ) : ?>
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						<?php endif; ?>
					</header>
					<div class="page-body">
						<?php
						the_content();
						wp_link_pages();
						?>
					</div>
				</article>
			<?php endwhile; ?>
			<?php if ( is_single() && 'post' === get_post_type() ) : ?>
<nav class="page-nav">
				<span class="prev"><?php previous_post_link( '%link', '&larr; ' . esc_html( 'Article précédent' ), true ); ?></span>
				<span class="next"><?php next_post_link( '%link', esc_html( 'Article suivant' ) . ' &rarr;', true ); ?></span>
			</nav>
			<?php endif; ?>
		<?php else : ?>
			<article class="legal-article">
				<header class="page-head">
					<h1 class="page-title"><?php echo esc_html( 'Introuvable' ); ?></h1>
				</header>
				<div class="page-body">
					<p><?php echo esc_html( 'Le contenu demandé n\'existe plus.' ); ?></p>
					<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Retour à l'accueil</a>
				</div>
			</article>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();