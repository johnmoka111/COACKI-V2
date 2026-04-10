USE coacki_db;

-- Table des likes
CREATE TABLE IF NOT EXISTS news_likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_hash_id VARCHAR(64) NOT NULL,
    user_fingerprint VARCHAR(64) NOT NULL,  -- IP+UserAgent hashé (visiteurs anonymes)
    user_id INT DEFAULT NULL,               -- Si connecté
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_like (news_hash_id, user_fingerprint)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des commentaires
CREATE TABLE IF NOT EXISTS news_commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_hash_id VARCHAR(64) NOT NULL,
    auteur_nom VARCHAR(100) NOT NULL,
    auteur_email VARCHAR(150) DEFAULT NULL,
    auteur_avatar VARCHAR(255) DEFAULT NULL,
    contenu TEXT NOT NULL,
    est_approuve TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_news (news_hash_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des partages (tracking)
CREATE TABLE IF NOT EXISTS news_partages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_hash_id VARCHAR(64) NOT NULL,
    plateforme VARCHAR(50) DEFAULT 'direct',  -- whatsapp, facebook, twitter, direct
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_news (news_hash_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ajout du temps de lecture calculé précisément (en secondes)
ALTER TABLE news ADD COLUMN IF NOT EXISTS temps_lecture_sec INT DEFAULT 0;

-- Vue consolidée pour les stats d'un article
CREATE OR REPLACE VIEW v_news_stats AS
SELECT 
    n.hash_id,
    n.titre,
    n.vues,
    n.date_publication,
    COUNT(DISTINCT l.id) AS likes,
    COUNT(DISTINCT c.id) AS commentaires,
    COUNT(DISTINCT p.id) AS partages
FROM news n
LEFT JOIN news_likes l ON l.news_hash_id = n.hash_id
LEFT JOIN news_commentaires c ON c.news_hash_id = n.hash_id AND c.est_approuve = 1
LEFT JOIN news_partages p ON p.news_hash_id = n.hash_id
GROUP BY n.hash_id, n.titre, n.vues, n.date_publication;
