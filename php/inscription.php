<?php
// Connexion à la base de données MySQL (à adapter selon tes paramètres)
$host = 'localhost';
$dbname = 'gristage';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    exit('Erreur de connexion : ' . htmlspecialchars($e->getMessage()));
}

// Fonction pour afficher un message d'erreur et stopper
function error($msg) {
    echo '<p style="color:red;">' . htmlspecialchars($msg) . '</p>';
    exit;
}

// Vérifier que le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et sécuriser les données
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $mot_de_passe_conf = $_POST['mot_de_passe_conf'] ?? '';
    $lettre_motivation = trim($_POST['lettre_motivation'] ?? '');
    $accept_conditions = isset($_POST['accept_conditions']);

    // Validation des champs obligatoires
    if (!$nom || !$prenom || !$email || !$mot_de_passe || !$mot_de_passe_conf) {
        error("Tous les champs obligatoires doivent être remplis.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error("Adresse email invalide.");
    }
    if (!$accept_conditions) {
        error("Vous devez accepter les conditions d'utilisation.");
    }
    if ($mot_de_passe !== $mot_de_passe_conf) {
        error("Les mots de passe ne correspondent pas.");
    }

    // Vérifier l'upload du CV
    if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
        error("Erreur lors de l'upload du CV.");
    }

    // Valider l'extension du fichier CV
    $allowed_extensions = ['pdf', 'doc', 'docx'];
    $file_info = pathinfo($_FILES['cv']['name']);
    $ext = strtolower($file_info['extension'] ?? '');
    if (!in_array($ext, $allowed_extensions)) {
        error("Format du CV non autorisé. Seuls PDF, DOC et DOCX sont acceptés.");
    }

    // Taille max fichier (ex: 5Mo)
    $max_size = 5 * 1024 * 1024;
    if ($_FILES['cv']['size'] > $max_size) {
        error("Le fichier CV est trop volumineux (max 5 Mo).");
    }

    // Hachage du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        // Vérifier si email existe déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM t_utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            error("Cette adresse email est déjà utilisée.");
        }

        // Insertion utilisateur
        $stmt = $pdo->prepare("INSERT INTO t_utilisateur (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $mot_de_passe_hash]);
        $id_utilisateur = $pdo->lastInsertId();

        // Sauvegarde du fichier CV
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Sécurisation du nom de fichier
        $safe_name = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', basename($_FILES['cv']['name']));
        $filename = uniqid() . '_' . $safe_name;
        $target_file = $upload_dir . $filename;

        if (!move_uploaded_file($_FILES['cv']['tmp_name'], $target_file)) {
            error("Erreur lors de l'enregistrement du fichier CV.");
        }

        // Insertion document dans la base
        $stmt = $pdo->prepare("INSERT INTO t_document (type, fichier_nom, id_utilisateur) VALUES (?, ?, ?)");
        $stmt->execute(['cv', $filename, $id_utilisateur]);

        // Insertion lettre de motivation dans une table candidature (à adapter selon ta base)
        $stmt = $pdo->prepare("INSERT INTO t_candidature (id_utilisateur, lettre_motivation) VALUES (?, ?)");
        $stmt->execute([$id_utilisateur, $lettre_motivation]);

        echo "<p style='color:green;'>Inscription réussie ! Vous pouvez maintenant vous connecter.</p>";

    } catch (Exception $e) {
        error("Erreur lors de l'inscription : " . $e->getMessage());
    }
} else {
    exit("Accès non autorisé.");
}
