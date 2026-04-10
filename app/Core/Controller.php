<?php

namespace App\Core;

abstract class Controller {

    /**
     * Charge une vue avec header/footer
     */
    protected function render(string $view, array $data = []): void {
        extract($data);
        $viewFile = BASE_PATH . "/app/Views/{$view}.php";
        
        if (!file_exists($viewFile)) {
            http_response_code(500);
            die("Vue introuvable : {$view}");
        }

        $isAdminView = (strpos($view, 'admin/') === 0 || $view === 'dashboard');
        
        if ($isAdminView && file_exists(BASE_PATH . '/app/Views/layout/admin_header.php')) {
            require BASE_PATH . '/app/Views/layout/admin_header.php';
            require $viewFile;
            require BASE_PATH . '/app/Views/layout/admin_footer.php';
        } else {
            require BASE_PATH . '/app/Views/layout/header.php';
            require $viewFile;
            require BASE_PATH . '/app/Views/layout/footer.php';
        }
    }

    /**
     * Charge une vue SANS header/footer (JSON, AJAX, pages nues)
     */
    protected function renderRaw(string $view, array $data = []): void {
        extract($data);
        $viewFile = BASE_PATH . "/app/Views/{$view}.php";
        if (!file_exists($viewFile)) { die("Vue introuvable : {$view}"); }
        require $viewFile;
    }

    /**
     * Réponse JSON
     */
    protected function json(mixed $data, int $code = 200): void {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Redirection
     */
    protected function redirect(string $path): void {
        header("Location: " . BASE_URL . "/" . ltrim($path, '/'));
        exit;
    }

    /**
     * Vérifie si l'utilisateur est connecté, sinon redirige
     */
    protected function requireAuth(): void {
        if (empty($_SESSION['user'])) {
            $this->redirect('login');
        }
    }

    /**
     * Vérifie un rôle minimum requis
     */
    protected function requireRole(string ...$roles): void {
        $this->requireAuth();
        $userRole = $_SESSION['user']['role'] ?? '';
        if (!in_array($userRole, $roles)) {
            http_response_code(403);
            die("Accès refusé.");
        }
    }
}
