<?php
// Connexion à la base de données MySQL (à adapter selon tes paramètres)
$host = 'localhost';
$dbname = 'gri_stage';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Vérifier que le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et sécuriser les données
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $mot_de_passe_conf = $_POST['mot_de_passe_conf'];
    $lettre_motivation = trim($_POST['lettre_motivation']);
    $accept_conditions = isset($_POST['accept_conditions']);

    // Validation
    if (!$nom || !$prenom || !$email || !$mot_de_passe || !$mot_de_passe_conf) {
        die("Tous les champs obligatoires doivent être remplis.");
    }
    if (!$accept_conditions) {
        die("Vous devez accepter les conditions d'utilisation.");
    }
    if ($mot_de_passe !== $mot_de_passe_conf) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Vérifier l'upload du CV
    if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
        die("Erreur lors de l'upload du CV.");
    }

    // Valider l'extension du fichier CV
    $allowed_extensions = ['pdf', 'doc', 'docx'];
    $file_info = pathinfo($_FILES['cv']['name']);
    $ext = strtolower($file_info['extension']);
    if (!in_array($ext, $allowed_extensions)) {
        die("Format du CV non autorisé. Seuls PDF, DOC et DOCX sont acceptés.");
    }

    // Hachage du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        // Insertion utilisateur
        $stmt = $pdo->prepare("INSERT INTO t_utilisateur (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $mot_de_passe_hash]);
        $id_utilisateur = $pdo->lastInsertId();

        // Sauvegarde du fichier CV
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $filename = uniqid() . '_' . basename($_FILES['cv']['name']);
        $target_file = $upload_dir . $filename;
        if (!move_uploaded_file($_FILES['cv']['tmp_name'], $target_file)) {
            die("Erreur lors de l'enregistrement du fichier CV.");
        }

        // Insertion document dans la base
        $stmt = $pdo->prepare("INSERT INTO t_document (type, fichier_nom, id_utilisateur) VALUES (?, ?, ?)");
        $stmt->execute(['cv', $filename, $id_utilisateur]);

        // (Optionnel) insertion lettre de motivation dans une table candidature ou autre selon ta structure
        // Ici tu peux étendre selon tes besoins

        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } catch (Exception $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
} else {
    die("Accès non autorisé.");
}
