<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Salle d'attente</title>
      <link rel="stylesheet" type="text/css" href="./style/style.x.css">
    </head>

    <body>
        
        <header>
            <nav>
                <ul class="ul_horizontal">
                    <li ><a class="actif" href="#">ACCUEIL</a></li>
                    <li><a href="#">MON PROFIL</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">CONTACT</a></li>
                </ul>
            </nav>
            <?php include(__DIR__.'/header.viewpart.php'); ?>

        </header>

        <main>
        <h1>Messagerie</h1>
        <section >
            <table class="messaging">
                <thead>
                    <th>Expéditeur</th>
                    <th>Objet du message</th>
                    <th>Date et heure</td> 
                </thead>
                <tbody>   
                    <tr class="message" onclick="window.location='admin.message.view.php';">
                           <td>Titouan Kevin</td> 
                           <td>Problème de gestion des élèves</td>                               
                           <td>9:21</td> 
                    </tr>
                </tbody>    
            </table>
        </section>


        </main>

        <footer>
            <?php include(__DIR__.'/footer.viewpart.php'); ?>
        </footer>
    </body>
</html>