<?php

namespace App\Models;

use App\Core\Database;

class Newsletter {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllSubscribers() {
        return $this->db->query("SELECT * FROM newsletter ORDER BY created_at DESC")->fetchAll();
    }

    public function getSubscribersCount() {
        return $this->db->query("SELECT COUNT(*) FROM newsletter")->fetchColumn();
    }

    public function deleteSubscriber(int $id) {
        $stmt = $this->db->prepare("DELETE FROM newsletter WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
