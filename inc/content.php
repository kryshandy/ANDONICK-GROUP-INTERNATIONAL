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
			'nav_group'       => 'Le Groupe',
			'nav_filiales'    => 'Filiales & Activités',
			'nav_impact'      => 'Impact',
			'nav_refs'        => 'Références',
			'nav_contact'     => 'Contact',
			'nav_devis'       => 'Demander un devis',
			'nav_group_href'  => '#groupe',
			'nav_filiales_href' => '#filiales',
			'nav_impact_href' => '#impact',
			'nav_refs_href'   => '#references',
			'nav_contact_href'=> '#contact',
			'nav_devis_href'  => '#devis',

			// Hero.
			'hero_tag'        => 'Groupe multisectoriel panafricain',
			'hero_title_main' => 'ANDONICK GROUP',
			'hero_title_tail' => 'INTERNATIONAL',
			'hero_title'      => 'ANDONICK GROUP INTERNATIONAL',
			'hero_lead'       => 'Télécommunications, énergie solaire, sécurité, BTP, transport & logistique, commerce général, facility management et conseil : un partenaire technique unique, présent à Bangui, Dakar et Bordeaux.',
			'hero_cta1'       => 'Demander un devis en ligne',
			'hero_cta2'       => 'Découvrir nos filiales',
			'hero_cta1_href'  => '#devis',
			'hero_cta2_href'  => '#filiales',
			'hero_cap'        => 'Nos équipes techniques et logistiques, mobilisées à travers l\'Afrique',
			'contact_mail'    => 'contact@andonickgroup.com',
			'stats'           => array(
				'15+|ans d\'expertise en Centrafrique',
				'8|filiales complémentaires',
				'3|pays — RCA · Sénégal · France',
			),
			'map_embed'       => '',
			'map_url'         => '',
			'map_lien'        => 'Voir sur la carte',
			'map_dir'         => 'ANDONICK Group — Quartier Sica 1, Rue du Languedoc, Bangui, République Centrafricaine',
			'socials'         => array(),
			'news_eyebrow'    => 'Actualités',
'news_title'    => 'L\'actualité du Groupe',
			'news_sub'      => '',
			'news_more'     => 'Lire la suite',
			'news_count'    => '3',
			'seo_desc'      => 'ANDONICK Group International — groupe multisectoriel panafricain présent à Bangui (Centrafrique), Dakar (Sénégal) et Bordeaux (France) : bâtiment, énergie, TIC, transport, mines, agriculture, commerce et services financiers.',
			'page_404_title' => 'Introuvable',
			'page_404_body'  => 'Le contenu demandé n\'existe plus ou n\'est plus disponible.',
			'page_404_back'  => 'Retour à l\'accueil',
			'page_prev'      => 'Article précédent',
			'page_next'      => 'Article suivant',
			'texte1_eyebrow' => '',
			'texte1_title'   => '',
			'texte1_body'    => '',
			'texte1_btn'     => '',
			'texte1_btn_href' => '',
			'texte2_eyebrow' => '',
			'texte2_title'   => '',
			'texte2_body'    => '',
			'texte2_btn'     => '',
			'texte2_btn_href' => '',
			'texte3_eyebrow' => '',
			'texte3_title'   => '',
			'texte3_body'    => '',
			'texte3_btn'     => '',
			'texte3_btn_href' => '',
			'banniere1_title' => '',
			'banniere1_body'  => '',
			'banniere1_btn'   => '',
			'banniere1_btn_href' => '',
			'banniere2_title' => '',
			'banniere2_body'  => '',
			'banniere2_btn'   => '',
			'banniere2_btn_href' => '',
			'banniere3_title' => '',
			'banniere3_body'  => '',
			'banniere3_btn'   => '',
			'banniere3_btn_href' => '',
			'devis_fields'   => array(
				'Nom complet|text|1',
				'Entreprise|text|0',
				'Téléphone|tel|1',
				'E-mail|email|0',
				'Filiale / service concerné|select|0|services',
				'Votre message|textarea|1',
				'Créneau de rappel souhaité|select|0|slots',
				'Ville|text|0',
			),
			'rappel_fields'  => array(
				'Nom complet|text|1',
				'Téléphone|tel|1',
				'Objet de la demande|text|0',
				'Créneau de rappel|select|0|slots',
				'Ville|text|0',
			),
			'strip'           => array(
				'Distributeur officiel Starlink RCA',
				'Fibre optique & Cybersécurité',
				'Énergie solaire clé en main',
				'Vidéosurveillance intelligente',
				'Conseil & Formation',
			),

			// Le Groupe.
			's2_eyebrow'    => 'Le Groupe',
			's2_title'      => 'Un acteur technologique et industriel intégré',
			's2_body'       => 'ANDONICK Group International est une entreprise multisectorielle basée à Bangui (République Centrafricaine), avec une présence à Dakar (Sénégal) et à Bordeaux (France). Dirigé par son Président-Directeur Général, M. Nico Andonick, le Groupe accompagne depuis plus de quinze ans les institutions publiques, les organisations humanitaires, les entreprises et les particuliers dans leurs projets d\'infrastructures, de connectivité et de services. Structuré en filiales spécialisées et complémentaires, le Groupe apporte une réponse intégrée : étude, déploiement, exploitation et maintenance, avec un même niveau d\'exigence sur l\'ensemble du territoire centrafricain et au-delà.',
			'values'        => array(
				'Fiabilité',
				'Innovation',
				'Engagement',
				'Partenariat durable',
			),
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
			'gallery_zoom'    => 'Agrandir la photo',

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
			'wa_msg'          => 'Bonjour ANDONICK Group, je souhaite un devis.',
			'call_direct'     => 'Appeler directement',
			'phone_rca1'      => '+236 75 00 06 49',
			'phone_rca2'      => '+236 70 28 66 01',
			'phone_fr'        => '+33 6 05 56 43 73',
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
			'form_copy_subject' => 'Confirmation de votre demande — ANDONICK Group International',
			'form_copy_body'  => 'Bonjour,

