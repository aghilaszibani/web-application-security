# Guide pour tester les attaques web sur TravelMates

Ce guide vous aidera à configurer l’environnement nécessaire pour tester les attaques web sur l'application web TravelMates, ainsi que les mesures de sécurité mises en place pour contrer ces attaques.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé soit Wamp soit Xampp sur votre système. Vous pouvez télécharger Wamp depuis [ici]([https://www.wampserver.com/](https://wampserver.aviatechno.net/)) ou Xampp depuis [ici](https://www.apachefriends.org/fr/index.html).

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

## Attaque par injection SQL

Dans cette section, nous allons démontrer deux attaques par injection SQL sur l'application TravelMates. L'objectif est de contourner le mécanisme d'authentification en exploitant des failles dans le formulaire de connexion.

### Méthode 1 : Contournement basé sur l’évaluation toujours vraie

Pour cette première attaque, nous allons exploiter une faille dans le formulaire de connexion en injectant une requête SQL manipulée dans le champ du mot de passe.

#### Méthode :
Nous allons saisir un pseudo valide dans le premier champ (`aghilas`) et dans le champ du mot de passe, nous entrerons `' OR '1'='1`. Cette manipulation de la requête SQL force l'évaluation de la condition à vrai, contournant ainsi l'authentification et permettant l'accès sans fournir de mot de passe valide.

#### Procédure :
1. Accédez à la page de connexion.
2. Entrez le pseudo `aghilas` dans le champ correspondant.
3. Dans le champ du mot de passe, entrez `' OR '1'='1`.
4. Soumettez le formulaire.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/a5540041-d473-4ccc-89ae-f676f9d25ca9)


### Méthode 2 : Utilisation des commentaires SQL

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

## Attaque XSS : Vol de cookies de session

### Création de la payload XSS :
Nous avons conçu une payload XSS contenant un script JavaScript qui extrait le cookie de session de l'utilisateur et l'envoie vers notre webhook.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/557376c8-8041-4976-aafc-5b848451bbce)


### Publication de la payload :
Nous avons posté cette payload en tant que commentaire sur le forum. Ainsi, chaque fois qu'un utilisateur accède à la page contenant notre commentaire, le script XSS est automatiquement exécuté dans son navigateur.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/c8956138-d6fa-4022-b142-46cdb293a486)

### Récupération des cookies de session :
Sur notre webhook configuré sur webhook.site, nous recevons les cookies de session des utilisateurs dès qu'ils chargent la page contenant notre commentaire

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/15447631-845d-4cc9-9fb9-ef72d99f9b5d)

### Mesures de sécurité

#### Utilisation de Content Security Policy (CSP)

La directive HTTP Content-Security-Policy script-src définit les sources autorisées pour le code JavaScript sur une page web. Cela englobe les URL chargées via les balises `<script>`, ainsi que les scripts intégrés, les attributs d'événement (comme `onclick`) et les feuilles de style XSLT qui pourraient entraîner l'exécution de scripts.

L’implémentation a été faite en ajoutant l'en-tête HTTP Content-Security-Policy avec les paramètres appropriés dans le code de la page HTML :
<meta http-equiv="Content-Security-Policy" content="script-src 'self'">

#### Filtrage des entrées utilisateur

Cette méthode pour contrer les attaques XSS consiste à filtrer et valider toutes les entrées utilisateur. Ce processus implique de s'assurer que les données fournies par les utilisateurs ne contiennent pas de scripts ou d'autres éléments potentiellement malveillants avant qu'elles soient traitées ou affichées sur le site web. Pour ce faire, nous avons appliqué la fonction htmlspecialchars() sur PHP. Cette fonction convertit les caractères spéciaux en entités HTML. Par exemple, les caractères comme <, >, ", ', et & sont convertis en &lt;, &gt;, &quot;, &#039;, et &amp; respectivement.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/d9300fb5-ee79-44e4-ad25-9b447a22e129)

## Attaquant ciblant le contrôle d'accés au panneau admin :

