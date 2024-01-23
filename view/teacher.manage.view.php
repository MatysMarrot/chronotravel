<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Gestion des élèves</title>
      <link rel="stylesheet" type="text/css" href="../view/style/style.css">    
    </head>

    <body>
        <?php $currentPage = 'manage';
        include(__DIR__.'/header.teacher.viewpart.php'); ?>

        <main>
            <form class="gestion" action="../controler/teacher.manage.ctrl.php" method = "post">
                <?php if(count($classList) == 0) :?>
                    <h2>Gestion de la classe</h2>
                    <input class="button-create" name = "createPage" value = "Créer un nouveau groupe de classe" type="submit">
                    <p>PAS DE CLASSE</p>
                <?php else : ?>
                    <div >
                        <!--Select permettant de filtrer le contenue du tableau ci-dessous -->
                        <select name="currentClass" id="classe-select">
                            <?php foreach($classList as $class) :?>
                                <?php if($class->getId() == $currentClass->getId()) : ?>
                                    <option value= '<?= $class->getId() ?>' selected><?= $class->getName() ?></option>
                                <?php else : ?>
                                    <option value= '<?= $class->getId() ?>'><?= $class->getName() ?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <input class="button-teacher" type="submit" value = "Choisir classe">
                    </div>
                    <!--<input class="button-create" name = "create" value = "Créer un nouveau groupe de classe" type="submit"> -->


                    <section>
                        <div class="container">
                            <h2><?=$className?> (<?=$code?>)       </h2>

                            <button class="button-teacher" value="Modifier" name = "modif"type = "submit">Modifier</button>
                            <input class="button-teacher-neg" name = "deleteGroup" value = "Supprimer" type="submit">
                        </div>



                        <!--Tableau contenant les élèves de la classe sélectionner dans le selecte ci-dessus -->
                        <?php if(count($students) == 0) :?>
                            <p>PAS D'ELEVES</p>
                        <?php else : ?>
                            <table class="tableau">
                                <?php foreach($students as $student) :?>
                                    <tr>
                                        <td><?=$student->getFirstName()?> <?=$student->getLastName()?></td>
                                        <td><button class="button-teacher" name = "stats" value = '<?=$student->getId()?>' type="submit">STATS</button></td>
                                        <td><button class="button-teacher-neg" name = "delete" value = '<?=$student->getId()?>' type="submit">SUPPRIMER</button></td>
                                    </tr>
                                <?php endforeach;?>
                            </table>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
            </form>
          
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?>   
    </body>
</html>