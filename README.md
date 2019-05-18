# quest_symfony_2
2 - Symfony : Initialiser un projet Blog en Symfony 4

***Blog Init***
Le défi est simple : Tu initialiseras un dépôt Git hébergé sur GitHub avec une release "Quête nouveau projet" et pour tag "q_new". Tu entreras l'URL de la release dans le champ solution.

L'URL d'une release GitHub ressemble à ça, avec ton propre USERNAME : https://github.com/USER_NAME/blog/tree/q_new

***Critères de validation :***
- Le dépôt contient uniquement les dossiers suivants : assets/, bin/, config/, public/, src/, templates/, tests/, translations/, var/ et quelques autres fichiers (.gitignore, composer.json, etc.).
- Le dépôt ne contient évidement pas les répertoire .idea/ et vendor/.
- Le correcteur peux installer le projet sur sa machine (voir étape bonus) et la page "Welcome to Symfony" s'affiche sur la route / en accédant à l'url http://localhost:8000/.

# quest_symfony_3

***La page d'accueil de ton site***
Tu as créé l'index de ta page blog. Potentiellement où se trouvera tous tes futurs articles. Mais quant est-il de ta page d'accueil ?

***Créer un nouveau contrôleur DefaultController***

Créer une méthode index() et une route en annotation nommée app_index qui devra répondre à une requête sur l'url / (la page par défaut de ton site finalement).

La méthode devra afficher un titre h1 contenant "Bienvenue sur mon blog" grâce à un template Twig nommé default.html.twig à la racine, qui étendra base.html.twig.

***Critères de validation :***
- Il y a un fichier DefaultController.php dans src/Controller de l'arborescence.
- Ce fichier comporte une classe DefaultController et étend le AbstractController de base de Symfony.
- La route sur / est faite en annotation et est nommée app_index.
- Le méthode index() du contrôleur se finit par un $this->render('path_vers_un_twig');.
- Le fichier Twig default.html.twig étend base.html.twig et comprend un titre h1 "Bienvenue sur mon blog".
- L'URL http://localhost:8000/ est fonctionnelle, le titre s'affiche. :)

# quest_symfony_4
4 - Symfony : Le routing avancé
 
 ***Crée ta propre route***
Crée une route blog/show/{slug} permettant de charger une vue affichant ce slug dynamiquement sous forme de titre, dans une balise h1. Le slug en question ne devra contenir que des caractères entre a et z (minuscules uniquement), des chiffres de 0 à 9 ou des tirets -. La route devra être reliée à une méthode show du BlogController. Avant d'appeler la vue Twig, cette méthode devra remplacer tous les tirets du slug par des espaces, puis passer la première lettre de chaque mot en majuscule (regarde la fonction ucwords) pour avoir un titre d'article lisible. Tu trouveras des exemples dans les critères de validation. Si aucun slug n'est fourni, il faudra afficher par défaut "Article Sans Titre" dans la balise h1.

***Critères de validation :***
- La route est correctement définie, en annotations, et est reliée à la méthode show() de BlogController.
Une vue templates/blog/show.html.twig est créée.
- La route blog/show/mon-super-article affiche bien une vue avec en titre "Mon Super Article" dans un h1.
- La route blog/show/article-du-1-janvier-1970 affiche bien une vue avec en titre "Article Du 1 Janvier 1970" dans un h1.
- La route blog/show/ affiche bien une vue avec "Article Sans Titre" dans un h1.
- La route blog/show/MonArticle n'affiche rien (erreur 404) car le paramètre contient des majuscules.
- La route blog/show/mon_article n'affiche rien (erreur 404) car le paramètre contient un underscore.

# quest_symfony_5
05 - Symfony : Créer ta première entité avec Doctrine

***Crée les entités Category et Article (sans liaison)
Crée deux entités Category et Article.***

*Category*
- id : integer (Clé primaire)
- name : string (Obligatoire, valeur max 100).

*Article*
- id : integer (Clé primaire)
- title : string (Obligatoire)
- content : text (Obligatoire)

Pour le moment ces deux entités ne sont pas liées. Tu dois également mettre à jour ta base de données en conséquence.

***Critères de validation :***
- Lance la commande doctrine:mapping:info, le résultat affiche bien les deux entités Category et Article.
- Lance la commande doctrine:schema:validate, le résultat affiche bien OK pour le mapping ET la base de données.
- Ton code devra être disponible sur un repository GitHub.

# quest_symfony_6
06 - Symfony : Relation "Many-To-One" avec Doctrine

***Crée la relation ManyToOne***

Ce challenge sera très simple car tu as besoin des quêtes suivantes pour mettre en place des choses plus complexes. Il s'agira uniquement de contrôler visuellement le code de la classe Article. Cette dernière doit être conforme à ce qui est expliqué dans la quête. C’est à dire, une classe Article.php qui contient une propriété category paramétrée comme il se doit dans ses annotation avec les getter et setter associés.

***Critères de validation :***
- La propriété category est présente et privée.
- Le getter et setter correspondants sont présents et publics.
- Les annotations ManyToOne et JoinColumn sont présentes et correctement paramétrées (nullable=false, targetEntity)
- Le use nécessaire pour les annotations @ORM est en place.
- Ton code devra être disponible sur un repository GitHub

# quest_symfony_7
07 - Symfony : Récupérer des données stockées avec Doctrine

***FindBy() : récupérer plusieurs objets avec des filtres***

Tu as utilisé pour le moment les méthodes findAll() et findOneBy(). Il est temps pour toi de mettre en pratique la méthode findBy(). Le principe reste identique à la méthode findOneBy(), mais au lieu de récupérer strictement un seul tuple, tu en récupères plusieurs liés à une catégorie donnée. De plus n’oublie pas, tu peux ajouter d’autres paramètres à cette méthode, très utile pour trier ou limiter tes résultats.

