<?php $emplacementSkin = "/assets/skin/"?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChronoTravel - Mon Profil</title>
    <link rel="stylesheet" href="../view/style/style.css">
</head>
<body>
    <?php
    $currentPage = 'profile';
    include(__DIR__ . '/header.student.viewpart.php');
    ?>
    <main class="profil">
        <div class="switch-buttons">
            <button class="statistics-button active" onclick="showStatistics()">Statistiques</button>
            <button class="class-button" onclick="showClassInfo()">Classe</button>
        </div>
        <div>
            <div class="dashboard">
                <div class="div_skin">
                    <img id="skin" src="<?=$emplacementSkin?>skintest.png" alt="personnage">
                    <?php if($currentSkin[2] != null):?>
                        <img id="shirt" src="<?=$emplacementSkin.$currentSkin[2]->getLocation()?>" alt="Tee-shirt">
                    <?php endif; ?>
                    <?php if($currentSkin[1] != null):?>
                        <img id="hair" src="<?=$emplacementSkin.$currentSkin[1]->getLocation()?>" alt="Cheveux">
                    <?php endif; ?>
                    <?php if($currentSkin[0] != null):?>
                        <img id="top" src="<?=$emplacementSkin.$currentSkin[0]->getLocation()?>" alt="Chapeau">
                    <?php endif; ?>
                    <?php if($currentSkin[3] != null):?>
                        <img id="pants" src="<?=$emplacementSkin.$currentSkin[3]->getLocation()?>" alt="Pantalon">
                    <?php endif; ?>
                    <?php if($currentSkin[4] != null):?>
                        <img id="shoes" src="<?=$emplacementSkin.$currentSkin[4]->getLocation()?>" alt="Chaussures">
                    <?php endif; ?>
                </div>
                <p>Pseudo: <?php echo $student->getLogin(); ?></p>
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
                <div id="chartDiv"></div>
            </div>
            <div class="class-info" style="display: none">
                <?php if ($classAndTeacher != null): ?>
                    <table>
                        <tr>
                            <th>Classe</th>
                            <th>Professeur</th>
                        </tr>
                        <tr>
                            <td><?= $classAndTeacher["className"] ?></td>
                            <td><?= $classAndTeacher["teacherName"] ?></td>
                        </tr>
                    </table>
                <?php else: ?>
                    <h3><?= $classError?></h3>
                <?php endif; ?>
            </div>
        </div>
        <script>
            function showStatistics() {
                document.querySelector('.statistics').style.display = 'block';
                document.querySelector('.class-info').style.display = 'none';
                document.querySelector('.statistics-button').classList.add('active');
                document.querySelector('.class-button').classList.remove('active');
            }
            function showClassInfo() {
                document.querySelector('.statistics').style.display = 'none';
                document.querySelector('.class-info').style.display = 'block';
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
