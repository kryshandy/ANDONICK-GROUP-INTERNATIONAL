<?php
/**
 * Page d'accueil — one page ANDONICK Group International.
 *
 * @package Andonick
 */

get_header();

$lang     = andonick_lang();
$content  = andonick_content()[ $lang ]; // phpcs:ignore
$lang_alt = ( 'en' === $lang ) ? 'fr' : 'en';
?>

<main id="accueil">

	<!-- ============ HERO ============ -->
	<section class="hero" id="hero">
		<div class="hero-bg" style="background-image:url('<?php echo esc_url( ANDONICK_URI . '/assets/img/hero.jpg' ); ?>');"></div>
		<div class="container hero-inner">
			<span class="hero-tag"><?php echo esc_html( $content['hero_tag'] ); ?></span>
			<h1 class="hero-title">ANDONICK GROUP <em>INTERNATIONAL</em></h1>
			<p class="hero-lead"><?php echo esc_html( $content['hero_lead'] ); ?></p>
			<div class="hero-cta">
				<a href="#devis" class="btn"><?php echo esc_html( $content['hero_cta1'] ); ?></a>
				<a href="#filiales" class="btn btn-outline-light"><?php echo esc_html( $content['hero_cta2'] ); ?></a>
			</div>

			<div class="hero-stats">
				<div class="stat reveal"><b><span data-count="15" data-suffix="+">0+</span></b><span><?php echo esc_html( $content['stat1'] ); ?></span></div>
				<div class="stat reveal reveal-delay-1"><b><span data-count="8">0</span></b><span><?php echo esc_html( $content['stat2'] ); ?></span></div>
				<div class="stat reveal reveal-delay-2"><b><span data-count="3">0</span></b><span><?php echo esc_html( $content['stat3'] ); ?></span></div>
			</div>
		</div>

		<div class="hero-strip">
			<div class="container strip-inner">
				<span><?php echo esc_html( $content['strip1'] ); ?></span>
				<span><?php echo esc_html( $content['strip2'] ); ?></span>
				<span><?php echo esc_html( $content['strip3'] ); ?></span>
				<span><?php echo esc_html( $content['strip4'] ); ?></span>
				<span><?php echo esc_html( $content['strip5'] ); ?></span>
			</div>
		</div>
	</section>

	<!-- ============ LE GROUPE ============ -->
	<section class="section section-group" id="groupe">
		<div class="container group-grid">
			<div class="group-text reveal">
				<span class="eyebrow"><?php echo esc_html( $content['s2_eyebrow'] ); ?></span>
				<h2><?php echo esc_html( $content['s2_title'] ); ?></h2>
				<p><?php echo esc_html( $content['s2_body'] ); ?></p>
				<ul class="value-list">
					<li><b><?php echo esc_html( $content['val1'] ); ?></b></li>
					<li><b><?php echo esc_html( $content['val2'] ); ?></b></li>
					<li><b><?php echo esc_html( $content['val3'] ); ?></b></li>
					<li><b><?php echo esc_html( $content['val4'] ); ?></b></li>
				</ul>
			</div>
			<figure class="group-media reveal reveal-delay-2">
				<img src="<?php echo esc_url( ANDONICK_URI . '/assets/img/domaines.jpg' ); ?>" alt="<?php echo esc_attr( $content['img_team_name'] ); ?>">
			</figure>
		</div>
	</section>

	<!-- ============ FILIALES / 8 MÉTIERS ============ -->
	<section class="section section-filiales" id="filiales">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( $content['s3_eyebrow'] ); ?></span>
				<h2><?php echo esc_html( $content['s3_title'] ); ?></h2>
				<p><?php echo esc_html( $content['s3_sub'] ); ?></p>
			</div>

			<div class="filiales-grid">
				<?php foreach ( $content['filiales'] as $filiale ) : ?>
					<article class="filiale-card reveal" data-num="<?php echo esc_attr( $filiale['num'] ); ?>">
						<div class="filiale-head">
							<span class="filiale-num"><?php echo esc_html( $filiale['num'] ); ?></span>
							<h3><?php echo esc_html( $filiale['title'] ); ?></h3>
						</div>
						<p class="filiale-desc"><?php echo esc_html( $filiale['desc'] ); ?></p>
						<ul class="filiale-tags">
							<?php foreach ( $filiale['tags'] as $tag ) : ?>
								<li><?php echo esc_html( $tag ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ IMPACT ============ -->
	<section class="section section-impact" id="impact">
		<div class="impact-bg" style="background-image:url('<?php echo esc_url( ANDONICK_URI . '/assets/img/impact.jpg' ); ?>');"></div>
		<div class="container impact-inner">
			<span class="eyebrow eyebrow-light reveal"><?php echo esc_html( $content['impact_eyebrow'] ); ?></span>
			<h2 class="reveal"><?php echo esc_html( $content['impact_title'] ); ?></h2>
			<p class="impact-body reveal reveal-delay-1"><?php echo esc_html( $content['impact_body'] ); ?></p>
			<div class="impact-grid">
				<?php foreach ( $content['impacts'] as $i => $impact ) : ?>
					<div class="impact-item reveal reveal-delay-<?php echo esc_attr( min( $i + 1, 4 ) ); ?>">
						<b><?php echo esc_html( $impact[0] ); ?></b>
						<span><?php echo esc_html( $impact[1] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ GALERIE RÉALISATIONS ============ -->
	<section class="section section-gallery" id="realisations">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( $content['gallery_eyebrow'] ); ?></span>
				<h2><?php echo esc_html( $content['gallery_title'] ); ?></h2>
				<p><?php echo esc_html( $content['gallery_sub'] ); ?></p>
			</div>
			<div class="gallery-grid">
				<?php
				$gallery_imgs = array( 'hero.jpg', 'domaines.jpg', 'impact.jpg', 'photo-07.jpg', 'photo-08.jpg', 'photo-11.jpg' );
				foreach ( $gallery_imgs as $gi => $gimg ) :
					?>
					<figure class="gallery-item reveal reveal-delay-<?php echo esc_attr( ( $gi % 3 ) + 1 ); ?>">
						<img src="<?php echo esc_url( ANDONICK_URI . '/assets/img/' . $gimg ); ?>" alt="<?php echo esc_attr( $content['gallery_title'] ); ?>" loading="lazy">
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ RÉFÉRENCES ============ -->
	<section class="section section-refs" id="references">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( $content['testi_eyebrow'] ); ?></span>
				<h2><?php echo esc_html( $content['testi_title'] ); ?></h2>
			</div>

			<div class="testi-grid">
				<?php foreach ( $content['testis'] as $ti => $testi ) : ?>
					<blockquote class="testi-card reveal reveal-delay-<?php echo esc_attr( ( $ti % 3 ) + 1 ); ?>">
						<span class="testi-quote-mark">“</span>
						<p><?php echo esc_html( $testi[0] ); ?></p>
						<footer>
							<b><?php echo esc_html( $testi[1] ); ?></b>
							<span><?php echo esc_html( $testi[2] ); ?></span>
						</footer>
					</blockquote>
				<?php endforeach; ?>
			</div>

			<div class="refs-block reveal">
				<span class="eyebrow"><?php echo esc_html( $content['refs_eyebrow'] ); ?></span>
				<h3><?php echo esc_html( $content['refs_title'] ); ?></h3>
				<div class="refs-table-wrap">
					<table class="refs-table">
						<thead>
							<tr>
								<?php foreach ( $content['ref_headers'] as $header ) : ?>
									<th><?php echo esc_html( $header ); ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $content['refs'] as $ref ) : ?>
								<tr>
									<td><?php echo esc_html( $ref[0] ); ?></td>
									<td><b><?php echo esc_html( $ref[1] ); ?></b></td>
									<td><?php echo esc_html( $ref[2] ); ?></td>
									<td class="ref-phone"><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $ref[3] ) ); ?>"><?php echo esc_html( $ref[3] ); ?></a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<div class="partners-strip">
					<span class="eyebrow"><?php echo esc_html( $content['partners_title'] ); ?></span>
					<ul>
						<?php foreach ( $content['partners'] as $partner ) : ?>
							<li><?php echo esc_html( $partner ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- ============ CONTACT ============ -->
	<section class="section section-contact" id="contact">
		<div class="container contact-grid">
			<div class="contact-info reveal">
				<span class="eyebrow"><?php echo esc_html( $content['contact_eyebrow'] ); ?></span>
				<h2><?php echo esc_html( $content['contact_title'] ); ?></h2>
				<p class="contact-sub"><?php echo esc_html( $content['contact_sub'] ); ?></p>

				<div class="contact-block">
					<h4><?php echo esc_html( $content['contact_coord'] ); ?></h4>
					<p><?php echo esc_html( $content['contact_addr'] ); ?></p>
					<p class="contact-phones">
						<a href="tel:+23675000649">+236 75 00 06 49</a> /
						<a href="tel:+23670286601">+236 70 28 66 01</a>
						<span><?php echo esc_html( $content['lbl_rca'] ); ?></span><br>
						<a href="tel:+33605564373">+33 6 05 56 43 73</a>
						<span><?php echo esc_html( $content['lbl_fr'] ); ?></span><br>
						<a href="mailto:contact@andonickgroup.com">contact@andonickgroup.com</a>
					</p>
				</div>

				<div class="contact-channels">
					<a class="btn btn-whatsapp" href="https://wa.me/23675000649" target="_blank" rel="noopener"><?php echo esc_html( $content['wa_rca'] ); ?></a>
					<a class="btn btn-whatsapp" href="https://wa.me/33605564373" target="_blank" rel="noopener"><?php echo esc_html( $content['wa_fr'] ); ?></a>
					<a class="btn btn-outline" href="tel:+23675000649"><?php echo esc_html( $content['call_direct'] ); ?></a>
				</div>
			</div>

			<div class="contact-form-wrap reveal reveal-delay-2" id="devis">
				<div class="form-tabs">
					<button type="button" class="form-tab active" data-tab="devis"><?php echo esc_html( $content['tab_devis'] ); ?></button>
					<button type="button" class="form-tab" data-tab="rappel"><?php echo esc_html( $content['tab_rappel'] ); ?></button>
				</div>

				<div class="form-panel" id="panel-devis">
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="andonick-form">
						<input type="hidden" name="action" value="andonick_contact">
						<input type="hidden" name="andonick_form_type" value="devis">
						<?php wp_nonce_field( 'andonick_contact', 'andonick_nonce' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<div class="form-row">
							<label for="f-name"><?php echo esc_html( $content['f_name'] ); ?></label>
							<input type="text" id="f-name" name="andonick_name" required>
						</div>
						<div class="form-row">
							<label for="f-company"><?php echo esc_html( $content['f_company'] ); ?></label>
							<input type="text" id="f-company" name="andonick_company">
						</div>
						<div class="form-row form-row-2">
							<div>
								<label for="f-phone"><?php echo esc_html( $content['f_phone'] ); ?></label>
								<input type="tel" id="f-phone" name="andonick_phone" required>
							</div>
							<div>
								<label for="f-email"><?php echo esc_html( $content['f_email'] ); ?></label>
								<input type="email" id="f-email" name="andonick_email">
							</div>
						</div>
						<div class="form-row">
							<label for="f-service"><?php echo esc_html( $content['f_service'] ); ?></label>
							<select id="f-service" name="andonick_service" required>
								<?php foreach ( $content['services'] as $service ) : ?>
									<option value="<?php echo esc_attr( $service ); ?>"><?php echo esc_html( $service ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-row">
							<label for="f-desc"><?php echo esc_html( $content['f_desc'] ); ?></label>
							<textarea id="f-desc" name="andonick_desc" rows="4" placeholder="<?php echo esc_attr( $content['descPlaceholder'] ); ?>" required></textarea>
						</div>
						<div class="form-row form-row-2">
							<div>
								<label><?php echo esc_html( $content['f_slot'] ); ?></label>
								<select name="andonick_slot">
									<?php foreach ( $content['slots'] as $slot ) : ?>
										<option value="<?php echo esc_attr( $slot ); ?>"><?php echo esc_html( $slot ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div>
								<label><?php echo esc_html( $content['f_city'] ); ?></label>
								<input type="text" name="andonick_city" placeholder="<?php echo esc_attr( $content['cityPlaceholder'] ); ?>">
							</div>
						</div>
						<button type="submit" class="btn btn-block"><?php echo esc_html( $content['f_submit_devis'] ); ?></button>
						<p class="form-disclaimer"><?php echo esc_html( $content['f_disc_devis'] ); ?></p>
					</form>
				</div>

				<div class="form-panel" id="panel-rappel" hidden>
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="andonick-form">
						<input type="hidden" name="action" value="andonick_contact">
						<input type="hidden" name="andonick_form_type" value="rappel">
						<?php wp_nonce_field( 'andonick_contact', 'andonick_nonce' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<div class="form-row">
							<label><?php echo esc_html( $content['f_name'] ); ?></label>
							<input type="text" name="andonick_name" required>
						</div>
						<div class="form-row form-row-2">
							<div>
								<label><?php echo esc_html( $content['f_phone'] ); ?></label>
								<input type="tel" name="andonick_phone" required>
							</div>
							<div>
								<label><?php echo esc_html( $content['f_object'] ); ?></label>
								<input type="text" name="andonick_object" placeholder="<?php echo esc_attr( $content['objectPlaceholder'] ); ?>">
							</div>
						</div>
						<div class="form-row form-row-2">
							<div>
								<label><?php echo esc_html( $content['f_slot'] ); ?></label>
								<select name="andonick_slot">
									<?php foreach ( $content['slots'] as $slot ) : ?>
										<option value="<?php echo esc_attr( $slot ); ?>"><?php echo esc_html( $slot ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div>
								<label><?php echo esc_html( $content['f_city'] ); ?></label>
								<input type="text" name="andonick_city" placeholder="<?php echo esc_attr( $content['cityPlaceholder'] ); ?>">
							</div>
						</div>
						<button type="submit" class="btn btn-block"><?php echo esc_html( $content['f_submit_rappel'] ); ?></button>
						<p class="form-disclaimer"><?php echo esc_html( $content['f_disc_rappel'] ); ?></p>
					</form>
				</div>
			</div>
		</div>
	</section>

	<div class="page-switcher">
		<?php if ( 'fr' === $lang ) : ?>
			<p>Voir cette page en <a href="<?php echo esc_url( andonick_lang_url( 'en' ) ); ?>">English</a></p>
		<?php else : ?>
			<p>View this page in <a href="<?php echo esc_url( andonick_lang_url( 'fr' ) ); ?>">Français</a></p>
		<?php endif; ?>
	</div>

</main>

<?php get_footer(); ?>