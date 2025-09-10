<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../view/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Tableau de bord</title>
 <link rel="stylesheet" href="../style/style.css" />
<style>
      body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

     h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    </style>

</head>
<body>
     <nav>
    <img src="../img/logo-gri.png" alt="gri-logo" width="140" height="79" />
    <ul>
      <li><a class="active" href="index.html">Home</a></li>
      <li><a href="services.html">Services</a></li>
      <li><a href="offres.html">Offres</a></li>
      <li><a href="information.html">Informations</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="inscrire.html">Inscription</a></li>
    </ul>
  </nav>
  <h2>Bienvenue <?php echo htmlspecialchars($_SESSION['utilisateur']['prenom']); ?> !</h2>
  <a href="../view/login.php?logout=1">Se déconnecter</a>



  <footer>
    <div class="container-footer">
      <div class="col autures">
        <p>Havana Al-Ali</p>
        <p>Bismellah HASHIMI</p>
        <p>Version: 1.0</p>
      </div>

      <div class="col copie">
        <p>© Copyright 2019 - 2025</p>
        <p>Groupement romand de l'informatique</p>
        <p>ALL RIGHTS RESERVED</p>
      </div>

      <div class="col-gri">
        <p class="par-phon">Tél: ++41 21 652 30 70</p>
        <a href="mailto:gri@gri.ch" class="mail">Email: gri@gri.ch</a>
        <p class="addresse">Adresse: En Chamard 41A 1442 Montagny</p>
      </div>
    </div>
  </footer>
</body>
</html>
