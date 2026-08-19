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
	$default = array( 'hero', 'groupe', 'filiales', 'impact', 'actualites', 'realisations', 'references', 'contact' );
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

			<?php $stats = andonick_stats(); ?>
			<?php if ( ! empty( $stats ) ) : ?>
				<div class="hero-stats">
					<?php $si = 0; ?>
					<?php foreach ( $stats as $stat ) : ?>
						<?php
						$num    = isset( $stat[0] ) ? trim( (string) $stat[0] ) : '';
						$label  = isset( $stat[1] ) ? trim( (string) $stat[1] ) : '';
						$count  = preg_replace( '/[^0-9]/', '', $num );
						$suffix = ( false !== strpos( $num, '+' ) ) ? '+' : '';
						if ( '' === $num && '' === $label ) {
							continue;
						}
						$anim   = ( '1' === andonick_ap( 'counter', '1' ) );
						$reveal = ( '1' === andonick_ap( 'reveal', '1' ) );
						$classes = $reveal ? 'stat reveal reveal-delay-' . ( $si % 3 ) : 'stat';
						?>
						<div class="<?php echo esc_attr( $classes ); ?>">
							<b><?php if ( $anim ) : ?><span data-count="<?php echo esc_attr( $count ); ?>" data-suffix="<?php echo esc_attr( $suffix ); ?>"><?php echo esc_html( $num ); ?></span><?php else : ?><span><?php echo esc_html( $num ); ?></span><?php endif; ?></b>
							<span><?php echo esc_html( $label ); ?></span>
						</div>
						<?php $si++; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
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
 * Section ACTUALITÉS — dernière doublée des articles WordPress.
 * Ne s'affiche que si activée ET si au moins un article existe.
 */
