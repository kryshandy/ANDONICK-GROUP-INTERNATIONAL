<?php
/**
 * ANDONICK Group International — Contenu bilingue (FR / EN).
 *
 * Contenu extrait du site officiel de référence (fiabilité garantie).
 * Utilisation : andonick_t( $key, $lang ) dans les templates.
 *
 * @package Andonick
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tableau de contenu bilingue, tel qu'utilisé sur le site officiel.
 * Les clés correspondent au dictionnaire i18n d'origine.
 */
function andonick_content() {
	return array(
		'fr' => array(
			// Navigation.
			'nav_group'     => 'Le Groupe',
			'nav_filiales'  => 'Filiales & Activités',
			'nav_impact'    => 'Impact',
			'nav_refs'      => 'Références',
			'nav_contact'   => 'Contact',
			'nav_devis'     => 'Demander un devis',

			// Hero.
			'hero_tag'      => 'Groupe multisectoriel panafricain',
			'hero_title_tail' => 'INTERNATIONAL',
			'hero_title'    => 'ANDONICK GROUP INTERNATIONAL',
			'hero_lead'     => 'Télécommunications, énergie solaire, sécurité, BTP, transport & logistique, commerce général, facility management et conseil : un partenaire technique unique, présent à Bangui, Dakar et Bordeaux.',
			'hero_cta1'     => 'Demander un devis en ligne',
			'hero_cta2'     => 'Découvrir nos filiales',
			'stat1'         => 'ans d\'expertise en Centrafrique',
			'stat2'         => 'filiales complémentaires',
			'stat3'         => 'pays — RCA · Sénégal · France',
			'hero_cap'      => 'Nos équipes techniques et logistiques, mobilisées à travers l\'Afrique',
			'strip1'        => 'Distributeur officiel Starlink RCA',
			'strip2'        => 'Fibre optique & Cybersécurité',
			'strip3'        => 'Énergie solaire clé en main',
			'strip4'        => 'Vidéosurveillance intelligente',
			'strip5'        => 'Conseil & Formation',

			// Le Groupe.
			's2_eyebrow'    => 'Le Groupe',
			's2_title'      => 'Un acteur technologique et industriel intégré',
			's2_body'       => 'ANDONICK Group International est une entreprise multisectorielle basée à Bangui (République Centrafricaine), avec une présence à Dakar (Sénégal) et à Bordeaux (France). Dirigé par son Président-Directeur Général, M. Nico Andonick, le Groupe accompagne depuis plus de quinze ans les institutions publiques, les organisations humanitaires, les entreprises et les particuliers dans leurs projets d\'infrastructures, de connectivité et de services. Structuré en filiales spécialisées et complémentaires, le Groupe apporte une réponse intégrée : étude, déploiement, exploitation et maintenance, avec un même niveau d\'exigence sur l\'ensemble du territoire centrafricain et au-delà.',
			'val1'          => 'Fiabilité',
			'val2'          => 'Innovation',
			'val3'          => 'Engagement',
			'val4'          => 'Partenariat durable',
			'img_team_name' => 'Équipe ANDONICK Group sur site logistique',

			// Filiales.
			's3_eyebrow'    => 'Nos filiales & domaines d\'activité',
			's3_title'      => 'Huit métiers, une même exigence de qualité',
			's3_sub'        => 'Chaque filiale du Groupe mobilise une expertise technique dédiée, tout en s\'appuyant sur la force logistique, financière et humaine de l\'ensemble ANDONICK Group International.',

			// Impact.
			'impact_eyebrow' => 'Notre engagement',
			'impact_title'   => 'Un impact numérique concret pour la population centrafricaine',
			'impact_body'    => 'En connectant familles, écoles, entreprises et centres de santé, ANDONICK Group International contribue à réduire la fracture numérique et à rapprocher les services essentiels des populations, y compris dans les zones les plus isolées du pays.',

			// Références.
			'testi_eyebrow' => 'Ils nous font confiance',
			'testi_title'   => 'Témoignages professionnels',
			'refs_eyebrow'  => 'Nos références',
			'refs_title'    => 'Clients & partenaires',
			'partners_title'=> 'Nos partenaires institutionnels',
			'gallery_eyebrow' => 'Nos réalisations',
			'gallery_title'   => 'Le Groupe sur le terrain',
			'gallery_sub'     => 'Une partie des chantiers, installations et déploiements réalisés par nos équipes en République Centrafricaine.',

			// Contact.
			'contact_eyebrow' => 'Contact',
			'contact_title'   => 'Parlons de votre projet',
			'contact_sub'     => 'Demandez un devis, sollicitez un rappel ou contactez-nous directement — nous répondons sous 24 à 48h ouvrées.',
			'contact_coord'   => 'Nos coordonnées',
			'contact_addr'    => 'ANDONICK Group — Sis Quartier Sica 1, Rue du Languedoc, Bangui, République Centrafricaine',
			'lbl_rca'         => '(RCA)',
			'lbl_fr'          => '(France)',
			'wa_rca'          => 'Discuter sur WhatsApp (RCA)',
			'wa_fr'           => 'Discuter sur WhatsApp (France)',
			'call_direct'     => 'Appeler directement',
			'tab_devis'       => 'Demander un devis',
			'tab_rappel'      => 'Être rappelé(e)',
			'f_name'          => 'Nom complet *',
			'f_company'       => 'Entreprise / Organisation',
			'f_phone'         => 'Téléphone *',
			'f_email'         => 'E-mail',
			'f_service'       => 'Filiale / service concerné *',
			'f_desc'          => 'Description du besoin *',
			'f_submit_devis'  => 'Envoyer ma demande de devis',
			'f_disc_devis'    => 'En soumettant ce formulaire, vous acceptez d\'être recontacté(e) par ANDONICK Group International au sujet de votre demande.',
			'f_slot'          => 'Créneau préféré',
			'f_city'          => 'Ville / Pays',
			'f_object'        => 'Objet de la demande',
			'f_submit_rappel' => 'Demander à être rappelé(e)',
			'f_disc_rappel'   => 'Un conseiller ANDONICK Group vous recontactera dans les meilleurs délais.',
			'descPlaceholder' => 'Décrivez votre projet, votre localisation et vos délais souhaités',
			'cityPlaceholder' => 'Bangui, Dakar, Bordeaux…',
			'objectPlaceholder'=> 'En quelques mots, l\'objet de votre appel',
			'slots'           => array( 'Matin (8h–12h)', 'Après-midi (13h–17h)', 'Le plus rapidement possible' ),
			'toast_msg'       => 'Merci — votre demande a bien été enregistrée.',
			'foot_tag'        => 'Votre réussite, notre engagement. Groupe multisectoriel présent en République Centrafricaine, au Sénégal et en France.',
			'foot_filiales'   => 'Filiales',
			'foot_contact'    => 'Contact',
			'foot_copy'       => '© 2026 ANDONICK Group International. Tous droits réservés.',
			'lang_fr'         => 'Français',
			'lang_en'         => 'English',

			// Les 8 métiers.
			'filiales'        => array(
				array( 'num' => '01', 'title' => 'Informatique & Télécommunications', 'desc' => 'Distributeur officiel Starlink en RCA, déploiement de liaisons fibre optique et hertziennes, cybersécurité, réseaux d\'entreprise et supervision de systèmes d\'information.', 'tags' => array( 'Starlink', 'Fibre optique', 'Cybersécurité' ) ),
				array( 'num' => '02', 'title' => 'Énergie Solaire', 'desc' => 'Études de faisabilité, dimensionnement, installation clé en main et maintenance de systèmes photovoltaïques résidentiels, professionnels et institutionnels.', 'tags' => array( 'Kits solaires', 'Onduleurs hybrides', 'Batteries GEL' ) ),
				array( 'num' => '03', 'title' => 'Sécurité Privée & Vidéosurveillance', 'desc' => 'Caméras haute définition, vision jour/nuit, enregistrement sécurisé, consultation à distance et agents de sécurité formés pour la protection des sites sensibles.', 'tags' => array( 'Vidéosurveillance HD', 'Gardiennage', 'Contrôle d\'accès' ) ),
				array( 'num' => '04', 'title' => 'Bâtiments & Travaux Publics', 'desc' => 'Conception, construction et réhabilitation d\'infrastructures : bâtiments administratifs, sites techniques et ouvrages de génie civil, aux normes internationales.', 'tags' => array( 'Génie civil', 'Suivi de chantier' ) ),
				array( 'num' => '05', 'title' => 'Transport & Logistique', 'desc' => 'Transport de marchandises, transit international et logistique de dernier kilomètre, appuyés par la filiale REANA Transport (France) et un maillage régional.', 'tags' => array( 'Fret international', 'REANA Transport' ) ),
				array( 'num' => '06', 'title' => 'Commerce Général & Import-Export', 'desc' => 'Approvisionnement en fournitures de bureau, matériels de chantier, produits d\'entretien, alimentaires et divers, avec livraison sur l\'ensemble du territoire centrafricain.', 'tags' => array( 'Import-export', 'Distribution' ) ),
				array( 'num' => '07', 'title' => 'Propreté, Hygiène & Blanchisserie', 'desc' => 'Entretien complet des sites professionnels et résidentiels, et service de blanchisserie pour hôtels, institutions et particuliers exigeants à Bangui.', 'tags' => array( 'Facility management', 'Blanchisserie' ) ),
				array( 'num' => '08', 'title' => 'LTD — Cabinet Conseil', 'desc' => 'Conseil en stratégie et organisation, formation professionnelle, renforcement des capacités et accompagnement au recrutement pour institutions et jeunes diplômés.', 'tags' => array( 'Conseil', 'Formation', 'Recrutement' ) ),
			),

			// Liste déroulante des services (formulaire devis).
			'services'        => array(
				'— Sélectionner —',
				'Informatique & Télécommunications (Starlink, fibre, cybersécurité)',
				'Énergie Solaire',
				'Sécurité Privée & Vidéosurveillance',
				'Bâtiments & Travaux Publics',
				'Transport & Logistique',
				'Commerce Général & Import-Export',
				'Propreté, Hygiène & Blanchisserie',
				'LTD — Cabinet Conseil',
				'Autre / non déterminé',
			),

			// Impacts.
			'impacts'        => array(
				array( 'Éducation', 'Accès à l\'information et aux outils numériques pour la jeunesse' ),
				array( 'Santé', 'Téléconsultation et connectivité pour les structures de soins' ),
				array( 'Entreprises', 'Connectivité fiable pour la continuité des activités' ),
				array( 'Familles', 'Accès internet dans les foyers, y compris en zones reculées' ),
			),

			// Témoignages.
			'testis'         => array(
				array( 'ANDONICK Group International nous accompagne avec réactivité et fiabilité sur l\'ensemble de nos sites. La connectivité et le support technique sont excellents, même dans les zones les plus isolées.', 'M. Guylain Kongawi Solombe', 'Directeur Pays — Première Urgence Internationale (ONG)' ),
				array( 'Nous apprécions la qualité des installations réalisées, le respect des délais et l\'accompagnement personnalisé d\'ANDONICK Group International. Un partenaire de confiance.', 'M. Mack P.', 'Client particulier — Installation Internet haut débit' ),
				array( 'ANDONICK Group International a déployé pour nous une solution réseau robuste et sécurisée. Le professionnalisme et l\'expertise de leurs équipes sont remarquables.', 'ICASEES', 'Institution publique — Solutions IT & Réseau' ),
			),

			// Tableau des références.
			'ref_headers'    => array( 'Catégorie', 'Nom', 'Fonction / Organisation', 'Téléphone' ),
			'refs'           => array(
				array( 'ONG Humanitaire', 'M. Guylain Kongawi Solombe', 'Directeur Pays, Première Urgence Internationale', '+236 72 68 33 37' ),
				array( 'Particulier', 'M. Mack P.', 'Installation Internet haut débit', '+236 72 52 27 26' ),
				array( 'Institution publique', 'Contact institutionnel', 'ICASEES', '+236 72 14 96 15' ),
				array( 'Organisation professionnelle', 'Contact organisation professionnelle', 'ICASEES — Solutions IT & Réseau', '+236 72 68 13 54' ),
			),

			// Partenaires.
			'partners'       => array( 'Welthungerhilfe', 'Médecins du Monde', 'DanChurchAid', 'ACTED', 'International Medical Corps' ),
		),

		'en' => array(
			'nav_group'     => 'The Group',
			'nav_filiales'  => 'Subsidiaries & Activities',
			'nav_impact'    => 'Impact',
			'nav_refs'      => 'References',
			'nav_contact'   => 'Contact',
			'nav_devis'     => 'Request a Quote',

			'hero_tag'      => 'Pan-African multi-sector group',
			'hero_title_tail' => 'INTERNATIONAL',
			'hero_title'    => 'ANDONICK GROUP INTERNATIONAL',
			'hero_lead'     => 'Telecommunications, solar energy, security, construction, transport & logistics, general trade, facility management and consulting: a single technical partner, present in Bangui, Dakar and Bordeaux.',
			'hero_cta1'     => 'Request a Quote Online',
			'hero_cta2'     => 'Discover Our Subsidiaries',
			'stat1'         => 'years of expertise in Central Africa',
			'stat2'         => 'complementary subsidiaries',
			'stat3'         => 'countries — CAR · Senegal · France',
			'hero_cap'      => 'Our technical and logistics teams, mobilised across Africa',
			'strip1'        => 'Official Starlink Distributor CAR',
			'strip2'        => 'Fibre Optics & Cybersecurity',
			'strip3'        => 'Turnkey Solar Energy',
			'strip4'        => 'Smart CCTV',
			'strip5'        => 'Consulting & Training',

			's2_eyebrow'    => 'The Group',
			's2_title'      => 'An integrated technology and industrial group',
			's2_body'       => 'ANDONICK Group International is a multi-sector company headquartered in Bangui (Central African Republic), with a presence in Dakar (Senegal) and Bordeaux (France). Led by its Chief Executive Officer, Mr. Nico Andonick, the Group has spent over fifteen years supporting public institutions, humanitarian organisations, businesses and individuals with their infrastructure, connectivity and service projects. Organised into specialised, complementary subsidiaries, the Group delivers an integrated response — study, deployment, operation and maintenance — with the same standard of excellence across the entire Central African territory and beyond.',
			'val1'          => 'Reliability',
			'val2'          => 'Innovation',
			'val3'          => 'Commitment',
			'val4'          => 'Lasting Partnership',
			'img_team_name' => 'ANDONICK Group team on a logistics site',

			's3_eyebrow'    => 'Our Subsidiaries & Business Lines',
			's3_title'      => 'Eight businesses, one standard of excellence',
			's3_sub'        => 'Each subsidiary of the Group brings dedicated technical expertise, backed by the logistical, financial and human strength of ANDONICK Group International as a whole.',

			'impact_eyebrow' => 'Our Commitment',
			'impact_title'   => 'A tangible digital impact for the people of Central Africa',
			'impact_body'    => 'By connecting families, schools, businesses and health centres, ANDONICK Group International helps close the digital divide and bring essential services closer to the population, including in the country\'s most remote areas.',

			'testi_eyebrow' => 'Trusted By',
			'testi_title'   => 'Professional Testimonials',
			'refs_eyebrow'  => 'Our References',
			'refs_title'    => 'Clients & partners',
			'partners_title'=> 'Our institutional partners',
			'gallery_eyebrow' => 'Our Projects',
			'gallery_title'   => 'The Group in the field',
			'gallery_sub'     => 'A selection of projects, installations and deployments carried out by our teams in the Central African Republic.',

			'contact_eyebrow' => 'Contact',
			'contact_title'   => 'Let\'s Discuss Your Project',
			'contact_sub'     => 'Request a quote, ask to be called back, or contact us directly — we respond within 24 to 48 business hours.',
			'contact_coord'   => 'Our Contact Details',
			'contact_addr'    => 'ANDONICK Group — Sis Quartier Sica 1, Rue du Languedoc, Bangui, Central African Republic',
			'lbl_rca'         => '(CAR)',
			'lbl_fr'          => '(France)',
			'wa_rca'          => 'Chat on WhatsApp (CAR)',
			'wa_fr'           => 'Chat on WhatsApp (France)',
			'call_direct'     => 'Call Directly',
			'tab_devis'       => 'Request a Quote',
			'tab_rappel'      => 'Request a Callback',
			'f_name'          => 'Full Name *',
			'f_company'       => 'Company / Organisation',
			'f_phone'         => 'Phone *',
			'f_email'         => 'Email',
			'f_service'       => 'Subsidiary / Service Needed *',
			'f_desc'          => 'Description of Your Needs *',
			'f_submit_devis'  => 'Send My Quote Request',
			'f_disc_devis'    => 'By submitting this form, you agree to be contacted by ANDONICK Group International regarding your request.',
			'f_slot'          => 'Preferred Time Slot',
			'f_city'          => 'City / Country',
			'f_object'        => 'Subject of Request',
			'f_submit_rappel' => 'Request a Callback',
			'f_disc_rappel'   => 'An ANDONICK Group advisor will get back to you as soon as possible.',
			'descPlaceholder' => 'Describe your project, location and desired timeline',
			'cityPlaceholder' => 'Bangui, Dakar, Bordeaux…',
			'objectPlaceholder'=> 'Briefly describe the subject of your call',
			'slots'           => array( 'Morning (8am–12pm)', 'Afternoon (1pm–5pm)', 'As soon as possible' ),
			'toast_msg'       => 'Thank you — your request has been submitted.',
			'foot_tag'        => 'Your success, our commitment. A multi-sector group present in the Central African Republic, Senegal and France.',
			'foot_filiales'   => 'Subsidiaries',
			'foot_contact'    => 'Contact',
			'foot_copy'       => '© 2026 ANDONICK Group International. All rights reserved.',
			'lang_fr'         => 'Français',
			'lang_en'         => 'English',

			'filiales'        => array(
				array( 'num' => '01', 'title' => 'IT & Telecommunications', 'desc' => 'Official Starlink distributor in the CAR, deployment of fibre-optic and wireless links, cybersecurity, enterprise networks and information-systems supervision.', 'tags' => array( 'Starlink', 'Fibre Optics', 'Cybersecurity' ) ),
				array( 'num' => '02', 'title' => 'Solar Energy', 'desc' => 'Feasibility studies, system sizing, turnkey installation and maintenance of photovoltaic systems for homes, businesses and institutions.', 'tags' => array( 'Solar Kits', 'Hybrid Inverters', 'GEL Batteries' ) ),
				array( 'num' => '03', 'title' => 'Private Security & CCTV', 'desc' => 'High-definition cameras, day/night vision, secure recording, remote monitoring and trained security officers to protect sensitive sites.', 'tags' => array( 'HD CCTV', 'Guarding', 'Access Control' ) ),
				array( 'num' => '04', 'title' => 'Construction & Public Works', 'desc' => 'Design, construction and rehabilitation of infrastructure: administrative buildings, technical sites and civil engineering works, to international standards.', 'tags' => array( 'Civil Engineering', 'Site Supervision' ) ),
				array( 'num' => '05', 'title' => 'Transport & Logistics', 'desc' => 'Freight transport, international transit and last-mile logistics, backed by REANA Transport (France) and a regional network.', 'tags' => array( 'International Freight', 'REANA Transport' ) ),
				array( 'num' => '06', 'title' => 'General Trade & Import-Export', 'desc' => 'Supply of office equipment, construction materials, cleaning products, food and general goods, delivered across the Central African territory.', 'tags' => array( 'Import-Export', 'Distribution' ) ),
				array( 'num' => '07', 'title' => 'Cleaning, Hygiene & Laundry', 'desc' => 'Complete upkeep of professional and residential sites, plus a dedicated laundry service for hotels, institutions and discerning individuals in Bangui.', 'tags' => array( 'Facility Management', 'Laundry' ) ),
				array( 'num' => '08', 'title' => 'LTD — Consulting Firm', 'desc' => 'Strategy and organisational consulting, professional training, capacity building and recruitment support for institutions and young graduates.', 'tags' => array( 'Consulting', 'Training', 'Recruitment' ) ),
			),

			'services'        => array(
				'— Select —',
				'IT & Telecommunications (Starlink, fibre, cybersecurity)',
				'Solar Energy',
				'Private Security & CCTV',
				'Construction & Public Works',
				'Transport & Logistics',
				'General Trade & Import-Export',
				'Cleaning, Hygiene & Laundry',
				'LTD — Consulting Firm',
				'Other / Not sure',
			),

			'impacts'        => array(
				array( 'Education', 'Access to information and digital tools for young people' ),
				array( 'Healthcare', 'Telemedicine and connectivity for care facilities' ),
				array( 'Business', 'Reliable connectivity for business continuity' ),
				array( 'Families', 'Home internet access, even in remote areas' ),
			),

			'testis'         => array(
				array( 'ANDONICK Group International supports us with responsiveness and reliability across all our sites. Connectivity and technical support are excellent, even in the most remote areas.', 'Mr. Guylain Kongawi Solombe', 'Country Director — Première Urgence Internationale (NGO)' ),
				array( 'We appreciate the quality of the installations, the respect of deadlines and the personalised support from ANDONICK Group International. A trusted partner.', 'Mr. Mack P.', 'Private Client — High-speed Internet Installation' ),
				array( 'ANDONICK Group International deployed a robust, secure network solution for us. The professionalism and expertise of their teams are remarkable.', 'ICASEES', 'Public Institution — IT & Network Solutions' ),
			),

			'ref_headers'    => array( 'Category', 'Name', 'Role / Organisation', 'Phone' ),
			'refs'           => array(
				array( 'Humanitarian NGO', 'Mr. Guylain Kongawi Solombe', 'Country Director, Première Urgence Internationale', '+236 72 68 33 37' ),
				array( 'Private Individual', 'Mr. Mack P.', 'High-speed Internet Installation', '+236 72 52 27 26' ),
				array( 'Public Institution', 'Institutional contact', 'ICASEES', '+236 72 14 96 15' ),
				array( 'Professional Organisation', 'Professional organisation contact', 'ICASEES — IT & Network Solutions', '+236 72 68 13 54' ),
			),

			'partners'       => array( 'Welthungerhilfe', 'Médecins du Monde', 'DanChurchAid', 'ACTED', 'International Medical Corps' ),
		),
	);
}

