<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class NewsletterController extends Controller {

    public function subscribe() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);

            if (!$email) {
                echo json_encode(['status' => 'error', 'message' => 'Email invalide.']);
                exit;
            }

            $db = Database::getInstance();
            
            // Vérifier si déjà abonné
            $stmt = $db->prepare("SELECT id FROM newsletter WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                echo json_encode(['status' => 'error', 'message' => 'Déjà abonné.']);
                exit;
            }

            $stmt = $db->prepare("INSERT INTO newsletter (email) VALUES (:email)");
            if ($stmt->execute(['email' => $email])) {
                // Envoi via MailService
                $subject = "Bienvenue à la Newsletter COACKI";
                $message = "<h1>Merci de vous être abonné !</h1><p>Vous recevrez désormais les actualités de COACKI directement dans votre boîte mail.</p>";
                
                \App\Services\MailService::send($email, $subject, $message);
                
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur BDD.']);
            }
            exit;
        }
    }
}
