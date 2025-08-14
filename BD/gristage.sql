
-- Création des tables et insertion des offres

-- Supprimer les tables si elles existent
DROP TABLE IF EXISTS t_candidature;
DROP TABLE IF EXISTS t_document;
DROP TABLE IF EXISTS t_utilisateur;
DROP TABLE IF EXISTS t_offre;

-- Table : t_utilisateur

CREATE TABLE IF NOT EXISTS t_utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom            VARCHAR(50) NOT NULL,
    prenom         VARCHAR(50) NOT NULL,
    email          VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe   VARCHAR(100) NOT NULL
);

-- Table : t_document

CREATE TABLE IF NOT EXISTS t_document (
    id_document    INT AUTO_INCREMENT PRIMARY KEY,
    type           VARCHAR(30) NOT NULL, -- Exemple : 'CV', 'Lettre'
    fichier_nom    VARCHAR(255) NOT NULL,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES t_utilisateur(id_utilisateur)
        ON DELETE CASCADE
);

-- Table : t_offre

CREATE TABLE IF NOT EXISTS t_offre (
    id_offre     INT AUTO_INCREMENT PRIMARY KEY,
    titre        VARCHAR(100) NOT NULL,
    description  TEXT NOT NULL
);

-- Table : t_candidature

CREATE TABLE IF NOT EXISTS t_candidature (
    id_candidature       INT AUTO_INCREMENT PRIMARY KEY,
    statut               VARCHAR(20) NOT NULL DEFAULT 'En attente',
    lettre_motivation    TEXT,
    id_utilisateur       INT NOT NULL,
    id_offre             INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES t_utilisateur(id_utilisateur)
        ON DELETE CASCADE,
    FOREIGN KEY (id_offre) REFERENCES t_offre(id_offre)
        ON DELETE CASCADE
);

-- Insertion des offres dans t_offre

INSERT INTO t_offre (id_offre, titre, description) VALUES
(1, 'Développeur Web Junior', 'Stage en développement web pour débutants.'),
(2, 'Assistant Cybersécurité', 'Assister l\'équipe de cybersécurité sur les projets.'),
(3, 'Data Analyst', 'Analyse de données et création de dashboards.'),
(4, 'Support Technique', 'Répondre aux demandes des utilisateurs.'),
(5, 'Développeur Mobile', 'Stage en développement d\'applications mobiles.'),
(6, 'Administrateur Réseau', 'Gestion et maintenance des réseaux internes.'),
(7, 'Développeur Backend', 'Développement de services backend en PHP.'),
(8, 'Testeur QA', 'Effectuer des tests fonctionnels et de performance.'),
(9, 'Community Manager', 'Gérer les réseaux sociaux et la communication.'),
(10, 'UX/UI Designer', 'Créer des interfaces utilisateurs intuitives.');
