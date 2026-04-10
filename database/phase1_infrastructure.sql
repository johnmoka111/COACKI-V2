USE coacki_db;

-- 1. Table Newsletter
CREATE TABLE IF NOT EXISTS newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(191) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 2. Table pour les demandes de réinitialisation de mot de passe (Onboarding/Approbation Admin)
CREATE TABLE IF NOT EXISTS password_reset_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    status ENUM('en_attente', 'approuve', 'refuse') DEFAULT 'en_attente',
    admin_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES utilisateurs(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Optimisation technique (Indexes pour les recherches rapides)
ALTER TABLE utilisateurs ADD INDEX IF NOT EXISTS idx_email (email);
ALTER TABLE utilisateurs ADD INDEX IF NOT EXISTS idx_role (role_id);
ALTER TABLE newsletter ADD INDEX IF NOT EXISTS idx_newsletter_email (email);
