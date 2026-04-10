<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller {
    public function index() {
        $this->requireAuth();
        
        $role = $_SESSION['user']['role'] ?? 'membre';
        $prenom = $_SESSION['user']['prenom'] ?? 'Membre';
        
        $userModel = new \App\Models\User();
        $partModel = new \App\Models\Partenaire();

        $data = [
            'title' => 'Espace Membres - COACKI',
            'user'  => $prenom,
            'role'  => $role,
            'pending_resets' => (int)$userModel->getPendingResetRequestsCount(),
            'pending_parts'  => (int)$partModel->getPendingCount()
        ];
        
        $this->render('dashboard', $data);
    }
}
