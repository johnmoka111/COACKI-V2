-- COACKI - Schéma de base de données MySQL

CREATE DATABASE IF NOT EXISTS coacki_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE coacki_db;

-- Table des parcelles
CREATE TABLE IF NOT EXISTS parcelles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hash_id VARCHAR(20) UNIQUE,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    altitude DECIMAL(6, 2),
    nb_pieds INT DEFAULT 0,
    producteur VARCHAR(255),
    groupement VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table des stations de lavage
CREATE TABLE IF NOT EXISTS stations_lavage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hash_id VARCHAR(20) UNIQUE,
    nom VARCHAR(255) NOT NULL,
    localisation VARCHAR(255),
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table de la galerie
CREATE TABLE IF NOT EXISTS gallery_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(500) NOT NULL,
    titre VARCHAR(255),
    description TEXT,
    categorie VARCHAR(100) DEFAULT 'Général',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table des actualités (News)
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hash_id VARCHAR(20) UNIQUE,
    titre VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    image_url VARCHAR(500),
    extrait TEXT,
    contenu LONGTEXT,
    auteur VARCHAR(100),
    date_publication DATE,
    temps_lecture VARCHAR(50),
    categorie VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