/**
 * Retourne la langue active : 'fr' (défaut) ou 'en'.
 */
function andonick_lang() {
	$lang = isset( $_GET['lang'] ) ? sanitize_key( wp_unslash( $_GET['lang'] ) ) : '';
	return ( 'en' === $lang ) ? 'en' : 'fr';
}

/**
 * Récupère une chaîne traduite. Ex. andonick_t( 'nav_contact' ).
 * Lit d'abord le Customizer (Apparence → Personnaliser), sinon la valeur par défaut.
 */
function andonick_t( $key ) {
	$content = andonick_content();
	$lang    = andonick_lang();
	$default = isset( $content[ $lang ][ $key ] ) ? $content[ $lang ][ $key ] : '';
	return get_theme_mod( "andonick_{$lang}_{$key}", $default );
}

/**
 * Nombre des statistiques (éditables). Ex. andonick_stat( 'stat1_num' ).
 */
function andonick_stat( $key ) {
	return andonick_t( $key );
}

/**
 * URL d'une image éditable du site.
 * Ex. andonick_img( 'hero' ), andonick_img( 'gallery_1' ).
 */
function andonick_img( $key ) {
	$defaults = array(
		'hero'      => ANDONICK_URI . '/assets/img/hero.jpg',
		'group'     => ANDONICK_URI . '/assets/img/domaines.jpg',
		'impact'    => ANDONICK_URI . '/assets/img/impact.jpg',
		'gallery_1' => ANDONICK_URI . '/assets/img/hero.jpg',
		'gallery_2' => ANDONICK_URI . '/assets/img/domaines.jpg',
		'gallery_3' => ANDONICK_URI . '/assets/img/impact.jpg',
		'gallery_4' => ANDONICK_URI . '/assets/img/photo-07.jpg',
		'gallery_5' => ANDONICK_URI . '/assets/img/photo-08.jpg',
		'gallery_6' => ANDONICK_URI . '/assets/img/photo-11.jpg',
	);
	$mod      = get_theme_mod( "andonick_img_{$key}", '' );
	return ( '' !== $mod ) ? $mod : $defaults[ $key ];
}

