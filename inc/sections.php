<?php
/**
 * ANDONICK — Sections de la page d'accueil.
 *
 * Chaque section est une fonction autonome, appelée dans l'ordre défini
 * par Apparence → Personnaliser → ANDONICK — Structure & Ordre.
 * On peut réordonner les sections et en masquer (retirer la ligne).
 *
 * @package Andonick
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Ordre des sections (éditable) : liste blanche, un nom par ligne.
 */
function andonick_section_order() {
	$default = array( 'hero', 'groupe', 'filiales', 'impact', 'realisations', 'references', 'contact' );
	$raw     = get_theme_mod( 'andonick_section_order', '' );
	if ( '' !== $raw ) {
		$order = array();
		foreach ( explode( "\n", $raw ) as $line ) {
			$item = sanitize_key( trim( $line ) );
			if ( in_array( $item, $default, true ) && ! in_array( $item, $order, true ) ) {
				$order[] = $item;
			}
		}
		if ( ! empty( $order ) ) {
			return $order;
		}
	}
	return $default;
}

/**
 * Section HERO — accueil + bandeau de valeurs.
 */
function andonick_section_hero() {
	?>
	<section class="hero" id="hero">
		<div class="hero-bg" style="background-image:url('<?php echo esc_url( andonick_img( 'hero' ) ); ?>');"></div>
		<div class="container hero-inner">
			<span class="hero-tag"><span class="dot"></span><?php echo esc_html( andonick_t( 'hero_tag' ) ); ?></span>
			<h1 class="hero-title"><?php echo esc_html( andonick_t( 'hero_title_main' ) ); ?> <em><?php echo esc_html( andonick_t( 'hero_title_tail' ) ); ?></em></h1>
			<p class="hero-lead"><?php echo esc_html( andonick_t( 'hero_lead' ) ); ?></p>
			<div class="hero-cta">
				<a href="<?php echo esc_url( andonick_t( 'hero_cta1_href' ) ); ?>" class="btn"><?php echo esc_html( andonick_t( 'hero_cta1' ) ); ?></a>
				<a href="<?php echo esc_url( andonick_t( 'hero_cta2_href' ) ); ?>" class="btn btn-outline-light"><?php echo esc_html( andonick_t( 'hero_cta2' ) ); ?></a>
			</div>

			<div class="hero-stats">
				<div class="stat reveal"><b><span data-count="<?php echo esc_attr( (int) andonick_stat( 'stat1_num' ) ); ?>" data-suffix="<?php echo esc_attr( andonick_t( 'stat1_suffix' ) ); ?>"><?php echo esc_html( andonick_stat( 'stat1_num' ) ); ?></span></b><span><?php echo esc_html( andonick_t( 'stat1' ) ); ?></span></div>
				<div class="stat reveal reveal-delay-1"><b><span data-count="<?php echo esc_attr( (int) andonick_stat( 'stat2_num' ) ); ?>"><?php echo esc_html( andonick_stat( 'stat2_num' ) ); ?></span></b><span><?php echo esc_html( andonick_t( 'stat2' ) ); ?></span></div>
				<div class="stat reveal reveal-delay-2"><b><span data-count="<?php echo esc_attr( (int) andonick_stat( 'stat3_num' ) ); ?>"><?php echo esc_html( andonick_stat( 'stat3_num' ) ); ?></span></b><span><?php echo esc_html( andonick_t( 'stat3' ) ); ?></span></div>
			</div>
		</div>

		<div class="hero-strip">
			<div class="container strip-inner">
				<?php foreach ( andonick_strips() as $strip ) : ?>
					<span><?php echo esc_html( $strip ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Section LE GROUPE.
 */
function andonick_section_groupe() {
	?>
	<section class="section section-group" id="groupe">
		<div class="container group-grid">
			<div class="group-text reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 's2_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 's2_title' ) ); ?></h2>
				<p><?php echo wp_kses_post( andonick_t( 's2_body' ) ); ?></p>
				<ul class="value-list">
					<?php foreach ( andonick_values() as $value ) : ?>
						<li><b><?php echo esc_html( $value ); ?></b></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<figure class="group-media reveal reveal-delay-2">
				<img src="<?php echo esc_url( andonick_img( 'group' ) ); ?>" alt="<?php echo esc_attr( andonick_t( 'img_team_name' ) ); ?>">
				<figcaption><?php echo esc_html( andonick_t( 'hero_cap' ) ); ?></figcaption>
			</figure>
		</div>
	</section>
	<?php
}

/**
 * Section FILIALES — les 8 (ou plus) métiers.
 */
function andonick_section_filiales() {
	$filiales = andonick_filiales();
	if ( empty( $filiales ) ) {
		return;
	}
	?>
	<section class="section section-filiales" id="filiales">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 's3_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 's3_title' ) ); ?></h2>
				<p><?php echo esc_html( andonick_t( 's3_sub' ) ); ?></p>
			</div>

			<div class="filiales-grid">
				<?php foreach ( $filiales as $filiale ) : ?>
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
	<?php
}

/**
 * Section IMPACT.
 */
function andonick_section_impact() {
	$impacts = andonick_impacts();
	?>
	<section class="section section-impact" id="impact">
		<div class="impact-bg" style="background-image:url('<?php echo esc_url( andonick_img( 'impact' ) ); ?>');"></div>
		<div class="container impact-inner">
			<span class="eyebrow eyebrow-light reveal"><?php echo esc_html( andonick_t( 'impact_eyebrow' ) ); ?></span>
			<h2 class="reveal"><?php echo esc_html( andonick_t( 'impact_title' ) ); ?></h2>
			<p class="impact-body reveal reveal-delay-1"><?php echo esc_html( andonick_t( 'impact_body' ) ); ?></p>
			<?php if ( ! empty( $impacts ) ) : ?>
				<div class="impact-grid">
					<?php foreach ( $impacts as $i => $impact ) : ?>
						<div class="impact-item reveal reveal-delay-<?php echo esc_attr( min( $i + 1, 4 ) ); ?>">
							<b><?php echo esc_html( $impact[0] ); ?></b>
							<span><?php echo esc_html( $impact[1] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
}

/**
 * Section GALERIE RÉALISATIONS.
 */
function andonick_section_realisations() {
	$gallery = array_filter( andonick_gallery() );
	if ( empty( $gallery ) ) {
		return;
	}
	?>
	<section class="section section-gallery" id="realisations">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 'gallery_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 'gallery_title' ) ); ?></h2>
				<p><?php echo esc_html( andonick_t( 'gallery_sub' ) ); ?></p>
			</div>
			<div class="gallery-grid">
				<?php foreach ( $gallery as $gi => $gimg ) : ?>
					<figure class="gallery-item reveal reveal-delay-<?php echo esc_attr( ( $gi % 3 ) + 1 ); ?>">
						<img src="<?php echo esc_url( $gimg ); ?>" alt="<?php echo esc_attr( andonick_t( 'gallery_title' ) ); ?>" loading="lazy">
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Section RÉFÉRENCES — témoignages, tableau des références, partenaires.
 */
function andonick_section_references() {
	$testis  = andonick_testis();
	$partners = andonick_partners();
	?>
	<section class="section section-refs" id="references">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 'testi_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 'testi_title' ) ); ?></h2>
			</div>

			<?php if ( ! empty( $testis ) ) : ?>
				<div class="testi-grid">
					<?php foreach ( $testis as $ti => $testi ) : ?>
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
			<?php endif; ?>

			<div class="refs-block reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 'refs_eyebrow' ) ); ?></span>
				<h3><?php echo esc_html( andonick_t( 'refs_title' ) ); ?></h3>
				<div class="refs-table-wrap">
					<table class="refs-table">
						<thead>
							<tr>
								<?php foreach ( andonick_ref_headers() as $header ) : ?>
									<th><?php echo esc_html( $header ); ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( andonick_refs() as $ref ) : ?>
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

				<?php if ( ! empty( $partners ) ) : ?>
					<div class="partners-strip">
						<span class="eyebrow"><?php echo esc_html( andonick_t( 'partners_title' ) ); ?></span>
						<ul>
							<?php foreach ( $partners as $partner ) : ?>
								<li><?php echo esc_html( $partner ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Section CONTACT — coordonnées + formulaires devis / rappel.
 */
function andonick_section_contact() {
	$services = andonick_services();
	$slots    = andonick_slots();
	?>
	<section class="section section-contact" id="contact">
		<div class="container contact-grid">
			<div class="contact-info reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 'contact_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 'contact_title' ) ); ?></h2>
				<p class="contact-sub"><?php echo esc_html( andonick_t( 'contact_sub' ) ); ?></p>

				<div class="contact-block">
					<h4><?php echo esc_html( andonick_t( 'contact_coord' ) ); ?></h4>
					<p><?php echo wp_kses_post( andonick_t( 'contact_addr' ) ); ?></p>
					<p class="contact-phones">
						<a href="tel:<?php echo esc_attr( andonick_tel( 'phone_rca1' ) ); ?>"><?php echo esc_html( andonick_t( 'phone_rca1' ) ); ?></a> /
						<a href="tel:<?php echo esc_attr( andonick_tel( 'phone_rca2' ) ); ?>"><?php echo esc_html( andonick_t( 'phone_rca2' ) ); ?></a>
						<span class="lbl"><?php echo esc_html( andonick_t( 'lbl_rca' ) ); ?></span><br>
						<a href="tel:<?php echo esc_attr( andonick_tel( 'phone_fr' ) ); ?>"><?php echo esc_html( andonick_t( 'phone_fr' ) ); ?></a>
						<span class="lbl"><?php echo esc_html( andonick_t( 'lbl_fr' ) ); ?></span><br>
						<a href="mailto:<?php echo esc_attr( sanitize_email( andonick_t( 'contact_mail' ) ) ); ?>"><?php echo esc_html( andonick_t( 'contact_mail' ) ); ?></a>
					</p>
				</div>

				<div class="contact-channels">
					<a class="btn btn-whatsapp" href="https://wa.me/<?php echo esc_attr( andonick_wa( 'phone_rca1' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( andonick_t( 'wa_rca' ) ); ?></a>
					<a class="btn btn-whatsapp" href="https://wa.me/<?php echo esc_attr( andonick_wa( 'phone_fr' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( andonick_t( 'wa_fr' ) ); ?></a>
					<a class="btn btn-outline" href="tel:<?php echo esc_attr( andonick_tel( 'phone_rca1' ) ); ?>"><?php echo esc_html( andonick_t( 'call_direct' ) ); ?></a>
				</div>
			</div>

			<div class="contact-form-wrap reveal reveal-delay-2" id="devis">
				<div class="form-tabs">
					<button type="button" class="form-tab active" data-tab="devis"><?php echo esc_html( andonick_t( 'tab_devis' ) ); ?></button>
					<button type="button" class="form-tab" data-tab="rappel"><?php echo esc_html( andonick_t( 'tab_rappel' ) ); ?></button>
				</div>

				<div class="form-panel" id="panel-devis">
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="andonick-form">
						<input type="hidden" name="action" value="andonick_contact">
						<input type="hidden" name="andonick_form_type" value="devis">
						<?php wp_nonce_field( 'andonick_contact', 'andonick_nonce' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<div class="form-row">
							<label for="f-name"><?php echo esc_html( andonick_t( 'f_name' ) ); ?></label>
							<input type="text" id="f-name" name="andonick_name" required>
						</div>
						<div class="form-row">
							<label for="f-company"><?php echo esc_html( andonick_t( 'f_company' ) ); ?></label>
							<input type="text" id="f-company" name="andonick_company">
						</div>
						<div class="form-row form-row-2">
							<div>
								<label for="f-phone"><?php echo esc_html( andonick_t( 'f_phone' ) ); ?></label>
								<input type="tel" id="f-phone" name="andonick_phone" required>
							</div>
							<div>
								<label for="f-email"><?php echo esc_html( andonick_t( 'f_email' ) ); ?></label>
								<input type="email" id="f-email" name="andonick_email">
							</div>
						</div>
						<div class="form-row">
							<label for="f-service"><?php echo esc_html( andonick_t( 'f_service' ) ); ?></label>
							<select id="f-service" name="andonick_service" required>
								<?php foreach ( $services as $service ) : ?>
									<option value="<?php echo esc_attr( $service ); ?>"><?php echo esc_html( $service ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-row">
							<label for="f-desc"><?php echo esc_html( andonick_t( 'f_desc' ) ); ?></label>
							<textarea id="f-desc" name="andonick_desc" rows="4" placeholder="<?php echo esc_attr( andonick_t( 'descPlaceholder' ) ); ?>" required></textarea>
						</div>
						<div class="form-row form-row-2">
							<div>
								<label><?php echo esc_html( andonick_t( 'f_slot' ) ); ?></label>
								<select name="andonick_slot">
									<?php foreach ( $slots as $slot ) : ?>
										<option value="<?php echo esc_attr( $slot ); ?>"><?php echo esc_html( $slot ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div>
								<label><?php echo esc_html( andonick_t( 'f_city' ) ); ?></label>
								<input type="text" name="andonick_city" placeholder="<?php echo esc_attr( andonick_t( 'cityPlaceholder' ) ); ?>">
							</div>
						</div>
						<button type="submit" class="btn btn-block"><?php echo esc_html( andonick_t( 'f_submit_devis' ) ); ?></button>
						<p class="form-disclaimer"><?php echo wp_kses_post( andonick_t( 'f_disc_devis' ) ); ?></p>
					</form>
				</div>

				<div class="form-panel" id="panel-rappel" hidden>
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="andonick-form">
						<input type="hidden" name="action" value="andonick_contact">
						<input type="hidden" name="andonick_form_type" value="rappel">
						<?php wp_nonce_field( 'andonick_contact', 'andonick_nonce' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<div class="form-row">
							<label><?php echo esc_html( andonick_t( 'f_name' ) ); ?></label>
							<input type="text" name="andonick_name" required>
						</div>
						<div class="form-row form-row-2">
							<div>
								<label><?php echo esc_html( andonick_t( 'f_phone' ) ); ?></label>
								<input type="tel" name="andonick_phone" required>
							</div>
							<div>
								<label><?php echo esc_html( andonick_t( 'f_object' ) ); ?></label>
								<input type="text" name="andonick_object" placeholder="<?php echo esc_attr( andonick_t( 'objectPlaceholder' ) ); ?>">
							</div>
						</div>
						<div class="form-row form-row-2">
							<div>
								<label><?php echo esc_html( andonick_t( 'f_slot' ) ); ?></label>
								<select name="andonick_slot">
									<?php foreach ( $slots as $slot ) : ?>
										<option value="<?php echo esc_attr( $slot ); ?>"><?php echo esc_html( $slot ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div>
								<label><?php echo esc_html( andonick_t( 'f_city' ) ); ?></label>
								<input type="text" name="andonick_city" placeholder="<?php echo esc_attr( andonick_t( 'cityPlaceholder' ) ); ?>">
							</div>
						</div>
						<button type="submit" class="btn btn-block"><?php echo esc_html( andonick_t( 'f_submit_rappel' ) ); ?></button>
						<p class="form-disclaimer"><?php echo wp_kses_post( andonick_t( 'f_disc_rappel' ) ); ?></p>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php
}