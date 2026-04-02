/* GestiLoc Docs — Traductions françaises */
window.I18N_FR = {
  "nav": {
    "home": "Accueil",
    "ug_start": "Premiers pas",
    "ug_dashboard": "Tableau de bord",
    "ug_properties": "Mes biens",
    "ug_tenants": "Mes locataires",
    "ug_contracts": "Mes contrats",
    "ug_payments": "Paiements",
    "ug_documents": "Documents",
    "ug_maintenance": "Maintenance",
    "fn_overview": "Aperçu métier",
    "fn_user_stories": "User Stories",
    "fn_modules": "Modules",
    "fn_properties": "Propriétés",
    "fn_tenants": "Locataires",
    "fn_contracts": "Contrats",
    "fn_payments": "Paiements",
    "fn_documents": "Documents",
    "fn_maintenance": "Maintenance",
    "tc_architecture": "Architecture",
    "tc_database": "Base de données",
    "tc_installation": "Installation",
    "tc_blade": "Composants Blade",
    "tc_poc": "POC vs Dynamic",
    "ug": "Guide utilisateur",
    "fn": "Fonctionnel",
    "tc": "Technique"
  },
  "ui": {
    "breadcrumb_docs": "Docs",
    "lang_toggle": "EN",
    "open_menu": "Ouvrir le menu"
  },
  "index": {
    "h1": "GestiLoc — Documentation",
    "subtitle": "Documentation technique et fonctionnelle du projet de gestion locative.",
    "h2": [
      "Structure du projet",
      "Guide utilisateur",
      "Documentation fonctionnelle",
      "Documentation technique"
    ],
    "h3": [
      "Modules"
    ],
    "th": [
      "Dossier",
      "Description"
    ],
    "td": [
      "<code>poc/</code>",
      "Prototype statique HTML/CSS/JS (maquette fonctionnelle)",
      "<code>projet-dynamic/</code>",
      "Application Laravel dynamique",
      "<code>docs/</code>",
      "Documentation technique et fonctionnelle"
    ],
    "card_label": [
      "Guide utilisateur",
      "Guide utilisateur",
      "Guide utilisateur",
      "Guide utilisateur",
      "Guide utilisateur",
      "Guide utilisateur",
      "Guide utilisateur",
      "Guide utilisateur",
      "Fonctionnel",
      "Fonctionnel",
      "Module",
      "Module",
      "Module",
      "Module",
      "Module",
      "Module",
      "Technique",
      "Technique",
      "Technique",
      "Technique",
      "Technique"
    ],
    "card_title": [
      "Premiers pas",
      "Tableau de bord",
      "Mes biens",
      "Mes locataires",
      "Mes contrats",
      "Paiements",
      "Documents",
      "Maintenance",
      "Aperçu métier",
      "User Stories",
      "Propriétés",
      "Locataires",
      "Contrats",
      "Paiements",
      "Documents",
      "Maintenance",
      "Architecture",
      "Base de données",
      "Installation",
      "Composants Blade",
      "POC vs Dynamic"
    ],
    "card_desc": [
      "Créer un compte, se connecter, modifier son profil.",
      "Comprendre les indicateurs et les alertes automatiques.",
      "Ajouter, modifier et gérer votre parc immobilier.",
      "Gérer vos locataires et suivre leur statut de paiement.",
      "Créer des baux, gérer les échéances et archiver.",
      "Enregistrer les loyers et marquer les paiements reçus.",
      "Uploader et retrouver vos fichiers (baux, diagnostics, assurances…).",
      "Planifier et suivre vos interventions et travaux.",
      "Présentation de GestiLoc, modules disponibles et rôles utilisateurs.",
      "Cas d'usage par module, basés sur les routes et controllers Laravel.",
      "Gestion du parc immobilier, types, statuts et références auto-générées.",
      "Gestion des locataires, statuts de paiement et recherche.",
      "Baux de location, archivage et alertes d'expiration.",
      "Suivi des loyers mensuels et marquage comme payé.",
      "Upload et gestion des fichiers liés aux biens.",
      "Suivi des interventions, priorités, coûts et avancement.",
      "Stack, structure des dossiers et flux d'authentification.",
      "Schéma des 6 tables métier et relations Eloquent.",
      "Setup Laravel pas à pas : clone, .env, migrate, serve.",
      "Liste et description des 26 composants réutilisables.",
      "Différences entre le prototype statique et l'application Laravel."
    ]
  },
  "utilisateur_demarrage": {
    "h1": "Premiers pas",
    "subtitle": "Créer votre compte, vous connecter et configurer votre profil.",
    "h2": [
      "Créer un compte",
      "Se connecter",
      "Se déconnecter",
      "Modifier votre profil",
      "Supprimer votre compte",
      "Étape suivante"
    ],
    "p": [
      "Si vous n'avez pas encore de compte, rendez-vous sur la page d'inscription accessible depuis la page de connexion.",
      "Si vous avez oublié votre mot de passe, utilisez le lien <strong>Mot de passe oublié ?</strong> présent sur la page de connexion.",
      "Cliquez sur votre nom en haut à droite de la navigation, puis sur <strong>Se déconnecter</strong>.",
      "Pour changer votre nom, votre adresse email ou votre mot de passe :",
      "Cette option se trouve en bas de la page <strong>Profil</strong>, dans la section <em>Supprimer le compte</em>. Une confirmation par mot de passe est requise.",
      "Une fois connecté, commencez par ajouter vos biens immobiliers. Consultez la section <a href=\"proprietes.html\">Mes biens</a> pour savoir comment procéder."
    ],
    "ol": [
      "<li>Cliquez sur <strong>S'inscrire</strong> depuis la page de connexion.</li><li>Renseignez votre nom, votre adresse email et un mot de passe.</li><li>Cliquez sur <strong>S'inscrire</strong> pour valider.</li><li>Vous êtes automatiquement connecté et redirigé vers le tableau de bord.</li>",
      "<li>Accédez à l'application dans votre navigateur.</li><li>Saisissez votre adresse email et votre mot de passe.</li><li>Cliquez sur <strong>Se connecter</strong>.</li>",
      "<li>Cliquez sur votre nom en haut à droite.</li><li>Sélectionnez <strong>Profil</strong>.</li><li>Modifiez les informations souhaitées.</li><li>Cliquez sur <strong>Enregistrer</strong>.</li>"
    ],
    "callout": [
      "Chaque compte est indépendant : vos biens, locataires et données ne sont visibles que par vous. Plusieurs bailleurs peuvent utiliser la même application sans se voir.",
      "La suppression de votre compte est définitive. Toutes vos données (biens, locataires, contrats, paiements, documents, maintenances) seront effacées sans possibilité de récupération."
    ]
  },
  "utilisateur_tableau_de_bord": {
    "h1": "Tableau de bord",
    "subtitle": "Vue d'ensemble de votre patrimoine locatif en un coup d'œil.",
    "h2": [
      "Ce que vous voyez",
      "Les cartes de statistiques",
      "Les alertes",
      "Navigation rapide"
    ],
    "p": [
      "Le tableau de bord est la première page que vous voyez après la connexion. Il résume l'état de votre parc locatif à la date du jour.",
      "En haut du tableau de bord, quatre indicateurs clés s'affichent :",
      "Le tableau de bord signale automatiquement les situations nécessitant votre attention :",
      "Depuis le tableau de bord, vous pouvez accéder directement à chaque module via le menu latéral ou les liens dans les cartes d'alertes."
    ],
    "ul": [
      "<li><strong>Contrats expirant bientôt</strong> — contrats dont la date de fin est dans les 30 jours.</li><li><strong>Paiements en retard</strong> — loyers dont le statut est « en retard ».</li><li><strong>Interventions urgentes</strong> — travaux de maintenance à priorité haute non encore terminés.</li>"
    ],
    "callout": [
      "Consultez le tableau de bord chaque début de mois pour identifier rapidement les loyers non encaissés et planifier vos relances."
    ],
    "th": [
      "Indicateur",
      "Ce qu'il mesure"
    ],
    "td": [
      "<strong>Biens</strong>",
      "Nombre total de biens enregistrés, avec le nombre de biens occupés et vacants.",
      "<strong>Locataires</strong>",
      "Nombre total de locataires actifs.",
      "<strong>Loyers du mois</strong>",
      "Montant total attendu pour le mois en cours, et part déjà encaissée.",
      "<strong>Paiements en retard</strong>",
      "Nombre de loyers non réglés dont l'échéance est dépassée."
    ]
  },
  "utilisateur_proprietes": {
    "h1": "Mes biens",
    "subtitle": "Ajouter, consulter et gérer vos biens immobiliers.",
    "h2": [
      "Ajouter un bien",
      "Consulter la liste de vos biens",
      "Modifier un bien",
      "Supprimer un bien",
      "Statut d'un bien",
      "Étape suivante"
    ],
    "p": [
      "La page <strong>Propriétés</strong> affiche l'ensemble de vos biens avec pour chacun : sa référence, son adresse, son type, son loyer mensuel et son statut (occupé / vacant).",
      "Le statut est mis à jour automatiquement selon les contrats actifs associés au bien.",
      "Une fois vos biens enregistrés, ajoutez vos locataires. Consultez la section <a href=\"locataires.html\">Mes locataires</a>."
    ],
    "ol": [
      "<li>Cliquez sur <strong>Propriétés</strong> dans le menu latéral.</li><li>Cliquez sur le bouton <strong>Ajouter un bien</strong>.</li><li>Remplissez le formulaire :</li>",
      "<li>Cliquez sur <strong>Enregistrer</strong>.</li>",
      "<li>Dans la liste des biens, cliquez sur le bouton <strong>Modifier</strong> du bien souhaité.</li><li>Mettez à jour les informations.</li><li>Cliquez sur <strong>Enregistrer</strong>.</li>",
      "<li>Dans la liste des biens, cliquez sur <strong>Supprimer</strong>.</li><li>Confirmez la suppression dans la fenêtre qui s'affiche.</li>"
    ],
    "ul": [
      "<li><strong>Occupé</strong> — un locataire est en cours de location.</li><li><strong>Vacant</strong> — le bien est disponible à la location.</li>"
    ],
    "callout": [
      "Une référence unique est attribuée automatiquement à chaque bien (ex : <strong>PROP-001</strong>). Vous n'avez pas à la saisir manuellement.",
      "La suppression d'un bien entraîne la suppression de toutes ses données associées : locataires rattachés, contrats, paiements, documents et interventions de maintenance. Cette action est irréversible."
    ],
    "th": [
      "Champ",
      "Description",
      "Obligatoire"
    ],
    "td": [
      "<strong>Nom</strong>",
      "Libellé du bien (ex : « Appartement Paris 11e »)",
      "Oui",
      "<strong>Type</strong>",
      "Appartement, maison, studio, commercial ou autre",
      "Oui",
      "<strong>Adresse</strong>",
      "Adresse complète du bien",
      "Oui",
      "<strong>Ville</strong>",
      "Ville",
      "Oui",
      "<strong>Code postal</strong>",
      "Code postal",
      "Non",
      "<strong>Surface</strong>",
      "Surface en m²",
      "Non",
      "<strong>Loyer mensuel</strong>",
      "Montant du loyer hors charges",
      "Oui",
      "<strong>Charges</strong>",
      "Montant des charges mensuelles",
      "Non (défaut : 0)",
      "<strong>Dépôt de garantie</strong>",
      "Montant du dépôt de garantie",
      "Non (défaut : 0)",
      "<strong>Description</strong>",
      "Notes libres sur le bien",
      "Non"
    ]
  },
  "utilisateur_locataires": {
    "h1": "Mes locataires",
    "subtitle": "Ajouter et gérer vos locataires, suivre leur statut de paiement.",
    "h2": [
      "Ajouter un locataire",
      "Comprendre les statuts de paiement",
      "Rechercher un locataire",
      "Modifier un locataire",
      "Supprimer un locataire",
      "Étape suivante"
    ],
    "p": [
      "La barre de recherche en haut de la liste permet de filtrer les locataires par prénom, nom ou adresse email. La recherche s'effectue en temps réel.",
      "Après avoir ajouté vos locataires, créez les contrats de bail. Consultez la section <a href=\"contrats.html\">Mes contrats</a>.",
      "Le statut de paiement d'un locataire se met à jour via le module <a href=\"paiements.html\">Paiements</a> lorsque vous marquez un loyer comme payé."
    ],
    "ol": [
      "<li>Cliquez sur <strong>Locataires</strong> dans le menu latéral.</li><li>Cliquez sur <strong>Ajouter un locataire</strong>.</li><li>Remplissez le formulaire :</li>",
      "<li>Cliquez sur <strong>Enregistrer</strong>.</li>",
      "<li>Dans la liste, cliquez sur <strong>Modifier</strong> à côté du locataire.</li><li>Mettez à jour les informations.</li><li>Cliquez sur <strong>Enregistrer</strong>.</li>",
      "<li>Cliquez sur <strong>Supprimer</strong> dans la liste.</li><li>Confirmez la suppression.</li>"
    ],
    "callout": [
      "La suppression d'un locataire supprime également tous ses paiements et contrats associés."
    ],
    "th": [
      "Champ",
      "Description",
      "Obligatoire"
    ],
    "td": [
      "<strong>Prénom</strong>",
      "Prénom du locataire",
      "Oui",
      "<strong>Nom</strong>",
      "Nom de famille",
      "Oui",
      "<strong>Email</strong>",
      "Adresse email de contact",
      "Non",
      "<strong>Téléphone</strong>",
      "Numéro de téléphone",
      "Non",
      "<strong>Bien associé</strong>",
      "Bien occupé par ce locataire",
      "Non",
      "<strong>Loyer mensuel</strong>",
      "Montant du loyer de ce locataire",
      "Non",
      "<strong>Date de début de bail</strong>",
      "Date d'entrée dans le logement",
      "Non",
      "<strong>Payé</strong>",
      "Le loyer du mois en cours a été encaissé.",
      "<strong>En attente</strong>",
      "Le paiement n'a pas encore été reçu pour ce mois.",
      "<strong>En retard</strong>",
      "Le paiement est dû mais n'a pas été encaissé après l'échéance."
    ]
  },
  "utilisateur_contrats": {
    "h1": "Mes contrats",
    "subtitle": "Créer et gérer vos baux de location, archiver les contrats terminés.",
    "h2": [
      "Créer un contrat",
      "Statuts d'un contrat",
      "Archiver un contrat",
      "Alerte d'expiration",
      "Modifier ou supprimer un contrat"
    ],
    "p": [
      "Avant de créer un contrat, assurez-vous d'avoir ajouté le bien et le locataire concernés.",
      "GestiLoc vous alerte automatiquement sur le tableau de bord lorsqu'un contrat arrive à échéance dans moins de <strong>30 jours</strong>. Pensez à renouveler ou archiver ces contrats en temps voulu.",
      "Les contrats archivés restent accessibles via le filtre <strong>Archivés</strong> en haut de la liste des contrats."
    ],
    "ol": [
      "<li>Cliquez sur <strong>Contrats</strong> dans le menu latéral.</li><li>Cliquez sur <strong>Nouveau contrat</strong>.</li><li>Remplissez le formulaire :</li>",
      "<li>Cliquez sur <strong>Enregistrer</strong>.</li>",
      "<li>Depuis la liste des contrats, cliquez sur <strong>Archiver</strong> sur le contrat concerné.</li><li>Le contrat passe en statut <strong>Archivé</strong> et n'apparaît plus dans la liste principale.</li>"
    ],
    "ul": [
      "<li><strong>Modifier</strong> — cliquez sur le bouton <strong>Modifier</strong> dans la liste pour corriger les informations d'un contrat actif.</li><li><strong>Supprimer</strong> — supprime définitivement le contrat. Préférez l'archivage pour conserver l'historique.</li>"
    ],
    "th": [
      "Champ",
      "Description",
      "Obligatoire",
      "Statut",
      "Signification"
    ],
    "td": [
      "<strong>Locataire</strong>",
      "Locataire concerné par ce bail",
      "Oui",
      "<strong>Bien</strong>",
      "Bien faisant l'objet du bail",
      "Oui",
      "<strong>Type de bail</strong>",
      "Vide, meublé ou commercial",
      "Oui",
      "<strong>Date de début</strong>",
      "Date d'entrée dans les lieux",
      "Oui",
      "<strong>Date de fin</strong>",
      "Date d'échéance du bail (laisser vide pour un bail à durée indéterminée)",
      "Non",
      "<strong>Loyer mensuel</strong>",
      "Montant du loyer hors charges",
      "Oui",
      "<strong>Charges</strong>",
      "Charges mensuelles",
      "Non",
      "<strong>Dépôt de garantie</strong>",
      "Montant du dépôt de garantie versé",
      "Non",
      "<strong>Actif</strong>",
      "Le bail est en cours. Le locataire occupe le bien.",
      "<strong>Expiré</strong>",
      "La date de fin est dépassée mais le contrat n'a pas été archivé.",
      "<strong>Archivé</strong>",
      "Le bail est terminé et classé dans les archives."
    ]
  },
  "utilisateur_paiements": {
    "h1": "Paiements",
    "subtitle": "Enregistrer les loyers mensuels et suivre leur encaissement.",
    "h2": [
      "Enregistrer un paiement",
      "Marquer un paiement comme payé",
      "Statuts des paiements",
      "Workflow mensuel recommandé",
      "Filtrer les paiements"
    ],
    "p": [
      "Lorsque vous recevez un loyer, vous pouvez le valider rapidement sans passer par le formulaire de modification :",
      "La liste des paiements peut être filtrée par statut, par locataire ou par période (mois / année) grâce aux filtres disponibles en haut de page.",
      "Utilisez ce bouton chaque mois au moment où vous recevez les virements. C'est plus rapide que d'ouvrir le formulaire complet."
    ],
    "ol": [
      "<li>Cliquez sur <strong>Paiements</strong> dans le menu latéral.</li><li>Cliquez sur <strong>Nouveau paiement</strong>.</li><li>Remplissez le formulaire :</li>",
      "<li>Cliquez sur <strong>Enregistrer</strong>.</li>",
      "<li>Dans la liste des paiements, repérez le paiement concerné (statut : <strong>En attente</strong>).</li><li>Cliquez sur le bouton <strong>Marquer comme payé</strong>.</li><li>Le statut passe à <strong>Payé</strong> et la date du jour est enregistrée automatiquement.</li>",
      "<li>En début de mois, créez un paiement <strong>En attente</strong> pour chaque locataire.</li><li>À réception de chaque virement, cliquez sur <strong>Marquer comme payé</strong>.</li><li>En milieu de mois, vérifiez le tableau de bord pour identifier les paiements encore en attente et les passer en <strong>Retard</strong> si nécessaire.</li>"
    ],
    "th": [
      "Champ",
      "Description",
      "Obligatoire",
      "Statut",
      "Signification"
    ],
    "td": [
      "<strong>Locataire</strong>",
      "Locataire concerné",
      "Oui",
      "<strong>Bien</strong>",
      "Bien concerné",
      "Oui",
      "<strong>Montant</strong>",
      "Montant du loyer à encaisser",
      "Oui",
      "<strong>Mois</strong>",
      "Mois concerné (1 à 12)",
      "Oui",
      "<strong>Année</strong>",
      "Année concernée",
      "Oui",
      "<strong>Date de paiement</strong>",
      "Date effective du versement (si déjà reçu)",
      "Non",
      "<strong>Statut</strong>",
      "En attente, payé ou en retard",
      "Oui",
      "<strong>En attente</strong>",
      "Loyer attendu mais pas encore encaissé.",
      "<strong>Payé</strong>",
      "Loyer reçu. La date de paiement est enregistrée.",
      "<strong>En retard</strong>",
      "Loyer non encaissé après l'échéance prévue."
    ]
  },
  "utilisateur_documents": {
    "h1": "Documents",
    "subtitle": "Centraliser et retrouver tous les fichiers liés à vos biens.",
    "h2": [
      "À quoi sert ce module ?",
      "Uploader un document",
      "Catégories de documents",
      "Télécharger un document",
      "Supprimer un document",
      "Bonne pratique : les diagnostics"
    ],
    "p": [
      "Le module Documents vous permet de stocker en ligne tous les fichiers liés à votre activité de bailleur : contrats de bail signés, diagnostics obligatoires (DPE, électricité…), quittances de loyer, attestations d'assurance, et tout autre document utile.",
      "Dans la liste des documents, cliquez sur le nom ou le bouton <strong>Télécharger</strong> pour récupérer le fichier sur votre appareil.",
      "Cliquez sur <strong>Supprimer</strong> dans la liste. La suppression est définitive. Si vous avez uploadé un mauvais fichier, supprimez-le et ré-uploadez le bon.",
      "Il n'est pas possible de modifier un document déjà uploadé. Pour remplacer un fichier, supprimez l'ancienne version puis uploadez la nouvelle.",
      "Renseignez la <strong>date d'expiration</strong> pour vos diagnostics obligatoires (DPE valable 10 ans, diagnostic électricité 6 ans, etc.). Cela vous permettra de suivre leur validité et d'anticiper leur renouvellement."
    ],
    "ol": [
      "<li>Cliquez sur <strong>Documents</strong> dans le menu latéral.</li><li>Cliquez sur <strong>Ajouter un document</strong>.</li><li>Remplissez le formulaire :</li>",
      "<li>Cliquez sur <strong>Uploader</strong>.</li>"
    ],
    "th": [
      "Champ",
      "Description",
      "Obligatoire",
      "Catégorie",
      "Exemples"
    ],
    "td": [
      "<strong>Nom</strong>",
      "Nom du document (ex : « DPE appartement Lyon »)",
      "Oui",
      "<strong>Catégorie</strong>",
      "Contrat, diagnostic, quittance, assurance ou autre",
      "Oui",
      "<strong>Bien associé</strong>",
      "Bien auquel ce document se rattache",
      "Non",
      "<strong>Date d'upload</strong>",
      "Date de dépôt du document",
      "Oui",
      "<strong>Date d'expiration</strong>",
      "Date de validité (ex : pour un DPE ou une assurance)",
      "Non",
      "<strong>Fichier</strong>",
      "Le fichier à uploader (PDF, image, etc.)",
      "Oui",
      "<strong>Contrat</strong>",
      "Bail de location signé, avenant au bail",
      "<strong>Diagnostic</strong>",
      "DPE, diagnostic électricité, amiante, plomb, gaz",
      "<strong>Quittance</strong>",
      "Quittance de loyer mensuelle",
      "<strong>Assurance</strong>",
      "Attestation assurance propriétaire non occupant (PNO), attestation locataire",
      "<strong>Autre</strong>",
      "Photos, relevés de charges, factures de travaux"
    ]
  },
  "utilisateur_maintenance": {
    "h1": "Maintenance",
    "subtitle": "Planifier et suivre les travaux et interventions sur vos biens.",
    "h2": [
      "À quoi sert ce module ?",
      "Créer une intervention",
      "Niveaux de priorité",
      "Suivre l'avancement d'une intervention",
      "Statuts d'une intervention",
      "Enregistrer le coût réel",
      "Interventions urgentes"
    ],
    "p": [
      "Le module Maintenance vous permet de tracer toutes les interventions sur vos biens : réparations urgentes signalées par un locataire, travaux de rénovation, entretien courant, sinistres… Chaque intervention est suivie avec sa priorité, son avancement et ses coûts.",
      "Au fur et à mesure que les travaux avancent, mettez à jour la progression :",
      "Une fois l'intervention terminée, renseignez le <strong>coût réel</strong> dans le formulaire de modification. Cela vous permet de comparer le budget prévu avec la dépense effective, et de constituer un historique de vos dépenses par bien.",
      "Passez une intervention en statut <strong>Terminé</strong> plutôt que de la supprimer. Vous conservez ainsi l'historique complet des travaux réalisés sur chaque bien, utile notamment lors d'une revente ou d'un litige.",
      "Les interventions à priorité <strong>Haute</strong> non encore terminées apparaissent automatiquement dans les alertes du <a href=\"tableau-de-bord.html\">tableau de bord</a>."
    ],
    "ol": [
      "<li>Cliquez sur <strong>Maintenance</strong> dans le menu latéral.</li><li>Cliquez sur <strong>Nouvelle intervention</strong>.</li><li>Remplissez le formulaire :</li>",
      "<li>Cliquez sur <strong>Enregistrer</strong>.</li>",
      "<li>Dans la liste des interventions, cliquez sur <strong>Mettre à jour</strong>.</li><li>Ajustez le <strong>pourcentage d'avancement</strong> (0 % à 100 %).</li><li>Mettez à jour le <strong>statut</strong> si nécessaire.</li><li>Cliquez sur <strong>Enregistrer</strong>.</li>"
    ],
    "th": [
      "Champ",
      "Description",
      "Obligatoire",
      "Priorité",
      "Usage recommandé",
      "Statut",
      "Signification"
    ],
    "td": [
      "<strong>Bien</strong>",
      "Bien concerné par l'intervention",
      "Oui",
      "<strong>Titre</strong>",
      "Résumé court (ex : « Fuite robinet cuisine »)",
      "Oui",
      "<strong>Description</strong>",
      "Détail de l'intervention",
      "Non",
      "<strong>Priorité</strong>",
      "Haute, moyenne ou basse",
      "Oui",
      "<strong>Coût estimé</strong>",
      "Montant prévu pour l'intervention",
      "Non",
      "<strong>Haute</strong>",
      "Urgence : fuite d'eau, panne de chauffage en hiver, problème de sécurité. Apparaît dans les alertes du tableau de bord.",
      "<strong>Moyenne</strong>",
      "Intervention à planifier rapidement mais sans urgence immédiate.",
      "<strong>Basse</strong>",
      "Entretien courant ou amélioration à réaliser à terme.",
      "<strong>À faire</strong>",
      "L'intervention est planifiée mais n'a pas encore commencé.",
      "<strong>En cours</strong>",
      "Les travaux ont démarré.",
      "<strong>Terminé</strong>",
      "L'intervention est clôturée."
    ]
  },
  "fonctionnel_apercu": {
    "h1": "Aperçu fonctionnel",
    "subtitle": "Présentation métier de GestiLoc, ses modules et ses rôles utilisateurs.",
    "h2": [
      "Présentation",
      "Objectifs",
      "Modules disponibles",
      "Rôles utilisateurs"
    ],
    "p": [
      "GestiLoc est une application web de gestion locative destinée aux bailleurs privés. Elle centralise la gestion des biens immobiliers, des locataires, des contrats de location, des paiements de loyer, des documents et des interventions de maintenance.",
      "L'authentification est gérée par <strong>Laravel Breeze</strong> (email + mot de passe).",
      "La gestion multi-rôles (propriétaire, gestionnaire, locataire) n'est pas implémentée dans la version actuelle mais peut être ajoutée via un package comme Spatie Laravel Permission."
    ],
    "ul": [
      "<li>Offrir une vue d'ensemble du parc immobilier (biens occupés / vacants)</li><li>Suivre les locataires et leur statut de paiement</li><li>Gérer les contrats de location (création, archivage, alertes d'expiration)</li><li>Enregistrer et suivre les paiements mensuels</li><li>Centraliser les documents liés aux biens (contrats, diagnostics, quittances, assurances)</li><li>Planifier et suivre les travaux de maintenance</li>"
    ],
    "th": [
      "Module",
      "Description",
      "Rôle",
      "Description"
    ],
    "td": [
      "<strong>Tableau de bord</strong>",
      "Statistiques globales, alertes, vue synthétique",
      "<strong>Propriétés</strong>",
      "CRUD des biens immobiliers",
      "<strong>Locataires</strong>",
      "CRUD des locataires, statut de paiement",
      "<strong>Contrats</strong>",
      "Gestion des baux, archivage, alertes d'expiration",
      "<strong>Paiements</strong>",
      "Suivi des loyers mensuels, marquage comme payé",
      "<strong>Documents</strong>",
      "Upload et gestion des fichiers liés aux biens",
      "<strong>Maintenance</strong>",
      "Suivi des interventions avec progression et coûts",
      "<strong>Rapports</strong>",
      "Vue agrégée financière et opérationnelle",
      "<strong>Bailleur (utilisateur authentifié)</strong>",
      "Accès complet à toutes les fonctionnalités. Toutes les données sont cloisonnées par <code>user_id</code> — chaque bailleur ne voit que ses propres biens, locataires, contrats, etc."
    ]
  },
  "fonctionnel_user_stories": {
    "h1": "User Stories",
    "subtitle": "Cas d'usage par module, basés sur les routes et controllers Laravel.",
    "h2": [
      "Authentification",
      "Tableau de bord",
      "Propriétés",
      "Locataires",
      "Contrats",
      "Paiements",
      "Documents",
      "Maintenance",
      "Rapports"
    ],
    "callout": [
      "Toutes les stories ci-dessous correspondent à des actions réelles implémentées dans <code>projet-dynamic/routes/web.php</code> et les controllers associés."
    ],
    "ul": [
      "<li>En tant que bailleur, je peux m'inscrire avec un email et un mot de passe.</li><li>En tant que bailleur, je peux me connecter avec mon compte Google via <code>GET /auth/google</code>.</li><li>En tant que bailleur, je peux me connecter et me déconnecter.</li><li>En tant que bailleur, je peux modifier mon profil (nom, email, mot de passe).</li><li>En tant que bailleur, je peux supprimer mon compte.</li><li>En tant que bailleur, je peux changer la langue de l'interface (FR/EN) via <code>GET /lang/{locale}</code>.</li>",
      "<li>En tant que bailleur, je peux voir un résumé de mon parc : nombre de biens, nombre de locataires, loyers du mois, alertes en cours.</li>",
      "<li>En tant que bailleur, je peux ajouter un bien immobilier (type, adresse, loyer, charges, dépôt de garantie).</li><li>En tant que bailleur, je peux consulter la liste de mes biens avec leur statut (occupé / vacant).</li><li>En tant que bailleur, je peux modifier les informations d'un bien.</li><li>En tant que bailleur, je peux supprimer un bien (et toutes ses données associées en cascade).</li><li>En tant que bailleur, une référence unique est auto-générée pour chaque bien (ex : <code>PROP-001</code>).</li>",
      "<li>En tant que bailleur, je peux ajouter un locataire et l'associer à un bien.</li><li>En tant que bailleur, je peux consulter la liste de mes locataires avec leur statut de paiement.</li><li>En tant que bailleur, je peux rechercher un locataire par nom ou email.</li><li>En tant que bailleur, je peux modifier les informations d'un locataire.</li><li>En tant que bailleur, je peux supprimer un locataire.</li>",
      "<li>En tant que bailleur, je peux créer un contrat de location (type vide/meublé/commercial, dates, loyer).</li><li>En tant que bailleur, je peux consulter la liste de mes contrats et leur statut (actif, expiré, archivé).</li><li>En tant que bailleur, je peux archiver un contrat actif via <code>PATCH /contracts/{id}/archive</code>.</li><li>En tant que bailleur, je suis alerté lorsqu'un contrat expire dans les 30 jours.</li><li>En tant que bailleur, je peux modifier ou supprimer un contrat.</li>",
      "<li>En tant que bailleur, je peux enregistrer un paiement mensuel pour un locataire.</li><li>En tant que bailleur, je peux consulter l'historique des paiements par locataire ou par bien.</li><li>En tant que bailleur, je peux marquer un paiement comme « payé » en un clic via <code>PATCH /payments/{id}/mark-paid</code>.</li><li>En tant que bailleur, je peux voir les paiements en retard.</li>",
      "<li>En tant que bailleur, je peux uploader un document et le rattacher à un bien (contrat, diagnostic, quittance, assurance).</li><li>En tant que bailleur, je peux consulter la liste de mes documents avec leur catégorie et date d'expiration.</li><li>En tant que bailleur, je peux télécharger ou supprimer un document.</li>",
      "<li>En tant que bailleur, je peux créer une intervention de maintenance pour un bien (titre, description, priorité, coût estimé).</li><li>En tant que bailleur, je peux consulter la liste des interventions et leur avancement.</li><li>En tant que bailleur, je peux mettre à jour la progression d'une intervention via <code>PATCH /maintenances/{id}/progress</code>.</li><li>En tant que bailleur, je peux voir les interventions urgentes (priorité haute, non terminées).</li>",
      "<li>En tant que bailleur, je peux accéder à une page de rapports pour visualiser les données financières et opérationnelles agrégées.</li>"
    ]
  },
  "technique_architecture": {
    "h1": "Architecture technique",
    "subtitle": "Stack technologique, structure des dossiers, services et flux d'authentification.",
    "h2": [
      "Stack",
      "Structure des dossiers",
      "Flux d'authentification",
      "Contrôleurs",
      "Services",
      "Middleware",
      "Principes appliqués"
    ],
    "ol": [
      "<li>L'utilisateur accède à `/` → redirection automatique vers `/dashboard`</li><li>Si non authentifié → redirection vers `/login` (middleware `auth`)</li><li>Inscription via `/register` (Laravel Breeze) ou connexion Google via `/auth/google`</li><li>Après login → accès à toutes les routes du groupe `auth`</li><li>Toutes les données sont filtrées par `user_id` (isolation multi-utilisateurs)</li><li>Changement de langue via `GET /lang/{locale}` → stocké en session</li>"
    ],
    "ul": [
      "<li><strong>SOLID</strong> — un contrôleur par ressource, responsabilité unique</li><li><strong>DRY</strong> — composants Blade réutilisables pour tous les éléments d'UI récurrents</li><li><strong>Scoped data</strong> — chaque query filtre sur <code>user_id</code> pour isoler les données par bailleur</li>"
    ],
    "th": [
      "Couche",
      "Technologie",
      "Contrôleur",
      "Responsabilité"
    ],
    "td": [
      "Framework backend",
      "Laravel 10",
      "Langage",
      "PHP 8.1+",
      "Templating",
      "Blade (composants réutilisables)",
      "CSS",
      "Tailwind CSS (via Vite)",
      "JS interactivité",
      "Alpine.js",
      "Build tool",
      "Vite",
      "Authentification",
      "Laravel Breeze",
      "Base de données",
      "SQLite (dev) / MySQL (prod)",
      "<code>DashboardController</code>",
      "Statistiques globales du tableau de bord",
      "<code>PropertyController</code>",
      "CRUD biens",
      "<code>TenantController</code>",
      "CRUD locataires",
      "<code>ContractController</code>",
      "CRUD contrats + archivage",
      "<code>PaymentController</code>",
      "CRUD paiements + mark-paid",
      "<code>DocumentController</code>",
      "Upload / suppression documents",
      "<code>MaintenanceController</code>",
      "CRUD maintenance + progression",
      "<code>ReportController</code>",
      "Page de rapports agrégés",
      "<code>ProfileController</code>",
      "Modification du profil utilisateur"
    ],
    "p": [
      "Chaque module dispose d'un service dédié dans `app/Services/` qui encapsule la logique métier, séparant les responsabilités des contrôleurs."
    ]
  },
  "technique_installation": {
    "h1": "Installation",
    "subtitle": "Setup de l'application Laravel pas à pas.",
    "h2": [
      "Prérequis",
      "1. Cloner le dépôt",
      "2. Installer les dépendances PHP",
      "3. Configurer l'environnement",
      "4. Créer la base de données SQLite",
      "5. Exécuter les migrations",
      "6. Installer les dépendances front-end",
      "7. Compiler les assets",
      "8. Lancer le serveur",
      "Récapitulatif rapide"
    ],
    "p": [
      "Éditer <code>.env</code> selon votre environnement :",
      "L'application est accessible sur <code>http://localhost:8000</code>.",
      "Optionnel — peupler avec des données de test :"
    ],
    "ul": [
      "<li>PHP 8.1+</li><li>Composer</li><li>Node.js 18+ et npm</li><li>SQLite (inclus dans PHP) ou MySQL</li>"
    ],
    "callout": [
      "Cette étape est uniquement nécessaire pour SQLite. Sur MySQL, créer la base via votre interface habituelle.",
      "Pour le développement, laissez <code>npm run dev</code> tourner dans un terminal séparé afin de bénéficier du hot module replacement (HMR) de Vite."
    ]
  },
  "technique_composants_blade": {
    "h1": "Composants Blade",
    "subtitle": "Tous les composants sont dans <code>projet-dynamic/resources/views/components/</code>. Ils s'utilisent avec la syntaxe <code>&lt;x-nom-du-composant /&gt;</code>.",
    "h2": [
      "Composants génériques (Breeze)",
      "Composants métier GestiLoc",
      "Principe d'utilisation"
    ],
    "p": [
      "Ces composants proviennent de Laravel Breeze et sont utilisés dans les formulaires et l'authentification.",
      "Ces composants ont été créés spécifiquement pour l'application, selon le principe DRY.",
      "Les composants métier acceptent des <code>props</code> pour être configurables sans duplication. Exemples :",
      "Pour ajouter un composant : créer le fichier dans <code>resources/views/components/</code>. Laravel le détecte automatiquement via la convention de nommage — aucune déclaration manuelle requise."
    ],
    "th": [
      "Composant",
      "Fichier",
      "Description"
    ],
    "td": [
      "<code>&lt;x-primary-button&gt;</code>",
      "<code>primary-button.blade.php</code>",
      "Bouton principal (action principale)",
      "<code>&lt;x-secondary-button&gt;</code>",
      "<code>secondary-button.blade.php</code>",
      "Bouton secondaire",
      "<code>&lt;x-danger-button&gt;</code>",
      "<code>danger-button.blade.php</code>",
      "Bouton destructif (suppression)",
      "<code>&lt;x-text-input&gt;</code>",
      "<code>text-input.blade.php</code>",
      "Champ texte standard",
      "<code>&lt;x-input-label&gt;</code>",
      "<code>input-label.blade.php</code>",
      "Label de formulaire",
      "<code>&lt;x-input-error&gt;</code>",
      "<code>input-error.blade.php</code>",
      "Affichage des erreurs de validation",
      "<code>&lt;x-dropdown&gt;</code>",
      "<code>dropdown.blade.php</code>",
      "Menu déroulant Alpine.js",
      "<code>&lt;x-dropdown-link&gt;</code>",
      "<code>dropdown-link.blade.php</code>",
      "Lien dans un dropdown",
      "<code>&lt;x-modal&gt;</code>",
      "<code>modal.blade.php</code>",
      "Modale Alpine.js",
      "<code>&lt;x-nav-link&gt;</code>",
      "<code>nav-link.blade.php</code>",
      "Lien de navigation (actif / inactif)",
      "<code>&lt;x-responsive-nav-link&gt;</code>",
      "<code>responsive-nav-link.blade.php</code>",
      "Lien nav mobile",
      "<code>&lt;x-auth-session-status&gt;</code>",
      "<code>auth-session-status.blade.php</code>",
      "Message de statut session",
      "<code>&lt;x-application-logo&gt;</code>",
      "<code>application-logo.blade.php</code>",
      "Logo de l'application",
      "<code>&lt;x-navbar&gt;</code>",
      "<code>navbar.blade.php</code>",
      "Barre de navigation principale",
      "<code>&lt;x-sidebar&gt;</code>",
      "<code>sidebar.blade.php</code>",
      "Menu latéral de navigation",
      "<code>&lt;x-page-header&gt;</code>",
      "<code>page-header.blade.php</code>",
      "En-tête de page (titre + bouton d'action)",
      "<code>&lt;x-stat-card&gt;</code>",
      "<code>stat-card.blade.php</code>",
      "Carte de statistique pour le dashboard",
      "<code>&lt;x-status-badge&gt;</code>",
      "<code>status-badge.blade.php</code>",
      "Badge coloré pour afficher un statut",
      "<code>&lt;x-action-buttons&gt;</code>",
      "<code>action-buttons.blade.php</code>",
      "Boutons d'action (éditer, supprimer)",
      "<code>&lt;x-data-table&gt;</code>",
      "<code>data-table.blade.php</code>",
      "Tableau de données réutilisable",
      "<code>&lt;x-empty-state&gt;</code>",
      "<code>empty-state.blade.php</code>",
      "Message quand une liste est vide",
      "<code>&lt;x-progress-bar&gt;</code>",
      "<code>progress-bar.blade.php</code>",
      "Barre de progression (maintenance)",
      "<code>&lt;x-form-section&gt;</code>",
      "<code>form-section.blade.php</code>",
      "Section de formulaire avec titre",
      "<code>&lt;x-toast&gt;</code>",
      "<code>toast.blade.php</code>",
      "Notification flash (succès, erreur)",
      "<code>&lt;x-property-card&gt;</code>",
      "<code>property-card.blade.php</code>",
      "Carte d'affichage d'un bien",
      "<code>&lt;x-tenant-card&gt;</code>",
      "<code>tenant-card.blade.php</code>",
      "Carte d'affichage d'un locataire"
    ]
  },
  "technique_poc_vs_dynamic": {
    "h1": "POC vs Projet Dynamic",
    "subtitle": "Comparaison entre le prototype statique (<code>poc/</code>) et l'application Laravel (<code>projet-dynamic/</code>).",
    "h2": [
      "Vue d'ensemble",
      "Objectif du POC",
      "Ce que le projet dynamic ajoute",
      "Correspondance des modules"
    ],
    "p": [
      "Le dossier <code>poc/</code> est une maquette haute-fidélité destinée à :"
    ],
    "ul": [
      "<li>Valider l'interface et la navigation avant le développement</li><li>Présenter le projet sans infrastructure back-end</li><li>Servir de référence visuelle pendant le développement</li>"
    ],
    "ol": [
      "<li><strong>Persistance</strong> — les données survivent au rechargement de page</li><li><strong>Authentification</strong> — chaque bailleur a ses propres données cloisonnées</li><li><strong>Validation serveur</strong> — les formulaires sont validés côté Laravel</li><li><strong>Actions métier</strong> — mark-paid, archivage contrat, progression maintenance</li><li><strong>Composants réutilisables</strong> — zéro duplication HTML grâce aux composants Blade</li><li><strong>Rapports</strong> — agrégation de données réelles</li><li><strong>Upload de fichiers</strong> — stockage des documents sur le serveur</li>"
    ],
    "th": [
      "Critère",
      "<code>poc/</code>",
      "<code>projet-dynamic/</code>",
      "Module",
      "POC",
      "Projet dynamic"
    ],
    "td": [
      "Type",
      "Prototype statique",
      "Application Laravel complète",
      "Données",
      "Fictives / codées en dur",
      "Persistées en base de données",
      "Authentification",
      "Aucune",
      "Laravel Breeze (email + mot de passe)",
      "Backend",
      "Aucun",
      "Laravel 10 / PHP 8.1",
      "Templating",
      "HTML brut",
      "Blade + composants réutilisables",
      "CSS",
      "Tailwind CDN",
      "Tailwind compilé via Vite",
      "JS",
      "Alpine.js CDN",
      "Alpine.js via npm",
      "Multi-utilisateurs",
      "Non",
      "Oui (isolation par <code>user_id</code>)",
      "CRUD réel",
      "Non",
      "Oui (tous les modules)",
      "Dashboard",
      "Page statique avec chiffres fictifs",
      "<code>DashboardController</code> + données réelles",
      "Propriétés",
      "Liste HTML fixe",
      "CRUD complet + référence auto-générée",
      "Locataires",
      "Liste HTML fixe",
      "CRUD + recherche + statut de paiement",
      "Contrats",
      "Affiché statiquement",
      "CRUD + archivage + alertes expiration 30j",
      "Paiements",
      "Tableau statique",
      "CRUD + mark-paid + filtres par période",
      "Documents",
      "Liste statique",
      "Upload réel + téléchargement + catégories",
      "Maintenance",
      "Liste statique",
      "CRUD + barre de progression + suivi des coûts"
    ]
  },
  "technique_base_de_donnees": {
    "h1": "Base de données",
    "subtitle": "Schéma des tables métier, table users et relations Eloquent.",
    "h2": [
      "Vue d'ensemble",
      "Table users",
      "Table properties",
      "Table tenants",
      "Table contracts",
      "Table payments",
      "Table documents",
      "Table maintenances",
      "Relations Eloquent — résumé"
    ],
    "th": [
      "Colonne",
      "Type",
      "Contraintes",
      "Modèle",
      "hasMany",
      "belongsTo"
    ]
  }
};