/**
 * Image du logo : logo personnalisé WP si défini, sinon logo officiel du thème.
 */
function andonick_logo() {
	$custom = get_theme_mod( 'custom_logo' );
	if ( $custom ) {
		$url = wp_get_attachment_image_url( $custom, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	return ANDONICK_URI . '/assets/img/logo.png';
}

/**
 * Liste à partir d'un Customizer « 1 ligne = 1 élément » avec repli sur les défauts.
 */
function andonick_lines( $key, $default_lines ) {
	$lang = andonick_lang();
	$raw  = get_theme_mod( "andonick_{$lang}_{$key}", '' );
	if ( '' !== $raw ) {
		$lines = array_filter( array_map( 'trim', explode( "\n", $raw ) ) );
		if ( ! empty( $lines ) ) {
			return array_values( $lines );
		}
	}
	return $default_lines;
}

/**
 * Les 8 métiers (éditables).
 */
function andonick_filiales() {
	$lang   = andonick_lang();
	$defs   = andonick_content()[ $lang ]['filiales'];
	$result = array();
	foreach ( $defs as $i => $f ) {
		$tags_raw = get_theme_mod( "andonick_{$lang}_filiales_{$i}_tags", '' );
		$tags     = ( '' !== $tags_raw ) ? array_values( array_filter( array_map( 'trim', explode( "\n", $tags_raw ) ) ) ) : $f['tags'];
		$result[] = array(
			'num'   => get_theme_mod( "andonick_{$lang}_filiales_{$i}_num", $f['num'] ),
			'title' => get_theme_mod( "andonick_{$lang}_filiales_{$i}_title", $f['title'] ),
			'desc'  => get_theme_mod( "andonick_{$lang}_filiales_{$i}_desc", $f['desc'] ),
			'tags'  => $tags,
		);
	}
	return $result;
}

/**
 * Les témoignages (éditables).
 */
function andonick_testis() {
	$lang   = andonick_lang();
	$defs   = andonick_content()[ $lang ]['testis'];
	$result = array();
	foreach ( $defs as $i => $t ) {
		$result[] = array(
			get_theme_mod( "andonick_{$lang}_testis_{$i}_quote", $t[0] ),
			get_theme_mod( "andonick_{$lang}_testis_{$i}_name", $t[1] ),
			get_theme_mod( "andonick_{$lang}_testis_{$i}_role", $t[2] ),
		);
	}
	return $result;
}

/**
 * Les impacts (éditables).
 */
function andonick_impacts() {
	$lang   = andonick_lang();
	$defs   = andonick_content()[ $lang ]['impacts'];
	$result = array();
	foreach ( $defs as $i => $imp ) {
		$result[] = array(
			get_theme_mod( "andonick_{$lang}_impacts_{$i}_title", $imp[0] ),
			get_theme_mod( "andonick_{$lang}_impacts_{$i}_desc", $imp[1] ),
		);
	}
	return $result;
}

/**
 * Tableau des références (éditable : 1 ligne = Catégorie | Nom | Fonction | Téléphone).
 */
function andonick_refs() {
	$lang = andonick_lang();
	$raw  = get_theme_mod( "andonick_{$lang}_refs_rows", '' );
	if ( '' !== $raw ) {
		$rows = array();
		foreach ( explode( "\n", $raw ) as $line ) {
			$parts = array_map( 'trim', explode( '|', $line ) );
			if ( count( $parts ) >= 4 ) {
				$rows[] = array_slice( $parts, 0, 4 );
			}
		}
		if ( ! empty( $rows ) ) {
			return $rows;
		}
	}
	return andonick_content()[ $lang ]['refs'];
}

/**
 * En-têtes du tableau références (éditables).
 */
function andonick_ref_headers() {
	return andonick_lines( 'ref_headers', andonick_content()[ andonick_lang() ]['ref_headers'] );
}

/**
 * Partenaires (éditables).
 */
function andonick_partners() {
	return andonick_lines( 'partners', andonick_content()[ andonick_lang() ]['partners'] );
}

/**
 * Liste déroulante des services (éditable).
 */
function andonick_services() {
	return andonick_lines( 'services', andonick_content()[ andonick_lang() ]['services'] );
}

/**
 * Créneaux de rappel (éditables).
 */
function andonick_slots() {
	return andonick_lines( 'slots', andonick_content()[ andonick_lang() ]['slots'] );
}

/**
 * Les 6 images de la galerie (éditables).
 */
function andonick_gallery() {
	$imgs = array();
	for ( $i = 1; $i <= 6; $i++ ) {
		$imgs[] = andonick_img( 'gallery_' . $i );
	}
	return $imgs;
}

/**
 * URL de la page dans l'autre langue (préserve ancre et langue).
 */
function andonick_lang_url( $target = 'en' ) {
	$scheme = ( is_ssl() ) ? 'https' : 'http';
	$parts  = wp_parse_url( $scheme . '://' . ( isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : 'localhost' ) . ( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/' ) );
	$path   = isset( $parts['path'] ) ? $parts['path'] : '/';
	$hash   = '';
	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		$uri    = esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) );
		$hpos   = strpos( $uri, '#' );
		if ( false !== $hpos ) {
			$hash = substr( $uri, $hpos );
		}
	}
	return home_url( $path ) . '?lang=' . $target . $hash;
}