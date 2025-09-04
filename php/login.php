<?php
session_start();
require_once '../php/config.php'; // adapte si besoin

// Pour stocker l'erreur éventuelle
$error = '';

// Si on a soumis le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM t_utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();


    
    // Vérification du mot de passe
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur'] = $utilisateur;

        // Redirection vers tableau de bord
        //header : va à url
        header("Location: ../php/dashboard.php");
    }
        //  Mauvais identifiants, on redirige vers login avec erreur
        header("Location: ../view/login.html?error=1");
    
    
} else {
    //  Si la page est accédée directement sans POST, on redirige vers le formulaire
    header("Location: ../view/login.html");
    
}
