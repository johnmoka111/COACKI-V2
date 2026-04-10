<?php

namespace App\Core;

class Security {
    private static $salt = "COACKI_SECURE_SALT_2024";

    /**
     * Hash un ID numérique en chaîne de caractères
     */
    /**
     * Génère un hash_id unique basé sur des bytes aléatoires + timestamp.
     * Résultat: 12 caractères hexadécimaux, pratiquement sans collision.
     */
    public static function hashId($id = null): string {
        $raw = bin2hex(random_bytes(8)) . dechex(time());
        return substr($raw, 0, 16);
    }

    /**
     * Génère un token unique pour une utilisation en URL (liens de confirmation, etc.)
     */
    public static function generateToken(): string {
        return bin2hex(random_bytes(32));
    }

    /**
     * Note: Dans un système réel, on utiliserait Hashids pour un décodage bidirectionnel fiable.
     * Pour ce projet, on pourra stocker le hash en base ou utiliser un mapping.
     */
}
