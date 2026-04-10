USE coacki_db;

ALTER TABLE news 
ADD COLUMN vues INT DEFAULT 0,
ADD COLUMN auteur_id INT,
ADD COLUMN est_archive TINYINT(1) DEFAULT 0,
MODIFY COLUMN date_publication DATETIME DEFAULT CURRENT_TIMESTAMP;

-- On associe les actus existantes au super admin par défaut au cas où
UPDATE news SET auteur_id = (SELECT id FROM utilisateurs WHERE role_id = 1 LIMIT 1);
