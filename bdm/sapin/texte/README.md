#ISI Search

##Avant-propos

	Cette partie contient la gestion de la recherche et de l'insertion de fichier texte.

##Moyens utilisés

	La partie qui s'occupe de l'insertion des mots clés dans la base de données est dans [add_text.php]. Plus précisément, le script permet, à partir d'un fichier, d'extraire les mots clés du texte contenu dans le fichier grâce aux fichiers [tree-tagger-english] et [tree-tagger-french] qui se trouvent dans le dossier [sapin/texte/cmd] et de compter le nombre d'occurences de chacun des mots. Tout est ensuite inséré dans la base de données dans cet ordre :
- Le type du fichier est inséré dans la base de données s'il n'existe pas. On récupère son identifiant.
- Le fichier est inséré en précisant son contenu (path) et son type (identifiant du type dans la bdd).
- Le texte est inséré en précisant son nom, son nombre de mot et l'identifiant du fichier qui lui correspond.
- Les mots clés sont insérés dans la table [words].
- Enfin, on lie les mots avec le texte en insérant dans la table [texts_keywords] pour chaque mot clé, l'identifiant du mot et celui du texte auquel il est associé et le nombre d'occurence de chaque mot.
3 types de fichiers utilisable : .pdf, .odt et .txt (on peut aussi utiliser un .doc avec le même traitement que celui du .odt)

	La partie qui s'occupe de la recherche pertinente des fichiers se situe dans [search.php]. L'amélioration de la recherche passe par l'amélioration de la requête SQL. Celle-ci est commenté pour chaque sous-requête. Contrairement à l'apparence de la requête, le principe est simple : on récupère le nom du fichier et son identifiant pour tout mot commençant par [le mot] rentré par l'utilisateur. Les fichiers sont triés par pertinence (par nombre d'occurences du mot recherché decroissant)

## Tâches restantes

	Les améliorations qu'il reste à faire sont les suivantes :
- Réduire le nombre de mots clés en limitant les mots à ajouter aux noms communs, adverbe et adjectif.
- Régler le problème d'encodage des mots clés
- Insérer le chemin du fichier (qui est stocké dans le dossier texte au moment de l'upload) dans la base de données plutôt que le fichier lui-même
- Pouvoir rechercher un fichier à partir d'une phrase (ou un groupe de mots) en plus des mots clés
- Pouvoir rechercher plusieurs mots (en vérifiant que le groupe de mot complet n'est dans aucun fichier) en faisant une recherche pour chaque mot (en évitant les doublons)
- (Optionnel) Pouvoir télécharger le fichier trouvé.

## Indication et idées pour la résolution

- Le script s'occupant de décomposer le texte en mots clés est capable de différencier les [types de mots] (verbe, pronom,...) Il faut utiliser cela pour limiter les mots clés à l'essentiel (le code-test commenté à la [ligne 75 de add_text.php] permet de voir comment sont représentés les types de mots)
- Pour l'encodage, utiliser [tree-tagger-french-utf8] à la place de [tree-tagger-french]
- La partie à modifier pour insérer le chemin du fichier plutôt que le fichier lui-même se situe à la ligne 114.
- Plusieurs solutions sont possible pour la recherche de phrase ou de groupe de mots. L'une d'entre elles consiste à ajouter un champ [contents] dans la table [file] pour stocker le text (non crypté en base 64) et utiliser la requête SELECT name, file WHERE file IN (SELECT id_file FROM files WHERE content LIKE '%".$_POST['field']."%') qui peut se traduire comme "Je veux les noms et identifiants des fichier des textes dont le fichier contient $_POST['field'].
- Pour pouvoir télécharger un fichier parmi les résultats trouvés, il faut tout d'abord les mettre sous forme de lien (<a href>) et de mettre dans href le lien vers un nouveau fichier php, par exemple getfile.php comme ceci : echo '<a href="getfile.php?id_file='.$id_file.'"> ($id_file est correspond à $row[1] d'après la requête du fichier [search.php]. Le fichier [search.php] fera juste un "SELECT path FROM files where id_file = $_GET['id_file']" et permettra à l'utilisateur de télécharger le fichier qui l'intéresse
- Pour la recherche de plusieurs mots, il faut "spliter" la chaine donnée en entrée avec la fonction php [explode] qui renverra un tableau.
  $tab = explode(" ", $_POST['field'])
  for($i = 0 ; $i < sizeof($tab) ; $i++)
     /* utiliser la requete existante en remplacant $_POST['field'] par $tab[$i] */