Votre demande a bien été transmise à l\'équipe ANDONICK Group International. Nous vous remercions de votre confiance et vous recontacterons dans les meilleurs délais.

Cordialement,
L\'équipe ANDONICK
Group International',
			'cookies_text'    => 'Ce site n\'utilise pas de cookies de suivi : vos données restent sur vos appareils. En poursuivant votre navigation, vous acceptez l\'usage des cookies strictement nécessaires au bon fonctionnement du site.',
			'cookies_accept'  => 'J\'accepte',
			'cookies_decline' => 'Je refuse',
			'foot_tag'        => 'Votre réussite, notre engagement. Groupe multisectoriel présent en République Centrafricaine, au Sénégal et en France.',
			'foot_cities'     => 'Bangui · Dakar · Bordeaux',
			'foot_filiales'   => 'Filiales',
			'foot_contact'    => 'Contact',
			'foot_copy'       => '© 2026 ANDONICK Group International. Tous droits réservés.',
			'lang_fr'         => 'Français',
			'lang_en'         => 'English',
			'aria_nav'        => 'Navigation principale',
			'aria_menu'       => 'Menu',
			'aria_top'        => 'Retour en haut',

			// Menu / bandeau du haut / colonnes du pied de page :
			// laissés vides = comportement automatique (5 liens du menu,
			// téléphones du bandeau, filiales & coordonnées du pied de page).
			// Remplis = 1 ligne par lien au format « Libellé|URL » (vide = masqué).
			'nav_links'        => '',
			'topbar_links'     => '',
			'foot_col2_links'  => '',
			'foot_col3_links'  => '',
			'foot_col4_title'  => '',
			'foot_col4_links'  => '',

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
			'nav_group_href'  => '#groupe',
			'nav_filiales_href' => '#filiales',
			'nav_impact_href' => '#impact',
			'nav_refs_href'   => '#references',
			'nav_contact_href'=> '#contact',
			'nav_devis_href'  => '#devis',

			'hero_tag'      => 'Pan-African multi-sector group',
			'hero_title_main' => 'ANDONICK GROUP',
			'hero_title_tail' => 'INTERNATIONAL',
			'hero_title'    => 'ANDONICK GROUP INTERNATIONAL',
			'hero_lead'     => 'Telecommunications, solar energy, security, construction, transport & logistics, general trade, facility management and consulting: a single technical partner, present in Bangui, Dakar and Bordeaux.',
			'hero_cta1'     => 'Request a Quote Online',
			'hero_cta2'     => 'Discover Our Subsidiaries',
			'hero_cta1_href'  => '#devis',
			'hero_cta2_href'  => '#filiales',
			'hero_cap'      => 'Our technical and logistics teams, mobilised across Africa',
			'contact_mail'  => 'contact@andonickgroup.com',
			'stats'         => array(
				'15+|years of expertise in Central Africa',
				'8|complementary subsidiaries',
				'3|countries — CAR · Senegal · France',
			),
			'map_embed'     => '',
			'map_url'       => '',
			'map_lien'      => 'View on the map',
			'map_dir'       => 'ANDONICK Group — Quartier Sica 1, Rue du Languedoc, Bangui, Central African Republic',
			'socials'       => array(),
			'news_eyebrow'  => 'News',
			'news_title'    => 'Group News',
			'news_sub'      => '',
			'news_more'     => 'Read more',
			'news_count'    => '3',
			'seo_desc'      => 'ANDONICK Group International — pan-African multi-sector group based in Bangui (Central African Republic), Dakar (Senegal) and Bordeaux (France): construction, energy, ICT, transport, mining, agriculture, trade and financial services.',
			'page_404_title' => 'Not Found',
			'page_404_body'  => 'The requested content no longer exists or is no longer available.',
			'page_404_back'  => 'Back to home',
			'page_prev'      => 'Previous article',
			'page_next'      => 'Next article',
			'texte1_eyebrow' => '',
			'texte1_title'   => '',
			'texte1_body'    => '',
			'texte1_btn'     => '',
			'texte1_btn_href' => '',
			'texte2_eyebrow' => '',
			'texte2_title'   => '',
			'texte2_body'    => '',
			'texte2_btn'     => '',
			'texte2_btn_href' => '',
			'texte3_eyebrow' => '',
			'texte3_title'   => '',
			'texte3_body'    => '',
			'texte3_btn'     => '',
			'texte3_btn_href' => '',
			'banniere1_title' => '',
			'banniere1_body'  => '',
			'banniere1_btn'   => '',
			'banniere1_btn_href' => '',
			'banniere2_title' => '',
			'banniere2_body'  => '',
			'banniere2_btn'   => '',
			'banniere2_btn_href' => '',
			'banniere3_title' => '',
			'banniere3_body'  => '',
			'banniere3_btn'   => '',
			'banniere3_btn_href' => '',
			'devis_fields'   => array(
				'Full name|text|1',
				'Company|text|0',
				'Phone|tel|1',
				'E-mail|email|0',
				'Subsidiary / service concerned|select|0|services',
				'Your message|textarea|1',
				'Preferred callback slot|select|0|slots',
				'City|text|0',
			),
			'rappel_fields'  => array(
				'Full name|text|1',
				'Phone|tel|1',
				'Subject of the request|text|0',
				'Callback slot|select|0|slots',
				'City|text|0',
			),
			'strip'         => array(
				'Official Starlink Distributor CAR',
				'Fibre Optics & Cybersecurity',
				'Turnkey Solar Energy',
				'Smart CCTV',
				'Consulting & Training',
			),

			's2_eyebrow'    => 'The Group',
			's2_title'      => 'An integrated technology and industrial group',
			's2_body'       => 'ANDONICK Group International is a multi-sector company headquartered in Bangui (Central African Republic), with a presence in Dakar (Senegal) and Bordeaux (France). Led by its Chief Executive Officer, Mr. Nico Andonick, the Group has spent over fifteen years supporting public institutions, humanitarian organisations, businesses and individuals with their infrastructure, connectivity and service projects. Organised into specialised, complementary subsidiaries, the Group delivers an integrated response — study, deployment, operation and maintenance — with the same standard of excellence across the entire Central African territory and beyond.',
			'values'        => array(
				'Reliability',
				'Innovation',
				'Commitment',
				'Lasting Partnership',
			),
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
			'gallery_zoom'    => 'Enlarge photo',

			'contact_eyebrow' => 'Contact',
			'contact_title'   => 'Let\'s Discuss Your Project',
			'contact_sub'     => 'Request a quote, ask to be called back, or contact us directly — we respond within 24 to 48 business hours.',
			'contact_coord'   => 'Our Contact Details',
			'contact_addr'    => 'ANDONICK Group — Sis Quartier Sica 1, Rue du Languedoc, Bangui, Central African Republic',
			'lbl_rca'         => '(CAR)',
			'lbl_fr'          => '(France)',
			'wa_rca'          => 'Chat on WhatsApp (CAR)',
			'wa_fr'           => 'Chat on WhatsApp (France)',
			'wa_msg'          => 'Hello ANDONICK Group, I would like a quote.',
			'call_direct'     => 'Call Directly',
			'phone_rca1'      => '+236 75 00 06 49',
			'phone_rca2'      => '+236 70 28 66 01',
			'phone_fr'        => '+33 6 05 56 43 73',
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
			'form_copy_subject' => 'Confirmation of your request — ANDONICK Group International',
			'form_copy_body'  => 'Hello,

