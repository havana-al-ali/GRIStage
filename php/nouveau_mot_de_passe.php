<?php
// Inclusion du fichier de configuration (connexion à la base de données)
require_once '../php/config.php';

// Vérifie si la requête a été envoyée via la méthode POST(envoie data sensible au serveur comme requete pas url)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données envoyées par le formulaire
    $token = $_POST['token'];  // Le token envoyé dans le lien
    $new_password = $_POST['new_password'];  // Nouveau mot de passe
    $confirm_password = $_POST['confirm_password'];  // Confirmation du mot de passe

    // Vérifie que tous les champs sont remplis
    if (empty($token) || empty($new_password) || empty($confirm_password)) {
        die("Tous les champs sont requis.");  // Message d'erreur si un champ est vide
    }

    // Vérifie que les deux mots de passe sont identiques
    if ($new_password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");  // Message d'erreur si les mots de passe ne sont pas les mêmes
    }

    // Recherche dans la base de données un utilisateur avec ce token
    // et dont la date d'expiration du token n'est pas encore passée
    $stmt = $pdo->prepare("SELECT * FROM t_utilisateur WHERE reset_token = ? AND reset_expiration > NOW()");
    $stmt->execute([$token]);
    $utilisateur = $stmt->fetch();  // Récupère les données de l'utilisateur s'il existe

    // Si un utilisateur avec un token valide est trouvé
    if ($utilisateur) {
        // Hachage sécurisé du nouveau mot de passe
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Mise à jour du mot de passe dans la base de données
        // On efface aussi le token et la date d'expiration pour empêcher une nouvelle utilisation
        $update = $pdo->prepare("UPDATE t_utilisateur SET mot_de_passe = ?, reset_token = NULL, reset_expiration = NULL WHERE id_utilisateur = ?");
        $update->execute([$hashed_password, $utilisateur['id_utilisateur']]);

        // Message de succès + lien vers la page de connexion
        echo "Votre mot de passe a été réinitialisé avec succès ! <a href='../view/login.php'>Se connecter</a>";
    } else {
        // Si aucun utilisateur avec ce token n'est trouvé ou si le token a expiré
        echo "Lien invalide ou expiré.";
    }

} else {
    // Si la requête n'est pas envoyée via POST (accès direct à la page), on redirige vers la page de connexion
    header("Location: ../view/login.php");
    exit;
}
