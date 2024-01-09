<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Scooby Gang" />
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Créer un compte</title>
    <script>
        function validateForm() {
            var isValid = true;

            // Vérifie la validité du nom 
            var errorMessage = document.getElementById('surnameError');
            var input = document.getElementById('surname');
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
        <h1>Chronotravel</h1>
    </header>
    <main id="connection">
        <form onsubmit="return validateForm()" action="" method="post">
            <div>
                <p>
                    <label for="surname">Nom</label>
                    <input id="surname" type="text" name="surname" value="" required>
                </p>
                <span id="surnameError"></span>
            </div>
            <div>
                <p>
                    <label for="firstName">Prénom</label>
                    <input id="firstName" type="text" name="firstName" value="" required>
                </p>
                <span id="firstNameError"></span>
            </div>
            <div>
                <p>
                    <label for="login">Identifiant</label>
                    <input id="login" type="text" name="login" value="" required>
                </p>
                <span id="loginError"></span>
            </div>
            <div>
                <p>
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password" value="" required>
                </p>
                <span id="passwordError"></span>
            </div>
            <div>
               <p>
                    <label for="mail">E-mail</label>
                    <input id="mail" type="email" name="mail" value="" required>
                </p> 
                <span id="mailError"></span>
            </div>
            <button type="submit" name="create">Créer mon compte</button>
        </form>
        <p>Vous avez déjà un compte ?<a href="connection.php">Connectez vous !</a></p>
    </main>
    <?php include(__DIR__.'/footer.viewpart.html')?>
</body>
</html>
