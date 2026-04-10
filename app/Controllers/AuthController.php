<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Security;

class AuthController extends Controller {
    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /* ──────────────── LOGIN ──────────────── */
    public function login(): void {
        if (!empty($_SESSION['user'])) {
            $this->redirect('dashboard');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                $user = $this->userModel->findByEmail($email);
                if ($user && password_verify($password, $user['mot_de_passe'])) {
                    $_SESSION['user'] = [
                        'id'         => $user['id'],
                        'hash'       => $user['hash_id'],
                        'prenom'     => $user['prenom'],
                        'nom'        => $user['nom'],
                        'email'      => $user['email'],
                        'role'       => $user['role'],
                        'avatar_url' => $user['avatar_url'] ?? null,
                    ];
                    $this->redirect('dashboard');
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        $this->render('auth/login', ['title' => 'Connexion - COACKI', 'error' => $error]);
    }

    /* ──────────────── REGISTER ──────────────── */
    public function register(): void {
        if (!empty($_SESSION['user'])) {
            $this->redirect('dashboard');
        }

        $error   = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom   = trim($_POST['prenom'] ?? '');
            $nom      = trim($_POST['nom'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $tel      = trim($_POST['telephone'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm  = $_POST['confirm_password'] ?? '';

            if (empty($prenom) || empty($nom) || empty($email) || empty($password)) {
                $error = "Tous les champs obligatoires doivent être remplis.";
            } elseif ($password !== $confirm) {
                $error = "Les mots de passe ne correspondent pas.";
            } elseif (strlen($password) < 6) {
                $error = "Le mot de passe doit contenir au moins 6 caractères.";
            } elseif ($this->userModel->emailExists($email)) {
                $error = "Cet email est déjà utilisé.";
            } else {
                // Gestion Photo du champ si applicable
                $photo_champ = null;
                if (isset($_FILES['photo_champ']) && $_FILES['photo_champ']['error'] === UPLOAD_ERR_OK) {
                    $dir = BASE_PATH . '/uploads/champs/';
                    if (!is_dir($dir)) mkdir($dir, 0777, true);
                    $ext = pathinfo($_FILES['photo_champ']['name'], PATHINFO_EXTENSION);
                    $filename = 'public_champ_' . time() . '.' . $ext;
                    if (move_uploaded_file($_FILES['photo_champ']['tmp_name'], $dir . $filename)) {
                        $photo_champ = BASE_URL . '/uploads/champs/' . $filename;
                    }
                }

                $result = $this->userModel->createUserFull([
                    'role_id'     => 4, // membre
                    'prenom'      => $prenom,
                    'nom'         => $nom,
                    'email'       => $email,
                    'telephone'   => $tel,
                    'mot_de_passe'=> password_hash($password, PASSWORD_BCRYPT),
                    'question_1'  => $_POST['question_1'] ?? null,
                    'reponse_1'   => $_POST['reponse_1'] ?? null,
                    'question_2'  => $_POST['question_2'] ?? null,
                    'reponse_2'   => $_POST['reponse_2'] ?? null,
                    'question_3'  => $_POST['question_3'] ?? null,
                    'reponse_3'   => $_POST['reponse_3'] ?? null,
                    'latitude'    => !empty($_POST['latitude']) ? (float)$_POST['latitude'] : null,
                    'longitude'   => !empty($_POST['longitude']) ? (float)$_POST['longitude'] : null,
                    'photo_champ' => $photo_champ
                ]);

                if ($result) {
                    $success = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
                } else {
                    $error = "Une erreur est survenue. Réessayez.";
                }
            }
        }

        $this->render('auth/register', [
            'title'   => 'Créer un compte - COACKI',
            'error'   => $error,
            'success' => $success,
        ]);
    }

    /* ──────────────── LOGOUT ──────────────── */
    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "/login");
        exit();
    }

    // --- SÉCURITÉ RENFORCÉE : MOT DE PASSE OUBLIÉ ---
    
    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            
            // Requete directe pour trouver l'utilisateur et ses questions
            $db = \App\Core\Database::getInstance();
            $stmt = $db->prepare("SELECT id, question_1, question_2, question_3 FROM utilisateurs WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $u = $stmt->fetch();
            
            if ($u && !empty($u['question_1'])) {
                $_SESSION['reset_user_id'] = $u['id'];
                $this->render('auth/security_questions', [
                    'q1' => $u['question_1'],
                    'q2' => $u['question_2'],
                    'q3' => $u['question_3']
                ]);
                return;
            } else {
                return $this->render('auth/forgot_password', ['error' => 'Email introuvable ou questions non configurées.']);
            }
        }
        $this->render('auth/forgot_password');
    }

    public function verifyQuestions() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['reset_user_id'])) {
            $id = $_SESSION['reset_user_id'];
            $db = \App\Core\Database::getInstance();
            $stmt = $db->prepare("SELECT reponse_1, reponse_2, reponse_3 FROM utilisateurs WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $u = $stmt->fetch();
            
            // On vérifie (insensible à la casse)
            if (strtolower(trim($_POST['rep1'])) === strtolower(trim($u['reponse_1'])) &&
                strtolower(trim($_POST['rep2'])) === strtolower(trim($u['reponse_2'])) &&
                strtolower(trim($_POST['rep3'])) === strtolower(trim($u['reponse_3']))) {
                
                // On crée une demande de réinitialisation officielle
                $db->prepare("INSERT INTO password_reset_requests (user_id, status) VALUES (:uid, 'en_attente')")
                   ->execute(['uid' => $id]);

                unset($_SESSION['reset_user_id']);
                
                return $this->render('auth/login', [
                    'error' => 'Vos réponses sont correctes. Votre demande de réinitialisation a été envoyée aux administrateurs pour approbation. Vous recevrez un nouveau code par message après validation.'
                ]);
            } else {
                return $this->render('auth/forgot_password', ['error' => 'Les réponses de sécurité sont incorrectes.']);
            }
        }
        $this->redirect('login');
    }

    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['reset_authorized'])) {
            $id = $_SESSION['reset_user_id'];
            $newPass = password_hash($_POST['password'], PASSWORD_BCRYPT);
            
            $db = \App\Core\Database::getInstance();
            $stmt = $db->prepare("UPDATE utilisateurs SET mot_de_passe = :pwd WHERE id = :id");
            $stmt->execute(['pwd' => $newPass, 'id' => $id]);
            
            unset($_SESSION['reset_user_id']);
            unset($_SESSION['reset_authorized']);
            
            return $this->render('auth/login', ['error' => 'Mot de passe réinitialisé. Connectez-vous.']);
        }
        $this->redirect('login');
    }
}
