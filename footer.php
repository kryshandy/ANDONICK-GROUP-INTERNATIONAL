<?php
/**
 * Footer du thème ANDONICK.
 *
 * @package Andonick
 */
?>

<footer class="site-footer">
	<div class="container footer-grid">
		<div class="footer-col footer-brand">
			<img src="<?php echo esc_url( andonick_logo() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="footer-logo">
			<p><?php echo esc_html( andonick_t( 'foot_tag' ) ); ?></p>
			<?php $socials = andonick_socials(); ?>
			<?php if ( ! empty( $socials ) ) : ?>
				<ul class="social-links">
					<?php foreach ( $socials as $social ) : ?>
						<li><a href="<?php echo esc_url( $social[1] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $social[0] ); ?>"><?php echo esc_html( $social[0] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php $col2 = andonick_footer_col( 2 ); ?>
		<?php if ( $col2 ) : ?>
		<div class="footer-col">
			<h4><?php echo esc_html( $col2[0] ); ?></h4>
			<ul class="footer-links">
				<?php foreach ( $col2[1] as $link ) : ?>
					<?php if ( '' === $link[1] ) : ?>
						<li><?php echo esc_html( $link[0] ); ?></li>
					<?php else : ?>
						<li><a href="<?php echo esc_url( $link[1] ); ?>"><?php echo esc_html( $link[0] ); ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

		<?php $col3 = andonick_footer_col( 3 ); ?>
		<?php if ( $col3 ) : ?>
		<div class="footer-col">
			<h4><?php echo esc_html( $col3[0] ); ?></h4>
			<ul class="footer-links">
				<?php foreach ( $col3[1] as $link ) : ?>
					<?php if ( '' === $link[1] ) : ?>
						<li><?php echo esc_html( $link[0] ); ?></li>
					<?php else : ?>
						<li><a href="<?php echo esc_url( $link[1] ); ?>"><?php echo esc_html( $link[0] ); ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

		<?php $col4 = andonick_footer_col( 4 ); ?>
		<?php if ( $col4 ) : ?>
		<div class="footer-col">
			<h4><?php echo esc_html( $col4[0] ); ?></h4>
			<ul class="footer-links">
				<?php foreach ( $col4[1] as $link ) : ?>
					<?php if ( '' === $link[1] ) : ?>
						<li><?php echo esc_html( $link[0] ); ?></li>
					<?php else : ?>
						<li><a href="<?php echo esc_url( $link[1] ); ?>"><?php echo esc_html( $link[0] ); ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<div class="footer-bottom">
		<div class="container footer-bottom-inner">
			<p><?php echo esc_html( andonick_t( 'foot_copy' ) ); ?></p>
			<?php $legal_ids = andonick_legal_pages(); ?>
			<?php if ( ! empty( $legal_ids ) ) : ?>
				<nav class="footer-legal" aria-label="<?php echo esc_attr( ( 'en' === andonick_lang() ) ? 'Legal pages' : 'Pages légales' ); ?>">
					<ul>
						<?php foreach ( $legal_ids as $legal_id ) : ?>
							<li><a href="<?php echo esc_url( andonick_url_in_language( get_permalink( $legal_id ), andonick_lang() ) ); ?>"><?php echo esc_html( get_the_title( $legal_id ) ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</footer>

<div class="progress-bar" id="progressBar" aria-hidden="true"></div>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<a class="wa-float" href="https://wa.me/<?php echo esc_attr( andonick_wa( 'phone_rca1' ) ); ?>?text=<?php echo rawurlencode( andonick_t( 'wa_msg' ) ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( 'WhatsApp — ' . andonick_t( 'wa_rca' ) ); ?>">
	<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91C21.96 6.45 17.5 2 12.04 2m0 18.13h-.01a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.25-8.24a8.2 8.2 0 0 1 8.25 8.25c0 4.54-3.7 8.23-8.25 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.13-.16.24-.64.8-.78.97-.14.16-.29.18-.54.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.16-.25.25-.41.08-.17.04-.31-.02-.43-.06-.12-.56-1.34-.76-1.84-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.22.25-.86.85-.86 2.07 0 1.22.89 2.4 1.01 2.56.12.17 1.75 2.67 4.23 3.74.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.06-.1-.23-.16-.48-.29"/></svg>
</a>

<button type="button" class="back-top" id="backTop" aria-label="<?php echo esc_attr( andonick_t( 'aria_top' ) ); ?>">↑</button>

<?php if ( '1' === get_theme_mod( 'andonick_cookies_enabled', '1' ) ) : ?>
	<div class="cookie-banner" id="cookieBanner" role="dialog" aria-live="polite" aria-modal="false" aria-label="Cookies" aria-describedby="cookieDescription" tabindex="-1">
		<p id="cookieDescription"><?php echo wp_kses_post( andonick_t( 'cookies_text' ) ); ?></p>
		<div class="cookie-actions">
			<button type="button" class="btn cookie-accept" data-cookie="accept"><?php echo esc_html( andonick_t( 'cookies_accept' ) ); ?></button>
			<button type="button" class="btn btn-outline cookie-decline" data-cookie="decline"><?php echo esc_html( andonick_t( 'cookies_decline' ) ); ?></button>
		</div>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
