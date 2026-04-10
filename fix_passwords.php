<?php
define('BASE_PATH', __DIR__);
require_once BASE_PATH . '/app/Core/Autoloader.php';
Autoloader::register();

use App\Core\Database;

try {
    $db = Database::getInstance();
    $hash = password_hash('coacki2024', PASSWORD_BCRYPT);
    
    // Update admin
    $stmt = $db->prepare("UPDATE utilisateurs SET mot_de_passe = :hash WHERE email = 'admin@coacki.cd'");
    $stmt->execute(['hash' => $hash]);
    
    // Update comm
    $stmt = $db->prepare("UPDATE utilisateurs SET mot_de_passe = :hash WHERE email = 'communication@coacki.cd'");
    $stmt->execute(['hash' => $hash]);

    echo "Passwords updated successfully to 'coacki2024'";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
