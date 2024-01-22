<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Gestion des élèves</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">    
    </head>

    <body>  
        <!--Header --> 
        <?php include(__DIR__.'/header.student.viewpart.php'); ?>

        <main>
            <h1>Statistiques</h1>
            <h2><?=$student->getFirstname() . " ".$student->getLastname()?> (<?=$student->getLogin()?>)</h2>
            <table class="data">     
                <tr>
                    <td>Nombre de parties jouées :</td>                             
                    <td>1512</td>
                </tr>    
                <tr>
                    <td>Taux de bonnes réponses :</td>                             
                    <td>9999%</td>
                </tr>    
                <tr>
                    <td>Points forts :</td>                             
                    <td>Epoque sup à 75% de reussite</td>
                </tr>    
                <tr>
                    <td>Difficultés :</td>                             
                    <td>Epoque inf à 50% de reussite</td>
                </tr>    
            </table>  
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?>   
    </body>
</html>