Your request has been forwarded to the ANDONICK Group International team. Thank you for your trust — we will get back to you as soon as possible.

Kind regards,
The ANDONICK Group
International team',
			'cookies_text'    => 'This site does not use tracking cookies: your data stays on your devices. By continuing to browse, you accept the use of cookies strictly necessary for the site to work properly.',
			'cookies_accept'  => 'I accept',
			'cookies_decline' => 'I decline',
			'foot_tag'        => 'Your success is our commitment. A multi-sector group present in the Central African Republic, Senegal and France.',
			'foot_cities'     => 'Bangui · Dakar · Bordeaux',
			'foot_filiales'   => 'Subsidiaries',
			'foot_contact'    => 'Contact',
			'foot_copy'       => '© 2026 ANDONICK Group International. All rights reserved.',
			'lang_fr'         => 'Français',
			'lang_en'         => 'English',
			'aria_nav'        => 'Main navigation',
			'aria_menu'       => 'Menu',
			'aria_top'        => 'Back to top',

			'nav_links'        => '',
			'topbar_links'     => '',
			'foot_col2_links'  => '',
			'foot_col3_links'  => '',
			'foot_col4_title'  => '',
			'foot_col4_links'  => '',

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
	$value   = get_theme_mod( "andonick_{$lang}_{$key}", $default );
	return ( '' === $value ) ? $default : $value;
}

