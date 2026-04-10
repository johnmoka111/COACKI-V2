<?php

namespace App\Models;

use App\Core\Database;

class Partenaire {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO partenaires (hash_id, nom_complet, organisation, email, telephone, type_partenariat, message)
                VALUES (:hash_id, :nom_complet, :organisation, :email, :telephone, :type_partenariat, :message)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM partenaires ORDER BY created_at DESC")->fetchAll();
    }

    public function markAsRead($hash) {
        $stmt = $this->db->prepare("UPDATE partenaires SET est_lu = 1 WHERE hash_id = :hash");
        return $stmt->execute(['hash' => $hash]);
    }

    public function getPendingCount() {
        return $this->db->query("SELECT COUNT(*) FROM partenaires WHERE est_lu = 0")->fetchColumn();
    }
}
