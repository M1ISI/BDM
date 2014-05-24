<?php

    echo "<form method='post' action='recherche_media.php' enctype='multipart/form-data'>\n";
    echo "  <input type='file' id='media_input' name='media_input' />\n";
    echo "  <input type='submit' id='submit_media' name='submit_media' />\n";
    echo "</form>\n";

    // Récupère le (vrai) mimetype du média correspondant au chemin en paramètre
    // /!\ Si le fichier en entrée est un fichier texte vide, la retour de file -i sera inode.
    function getFileType($filePath)
    {
        /*Pour le debug
        echo "<pre>\n";
        print_r(exec("pwd"));
        echo "</pre>\n";*/

        // Récupération du type mime par l'intermédiaire d'un appel système (non optimal, mais mieux que la plupart des fonctions php ne testant que l'extension)
        $buf = exec("file -i ".$filePath);
        $mimetype = explode(" ", $buf);

        /*Pour le debug
        echo "<pre>\n";
        print_r($buf);
        echo "</pre>\n";*/

        if (!isset($mimetype) || count($mimetype) < 2)
            die("Error : mimetype has a wrong structure\n");

        // $m_type contient le type 'global' (image, text,...) et $m_type_accurate contient le type précis (png, x-php, plain,...).
        // $mimetype[1] contient le résultat de la commande unix file -i, mais tronquée à la seconde partie, c-a-d un truc du genre text/plain;
        list($m_type, $m_type_accurate) = explode("/", $mimetype[1]);

        // On enlève le ; final s'il y en a un
        if ($m_type_accurate[ strlen($m_type_accurate) - 1 ] == ';')
            $m_type_accurate = substr($m_type_accurate, 0, -1);

        /*Pour le debug
        echo "<pre>\n";
        print_r($m_type." -- ".$m_type_accurate);
        echo "</pre>\n";*/

        $media_type = array("m_type" => $m_type, "m_type_accurate" => $m_type_accurate);
        return $media_type;
    }

    // Redirige vers le code effectuant le traitement. Cela dépend du média testé
    // /!\ attention aux droits d'accès au fichier temporaire contenant le fichier uploadé
    function applyCorrectTreatment($filePath)
    {
        $data = getFileType($filePath);
        switch($data['m_type'])
        {
            // -> textes
            case "text" :
                // ~> point d'entrée du traitement des textes <~
                echo "<p>text</p>\n";
            break;

            // -> texte vide <= utile ?
            case "inode" :
                // ~> point d'entrée du traitement des textes vides <~ à mon avis sans utilité
                echo "<p>empty text</p>\n";
            break;

            // -> images
            case "image" :
                // ~> point d'entrée du traitement des images <~
                echo "<p>image</p>\n";
                //exec("./sapin/images/squelettisation/squelette.c " . $filePath);
                //include(sapin/images/couleurs/color.php);
                //exec("python sapin/images/faceDetector/findFace.py " . $filePath);
                //si visages :
                //exec("python sapin/images/faceDetector/Facecompare.py");
                //sinon (voire même dans tous les cas)
                //exec(...comparaison d'images...);
            break;

            case "application" :
                switch($data['m_type_accurate'])
                {
                    // -> pdf
                    case "pdf" :
                        // ~> point d'entrée du traitement des pdf <~
                        echo "<p>pdf</p>\n";
                    break;

                    // -> odt
                    case "vnd.oasis.opendocument.text" :
                    // ~> point d'entrée du traitement des fichiers odt <~
                        echo "<p>odt</p>\n";
                    break;

                    default :
                        echo "<p>Unknown file type</p>\n";
                }
            break;

            // -> audio
            case "audio" :
                // ~> point d'entrée du traitement des fichiers audio <~
                echo "<p>audio</p>\n";
            break;

            default :
                echo "<p>Unknown file type</p>\n";
        }
    }

    // /!\ il ne faut pas tester si la variable $_POST[submit_media] est définie => bug O_o
    if (isset($_FILES['media_input']))
    {
        applyCorrectTreatment($_FILES['media_input']['tmp_name']);
    }

?>