/**
 * Nombre des statistiques (éditables). Ex. andonick_stat( 'stat1_num' ).
 */
function andonick_stat( $key ) {
	return andonick_t( $key );
}

/**
 * Numéro de téléphone en chiffres (pour les liens tel: et wa.me).
 * Ex. andonick_tel( 'phone_rca1' ).
 */
function andonick_tel( $key ) {
	return preg_replace( '/[^0-9+]/', '', andonick_t( $key ) );
}

/**
 * Numéro de téléphone en chiffres uniquement (pour les liens WhatsApp).
 * Ex. andonick_wa( 'phone_rca1' ).
 */
function andonick_wa( $key ) {
	return preg_replace( '/[^0-9]/', '', andonick_t( $key ) );
}

/**
 * URL d'une image éditable du site.
 * Ex. andonick_img( 'hero' ), andonick_img( 'gallery_1' ).
 */
function andonick_img( $key ) {
	$defaults = array(
		'hero'       => ANDONICK_URI . '/assets/img/hero.jpg',
		'group'      => ANDONICK_URI . '/assets/img/domaines.jpg',
		'impact'     => ANDONICK_URI . '/assets/img/impact.jpg',
		'gallery_1'  => ANDONICK_URI . '/assets/img/hero.jpg',
		'gallery_2'  => ANDONICK_URI . '/assets/img/photo-10.jpg',
		'gallery_3'  => ANDONICK_URI . '/assets/img/impact.jpg',
		'gallery_4'  => ANDONICK_URI . '/assets/img/photo-07.jpg',
		'gallery_5'  => ANDONICK_URI . '/assets/img/photo-08.jpg',
		'gallery_6'  => ANDONICK_URI . '/assets/img/photo-11.jpg',
		'gallery_7'  => '',
		'gallery_8'  => '',
		'gallery_9'  => '',
		'gallery_10' => '',
		'gallery_11' => '',
		'gallery_12' => '',
		'filiale_1'  => ANDONICK_URI . '/assets/img/metiers/telecom.jpg',
		'filiale_2'  => ANDONICK_URI . '/assets/img/metiers/solar.jpg',
		'filiale_3'  => ANDONICK_URI . '/assets/img/metiers/security.jpg',
		'filiale_4'  => ANDONICK_URI . '/assets/img/metiers/btp.jpg',
		'filiale_5'  => ANDONICK_URI . '/assets/img/metiers/transport.jpg',
		'filiale_6'  => ANDONICK_URI . '/assets/img/metiers/commerce.jpg',
		'filiale_7'  => ANDONICK_URI . '/assets/img/metiers/facility.jpg',
		'filiale_8'  => ANDONICK_URI . '/assets/img/metiers/ltd.jpg',
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
 * Photo d'un métier (par position dans la liste « Les métiers »).
 * Vide (ou position au-delà de 8) = carte sans photo, comme avant.
 */
function andonick_filiale_img( $index ) {
	return andonick_img( 'filiale_' . $index );
}

/**
 * Les métiers — illimités et édités sans code.
 * Champ « Les métiers » : 1 ligne = « Numéro|Titre|Description|Étiquette1;Étiquette2 ».
 * Vide partiellement → comportement d'origine (les 8 métiers officiels).
 */
function andonick_filiales_legacy( $lang ) {
	$defs   = andonick_content()[ $lang ]['filiales'];
	$result = array();
	for ( $i = 0; $i < 12; $i++ ) {
		$f = isset( $defs[ $i ] ) ? $defs[ $i ] : array( 'num' => '', 'title' => '', 'desc' => '', 'tags' => array() );
		$tags_raw = get_theme_mod( "andonick_{$lang}_filiales_{$i}_tags", '' );
		$title    = get_theme_mod( "andonick_{$lang}_filiales_{$i}_title", $f['title'] );
		if ( '' === trim( $title ) ) {
			continue;
		}
		$tags = ( '' !== $tags_raw ) ? array_values( array_filter( array_map( 'trim', explode( "\n", $tags_raw ) ) ) ) : $f['tags'];
		$result[] = array(
			'num'   => get_theme_mod( "andonick_{$lang}_filiales_{$i}_num", $f['num'] ),
			'title' => $title,
			'desc'  => get_theme_mod( "andonick_{$lang}_filiales_{$i}_desc", $f['desc'] ),
			'tags'  => $tags,
		);
	}
	return $result;
}

/**
 * Format « une ligne par métier » correspondant aux valeurs actuelles
 * (utilisé comme contenu pré-rempli du champ dans le Customizer).
 */
function andonick_format_filiales_rows( $lang ) {
	$out = array();
	foreach ( andonick_filiales_legacy( $lang ) as $f ) {
		$out[] = $f['num'] . '|' . $f['title'] . '|' . $f['desc'] . '|' . implode( ';', $f['tags'] );
	}
	return implode( "\n", $out );
}

function andonick_filiales() {
	$lang = andonick_lang();
	$raw  = (string) get_theme_mod( "andonick_{$lang}_filiales_rows", '' );
	if ( '' !== $raw ) {
		$out = array();
		foreach ( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) as $line ) {
			$parts = array_pad( array_map( 'trim', explode( '|', $line, 4 ) ), 4, '' );
			if ( '' === $parts[1] ) {
				continue;
			}
			$out[] = array(
				'num'   => $parts[0],
				'title' => $parts[1],
				'desc'  => $parts[2],
				'tags'  => array_values( array_filter( array_map( 'trim', explode( ';', $parts[3] ) ) ) ),
			);
		}
		if ( ! empty( $out ) ) {
			return $out;
		}
	}
	return andonick_filiales_legacy( $lang );
}

/**
 * Les bandes du bandeau du haut de page (éditables, 1 ligne = 1 bande).
 */
function andonick_strips() {
	return andonick_lines( 'strip', andonick_content()[ andonick_lang() ]['strip'] );
}

/**
 * Les valeurs du Groupe (éditables, 1 ligne = 1 valeur).
 */
function andonick_values() {
	return andonick_lines( 'values', andonick_content()[ andonick_lang() ]['values'] );
}

/**
 * Les statistiques du haut de page (éditables et illimitées).
 * 1 ligne = « nombre|libellé » (ex. « 15+|ans d'expertise »).
 * Les lignes vides sont ignorées.
 */
function andonick_stats() {
	$default = implode( "\n", andonick_content()[ andonick_lang() ]['stats'] );
	$raw     = (string) get_theme_mod( 'andonick_' . andonick_lang() . '_stats', $default );
	$out     = array();
	foreach ( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) as $line ) {
		$parts  = array_map( 'trim', explode( '|', $line, 2 ) );
		$num    = isset( $parts[0] ) ? $parts[0] : '';
		$label  = isset( $parts[1] ) ? $parts[1] : '';
		if ( '' === $num && '' === $label ) {
			continue;
		}
		$out[] = array( $num, $label );
	}
	return $out;
}

