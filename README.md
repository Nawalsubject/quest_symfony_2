# quest_symfony_2
2 - Symfony : Initialiser un projet Blog en Symfony 4

Challenge

Blog Init
Le défi est simple : Tu initialiseras un dépôt Git hébergé sur GitHub avec une release "Quête nouveau projet" et pour tag "q_new". Tu entreras l'URL de la release dans le champ solution.

L'URL d'une release GitHub ressemble à ça, avec ton propre USERNAME : https://github.com/USER_NAME/blog/tree/q_new

Critères de validation
Le dépôt contient uniquement les dossiers suivants : assets/, bin/, config/, public/, src/, templates/, tests/, translations/, var/ et quelques autres fichiers (.gitignore, composer.json, etc.).
Le dépôt ne contient évidement pas les répertoire .idea/ et vendor/.
Le correcteur peux installer le projet sur sa machine (voir étape bonus) et la page "Welcome to Symfony" s'affiche sur la route / en accédant à l'url http://localhost:8000/.

# quest_symfony_3

La page d'accueil de ton site
Tu as créé l'index de ta page blog. Potentiellement où se trouvera tous tes futurs articles. Mais quant est-il de ta page d'accueil ?

Créer un nouveau contrôleur DefaultController

Créer une méthode index() et une route en annotation nommée app_index qui devra répondre à une requête sur l'url / (la page par défaut de ton site finalement).

La méthode devra afficher un titre h1 contenant "Bienvenue sur mon blog" grâce à un template Twig nommé default.html.twig à la racine, qui étendra base.html.twig.

Critères de validation
Il y a un fichier DefaultController.php dans src/Controller de l'arborescence.
Ce fichier comporte une classe DefaultController et étend le AbstractController de base de Symfony.
La route sur / est faite en annotation et est nommée app_index.
Le méthode index() du contrôleur se finit par un $this->render('path_vers_un_twig');.
Le fichier Twig default.html.twig étend base.html.twig et comprend un titre h1 "Bienvenue sur mon blog".
L'URL http://localhost:8000/ est fonctionnelle, le titre s'affiche. :)