function andonick_section_actualites() {
	if ( ! andonick_news_enabled() ) {
		return;
	}
	$count = absint( andonick_t( 'news_count' ) );
	if ( $count < 1 ) {
		$count = 3;
	}
	$q = new WP_Query( array(
		'post_type'           => 'post',
		'posts_per_page'      => min( $count, 9 ),
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
	) );
	if ( empty( $q->posts ) ) {
		return;
	}
	?>
	<section class="section section-news" id="actualites">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 'news_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 'news_title' ) ); ?></h2>
				<?php if ( '' !== trim( andonick_t( 'news_sub' ) ) ) : ?>
					<p><?php echo esc_html( andonick_t( 'news_sub' ) ); ?></p>
				<?php endif; ?>
			</div>
			<div class="news-grid">
				<?php foreach ( $q->posts as $news ) : ?>
					<article class="news-card reveal">
						<?php if ( has_post_thumbnail( $news ) ) : ?>
							<a class="news-thumb" href="<?php echo esc_url( get_permalink( $news ) ); ?>"><?php echo get_the_post_thumbnail( $news, 'medium_large' ); ?></a>
						<?php endif; ?>
						<time datetime="<?php echo esc_attr( get_the_date( 'c', $news ) ); ?>"><?php echo esc_html( get_the_date( '', $news ) ); ?></time>
						<h3><a href="<?php echo esc_url( get_permalink( $news ) ); ?>"><?php echo esc_html( get_the_title( $news ) ); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $news ), 24, '…' ) ); ?></p>
						<a class="news-more" href="<?php echo esc_url( get_permalink( $news ) ); ?>"><?php echo esc_html( andonick_t( 'news_more' ) ); ?></a>
					</article>
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

				<?php $map_embed = trim( (string) andonick_t( 'map_embed' ) ); ?>
				<?php $map_url   = trim( (string) andonick_t( 'map_url' ) ); ?>
				<?php $map_dir   = trim( (string) andonick_t( 'map_dir' ) ); ?>
				<?php if ( '' !== $map_embed || '' !== $map_url ) : ?>
					<div class="contact-map">
						<?php if ( '' !== $map_dir ) : ?>
							<p class="map-dir"><?php echo esc_html( $map_dir ); ?></p>
						<?php endif; ?>
						<?php if ( '' !== $map_embed ) : ?>
							<iframe src="<?php echo esc_url( $map_embed ); ?>" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
						<?php endif; ?>
						<?php if ( '' !== $map_url ) : ?>
							<a class="btn btn-outline" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( andonick_t( 'map_lien' ) ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
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
						<input type="hidden" name="andonick_lang" value="<?php echo esc_attr( andonick_lang() ); ?>">
						<?php wp_nonce_field( 'andonick_contact', 'andonick_nonce' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<?php $fi = 0; ?>
						<?php foreach ( andonick_form_fields( 'devis' ) as $ffield ) : ?>
							<div class="form-row">
								<label for="f-devis-<?php echo esc_attr( $fi ); ?>"><?php echo esc_html( $ffield['label'] ); ?></label>
								<?php if ( 'select' === $ffield['type'] ) : ?>
									<select id="f-devis-<?php echo esc_attr( $fi ); ?>" name="andonick_f<?php echo esc_attr( $fi ); ?>"<?php echo $ffield['required'] ? ' required' : ''; ?>>
										<?php $options = ( 'slots' === $ffield['options'] ) ? andonick_lines( 'slots', $slots ) : andonick_lines( 'services', $services ); ?>
										<?php foreach ( $options as $option ) : ?>
											<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
										<?php endforeach; ?>
									</select>
								<?php elseif ( 'textarea' === $ffield['type'] ) : ?>
									<textarea id="f-devis-<?php echo esc_attr( $fi ); ?>" name="andonick_f<?php echo esc_attr( $fi ); ?>" rows="4"<?php echo $ffield['required'] ? ' required' : ''; ?>></textarea>
								<?php else : ?>
									<input type="<?php echo esc_attr( $ffield['type'] ); ?>" id="f-devis-<?php echo esc_attr( $fi ); ?>" name="andonick_f<?php echo esc_attr( $fi ); ?>"<?php echo $ffield['required'] ? ' required' : ''; ?>>
								<?php endif; ?>
							</div>
							<?php $fi++; ?>
						<?php endforeach; ?>
						<button type="submit" class="btn btn-block"><?php echo esc_html( andonick_t( 'f_submit_devis' ) ); ?></button>
						<p class="form-disclaimer"><?php echo wp_kses_post( andonick_t( 'f_disc_devis' ) ); ?></p>
					</form>
				</div>

				<div class="form-panel" id="panel-rappel" hidden>
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="andonick-form">
						<input type="hidden" name="action" value="andonick_contact">
						<input type="hidden" name="andonick_form_type" value="rappel">
						<input type="hidden" name="andonick_lang" value="<?php echo esc_attr( andonick_lang() ); ?>">
						<?php wp_nonce_field( 'andonick_contact', 'andonick_nonce' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<?php $ri = 0; ?>
						<?php foreach ( andonick_form_fields( 'rappel' ) as $rfield ) : ?>
							<div class="form-row">
								<label for="f-rappel-<?php echo esc_attr( $ri ); ?>"><?php echo esc_html( $rfield['label'] ); ?></label>
								<?php if ( 'select' === $rfield['type'] ) : ?>
									<select id="f-rappel-<?php echo esc_attr( $ri ); ?>" name="andonick_f<?php echo esc_attr( $ri ); ?>"<?php echo $rfield['required'] ? ' required' : ''; ?>>
										<?php $options = ( 'slots' === $rfield['options'] ) ? andonick_lines( 'slots', $slots ) : andonick_lines( 'services', $services ); ?>
										<?php foreach ( $options as $option ) : ?>
											<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
										<?php endforeach; ?>
									</select>
								<?php elseif ( 'textarea' === $rfield['type'] ) : ?>
									<textarea id="f-rappel-<?php echo esc_attr( $ri ); ?>" name="andonick_f<?php echo esc_attr( $ri ); ?>" rows="4"<?php echo $rfield['required'] ? ' required' : ''; ?>></textarea>
								<?php else : ?>
									<input type="<?php echo esc_attr( $rfield['type'] ); ?>" id="f-rappel-<?php echo esc_attr( $ri ); ?>" name="andonick_f<?php echo esc_attr( $ri ); ?>"<?php echo $rfield['required'] ? ' required' : ''; ?>>
								<?php endif; ?>
							</div>
							<?php $ri++; ?>
						<?php endforeach; ?>
						<button type="submit" class="btn btn-block"><?php echo esc_html( andonick_t( 'f_submit_rappel' ) ); ?></button>
						<p class="form-disclaimer"><?php echo wp_kses_post( andonick_t( 'f_disc_rappel' ) ); ?></p>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php
}
/**
 * Section libre « Texte » — titre, contenu et bouton, édités sans code.
 * Ne s'affiche que si au moins un contenu est rempli.
 */
function andonick_free_texte( $n ) {
	$p       = 'texte' . $n;
	$eyebrow = trim( (string) andonick_t( $p . '_eyebrow' ) );
	$title   = trim( (string) andonick_t( $p . '_title' ) );
	$body    = trim( (string) andonick_t( $p . '_body' ) );
	$btn     = trim( (string) andonick_t( $p . '_btn' ) );
	$href    = trim( (string) andonick_t( $p . '_btn_href' ) );
	if ( '' === $title && '' === $body && '' === $btn ) {
		return;
	}
	?>
	<section class="section section-free" id="<?php echo esc_attr( $p ); ?>">
		<div class="container">
			<?php if ( '' !== $eyebrow || '' !== $title ) : ?>
				<div class="section-head reveal">
					<?php if ( '' !== $eyebrow ) : ?><span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span><?php endif; ?>
					<?php if ( '' !== $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( '' !== $body ) : ?>
				<div class="free-body reveal"><?php echo nl2br( esc_html( $body ) ); ?></div>
			<?php endif; ?>
			<?php if ( '' !== $btn ) : ?>
				<p class="free-cta reveal"><a class="btn" href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $btn ); ?></a></p>
			<?php endif; ?>
		</div>
	</section>
	<?php
}
function andonick_section_texte1() { andonick_free_texte( 1 ); }
function andonick_section_texte2() { andonick_free_texte( 2 ); }
function andonick_section_texte3() { andonick_free_texte( 3 ); }

/**
 * Section libre « Bannière » — pleine largeur, fond violet ou image personnalisée.
 */
function andonick_free_banniere( $n ) {
	$p     = 'banniere' . $n;
	$title = trim( (string) andonick_t( $p . '_title' ) );
	$body  = trim( (string) andonick_t( $p . '_body' ) );
	$btn   = trim( (string) andonick_t( $p . '_btn' ) );
	$href  = trim( (string) andonick_t( $p . '_btn_href' ) );
	if ( '' === $title && '' === $body && '' === $btn ) {
		return;
	}
	$bg = andonick_ap_bg( $p );
	?>
	<section class="section section-banner" id="<?php echo esc_attr( $p ); ?>"<?php if ( '' !== $bg ) : ?> style="background-image:linear-gradient(rgba(42,10,99,0.84),rgba(42,10,99,0.84)),url('<?php echo esc_url( $bg ); ?>');background-size:cover;background-position:center;"<?php endif; ?>>
		<div class="container banner-inner">
			<?php if ( '' !== $title ) : ?><h2 class="banner-title reveal"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
			<?php if ( '' !== $body ) : ?><p class="banner-body reveal"><?php echo nl2br( esc_html( $body ) ); ?></p><?php endif; ?>
			<?php if ( '' !== $btn ) : ?><p class="banner-cta reveal"><a class="btn btn-outline-light" href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $btn ); ?></a></p><?php endif; ?>
		</div>
	</section>
	<?php
}
function andonick_section_banniere1() { andonick_free_banniere( 1 ); }
function andonick_section_banniere2() { andonick_free_banniere( 2 ); }
function andonick_section_banniere3() { andonick_free_banniere( 3 ); }
