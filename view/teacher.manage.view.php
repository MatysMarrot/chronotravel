<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Gestion des élèves</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">    
    </head>

    <body>  
        <!--Header --> 
        <?php include(__DIR__.'/header.student.viewpart.php'); ?>

        <main>
            <h1>Gestion des élèves</h2>

            <h2><?=$className?></h2>
            <h3><?=$code?></h3>
            <!--Select permettant de filtrer le contenue du tableau ci-dessous -->
            <form action="../controler/teacher.manage.ctrl.php" method = "post">
                <select name="currentClass" id="classe-select">
                    <?php if(count($classList) != 0) :?>
                        <?php foreach($classList as $class) :?>
                            <?php if($class->getId() == $currentClass->getId()) : ?>
                                <option value= '<?= $class->getId() ?>' selected><?= $class->getName() ?></option>
                            <?php else : ?>
                                <option value= '<?= $class->getId() ?>'><?= $class->getName() ?></option>
                            <?php endif;?>
                        <?php endforeach;?>

                    <?php else : ?>
                        <option value= '-1'>PAS DE CLASSE</option>
                    <?php endif; ?>
                </select>
                <input type="submit" value = "Choisir classe">

                <!--Tableau contenant les élèves de la classe sélectionner dans le selecte ci-dessus -->
                <?php if(count($students) == 0) :?>
                    <p>PAS D'ELEVES</p>
                <?php else : ?>
                    <table class="tableau">
                        <?php foreach($students as $student) :?>    
                            <tr>
                                <td><?=$student->getFirstName()?> <?=$student->getLastName()?></td>                             
                                <td><button type="submit">STATS</button></td>
                                <td><button name = "delete" value = '<?=$student->getId()?>' type="submit">SUPPRIMER</button></td>
                            </tr>    
                        <?php endforeach;?>
                    </table>
                <?php endif; ?>
            </form>
          
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?>   
    </body>
</html>