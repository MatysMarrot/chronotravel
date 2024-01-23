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

    //Tableau des students trier du premier au dernier (1er... 4eme)
    $classement=[
        1=>,
        2,
        3,
        4
    ];

    // Création du tableau des scores
    for($i=0; $i<4;$i++){
        echo "<tr>
                    <th>$classement </th> <th>$student</th> <th>$gain<img id="gain" src="chrono_coin.png" alt=""></th>
              </tr>";
    }


    ?>