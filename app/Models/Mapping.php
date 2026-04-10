<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Mapping {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Récupère toutes les parcelles
     */
    public function getParcelles() {
        $stmt = $this->db->query("SELECT * FROM parcelles");
        return $stmt->fetchAll();
    }

    /**
     * Récupère toutes les stations de lavage
     */
    public function getStations() {
        $stmt = $this->db->query("SELECT * FROM stations_lavage");
        return $stmt->fetchAll();
    }
}
