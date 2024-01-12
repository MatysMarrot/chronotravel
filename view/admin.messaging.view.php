<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Messagerie</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">
    </head>

    <body>
        <!--Header --> 
        <?php include(__DIR__.'/header.viewpart.php'); ?>

        <main>
        <h1>Messagerie</h1>
        <section >
            <table class="messaging">
                <thead>
                    <th>Expéditeur</th>
                    <th>Objet du message</th>
                    <th>Date et heure</th> 
                    <th>Lu</th>
                </thead>
                <tbody>   
                    <tr class="message" onclick="window.location='admin.message.view.php';">
                           <td>Titouan Kevin</td> 
                           <td>Problème de gestion des élèves</td>                               
                           <td>9:21</td>
                           <td>X</td>
                    </tr>
                    <tr class="message" onclick="window.location='admin.message.view.php';">
                           <td>heheh jajaja</td> 
                           <td>Problème de gestion des élèves</td>                               
                           <td>9:21</td>
                           <td></td>
                    </tr>
                </tbody>    
            </table>
        </section>

        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?> 
    </body>
</html>