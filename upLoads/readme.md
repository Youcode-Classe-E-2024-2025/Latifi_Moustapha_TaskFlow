Latifi Moustapha Todo App

Une application de gestion de tâches utilisant TailwindCSS, HTML, CSS, PHP, MySQL, et JavaScript.

Description

Cette application permet aux utilisateurs de créer, lire, mettre à jour et supprimer des tâches (CRUD). Elle est construite avec une architecture simple et utilise des outils modernes comme TailwindCSS pour un design rapide et propre.


Fonctionnalités

    Ajouter une nouvelle tâche avec titre, description, statut et catégorie.
    Modifier les détails d'une tâche existante.
    Design responsive grâce à TailwindCSS.


Technologies utilisées

    Frontend : HTML, TailwindCSS, JavaScript
    Backend : PHP
    Base de données : MySQL


Voici un exemple de documentation pour ton projet au format Markdown, comme celle qu'on trouve sur GitHub :
Latifi Moustapha Todo App

Une application de gestion de tâches utilisant TailwindCSS, HTML, CSS, PHP, MySQL, et JavaScript.
Table des matières

    Description
    Fonctionnalités
    Technologies utilisées
    Installation
    Utilisation
    Structure du projet
    Contributions
    Licence

Description

Cette application permet aux utilisateurs de créer, lire, mettre à jour et supprimer des tâches (CRUD). Elle est construite avec une architecture simple et utilise des outils modernes comme TailwindCSS pour un design rapide et propre.
Fonctionnalités

    Ajouter une nouvelle tâche avec titre, description, statut et catégorie.
    Voir toutes les tâches avec filtres (par statut ou catégorie).
    Modifier les détails d'une tâche existante.
    Supprimer une tâche.
    Design responsive grâce à TailwindCSS.

Technologies utilisées

    Frontend : HTML, TailwindCSS, JavaScript
    Backend : PHP
    Base de données : MySQL

Installation
Pré-requis

    PHP >= 7.4
    MySQL >= 5.7
    Serveur local (ex. XAMPP, WAMP, ou Laravel Valet)
    Node.js (pour installer et compiler TailwindCSS)

Étapes d'installation

    Clone ce dépôt :

git clone https://github.com/username/Latifi_Moustapha_todo_oop.git

Accédez au répertoire du projet :

cd Latifi_Moustapha_todo_oop

Installez les dépendances TailwindCSS :

npm install

Compilez le fichier CSS :

npx tailwindcss -i ./src/input.css -o ./frontOffice/assets/css/styles.css --watch

Configurez la base de données :

    Importez le fichier SQL fourni (database.sql) dans votre serveur MySQL.
    Mettez à jour les informations de connexion dans backOffice/db/connect.php.

Lancez le serveur local :

php -S localhost:8000

Ouvrez l'application dans votre navigateur :

    http://localhost:8000/frontOffice/index.php

Utilisation

    Page d'accueil : Liste toutes les tâches avec options pour ajouter, modifier.
    Ajout de tâches : Cliquez sur "Ajouter une tâche", remplissez le formulaire, et soumettez.
    Modification/Suppression : Utilisez les boutons d'action à côté de chaque tâche.


