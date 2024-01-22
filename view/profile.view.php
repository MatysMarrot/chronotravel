<?php $emplacementSkin = "/assets/skin/" ?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChronoTravel - Mon Profil</title>
    <link rel="stylesheet" href="../view/style/style.profile.css">
</head>

<body>
<?php
require_once(__DIR__ . '/../controler/profile.ctrl.php');
$currentPage = 'profile';
include(__DIR__ . '/header.student.viewpart.php');
?>

<main>
    <!-- Ajout des boutons de commutation -->
    <div class="switch-buttons">
        <button class="switch-button statistics-button active" onclick="showStatistics()">Statistiques</button>
        <button class="switch-button class-button" onclick="showClassInfo()">Classe</button>
    </div>
    <!-- Ajout du tableau de bord -->
    <div class="dashboard">
        <div class="user-info">
            <!-- Insérez l'image de profil -->
            <img src="../view/img/1467684-mob1-article_m-1.png" alt="Image de Profil">
            <p>Pseudo: <?php echo $student->getLogin(); ?></p>
            <!-- Remplacez $pseudo par la variable appropriée -->
            <p>Email: utilisateur@example.com</p>
        </div>
        <div class="statistics">
            <div>
                <?php if ($allState != null): ?>
                    <h3>Parties jouées : <?= $allState->getGamePlayed() ?></h3>
                    <h3>Parties gagnées : <?= $allState->getGameWin() ?></h3>
                <?php else: ?>
                    <h3>Aucune statistique existante pour ce joueur</h3>
                <?php endif; ?>
            </div>
            <div id="chartDiv">
            </div>
        </div>

        <div class="class-info">
            <table>
                <tr>
                    <th>Classe</th>
                    <th>Prof</th>
                </tr>
                <tr>
                    <td><?php echo $className; ?></td>
                    <td><?php echo $profName; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        function showStatistics() {
            document.querySelector('.statistics').style.display = 'flex';
            document.querySelector('.class-info').style.display = 'none';
            document.querySelector('.statistics-button').classList.add('active');
            document.querySelector('.class-button').classList.remove('active');
        }

        function showClassInfo() {
            document.querySelector('.statistics').style.display = 'none';
            document.querySelector('.class-info').style.display = 'flex';
            document.querySelector('.statistics-button').classList.remove('active');
            document.querySelector('.class-button').classList.add('active');
        }
    </script>


</main>
<?php if ($allState != null): ?>
    <div class="json" style="display: none">
        <?= $allStateJSON ?>
    </div>
<?php endif; ?>
</body>
<?php if ($allState != null): ?>
    <script src="https://code.jscharting.com/2.9.0/jscharting.js"></script>
    <script src="../view/js/chart.js"></script>
<?php endif; ?>
</html>
