<?php
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau mot de passe</title>
    <link rel="stylesheet" href="../style/style.css">
     <style>
      body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
     button {
      width: 100%;
      padding: 12px;
      background-color: #3498db;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover {
      background-color: #2980b9;
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

    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 8px 0 16px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
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
    <div class="login-container">
        <h2>Définir un nouveau mot de passe</h2>

        <form action="../php/nouveau_mot_de_passe.php" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" name="new_password" id="new_password" required>

            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit">Réinitialiser</button>
        </form>
    </div>


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
