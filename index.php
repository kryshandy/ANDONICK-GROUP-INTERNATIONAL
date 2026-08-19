<?php
/**
 * Gabarit de repli — redirige tout le contenu vers la page d'accueil.
 *
 * @package Andonick
 */

if ( is_front_page() ) {
	get_template_part( 'front-page' );
} else {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}