<?php

namespace App\Models;

use App\Core\Database;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findByEmail(string $email): array|false {
        $stmt = $this->db->prepare(
            "SELECT u.*, r.nom AS role FROM utilisateurs u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.email = :email AND u.actif = 1 LIMIT 1"
        );
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function findByHash(string $hash): array|false {
        $stmt = $this->db->prepare(
            "SELECT u.*, r.nom AS role FROM utilisateurs u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.hash_id = :hash AND u.actif = 1 LIMIT 1"
        );
        $stmt->execute(['hash' => $hash]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO utilisateurs (hash_id, prenom, nom, email, telephone, mot_de_passe, role_id)
                VALUES (:hash_id, :prenom, :nom, :email, :telephone, :mot_de_passe, :role_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare("SELECT id FROM utilisateurs WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return (bool) $stmt->fetch();
    }

    public function updateProfile(int $id, string $prenom, string $nom, ?string $avatar_url): bool {
        $sql = "UPDATE utilisateurs SET prenom = :prenom, nom = :nom";
        $params = ['prenom' => $prenom, 'nom' => $nom, 'id' => $id];
        
        if ($avatar_url !== null) {
            $sql .= ", avatar_url = :avatar_url";
            $params['avatar_url'] = $avatar_url;
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // --- Administration CRM ---
    
    public function createUserFull(array $data) {
        $data['hash_id'] = \App\Core\Security::hashId('u' . time());
        $sql = "INSERT INTO utilisateurs 
                (hash_id, role_id, prenom, nom, email, telephone, mot_de_passe, 
                 question_1, reponse_1, question_2, reponse_2, question_3, reponse_3, 
                 latitude, longitude, photo_champ) 
                VALUES 
                (:hash_id, :role_id, :prenom, :nom, :email, :telephone, :mot_de_passe, 
                 :question_1, :reponse_1, :question_2, :reponse_2, :question_3, :reponse_3, 
                 :latitude, :longitude, :photo_champ)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function adminResetPassword(int $id, string $hashedPassword) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET mot_de_passe = :pwd WHERE id = :id");
        return $stmt->execute(['pwd' => $hashedPassword, 'id' => $id]);
    }

    public function getAllUsers() {
        return $this->db->query("
            SELECT u.*, r.nom AS role_nom 
            FROM utilisateurs u 
            LEFT JOIN roles r ON u.role_id = r.id 
            ORDER BY u.created_at DESC
        ")->fetchAll();
    }

    public function updateRoleInfo(int $id, int $role_id, string $prenom, string $nom) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET role_id = :r, prenom = :p, nom = :n WHERE id = :id");
        return $stmt->execute(['r' => $role_id, 'p' => $prenom, 'n' => $nom, 'id' => $id]);
    }

    public function delete(int $id) {
        $stmt = $this->db->prepare("DELETE FROM utilisateurs WHERE id = :id AND id != 1"); // Proteger admin natif
        return $stmt->execute(['id' => $id]);
    }

    public function toggleStatus(int $id) {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET actif = 1 - actif WHERE id = :id AND id != 1");
        return $stmt->execute(['id' => $id]);
    }

    // --- Demandes de réinitialisation ---

    public function getPendingResetRequestsCount() {
        return $this->db->query("SELECT COUNT(*) FROM password_reset_requests WHERE status = 'en_attente'")->fetchColumn();
    }

    public function getPendingResetRequests() {
        return $this->db->query("
            SELECT pr.*, u.prenom, u.nom, u.email 
            FROM password_reset_requests pr
            JOIN utilisateurs u ON pr.user_id = u.id
            WHERE pr.status = 'en_attente'
            ORDER BY pr.created_at DESC
        ")->fetchAll();
    }

    public function getResetRequestsHistory() {
        return $this->db->query("
            SELECT pr.*, u.prenom, u.nom, u.email, a.prenom as admin_prenom, a.nom as admin_nom
            FROM password_reset_requests pr
            JOIN utilisateurs u ON pr.user_id = u.id
            LEFT JOIN utilisateurs a ON pr.admin_id = a.id
            WHERE pr.status != 'en_attente'
            ORDER BY pr.updated_at DESC
            LIMIT 50
        ")->fetchAll();
    }

    public function updateResetRequestStatus(int $id, string $status, ?int $admin_id = null) {
        $stmt = $this->db->prepare("UPDATE password_reset_requests SET status = :s, admin_id = :a WHERE id = :id");
        return $stmt->execute(['s' => $status, 'a' => $admin_id, 'id' => $id]);
    }
}
