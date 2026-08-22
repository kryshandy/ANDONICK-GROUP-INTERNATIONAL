# ANDONICK GROUP INTERNATIONAL — Site WordPress

Site vitrine one-page bilingue (FR/EN) de **ANDONICK Group International** (Bangui · Dakar · Bordeaux), développé en WordPress avec un thème 100 % custom.

> **Charte graphique stricte** : violet `#461491`, violet foncé `#2A0A63`, blanc `#FFFFFF`, gris `#333333`. Aucune autre couleur (jaune, or...) n'est autorisée.

---

## Aperçu

- **Environnement local** : XAMPP (Apache + MySQL + PHP 8.x) — WordPress 7.0
- **Thème** : `andonick` (classique, sans builder obligatoire)
- **Multilingue** : FR (défaut) / EN via `?lang=en` — accueil bilingue, avec locale et balises `hreflang` uniquement là où les deux versions existent réellement
- **Contenu** : 8 métiers (extensible à 12 dès le Customizer), témoignages (6 places), références (illimité), partenaires (illimité), statistiques du haut de page (illimitées), actualités (articles WordPress), réseaux sociaux (illimités), carte Google Maps, formulaires devis/rappel aux champs modifiables, **6 sections libres (3 « texte » + 3 « bannière »)** ajoutables/masquables dans la page, galerie réalisations (12 places)
- **Référencement** : description + Open Graph/Twitter réglés sans code (par langue), image de partage dédiée, textes du blog et de la page 404 modifiables

## Structure du thème

```
wp-content/themes/andonick/
├── style.css              → déclaration du thème + CSS complet (charte)
├── functions.php          → setup, assets, service de langues, demandes de contact
├── header.php             → topbar, menus WordPress FR/EN, bouton FR/EN
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

- **Menus** : créez un menu français et un menu anglais dans **Apparence → Menus**, puis assignez-les aux emplacements « Navigation principale — français » et « — anglais ». Le menu de compatibilité et les liens du Customizer restent disponibles pour les anciennes installations.
- **Panneau « ANDONICK — Contenu du site »** :
  - **Structure & Ordre** : l'ordre d'affichage des 14 sections (une ligne = une section, retirez la ligne pour masquer)
  - **Textes principaux — FR / EN** : tous les textes de la page dans chaque langue (dont carte : lien d'intégration + bouton « Voir sur la carte » ; actualités : titres, sous-titre, nombre d'articles ; **menu et bandeau du haut** : 1 ligne = `Libellé|URL`, vide = affichage officiel automatique)
  - **Les métiers — FR / EN** : **illimités** (1 ligne = `Numéro|Titre|Description|Étiquette1;Étiquette2`)
  - **Témoignages & Références — FR / EN** : **témoignages illimités** (1 ligne = `Citation|Nom|Rôle`), références illimitées (1 ligne = `Catégorie | Organisation | Mission`), en-têtes du tableau
  - **Formulaires & listes — FR / EN** : impacts **illimités** (1 ligne = `Chiffre|Description`), partenaires, liste déroulante des services, créneaux de rappel, **statistiques illimitées** (1 ligne = `Nombre|Libellé`, ex. `15+|ans d'expertise`), **réseaux sociaux illimités** (1 ligne = `Nom|URL`), champs des formulaires Devis/Rappel
  - **Pages légales & Actualités** : 3 liens de pied de page choisis parmi vos pages WordPress (Mentions légales, Politique de confidentialité…), interrupteur d'affichage de la section Actualités (articles du blog)
  - **Formulaires & Blog (réglages communs)** : afficher/masquer chacun des deux formulaires, longueur des extraits d'articles, commentaires sous les articles
  - **Images** : photo du hero, photos des sections, **galerie à 40 emplacements réglables** (place vide = photo non affichée), **photo optionnelle des sections libres « Texte » (position gauche/droite réglable)**, image de partage Open Graph
- **Identité du site** (Réglages de base) : logo, titre, icône, description.
- **Liens des menus & boutons**, grand titre, bandes du haut de page, valeurs, e-mail de contact : rien n'est figé, tout texte et tout lien peut être changé (2 langues).
- **Apparence & Styles** (Personnaliser > ANDONICK — Apparence & Styles) : polices, alignements, espacements, positions (hero, galerie, menu fixe), **hauteur du menu, taille des boutons**, **animations au défilement et compteurs (oui/non) + durée du comptage**, **police personnalisée (fichier .woff2 + nom, ils se chargent automatiquement)**, **bouton « Réinitialiser »** — sans code. La palette est verrouillée pour protéger la charte officielle.
- **Règle d'or** : une valeur enregistrée vide est un choix éditorial ; elle ne sera pas réinsérée automatiquement. Les listes, cartes, réseaux sociaux, statistiques, liens légaux et sections libres vides sont masqués.
- Chaque modification est **prévisualisée en direct** ; « Publier » applique au site.
- Les fichiers ne sont jamais à modifier : tout part de `inc/content.php` (valeurs par défaut, source officielle) et du Customizer (ce que le client voit et change).

**Règles** : ne jamais modifier les couleurs, ni le logo (fichier officiel, à conserver intact), ni ajouter de couleur hors charte.

## Service de langues (sans plugin)

L'approche `?lang=en` est recommandée pour un site vitrine structuré (zéro requête DB, pas de plugin lourd). Pour être complet et SEO-correct :
- `switch_to_locale('en_US')` → les éléments WordPress affichés côté visiteur suivent l’anglais
- `<html lang="en-US">` (fr-FR par défaut)
- Titre de l'onglet et métadonnées adaptés au contenu réellement consulté
- `hreflang` réciproques fr/en + `x-default` pour l’accueil ; les pages et articles ne déclarent pas une fausse traduction
- `body class="lang-en"` / `lang-fr`
- Les textes du thème sont traduits. Les articles et pages WordPress doivent être rédigés dans les deux langues avant d’être reliés par une solution multilingue dédiée.

