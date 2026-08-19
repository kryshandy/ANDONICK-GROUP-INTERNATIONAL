# ANDONICK Group International — Documentation projet

Documentation et fichiers sources fournis par le client (Google Drive) et extraits du site officiel.

## Fichiers client (Drive)

| Fichier | Usage |
|---|---|
| `Note_Webmaster.pdf` | Instruction officielle de la CEO Adjointe (Astrid NAMSENEY) : charte stricte, logo à conserver intact |
| `Charte_Couleurs.pptx` | Palette officielle (HEX/RGB/CMYK) + logo officiel haute résolution |

## Fichiers sources (site officiel)

`Site_FR-EN.html` et `Site_EN.html` : ancien site une-page bilingue de référence. Toute la rédaction du nouveau thème WordPress en a été extraite (témoignages, références, métiers, formulaires, contacts) — garantie d'exactitude.

## Médias extraits

16 images extraites du site officiel : logo (PNG) et photos (JPG) — équipe, chantiers, impact. La version haute résolution du logo est utilisée dans `../assets/img/logo.png`.

## Notes de production

- L'envoi des formulaires (devis/rappel) passe par `wp_mail()` — nécessite un plugin SMTP (ex. WP Mail SMTP) en production.
- Le formulaire inclut : nonce WordPress, honeypot anti-spam, validation serveur, redirection sécurisée.
- Pour tout changement visuel : respecter impérativement la charte (4 couleurs, logo intact).