/**
 * Les réseaux sociaux (éditables, illimités).
 * 1 ligne = « Nom|URL » (ex. « Facebook|https://facebook.com/… »).
 * Vide = aucun lien affiché.
 */
function andonick_socials() {
	$raw = get_theme_mod( 'andonick_' . andonick_lang() . '_socials', '' );
	if ( '' === $raw ) {
		return array();
	}
	$out = array();
	foreach ( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		if ( isset( $parts[1] ) && '' !== $parts[0] ) {
			$out[] = array( $parts[0], $parts[1] );
		}
	}
	return $out;
}

/**
 * Les pages légales (liens du pied de page) — choisies dans les pages WordPress.
 * Rendu uniquement si des pages existent.
 */
function andonick_legal_pages() {
	$ids = array();
	foreach ( array( '1', '2', '3' ) as $n ) {
		$id = absint( get_theme_mod( 'andonick_legal_page_' . $n, 0 ) );
		if ( $id > 0 && 'publish' === get_post_status( $id ) ) {
			$ids[] = $id;
		}
	}
	return $ids;
}

/**
 * Liens « Libellé|URL » (1 par ligne). Champ vide = repli sur $fallback.
 */
function andonick_links_from( $lang_key, $fallback ) {
	$lang = andonick_lang();
	$raw  = (string) get_theme_mod( 'andonick_' . $lang . '_' . $lang_key, '' );
	if ( '' === $raw ) {
		return $fallback;
	}
	$out = array();
	foreach ( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) as $line ) {
		$parts = array_pad( array_map( 'trim', explode( '|', $line, 2 ) ), 2, '' );
		if ( '' !== $parts[0] && '' !== $parts[1] ) {
			$out[] = array( $parts[0], $parts[1] );
		}
	}
	return $out;
}

