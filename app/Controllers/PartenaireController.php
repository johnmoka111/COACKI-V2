<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Partenaire;
use App\Core\Security;

class PartenaireController extends Controller {
    private Partenaire $model;

    public function __construct() {
        $this->model = new Partenaire();
    }

    public function index(): void {
        $success = false;
        $error   = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom       = trim($_POST['nom'] ?? '');
            $org       = trim($_POST['organisation'] ?? '');
            $email     = trim($_POST['email'] ?? '');
            $tel       = trim($_POST['telephone'] ?? '');
            $type      = trim($_POST['type'] ?? '');
            $autreDesc = trim($_POST['description_autre'] ?? '');
            $message   = trim($_POST['message'] ?? '');

            // Gestion de l'upload du Logo
            $logoUrl = null;
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/partenaires/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $filename = 'logo_' . time() . '_' . uniqid() . '.' . $ext;
                if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadDir . $filename)) {
                    $logoUrl = '/uploads/partenaires/' . $filename;
                }
            }

            if (empty($nom) || empty($email) || empty($type) || empty($message)) {
                $error = "Veuillez remplir tous les champs obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Adresse email invalide.";
            } else {
                $hash = Security::hashId('p' . time());
                $result = $this->model->create([
                    'hash_id'           => $hash,
                    'nom_complet'       => $nom,
                    'organisation'      => $org,
                    'logo_url'          => $logoUrl,
                    'email'             => $email,
                    'telephone'         => $tel,
                    'type_partenariat'  => $type,
                    'description_autre' => $autreDesc,
                    'message'           => $message,
                ]);
                $success = $result;
                if (!$result) $error = "Erreur lors de l'envoi. Réessayez.";
            }
        }

        $this->render('partenaire', [
            'title'   => 'Devenir Partenaire - COACKI',
            'success' => $success,
            'error'   => $error,
        ]);
    }
}
