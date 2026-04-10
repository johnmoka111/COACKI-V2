<?php

require_once __DIR__ . '/../app/Core/Autoloader.php';
Autoloader::register();

use App\Core\Database;
use App\Core\Security;

$db = Database::getInstance();

echo "Initialisation de la base de données (Carte)...\n";

// Stations de lavage
$stations = [
    [
        'hash_id' => Security::hashId(101),
        'nom' => 'Station Centrale Munanira',
        'localisation' => 'Village Munanira, Mbinga-Sud',
        'latitude' => -2.041538,
        'longitude' => 28.970495
    ],
    [
        'hash_id' => Security::hashId(102),
        'nom' => 'Station de Collecte Nord',
        'localisation' => 'Hauts Plateaux Kalehe',
        'latitude' => -2.035000,
        'longitude' => 28.965000
    ]
];

// Parcelles (Simulation de quelques membres)
$parcelles = [
    [
        'hash_id' => Security::hashId(201),
        'producteur' => 'Maison Biringanine',
        'groupement' => 'Mbinga-Sud',
        'latitude' => -2.043000,
        'longitude' => 28.972000,
        'altitude' => 1550,
        'nb_pieds' => 450
    ],
    [
        'hash_id' => Security::hashId(202),
        'producteur' => 'Famille Shamavu',
        'groupement' => 'Mbinga-Sud',
        'latitude' => -2.040000,
        'longitude' => 28.975000,
        'altitude' => 1620,
        'nb_pieds' => 800
    ],
    [
        'hash_id' => Security::hashId(203),
        'producteur' => 'Coopérateur Munira',
        'groupement' => 'Mbinga-Sud',
        'latitude' => -2.045000,
        'longitude' => 28.968000,
        'altitude' => 1510,
        'nb_pieds' => 320
    ]
];

// Insertion Stations
foreach ($stations as $s) {
    try {
        $stmt = $db->prepare("INSERT INTO stations_lavage (hash_id, nom, localisation, latitude, longitude) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$s['hash_id'], $s['nom'], $s['localisation'], $s['latitude'], $s['longitude']]);
        echo "✅ Station ajoutée : " . $s['nom'] . "\n";
    } catch (Exception $e) { echo "❌ " . $e->getMessage() . "\n"; }
}

// Insertion Parcelles
foreach ($parcelles as $p) {
    try {
        $stmt = $db->prepare("INSERT INTO parcelles (hash_id, producteur, groupement, latitude, longitude, altitude, nb_pieds) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$p['hash_id'], $p['producteur'], $p['groupement'], $p['latitude'], $p['longitude'], $p['altitude'], $p['nb_pieds']]);
        echo "✅ Parcelle ajoutée : " . $p['producteur'] . "\n";
    } catch (Exception $e) { echo "❌ " . $e->getMessage() . "\n"; }
}

echo "Terminé.\n";
