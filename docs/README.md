# ANDONICK Group International — Documentation projet

Documentation et fichiers sources fournis par le client (Google Drive) et extraits du site officiel.

## Documentation de livraison

| Fichier | Usage |
|---|---|
| `GUIDE-PROPRIETAIRE.pdf` | Administration no-code, bonnes pratiques éditoriales et formation du propriétaire |
| `INSTALLATION-DEPLOIEMENT.md` | Construction des ZIP, installation, migration, recette et retour arrière |
| `PRODUCTION-CHECKLIST.md` | Décision GO/NO-GO avant ouverture publique |
| `PLAN-SUITE.md` | Priorités P0 à P3 après livraison |
| `RELEASE-NOTES-4.0.0.md` | Synthèse de la version livrée |

## Fichiers client (Drive)

| Fichier | Usage |
|---|---|
| `Note_Webmaster.pdf` | Instruction officielle de la CEO Adjointe (Astrid NAMSENEY) : charte stricte, logo à conserver intact |
| `Charte_Couleurs.pptx` | Palette officielle (HEX/RGB/CMYK) + logo officiel haute résolution |

## Fichiers sources (site officiel)

`Site_FR-EN.html` et `Site_EN.html` : ancien site une-page bilingue conservé comme source historique. Il ne constitue pas à lui seul une preuve d’exactitude : les affirmations sensibles, témoignages et coordonnées de tiers ont été écartés ou recoupés avec les documents client plus récents.

## Médias extraits

16 images extraites du site officiel : logo (PNG) et photos (JPG) — équipe, chantiers, impact. La version haute résolution du logo est utilisée dans `../assets/img/logo.png`.

## Notes de production

- L'envoi des formulaires (devis/rappel) passe par `wp_mail()` et exige un SMTP authentifié correctement configuré en production.
- ANDONICK Core gère : nonces distincts, honeypot, temps minimal, limitation de débit, validation serveur, consentement, enregistrement privé dans **Demandes**, rétention, export/effacement et redirection sécurisée.
- Pour tout changement visuel : respecter impérativement la charte (4 couleurs, logo intact).
- Les menus, pages, articles, médias et réglages restent des données WordPress. Le dépôt Git versionne le thème ; la sauvegarde WordPress versionne les données de production.
