<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO & OpenGraph pour les partages -->
    <title><?= $title ?? 'COACKI - Coopérative Agricole de Kalehe' ?></title>
    <meta name="description" content="<?= $og['description'] ?? 'Découvrez notre coopérative basée à Kalehe, RDC.' ?>">
    
    <?php if(isset($og)): ?>
    <!-- OpenGraph (Facebook, LinkedIn, etc.) -->
    <meta property="og:title" content="<?= htmlspecialchars($og['title'] ?? $title ?? '') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($og['description'] ?? '') ?>">
    <meta property="og:image" content="<?= htmlspecialchars(isset($og['image']) ? (strpos($og['image'], 'http') === 0 ? $og['image'] : 'http://'.$_SERVER['HTTP_HOST'].$og['image']) : '') ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) ?>">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($og['title'] ?? $title ?? '') ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($og['description'] ?? '') ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars(isset($og['image']) ? (strpos($og['image'], 'http') === 0 ? $og['image'] : 'http://'.$_SERVER['HTTP_HOST'].$og['image']) : '') ?>">
    <?php endif; ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: '#1B4332',
                        earth:  '#603813',
                        gold:   '#D4AF37',
                        'coacki-bg': '#FDFCF8',
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style>
        /* Premium Select Styling Everywhere */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%231B4332' stroke-width='3'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem !important;
        }

        body { background:#FDFCF8; -webkit-tap-highlight-color:transparent; }
        .no-scrollbar::-webkit-scrollbar { display:none; }
        .no-scrollbar { -ms-overflow-style:none; scrollbar-width:none; }
        /* Bottom Sheet System */
        .bottom-sheet {
            position: fixed;
            inset: 0;
            background: rgba(27, 67, 50, 0.4);
            backdrop-filter: blur(8px);
            z-index: 5000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }
        .bottom-sheet.active {
            opacity: 1;
            pointer-events: auto;
        }
        .bottom-sheet-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-radius: 40px 40px 0 0;
            padding: 2.5rem 2rem;
            transform: translateY(100%);
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 -20px 50px rgba(0,0,0,0.1);
        }
        .bottom-sheet.active .bottom-sheet-content {
            transform: translateY(0);
        }
        .bottom-sheet-handle {
            width: 40px;
            height: 4px;
            background: #E5E7EB;
            border-radius: 2px;
            margin: -1.5rem auto 2rem;
        }

        /* Premium Select Replacement (Mobile) */
        .premium-select-trigger {
            width: 100%;
            background: white;
            border: 1px solid rgba(27, 67, 50, 0.1);
            border-radius: 20px;
            padding: 1.25rem 1.5rem;
            text-align: left;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .premium-select-trigger:active { scale: 0.98; }
        
        /* Floating/Focused Label Styles */
        .premium-form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .premium-input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid transparent;
            border-radius: 20px;
            padding: 1.5rem 1.25rem 0.75rem;
            font-size: 0.95rem;
            font-weight: 700;
            color: #1B4332;
            transition: all 0.3s ease;
            outline: none;
        }
        .premium-input:focus {
            border-color: #D4AF37;
            background: white;
            box-shadow: 0 10px 30px -10px rgba(212, 175, 55, 0.2);
        }
        .premium-label {
            position: absolute;
            top: 0.65rem;
            left: 1.25rem;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #9CA3AF;
            pointer-events: none;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="font-sans text-forest selection:bg-gold/30">

<?php $currentUrl = trim($_GET['url'] ?? '', '/'); ?>

<!-- ═══ NAV DESKTOP ═══ -->
<nav class="hidden md:flex fixed w-full z-50 bg-white/90 backdrop-blur-xl border-b border-forest/10 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 h-20 w-full flex items-center justify-between">
        <a href="<?= BASE_URL ?>/" class="flex items-center gap-3">
            <div class="h-10 w-10 bg-forest rounded-xl flex items-center justify-center shadow-lg">
                <i data-lucide="coffee" class="text-gold" style="width:22px;height:22px"></i>
            </div>
            <span class="font-black text-2xl tracking-tighter text-forest">COACKI</span>
        </a>

        <div class="flex items-center gap-1 text-[11px] font-black uppercase tracking-widest text-forest/60">
            <?php
            $navLinks = [
                ''           => 'Accueil',
                'actualites' => 'Actualités',
                'carte'      => 'Carte',
                'partenaire' => 'Partenaire',
            ];
            foreach ($navLinks as $slug => $label):
                $isActive = ($currentUrl === $slug);
            ?>
            <a href="<?= BASE_URL ?>/<?= $slug ?>"
               class="px-3 py-2 rounded-lg transition-all <?= $isActive ? 'text-forest bg-forest/5 border-b-2 border-gold' : 'hover:text-forest hover:bg-forest/5' ?>">
                <?= $label ?>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="flex items-center gap-3">
            <a href="<?= BASE_URL ?>/partenaire"
               class="border-2 border-forest/20 text-forest px-5 py-2 rounded-full text-[11px] font-black uppercase tracking-widest hover:border-gold hover:text-gold transition-all flex items-center gap-2">
                <i data-lucide="handshake" style="width:16px;height:16px"></i> Partenaire
            </a>
            <?php if (!empty($_SESSION['user'])): ?>
                <a href="<?= BASE_URL ?>/dashboard"
                   class="bg-forest text-gold px-6 py-2.5 rounded-full text-sm font-black shadow-lg hover:scale-105 transition-all">
                    <i data-lucide="layout-dashboard" style="width:14px;height:14px;display:inline"></i>
                    Dashboard
                </a>
                <a href="<?= BASE_URL ?>/logout"
                   class="text-[11px] font-black text-zinc-400 hover:text-red-500 transition-colors">Déconnexion</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/login"
                   class="bg-forest text-gold px-6 py-2.5 rounded-full text-sm font-black shadow-lg hover:scale-105 transition-all">
                    Espace Membres
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- ═══ NAV MOBILE TOP ═══ -->
<header class="md:hidden fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-xl border-b border-forest/10 h-16 flex items-center justify-between px-5">
    <a href="<?= BASE_URL ?>/" class="flex items-center gap-2">
        <div class="h-9 w-9 bg-forest rounded-xl flex items-center justify-center">
            <i data-lucide="coffee" class="text-gold" style="width:18px;height:18px"></i>
        </div>
        <span class="font-black text-xl tracking-tighter text-forest">COACKI</span>
    </a>
    <?php if (!empty($_SESSION['user'])): ?>
        <a href="<?= BASE_URL ?>/logout" class="h-9 w-9 bg-coacki-bg rounded-xl border border-forest/10 flex items-center justify-center">
            <i data-lucide="log-out" style="width:16px;height:16px;color:#1B4332"></i>
        </a>
    <?php else: ?>
        <a href="<?= BASE_URL ?>/login"
           class="text-[10px] font-black text-forest uppercase tracking-widest bg-gold/10 px-4 py-2 rounded-full border border-gold/20">
            Connexion
        </a>
    <?php endif; ?>
</header>

<!-- ═══ CONTENU PRINCIPAL ═══ -->
<main class="pt-16 md:pt-20 pb-24 md:pb-0">
