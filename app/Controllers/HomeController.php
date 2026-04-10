<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Accueil - COACKI',
            'description' => 'Coopérative Agricole Agricole du Kivu'
        ];
        
        $this->render('home', $data);
    }
}
