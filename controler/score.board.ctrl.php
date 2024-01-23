<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Gain.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/utils/Utils.php");
include_once(__DIR__."/../model/SkinObject.class.php");

    //Démarrer la session
    session_start();
    $view = new View();
    //Récupérer la party
    $party=$_SESSION['party'];
    //$studentsPosition = $party->getStudentPosition(); //Student1 => Case1, Student2 => Case2 etc ...


    $studentsPosition = [
        "id1" => ["case" => 31, "classement" =>0, "gain"=> 0],
        "id2" => ["case" => 15, "classement" =>0, "gain"=> 0],
        "id3" => ["case" => 16, "classement" =>0, "gain"=> 0],
        "id4" => ["case" => 31, "classement" =>0, "gain"=> 0],
    ];
    var_dump($studentsPosition);
    uasort($studentsPosition, function ($a, $b) {
        if ($a['classement'] == $b['classement']) {
            return $b['case'] - $a['case'];
        }
        return $a['classement'] - $b['classement'];
    });
    var_dump($studentsPosition);
    /*
    * "id1" => ["case" => 31, "classement" =>0, "gain"=> 0],
    * "id4" => ["case" => 31, "classement" =>0, "gain"=> 0],
    "id3" => ["case" => 16, "classement" =>0, "gain"=> 0],
    "id2" => ["case" => 15, "classement" =>0, "gain"=> 0],
    */

    //Gestion des égalités
    $oldPosition = 0;
    $i=1;
    foreach ($studentsPosition as $id => $student) {
        // Si l'étudiant actuel a la même position que l'étudiant précédent
        if ($student['case'] == $oldPosition) {
            $studentsPosition[$id]['classement'] = $studentsPosition[$prevId]['classement']; // L'étudiant a le même rang que le précédent
        } else {
            $studentsPosition[$id]['classement'] = $i;
        }
        $oldPosition = $student['case']; // Récupérer les 'case' de l'étudiant pour les comparer avec le suivant
        $prevId = $id; // Mise à jour de la variable pour l'ID précédent
        $i++;
    }
    var_dump($studentsPosition);
    /*
    * "id1" => ["case" => 31, "classement" =>1, "gain"=> 0],
    * "id4" => ["case" => 31, "classement" =>1, "gain"=> 0],
    "id3" => ["case" => 16, "classement" =>3, "gain"=> 0],
    "id2" => ["case" => 15, "classement" =>4, "gain"=> 0],
    */
    foreach ($studentsPosition as $id => $student) {
        $tableau .= "<tr>
                        <td>{$student['classement']}</td>
                        <td>{$id}</td>
                        <td>{$student['gain']}<img id=\"gain\" src=\"chrono_coin.png\" alt='coin'></td>
                     </tr>";
    }

        $view->assign("tableau",$tableau);
        $view->display('score.board.view.php');


/*
//Gestion des égalité
$oldPosition=0;
for ($i=0; $i< count($studentsPosition); $i++){
//Si l'étudiant actuel a la même position que l'étudiant précédent
if ($studentsPosition[$i][2]== $oldPosition){
$studentsPosition[$i][3]= $studentsPosition[$i-1][3]; //Le student a le même rank que le précédent
}else{
$studentsPosition[$i][3]= $i;
}
$oldPosition=$studentsPosition[$i][2]; //Récuperer les case de l'étudiant pour le comparer avec le suivant
}
/*
* "id1" => ["case" => 31, "classement" =>1, "gain"=> 0],
* "id4" => ["case" => 31, "classement" =>1, "gain"=> 0],
"id3" => ["case" => 16, "classement" =>3, "gain"=> 0],
"id2" => ["case" => 15, "classement" =>4, "gain"=> 0],
*/

/************************************************
$gainCalculator = new Gain();

// Initialiser la variable pour stocker le classement précédent
$oldPosition = 0;
var_dump($studentsPosition);
foreach ($studentsPosition as $id => $student) {
    // Si l'étudiant actuel a la même position que l'étudiant précédent
    if ($student['classement'] == $oldPosition) {
        $studentsPosition[$id]['gain'] = $studentsPosition[$prevId]['gain']; // L'étudiant a le même gain que le précédent
    } else {
        // Obtenir les gains avec getGainRank()
        $idsWithSameRank = array_keys(array_filter($studentsPosition, function ($s) use ($student) {
            return $s['classement'] == $student['classement'];
        }));

        // Utiliser la méthode getGainRank pour calculer le gain pour ce classement
        //$studentsPosition[$id]['gain'] = $gainCalculator->getGainRank($idsWithSameRank, ["1", "3", "2", "4"]);
    }

    // Mettre à jour la variable pour le classement précédent
    $oldPosition = $student['classement'];
    $prevId = $id;
}
var_dump($studentsPosition);
// Afficher les résultats
foreach ($studentsPosition as $id => $student) {
    echo "$id => [" . implode(', ', $student) . "]\n";
}

**********************************************************/
//Parcourir rank
//obtenir les gains avec getGainRank()
/*
* "id1" => ["case" => 31, "classement" =>1, "gain"=> 87],
* "id4" => ["case" => 31, "classement" =>1, "gain"=> 87],
"id3" => ["case" => 16, "classement" =>3, "gain"=> 50],
"id2" => ["case" => 15, "classement" =>4, "gain"=> 35],
*/
    ?>