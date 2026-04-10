<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class News {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllPaginated($page = 1, $limit = 20) {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db->prepare("
            SELECT n.*, u.prenom, u.nom, u.avatar_url 
            FROM news n 
            LEFT JOIN utilisateurs u ON n.auteur_id = u.id 
            WHERE n.est_archive = 0 
            ORDER BY n.date_publication DESC 
            LIMIT :offset, :limit
        ");
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll() {
        return (int) $this->db->query("SELECT COUNT(*) FROM news WHERE est_archive = 0")->fetchColumn();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT n.*, u.prenom, u.nom, u.avatar_url 
            FROM news n 
            LEFT JOIN utilisateurs u ON n.auteur_id = u.id 
            WHERE n.est_archive = 0 
            ORDER BY n.date_publication DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère un article par son hash_id
     */
    public function getByHash($hash) {
        $stmt = $this->db->prepare("
            SELECT n.*, u.prenom, u.nom, u.avatar_url 
            FROM news n 
            LEFT JOIN utilisateurs u ON n.auteur_id = u.id 
            WHERE n.hash_id = :hash AND n.est_archive = 0
        ");
        $stmt->execute(['hash' => $hash]);
        return $stmt->fetch();
    }

    /**
     * Récupère les actualités récentes, excluant l'article courant
     */
    public function getRecentExcluding($hash, $limit = 3) {
        $stmt = $this->db->prepare("
            SELECT n.*, u.prenom, u.nom, u.avatar_url 
            FROM news n 
            LEFT JOIN utilisateurs u ON n.auteur_id = u.id 
            WHERE n.hash_id != :hash AND n.est_archive = 0 
            ORDER BY n.date_publication DESC LIMIT :limit
        ");
        $stmt->bindValue(':hash', $hash);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function incrementVues($hash) {
        $stmt = $this->db->prepare("UPDATE news SET vues = vues + 1 WHERE hash_id = :hash");
        $stmt->execute(['hash' => $hash]);
    }

    /**
     * Création d'un article
     */
    public function create($data) {
        $sql = "INSERT INTO news (hash_id, titre, slug, image_url, extrait, contenu, auteur, auteur_id, date_publication, temps_lecture, categorie) 
                VALUES (:hash_id, :titre, :slug, :image_url, :extrait, :contenu, :auteur, :auteur_id, :date_publication, :temps_lecture, :categorie)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($hash_id, $data) {
        $sql = "UPDATE news SET titre = :titre, extrait = :extrait, contenu = :contenu, categorie = :categorie";
        if (isset($data['image_url'])) {
            $sql .= ", image_url = :image_url";
        }
        $sql .= " WHERE hash_id = :hash_id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function archive($hash_id) {
        $stmt = $this->db->prepare("UPDATE news SET est_archive = 1 WHERE hash_id = :hash_id");
        return $stmt->execute(['hash_id' => $hash_id]);
    }
}
