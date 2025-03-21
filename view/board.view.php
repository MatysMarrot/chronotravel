<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>ChronoTravel - Jeu</title>
      <link rel="stylesheet" type="text/css" href="../view/style/board.style.css">
      <link rel="stylesheet" type="text/css" href="../view/style/quiz.style.css">
        <style>
            #canvas-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            #myCanvas {
                display: none;
                border: 1px solid #000;
                background-color: white;
            }

            #content {
                z-index: 2;
                position: relative;
                /* Ajoutez d'autres styles pour votre contenu ici */
            }
        </style>
    </head>

    <body>
        <div id="jeu">
            <table id="board"></table>

            <div id="content">
                <!-- Votre contenu ici -->
            </div>
        </div>

        <div id="minijeu">
            <?php
            include('../view/quiz.view.php');
            ?>
        </div>


    </body>

    <script type="module" src="../controler/partyws.ctrl.js" ></script>
</html>