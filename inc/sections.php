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
	$default = array_merge(
		array( 'hero', 'groupe', 'filiales', 'projets', 'references', 'realisations', 'impact', 'actualites', 'contact' ),
		andonick_free_sections()
	);
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

			<?php $hero_partners = andonick_partners(); ?>
			<?php if ( ! empty( $hero_partners ) ) : ?>
				<div class="hero-trust" aria-label="<?php echo esc_attr( andonick_t( 'partners_title' ) ); ?>">
					<span><?php echo esc_html( andonick_t( 'partners_title' ) ); ?></span>
					<ul>
						<?php foreach ( $hero_partners as $partner ) : ?>
							<li><?php echo esc_html( $partner ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php $engagement_steps = andonick_engagement_steps(); ?>
			<?php if ( ! empty( $engagement_steps ) ) : ?>
				<ol class="engagement-rail" aria-label="<?php echo esc_attr( andonick_t( 's2_title' ) ); ?>">
					<?php foreach ( $engagement_steps as $step ) : ?>
						<li><?php echo esc_html( $step ); ?></li>
					<?php endforeach; ?>
				</ol>
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
 * Fond d'une section non-image : light (clair), tint (teinté), dark (violet).
 */
function andonick_sec_bg( $key, $default = 'light' ) {
	$choice = andonick_ap( 'secbg_' . $key, $default );
	return in_array( $choice, array( 'light', 'tint', 'dark' ), true ) ? esc_attr( $choice ) : esc_attr( $default );
}

/**
 * Section GROUPE.
 */
function andonick_section_groupe() {
	$group_img = andonick_img( 'group' );
	$values = andonick_values();
	if ( '' === trim( (string) andonick_t( 's2_eyebrow' ) ) && '' === trim( (string) andonick_t( 's2_title' ) ) && '' === trim( (string) andonick_t( 's2_body' ) ) && empty( $values ) && '' === $group_img ) {
		return;
	}
	?>
	<section class="section section-group section-bg-<?php echo andonick_sec_bg( 'groupe', 'light' ); ?>" id="groupe">
		<div class="container group-grid">
			<div class="group-text reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 's2_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 's2_title' ) ); ?></h2>
				<p><?php echo wp_kses_post( andonick_t( 's2_body' ) ); ?></p>
				<?php if ( ! empty( $values ) ) : ?><ul class="value-list">
					<?php foreach ( $values as $value ) : ?>
						<li><b><?php echo esc_html( $value ); ?></b></li>
					<?php endforeach; ?>
				</ul><?php endif; ?>
			</div>
			<?php if ( '' !== $group_img ) : ?><figure class="group-media reveal reveal-delay-2">
				<img src="<?php echo esc_url( $group_img ); ?>" alt="<?php echo esc_attr( andonick_t( 'img_team_name' ) ); ?>">
				<?php if ( '' !== trim( (string) andonick_t( 'hero_cap' ) ) ) : ?><figcaption><?php echo esc_html( andonick_t( 'hero_cap' ) ); ?></figcaption><?php endif; ?>
			</figure><?php endif; ?>
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
	<section class="section section-filiales section-bg-<?php echo andonick_sec_bg( 'filiales', 'tint' ); ?>" id="filiales">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 's3_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 's3_title' ) ); ?></h2>
				<p><?php echo esc_html( andonick_t( 's3_sub' ) ); ?></p>
			</div>

			<div class="filiales-grid">
				<?php $fi = 0; foreach ( $filiales as $filiale ) : $fi++; $img = andonick_filiale_img( $fi ); ?>
					<article class="filiale-card reveal<?php echo $img ? ' has-media' : ''; ?>" data-num="<?php echo esc_attr( $filiale['num'] ); ?>">
						<?php if ( $img ) : ?>
							<div class="filiale-media">
								<span class="filiale-badge"><?php echo esc_html( $filiale['num'] ); ?></span>
								<img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( ! empty( $filiale['alt'] ) ? $filiale['alt'] : $filiale['title'] ); ?>" loading="lazy">
							</div>
						<?php endif; ?>
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
	$impact_img = andonick_img( 'impact' );
	if ( empty( $impacts ) && '' === trim( (string) andonick_t( 'impact_eyebrow' ) ) && '' === trim( (string) andonick_t( 'impact_title' ) ) && '' === trim( (string) andonick_t( 'impact_body' ) ) && '' === $impact_img ) {
		return;
	}
	?>
	<section class="section section-impact" id="impact">
		<?php if ( '' !== $impact_img ) : ?><div class="impact-bg" style="background-image:url('<?php echo esc_url( $impact_img ); ?>');"></div><?php endif; ?>
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
	$gallery = andonick_gallery_items();
	if ( empty( $gallery ) ) {
		return;
	}
	?>
	<section class="section section-gallery section-bg-<?php echo andonick_sec_bg( 'realisations', 'light' ); ?>" id="realisations">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 'gallery_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( andonick_t( 'gallery_title' ) ); ?></h2>
				<p><?php echo esc_html( andonick_t( 'gallery_sub' ) ); ?></p>
			</div>
			<div class="gallery-grid">
				<?php foreach ( $gallery as $gi => $gimg ) : ?>
<figure class="gallery-item reveal reveal-delay-<?php echo esc_attr( ( $gi % 3 ) + 1 ); ?>">
						<a class="gallery-link" href="<?php echo esc_url( $gimg['url'] ); ?>" aria-label="<?php echo esc_attr( andonick_t( 'gallery_zoom' ) . ' — ' . $gimg['alt'] ); ?>">
							<img src="<?php echo esc_url( $gimg['url'] ); ?>" alt="<?php echo esc_attr( $gimg['alt'] ); ?>" loading="lazy">
						</a>
						<?php if ( '' !== $gimg['caption'] ) : ?><figcaption><?php echo esc_html( $gimg['caption'] ); ?></figcaption><?php endif; ?>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}

/** Section PROJETS & PREUVES TERRAIN — données structurées par ANDONICK Core. */
function andonick_section_projets() {
	$projects = andonick_projects();
	if ( empty( $projects ) ) {
		return;
	}
	?>
	<section class="section section-projects section-bg-<?php echo andonick_sec_bg( 'projets', 'light' ); ?>" id="projets">
		<div class="container">
			<div class="section-head reveal">
				<?php if ( '' !== trim( (string) andonick_t( 'projects_eyebrow' ) ) ) : ?><span class="eyebrow"><?php echo esc_html( andonick_t( 'projects_eyebrow' ) ); ?></span><?php endif; ?>
				<?php if ( '' !== trim( (string) andonick_t( 'projects_title' ) ) ) : ?><h2><?php echo esc_html( andonick_t( 'projects_title' ) ); ?></h2><?php endif; ?>
				<?php if ( '' !== trim( (string) andonick_t( 'projects_sub' ) ) ) : ?><p><?php echo esc_html( andonick_t( 'projects_sub' ) ); ?></p><?php endif; ?>
			</div>
			<div class="projects-grid">
				<?php foreach ( $projects as $project ) : ?>
					<article class="project-card reveal">
						<?php if ( ! empty( $project['logo'] ) ) : ?><img class="project-logo" src="<?php echo esc_url( $project['logo'] ); ?>" alt="" loading="lazy"><?php endif; ?>
						<?php if ( ! empty( $project['domains'] ) ) : ?><p class="project-domains"><?php echo esc_html( implode( ' · ', $project['domains'] ) ); ?></p><?php endif; ?>
						<?php if ( '' !== $project['title'] ) : ?><h3><?php echo esc_html( $project['title'] ); ?></h3><?php endif; ?>
						<?php if ( '' !== $project['description'] ) : ?><p class="project-description"><?php echo esc_html( $project['description'] ); ?></p><?php endif; ?>
						<?php if ( '' !== $project['location'] ) : ?><p class="project-location"><?php echo esc_html( $project['location'] ); ?></p><?php endif; ?>
						<?php if ( '' !== $project['proof'] ) : ?><p class="project-proof"><?php echo esc_html( $project['proof'] ); ?></p><?php endif; ?>
						<?php if ( '' !== $project['link'] ) : ?><p><a class="project-link" href="<?php echo esc_url( $project['link'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( andonick_t( 'projects_link' ) ); ?></a></p><?php endif; ?>
					</article>
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
		'cat'                 => andonick_news_cat( andonick_lang() ),
	) );
	if ( empty( $q->posts ) ) {
		return;
	}
	?>
	<section class="section section-news section-bg-<?php echo andonick_sec_bg( 'actualites', 'light' ); ?>" id="actualites">
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
							<a class="news-thumb" href="<?php echo esc_url( andonick_url_in_language( get_permalink( $news ), andonick_lang() ) ); ?>"><?php echo get_the_post_thumbnail( $news, 'medium_large' ); ?></a>
						<?php endif; ?>
						<time datetime="<?php echo esc_attr( get_the_date( 'c', $news ) ); ?>"><?php echo esc_html( get_the_date( '', $news ) ); ?></time>
						<h3><a href="<?php echo esc_url( andonick_url_in_language( get_permalink( $news ), andonick_lang() ) ); ?>"><?php echo esc_html( get_the_title( $news ) ); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $news ), andonick_excerpt_words(), '…' ) ); ?></p>
						<a class="news-more" href="<?php echo esc_url( andonick_url_in_language( get_permalink( $news ), andonick_lang() ) ); ?>"><?php echo esc_html( andonick_t( 'news_more' ) ); ?></a>
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
	$refs    = andonick_refs();
	$headers = array_values( array_filter( array_map( 'trim', andonick_ref_headers() ), 'strlen' ) );
	/* Une quatrième colonne doit être explicitement nommée. Les anciennes
	 * lignes à quatre valeurs ne peuvent ainsi republier un téléphone privé. */
	$column_count = count( $headers ) >= 4 ? 4 : 3;
	if ( empty( $testis ) && empty( $refs ) && '' === trim( (string) andonick_t( 'refs_title' ) ) && '' === trim( (string) andonick_t( 'refs_eyebrow' ) ) ) {
		return;
	}
	?>
