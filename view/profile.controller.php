<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChronoTravel - Mon Profil</title>
  <link rel="stylesheet" href="style/style.profile.css">
  <style>
    /* Ajoutez vos styles spécifiques ici */
  </style>
</head>

<body>

  <?php
  require_once(__DIR__ . '/../controler/profile.controller.php');
  $currentPage = 'profile';
  include(__DIR__ . '/header.student.viewpart.php');
  ?>

  <main>
    <!-- Ajout des boutons de commutation -->
    <div class="switch-buttons">
      <button class="switch-button statistics-button active" onclick="showStatistics()">Statistiques</button>
      <button class="switch-button class-button" onclick="showClassInfo()">Classe</button>
    </div>

    <!-- Ajout du tableau de bord -->
    <div class="dashboard">
      <div class="user-info">
        <!-- Insérez l'image de profil -->
        <img src="../view/img/1467684-mob1-article_m-1.png" alt="Image de Profil">
        <p>Pseudo: <?php echo $pseudo; ?></p>
        <!-- Remplacez $pseudo par la variable appropriée -->
        <p>Email: utilisateur@example.com</p>
      </div>

      <div class="statistics">
        <table>
          <tr>
            <th>Parties Jouées</th>
            <th>Parties Gagnées</th>
          </tr>
          <tr>
            <td>50</td>
            <td>30</td>
          </tr>
        </table>
      </div>

      <div class="class-info">
        <table>
          <tr>
            <th>Info 1</th>
            <th>Info 2</th>
          </tr>
          <tr>
            <td>Donnée 1</td>
            <td>Donnée 2</td>
          </tr>
        </table>
      </div>
    </div>

    <!-- Reste du contenu de la page -->
    <!-- ... -->

    <script>
      function showStatistics() {
        document.querySelector('.statistics').style.display = 'flex';
        document.querySelector('.class-info').style.display = 'none';
        document.querySelector('.statistics-button').classList.add('active');
        document.querySelector('.class-button').classList.remove('active');
      }

      function showClassInfo() {
        document.querySelector('.statistics').style.display = 'none';
        document.querySelector('.class-info').style.display = 'flex';
        document.querySelector('.statistics-button').classList.remove('active');
        document.querySelector('.class-button').classList.add('active');
      }
    </script>
  </main>
</body>

</html>
