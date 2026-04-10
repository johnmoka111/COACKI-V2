USE coacki_db;

-- Mise à jour de la table des partenaires pour le logo et les précisions
ALTER TABLE partenaires 
ADD COLUMN IF NOT EXISTS logo_url VARCHAR(500) DEFAULT NULL AFTER organisation,
ADD COLUMN IF NOT EXISTS description_autre TEXT DEFAULT NULL AFTER type_partenariat;
