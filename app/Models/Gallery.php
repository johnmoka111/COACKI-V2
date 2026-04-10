<?php

namespace App\Models;

use App\Core\Database;

class Gallery {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM gallery_items ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO gallery_items (url, titre, description, categorie)
                VALUES (:url, :titre, :description, :categorie)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
