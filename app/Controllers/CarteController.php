<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Mapping;

class CarteController extends Controller {
    private $mappingModel;

    public function __construct() {
        $this->mappingModel = new Mapping();
    }

    public function index() {
        $parcelles = $this->mappingModel->getParcelles();
        $stations = $this->mappingModel->getStations();
        
        $data = [
            'title' => 'Carte & Terroir - COACKI',
            'parcelles' => $parcelles,
            'stations' => $stations
        ];
        
        $this->render('carte', $data);
    }
}
