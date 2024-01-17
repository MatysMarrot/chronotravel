
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/style/quiz.style.css">
    <title>ChronoTravel - Quiz</title>
    <style>
        #qcm {
            background-image: url('<?php echo $backgroundImage; ?>');
        }

    </style>
</head>
<body id="qcm">
    <h1>Question à réponse unique</h1>
    <h1>Thème : <?php echo $theme; ?></h1>
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


    <script src="../controler/quiz.ctrl.js"></script>
</body>
</html>