<?php
session_start();
require_once '../php/config.php'; // adapte le chemin si besoin

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM t_utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur'] = $utilisateur;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="../style/style.css"> <!-- adapte ce chemin -->
</head>
<body>

<h2>Connexion au Portail de Stage</h2>

<!-- Bouton pour ouvrir le modal -->
<button onclick="document.getElementById('loginModal').style.display='block'" style="width:auto;">Login</button>

<!-- Modal -->
<div id="loginModal" class="modal">
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('loginModal').style.display='none'" class="close" title="Fermer">&times;</span>
      <img src="../img/avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
      
      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label for="password"><b>Mot de passe</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Se souvenir de moi
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('loginModal').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Mot de passe <a href="#">oublié ?</a></span>
    </div>
  </form>
</div>

<script>
  // Fermer le modal si on clique à l'extérieur
  window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>

</body>
</html>
