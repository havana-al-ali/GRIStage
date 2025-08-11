-- Base de données GRIStage
-- Création des tables avec gestion des relations

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS t_utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom            VARCHAR(50) NOT NULL,
    prenom         VARCHAR(50) NOT NULL,
    email          VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe   VARCHAR(100) NOT NULL
);

-- Table des documents (CV, lettre de motivation, etc.)
CREATE TABLE IF NOT EXISTS t_document (
    id_document    INT AUTO_INCREMENT PRIMARY KEY,
    type           VARCHAR(30) NOT NULL, -- ex : 'CV', 'Lettre'
    fichier_nom    VARCHAR(255) NOT NULL,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES t_utilisateur(id_utilisateur)
        ON DELETE CASCADE
    -- Si un utilisateur est supprimé, tous ses documents le seront aussi
);

-- Table des offres de stage
CREATE TABLE IF NOT EXISTS t_offre (
    id_offre     INT AUTO_INCREMENT PRIMARY KEY,
    titre        VARCHAR(100) NOT NULL,
    description  TEXT NOT NULL
);

-- Table des candidatures
CREATE TABLE IF NOT EXISTS t_candidature (
    id_candidature       INT AUTO_INCREMENT PRIMARY KEY,
    statut               VARCHAR(20) NOT NULL DEFAULT 'En attente', -- ex : En attente, Acceptée, Refusée
    lettre_motivation    TEXT,
    id_utilisateur       INT NOT NULL,
    id_offre             INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES t_utilisateur(id_utilisateur)
        ON DELETE CASCADE,
    FOREIGN KEY (id_offre) REFERENCES t_offre(id_offre)
        ON DELETE CASCADE
    -- Si une offre ou un utilisateur est supprimé, les candidatures liées le seront aussi
);