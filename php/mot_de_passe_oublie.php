<?php
require_once '../php/config.php'; // Connexion à la BDD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Vérifie que l'email est bien dans la base
    $stmt = $pdo->prepare("SELECT * FROM t_utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur) {
        // Génère un token unique (32 caractères)
        $token = bin2hex(random_bytes(16));
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Sauvegarde le token et sa date d'expiration
        $update = $pdo->prepare("UPDATE t_utilisateur SET reset_token = ?, reset_expiration = ? WHERE email = ?");
        $update->execute([$token, $expiration, $email]);

        // Lien de réinitialisation (à adapter à ton serveur ou localhost)
        $reset_link = "http://localhost/GRIStage/view/nouveau_mot_de_passe.php?token=$token";

        // En développement : afficher le lien (en prod, tu l'enverras par email)
        echo "<p>Un lien de réinitialisation a été généré :</p>";
        echo "<p><a href='$reset_link'>$reset_link</a></p>";
        echo "<p>Le lien est valable pendant 1 heure.</p>";
    } else {
        echo "<p style='color:red;'>Aucun compte trouvé avec cet email.</p>";
    }
} else {
    // Si la page est accédée sans POST
    header("Location: ../view/login.html");
    exit;
}
?>
