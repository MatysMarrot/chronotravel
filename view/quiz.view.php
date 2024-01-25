<head>
    <style>
        #qcm {
            background-image: url('<?php echo $backgroundImage; ?>');
        }
    </style>
</head>

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
</div>