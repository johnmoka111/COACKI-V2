<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Gallery;

class GalerieController extends Controller {
    private Gallery $galleryModel;

    public function __construct() {
        $this->galleryModel = new Gallery();
    }

    public function index(): void {
        $items = $this->galleryModel->getAll();
        
        // Simuler des données si la galerie est vide pour tester l'UI
        if (empty($items)) {
            $items = [
                ['url' => 'https://images.unsplash.com/photo-1524350303359-8683aa3d29a7', 'titre' => 'Récolte 2024', 'categorie' => 'Récolte'],
                ['url' => 'https://images.unsplash.com/photo-1559056191-4e17726e6400', 'titre' => 'Séchage Solaire', 'categorie' => 'Infrastructure'],
                ['url' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb75bb44', 'titre' => 'Tri Manuel', 'categorie' => 'Femmes'],
                ['url' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb', 'titre' => 'Plantation', 'categorie' => 'Culture'],
            ];
        }

        $this->render('galerie', [
            'title' => 'Galerie - COACKI',
            'items' => $items
        ]);
    }
}
