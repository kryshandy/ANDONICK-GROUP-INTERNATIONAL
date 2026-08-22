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

<main id="main-content" class="page-main" tabindex="-1">
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
					<?php if ( is_single() && 'post' === get_post_type() && andonick_blog_comments() ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				</article>
			<?php endwhile; ?>
			<?php if ( is_single() && 'post' === get_post_type() ) : ?>
<nav class="page-nav">
				<span class="prev"><?php previous_post_link( '%link', '&larr; ' . esc_html( andonick_t( 'page_prev' ) ), true ); ?></span>
				<span class="next"><?php next_post_link( '%link', esc_html( andonick_t( 'page_next' ) ) . ' &rarr;', true ); ?></span>
			</nav>
			<?php endif; ?>
		<?php else : ?>
			<article class="legal-article">
				<header class="page-head">
					<h1 class="page-title"><?php echo esc_html( andonick_t( 'page_404_title' ) ); ?></h1>
				</header>
				<div class="page-body">
					<p><?php echo esc_html( andonick_t( 'page_404_body' ) ); ?></p>
					<a class="btn" href="<?php echo esc_url( andonick_url_in_language( home_url( '/' ), andonick_lang() ) ); ?>"><?php echo esc_html( andonick_t( 'page_404_back' ) ); ?></a>
				</div>
			</article>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
