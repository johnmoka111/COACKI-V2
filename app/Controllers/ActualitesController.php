<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\News;
use App\Models\Engagement;

class ActualitesController extends Controller {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new News();
    }

    /**
     * Liste des actualités
     */
    public function index() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 20;

        $news = $this->newsModel->getAllPaginated($page, $limit);
        $total = $this->newsModel->countAll();
        $totalPages = ceil($total / $limit);
        
        foreach ($news as &$article) {
            $article['time_ago'] = $this->timeAgo($article['date_publication']);
            // Fallback de l'auteur s'il y a prenom et nom
            if (!empty($article['prenom']) && !empty($article['nom'])) {
                $article['auteur'] = $article['prenom'] . ' ' . $article['nom'];
            }
        }
        
        $data = [
            'title' => 'Actualités - COACKI',
            'news' => $news,
            'page' => $page,
            'totalPages' => $totalPages
        ];
        
        $this->render('news/index', $data);
    }

    /**
     * Voir un article spécifique
     */
    public function show($hash) {
        $article = $this->newsModel->getByHash($hash);
        
        if (!$article) {
            header("HTTP/1.0 404 Not Found");
            die("Article non trouvé.");
        }

        // Incrémentation des vues
        $this->newsModel->incrementVues($hash);
        $article['vues']++;

        // Engagement stats (likes, commentaires, partages)
        $engagement = new Engagement();
        $stats = $engagement->getStats($hash);
        $comments = $engagement->getComments($hash);
        $hasLiked = $engagement->hasLiked($hash);

        // Articles connexes
        $autresArticles = $this->newsModel->getRecentExcluding($hash, 3);
        
        // Temps relatif réel
        $article['time_ago'] = $this->timeAgo($article['date_publication']);
        // Date et heure complète
        $article['date_heure'] = date('d M Y \u00e0 H\hi', strtotime($article['date_publication']));
        
        foreach ($autresArticles as &$autre) {
            $autre['time_ago'] = $this->timeAgo($autre['date_publication']);
        }
        
        $data = [
            'title'         => $article['titre'] . ' - COACKI',
            'article'       => $article,
            'autresArticles'=> $autresArticles,
            'stats'         => $stats,
            'comments'      => $comments,
            'hasLiked'      => $hasLiked,
            'og'            => [
                'title'       => $article['titre'],
                'description' => $article['extrait'],
                'image'       => $article['image_url']
            ]
        ];
        
        $this->render('news/show', $data);
    }

    private function timeAgo($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'an',
            'm' => 'mois',
            'w' => 'semaine',
            'd' => 'jour',
            'h' => 'heure',
            'i' => 'minute',
            's' => 'seconde',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 && $k !== 'm' ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? 'Publié il y a ' . implode(', ', $string) : 'À l\'instant';
    }
}
