USE coacki_db;

-- Système de Partenariat CRM
CREATE TABLE IF NOT EXISTS partenariats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    organisation VARCHAR(150) DEFAULT NULL,
    email VARCHAR(150) NOT NULL,
    telephone VARCHAR(50) DEFAULT NULL,
    type_partenariat VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    est_lu TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table roles si non existante
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO roles (id, nom) VALUES (1, 'superadmin'), (2, 'admin'), (3, 'communication'), (4, 'membre');

-- Modification de la table utilisateurs pour associer role_id
ALTER TABLE utilisateurs 
ADD COLUMN IF NOT EXISTS role_id INT DEFAULT 4,
ADD FOREIGN KEY IF NOT EXISTS (role_id) REFERENCES roles(id) ON DELETE SET NULL;
