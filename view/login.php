<?php 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Scooby Gang" />
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <title>Se connecter</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            passwordInput.type === 'password' ? passwordInput.type = 'text' : passwordInput.type = 'password'; 
        }
    </script>
</head>
<body>
    <header class="connectionpage">
        <a href="">Règles</a>
        <a href="landingpage.php"><h1>Chronotravel</h1></a>
        <a href="">FAQ</a>
    </header>
    <main class="connection">
        <form action="../controler/login.crtl.php" method="post">
            <p>
                <label>Identifiant</label>
                <input id="login" type="text" name="login" value="" required>
                
            </p>
            <p>
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" value="" required>
                <button type="button" id="togglePassword" onclick="togglePasswordVisibility()"><i class="material-symbols-outlined" style="font-size:20px;" >visibility</i></button>
            </p>
            <p> <?=$error?></p>
            <button type="submit" name="connect">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte ? <a href="createaccount.ctrl.php">Créez en vous un !</a></p>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html')?>
</body>
</html>
