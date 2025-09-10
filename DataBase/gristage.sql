CREATE DATABASE IF NOT EXISTS gristage;
USE gristage;

-- Création de la base
CREATE DATABASE IF NOT EXISTS gristage;
USE gristage;

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
    mot_de_passe   VARCHAR(100) NOT NULL,
    reset_token    VARCHAR(255) DEFAULT NULL,
    reset_expiration DATETIME DEFAULT NULL
);

-- Table : t_document
CREATE TABLE IF NOT EXISTS t_document (
    id_document    INT AUTO_INCREMENT PRIMARY KEY,
    type           VARCHAR(30) NOT NULL,
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

-- Insertion des offres
INSERT INTO t_offre (titre, description) VALUES
('Développeur Web Junior', 'Stage en développement web pour débutants.'),
('Assistant Cybersécurité', 'Assister l\'équipe de cybersécurité sur les projets.'),
('Data Analyst', 'Analyse de données et création de dashboards.'),
('Support Technique', 'Répondre aux demandes des utilisateurs.'),
('Développeur Mobile', 'Stage en développement d\'applications mobiles.'),
('Administrateur Réseau', 'Gestion et maintenance des réseaux internes.'),
('Développeur Backend', 'Développement de services backend en PHP.'),
('Testeur QA', 'Effectuer des tests fonctionnels et de performance.'),
('Community Manager', 'Gérer les réseaux sociaux et la communication.'),
('UX/UI Designer', 'Créer des interfaces utilisateurs intuitives.');

-- Insertion des utilisateur
INSERT INTO t_utilisateur (nom, prenom, email, mot_de_passe) VALUES
('Al-Ali', 'Havana', 'havanaali@gmail.com', '$2y$10$kHhs9VHSGZnPsXVDWp3ErutuMcAiEkz404ge6jbuZuPlNMgG69lOK'),
('Al-Ali', 'Jan', 'Janali@gmail.com', '$2y$10$W.WQo3SUyqDDcMZFiZSCoeAxhdn9f1ah8uoi9XBSr5BB.kAjWeh7q'),
('Al-Ali', 'Emma', 'emmaali@gmail.com', '$2y$10$F36ZyXWYYujWYt6/m.l7quA6hU7ss6Laz.klu.AQx1pglAsRnp4yu'),
('Rahmoun', 'Mahmoud', 'mahmoud4rahmoun@gmail.com', '$2y$10$UKaFtoJ97e4s.dcLdc7m.eoNKpfAktcVwBG5WCzHm7HaJoyZXgpfO');