<section class="section section-refs section-bg-<?php echo andonick_sec_bg( 'references', 'light' ); ?>" id="references">
		<div class="container">
			<?php if ( ! empty( $testis ) ) : ?>
				<div class="section-head reveal">
					<span class="eyebrow"><?php echo esc_html( andonick_t( 'testi_eyebrow' ) ); ?></span>
					<h2><?php echo esc_html( andonick_t( 'testi_title' ) ); ?></h2>
				</div>

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

			<?php if ( ! empty( $refs ) ) : ?><div class="refs-block reveal">
				<span class="eyebrow"><?php echo esc_html( andonick_t( 'refs_eyebrow' ) ); ?></span>
				<h3><?php echo esc_html( andonick_t( 'refs_title' ) ); ?></h3>
				<div class="refs-table-wrap">
					<table class="refs-table">
						<caption><?php echo esc_html( andonick_t( 'refs_caption' ) ); ?></caption>
						<thead>
							<tr>
								<?php foreach ( array_slice( $headers, 0, $column_count ) as $header ) : ?>
									<th scope="col"><?php echo esc_html( $header ); ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $refs as $ref ) : ?>
								<tr>
									<?php for ( $ci = 0; $ci < $column_count; $ci++ ) : ?>
										<?php if ( 0 === $ci ) : ?><th scope="row"><?php echo esc_html( isset( $ref[ $ci ] ) ? $ref[ $ci ] : '' ); ?></th><?php else : ?><td><?php echo esc_html( isset( $ref[ $ci ] ) ? $ref[ $ci ] : '' ); ?></td><?php endif; ?>
									<?php endfor; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			</div><?php endif; ?>
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
	<section class="section section-contact section-bg-<?php echo andonick_sec_bg( 'contact', 'tint' ); ?>" id="contact">
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
				<?php $map_allowed = isset( $_GET['andonick_map'] ) && '1' === sanitize_key( wp_unslash( $_GET['andonick_map'] ) ); ?>
				<?php if ( '' !== $map_embed || '' !== $map_url ) : ?>
					<div class="contact-map">
						<?php if ( '' !== $map_dir ) : ?>
							<p class="map-dir"><?php echo esc_html( $map_dir ); ?></p>
						<?php endif; ?>
						<?php if ( '' !== $map_embed && $map_allowed ) : ?>
							<iframe src="<?php echo esc_url( $map_embed ); ?>" title="<?php echo esc_attr( andonick_t( 'map_title' ) ); ?>" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
						<?php elseif ( '' !== $map_embed ) : ?>
							<form class="map-consent" method="get" action="<?php echo esc_url( andonick_current_url() ); ?>">
								<?php if ( 'en' === andonick_lang() ) : ?><input type="hidden" name="lang" value="en"><?php endif; ?>
								<input type="hidden" name="andonick_map" value="1">
								<p><?php echo esc_html( andonick_t( 'map_consent' ) ); ?></p>
								<button class="btn btn-outline" type="submit"><?php echo esc_html( andonick_t( 'map_consent_btn' ) ); ?></button>
							</form>
						<?php endif; ?>
						<?php if ( '' !== $map_url ) : ?>
							<a class="btn btn-outline" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( andonick_t( 'map_lien' ) ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

<div class="contact-form-wrap reveal reveal-delay-2" id="devis">
				<?php $tab_devis  = andonick_form_enabled( 'devis' ); ?>
				<?php $tab_rappel = andonick_form_enabled( 'rappel' ); ?>
				<?php $active_form = andonick_form_active(); ?>
				<?php if ( 'rappel' === $active_form && ! $tab_rappel ) { $active_form = 'devis'; } ?>
				<?php if ( 'devis' === $active_form && ! $tab_devis ) { $active_form = 'rappel'; } ?>
				<?php if ( $tab_devis || $tab_rappel ) : ?>
				<div class="form-tabs" role="tablist" aria-label="<?php echo esc_attr( andonick_t( 'contact_title' ) ); ?>">
					<?php if ( $tab_devis ) : ?>
						<button type="button" class="form-tab<?php echo 'devis' === $active_form ? ' active' : ''; ?>" id="tab-devis" data-tab="devis" role="tab" aria-selected="<?php echo 'devis' === $active_form ? 'true' : 'false'; ?>" aria-controls="panel-devis"><?php echo esc_html( andonick_t( 'tab_devis' ) ); ?></button>
					<?php endif; ?>
					<?php if ( $tab_rappel ) : ?>
						<button type="button" class="form-tab<?php echo 'rappel' === $active_form ? ' active' : ''; ?>" id="tab-rappel" data-tab="rappel" role="tab" aria-selected="<?php echo 'rappel' === $active_form ? 'true' : 'false'; ?>" aria-controls="panel-rappel"><?php echo esc_html( andonick_t( 'tab_rappel' ) ); ?></button>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<?php if ( $tab_devis ) : ?>
				<div class="form-panel" id="panel-devis" role="tabpanel" aria-labelledby="tab-devis"<?php echo 'devis' !== $active_form ? ' hidden' : ''; ?>>
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="andonick-form">
						<input type="hidden" name="action" value="andonick_contact">
						<input type="hidden" name="andonick_form_type" value="devis">
						<input type="hidden" name="andonick_lang" value="<?php echo esc_attr( andonick_lang() ); ?>">
						<input type="hidden" name="andonick_started" value="<?php echo esc_attr( time() ); ?>">
						<?php wp_nonce_field( 'andonick_contact_devis', 'andonick_nonce_devis' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<?php $fi = 0; ?>
						<?php foreach ( andonick_form_fields( 'devis' ) as $ffield ) : ?>
							<div class="form-row">
								<label for="f-devis-<?php echo esc_attr( $fi ); ?>"><?php echo esc_html( $ffield['label'] ); ?></label>
								<?php if ( 'select' === $ffield['type'] ) : ?>
									<select id="f-devis-<?php echo esc_attr( $fi ); ?>" name="andonick_f<?php echo esc_attr( $fi ); ?>"<?php echo $ffield['required'] ? ' required' : ''; ?>>
										<option value=""><?php echo esc_html( andonick_t( 'form_select_placeholder' ) ); ?></option>
										<?php $options = ( 'slots' === $ffield['options'] ) ? andonick_lines( 'slots', $slots ) : andonick_lines( 'services', $services ); ?>
										<?php foreach ( $options as $option ) : ?>
											<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
										<?php endforeach; ?>
									</select>
								<?php elseif ( 'checkbox' === $ffield['type'] ) : ?>
									<input type="checkbox" id="f-devis-<?php echo esc_attr( $fi ); ?>" name="andonick_f<?php echo esc_attr( $fi ); ?>" value="1"<?php echo $ffield['required'] ? ' required' : ''; ?>>
								<?php elseif ( 'textarea' === $ffield['type'] ) : ?>
									<textarea id="f-devis-<?php echo esc_attr( $fi ); ?>" name="andonick_f<?php echo esc_attr( $fi ); ?>" rows="4"<?php echo $ffield['required'] ? ' required' : ''; ?>></textarea>
								<?php else : ?>
									<input type="<?php echo esc_attr( $ffield['type'] ); ?>" id="f-devis-<?php echo esc_attr( $fi ); ?>" name="andonick_f<?php echo esc_attr( $fi ); ?>"<?php echo $ffield['required'] ? ' required' : ''; ?>>
								<?php endif; ?>
							</div>
							<?php $fi++; ?>
						<?php endforeach; ?>
						<?php if ( '0' !== get_theme_mod( 'andonick_form_consent_enabled', '1' ) ) : ?>
							<p class="form-consent"><label for="andonick-consent-devis"><input type="checkbox" id="andonick-consent-devis" name="andonick_consent" value="1" required> <?php echo esc_html( andonick_t( 'form_consent' ) ); ?></label><?php $privacy_url = andonick_privacy_page_url(); if ( $privacy_url ) : ?> <a href="<?php echo esc_url( $privacy_url ); ?>"><?php echo esc_html( andonick_t( 'form_consent_link' ) ); ?></a><?php endif; ?></p>
						<?php endif; ?>
						<button type="submit" class="btn btn-block"><?php echo esc_html( andonick_t( 'f_submit_devis' ) ); ?></button>
<p class="form-disclaimer"><?php echo wp_kses_post( andonick_t( 'f_disc_devis' ) ); ?></p>
					</form>
				</div>
				<?php endif; ?>

				<?php if ( $tab_rappel ) : ?>
				<div class="form-panel" id="panel-rappel" role="tabpanel" aria-labelledby="tab-rappel"<?php echo 'rappel' !== $active_form ? ' hidden' : ''; ?>>
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" class="andonick-form">
						<input type="hidden" name="action" value="andonick_contact">
						<input type="hidden" name="andonick_form_type" value="rappel">
						<input type="hidden" name="andonick_lang" value="<?php echo esc_attr( andonick_lang() ); ?>">
						<input type="hidden" name="andonick_started" value="<?php echo esc_attr( time() ); ?>">
						<?php wp_nonce_field( 'andonick_contact_rappel', 'andonick_nonce_rappel' ); ?>
						<div style="display:none;"><input type="text" name="andonick_website" tabindex="-1" autocomplete="off"></div>

						<?php $ri = 0; ?>
						<?php foreach ( andonick_form_fields( 'rappel' ) as $rfield ) : ?>
							<div class="form-row">
								<label for="f-rappel-<?php echo esc_attr( $ri ); ?>"><?php echo esc_html( $rfield['label'] ); ?></label>
								<?php if ( 'select' === $rfield['type'] ) : ?>
									<select id="f-rappel-<?php echo esc_attr( $ri ); ?>" name="andonick_f<?php echo esc_attr( $ri ); ?>"<?php echo $rfield['required'] ? ' required' : ''; ?>>
										<option value=""><?php echo esc_html( andonick_t( 'form_select_placeholder' ) ); ?></option>
										<?php $options = ( 'slots' === $rfield['options'] ) ? andonick_lines( 'slots', $slots ) : andonick_lines( 'services', $services ); ?>
										<?php foreach ( $options as $option ) : ?>
											<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
										<?php endforeach; ?>
									</select>
								<?php elseif ( 'checkbox' === $rfield['type'] ) : ?>
									<input type="checkbox" id="f-rappel-<?php echo esc_attr( $ri ); ?>" name="andonick_f<?php echo esc_attr( $ri ); ?>" value="1"<?php echo $rfield['required'] ? ' required' : ''; ?>>
								<?php elseif ( 'textarea' === $rfield['type'] ) : ?>
									<textarea id="f-rappel-<?php echo esc_attr( $ri ); ?>" name="andonick_f<?php echo esc_attr( $ri ); ?>" rows="4"<?php echo $rfield['required'] ? ' required' : ''; ?>></textarea>
								<?php else : ?>
									<input type="<?php echo esc_attr( $rfield['type'] ); ?>" id="f-rappel-<?php echo esc_attr( $ri ); ?>" name="andonick_f<?php echo esc_attr( $ri ); ?>"<?php echo $rfield['required'] ? ' required' : ''; ?>>
								<?php endif; ?>
							</div>
							<?php $ri++; ?>
						<?php endforeach; ?>
						<?php if ( '0' !== get_theme_mod( 'andonick_form_consent_enabled', '1' ) ) : ?>
							<p class="form-consent"><label for="andonick-consent-rappel"><input type="checkbox" id="andonick-consent-rappel" name="andonick_consent" value="1" required> <?php echo esc_html( andonick_t( 'form_consent' ) ); ?></label><?php $privacy_url = andonick_privacy_page_url(); if ( $privacy_url ) : ?> <a href="<?php echo esc_url( $privacy_url ); ?>"><?php echo esc_html( andonick_t( 'form_consent_link' ) ); ?></a><?php endif; ?></p>
						<?php endif; ?>
						<button type="submit" class="btn btn-block"><?php echo esc_html( andonick_t( 'f_submit_rappel' ) ); ?></button>
<p class="form-disclaimer"><?php echo wp_kses_post( andonick_t( 'f_disc_rappel' ) ); ?></p>
					</form>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
}
/**
 * Section libre « Texte » — titre, contenu et bouton, édités sans code.
 * Ne s'affiche que si au moins un contenu est rempli.
 */
function andonick_free_texte_img( $n ) {
	$img = trim( (string) get_theme_mod( 'andonick_img_texte' . $n, '' ) );
	if ( '' === $img ) {
		return null;
	}
	$pos = get_theme_mod( 'andonick_texte' . $n . '_img_pos', 'left' );
	$pos = ( 'right' === $pos ) ? 'right' : 'left';
	return array( $img, $pos );
}

function andonick_free_texte( $n ) {
	$p       = 'texte' . $n;
	$eyebrow = trim( (string) andonick_t( $p . '_eyebrow' ) );
	$title   = trim( (string) andonick_t( $p . '_title' ) );
	$body    = trim( (string) andonick_t( $p . '_body' ) );
	$btn     = trim( (string) andonick_t( $p . '_btn' ) );
	$href    = trim( (string) andonick_t( $p . '_btn_href' ) );
	$media   = andonick_free_texte_img( $n );
	if ( '' === $eyebrow && '' === $title && '' === $body && '' === $btn && ! $media ) {
		return;
	}
	?>
	<section class="section section-free" id="<?php echo esc_attr( $p ); ?>">
		<div class="container">
			<div class="free-layout<?php echo $media && 'right' === $media[1] ? ' pos-right' : ''; ?>">
				<?php if ( $media ) : ?>
					<figure class="free-media reveal">
						<img src="<?php echo esc_url( $media[0] ); ?>" alt="<?php echo esc_attr( '' !== trim( (string) andonick_t( $p . '_img_alt' ) ) ? andonick_t( $p . '_img_alt' ) : $title ); ?>" loading="lazy">
					</figure>
				<?php endif; ?>
				<div class="free-content">
					<?php if ( '' !== $eyebrow || '' !== $title ) : ?>
						<div class="section-head reveal">
							<?php if ( '' !== $eyebrow ) : ?><span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span><?php endif; ?>
							<?php if ( '' !== $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if ( '' !== $body ) : ?>
						<div class="free-body reveal"><?php echo nl2br( esc_html( $body ) ); ?></div>
					<?php endif; ?>
					<?php if ( '' !== $btn && '' !== $href ) : ?>
						<p class="free-cta reveal"><a class="btn" href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $btn ); ?></a></p>
					<?php endif; ?>
				</div>
			</div>
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
	if ( '' === $title && '' === $body && ( '' === $btn || '' === $href ) ) {
		return;
	}
	$bg = andonick_ap_bg( $p );
	?>
	<section class="section section-banner" id="<?php echo esc_attr( $p ); ?>"<?php if ( '' !== $bg ) : ?> style="background-image:linear-gradient(rgba(42,10,99,0.84),rgba(42,10,99,0.84)),url('<?php echo esc_url( $bg ); ?>');background-size:cover;background-position:center;"<?php endif; ?>>
		<div class="container banner-inner">
			<?php if ( '' !== $title ) : ?><h2 class="banner-title reveal"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
			<?php if ( '' !== $body ) : ?><p class="banner-body reveal"><?php echo nl2br( esc_html( $body ) ); ?></p><?php endif; ?>
			<?php if ( '' !== $btn && '' !== $href ) : ?><p class="banner-cta reveal"><a class="btn btn-outline-light" href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $btn ); ?></a></p><?php endif; ?>
		</div>
	</section>
	<?php
}
function andonick_section_banniere1() { andonick_free_banniere( 1 ); }
function andonick_section_banniere2() { andonick_free_banniere( 2 ); }
function andonick_section_banniere3() { andonick_free_banniere( 3 ); }
