<?php

namespace App\Models;

use App\Core\Database;

class Partenaire {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO partenariats (hash_id, nom_complet, organisation, email, telephone, type_partenariat, autre_details, logo_url, message)
                VALUES (:hash_id, :nom_complet, :organisation, :email, :telephone, :type_partenariat, :autre_details, :logo_url, :message)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM partenariats ORDER BY created_at DESC")->fetchAll();
    }

    public function markAsRead($hash) {
        $stmt = $this->db->prepare("UPDATE partenariats SET est_lu = 1 WHERE hash_id = :hash");
        return $stmt->execute(['hash' => $hash]);
    }

    public function getPendingCount() {
        return $this->db->query("SELECT COUNT(*) FROM partenariats WHERE est_lu = 0")->fetchColumn();
    }
}
