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
        <h1>Nous contacter</h1>
        <div class="formulaire">
            <p>Pour toute question, contactez nous par mail 
            <a href="mailto:chronotravel@game.fr">chronotravel@game.fr</a>, ou en utilisant le formulaire ci-dessous: </p>
            <form> <!--Le mail doit être renseigné dans le message que nous recevons -->
                <label for="email">Email :</label>
                <input type="text" id="email" name="email" required>
                
                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>
                <!-- Le formulaire doit pouvoir envoyer un mail à notre adresse email -->
                <input type="submit" value="Envoyer"> 
            </form>
        </div>
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?> 
    </body>
</html>