/**
 * Liens du menu principal (illimités). Vide = les 5 liens officiels.
 * 1 ligne = « Libellé|URL » (ex. « Le Groupe|#groupe »).
 */
function andonick_nav_links() {
	return andonick_links_from( 'nav_links', array(
		array( andonick_t( 'nav_group' ), andonick_t( 'nav_group_href' ) ),
		array( andonick_t( 'nav_filiales' ), andonick_t( 'nav_filiales_href' ) ),
		array( andonick_t( 'nav_impact' ), andonick_t( 'nav_impact_href' ) ),
		array( andonick_t( 'nav_refs' ), andonick_t( 'nav_refs_href' ) ),
		array( andonick_t( 'nav_contact' ), andonick_t( 'nav_contact_href' ) ),
	) );
}

/**
 * Liens du bandeau supérieur (illimités). Vide = téléphones officiels.
 */
function andonick_topbar_links() {
	return andonick_links_from( 'topbar_links', array(
		array( andonick_t( 'wa_rca' ) . ' — ' . andonick_t( 'phone_rca1' ), 'https://wa.me/' . andonick_wa( 'phone_rca1' ) ),
		array( andonick_t( 'wa_fr' ) . ' — ' . andonick_t( 'phone_fr' ), 'https://wa.me/' . andonick_wa( 'phone_fr' ) ),
		array( andonick_t( 'phone_rca2' ) . ' — ' . andonick_t( 'lbl_rca' ), 'tel:' . andonick_tel( 'phone_rca2' ) ),
	) );
}

/**
 * Colonnes du pied de page. Colonnes 2 et 3 : titres et liens éditables,
 * vide = composition officielle. Colonne 4 : facultative, masquée si vide.
 * Renvoie array( titre, array( array( Libellé, URL ), … ) ) ou null (masquée).
 */
