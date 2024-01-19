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
            <h2>Gestion des élèves</h2>


            <!--Select permettant de filtrer le contenue du tableau ci-dessous -->
            <form class="gestion" action="../controler/teacher.manage.ctrl.php" method = "post">
                <input class="button-create" name = "create" value = "Créer un nouveau groupe de classe" type="submit">



               <div>
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

                <section>
                    <h3><?=$className?> (<?=$code?>)</h3>
                    <input class="button-teacher-neg" name = "deleteGroup" value = "Supprimer le groupe de classe" type="submit">

                    <?php if(count($classList) != 0) :?>
                        <div>
                            <label>Modifier le nom de la classe:</label>
                            <input value = "<?=$className?>"name = "className"type="text">
                            <button class="button-teacher" value="update" name = "updateName"type = "submit">Modifier nom</button>
                        </div>

                    <?php else : ?>
                        <p>PAS DE CLASSE</p>
                    <?php endif; ?>


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

            </form>
          
        </main>

        <!--Footer --> 
        <?php include(__DIR__.'/footer.viewpart.html'); ?>   
    </body>
</html>