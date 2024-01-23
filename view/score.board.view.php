<head>
    <style>
        #qcm {
            background-image: url('view/img/theme/2-moyenage/4-img-moyenage.jpg');
        }
    </style>
    <link rel="stylesheet" href="../view/style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /></head>
</head>

<a id="button-return" href="../controler/home.ctrl.php"><i class="material-symbols-outlined">arrow_back</i></a>
<body class="relativ">
    <table id="score">
        <thead>
        <tr >
            <th>Position</th><th>Pseudo</th><th>Gains</th>
        </tr>
        </thead>
        <tbody>
        <?=$tableau?>
        </tbody>
    </table>
</body>
