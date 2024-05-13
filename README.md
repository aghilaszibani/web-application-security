# Guide pour tester les attaques web sur TravelMates

Ce guide vous aidera à configurer l’environnement nécessaire pour tester les attaques web sur l'application web TravelMates, ainsi que les mesures de sécurité mises en place pour contrer ces attaques.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé soit Wamp soit Xampp sur votre système. Vous pouvez télécharger Wamp depuis [ici](https://www.wampserver.com/) ou Xampp depuis [ici](https://www.apachefriends.org/fr/index.html).

## Étapes à suivre

1. **Installation de Wamp ou Xampp**:
   - Suivez les instructions d'installation de Wamp ou Xampp selon votre choix.
   - Assurez-vous que les services Apache et MySQL sont démarrés.

2. **Placement des codes sources**:
   - Téléchargez les codes sources de l'application avant et après le patch depuis GitHub.
   - Pour Wamp, placez les fichiers de l'application dans le dossier `www` (généralement situé dans `C:\wamp\www`).
   - Pour Xampp, placez les fichiers de l'application dans le dossier `htdocs` (généralement situé dans `C:\xampp\htdocs`).

3. **Importation de la base de données**:
   - Ouvrez phpMyAdmin en accédant à `http://localhost/phpmyadmin`.
   - Créez une nouvelle base de données nommée `projetgl`.
   - Importez le fichier SQL `projetgl.sql` fourni dans la base de données nouvellement créée.

4. **Accès au site web**:
   - Pour accéder à l'application web vulnérable, ouvrez un navigateur web et entrez l'URL `http://localhost/travelmates_unsecure`.
   - Pour accéder à l'application web sécurisée, entrez l'URL `http://localhost/travelmates`.
   - Explorez les fonctionnalités de chaque site pour découvrir les vulnérabilités.
