<?php

require_once __DIR__ . '/../app/Core/Autoloader.php';
Autoloader::register();

use App\Models\News;
use App\Core\Security;

$newsModel = new News();

// Données de test professionnelles
$articles = [
    [
        'hash_id' => Security::hashId(1),
        'titre' => 'Début de la Grande Récolte 2024 à Munanira',
        'slug' => 'debut-recolte-2024-munanira',
        'image_url' => 'https://images.unsplash.com/photo-1524350303359-8683aa3d29a7?q=80&w=2070&auto=format&fit=crop',
        'extrait' => 'Les premières cerises Bourbon de la saison montrent une qualité exceptionnelle avec une maturation uniforme record.',
        'contenu' => "Le terroir de Munanira vibre actuellement au rythme de la grande récolte annuelle. Nos techniciens agricoles rapportent des indices de maturation très prometteurs, favorisés par une saison des pluies particulièrement clémente.\n\nChaque cerise est cueillie à la main par nos membres coopérateurs, garantissant que seuls les fruits au pic de leur teneur en sucre (Brix) atteignent notre station de lavage. Les premiers tests en laboratoire augurent un profil aromatique complexe avec des notes distinctives de baies sauvages et de jasmin.",
        'auteur' => 'Fleming Cizungu',
        'date_publication' => date('Y-m-d'),
        'temps_lecture' => '4 min',
        'categorie' => 'Récolte'
    ],
    [
        'hash_id' => Security::hashId(2),
        'titre' => 'Inauguration du Nouveau Centre de Séchage Solaire',
        'slug' => 'inauguration-sechage-solaire-2024',
        'image_url' => 'https://images.unsplash.com/photo-1559056191-4e17726e6400?q=80&w=2070&auto=format&fit=crop',
        'extrait' => 'L’installation de nouveaux lits de séchage couverts permet de mieux contrôler l’humidité et d’élever notre score de qualité.',
        'contenu' => "Afin de stabiliser la qualité de nos lots 'Specialty', la COACKI a investi dans une infrastructure de séchage de pointe. Ce centre utilise des lits africains surélevés sous serre ventilée, permettant un séchage lent et homogène, même en cas d'humidité nocturne élevée.\n\nCet investissement stratégique, financé grâce au fonds de développement social de la coopérative, bénéficiera à plus de 150 familles de producteurs du groupement Mbinga-Sud.",
        'auteur' => 'Sarah Ndagano',
        'date_publication' => date('Y-m-d', strtotime('-5 days')),
        'temps_lecture' => '3 min',
        'categorie' => 'Infrastructure'
    ],
    [
        'hash_id' => Security::hashId(3),
        'titre' => 'Le rôle crucial des Femmes dans la Qualité du Café',
        'slug' => 'role-femmes-qualite-cafe',
        'image_url' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb75bb44?q=80&w=2070&auto=format&fit=crop',
        'extrait' => 'Portrait de notre section féminine qui assure le tri densimétrique et manuel des meilleurs micro-lots de la saison.',
        'contenu' => "Au sein de la COACKI, les femmes ne sont pas seulement des productrices, elles sont les gardiennes de la qualité ultime. Lors de la phase de tri manuel, leur attention aux détails permet d'éliminer les moindres défauts que les machines pourraient manquer.\n\nLeur expertise est aujourd'hui reconnue mondialement, et les lots issus de la 'Women Selection' de Munanira ont atteint un score SCA historique de 88 le mois dernier lors d'un test aveugle en Europe.",
        'auteur' => 'John Moka',
        'date_publication' => date('Y-m-d', strtotime('-12 days')),
        'temps_lecture' => '5 min',
        'categorie' => 'Femmes'
    ]
];

// Insertion des données
echo "Initialisation de la base de données (News)...\n";

foreach ($articles as $article) {
    try {
        $newsModel->create($article);
        echo "✅ Article ajouté : " . $article['titre'] . "\n";
    } catch (Exception $e) {
        echo "❌ Erreur : " . $e->getMessage() . "\n";
    }
}

echo "Terminé.\n";
