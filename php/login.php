<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM t_utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur'] = $utilisateur;
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: ../view/login.php?error=1");
        exit;
    }
} else {
    header("Location: ../view/login.php");
    exit;
}
