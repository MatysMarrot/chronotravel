<?php
    include_once(__DIR__ . "/../framework/view.class.php");
    include_once(__DIR__ . "/../model/DAO.class.php");
    include_once(__DIR__ . "/../model/Gain.class.php");
    include_once(__DIR__ . "/../model/Student.class.php");
    include_once(__DIR__ . "/utils/Utils.php");
    include_once(__DIR__ . "/../model/SkinObject.class.php");

    //Démarrer la session
    session_start();
    $view = new View();
    $emplacementSkin = "/assets/skin/";
    $emplacementPosition = "/assets/position/";
    //Récupérer la party
    $party = $_SESSION['party'];

    //$studentsPosition = $party->getStudentPosition(); //Student1 => Case1, Student2 => Case2 etc ...

    $studentsPosition = [
        112 => ["case" => 31, "classement" => 0, "gain" => 1],
        107 => ["case" => 15, "classement" => 0, "gain" => 4],
        109 => ["case" => 16, "classement" => 0, "gain" => 3],
        128 => ["case" => 31, "classement" => 0, "gain" => 1],
    ];

    uasort($studentsPosition, function ($a, $b) {
        if ($a['classement'] == $b['classement']) {
            return $b['case'] - $a['case'];
        }
        return $a['classement'] - $b['classement'];
    });

    /*
    * "id1" => ["case" => 31, "classement" =>0, "gain"=> 0],
    * "id4" => ["case" => 31, "classement" =>0, "gain"=> 0],
    "id3" => ["case" => 16, "classement" =>0, "gain"=> 0],
    "id2" => ["case" => 15, "classement" =>0, "gain"=> 0],
    */

    //Gestion des égalités
    $oldPosition = 0;
    $i = 1;
    foreach ($studentsPosition as $id => $student) {
        //Si l'étudiant actuel a la même position que l'étudiant précédent
        if ($student['case'] == $oldPosition) {
            $studentsPosition[$id]['classement'] = $studentsPosition[$prevId]['classement']; // L'étudiant a le même rang que le précédent
        } else {
            $studentsPosition[$id]['classement'] = $i;
        }
        $oldPosition = $student['case']; //Récupérer la position de l'étudiant pour comparer avec le suivant
        $prevId = $id; //id précédent
        $i++;
    }
    /* $studentPosition
    * "id1" => ["case" => 31, "classement" =>1, "gain"=> 1],
    * "id4" => ["case" => 31, "classement" =>1, "gain"=> 1],
    "id3" => ["case" => 16, "classement" =>3, "gain"=> 3],
    "id2" => ["case" => 15, "classement" =>4, "gain"=> 4],
    */
    $gainCalculator = new Gain();


    $gainCalculator->calculateGainsByClassement($studentsPosition);
    // Affichage des résultats + Skin
    foreach ($studentsPosition as $id => $student) {
        $currentStudent = Student::readStudent($id);
        $currentSkin = SkinObject::getCurrentSkinOfPlayer($id);
        $tableau .= "
            <section>
                <ul class=\"ul_horizontal\">
                    <li><img id=\"positionClassement\" src=\"{$emplacementPosition}pos{$student['classement']}.png\" alt=\"position\"></li>
                    <li><h3 class=\"pseudo\">{$currentStudent->getLogin()}</h3></li>
                </ul>
        
                <div class=\"div_skin\">
                    <img id=\"skin\" src=\"{$emplacementSkin}{$currentSkin[5]->getLocation()}\" alt=\"personnage\">";

                if ($currentSkin[2] != null) {
                    $tableau .= "<img id=\"shirt\" src=\"{$emplacementSkin}{$currentSkin[2]->getLocation()}\" alt=\"Tee-shirt\">";
                }
                if ($currentSkin[1] != null) {
                    $tableau .= "<img id=\"hair\" src=\"{$emplacementSkin}{$currentSkin[1]->getLocation()}\" alt=\"Cheveux\">";
                }
                if ($currentSkin[0] != null) {
                    $tableau .= "<img id=\"top\" src=\"{$emplacementSkin}{$currentSkin[0]->getLocation()}\" alt=\"Chapeau\">";
                }
                if ($currentSkin[3] != null) {
                    $tableau .= "<img id=\"pants\" src=\"{$emplacementSkin}{$currentSkin[3]->getLocation()}\" alt=\"Pantalon\">";
                }
                if ($currentSkin[4] != null) {
                    $tableau .= "<img id=\"shoes\" src=\"{$emplacementSkin}{$currentSkin[4]->getLocation()}\" alt=\"Chaussures\">";
                }
                $tableau .= "
                </div>
                
                <ul class=\"ul_horizontal\">
                    <li><h3>{$student['gain']}</h3></li>
                    <li><img id=\"gain\" src=\"../view/img/chrono_coin.png\" alt=\"coin\"></li>
                </ul>
            </section>";
    }
    $view->assign("tableau", $tableau);
    $view->display('score.board.view.php');

?>