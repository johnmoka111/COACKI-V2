<?php
require_once __DIR__ . '/app/Core/Database.php';

use App\Core\Database;

try {
    $db = Database::getInstance();
    
    echo "<h1>Mise à jour de la base de données</h1>";

    // 1. Détecter si on doit renommer la table partenaires -> partenariats
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    if (in_array('partenaires', $tables) && !in_array('partenariats', $tables)) {
        echo "Renommage de 'partenaires' en 'partenariats'...<br>";
        $db->exec("RENAME TABLE partenaires TO partenariats");
    }

    // 2. Ajouter les colonnes manquantes à la table 'partenariats'
    $columns = $db->query("SHOW COLUMNS FROM partenariats")->fetchAll(PDO::FETCH_COLUMN);
    
    $toAdd = [
        'hash_id' => "VARCHAR(20) DEFAULT NULL AFTER id",
        'logo_url' => "VARCHAR(500) DEFAULT NULL AFTER telephone",
        'autre_details' => "TEXT DEFAULT NULL AFTER type_partenariat",
        'nom_complet' => "VARCHAR(150) DEFAULT NULL AFTER hash_id"
    ];

    foreach ($toAdd as $col => $definition) {
        if (!in_array($col, $columns)) {
            echo "Ajout de la colonne '$col'...<br>";
            $db->exec("ALTER TABLE partenariats ADD COLUMN $col $definition");
        }
    }

    // 3. Si 'nom' existe mais pas 'nom_complet' (migration des données)
    if (in_array('nom', $columns) && in_array('nom_complet', $columns)) {
        echo "Transfert des données de 'nom' vers 'nom_complet'...<br>";
        $db->exec("UPDATE partenariats SET nom_complet = nom WHERE nom_complet IS NULL");
        // Optionnel : supprimer 'nom'
        // $db->exec("ALTER TABLE partenariats DROP COLUMN nom");
    }

    echo "<br><strong style='color:green;'>Succès ! La base de données est à jour.</strong>";
    echo "<br><a href='./partenaire'>Retour au formulaire</a>";

} catch (Exception $e) {
    echo "<br><strong style='color:red;'>Erreur : " . $e->getMessage() . "</strong>";
}
