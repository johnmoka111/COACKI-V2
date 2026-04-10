<?php
/**
 * COACKI - Point d'entrée unique & Routeur
 */

define('BASE_PATH', __DIR__);
define('BASE_URL', '/COACKI');

require_once __DIR__ . '/app/Core/Autoloader.php';
Autoloader::register();

// Chargement des variables d'environnement
\App\Core\Env::load(__DIR__ . '/.env');

// Initialisation de la session et des constantes
session_start();

// Récupération de l'URL
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
if ($url === '') $url = 'home';

$parts = explode('/', $url);

// Table de routage
$routes = [
    'home'          => ['controller' => 'HomeController',        'method' => 'index'],
    'actualites'    => ['controller' => 'ActualitesController',  'method' => 'index'],
    'carte'         => ['controller' => 'CarteController',       'method' => 'index'],
    'dashboard'     => ['controller' => 'DashboardController',   'method' => 'index'],
    'login'         => ['controller' => 'AuthController',        'method' => 'login'],
    'logout'        => ['controller' => 'AuthController',        'method' => 'logout'],
    'forgot_password'=> ['controller' => 'AuthController',       'method' => 'forgotPassword'],
    'verify_questions'=>['controller' => 'AuthController',       'method' => 'verifyQuestions'],
    'update_password'=> ['controller' => 'AuthController',       'method' => 'updatePassword'],
    'register'      => ['controller' => 'AuthController',        'method' => 'register'],
    'partenaire'    => ['controller' => 'PartenaireController',  'method' => 'index'],
    'galerie'       => ['controller' => 'GalerieController',     'method' => 'index'],
    'newsletter/subscribe' => ['controller' => 'NewsletterController', 'method' => 'subscribe'],
];

// Segments spéciaux avec paramètres (ex: actualites/show/xyz)
$segment0 = $parts[0] ?? '';
$segment1 = $parts[1] ?? '';
$segment2 = $parts[2] ?? '';

// Routage pour les actualités
if ($segment0 === 'actualites' && $segment1 === 'show' && $segment2 !== '') {
    $controller = new \App\Controllers\ActualitesController();
    $controller->show($segment2);
    exit;
}

// ─── Routes API (JSON) ───
if ($segment0 === 'api') {
    header('Content-Type: application/json');
    $engagement = new \App\Models\Engagement();
    $body = json_decode(file_get_contents('php://input'), true) ?? [];
    $hash = $body['hash'] ?? '';

    if ($segment1 === 'like' && $_SERVER['REQUEST_METHOD'] === 'POST' && $hash) {
        echo json_encode($engagement->toggleLike($hash));
        exit;
    }
    if ($segment1 === 'share' && $_SERVER['REQUEST_METHOD'] === 'POST' && $hash) {
        $engagement->recordShare($hash, $body['platform'] ?? 'direct');
        $count = (int) \App\Core\Database::getInstance()->query(
            "SELECT COUNT(*) FROM news_partages WHERE news_hash_id = '" . addslashes($hash) . "'"
        )->fetchColumn();
        echo json_encode(['count' => $count]);
        exit;
    }
    if ($segment1 === 'comment' && $_SERVER['REQUEST_METHOD'] === 'POST' && $hash) {
        $ok = $engagement->addComment(
            $hash,
            trim($body['nom'] ?? ''),
            trim($body['email'] ?? ''),
            trim($body['contenu'] ?? '')
        );
        echo json_encode(['success' => $ok]);
        exit;
    }
    echo json_encode(['error' => 'Not found']);
    exit;
}

// Routage pour l'administration (SuperAdmin, Admin, Communication)
if ($segment0 === 'admin') {
    $controller = new \App\Controllers\AdminController();
    // News management
    if ($segment1 === 'news' && !$segment2)               { $controller->listNews(); exit; }
    if ($segment1 === 'news' && $segment2 === 'create')   { $controller->createNews(); exit; }
    if ($segment1 === 'news' && $segment2 === 'store')    { $controller->storeNews(); exit; }
    if ($segment1 === 'news' && $segment2 === 'edit'    && isset($parts[3])) { $controller->editNews($parts[3]); exit; }
    if ($segment1 === 'news' && $segment2 === 'update'  && isset($parts[3])) { $controller->updateNews($parts[3]); exit; }
    if ($segment1 === 'news' && $segment2 === 'archive' && isset($parts[3])) { $controller->archiveNews($parts[3]); exit; }
    // Gallery
    if ($segment1 === 'gallery' && $segment2 === 'create') { $controller->createGallery(); exit; }
    if ($segment1 === 'gallery' && $segment2 === 'store')  { $controller->storeGallery(); exit; }
    // Profile
    if ($segment1 === 'profile' && !$segment2)             { $controller->profile(); exit; }
    if ($segment1 === 'profile' && $segment2 === 'update') { $controller->updateProfile(); exit; }
    
    // Partenariats CRM
    if ($segment1 === 'partenariats' && !$segment2) { $controller->listPartenariats(); exit; }
    if ($segment1 === 'partenariats' && $segment2 === 'lu' && isset($parts[3])) { $controller->marquerLuPartenariat($parts[3]); exit; }

    // Users CRM
    if ($segment1 === 'users' && !$segment2) { $controller->listUsers(); exit; }
    if ($segment1 === 'users' && $segment2 === 'create') { $controller->createUser(); exit; }
    if ($segment1 === 'users' && $segment2 === 'store') { $controller->storeUser(); exit; }
    if ($segment1 === 'users' && $segment2 === 'reset' && isset($parts[3])) { $controller->resetPasswordUser($parts[3]); exit; }
    if ($segment1 === 'users' && $segment2 === 'toggle' && isset($parts[3])) { $controller->toggleUserStatus($parts[3]); exit; }
    if ($segment1 === 'users' && $segment2 === 'update' && isset($parts[3])) { $controller->updateUserRole($parts[3]); exit; }
    if ($segment1 === 'users' && $segment2 === 'delete' && isset($parts[3])) { $controller->deleteUser($parts[3]); exit; }

    // Resets CRM
    if ($segment1 === 'resets' && !$segment2) { $controller->listResets(); exit; }
    if ($segment1 === 'resets' && $segment2 === 'approve' && isset($parts[3])) { $controller->approveReset($parts[3]); exit; }
    if ($segment1 === 'resets' && $segment2 === 'refuse' && isset($parts[3])) { $controller->refuseReset($parts[3]); exit; }

    // Newsletter & Campagnes CRM
    if ($segment1 === 'newsletter' && !$segment2) { $controller->listSubscribers(); exit; }
    if ($segment1 === 'newsletter' && $segment2 === 'delete' && isset($parts[3])) { $controller->deleteSubscriber($parts[3]); exit; }
    if ($segment1 === 'campaign' && $segment2 === 'create') { $controller->createCampaign(); exit; }
    if ($segment1 === 'campaign' && $segment2 === 'send')   { $controller->sendCampaign(); exit; }
}

$matchedRoute = $routes[$url] ?? ($routes[$segment0] ?? null);

if ($matchedRoute) {
    $class  = "\\App\\Controllers\\" . $matchedRoute['controller'];
    $method = $matchedRoute['method'];
    
    if (file_exists(BASE_PATH . "/app/Controllers/" . $matchedRoute['controller'] . ".php")) {
        $ctrl = new $class();
        $ctrl->$method();
    } else {
        http_response_code(404);
        echo "<h1>404 - Page introuvable</h1>";
    }
} else {
    http_response_code(404);
    echo "<h1>404 - Page introuvable</h1>";
}
