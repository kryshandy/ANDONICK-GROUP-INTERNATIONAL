# Plan pour la suite

Le code livré est prêt pour une recette de préproduction. Le passage public reste conditionné aux informations juridiques, au domaine, à la messagerie et à l’exploitation. Les priorités ci-dessous évitent d’ajouter des fonctionnalités avant de sécuriser le lancement.

## P0 — Avant mise en ligne

| Action | Responsable suggéré | Critère de fin |
|---|---|---|
| Fournir et valider les informations légales manquantes | Direction + conseil local | Mentions légales complètes, approuvées et publiées |
| Choisir domaine/hébergement et créer le staging final | Direction + hébergeur | HTTPS, PHP/MySQL compatibles, accès remis à l’exploitant |
| Configurer SMTP, SPF, DKIM et DMARC | Hébergeur / administrateur DNS | Devis et rappel reçus, sans classement spam anormal |
| Migrer contenus, médias, menus et réglages | Intégrateur WordPress | Staging identique à la version validée, URLs finales propres |
| Mettre en place sauvegardes et 2FA | Exploitant | Restauration testée et comptes sécurisés |
| Effectuer la recette finale | Product designer + client | Checklist production signée, zéro blocant |

## P1 — Semaine de lancement

- Surveiller chaque jour disponibilité, erreurs serveur et délivrabilité des formulaires.
- Vérifier Search Console/Bing Webmaster Tools après soumission du sitemap.
- Contrôler les demandes dans **Demandes** même si aucun e-mail n’est reçu.
- Corriger uniquement les anomalies bloquantes ; conserver une fenêtre de rollback.
- Mesurer les temps de réponse sur réseau mobile réel et optimiser les images ajoutées par le client.

## P2 — 30 premiers jours

- Organiser une session propriétaire de 90 minutes à partir du `GUIDE-PROPRIETAIRE.pdf`.
- Nommer un responsable éditorial et appliquer un cycle brouillon → relecture → publication.
- Publier 2 à 4 actualités utiles et factuelles ; éviter les affirmations non documentées.
- Examiner les requêtes reçues : services demandés, provenance et taux de réponse, sans installer de traceur par défaut.
- Réaliser un audit accessibilité manuel sur les contenus réellement publiés.
- Mettre à jour politique de confidentialité/cookies avant tout ajout d’analytics, vidéo ou widget tiers.

## P3 — Trimestriel

- Tester restauration, formulaires, liens critiques, mobile, certificats et comptes administrateurs.
- Mettre à jour WordPress, PHP, thème et extension d’abord sur staging.
- Réviser les projets/preuves, références et statistiques ; retirer toute donnée devenue inexacte.
- Contrôler la durée de conservation des demandes et traiter les demandes d’accès/effacement.
- Examiner Core Web Vitals et accessibilité après chaque changement visuel important.

## Évolutions optionnelles après stabilisation

1. Traduction éditoriale avec workflow dédié si le volume de pages/articles augmente.
2. Formulaire connecté à un CRM uniquement après cadrage des droits, de la rétention et des responsabilités.
3. Mesure d’audience respectueuse de la vie privée, avec consentement si juridiquement requis.
4. Bibliothèque de blocs ou patterns WordPress si l’équipe publie régulièrement des pages supplémentaires.

Chaque évolution doit préserver trois invariants : édition sans code, charte verrouillée et séparation entre données métier et présentation.
