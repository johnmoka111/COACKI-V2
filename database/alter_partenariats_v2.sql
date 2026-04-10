-- Mise à jour de la table partenariats pour le nouveau formulaire riche
USE coacki_db;

-- On renomme la table si elle s'appelait partenaires
-- RENAME TABLE partenaires TO partenariats;

-- S'assurer que les colonnes existent (on utilise ADD COLUMN IF NOT EXISTS si supporté, sinon une approche manuelle)
ALTER TABLE partenariats 
ADD COLUMN IF NOT EXISTS logo_url VARCHAR(500) DEFAULT NULL AFTER telephone,
ADD COLUMN IF NOT EXISTS autre_details TEXT DEFAULT NULL AFTER type_partenariat,
ADD COLUMN IF NOT EXISTS hash_id VARCHAR(20) DEFAULT NULL AFTER id,
MODIFY COLUMN nom VARCHAR(150) NULL,
CHANGE COLUMN IF EXISTS nom nom_complet VARCHAR(150);

-- Si la colonne nom_complet n'existe pas encore mais 'nom' oui
-- ALTER TABLE partenariats CHANGE COLUMN nom nom_complet VARCHAR(150);
