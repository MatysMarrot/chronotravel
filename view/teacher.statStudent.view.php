<!DOCTYPE html>
<html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Gestion des élèves</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /></head>
    </head>
    <body>
        <?php $currentPage = 'manage';
        include(__DIR__.'/header.teacher.viewpart.php'); ?>
        <main class="teacherStat">
            <a href="../controler/teacher.manage.ctrl.php"><i class="material-symbols-outlined">arrow_back</i></a>
            <h1>Statistiques</h1>
            <h2><?=$student->getFirstname(). " ".$student->getLastname()?> (<?=$student->getLogin()?>)</h2>
            <div class="game">
                <?php if ($allStat != null): ?>
                    <h3>Parties jouées : <?= $allStat->getGamePlayed() ?></h3>
                    <h3>Parties gagnées : <?= $allStat->getGameWin() ?></h3>
                <?php else: ?>
                    <h3>Aucune statistique existante pour ce joueur. Le joueur n'a jamais joué</h3>
                <?php endif; ?>
            </div>
            <div id="chartDiv"></div>
        </main>
        <?php include(__DIR__.'/footer.viewpart.html'); ?>
        <?php if ($allStat != null): ?>
            <div class="json" style="display: none">
                <?= $allStatJSON ?>
            </div>
        <?php endif; ?>
    </body>
    <?php if ($allStat != null): ?>
        <script src="https://code.jscharting.com/2.9.0/jscharting.js"></script>
        <script src="../view/js/chart.js"></script>
    <?php endif; ?>
</html>