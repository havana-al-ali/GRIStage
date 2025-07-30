-- Table des utilisateurs
CREATE TABLE t_utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom            VARCHAR(50) NOT NULL,
    prenom         VARCHAR(50) NOT NULL,
    email          VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe   VARCHAR(100) NOT NULL
);

-- Table des documents
CREATE TABLE t_document (
    id_document    INT AUTO_INCREMENT PRIMARY KEY,
    type           VARCHAR(30) NOT NULL,
    fichier_nom    VARCHAR(255) NOT NULL,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES t_utilisateur(id_utilisateur)
        ON DELETE CASCADE
        -- si un utilisateur est supprimé, tous ses documents seront aussi automatiquement supprimés
);

-- Table des offres de stages
CREATE TABLE t_offre (
    id_offre     INT AUTO_INCREMENT PRIMARY KEY,
    titre        VARCHAR(100) NOT NULL,
    description  TEXT NOT NULL
);

-- Table des candidatures
CREATE TABLE t_candidature (
    id_candidature         INT AUTO_INCREMENT PRIMARY KEY,
    statut              VARCHAR(20) NOT NULL,
    lettre_motivation   TEXT,
    id_utilisateur      INT NOT NULL,
    id_offre            INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES t_utilisateur(id_utilisateur)
        ON DELETE CASCADE,
    FOREIGN KEY (id_offre) REFERENCES t_offre(id_offre)
        ON DELETE CASCADE
        -- la candidateure concerne une offre de stage 
        -- si cette offre est supprimée, la candidateure l'est également
);
