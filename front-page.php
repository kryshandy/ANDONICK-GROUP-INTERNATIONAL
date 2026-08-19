<?php
/**
 * Page d'accueil — one page ANDONICK Group International.
 *
 * Les sections sont rendues dans l'ordre défini par
 * Apparence → Personnaliser → ANDONICK — Structure & Ordre.
 *
 * @package Andonick
 */

get_header();
?>

<main id="accueil">
	<?php
	foreach ( andonick_section_order() as $section ) {
		$render = 'andonick_section_' . $section;
		if ( function_exists( $render ) ) {
			$render();
		}
	}
	?>
</main>

<?php
get_footer();