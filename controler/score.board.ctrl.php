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
    //Récupérer la party
    $party = $_SESSION['party'];
    //$studentsPosition = $party->getStudentPosition(); //Student1 => Case1, Student2 => Case2 etc ...

    $studentsPosition = [
        "id1" => ["case" => 31, "classement" => 0, "gain" => 1],
        "id2" => ["case" => 15, "classement" => 0, "gain" => 4],
        "id3" => ["case" => 16, "classement" => 0, "gain" => 3],
        "id4" => ["case" => 31, "classement" => 0, "gain" => 1],
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
    /*
    * "id1" => ["case" => 31, "classement" =>1, "gain"=> 1],
    * "id4" => ["case" => 31, "classement" =>1, "gain"=> 1],
    "id3" => ["case" => 16, "classement" =>3, "gain"=> 3],
    "id2" => ["case" => 15, "classement" =>4, "gain"=> 4],
    */
    $gainCalculator = new Gain();


    $gainCalculator->calculateGainsByClassement($studentsPosition);
    // Affichage des résultats
    foreach ($studentsPosition as $id => $student) {
        $tableau .= "<tr>
                            <th>{$student['classement']}</th>
                            <th>{$id}</th>
                            <th>{$student['gain']}<img id=\"gain\" src=\"../view/img/chrono_coin.png\" alt='coin'></th>
                         </tr>";
    }

    $view->assign("tableau", $tableau);
    $view->display('score.board.view.php');

?>