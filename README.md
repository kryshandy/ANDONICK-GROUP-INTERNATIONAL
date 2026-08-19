# ANDONICK GROUP INTERNATIONAL — Site WordPress

Site vitrine one-page bilingue (FR/EN) de **ANDONICK Group International** (Bangui · Dakar · Bordeaux), développé en WordPress avec un thème 100 % custom.

> **Charte graphique stricte** : violet `#461491`, violet foncé `#2A0A63`, blanc `#FFFFFF`, gris `#333333`. Aucune autre couleur (jaune, or...) n'est autorisée.

---

## Aperçu

- **Environnement local** : XAMPP (Apache + MySQL + PHP 8.x) — WordPress 7.0
- **Thème** : `andonick` (classique, sans builder, zéro plugin additionnel)
- **Multilingue** : FR (défaut) / EN via `?lang=en` — service de langue complet (locale WP, `<html lang>`, titre d'onglet, hreflang, canonical)
- **Contenu** : 8 métiers (extensible à 12 dès le Customizer), témoignages (6 places), références (illimité), partenaires (illimité), statistiques du haut de page (illimitées), actualités (articles WordPress), réseaux sociaux (illimités), carte Google Maps, formulaires devis/rappel aux champs modifiables, **6 sections libres (3 « texte » + 3 « bannière »)** ajoutables/masquables dans la page, galerie réalisations (12 places)
- **Référencement** : description + Open Graph/Twitter réglés sans code (par langue), image de partage dédiée, textes du blog et de la page 404 modifiables

## Structure du thème

```
wp-content/themes/andonick/
├── style.css              → déclaration du thème + CSS complet (charte)
├── functions.php          → setup, assets, service de langues, envoi des formulaires
├── header.php             → topbar, navigation, bouton FR/EN
├── footer.php             → footer, WhatsApp flottant, retour en haut
├── front-page.php         → orchestre les sections dans l'ordre du Customizer
├── index.php              → pages & articles (mentions légales, blog) + 404
├── inc/
│   ├── content.php        → contenu bilingue par défaut + helpers éditables
│   ├── sections.php       → les 8 sections de la page d'accueil
│   ├── settings.php       → enregistrement de tout le Customizer (contenu)
│   └── appearance.php     → panneau « Apparence & Styles » + réinitialisation
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
  - **Structure & Ordre** : l'ordre d'affichage des 14 sections (une ligne = une section, retirez la ligne pour masquer)
  - **Textes principaux — FR / EN** : tous les textes de la page dans chaque langue (dont carte : lien d'intégration + bouton « Voir sur la carte » ; actualités : titres, sous-titre, nombre d'articles ; **menu et bandeau du haut** : 1 ligne = `Libellé|URL`, vide = affichage officiel automatique)
  - **Les métiers — FR / EN** : **illimités** (1 ligne = `Numéro|Titre|Description|Étiquette1;Étiquette2`)
  - **Témoignages & Références — FR / EN** : **témoignages illimités** (1 ligne = `Citation|Nom|Rôle`), références illimitées (1 ligne = `Catégorie | Nom | Fonction | Téléphone`), en-têtes du tableau
  - **Formulaires & listes — FR / EN** : impacts **illimités** (1 ligne = `Chiffre|Description`), partenaires, liste déroulante des services, créneaux de rappel, **statistiques illimitées** (1 ligne = `Nombre|Libellé`, ex. `15+|ans d'expertise`), **réseaux sociaux illimités** (1 ligne = `Nom|URL`), champs des formulaires Devis/Rappel
  - **Pages légales & Actualités** : 3 liens de pied de page choisis parmi vos pages WordPress (Mentions légales, Politique de confidentialité…), interrupteur d'affichage de la section Actualités (articles du blog)
  - **Formulaires & Blog (réglages communs)** : afficher/masquer chacun des deux formulaires, longueur des extraits d'articles, commentaires sous les articles
  - **Images** : photo du hero, photos des sections, **galerie à 40 emplacements réglables** (place vide = photo non affichée), **photo optionnelle des sections libres « Texte » (position gauche/droite réglable)**, image de partage Open Graph
- **Identité du site** (Réglages de base) : logo, titre, icône, description.
- **Liens des menus & boutons**, grand titre, bandes du haut de page, valeurs, e-mail de contact : rien n'est figé, tout texte et tout lien peut être changé (2 langues).
- **Apparence & Styles** (Personnaliser > ANDONICK — Apparence & Styles) : couleurs, polices, alignements, espacements, positions (hero, galerie, menu fixe), **hauteur du menu, taille des boutons**, **animations au défilement et compteurs (oui/non) + durée du comptage**, **police personnalisée (fichier .woff2 + nom, ils se chargent automatiquement)**, **bouton « Réinitialiser »** — sans code, valeurs par défaut = design officiel.
- **Règle d'or** : un champ laissé vide ne s'affiche jamais (carte, réseaux sociaux, statistiques, liens légaux, sections libres) — le site garde alors son apparence d'origine.
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
- [ ] Créer ses pages légales (Pages → Ajouter) et relier les 3 liens du pied de page (Customizer → Pages légales)
- [ ] Publier des articles (Articles → Ajouter) pour alimenter la section Actualités (invisible tant qu'aucun article n'existe)

## Versions

- **3.5.1** — Section « Les métiers » : **photo par métier** (photos officielles pré-remplies, remplaçables une par une dans Images — elles suivent la position des lignes « Les métiers »), pastille numéro sur la photo, zoom au survol ; cartes sans photo = comme avant (aucune autre section touchée) — 15/15 preuves
- **3.5.0** — Derniers 10 % rendus sans code : **menu principal illimité** (1 ligne = `Libellé|URL`, vide = les 5 liens officiels), **bandeau du haut illimité**, **colonnes du pied de page éditables** (colonnes Filiales/Contact = listes `Libellé|URL`, + **4ᵉ colonne facultative**), **métiers, témoignages et impacts illimités** (1 ligne = `Numéro|Titre|Description|Étiquettes` / `Citation|Nom|Rôle` / `Chiffre|Description`), **galerie à 40 emplacements réglables**, sections libres « Texte » avec **photo + position gauche/droite**, **interrupteurs des formulaires** Devis/Rappel, longueur des extraits d'articles réglable, **commentaires blog activables**, durée du comptage réglable, SEO par article (extrait) — 14/14 preuves, 35 scénarios documentés
- **3.4.0** — Dernière étape du « 100 % sans code » : référencement éditable (meta description + balises Open Graph/Twitter par langue + image de partage), formulaires Devis/Rappel aux champs entièrement modifiables (1 ligne = `Libellé|type|obligatoire|source`, types texte/téléphone/e-mail/zone de texte/liste — sources : vos services ou vos créneaux), **6 sections libres** (3 « texte » + 3 « bannière » avec image de fond, insérables dans l'ordre des sections, invisibles si vides), **police personnalisée du site** (fichier .woff2 + nom, chargée automatiquement, proposée en tête de liste), textes de la page 404, des « précédent/suivant » du blog — le tout sans toucher au code ; règle d'or étendue : 9/9 vérifications de masquage + 23 réglages Customizer + 4 cas d'envoi de formulaires vérifiés
- **3.3.0** — Dernière étape « 100 % sans code » : statistiques illimitées (1 ligne = `Nombre|Libellé`, vide = masquée), réseaux sociaux illimités (1 ligne = `Nom|URL`, vide = aucun lien), carte Google Maps dans le Contact (lien d'intégration + bouton + adresse, vide = masquée), section Actualités alimentée par les articles WordPress (interrupteur on/off + nombre d'articles), pages légales dans le pied de page (3 liens choisis parmi vos pages), la redirection « tout vers l'accueil » remplacée par de vraies pages/articles — plus hauteur du menu, taille des boutons, bouton « Réinitialiser » et interrupteurs d'animations (défilement + compteurs) ; règle d'or : tout champ vide reste invisible (9/9 vérifications ok)
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