<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Chrono Travel- Gestion des élèves</title>
      <link rel="stylesheet" type="text/css" href="../view/style/board.style.css">
      <link rel="stylesheet" type="text/css" href="../view/style/quiz.style.css">
        <style>
            #qcm {
                background-image: url('<?php echo $backgroundImage; ?>');
            }

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

    <table id="board"></table>

    <div id="content">
        <!-- Votre contenu ici -->
    </div>


    <div id="qcm">
        <header>
            <h1>Question à réponse unique</h1>
        </header>
        <div id="question">
            <h2><?php echo $theme; ?></h2>
            <h3>Question</h3>
        </div>
        <table id="answerTable">
            <tr>
                <td class="answer" id="answerA">
                    <input type="radio" name="answer" id="radioA">
                    <label for="radioA">Réponse A</label>
                </td>
                <td class="answer" id="answerB">
                    <input type="radio" name="answer" id="radioB">
                    <label for="radioB">Réponse B</label>
                </td>
            </tr>
            <tr>
                <td class="answer" id="answerC">
                    <input type="radio" name="answer" id="radioC">
                    <label for="radioC">Réponse C</label>
                </td>
                <td class="answer" id="answerD">
                    <input type="radio" name="answer" id="radioD">
                    <label for="radioD">Réponse D</label>
                </td>
            </tr>
        </table>
        <div id="selectedAnswerDisplay">
            Réponse sélectionnée : <span id="selectedAnswerText"></span>
        </div>

        <button id="hideButton">Cacher les éléments</button>

    </div>
    <button id="revealButton">Révéler les éléments</button>

    <script type="module" src="../controler/quiz.ctrl.js"></script>



    <script type="module" src="../controler/partyws.ctrl.js" ></script>
    </body>
</html>