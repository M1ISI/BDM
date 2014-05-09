<?php

    // Connexion à la base de données
    try
    {
        $pdo = new PDO('sqlite:/opt/lampp/htdocs/BDM/bdm/testBDD/test.db');
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    } catch(Exception $e) {
        echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
        die();
    }

    // A décommenter lorsque ce sera intégré dans la page principale
    //$searchValue = $_GET['recherche'];
    $searchValue = "Tr";

    // Exécution de la requête de recherche
    try 
    {
        //Changement de l'encodage. Marche pas O_o ??
        $pdo->query("PRAGMA ENCODING=\"UTF-8\"");

        //Requête de recherche préparée ne tenant pas compte de la casse
        $stmt = $pdo->prepare("SELECT m.TITLE, m.AUTHOR, m.YEAR, s.STYLE FROM MUSICS m, STYLES s WHERE (s.ID_STYLE = m.STYLE) AND (m.AUTHOR LIKE :searchValue OR m.TITLE LIKE :searchValue OR m.YEAR LIKE :searchValue_year OR s.STYLE LIKE :searchValue) COLLATE NOCASE");

        //Remplissemnt de la requête, puis exécution.
        $stmt->execute(array('searchValue' => '%'.$searchValue.'%', 'searchValue_year' => $searchValue));
        $result = $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Impossible d'accéder aux résultats de la requête : ".$e->getMessage();
        die();
    }

    // Affichage des résultats => pour le debug
    echo "<pre>\n";
    print_r($result);
    echo "</pre>\n";
?>