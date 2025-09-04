<?php
require_once '../php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($token) || empty($new_password) || empty($confirm_password)) {
        die("Tous les champs sont requis.");
    }

    if ($new_password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Recherche du token valide
    $stmt = $pdo->prepare("SELECT * FROM t_utilisateur WHERE reset_token = ? AND reset_expiration > NOW()");
    $stmt->execute([$token]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur) {
        // Hachage du mot de passe (recommandé)
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Mise à jour du mot de passe
        $update = $pdo->prepare("UPDATE t_utilisateur SET mot_de_passe = ?, reset_token = NULL, reset_expiration = NULL WHERE id_utilisateur = ?");
        $update->execute([$hashed_password, $utilisateur['id_utilisateur']]);

        echo "Votre mot de passe a été réinitialisé avec succès ! <a href='../view/login.html'>Se connecter</a>";
    } else {
        echo "Lien invalide ou expiré.";
    }
} else {
    header("Location: ../view/login.html");
    exit;
}
