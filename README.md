# ANDONICK GROUP INTERNATIONAL — Site WordPress

Site vitrine one-page bilingue (FR/EN) de **ANDONICK Group International** (Bangui · Dakar · Bordeaux), développé en WordPress avec un thème 100 % custom.

> **Charte graphique stricte** : violet `#461491`, violet foncé `#2A0A63`, blanc `#FFFFFF`, gris `#333333`. Aucune autre couleur (jaune, or...) n'est autorisée.

---

## Aperçu

- **Environnement local** : XAMPP (Apache + MySQL + PHP 8.x) — WordPress 7.0
- **Thème** : `andonick` (classique, sans builder, zéro plugin additionnel)
- **Multilingue** : FR (défaut) / EN via `?lang=en` — service de langue complet (locale WP, `<html lang>`, titre d'onglet, hreflang, canonical)
- **Contenu** : 8 métiers (extensible à 12 dès le Customizer), témoignages (6 places), références (illimité), partenaires (illimité), formulaires devis/rappel, galerie réalisations (12 places)

## Structure du thème

```
wp-content/themes/andonick/
├── style.css              → déclaration du thème + CSS complet (charte)
├── functions.php          → setup, assets, service de langues, envoi des formulaires
├── header.php             → topbar, navigation, bouton FR/EN
├── footer.php             → footer, WhatsApp flottant, retour en haut
├── front-page.php         → orchestre les sections dans l'ordre du Customizer
├── index.php              → repli (redirige vers l'accueil)
├── inc/
│   ├── content.php        → contenu bilingue par défaut + helpers éditables
│   ├── sections.php       → les 7 sections de la page d'accueil
│   └── settings.php       → enregistrement de tout le Customizer
├── assets/
│   ├── img/               → logo officiel HD, favicon, photos du site officiel
│   └── js/main.js         → menu mobile, scrollspy, reveal, compteurs, AJAX
└── docs/                  → documentation et fichiers sources du client
```

## Installation locale

1. Installer XAMPP, démarrer Apache + MySQL.
2. Télécharger WordPress dans `C:\xampp\htdocs\wordpress`.
3. Copier ce thème dans `wp-content/themes/andonick/`.
4. Créer la base de données (ex. `wp_elecam`, charset `utf8mb4`).
5. Configurer `wp-config.php` (DB + salts officiels).
6. Activer le thème **ANDONICK Group International** (Apparence → Thèmes).
7. Ouvrir `http://localhost/wordpress/`.

## Modifier le site SANS code — Apparence → Personnaliser

Tout le site est éditable depuis l'admin WordPress, sans toucher au code :

- **Panneau « ANDONICK — Contenu du site »** :
  - **Structure & Ordre** : l'ordre d'affichage des 7 sections (une ligne = une section, retirez la ligne pour masquer)
  - **Textes principaux — FR / EN** : tous les textes de la page dans chaque langue
  - **Les métiers — FR / EN** : 12 emplacements (8 remplis par défaut, **4 libres pour ajouter de nouveaux métiers plus tard**)
  - **Témoignages & Références — FR / EN** : 6 emplacements de témoignages (3 remplis), références illimitées (1 ligne = `Catégorie | Nom | Fonction | Téléphone`), en-têtes du tableau
  - **Formulaires & listes — FR / EN** : impacts (8 places, 4 libres), partenaires, liste déroulante des services, créneaux de rappel, statistiques (chiffres + libellés)
  - **Images** : photo du hero, photos des sections, **12 places de galerie** (6 remplies ; place vide = photo non affichée)
- **Identité du site** (Réglages de base) : logo, titre, icône, description.
- **Liens des menus & boutons**, grand titre, bandes du haut de page, valeurs, e-mail de contact : rien n'est figé, tout texte et tout lien peut être changé (2 langues).
- **Apparence & Styles** (Personnalizer > ANDONICK — Apparence & Styles) : couleurs, polices, alignements, espacements, positions (hero, galerie, menu fixe) et arrière-plans — sans code, valeurs par défaut = design officiel.
- Chaque modification est **prévisualisée en direct** ; « Publier » applique au site.
- Les fichiers ne sont jamais à modifier : tout part de `inc/content.php` (valeurs par défaut, source officielle) et du Customizer (ce que le client voit et change).

**Règles** : ne jamais modifier les couleurs, ni le logo (fichier officiel, à conserver intact), ni ajouter de couleur hors charte.

## Service de langues (complet, sans plugin)

L'approche `?lang=en` est recommandée pour un site vitrine structuré (zéro requête DB, pas de plugin lourd). Pour être complet et SEO-correct :
- `switch_to_locale('en_US')` → tout WordPress parle anglais (admin bar, dates, plugins)
- `<html lang="en-US">` (fr-FR par défaut)
- Titre de l'onglet traduit (« ANDONICK Group International — Pan-African multi-sector group »)
- `hreflang` réciproques fr/en + `x-default`, `canonical` auto-référent par langue
- `body class="lang-en"` / `lang-fr`
- Tout texte visible est traduit (162 chaînes auditées à chaque build — 0 texte non traduit)

## Mise en production — checklist

- [ ] Hébergement PHP 8+ avec MySQL/MariaDB
- [ ] Passer `WP_DEBUG` à `false` dans `wp-config.php`
- [ ] Installer **WP Mail SMTP** (l'envoi local des formulaires ne fonctionne pas sans)
- [ ] Certificat SSL (Let's Encrypt) + redirection HTTPS
- [ ] CDN Cloudflare (perfs + protection)
- [ ] Sauvegardes régulières (UpdraftPlus)
- [ ] Remplacer les URL locales (`http://localhost/wordpress`) par le domaine

## Versions

- **3.2.0** — Nouveau panneau « ANDONICK — Apparence & Styles » : couleurs (8 réglages par roue chromatique), polices & taille de texte, alignement du haut de page, largeur du contenu, espacements des sections, hauteur du hero, colonnes de la galerie, coins arrondis, menu fixe oui/non, visibilité des photos, images de fond facultatives par section — le tout injecté en variables CSS (15/15 vérifications ok) + guide PDF du propriétaire enrichi (16 pages, 20 scénarios)
- **3.1.0** — Audit « zéro élément figé » : plus rien d'en dur dans les gabarits. Grand titre du hero, suffixe des statistiques, liens des boutons & du menu éditables ; e-mail de contact (affiché + destinataire) ; listes ajoutables/retirables partout (bandes du haut de page, valeurs du Groupe) ; logo/alt/aria pilotés par l'identité du site ; pilule de langue localisée ; favicon déléguée à « Icône du site » si définie
- **3.0.1** — Correctif bouton langue : les liens FR/EN ne contenaient plus le double chemin d'installation (sous-dossier `/wordpress/`) — la langue et la pilule actives basculent correctement
- **3.0.0** — Personnalisation totale depuis WordPress : ordre & masquage des sections, 12 métiers (4 ajoutables), 6 témoignages, 8 impacts, 12 photos de galerie, références/partenaires illimités + service de langues complet (html lang, titre d'onglet, hreflang, canonical, locale) + audit exhaustif des 162 chaînes
- **2.2.1** — Bouton FR/EN fiable : le changement de langue conserve la section en cours (plus de retour en haut), photos du hero/impact plus visibles (zoom supprimé, opacité relevée), galerie rééquilibrée (photo paysage), légende sous la photo « Le Groupe »
- **2.2.0** — Rendu image professionnel : galerie en masonry (chaque photo affichée en entier, aucun recadrage), photo « Le Groupe » au ratio naturel 2:3, téléphones / villes / message WhatsApp éditables depuis le Customizer
- **2.1.0** — Sélecteur de langue FR/EN visible dans le header (bouton segmenté, desktop + mobile), statistiques du hero corrigées (15+, 8, 3), contenu 100 % éditable depuis le Customizer + audit complet des traductions
- **2.0.0** — Refonte design premium : animations au scroll, compteurs animés, scrollspy, barre de progression, WhatsApp flottant, galerie réalisations, responsiveness profond (320–1440px)
- **1.0.0** — Création du thème one-page bilingue conforme à la charte

© 2026 ANDONICK Group International. Tous droits réservés.