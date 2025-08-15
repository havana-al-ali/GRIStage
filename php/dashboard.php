<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Tableau de bord</title></head>
<body>
  <h1>Bienvenue <?php echo htmlspecialchars($_SESSION['utilisateur']['prenom']); ?> !</h1>
  <a href="login.php?logout=1">Se déconnecter</a>
</body>
</html>
