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

# Démo de sécurité : Test d'attaques et mesures de sécurité sur l'application web

Dans cette section, nous allons démontrer plusieurs attaques sur l'application web TravelMates ainsi que les mesures de sécurité mises en place pour contrer ces attaques. L'objectif est d'identifier et de comprendre les failles de sécurité en exploitant diverses vulnérabilités présentes dans l'application.

## Démo d'attaques par injection SQL

Dans cette section, nous allons démontrer deux attaques par injection SQL sur l'application TravelMates. L'objectif est de contourner le mécanisme d'authentification en exploitant des failles dans le formulaire de connexion.

### Attaque 1 : Contournement basé sur l’évaluation toujours vraie

Pour cette première attaque, nous allons exploiter une faille dans le formulaire de connexion en injectant une requête SQL manipulée dans le champ du mot de passe.

#### Méthode :
Nous allons saisir un pseudo valide dans le premier champ (`aghilas`) et dans le champ du mot de passe, nous entrerons `' OR '1'='1`. Cette manipulation de la requête SQL force l'évaluation de la condition à vrai, contournant ainsi l'authentification et permettant l'accès sans fournir de mot de passe valide.

#### Procédure :
1. Accédez à la page de connexion.
2. Entrez le pseudo `aghilas` dans le champ correspondant.
3. Dans le champ du mot de passe, entrez `' OR '1'='1`.
4. Soumettez le formulaire.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/a5540041-d473-4ccc-89ae-f676f9d25ca9)


### Attaque 2 : Utilisation des commentaires SQL

Pour la deuxième attaque, nous exploiterons également une faille dans le formulaire de connexion en utilisant les commentaires SQL pour neutraliser la vérification du mot de passe.

#### Méthode :
En insérant `'--` après le nom d'utilisateur, nous empêcherons la requête SQL de vérifier le mot de passe, permettant ainsi l'accès sans authentification valide.

#### Procédure :
1. Accédez à la page de connexion.
2. Entrez le pseudo suivi de `'--` dans le champ correspondant.
3. Soumettez le formulaire.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/d4228776-264e-4ef8-9450-2ca8638cbeca)

### Mesure de sécurité : Utilisation de requêtes préparées

Les requêtes préparées permettent de séparer les instructions SQL des données utilisateur en utilisant des marqueurs de paramètres. Au lieu d'incorporer directement les données utilisateur dans la requête SQL, les valeurs sont fournies séparément, ce qui permet à la base de données de distinguer les données des instructions SQL.

#### Fonctionnement :
En utilisant des marqueurs de paramètres, les données utilisateur sont dissociées des instructions SQL, éliminant ainsi le risque d'injection SQL.

#### Implémentation dans notre application web PHP :
Nous utilisons l'extension MySQLi en PHP pour appliquer l'utilisation de requêtes préparées. La requête SQL est formulée avec des marqueurs de paramètres (?) pour les valeurs de pseudo et de mot_de_passe.
- Les valeurs des paramètres sont ensuite liées à la requête via la méthode `bind_param()`.
- La requête est exécutée de manière sécurisée avec `execute()`.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/2ea55873-8429-4561-a860-278236689a49)


