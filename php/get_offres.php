<?php
require_once 'connexion.php';

try {
    $stmt = $pdo->query("SELECT id_offre, titre, description FROM t_offre");
    $offres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($offres);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la récupération des offres : ' . $e->getMessage()]);
}
?>
