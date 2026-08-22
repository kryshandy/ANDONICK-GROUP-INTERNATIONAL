# Installation et déploiement

Ce document décrit une livraison reproductible du thème ANDONICK 4.0.0 et de l’extension ANDONICK Core 1.0.0. Il ne remplace pas la sauvegarde complète de WordPress, car les pages, menus, médias et réglages no-code vivent dans la base de données.

## 1. Prérequis

- WordPress 6.0 ou supérieur ;
- PHP 7.4 ou supérieur, avec HTTPS en production ;
- MySQL/MariaDB pris en charge par la version de WordPress choisie ;
- accès administrateur WordPress, SFTP/SSH et base de données ;
- SMTP authentifié et accès DNS pour SPF, DKIM et DMARC ;
- sauvegarde restaurable des fichiers et de la base avant toute intervention.

## 2. Construire les archives

Depuis la racine du dépôt :

```powershell
powershell -ExecutionPolicy Bypass -File scripts/build-release.ps1
```

Le dossier local ignoré `release/` contient alors :

- `andonick-theme.zip` ;
- `andonick-core.zip`.

Le ZIP du thème exclut le dépôt Git, les documents client, le plugin compagnon et les outils de développement. Le ZIP du plugin ne contient que l’extension métier.

## 3. Installer sur un WordPress neuf

1. Installer WordPress et créer un compte administrateur nominatif.
2. Dans **Extensions → Ajouter une extension → Téléverser**, installer puis activer `andonick-core.zip`.
3. Dans **Apparence → Thèmes → Ajouter un thème → Téléverser**, installer puis activer `andonick-theme.zip`.
4. Facultatif : placer le dépôt dans `wp-content/themes/andonick/`, puis exécuter depuis la racine WordPress :

```powershell
php wp-content/themes/andonick/scripts/andonick-site-setup.php
```

Le script est rejouable : il met à jour les pages prévues sans dupliquer leurs slugs. La page « Mentions légales » reste volontairement en brouillon.

5. Dans **Réglages → Lecture**, vérifier que « Accueil » est la page d’accueil statique.
6. Enregistrer une fois **Réglages → Permaliens**.
7. Configurer les menus FR/EN et relire chaque panneau du Customizer avant publication.

## 4. Migrer l’instance validée

La méthode recommandée consiste à migrer ensemble fichiers, base et médias depuis un staging validé.

1. Geler les modifications éditoriales pendant la fenêtre de migration.
2. Sauvegarder et tester la restauration du staging.
3. Copier la base et `wp-content/uploads/` avec le thème et l’extension.
4. Remplacer les URL de l’ancien domaine par celles du domaine final avec un outil WordPress compatible avec les données sérialisées ; ne jamais faire un remplacement SQL brut.
5. Renseigner les clés/salts et secrets directement dans l’environnement d’hébergement, jamais dans Git.
6. Activer HTTPS et la redirection permanente vers l’URL canonique.
7. Purger les caches, réenregistrer les permaliens et contrôler le sitemap.

Exemple de constantes de production à adapter dans `wp-config.php` sans committer ce fichier :

```php
define( 'WP_ENVIRONMENT_TYPE', 'production' );
define( 'WP_DEBUG', false );
define( 'DISALLOW_FILE_EDIT', true );
```

## 5. Configuration fonctionnelle obligatoire

- Compléter puis faire valider : forme juridique, capital, RCCM/immatriculation, NIF, directeur de publication et identité complète de l’hébergeur.
- Publier la page « Mentions légales » seulement après cette validation.
- Configurer le SMTP ; tester un devis et une demande de rappel vers une boîte réelle, puis vérifier réception et réponse.
- Déclarer SPF, DKIM et DMARC sur le domaine d’envoi.
- Remplacer les éventuels contenus, images ou coordonnées provisoires.
- Contrôler les utilisateurs, supprimer les comptes inutiles et activer la double authentification.
- Configurer sauvegardes automatiques, supervision de disponibilité et mises à jour encadrées.

## 6. Recette après déploiement

Depuis une machine disposant de PHP, Node.js et PowerShell :

```powershell
powershell -ExecutionPolicy Bypass -File scripts/qa/verify-site.ps1 -BaseUrl "https://www.exemple.com" -BuildRelease
```

Compléter avec une vérification réelle sur mobile et ordinateur : menu, changement de langue, clavier, formulaires, e-mails, pages légales, liens téléphone/WhatsApp, image de partage et absence de débordement horizontal.

La mise en ligne est acceptée uniquement lorsque toutes les lignes de `PRODUCTION-CHECKLIST.md` sont cochées et qu’aucun échec de recette n’est ouvert.

## 7. Retour arrière

1. Mettre le site en maintenance contrôlée si l’incident affecte les visiteurs ou les données.
2. Restaurer simultanément la base et les fichiers issus de la même sauvegarde.
3. Vérifier l’URL du site, les permaliens, la connexion admin et une soumission de formulaire.
4. Purger les caches/CDN.
5. Documenter la cause avant une nouvelle tentative.

Ne jamais rétrograder uniquement la base ou uniquement les fichiers si une migration les a modifiés ensemble.
