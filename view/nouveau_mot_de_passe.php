<?php
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau mot de passe</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
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
</body>
</html>
