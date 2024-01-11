<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Salle d'attente</title>
      <link rel="stylesheet" type="text/css" href="./style/style.x.css">
    </head>

    <body>  
        <!--Header --> 
        <?php include(__DIR__.'/header.viewpart.php'); ?>

        <main>
            <h1>Gestion des élèves</h2>

            <!--Select permettant de filtrer le contenue du tableau ci-dessous --> 
            <select name="classe" id="classe-select">
                <option value="classe1">Classe 1</option>
                <option value="classe2">Classe 2</option>
                <option value="classe3">Classe 3</option>
            </select>
            
            <!--Tableau contenant les élèves de la classe sélectionner dans le selecte ci-dessus -->
            <table>     
                <tr>
                    <td>Nom Prénom</td>                             
                    <td><button type="submit">ACTION</button></td>
                </tr>    
                <tr>
                    <td>Nom Prénom</td>                             
                    <td><button type="submit">ACTION</button></td>
                </tr>    
            </table>  
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?>   
    </body>
</html>