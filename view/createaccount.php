<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Scooby Gang" />
    <link rel="stylesheet" type="text/css" href="../view/style/login.css">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            passwordInput.type === 'password' ? passwordInput.type = 'text' : passwordInput.type = 'password'; 
        }

        function validateForm() {
            var isValid = true;

            // Vérifie la validité du nom 
            var errorMessage = document.getElementById('lastnameError');
            var input = document.getElementById('lastname');
            // Vérifier que le nom ne contient pas des caractères autres que des minuscules, majuscules et accents ou tiret
            if (/[^a-zA-ZÀ-ÖØ-öø-ÿ-]/.test(input.value)) {
                errorMessage.innerHTML = 'Votre nom ne peut contenir des caractères spéciaux ou des chiffres.';
                isValid = false;
            } else {
                errorMessage.innerHTML = '';
            }

            // Vérifie la validité du prénom 
            errorMessage = document.getElementById('firstNameError');
            input = document.getElementById('firstName');
            // Vérifier que le prénom ne contient pas des caractères autres que des minuscules, majuscules et accents ou tiret
            if (/[^a-zA-ZÀ-ÖØ-öø-ÿ-]/.test(input.value)) {
                errorMessage.innerHTML = 'Votre prénom ne peut contenir des caractères spéciaux ou des chiffres.';
                isValid = false;
            } else {
                errorMessage.innerHTML = '';
            }

            // Vérifie la validité du login 
            errorMessage = document.getElementById('loginError');
            input = document.getElementById('login');
            // Vérifier que le login ne contient pas des caractères autres que des minuscules, majuscules ou des chiffres
            if (/[^a-zA-Z0-9]/.test(input.value)) {
                errorMessage.innerHTML = 'Votre identifiant ne peut contenir de caractères spéciaux ou des accents.';
                isValid = false;
            } else {
                errorMessage.innerHTML = '';
            }

            // Vérifie la validité du password 
            errorMessage = document.getElementById('passwordError');
            input = document.getElementById('password');
            // Vérifier si le mot de passe contient au moins une minuscule, une majuscule, un chiffre, un caractère spécial et au moins 8 caractères
            if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/.test(input.value)) {
                errorMessage.innerHTML = 'Votre mot de passe doit contenir au minimum 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial.';
                isValid = false;
            } else {
                errorMessage.innerHTML = '';
            }

            // Vérifie la validité du mail 
            errorMessage = document.getElementById('mailError');
            input = document.getElementById('mail');
            // Vérifier si le format de l'adresse mail est valide 
            if (!/^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/.test(input.value)) {
                errorMessage.innerHTML = 'Votre e-mail doit être de la forme : prenom@exemple.com';
                isValid = false;
            } else {
                errorMessage.innerHTML = '';
            }
            return isValid;
        }
    </script>
</head>
<body>
    <header class="connectionpage">
        <a href="">Règles</a>
        <a href="landingpage.php"><h1>Chronotravel</h1></a>
        <a href="contact.view.php">Contact</a>
    </header>
    <main class="connection">
        <form onsubmit="return validateForm()" action="../controler/createaccount.ctrl.php" method="post">
            <div>
                <p>
                    <label for="lastname">Nom</label>
                    <input id="lastname" type="text" name="lastname" value="" required>
                </p>
                <span id="lastnameError" class="error"></span>
            </div>
            <div>
                <p>
                    <label for="firstName">Prénom</label>
                    <input id="firstName" type="text" name="firstName" value="" required>
                </p>
                <span id="firstNameError" class="error"></span>
            </div>
            <div>
                <p>
                    <label for="login">Identifiant</label>
                    <input id="login" type="text" name="login" value="" required>
                </p>
                <span id="loginError" class="error"></span>
                <p> <?=$loginError?></p>
            </div>
            <div>
                <p>
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password" value="" required>
                    <button type="button" id="togglePassword" onclick="togglePasswordVisibility()"><i class="material-symbols-outlined" style="font-size:20px;" >visibility</i></button>
                </p>
                <span id="passwordError" class="error"></span>
            </div>
            <div>
               <p>
                    <label for="mail">E-mail</label>
                    <input id="mail" type="email" name="mail" value="" required>
                </p> 
                <span id="mailError" class="error"></span>
            </div>
            <button type="submit" name="create">Créer mon compte</button>
        </form>
        <p>Vous avez déjà un compte ? <a href="login.php">Connectez vous !</a></p>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html')?>
</body>
</html>