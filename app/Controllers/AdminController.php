<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\User;
use App\Core\Security;

class AdminController extends Controller {
    
    public function __construct() {
        $this->requireAuth();
    }

    public function createNews() {
        $this->requireRole('superadmin', 'admin', 'communication');
        $this->render('admin/news_create', ['title' => 'Rédiger un article - Admin']);
    }

    public function listNews() {
        $this->requireRole('superadmin', 'admin', 'communication');
        $model = new News();
        $news = $model->getAll();
        $this->render('admin/news_list', ['title' => 'Gérer les articles', 'news' => $news]);
    }

    public function storeNews() {
        $this->requireRole('superadmin', 'admin', 'communication');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = trim($_POST['titre'] ?? '');
            $categorie = trim($_POST['categorie'] ?? '');
            $extrait = trim($_POST['extrait'] ?? '');
            $contenu = $_POST['contenu'] ?? ''; 
            
            // Gestion de l'upload d'image
            $image_url = '/COACKI/public/default-news.jpg'; // Par défaut
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . uniqid() . '.' . $ext;
                $dest = BASE_PATH . '/uploads/news/' . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                    $image_url = '/COACKI/uploads/news/' . $filename;
                }
            }

            $model = new News();
            $hash = Security::hashId(); // Token unique cryptographique 16 chars
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $titre)));

            $model->create([
                'hash_id' => $hash,
                'titre' => $titre,
                'slug' => $slug,
                'image_url' => $image_url,
                'extrait' => $extrait,
                'contenu' => $contenu,
                'auteur' => $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom'],
                'auteur_id' => $_SESSION['user']['id'],
                'date_publication' => date('Y-m-d H:i:s'),
                'temps_lecture' => max(1, ceil(str_word_count(strip_tags($contenu)) / 200)) . ' min',
                'categorie' => $categorie
            ]);
            
            $this->redirect('admin/news');
        }
    }

    public function editNews($hash) {
        $this->requireRole('superadmin', 'admin', 'communication');
        $model = new News();
        $article = $model->getByHash($hash);
        if (!$article) die("Introuvable");
        $this->render('admin/news_edit', ['title' => 'Modifier article', 'article' => $article]);
    }

    public function updateNews($hash) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'hash_id' => $hash,
                'titre' => trim($_POST['titre'] ?? ''),
                'categorie' => trim($_POST['categorie'] ?? ''),
                'extrait' => trim($_POST['extrait'] ?? ''),
                'contenu' => $_POST['contenu'] ?? ''
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . uniqid() . '.' . $ext;
                $dest = BASE_PATH . '/uploads/news/' . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                    $data['image_url'] = '/COACKI/uploads/news/' . $filename;
                }
            }

            $model = new News();
            $model->update($hash, $data);
            $this->redirect('admin/news');
        }
    }

    public function archiveNews($hash) {
        $model = new News();
        $model->archive($hash);
        $this->redirect('admin/news');
    }

    // --- Profil ---
    public function profile() {
        $this->render('admin/profile', ['title' => 'Mon Profil']);
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom = trim($_POST['prenom'] ?? '');
            $nom = trim($_POST['nom'] ?? '');
            
            $avatar_url = null;
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $filename = 'avatar_' . $_SESSION['user']['id'] . '_' . time() . '.' . $ext;
                $dest = BASE_PATH . '/uploads/avatars/' . $filename;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dest)) {
                    $avatar_url = '/COACKI/uploads/avatars/' . $filename;
                }
            }

            $model = new User();
            if ($model->updateProfile($_SESSION['user']['id'], $prenom, $nom, $avatar_url)) {
                // Update Session
                $_SESSION['user']['prenom'] = $prenom;
                $_SESSION['user']['nom'] = $nom;
                if ($avatar_url) $_SESSION['user']['avatar_url'] = $avatar_url;
            }
            
            $this->redirect('dashboard');
        }
    }

    // --- Galerie ---
    public function createGallery() {
        $this->requireRole('superadmin', 'admin', 'communication');
        $this->render('admin/gallery_create', ['title' => 'Ajouter à la galerie - Admin']);
    }

    public function storeGallery() {
        $this->requireRole('superadmin', 'admin', 'communication');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = trim($_POST['titre'] ?? '');
            $categorie = trim($_POST['categorie'] ?? '');
            
            $image_url = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = 'gal_' . time() . '_' . uniqid() . '.' . $ext;
                $dest = BASE_PATH . '/uploads/news/' . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                    $image_url = '/COACKI/uploads/news/' . $filename;
                }
            }

            if ($image_url) {
                $model = new Gallery();
                $model->create([
                    'url' => $image_url,
                    'titre' => $titre,
                    'description' => '',
                    'categorie' => $categorie
                ]);
            }
            
            $this->redirect('galerie');
        }
    }

    // --- CRM / Partenariats ---
    public function listPartenariats() {
        $this->requireRole('superadmin', 'admin'); // Uniquement Admin & SuperAdmin
        $model = new \App\Models\Partenaire();
        $demandes = $model->getAll();
        $this->render('admin/partenariats_list', ['title' => 'Demandes de Partenariat', 'demandes' => $demandes]);
    }

    public function marquerLuPartenariat($hash) {
        $this->requireRole('superadmin', 'admin');
        $model = new \App\Models\Partenaire();
        $model->markAsRead($hash);
        $this->redirect('admin/partenariats');
    }

    // --- CRM / Utilisateurs ---
    public function listUsers() {
        $this->requireRole('superadmin'); // Seul superadmin peut gérer le staff
        $model = new User();
        $users = $model->getAllUsers();
        $this->render('admin/users_list', ['title' => 'Gérer le personnel', 'users' => $users]);
    }

    public function createUser() {
        $this->requireRole('superadmin');
        $this->render('admin/user_create', ['title' => 'Créer un utilisateur']);
    }

    public function storeUser() {
        $this->requireRole('superadmin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new User();
            $data = [
                'role_id'     => (int)$_POST['role_id'],
                'prenom'      => $_POST['prenom'],
                'nom'         => $_POST['nom'],
                'email'       => $_POST['email'],
                'telephone'   => $_POST['telephone'] ?? null,
                'mot_de_passe'=> password_hash($_POST['password'], PASSWORD_BCRYPT),
                'question_1'  => null,
                'reponse_1'   => null,
                'question_2'  => null,
                'reponse_2'   => null,
                'question_3'  => null,
                'reponse_3'   => null,
                'latitude'    => !empty($_POST['latitude']) ? (float)$_POST['latitude'] : null,
                'longitude'   => !empty($_POST['longitude']) ? (float)$_POST['longitude'] : null,
                'photo_champ' => null
            ];

            if (isset($_FILES['photo_champ']) && $_FILES['photo_champ']['error'] === UPLOAD_ERR_OK) {
                $dir = BASE_PATH . '/uploads/champs/';
                if (!is_dir($dir)) mkdir($dir, 0777, true);
                $ext = pathinfo($_FILES['photo_champ']['name'], PATHINFO_EXTENSION);
                $filename = 'champ_' . time() . '.' . $ext;
                if (move_uploaded_file($_FILES['photo_champ']['tmp_name'], $dir . $filename)) {
                    $data['photo_champ'] = BASE_URL . '/uploads/champs/' . $filename;
                }
            }

            $model->createUserFull($data);
            $this->redirect('admin/users');
        }
    }

    public function resetPasswordUser($id) {
        $this->requireRole('superadmin');
        $model = new User();
        $newPass = "COACKI_2026_Reset";
        $model->adminResetPassword($id, password_hash($newPass, PASSWORD_BCRYPT));
        $_SESSION['flash_success'] = "Le mot de passe a été réinitialisé à : " . $newPass;
        $this->redirect('admin/users');
    }

    public function updateUserRole($id) {
        $this->requireRole('superadmin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_id = (int)$_POST['role_id'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $model = new User();
            $model->updateRoleInfo($id, $role_id, $prenom, $nom);
            $this->redirect('admin/users');
        }
    }

    public function deleteUser($id) {
        $this->requireRole('superadmin');
        $model = new User();
        $model->delete($id);
        $this->redirect('admin/users');
    }

    public function toggleUserStatus($id) {
        $this->requireRole('superadmin');
        $model = new User();
        $model->toggleStatus($id);
        $_SESSION['flash_success'] = "Statut utilisateur mis à jour avec succès.";
        $this->redirect('admin/users');
    }
    // --- CRM / Sécurité & Resets ---
    public function listResets() {
        $this->requireRole('superadmin', 'admin');
        $model = new User();
        $requests = $model->getPendingResetRequests();
        $history = $model->getResetRequestsHistory();
        $this->render('admin/resets_list', [
            'title' => 'Demandes de réinitialisation', 
            'requests' => $requests,
            'history' => $history
        ]);
    }

    public function approveReset($id) {
        $this->requireRole('superadmin', 'admin');
        $userModel = new User();
        
        // Trouver la demande pour avoir l'user_id
        $db = \App\Core\Database::getInstance(); 
        $stmt = $db->prepare("SELECT user_id FROM password_reset_requests WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $req = $stmt->fetch();
        
        if ($req) {
            // 1. Générer mot de passe complexe (8 chars)
            $chars = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789!@#$%&*";
            $newPass = "";
            for ($i = 0; $i < 8; $i++) {
                $newPass .= $chars[rand(0, strlen($chars) - 1)];
            }
            
            // 2. Mettre à jour en BDD
            $userModel->adminResetPassword($req['user_id'], password_hash($newPass, PASSWORD_BCRYPT));
            
            // 3. Marquer la demande comme approuvée
            $userModel->updateResetRequestStatus($id, 'approuve', $_SESSION['user']['id']);
            
            // 4. (Simulation Email avec johnmoka2024@gmail.com)
            $stmtUser = $db->prepare("SELECT email FROM utilisateurs WHERE id = :id");
            $stmtUser->execute(['id' => $req['user_id']]);
            $u = $stmtUser->fetch();
            
            if ($u) {
                $subject = "Votre nouveau mot de passe COACKI";
                $message = "<h1>Demande Approuvée</h1><p>Bonjour, votre demande a été approuvée par un administrateur.</p><p>Votre nouveau mot de passe est : <b>" . $newPass . "</b></p><br><p>Connectez-vous ici : " . BASE_URL . "/login</p>";
                \App\Services\MailService::send($u['email'], $subject, $message);
            }

            $_SESSION['flash_success'] = "Approuvé ! Mot de passe : " . $newPass . ". Le membre a reçu un email.";
            $this->redirect('admin/resets');
        }
    }

    public function refuseReset($id) {
        $this->requireRole('superadmin', 'admin');
        $userModel = new User();
        $userModel->updateResetRequestStatus($id, 'refuse', $_SESSION['user']['id']);
        $this->redirect('admin/resets');
    }

    // --- Newsletter & Campagnes ---
    public function listSubscribers() {
        $this->requireRole('superadmin', 'admin', 'communication');
        $model = new \App\Models\Newsletter();
        $subscribers = $model->getAllSubscribers();
        $this->render('admin/newsletter_list', [
            'title' => 'Abonnés Newsletter',
            'subscribers' => $subscribers
        ]);
    }

    public function deleteSubscriber($id) {
        $this->requireRole('superadmin', 'admin');
        $model = new \App\Models\Newsletter();
        $model->deleteSubscriber($id);
        $this->redirect('admin/newsletter');
    }

    public function createCampaign() {
        $this->requireRole('superadmin', 'admin', 'communication');
        $newsModel = new News();
        $articles = $newsModel->getAll(); 
        $this->render('admin/campaign_create', [
            'title' => 'Lancer une campagne',
            'articles' => $articles
        ]);
    }

    public function sendCampaign() {
        $this->requireRole('superadmin', 'admin', 'communication');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedHashes = $_POST['news_ids'] ?? [];
            if (empty($selectedHashes)) {
                $this->redirect('admin/campaign/create');
            }

            $newsModel = new News();
            $nlModel = new \App\Models\Newsletter();
            $subscribers = $nlModel->getAllSubscribers();
            $allArticles = [];
            
            foreach ($selectedHashes as $hash) {
                $article = $newsModel->getByHash($hash);
                if ($article) $allArticles[] = $article;
            }

            // Construction du mail HTML (Design Épuré "Google Like")
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
            
            $html = "<div style='font-family: \"Google Sans\", Roboto, Arial, sans-serif; background-color: #f4f7f6; padding: 40px 20px; text-align: center;'>";
            $html .= "<div style='max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: left;'>";
            
            // Header
            $html .= "<div style='padding: 40px 40px 30px; text-align: center;'>";
            $html .= "<div style='width: 60px; height: 60px; background: #032E1A; border-radius: 16px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;'><span style='color: #EAB308; font-size: 32px; font-weight: 900;'>C</span></div>";
            $html .= "<h1 style='color: #032E1A; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px;'>COACKI NEWS</h1>";
            $html .= "<p style='color: #5f6368; font-size: 14px; margin-top: 8px; margin-bottom: 0;'>Les dernières actualités de votre coopérative</p>";
            $html .= "</div>";
            
            // Body
            $html .= "<div style='padding: 0 40px 40px;'>";
            $html .= "<p style='color: #3c4043; font-size: 15px; line-height: 1.6; margin-top: 0; margin-bottom: 30px;'>Bonjour,<br><br>Voici une sélection des dernières actualités et initiatives de la coopérative COACKI au Sud-Kivu.</p>";

            foreach ($allArticles as $art) {
                // S'assurer que le lien de l'image est absolu
                $imgSrc = strpos($art['image_url'], 'http') === 0 ? $art['image_url'] : 'http://' . $host . $art['image_url'];
                $link = 'http://' . $host . BASE_URL . '/actualites/show/' . $art['slug'];

                $html .= "<div style='margin-bottom: 24px; background: #ffffff; border: 1px solid #e8eaed; border-radius: 12px; overflow: hidden;'>";
                if ($art['image_url']) {
                    $html .= "<img src='" . $imgSrc . "' style='width: 100%; height: 180px; object-fit: cover; display: block;' alt=''>";
                }
                $html .= "<div style='padding: 24px;'>";
                $html .= "<h3 style='margin: 0 0 8px; color: #032E1A; font-size: 18px; line-height: 1.4; font-weight: 700;'>" . htmlspecialchars($art['titre']) . "</h3>";
                $html .= "<p style='font-size: 14px; color: #5f6368; line-height: 1.6; margin: 0 0 20px;'>" . htmlspecialchars($art['extrait']) . "</p>";
                $html .= "<a href='" . $link . "' style='display: inline-block; background-color: #032E1A; color: #EAB308; padding: 10px 24px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 13px;'>Lire l'article complet</a>";
                $html .= "</div></div>";
            }

            $html .= "</div>"; // End Body
            
            // Footer
            $html .= "<div style='background-color: #f8f9fa; padding: 24px 40px; text-align: center; border-top: 1px solid #e8eaed;'>";
            $html .= "<p style='color: #80868b; font-size: 12px; line-height: 1.5; margin: 0;'>Vous recevez cet email car vous êtes abonné à la newsletter de COACKI.<br>&copy; " . date('Y') . " COACKI Cooperative - Tous droits réservés.</p>";
            $html .= "</div></div></div>";

            // Envoi à tous les abonnés
            $count = 0;
            foreach ($subscribers as $sub) {
                \App\Services\MailService::send($sub['email'], "COACKI News : " . count($allArticles) . " nouveaux articles à découvrir", $html);
                $count++;
            }

            $_SESSION['flash_success'] = "Campagne envoyée avec succès à " . $count . " abonnés !";
            $this->redirect('admin/newsletter');
        }
    }
}