- Crée une nouvelle méthode dans la classe BlogController nommée showByCategory(string $categoryName). Celle-ci doit prendre prendre en paramètre le nom d’une catégorie de type string.
- Utilise la méthode findOneBy() sur le repository Category::class afin de récupérer l'objet Category correspondant.
- Dans la même méthode, à partir de l’objet Catégory fraîchement récupéré, appel la méthode findBy() sur le repository Article::class afin de parcourir tous les articles liés.
- Enfin, ajoutes une limite de 3 articles et un tri par id décroissant à la récupération des articles.
- Crée une nouvelle vue templates/blog/category.html.twig qui affichera tous les articles récupérés avec leurs id, titres et contenus.

***Critères de validation***
- Une nouvelle méthode showByCategory(string $categoryName) a été créée dans le controller BlogController.
- La route de cette méthode sera sous la forme : @Route("/category/{category}", name="show_category").
- Cette méthode retourne un tableau d'articles récupéré par une méthode de type findBy(), en limitant le nombre de résultats à 3, le tout trié par id décroissant.
- Un nouveau fichier a été créé templates/blog/category.html.twig.
- Ce fichier bouclera sur tous les articles afin d'afficher l'id, le titre et le contenu de chaque itération.
- L'URL http://localhost:8000/blog/category/javascript est fonctionnelle et renvoie bien tous les articles liés à la catégorie Javascript, ajoutée en début de quête.
- Ton code devra être disponible sur un repository GitHub

# quest_symfony_8
08 - Symfony : Les relations bidirectionnelles avec Doctrine

***Titre du challenge***

Votre mission, si vous l'acceptez, sera de créer une relation bidirectionnelle entre tes articles et tes catégories.

Tu devras créer en BDD plusieurs articles (une dizaine) et plusieurs catégories (environ 3).

Reprend la méthode showByCategory(string $categoryName) et modifie la récuperation en 2 temps des articles d’une categorie en utilisant l’appel à $category->getArticles().

Exceptionnellement, tu peu conserver ton vieux code en commentaire pour comparer les 2 techniques.

***Critères de validation :***
- Rendre la quête avec un repository GitHub
- Avoir les deux classes Article et Category
- Les annotations inversedBy et mappedBy sont présentes
- Les méthodes addArticle() et removeArticle() sont présentes dans la classe Category
- Utiliser les méthodes getArticles() et getCategory()

# quest_symfony_9
09 - Symfony : Le param converter

***Utilise un param converter***

Pour ton projet Blog, reprend dans BlogController la méthode showByCategory(string $categoryName). Tu vas devoir utiliser un param converter pour te retourner un objet Category en fonction du nom de la catégorie transmis par la route. La vue associée doit afficher comme précedement le nom de la catégorie correspondante ainsi que la liste des articles associés.

***Critères de validation :***
- Dans blogController, la méthode showByCategory() permet de récupérer un objet Category via le param converter, à partir d'un name en paramètre de route,
- Dans showByCategory(), les articles associés à la categorie sont toujours récupérés par 
l’appel à $category->getArticles();,
- La méthode rend une vue affichant le nom de la catégorie et ses articles associés.

# quest_symfony_10
10 - Symfony : Gardez la “form” !

***Créer des catégories***

Tu dois créer une page contenant un formulaire qui pourra te permettre d’ajouter une catégorie en base de données. À partir des ressources citées plus haut, à toi de définir dans un CategoryController une méthode **add()**. Celle-ci appelera une vue contenant un formulaire pertmettant de saisir les informations à fournir pour créer une nouvelle catégorie. À la soumission du formulaire, les données saisies sont *persistées* en base de données.

***Critères de validation :***
- La classe App\Form\CategoryType est présente dans le dossier src/Form.
- La route /category affiche bien le formulaire de création de catégorie.
- Le formulaire fonctionne (il crée une catégorie).
- Ton code est présent sur le même dépot github que tes précédentes quêtes Symfony.

# ques_symfony_11
11 - Symfony : Générer un CRUD

***Générons du CRUD***
Génère le CRUD pour les entités Article.

Une fois le crud créé:

- Crée plusieurs articles (au moins 4),
- Affiche tous les articles,
- Modifie plusieurs articles (au moins 2),
- Efface plusieurs articles (au moins 2)

***Critères de validation***
- Le CRUD est généré pour l’entité Article.
- L’entité Article dispose des actions de lecture, écriture et suppression.
- Les routes sont cohérentes et fonctionnelles.
- Le CRUD agit bien avec la BDD (exemple : insérer un article depuis http://localhost:8000/article/new).
- Le code est disponible sur un dépot GitHub

# quest_symfony_12
12 - Symfony : Doctrine relations “Many-To-Many”

***Affichage des tags d’un article***

Crée une page, répondant à l'appel de la route /tag/{name} et affichant les informations suivantes :
- Le nom du tag,
- La liste des articles associés à ce tag.

***Critères de validation :***
- Ton code est disponible sur github,
- Ton entité App\Entity\Tag est bien présente,
- Ta classe de migration générant les 2 nouvelles tables et les contraintes d'intégrité fonctionnent,
- La route vers la page de tag est fonctionnelle,
- Sur la page du tag, la liste des articles associés s'affiche.
- Sur la page des articles, la liste des tags associés s'affiche.
- **Bonus :** Sur la page de tag, lors du clic sur un article de la liste, l'utilisateur est redirigé vers la page de l'article sélectionné.
- **Bonus II :** Sur la page d'article, lors du clic sur un tag de la liste, l'utilisateur est redirigé vers la page du tag sélectionné.