1. **Découverte de fichiers et répertoires cachés en utilisant Gobuster :**
Nous lançons Gobuster, un outil de recherche de contenu sur le web, pour scanner l'application à la recherche de répertoires ou de fichiers cachés. Après avoir configuré Gobuster avec une liste de mots clés courants, nous lançons le scan et examinons les résultats. Parmi les répertoires découverts, nous identifions "admin" comme étant potentiellement intéressant pour une attaque.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/accb39f7-9414-4866-b9b6-70f808464caa)


3. **Découverte de l'URL du Panneau de Configuration Admin :**
Nous poursuivons l'exploration en utilisant Gobuster pour scanner le répertoire "admin" découvert précédemment. Après un certain temps, Gobuster identifie un fichier appelé "user.php" à l'intérieur du répertoire "admin". Nous déduisons alors que cet URL pourrait être celui du panneau de configuration administrateur.

4. **Accès au Panneau de Configuration Admin sans les Autorisations Requises :**
Nous copions l'URL découvert ("/admin/src/user.php") dans notre navigateur et tentons d'y accéder. Nous constatons que l'accès au panneau de configuration administrateur nous est accordé, même si nous ne possédons pas les autorisations nécessaires pour y accéder légitimement. Cette faille de contrôle d'accès défaillant est confirmée.

5. **Test de l'Attaque :**
Pour vérifier l'efficacité de l'attaque, nous décidons de procéder à une action qui nécessite des privilèges administratifs. Nous choisissons de tenter de supprimer un compte administrateur à partir de la page de gestion des utilisateurs dans le panneau d'administration. En soumettant la demande de suppression, nous observons que l'action est effectuée avec succès, malgré notre statut d'utilisateur non autorisé.

![image](https://github.com/aghilaszibani/web-application-security/assets/161652334/916d5a1d-688e-467c-a022-707bd9fc0bed)

### Mesures et correctifs

#### Système d’autorisation basé sur les rôles utilisateur :

Nous avons mis en place un système d'autorisation basé sur les rôles utilisateur pour limiter l'accès aux fonctionnalités de manière appropriée.

- **Définition des rôles utilisateur :** Les rôles utilisateur sont définis dans notre base de données, où chaque utilisateur est associé à un rôle spécifique (admin ou user) via l'attribut "role".

- **Attribution automatique des rôles :** Lorsqu'un utilisateur s'inscrit à notre application, nous lui attribuons automatiquement le rôle "user", garantissant ainsi des autorisations limitées pour les nouveaux utilisateurs.

- **Procédure de création de compte administrateur :** Pour créer un compte administrateur, une procédure spéciale est mise en place, nécessitant qu'un autre compte administrateur effectue cette action. Cela garantit un contrôle strict sur les privilèges d'administration.

- **Vérification du rôle de l'utilisateur :** Nous avons écrit du code PHP pour vérifier le rôle de l'utilisateur à chaque point d'accès sensible. Par exemple, sur les pages d'administration ou les fonctionnalités réservées aux administrateurs, nous vérifions si l'utilisateur connecté a le rôle "admin". Si ce n'est pas le cas, nous le redirigeons automatiquement vers la page d'accueil du site web.

# À vous de découvrir les autres vulnérabilités et de tester des mesures de sécurité !

Nous avons présenté quelques exemples d'attaques et de mesures de sécurité dans ce projet. Mais n'oubliez pas que la sécurité est un processus continu. Il reste encore beaucoup à découvrir et à explorer. Nous vous encourageons à explorer d'avantage l'application pour identifier d'autres vulnérabilités et à tester des mesures de sécurité supplémentaires.

Pour plus d'informations et pour découvrir une variété d'attaques et de contre-mesures, n'hésitez pas à consulter notre mémoire de fin d'études où plusieurs attaques et mesures de sécurité sont démontrées en détail. Vous pouvez y accéder avec le lien ci-dessous :
[Mémoire_Finale ZIBANI - SOUICI .pdf](https://github.com/aghilaszibani/web-application-security/files/15299836/Memoire_Finale.ZIBANI.-.SOUICI.pdf)


