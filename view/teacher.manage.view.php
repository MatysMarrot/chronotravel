<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Salle d'attente</title>
      <link rel="stylesheet" type="text/css" href="../../style.css">
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
            <h1>Gestion des élèves</h2>
            <label for="classe-select">Classe:</label>
                <select name="classe" id="classe-select">
                    <option value="classe1">Classe 1</option>
                    <option value="classe2">Classe 2</option>
                    <option value="classe3">Classe 3</option>
                </select>
            <table>
                     
                        <tr>
                            <td>Titouan Kevin</td>                             
                            <td><button type="submit">ACTION</button></td>
                        </tr>    
                        <tr>
                            <td>Titouan KevinTitouan KevinTitouan Kevin</td>                             
                            <td><button type="submit">ACTION</button></td>
                        </tr>    
                </table>
            
        </main>

        <footer>
            <?php include(__DIR__.'/footer.viewpart.php'); ?>
        </footer>
    </body>
</html>