function andonick_footer_col( $n ) {
	$lang = andonick_lang();
	if ( 4 === $n ) {
		$title = trim( (string) get_theme_mod( "andonick_{$lang}_foot_col4_title", '' ) );
		$links = andonick_links_from( 'foot_col4_links', array() );
		if ( '' === $title && empty( $links ) ) {
			return null;
		}
		return array( $title, $links );
	}
	$title = andonick_t( 2 === $n ? 'foot_filiales' : 'foot_contact' );
	if ( 2 === $n ) {
		$fallback = array();
		foreach ( andonick_filiales() as $fil ) {
			$fallback[] = array( $fil['title'], '#filiales' );
		}
	} else {
		$fallback = array(
			array( andonick_t( 'contact_addr' ), '' ),
			array( andonick_t( 'phone_rca1' ), 'tel:' . andonick_tel( 'phone_rca1' ) ),
			array( andonick_t( 'phone_rca2' ) . ' — ' . andonick_t( 'lbl_rca' ), 'tel:' . andonick_tel( 'phone_rca2' ) ),
			array( andonick_t( 'phone_fr' ) . ' — ' . andonick_t( 'lbl_fr' ), 'tel:' . andonick_tel( 'phone_fr' ) ),
			array( andonick_t( 'contact_mail' ), 'mailto:' . sanitize_email( andonick_t( 'contact_mail' ) ) ),
			array( andonick_t( 'foot_cities' ), '' ),
		);
	}
	$key = ( 2 === $n ) ? 'foot_col2_links' : 'foot_col3_links';
	return array( $title, andonick_links_from( $key, $fallback ) );
}

/**
 * Interrupteurs des formulaires (1 = affiché, 0 = masqué).
 */
function andonick_form_enabled( $form ) {
	return '0' === get_theme_mod( 'andonick_' . $form . '_enabled', '1' ) ? false : true;
}

/**
 * Nombre de mots des extraits d'articles (5–60, défaut 24).
 */
function andonick_excerpt_words() {
	return min( 60, max( 5, absint( get_theme_mod( 'andonick_news_excerpt_words', 24 ) ) ) );
}

/**
 * Afficher les commentaires des articles (1 = oui, 0 = non).
 */
function andonick_blog_comments() {
	return '1' === get_theme_mod( 'andonick_blog_comments', '0' );
}

/**
 * Active ou non la section Actualités (1 = oui, 0 = non).
 */
function andonick_news_enabled() {
	return '0' === get_theme_mod( 'andonick_news_enabled', '1' ) ? false : true;
}

/**
 * Catégorie des articles de la langue active (0 = toutes les catégories).
 * Éditable sans code : « Pages légales & Actualités » dans le Customizer.
 */
function andonick_news_cat( $lang ) {
	return absint( get_theme_mod( 'andonick_news_cat_' . $lang, 0 ) );
}

/**
 * Les champs d'un formulaire — éditable sans code.
 * 1 ligne = « Libellé|type|obligatoire(0/1)|source(optionnelle) »
 * Types : text, tel, email, textarea, select.
 * Pour select : source = services (liste déroulante) ou slots (créneaux).
 */
function andonick_form_fields( $form, $lang = '' ) {
	if ( '' === $lang ) {
		$lang = andonick_lang();
	}
	if ( ! in_array( $lang, array( 'fr', 'en' ), true ) ) {
		$lang = 'fr';
	}
	$key = ( 'rappel' === $form ) ? 'rappel_fields' : 'devis_fields';
	$raw = get_theme_mod( 'andonick_' . $lang . '_' . $key, implode( "\n", andonick_content()[ $lang ][ $key ] ) );
	$out = array();
	foreach ( array_filter( array_map( 'trim', explode( "\n", (string) $raw ) ) ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line ) );
		if ( '' === $parts[0] ) {
			continue;
		}
		$type = isset( $parts[1] ) ? $parts[1] : 'text';
		if ( ! in_array( $type, array( 'text', 'tel', 'email', 'textarea', 'select' ), true ) ) {
			$type = 'text';
		}
		$out[] = array(
			'label'    => $parts[0],
			'type'     => $type,
			'required' => isset( $parts[2] ) && '1' === $parts[2],
			'options'  => isset( $parts[3] ) ? $parts[3] : '',
		);
	}
	return $out;
}

/**
 * Les sections libres activables : texte1…3, banniere1…3 (ordre des sections).
 */
function andonick_free_sections() {
	return array( 'texte1', 'texte2', 'texte3', 'banniere1', 'banniere2', 'banniere3' );
}

/**
 * Témoignages — illimités, 1 ligne = « Citation|Nom|Rôle ».
 */
function andonick_testis_raw( $lang ) {
	$defs   = andonick_content()[ $lang ]['testis'];
	$result = array();
	for ( $i = 0; $i < 6; $i++ ) {
		$t = isset( $defs[ $i ] ) ? $defs[ $i ] : array( '', '', '' );
		if ( '' === trim( $t[0] ) ) {
			continue;
		}
		$result[] = array(
			get_theme_mod( "andonick_{$lang}_testis_{$i}_quote", $t[0] ),
			get_theme_mod( "andonick_{$lang}_testis_{$i}_name", $t[1] ),
			get_theme_mod( "andonick_{$lang}_testis_{$i}_role", $t[2] ),
		);
	}
	return $result;
}

