<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/utils/Utils.php");
include_once(__DIR__."/../model/SkinObject.class.php");

    //Démarrer la session
    session_start();

    //Récupérer la party
    $party=$_SESSION['party'];
    $studentsPosition = $party->getStudentPosition(); //Student1 => Case1, Student2 => Case2 etc ...
    $test = [
        "id1"=>31,
        "id2"=>15,
        "id3"=>16,
        "id4"=>31,
    ];

    arsort($studentsPosition);
    /* studentPosition[id][case][rank][gain]
     * 1er "id1"=>31,
     * 1er "id4"=>31,
     * 3eme "id3"=>16,
     * 4eme "id2"=>15,
     */

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
    * "id1"=>31, 1
    * "id4"=>31, 1
    * "id3"=>16, 3
    * "id2"=>15, 4
    */
    $tableau ="";
    $oldPosition=0;
    $rank=1;
    foreach ($studentsPosition as $student) {

        $student = $rank;
        $case = $students[$student];

        $tableau += "<tr>
                    <th>$rank</th> <th>$student->getLogin()</th> <th>$gain<img id="gain" src="chrono_coin.png" alt=""></th>
                   </tr>"
        $oldPosition=$student;
    }



    ?>