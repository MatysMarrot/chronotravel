<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Scooby Gang" />
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Se connecter</title>
</head>
<body>
    <header class="connectionpage">
        <h1>Chronotravel</h1>
    </header>
    <main id="connection">
        <form action="" method="post">
            <p>
                <label>Identifiant</label>
                <input id="login" type="text" name="login" value="" required>
            </p>
            <p>
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" value="" required>
            </p>
            <button type="submit" name="connect">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte ? <a href="createaccount.php">Créez en vous un !</a></p>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html')?>
</body>
</html>
