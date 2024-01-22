<?php $emplacementSkin = "/assets/skin/"?>


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
        <div class="switch-buttons">
            <button class="switch-button statistics-button active" onclick="showStatistics()">Statistiques</button>
            <button class="switch-button class-button" onclick="showClassInfo()">Classe</button>
        </div>

        <div class="dashboard">
    <div class="user-info">
        
    

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
    
    <p>Pseudo: <?php echo $pseudo; ?></p>
    <p>ID : <?php echo $userId; ?></p>
</div>
</div>
            
            
            <div class="statistics">
                    <table>
                        <tr>
                            <th>Parties Jouées</th>
                            <th>Parties Gagnées</th>
                        </tr>
                        <tr>
                            <td>50</td>
                            <td>30</td>
                        </tr>
                    </table>
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
        </div>
    </main>
</body>

</html>
