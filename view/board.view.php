<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Gestion des élèves</title>
      <link rel="stylesheet" type="text/css" href="../view/style/board.style.css">
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
    <div id="canvas-container">
        <canvas id="myCanvas"></canvas>
    </div>

    <div id="content">
        <!-- Votre contenu ici -->
    </div>
        <script src="./board.ctrl.js"></script>
    </body>
</html>