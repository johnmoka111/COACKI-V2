<?php

namespace App\Models;

use App\Core\Database;

class Engagement {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /** Fingerprint anonyme d'un visiteur (hash IP + UserAgent) */
    private function fingerprint(): string {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return hash('sha256', $ip . $ua);
    }

    /** Récupère les stats complètes d'un article */
    public function getStats(string $hash): array {
        $stmt = $this->db->prepare("
            SELECT 
                (SELECT COUNT(*) FROM news_likes WHERE news_hash_id = :h1) AS likes,
                (SELECT COUNT(*) FROM news_commentaires WHERE news_hash_id = :h2 AND est_approuve = 1) AS commentaires,
                (SELECT COUNT(*) FROM news_partages WHERE news_hash_id = :h3) AS partages
        ");
        $stmt->execute(['h1' => $hash, 'h2' => $hash, 'h3' => $hash]);
        return $stmt->fetch() ?: ['likes' => 0, 'commentaires' => 0, 'partages' => 0];
    }

    /** Toggle like (ajoute ou retire) */
    public function toggleLike(string $hash): array {
        $fp = $this->fingerprint();
        $uid = $_SESSION['user']['id'] ?? null;

        // Check si déjà liké
        $stmt = $this->db->prepare("SELECT id FROM news_likes WHERE news_hash_id = :h AND user_fingerprint = :fp");
        $stmt->execute(['h' => $hash, 'fp' => $fp]);
        $existing = $stmt->fetch();

        if ($existing) {
            $this->db->prepare("DELETE FROM news_likes WHERE news_hash_id = :h AND user_fingerprint = :fp")
                     ->execute(['h' => $hash, 'fp' => $fp]);
            $liked = false;
        } else {
            $this->db->prepare("INSERT INTO news_likes (news_hash_id, user_fingerprint, user_id) VALUES (:h, :fp, :uid)")
                     ->execute(['h' => $hash, 'fp' => $fp, 'uid' => $uid]);
            $liked = true;
        }

        $count = $this->db->query("SELECT COUNT(*) FROM news_likes WHERE news_hash_id = '$hash'")->fetchColumn();
        return ['liked' => $liked, 'count' => (int)$count];
    }

    /** Vérifie si l'utilisateur actuel a liké */
    public function hasLiked(string $hash): bool {
        $fp = $this->fingerprint();
        $stmt = $this->db->prepare("SELECT id FROM news_likes WHERE news_hash_id = :h AND user_fingerprint = :fp");
        $stmt->execute(['h' => $hash, 'fp' => $fp]);
        return (bool) $stmt->fetch();
    }

    /** Enregistre un partage */
    public function recordShare(string $hash, string $platform = 'direct'): void {
        $this->db->prepare("INSERT INTO news_partages (news_hash_id, plateforme) VALUES (:h, :p)")
                 ->execute(['h' => $hash, 'p' => $platform]);
    }

    /** Récupère les commentaires approuvés */
    public function getComments(string $hash): array {
        $stmt = $this->db->prepare("
            SELECT * FROM news_commentaires 
            WHERE news_hash_id = :h AND est_approuve = 1 
            ORDER BY created_at DESC
        ");
        $stmt->execute(['h' => $hash]);
        return $stmt->fetchAll();
    }

    /** Ajouter un commentaire (approuvé par défaut pour ce projet) */
    public function addComment(string $hash, string $nom, string $email, string $contenu): bool {
        $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($nom) . '&background=032E1A&color=EAB308&size=64';
        $stmt = $this->db->prepare("
            INSERT INTO news_commentaires (news_hash_id, auteur_nom, auteur_email, auteur_avatar, contenu)
            VALUES (:h, :nom, :email, :avatar, :contenu)
        ");
        return $stmt->execute(['h' => $hash, 'nom' => $nom, 'email' => $email, 'avatar' => $avatar, 'contenu' => $contenu]);
    }
}
