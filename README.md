# ANDONICK GROUP INTERNATIONAL — Site WordPress

Site vitrine one-page bilingue (FR/EN) de **ANDONICK Group International** (Bangui · Dakar · Bordeaux), développé en WordPress avec un thème 100 % custom.

> **Charte graphique stricte** : violet `#461491`, violet foncé `#2A0A63`, blanc `#FFFFFF`, gris `#333333`. Aucune autre couleur (jaune, or...) n'est autorisée.

---

## Aperçu

- **Environnement local** : XAMPP (Apache + MySQL + PHP 8.x) — WordPress 7.0
- **Thème** : `andonick` (classique, sans builder, zéro plugin additionnel)
- **Multilingue** : FR (défaut) / EN via `?lang=en`
- **Contenu** : 8 métiers (filiales), témoignages, références, partenaires, formulaires devis/rappel, galerie réalisations

## Structure du thème

```
wp-content/themes/andonick/
├── style.css              → déclaration du thème + CSS complet (charte)
├── functions.php          → setup, assets, favicon, envoi des formulaires
├── header.php             → topbar, navigation, toggle FR/EN
├── footer.php             → footer, WhatsApp flottant, retour en haut
├── front-page.php         → one-page complète (8 sections)
├── index.php              → repli (redirige vers l'accueil)
├── inc/
│   └── content.php        → TOUT le contenu bilingue (textes des pages)
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

## Modifier les textes du site

Tous les textes FR/EN sont regroupés dans **`inc/content.php`** (tableaux bilingues) :
- `fr` → textes français, `en` → textes anglais.
- Les clés sont appelées dans les templates via `andonick_t( 'cle' )`.
- Images : remplacer les fichiers dans `assets/img/` (mêmes noms).

**Règles** : ne jamais modifier les couleurs, ni le logo (fichier officiel, à conserver intact), ni ajouter de couleur hors charte.

## Mise en production — checklist

- [ ] Hébergement PHP 8+ avec MySQL/MariaDB
- [ ] Passer `WP_DEBUG` à `false` dans `wp-config.php`
- [ ] Installer **WP Mail SMTP** (l'envoi local des formulaires ne fonctionne pas sans)
- [ ] Certificat SSL (Let's Encrypt) + redirection HTTPS
- [ ] CDN Cloudflare (perfs + protection)
- [ ] Sauvegardes régulières (UpdraftPlus)
- [ ] Remplacer les URL locales (`http://localhost/wordpress`) par le domaine

## Versions

- **2.0.0** — Refonte design premium : animations au scroll, compteurs animés, scrollspy, barre de progression, WhatsApp flottant, galerie réalisations, responsiveness profond (320–1440px)
- **1.0.0** — Création du thème one-page bilingue conforme à la charte

© 2026 ANDONICK Group International. Tous droits réservés.