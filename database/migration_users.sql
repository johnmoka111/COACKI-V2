-- ============================================
-- COACKI - Migration: Tables Utilisateurs
-- ============================================
USE coacki_db;

-- Rôles utilisateurs
CREATE TABLE IF NOT EXISTS roles (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    nom  VARCHAR(50) NOT NULL UNIQUE  -- 'superadmin', 'admin', 'communication', 'membre', 'partenaire'
) ENGINE=InnoDB;

INSERT IGNORE INTO roles (nom) VALUES 
  ('superadmin'), ('admin'), ('communication'), ('membre'), ('partenaire');

-- Table utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    hash_id       VARCHAR(20) UNIQUE,
    prenom        VARCHAR(100) NOT NULL,
    nom           VARCHAR(100) NOT NULL,
    email         VARCHAR(191) NOT NULL UNIQUE,
    telephone     VARCHAR(30),
    mot_de_passe  VARCHAR(255) NOT NULL,
    role_id       INT NOT NULL DEFAULT 4,  -- 4 = membre par défaut
    actif         TINYINT(1) DEFAULT 1,
    avatar_url    VARCHAR(500),
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDB;

-- Table demandes partenaires
CREATE TABLE IF NOT EXISTS partenaires (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    hash_id       VARCHAR(20) UNIQUE,
    nom_complet   VARCHAR(255) NOT NULL,
    organisation  VARCHAR(255),
    email         VARCHAR(191) NOT NULL,
    telephone     VARCHAR(30),
    type_partenariat VARCHAR(100) NOT NULL,  -- 'torrefacteur', 'distributeur', 'investisseur', 'ong', 'autre'
    message       TEXT NOT NULL,
    statut        VARCHAR(30) DEFAULT 'en_attente',  -- 'en_attente', 'accepte', 'refuse'
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Admin par défaut (mot de passe: coacki2024)
INSERT IGNORE INTO utilisateurs (hash_id, prenom, nom, email, mot_de_passe, role_id) VALUES
('sa001', 'Super', 'Admin', 'admin@coacki.cd', '$2y$12$Zb5zFv.3gQzSWAK7r/VQ4ugD0hALAb88bgj7jvGr3cI4GJVHk8USq', 1),
('com001', 'Chargé', 'Communication', 'communication@coacki.cd', '$2y$12$Zb5zFv.3gQzSWAK7r/VQ4ugD0hALAb88bgj7jvGr3cI4GJVHk8USq', 3);
