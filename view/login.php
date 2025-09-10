<?php
// login.php : Affiche le formulaire + message d'erreur (si présent dans l'URL)
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../style/style.css" />
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-container {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 350px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 8px 0 16px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
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
    .checkbox-container {
      display: flex;
      align-items: center;
    }
    .checkbox-container input {
      margin-right: 8px;
    }
    .psw {
      text-align: right;
      margin-top: 10px;
    }
    .psw a {
      color: #3498db;
      text-decoration: none;
    }
    .psw a:hover {
      text-decoration: underline;
    }
    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 15px;
      font-weight: bold;
    }
  </style>
</head>
     <script>
       window.onload = () => {
         document.getElementById('login_email').value = '';
         document.getElementById('login_pass').value = '';
         document.getElementById('remember').checked = false;
       };
     </script>


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

  <main>
    <div class="login-container">
      <h2>Connexion</h2>

      <!-- Affichage du message d'erreur -->
      <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="error-message">Email ou mot de passe incorrect.</div>
      <?php endif; ?>

        <form action="../php/login.php" method="POST" autocomplete="off">

         <label for="login_email"><b>Email</b></label>
         <input type="text" placeholder="Entrez votre email" name="email" id="login_email" autocomplete="off" />

         <label for="login_pass"><b>Mot de passe</b></label>
         <input type="password" placeholder="Entrez votre mot de passe" name="password" id="login_pass" autocomplete="new-password" />

         <div class="checkbox-container">
           <input type="checkbox" name="remember" id="remember" />
           <label for="remember">Se souvenir de moi</label>
         </div>

         <button type="submit">Login</button>

         <div class="psw">
           <a href="mot_de_passe_oublie.html">Mot de passe oublié ?</a>
         </div>
       </form>


    </div>
  </main>

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