function andonick_format_testi_rows( $lang ) {
	$out = array();
	foreach ( andonick_testis_raw( $lang ) as $t ) {
		if ( '' !== trim( $t[0] ) ) {
			$out[] = implode( '|', $t );
		}
	}
	return implode( "\n", $out );
}

function andonick_testis() {
	$lang = andonick_lang();
	$raw  = (string) get_theme_mod( "andonick_{$lang}_testi_rows", '' );
	if ( '' !== $raw ) {
		$out = array();
		foreach ( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) as $line ) {
			$parts = array_pad( array_map( 'trim', explode( '|', $line, 3 ) ), 3, '' );
			if ( '' !== $parts[0] ) {
				$out[] = $parts;
			}
		}
		if ( ! empty( $out ) ) {
			return $out;
		}
	}
	return andonick_testis_raw( $lang );
}

/**
 * Impacts — illimités, 1 ligne = « Chiffre|Description ».
 */
function andonick_impacts_raw( $lang ) {
	$defs   = andonick_content()[ $lang ]['impacts'];
	$result = array();
	for ( $i = 0; $i < 8; $i++ ) {
		$imp = isset( $defs[ $i ] ) ? $defs[ $i ] : array( '', '' );
		if ( '' === trim( $imp[0] ) ) {
			continue;
		}
		$result[] = array(
			get_theme_mod( "andonick_{$lang}_impacts_{$i}_title", $imp[0] ),
			get_theme_mod( "andonick_{$lang}_impacts_{$i}_desc", $imp[1] ),
		);
	}
	return $result;
}

function andonick_format_impact_rows( $lang ) {
	$out = array();
	foreach ( andonick_impacts_raw( $lang ) as $imp ) {
		if ( '' !== trim( $imp[0] ) ) {
			$out[] = implode( '|', $imp );
		}
	}
	return implode( "\n", $out );
}

function andonick_impacts() {
	$lang = andonick_lang();
	$raw  = (string) get_theme_mod( "andonick_{$lang}_impact_rows", '' );
	if ( '' !== $raw ) {
		$out = array();
		foreach ( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) as $line ) {
			$parts = array_pad( array_map( 'trim', explode( '|', $line, 2 ) ), 2, '' );
			if ( '' !== $parts[0] ) {
				$out[] = $parts;
			}
		}
		if ( ! empty( $out ) ) {
			return $out;
		}
	}
	return andonick_impacts_raw( $lang );
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
 * Les photos de la galerie (éditables) — jusqu'à 40 emplacements,
 * seuls les remplis sont affichés (vide = ignoré).
 */
function andonick_gallery() {
	$imgs  = array();
	$slots = min( 40, max( 1, absint( get_theme_mod( 'andonick_gallery_slots', 12 ) ) ) );
	for ( $i = 1; $i <= $slots; $i++ ) {
		$url = andonick_img( 'gallery_' . $i );
		if ( '' !== $url ) {
			$imgs[] = $url;
		}
	}
	return $imgs;
}

/**
 * URL de la page dans l'autre langue (préserve ancre et langue).
 * Correcte même si WordPress est installé dans un sous-dossier
 * (ex. http://localhost/wordpress/).
 */
function andonick_lang_url( $target = 'en' ) {
	$request = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	$hash    = '';
	$hpos    = strpos( $request, '#' );
	if ( false !== $hpos ) {
		$hash    = substr( $request, $hpos );
		$request = substr( $request, 0, $hpos );
	}
	$parsed = wp_parse_url( $request );
	$path   = isset( $parsed['path'] ) ? $parsed['path'] : '/';

	// Supprime la profondeur d'installation (ex. /wordpress/) pour
	// ne garder que le chemin relatif à la racine du site.
	$home_path = rtrim( (string) wp_parse_url( home_url(), PHP_URL_PATH ), '/' );
	if ( '' !== $home_path && 0 === strpos( $path, $home_path . '/' ) ) {
		$path = substr( $path, strlen( $home_path ) );
	}
	if ( '' === $path ) {
		$path = '/';
	}
	return home_url( $path ) . '?lang=' . $target . $hash;
}