## Demandes et e-mails

Chaque formulaire validé est enregistré dans **Demandes** dans l’administration WordPress avant l’envoi de l’e-mail. Ainsi, une panne SMTP ne fait pas perdre le prospect : le statut « enregistrée » est affiché au visiteur. Configurez tout de même un SMTP transactionnel avant la mise en ligne.

## Workflow Git recommandé

Le dépôt Git se trouve à la racine de ce thème. Travaillez sur une branche par évolution, vérifiez PHP/JavaScript, créez un commit lisible puis ouvrez une pull request vers `main`. Les réglages, pages, médias et menus WordPress vivent dans la base de données : exportez-les avec une sauvegarde de production, ils ne doivent pas être committés comme du code. Pour transmettre le thème, lancez `scripts/build-release.ps1` : son ZIP exclut volontairement Git, les documents internes, les sources et les scripts de développement. Apache bloque aussi `.git` et `docs` lorsque le thème est servi localement.

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

- **3.9.0** — **Livraison opérationnelle** : positionnement recentré sur un partenaire unique de l’étude à la maintenance ; hero sobre avec preuves partenaires et parcours de prise en charge éditables ; palette officielle verrouillée ; menus WordPress distincts FR/EN ; demandes de formulaire validées et conservées dans l’administration avant e-mail ; SEO par page corrigé (titre, canonical unique, Open Graph), navigation/accessibilité mobile, onglets et lightbox durcis. Les mises à jour du thème ne suppriment plus jamais de contenu WordPress.
- **3.8.0** — **Harmonie et équilibre responsive sur tous les écrans** : grilles de cartes (métiers, témoignages, impacts) qui passent proprement de 3 → 2 → 1 colonnes (tablette et mobile), ancres qui ne sont plus cachées sous le menu fixe (`scroll-margin-top`), boutons WhatsApp du contact empilés pleine largeur sur mobile, échelles typographiques fluides, rythme d&#8217;espacement homogène. Vérifié à 1400/1024/768/480/380 px : aucune colonne écrasée, aucun débordement horizontal, boutons 448 px pleine largeur au mobile
- **3.7.0** — **Actualités proprement bilingues et « vraies »** : le contenu de démonstration WordPress (article « Bonjour tout le monde ! », page d&#8217;exemple et son commentaire) est automatiquement supprimé à l&#8217;installation/à la mise à jour du thème — la section n&#8217;apparaît donc plus à cause d&#8217;un article vide ; nouvelle : **« Actualités — catégorie des articles français / anglais »** (Pages légales &amp; Actualités) : la section ne montre que les articles de la langue visitée et se masque quand la catégorie est vide. Vérifié : EN vide → section masquée, FR intacte
- **3.6.0** — **RGPD + personnalisation augmentée, tout sans code** : bandeau cookies (textes FR/EN éditables, choix mémorisé sur l&#8217;appareil, activable/masquable) ; interrupteurs individuels par section (8 cases à cocher dans « Structure & Ordre ») ; fonds de section Clair/Teinté/Violet foncé + nombre de colonnes des cartes métiers et témoignages (1 à 4) ; **lightbox galerie** (clic → plein écran, ‹ › et ← →, Échap) ; copie de la demande envoyée au visiteur par e-mail (réglable). Testé navigateur : bandeau disparaît après choix, compteur lightbox 2/6 après flèche, sections masquées puis restaurées
- **3.5.7** — **Cartes de témoignages vides supprimées** : si un emplacement témoignage (ou impact) n&#8217;a pas de citation, la carte ne s&#8217;affiche plus ; l&#8217;en-tête « Témoignages » disparaît quand la liste est vide. Objectif : ne montrer que ce qui est rempli dans Personnaliser (site 100 % personnalisable sans code)
- **3.5.6** — Retour aux **deux boutons WhatsApp initiaux** de la section Contact (RCA + France) : le bouton vert d&#8217;en-tête (ajouté en 3.5.5, puis retiré à la demande) est démonté. Preuve navigateur : clic → `defaultPrevented=false` (aucune interception), `target="_blank"` → nouvel onglet `api.whatsapp.com/send/?phone=…` qui fonctionne sur PC et mobile
- **3.5.5** — (ajout puis retiré en 3.5.6) Bouton « 💬 WhatsApp » vert dans l&#8217;en-tête
- **3.5.4** — Ancres internes corrigées : sur une page d&#8217;article de blog (où les sections n&#8217;existent pas), cliquer « Demander un devis » / menu « Filiales »… **redirige vers l&#8217;accueil avec l&#8217;ancre** (la langue est conservée), comme le site officiel — vérifié dans un vrai navigateur (accueil : défiler sur place ; article : redirection)
- **3.5.3** — Durcissement : **tout champ texte vidé revient automatiquement à la valeur officielle** (ex. si vous videz un numéro de téléphone, le site réaffiche celui d'origine au lieu de casser les liens WhatsApp/tel:) — ceinture + bretelles, site vérifié en base
- **3.5.2** — Bandeau supérieur : les liens WhatsApp par défaut pointent maintenant vers **leurs bon numéros** (RCA 75 00 06 49 / France +33 6 05 56 43 73, comme le site officiel) — tout reste modifiable via « Bandeau du haut — liens »
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
