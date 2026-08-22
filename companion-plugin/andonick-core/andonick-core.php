<?php
/**
 * Plugin Name: ANDONICK Core
 * Description: Demandes, preuves terrain et gouvernance des données du site ANDONICK, indépendamment du thème.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Webmaster ANDONICK
 * Text Domain: andonick-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ANDONICK_CORE_VERSION', '1.0.0' );
define( 'ANDONICK_CORE_SETTINGS', 'andonick_core_settings' );
define( 'ANDONICK_CORE_CRON', 'andonick_core_daily_retention' );

/** Réglages opérationnels, avec valeurs sûres. */
function andonick_core_settings() {
	$defaults = array(
		'retention_days'  => 365,
		'rate_limit_count'=> 5,
		'rate_window'     => 15,
		'min_fill_seconds'=> 2,
	);
	$saved = get_option( ANDONICK_CORE_SETTINGS, array() );
	return wp_parse_args( is_array( $saved ) ? $saved : array(), $defaults );
}

/** CPT privé des demandes ; le slug historique est conservé pour les données existantes. */
function andonick_core_register_leads() {
	register_post_type( 'andonick_lead', array(
		'labels' => array(
			'name'          => __( 'Demandes du site', 'andonick-core' ),
			'singular_name' => __( 'Demande du site', 'andonick-core' ),
			'menu_name'     => __( 'Demandes', 'andonick-core' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'exclude_from_search' => true,
		'supports'            => array( 'title', 'editor' ),
		'menu_icon'           => 'dashicons-email-alt',
		'capabilities'        => array(
			'edit_post'            => 'manage_options',
			'read_post'            => 'manage_options',
			'delete_post'          => 'manage_options',
			'edit_posts'           => 'manage_options',
			'edit_others_posts'    => 'manage_options',
			'delete_posts'         => 'manage_options',
			'delete_private_posts' => 'manage_options',
			'edit_private_posts'   => 'manage_options',
			'read_private_posts'   => 'manage_options',
			'publish_posts'        => 'manage_options',
			'create_posts'         => 'do_not_allow',
		),
		'map_meta_cap'        => false,
	) );
}

/** Projets/preuves structurés : éditables, mais sans pages publiques individuelles. */
function andonick_core_register_projects() {
	register_post_type( 'andonick_project', array(
		'labels' => array(
			'name'          => __( 'Projets & preuves', 'andonick-core' ),
			'singular_name' => __( 'Projet / preuve', 'andonick-core' ),
			'add_new_item'  => __( 'Ajouter un projet / une preuve', 'andonick-core' ),
			'edit_item'     => __( 'Modifier le projet / la preuve', 'andonick-core' ),
		),
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => false,
		'exclude_from_search' => true,
		'supports'            => array( 'title', 'page-attributes' ),
		'menu_icon'           => 'dashicons-portfolio',
	) );

	register_taxonomy( 'andonick_domain', array( 'andonick_project' ), array(
		'labels' => array(
			'name'          => __( '8 domaines d’activité', 'andonick-core' ),
			'singular_name' => __( 'Domaine d’activité', 'andonick-core' ),
		),
		'public'            => false,
		'publicly_queryable'=> false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'rewrite'           => false,
	) );
}
add_action( 'init', 'andonick_core_register_leads' );
add_action( 'init', 'andonick_core_register_projects' );

/** Champs bilingues et médias optionnels des preuves terrain. */
function andonick_core_project_metaboxes() {
	add_meta_box(
		'andonick_project_details',
		__( 'Contenu bilingue et preuve', 'andonick-core' ),
		'andonick_core_project_metabox',
		'andonick_project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'andonick_core_project_metaboxes' );

function andonick_core_project_metabox( $post ) {
	wp_nonce_field( 'andonick_core_save_project', 'andonick_core_project_nonce' );
	$fields = array(
		'title_fr'       => 'Titre — français',
		'title_en'       => 'Title — English',
		'description_fr' => 'Description — français',
		'description_en' => 'Description — English',
		'location_fr'    => 'Lieu — français',
		'location_en'    => 'Location — English',
		'proof_label'    => 'Source / organisation (sans personne physique)',
		'link_url'       => 'Lien public de preuve (optionnel)',
	);
	foreach ( $fields as $key => $label ) {
		$value = get_post_meta( $post->ID, '_andonick_project_' . $key, true );
		$is_long = false !== strpos( $key, 'description_' );
		?>
		<p>
			<label for="andonick-project-<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $label ); ?></strong></label><br>
			<?php if ( $is_long ) : ?>
				<textarea class="widefat" rows="4" id="andonick-project-<?php echo esc_attr( $key ); ?>" name="andonick_project[<?php echo esc_attr( $key ); ?>]"><?php echo esc_textarea( $value ); ?></textarea>
			<?php else : ?>
				<input class="widefat" type="<?php echo false !== strpos( $key, '_url' ) ? 'url' : 'text'; ?>" id="andonick-project-<?php echo esc_attr( $key ); ?>" name="andonick_project[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>">
			<?php endif; ?>
		</p>
		<?php
	}
	$logo_id = absint( get_post_meta( $post->ID, '_andonick_project_logo_id', true ) );
	$logo_src = $logo_id ? wp_get_attachment_image_url( $logo_id, 'thumbnail' ) : '';
	?>
	<p><strong><?php esc_html_e( 'Logo autorisé (optionnel)', 'andonick-core' ); ?></strong></p>
	<div id="andonick-project-logo-preview"><?php if ( $logo_src ) : ?><img src="<?php echo esc_url( $logo_src ); ?>" alt="" style="max-width:160px;height:auto;"><?php endif; ?></div>
	<input type="hidden" id="andonick-project-logo-id" name="andonick_project[logo_id]" value="<?php echo esc_attr( $logo_id ); ?>">
	<p><button type="button" class="button" id="andonick-project-logo-select"><?php esc_html_e( 'Choisir dans la médiathèque', 'andonick-core' ); ?></button> <button type="button" class="button-link-delete" id="andonick-project-logo-remove"><?php esc_html_e( 'Retirer', 'andonick-core' ); ?></button></p>
	<?php
	$enabled = '0' !== get_post_meta( $post->ID, '_andonick_project_enabled', true );
	?>
	<p><label><input type="checkbox" name="andonick_project[enabled]" value="1" <?php checked( $enabled ); ?>> <?php esc_html_e( 'Afficher ce projet dans la section du site', 'andonick-core' ); ?></label></p>
	<p class="description"><?php esc_html_e( 'Le titre WordPress sert seulement de repère interne. Utilisez les champs FR/EN ci-dessus pour le site.', 'andonick-core' ); ?></p>
	<?php
}

function andonick_core_save_project( $post_id ) {
	if ( ! isset( $_POST['andonick_core_project_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['andonick_core_project_nonce'] ) ), 'andonick_core_save_project' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) || ! isset( $_POST['andonick_project'] ) || ! is_array( $_POST['andonick_project'] ) ) {
		return;
	}
	$data = wp_unslash( $_POST['andonick_project'] );
	$text_fields = array( 'title_fr', 'title_en', 'location_fr', 'location_en', 'proof_label' );
	foreach ( $text_fields as $field ) {
		update_post_meta( $post_id, '_andonick_project_' . $field, sanitize_text_field( isset( $data[ $field ] ) ? $data[ $field ] : '' ) );
	}
	foreach ( array( 'description_fr', 'description_en' ) as $field ) {
		update_post_meta( $post_id, '_andonick_project_' . $field, sanitize_textarea_field( isset( $data[ $field ] ) ? $data[ $field ] : '' ) );
	}
	foreach ( array( 'link_url' ) as $field ) {
		update_post_meta( $post_id, '_andonick_project_' . $field, esc_url_raw( isset( $data[ $field ] ) ? $data[ $field ] : '' ) );
	}
	update_post_meta( $post_id, '_andonick_project_logo_id', absint( isset( $data['logo_id'] ) ? $data['logo_id'] : 0 ) );
	update_post_meta( $post_id, '_andonick_project_enabled', isset( $data['enabled'] ) ? '1' : '0' );
}
add_action( 'save_post_andonick_project', 'andonick_core_save_project' );

/** Sélecteur média natif pour le logo, sans dépendance externe. */
function andonick_core_project_admin_assets( $hook ) {
	$screen = get_current_screen();
	if ( ! $screen || 'andonick_project' !== $screen->post_type ) {
		return;
	}
	wp_enqueue_media();
	wp_add_inline_script( 'jquery-core', "jQuery(function($){var frame;$('#andonick-project-logo-select').on('click',function(e){e.preventDefault();if(frame){frame.open();return;}frame=wp.media({title:'Choisir un logo autorisé',button:{text:'Utiliser ce média'},multiple:false});frame.on('select',function(){var a=frame.state().get('selection').first().toJSON();$('#andonick-project-logo-id').val(a.id);$('#andonick-project-logo-preview').html('<img src=\"'+(a.sizes&&a.sizes.thumbnail?a.sizes.thumbnail.url:a.url)+'\" alt=\"\" style=\"max-width:160px;height:auto;\">');});frame.open();});$('#andonick-project-logo-remove').on('click',function(e){e.preventDefault();$('#andonick-project-logo-id').val('');$('#andonick-project-logo-preview').empty();});});" );
}
add_action( 'admin_enqueue_scripts', 'andonick_core_project_admin_assets' );

/** Fournit au thème les projets publiés, déjà normalisés pour la langue. */
function andonick_core_get_projects( $lang = 'fr' ) {
	$lang = ( 'en' === $lang ) ? 'en' : 'fr';
	$query = new WP_Query( array(
		'post_type'      => 'andonick_project',
		'post_status'    => 'publish',
		'posts_per_page' => 30,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
		'no_found_rows'  => true,
		'meta_query'     => array(
			array(
				'key'     => '_andonick_project_enabled',
				'value'   => '0',
				'compare' => '!=',
			),
		),
	) );
	$items = array();
	foreach ( $query->posts as $project ) {
		$title = trim( (string) get_post_meta( $project->ID, '_andonick_project_title_' . $lang, true ) );
		$description = trim( (string) get_post_meta( $project->ID, '_andonick_project_description_' . $lang, true ) );
		$location = trim( (string) get_post_meta( $project->ID, '_andonick_project_location_' . $lang, true ) );
		if ( '' === $title && '' === $description ) {
			continue;
		}
		$terms = wp_get_post_terms( $project->ID, 'andonick_domain' );
		$domain_names = array();
		$domain_en = array(
			'telecommunications-ict' => 'Telecommunications & ICT',
			'energie-solaire'        => 'Solar energy',
			'securite-electronique'  => 'Electronic security',
			'btp-genie-civil'        => 'Construction & civil engineering',
			'transport-logistique'   => 'Transport & logistics',
			'commerce-general'       => 'General trade',
			'facility-management'    => 'Facility management',
			'conseil-formation'      => 'Consulting & training',
		);
		if ( ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$domain_names[] = ( 'en' === $lang && isset( $domain_en[ $term->slug ] ) ) ? $domain_en[ $term->slug ] : $term->name;
			}
		}
		$logo_id = absint( get_post_meta( $project->ID, '_andonick_project_logo_id', true ) );
		$logo = $logo_id ? wp_get_attachment_image_url( $logo_id, 'medium' ) : '';
		if ( ! $logo ) {
			$logo = esc_url_raw( get_post_meta( $project->ID, '_andonick_project_logo_url', true ) ); // Migration d'une éventuelle bêta.
		}
		$items[] = array(
			'title'       => $title,
			'description' => $description,
			'location'    => $location,
			'proof'       => trim( (string) get_post_meta( $project->ID, '_andonick_project_proof_label', true ) ),
			'link'        => esc_url_raw( get_post_meta( $project->ID, '_andonick_project_link_url', true ) ),
			'logo'        => $logo,
			'domains'     => $domain_names,
		);
	}
	return $items;
}

/** Retour utilisateur traduit par le thème, sans divulguer la raison technique. */
function andonick_core_form_feedback() {
	$status = isset( $_GET['andonick_form'] ) ? sanitize_key( wp_unslash( $_GET['andonick_form'] ) ) : '';
	if ( ! function_exists( 'andonick_t' ) ) {
		return '';
	}
	if ( 'saved' === $status ) {
		return andonick_t( 'form_saved_msg' );
	}
	if ( 'sent' === $status ) {
		return andonick_t( 'toast_msg' );
	}
	return in_array( $status, array( 'error', 'limited' ), true ) ? andonick_t( 'form_error_msg' ) : '';
}

function andonick_core_active_form() {
	$type = isset( $_GET['andonick_form_type'] ) ? sanitize_key( wp_unslash( $_GET['andonick_form_type'] ) ) : 'devis';
	return ( 'rappel' === $type ) ? 'rappel' : 'devis';
}

/** Clé éphémère, non réversible, pour limiter les soumissions sans stocker l'IP. */
function andonick_core_rate_key() {
	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? (string) wp_unslash( $_SERVER['REMOTE_ADDR'] ) : 'unknown';
	return 'andonick_rate_' . hash_hmac( 'sha256', $ip, wp_salt( 'nonce' ) );
}

function andonick_core_rate_allowed( $consume = false ) {
	$settings = andonick_core_settings();
	$limit = max( 1, min( 50, absint( $settings['rate_limit_count'] ) ) );
	$window = max( 1, min( 1440, absint( $settings['rate_window'] ) ) ) * MINUTE_IN_SECONDS;
	$key = andonick_core_rate_key();
	$count = absint( get_transient( $key ) );
	if ( $count >= $limit ) {
		return false;
	}
	if ( $consume ) {
		set_transient( $key, $count + 1, $window );
	}
	return true;
}

function andonick_core_redirect( $status, $type ) {
	$referer = wp_get_referer();
	$url = $referer ? $referer : home_url( '/' );
	$url = strtok( $url, '#' );
	$url = remove_query_arg( array( 'andonick_form', 'andonick_form_type' ), $url );
	$url = add_query_arg( array(
		'andonick_form'      => sanitize_key( $status ),
		'andonick_form_type' => ( 'rappel' === $type ) ? 'rappel' : 'devis',
	), $url );
	wp_safe_redirect( $url . '#devis' );
	exit;
}

/** Traitement robuste du formulaire public. */
function andonick_core_handle_form() {
	$type = ( isset( $_POST['andonick_form_type'] ) && 'rappel' === sanitize_key( wp_unslash( $_POST['andonick_form_type'] ) ) ) ? 'rappel' : 'devis';
	$nonce_name = 'andonick_nonce_' . $type;
	$nonce = isset( $_POST[ $nonce_name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $nonce_name ] ) ) : '';
	if ( '' === $nonce && isset( $_POST['andonick_nonce'] ) ) {
		$nonce = sanitize_text_field( wp_unslash( $_POST['andonick_nonce'] ) ); // Compatibilité v3.9 et antérieures.
	}
	if ( ! wp_verify_nonce( $nonce, 'andonick_contact_' . $type ) && ! wp_verify_nonce( $nonce, 'andonick_contact' ) ) {
		andonick_core_redirect( 'error', $type );
	}
	if ( ! empty( $_POST['andonick_website'] ) ) {
		andonick_core_redirect( 'sent', $type );
	}
	$settings = andonick_core_settings();
	$started = isset( $_POST['andonick_started'] ) ? absint( $_POST['andonick_started'] ) : 0;
	$elapsed = time() - $started;
	if ( $started < 1 || $elapsed < absint( $settings['min_fill_seconds'] ) || $elapsed > DAY_IN_SECONDS ) {
		andonick_core_redirect( 'error', $type );
	}
	if ( ! function_exists( 'andonick_form_fields' ) || ! function_exists( 'andonick_t_lang' ) ) {
		andonick_core_redirect( 'error', $type );
	}

	$lang = ( isset( $_POST['andonick_lang'] ) && 'en' === sanitize_key( wp_unslash( $_POST['andonick_lang'] ) ) ) ? 'en' : 'fr';
	$config = andonick_form_fields( $type, $lang );
	$lines = array();
	$stored_fields = array();
	$visitor_email = '';
	$ok = ! empty( $config );
	foreach ( $config as $i => $field ) {
		$key = 'andonick_f' . $i;
		$raw = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
		if ( 'email' === $field['type'] ) {
			$value = sanitize_email( $raw );
		} elseif ( 'textarea' === $field['type'] ) {
			$value = sanitize_textarea_field( $raw );
		} elseif ( 'checkbox' === $field['type'] ) {
			$value = ! empty( $raw ) ? '1' : '';
		} else {
			$value = sanitize_text_field( $raw );
		}
		$value = trim( $value );
		if ( strlen( $value ) > 3000 || ( 'email' === $field['type'] && '' !== $value && ! is_email( $value ) ) ) {
			$ok = false;
			continue;
		}
		if ( 'select' === $field['type'] && '' !== $value ) {
			$options = ( 'slots' === $field['options'] && function_exists( 'andonick_slots' ) ) ? andonick_slots() : ( function_exists( 'andonick_services' ) ? andonick_services() : array() );
			if ( ! in_array( $value, $options, true ) ) {
				$ok = false;
				continue;
			}
		}
		if ( ! empty( $field['required'] ) && '' === $value ) {
			$ok = false;
			continue;
		}
		if ( '' !== $value ) {
			$lines[] = $field['label'] . ' : ' . ( 'checkbox' === $field['type'] ? __( 'Oui', 'andonick-core' ) : $value );
			$stored_fields[] = array( 'label' => $field['label'], 'value' => $value, 'type' => $field['type'] );
		}
		if ( 'email' === $field['type'] && is_email( $value ) && '' === $visitor_email ) {
			$visitor_email = $value;
		}
	}

	$consent_required = '0' !== get_theme_mod( 'andonick_form_consent_enabled', '1' );
	$consent = isset( $_POST['andonick_consent'] ) && '1' === sanitize_key( wp_unslash( $_POST['andonick_consent'] ) );
	if ( $consent_required && ! $consent ) {
		$ok = false;
	}
	if ( ! $ok ) {
		andonick_core_redirect( 'error', $type );
	}
	/* Une demande invalide ne consomme pas le quota d'une adresse partagée
	 * (bureau, ONG, cybercafé). Le compteur ne progresse qu'après validation. */
	if ( ! andonick_core_rate_allowed( true ) ) {
		andonick_core_redirect( 'limited', $type );
	}

	$labels = array( 'fr' => 'FR', 'en' => 'EN' );
	$kind = ( 'rappel' === $type ) ? 'RAPPEL' : 'DEVIS';
	$body = 'Demande [' . $kind . '] — Site web (langue ' . $labels[ $lang ] . ')' . "\n\n" . implode( "\n", $lines );
	$body .= "\n\nConsentement : " . ( $consent ? 'oui' : 'non requis' );
	$referer = wp_get_referer();
	if ( $referer ) {
		$body .= "\nEnvoyé depuis : " . esc_url_raw( $referer );
	}
	$lead_id = wp_insert_post( array(
		'post_type'    => 'andonick_lead',
		'post_status'  => 'private',
		'post_title'   => sprintf( '%s — %s', $kind, current_time( 'Y-m-d H:i' ) ),
		'post_content' => $body,
	), true );
	if ( ! is_wp_error( $lead_id ) ) {
		update_post_meta( $lead_id, '_andonick_lead_language', $lang );
		update_post_meta( $lead_id, '_andonick_lead_type', $type );
		update_post_meta( $lead_id, '_andonick_lead_fields', wp_json_encode( $stored_fields, JSON_UNESCAPED_UNICODE ) );
		update_post_meta( $lead_id, '_andonick_lead_email', $visitor_email );
		update_post_meta( $lead_id, '_andonick_lead_consent', $consent ? current_time( 'mysql', true ) : '' );
	}

	$recipient = sanitize_email( andonick_t_lang( 'contact_mail', $lang ) );
	$mail_sent = false;
	if ( ! is_wp_error( $lead_id ) && is_email( $recipient ) ) {
		$mail_sent = wp_mail( $recipient, '[ANDONICK] Nouvelle demande ' . $kind . ' (' . $labels[ $lang ] . ')', $body );
	}
	if ( ! is_wp_error( $lead_id ) && '1' === get_theme_mod( 'andonick_forms_copy', '0' ) && is_email( $visitor_email ) ) {
		wp_mail( $visitor_email, andonick_t_lang( 'form_copy_subject', $lang ), andonick_t_lang( 'form_copy_body', $lang ) . "\n\n" . implode( "\n", $lines ) );
	}
	andonick_core_redirect( is_wp_error( $lead_id ) ? 'error' : ( $mail_sent ? 'sent' : 'saved' ), $type );
}
add_action( 'admin_post_nopriv_andonick_contact', 'andonick_core_handle_form' );
add_action( 'admin_post_andonick_contact', 'andonick_core_handle_form' );

/** Page de réglages opérationnels, volontairement courte. */
function andonick_core_sanitize_settings( $input ) {
	$input = is_array( $input ) ? $input : array();
	return array(
		'retention_days'   => min( 3650, max( 0, absint( isset( $input['retention_days'] ) ? $input['retention_days'] : 365 ) ) ),
		'rate_limit_count' => min( 50, max( 1, absint( isset( $input['rate_limit_count'] ) ? $input['rate_limit_count'] : 5 ) ) ),
		'rate_window'      => min( 1440, max( 1, absint( isset( $input['rate_window'] ) ? $input['rate_window'] : 15 ) ) ),
		'min_fill_seconds' => min( 30, max( 0, absint( isset( $input['min_fill_seconds'] ) ? $input['min_fill_seconds'] : 2 ) ) ),
	);
}

function andonick_core_admin_settings() {
	register_setting( 'andonick_core', ANDONICK_CORE_SETTINGS, array( 'sanitize_callback' => 'andonick_core_sanitize_settings' ) );
	add_settings_section( 'andonick_core_forms', __( 'Protection et conservation', 'andonick-core' ), '__return_false', 'andonick-core' );
	$fields = array(
		'retention_days'   => array( 'Conservation des demandes (jours)', '0 = conservation sans purge automatique.' ),
		'rate_limit_count' => array( 'Soumissions maximales par fenêtre', 'Par adresse réseau, sans conserver l’adresse en clair.' ),
		'rate_window'      => array( 'Durée de la fenêtre (minutes)', 'Entre 1 et 1 440 minutes.' ),
		'min_fill_seconds' => array( 'Durée minimale de saisie (secondes)', 'Bloque les robots trop rapides ; 0 désactive ce contrôle.' ),
	);
	foreach ( $fields as $key => $copy ) {
		add_settings_field( $key, $copy[0], 'andonick_core_setting_number', 'andonick-core', 'andonick_core_forms', array( 'key' => $key, 'description' => $copy[1] ) );
	}
}
add_action( 'admin_init', 'andonick_core_admin_settings' );

function andonick_core_setting_number( $args ) {
	$settings = andonick_core_settings();
	$key = $args['key'];
	?><input type="number" min="0" class="small-text" name="<?php echo esc_attr( ANDONICK_CORE_SETTINGS . '[' . $key . ']' ); ?>" value="<?php echo esc_attr( $settings[ $key ] ); ?>"> <span class="description"><?php echo esc_html( $args['description'] ); ?></span><?php
}

function andonick_core_settings_menu() {
	add_options_page( 'ANDONICK Core', 'ANDONICK Core', 'manage_options', 'andonick-core', 'andonick_core_settings_page' );
}
add_action( 'admin_menu', 'andonick_core_settings_menu' );

function andonick_core_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?><div class="wrap"><h1>ANDONICK Core</h1><p><?php esc_html_e( 'Les demandes restent privées. La purge est définitive ; sauvegardez avant de raccourcir la durée de conservation.', 'andonick-core' ); ?></p><form method="post" action="options.php"><?php settings_fields( 'andonick_core' ); do_settings_sections( 'andonick-core' ); submit_button(); ?></form></div><?php
}

/** Purge quotidienne des demandes dépassant la durée choisie. */
function andonick_core_retention_cleanup() {
	$days = absint( andonick_core_settings()['retention_days'] );
	if ( $days < 1 ) {
		return;
	}
	$before = gmdate( 'Y-m-d H:i:s', time() - ( $days * DAY_IN_SECONDS ) );
	/* Lots bornés : purge complète sans charger toutes les demandes en mémoire. */
	for ( $batch = 0; $batch < 100; $batch++ ) {
		$ids = get_posts( array(
			'post_type'      => 'andonick_lead',
			'post_status'    => 'any',
			'posts_per_page' => 100,
			'fields'         => 'ids',
			'date_query'     => array( array( 'before' => $before, 'column' => 'post_date_gmt' ) ),
		) );
		foreach ( $ids as $id ) {
			wp_delete_post( $id, true );
		}
		if ( count( $ids ) < 100 ) {
			break;
		}
	}
}
add_action( ANDONICK_CORE_CRON, 'andonick_core_retention_cleanup' );

/** Export/effacement WordPress des demandes liées à une adresse e-mail. */
function andonick_core_privacy_ids( $email, $page ) {
	global $wpdb;
	$offset = ( max( 1, absint( $page ) ) - 1 ) * 20;
	$like = '%' . $wpdb->esc_like( $email ) . '%';
	$sql = $wpdb->prepare(
		"SELECT DISTINCT p.ID FROM {$wpdb->posts} p LEFT JOIN {$wpdb->postmeta} pm ON p.ID=pm.post_id AND pm.meta_key='_andonick_lead_email' WHERE p.post_type='andonick_lead' AND (pm.meta_value=%s OR p.post_content LIKE %s) ORDER BY p.ID ASC LIMIT 20 OFFSET %d",
		$email,
		$like,
		$offset
	);
	return array_map( 'absint', $wpdb->get_col( $sql ) );
}

function andonick_core_privacy_exporter( $email, $page = 1 ) {
	$ids = andonick_core_privacy_ids( sanitize_email( $email ), $page );
	$data = array();
	foreach ( $ids as $id ) {
		$data[] = array(
			'group_id'    => 'andonick-site-requests',
			'group_label' => __( 'Demandes envoyées au site ANDONICK', 'andonick-core' ),
			'item_id'     => 'andonick-lead-' . $id,
			'data'        => array(
				array( 'name' => __( 'Date', 'andonick-core' ), 'value' => get_post_field( 'post_date_gmt', $id ) ),
				array( 'name' => __( 'Demande', 'andonick-core' ), 'value' => get_post_field( 'post_content', $id ) ),
			),
		);
	}
	return array( 'data' => $data, 'done' => count( $ids ) < 20 );
}

function andonick_core_privacy_eraser( $email, $page = 1 ) {
	/* Après suppression, les offsets se décalent. Toujours retraiter le premier
	 * lot garantit qu'aucune demande correspondante n'est sautée. */
	$ids = andonick_core_privacy_ids( sanitize_email( $email ), 1 );
	$removed = false;
	foreach ( $ids as $id ) {
		if ( wp_delete_post( $id, true ) ) {
			$removed = true;
		}
	}
	return array(
		'items_removed'  => $removed,
		'items_retained' => false,
		'messages'       => array(),
		'done'           => count( $ids ) < 20,
	);
}

function andonick_core_register_exporter( $exporters ) {
	$exporters['andonick-core'] = array( 'exporter_friendly_name' => __( 'Demandes ANDONICK', 'andonick-core' ), 'callback' => 'andonick_core_privacy_exporter' );
	return $exporters;
}
function andonick_core_register_eraser( $erasers ) {
	$erasers['andonick-core'] = array( 'eraser_friendly_name' => __( 'Demandes ANDONICK', 'andonick-core' ), 'callback' => 'andonick_core_privacy_eraser' );
	return $erasers;
}
add_filter( 'wp_privacy_personal_data_exporters', 'andonick_core_register_exporter' );
add_filter( 'wp_privacy_personal_data_erasers', 'andonick_core_register_eraser' );

/** Migration idempotente : types, taxonomie, 8 termes et 4 preuves documentées. */
function andonick_core_seed_content() {
	$domains = array(
		'telecommunications-ict' => 'Télécommunications & ICT',
		'energie-solaire'        => 'Énergie solaire',
		'securite-electronique'  => 'Sécurité électronique',
		'btp-genie-civil'        => 'BTP & Génie civil',
		'transport-logistique'   => 'Transport & logistique',
		'commerce-general'       => 'Commerce général',
		'facility-management'    => 'Facility management',
		'conseil-formation'      => 'Conseil & formation',
	);
	foreach ( $domains as $slug => $name ) {
		if ( ! term_exists( $slug, 'andonick_domain' ) ) {
			wp_insert_term( $name, 'andonick_domain', array( 'slug' => $slug ) );
		}
	}
	if ( get_option( 'andonick_core_projects_seeded' ) ) {
		return;
	}
	$projects = array(
		array( 'Solarisation de trois CLAC', 'Solar power for three CLAC centres', 'Solarisation des CLAC de Bangui, Damara et Bossangoa.', 'Solar power systems for the CLAC centres in Bangui, Damara and Bossangoa.', 'Bangui · Damara · Bossangoa', 'Bangui · Damara · Bossangoa', 'OIF', 'energie-solaire' ),
		array( 'Systèmes solaires à Bamingui et sur la base WCS', 'Solar systems in Bamingui and at the WCS base', 'Déploiement de systèmes solaires à Bamingui et sur la base WCS dans le cadre UE–NaturAfrica.', 'Deployment of solar systems in Bamingui and at the WCS base under the EU–NaturAfrica framework.', 'Bamingui', 'Bamingui', 'UE–NaturAfrica · WCS', 'energie-solaire' ),
		array( 'Intervention de connectivité Starlink pour PUI', 'Starlink connectivity intervention for PUI', 'Intervention terrain de connectivité Starlink pour Première Urgence Internationale.', 'Field Starlink connectivity intervention for Première Urgence Internationale.', '', '', 'PUI', 'telecommunications-ict' ),
		array( 'Intervention de connectivité Starlink pour ICASEES', 'Starlink connectivity intervention for ICASEES', 'Intervention terrain de connectivité Starlink pour ICASEES.', 'Field Starlink connectivity intervention for ICASEES.', '', '', 'ICASEES', 'telecommunications-ict' ),
	);
	foreach ( $projects as $order => $item ) {
		$id = wp_insert_post( array(
			'post_type'   => 'andonick_project',
			'post_status' => 'publish',
			'post_title'  => $item[0],
			'menu_order'  => $order,
		), true );
		if ( is_wp_error( $id ) ) {
			continue;
		}
		$keys = array( 'title_fr', 'title_en', 'description_fr', 'description_en', 'location_fr', 'location_en', 'proof_label' );
		foreach ( $keys as $index => $key ) {
			update_post_meta( $id, '_andonick_project_' . $key, $item[ $index ] );
		}
		update_post_meta( $id, '_andonick_project_enabled', '1' );
		wp_set_object_terms( $id, $item[7], 'andonick_domain' );
	}
	update_option( 'andonick_core_projects_seeded', ANDONICK_CORE_VERSION, false );
}

function andonick_core_activate() {
	andonick_core_register_leads();
	andonick_core_register_projects();
	andonick_core_seed_content();
	if ( ! wp_next_scheduled( ANDONICK_CORE_CRON ) ) {
		wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', ANDONICK_CORE_CRON );
	}
	update_option( 'andonick_core_version', ANDONICK_CORE_VERSION, false );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'andonick_core_activate' );

function andonick_core_deactivate() {
	wp_clear_scheduled_hook( ANDONICK_CORE_CRON );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'andonick_core_deactivate' );

function andonick_core_upgrade() {
	if ( get_option( 'andonick_core_version' ) === ANDONICK_CORE_VERSION ) {
		return;
	}
	andonick_core_register_projects();
	andonick_core_seed_content();
	if ( ! wp_next_scheduled( ANDONICK_CORE_CRON ) ) {
		wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', ANDONICK_CORE_CRON );
	}
	update_option( 'andonick_core_version', ANDONICK_CORE_VERSION, false );
}
add_action( 'init', 'andonick_core_upgrade', 20 );
