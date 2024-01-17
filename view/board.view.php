<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Gestion des élèves</title>
      <link rel="stylesheet" type="text/css" href="../view/style/board.style.css">   
    </head>

    <body>  
        <!--Header 
        --> 

        <main>
        <a id="return" href="#"><-</a>
        <table class="board">
            <!--Board -->
                <?php 
                    $x=0;
                    for($i =0; $i<2; $i++){
                        if($i%2){ 
                            //Sens : Droite à gauche
                            //ligne
                            echo "<tr>";
                            
                            for ($j = 0; $j < 10; $j++) {
                                printf("<td id=\"%d\" class=\"board_available\"></td>", $x+(9-$j));
                            }
                            $x=$x+10;
                            echo "</tr>";

                            //colonne
                            for ($j = 0; $j < 1; $j++) {
                                //Descendre à gauche
                                echo "<tr>";
                                echo "<td id=\"$x\" class=\"board_available\"></td>";
                                $x++;
                                for ($k = 0; $k < 9; $k++) {
                                    echo "<td class=\"board_none\"></td>";
                                }
                                echo "</tr>"; 
                            }
                        }else{
                            //Sens : Gauche à droite
                            //ligne
                            echo "<tr>";
                            for ($j = 0; $j < 10; $j++) {
                                echo "<td id=\"$x\" class=\"board_available\"></td>";
                                $x++;
                            }
                            echo "</tr>";
                            // Descendre à droite
                            for ($j = 0; $j < 1; $j++) {
                                echo "<tr>";
                                for ($k = 0; $k < 9; $k++) {
                                    echo "<td class=\"board_none\"></td>";
                                }
                                echo "<td id=\"$x\" class=\"board_available\"></td>";
                                $x++;
                                echo "</tr>";
                            }  
                        }
                    }
                    //Derniere ligne
                    echo "<tr>";
                    for ($i = 0; $i < 10; $i++) {
                        echo "<td id=\"$x\" class=\"board_available\"></td>";
                        $x++;
                    }
                    echo "</tr>";
                ?>
                
            </table>  
        </main>
    </body>
</html>