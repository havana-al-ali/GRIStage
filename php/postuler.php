<?php
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_utilisateur = $_POST['id_utilisateur'];
    $id_offre = $_POST['id_offre'];
    $lettre_motivation = trim($_POST['lettre_motivation']);

    if (!$id_utilisateur || !$id_offre || !$lettre_motivation) {
        die("Tous les champs sont obligatoires pour postuler.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO t_candidature (statut, lettre_motivation, id_utilisateur, id_offre) VALUES (?, ?, ?, ?)");
        $stmt->execute(['en attente', $lettre_motivation, $id_utilisateur, $id_offre]);

        echo "Votre candidature a bien été envoyée.";
    } catch (Exception $e) {
        die("Erreur lors de la candidature : " . $e->getMessage());
    }
} else {
    die("Accès non autorisé.");
}
?>
