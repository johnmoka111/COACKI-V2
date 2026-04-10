<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Administration COACKI' ?></title>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        body { background:#FDFCF8; -webkit-tap-highlight-color:transparent; }
        .no-scrollbar::-webkit-scrollbar { display:none; }
        .no-scrollbar { -ms-overflow-style:none; scrollbar-width:none; }
        
        /* Premium Select Styling */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%231B4332' stroke-width='3'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem !important;
        }
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
            background: #FDFCF8;
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
            background: whitesmoke;
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
        .premium-input:focus + .premium-label {
            color: #D4AF37;
        }
    </style>
</head>
<body class="font-sans text-forest bg-coacki-bg md:flex min-h-screen overflow-x-hidden">

<!-- ═══ SIDEBAR ADMIN DESKTOP ═══ -->
<aside class="hidden md:flex flex-col w-64 fixed inset-y-0 left-0 bg-forest border-r border-forest/10 z-50 text-white shadow-2xl">
    <div class="h-24 flex items-center justify-center border-b border-white/5 px-6">
        <a href="<?= BASE_URL ?>/dashboard" class="flex flex-col items-center gap-2 group transition-all" title="Tableau de bord">
            <img src="<?= BASE_URL ?>/logo.png" alt="Logo" class="h-12 w-auto object-contain brightness-0 invert opacity-90 group-hover:opacity-100 transition-opacity">
            <span class="font-black text-xs uppercase tracking-[0.3em] text-gold/80 group-hover:text-gold transition-colors">COACKI Admin</span>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-8 space-y-2 relative no-scrollbar">
        <div class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-4 px-3">Menu Principal</div>
        
        <?php $url = trim($_GET['url'] ?? '', '/'); ?>
        <a href="<?= BASE_URL ?>/admin/profile" class="flex items-center gap-3 px-3 py-3 rounded-xl font-bold text-sm transition-all <?= (strpos($url, 'admin/profile') === 0) ? 'bg-gold text-forest' : 'hover:bg-white/10 text-white/80 hover:text-white' ?>">
            <i data-lucide="user-cog" style="width:18px;height:18px"></i> Mon Profil
        </a>
        
        <?php if(isset($_SESSION['user']) && in_array($_SESSION['user']['role'], ['superadmin', 'admin'])): ?>
        <a href="<?= BASE_URL ?>/admin/users" class="flex items-center gap-3 px-3 py-3 rounded-xl font-bold text-sm transition-all <?= (strpos($url, 'admin/users') === 0) ? 'bg-gold text-forest' : 'hover:bg-white/10 text-white/80 hover:text-white' ?>">
            <i data-lucide="users" style="width:18px;height:18px"></i> Personnel CRM
        </a>
        <a href="<?= BASE_URL ?>/admin/resets" class="flex items-center gap-3 px-3 py-3 rounded-xl font-bold text-sm transition-all <?= (strpos($url, 'admin/resets') === 0) ? 'bg-gold text-forest' : 'hover:bg-white/10 text-white/80 hover:text-white' ?>">
            <i data-lucide="shield-alert" style="width:18px;height:18px"></i> Demandes Sécurité
        </a>
        <?php endif; ?>
        
        <div class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-4 px-3 mt-8">Communication</div>
        
        <a href="<?= BASE_URL ?>/admin/news" class="flex items-center gap-3 px-3 py-3 rounded-xl font-bold text-sm transition-all <?= (strpos($url, 'admin/news') === 0) ? 'bg-gold text-forest' : 'hover:bg-white/10 text-white/80 hover:text-white' ?>">
            <i data-lucide="newspaper" style="width:18px;height:18px"></i> Gestion Actualités
        </a>
        <a href="<?= BASE_URL ?>/admin/newsletter" class="flex items-center gap-3 px-3 py-3 rounded-xl font-bold text-sm transition-all <?= (strpos($url, 'admin/newsletter') === 0) ? 'bg-gold text-forest' : 'hover:bg-white/10 text-white/80 hover:text-white' ?>">
            <i data-lucide="mail-search" style="width:18px;height:18px"></i> Base d'Abonnés
        </a>
        <a href="<?= BASE_URL ?>/admin/campaign/create" class="flex items-center gap-3 px-3 py-3 rounded-xl font-bold text-sm transition-all <?= (strpos($url, 'admin/campaign') === 0) ? 'bg-gold text-forest' : 'hover:bg-white/10 text-white/80 hover:text-white' ?>">
            <i data-lucide="send-to-back" style="width:18px;height:18px"></i> Campagnes Mail
        </a>
    </nav>
    
    <div class="p-4 border-t border-white/10">
        <a href="<?= BASE_URL ?>/logout" class="flex items-center justify-center gap-2 w-full py-3 bg-red-500/20 text-red-400 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
            Déconnexion
        </a>
    </div>
</aside>

<!-- ═══ HEADER NAV MOBILE ═══ -->
<header class="md:hidden fixed top-0 left-0 w-full z-40 bg-forest border-b border-forest/10 h-16 flex items-center justify-between px-5">
    <a href="<?= BASE_URL ?>/dashboard" class="flex items-center gap-2">
        <div class="h-9 w-9 bg-white rounded-xl flex items-center justify-center">
            <i data-lucide="coffee" class="text-forest" style="width:18px;height:18px"></i>
        </div>
        <span class="font-black text-xl tracking-tighter text-white">ADMIN</span>
    </a>
    <a href="<?= BASE_URL ?>/logout" class="h-9 w-9 bg-red-500/20 rounded-xl flex items-center justify-center text-red-500 transition-colors">
        <i data-lucide="log-out" style="width:16px;height:16px"></i>
    </a>
</header>
<nav id="mobileBottomNav" class="md:hidden fixed bottom-0 left-0 w-full z-40 bg-white border-t border-zinc-200 h-16 flex items-center justify-around px-2 shadow-[0_-10px_40px_rgba(0,0,0,0.05)] transition-transform duration-300">
    <a href="<?= BASE_URL ?>/admin/resets" class="flex flex-col items-center gap-1 text-zinc-400 hover:text-forest transition-colors">
        <i data-lucide="shield-alert" style="width:20px;height:20px"></i>
    </a>
    <a href="<?= BASE_URL ?>/admin/news" class="flex flex-col items-center gap-1 text-zinc-400 hover:text-forest transition-colors">
        <i data-lucide="newspaper" style="width:20px;height:20px"></i>
    </a>
    <a href="<?= BASE_URL ?>/admin/profile" class="h-10 w-10 bg-forest text-gold rounded-full flex items-center justify-center shadow-lg -translate-y-4 shadow-xl shadow-forest/30">
        <i data-lucide="user" style="width:20px;height:20px"></i>
    </a>
    <a href="<?= BASE_URL ?>/admin/newsletter" class="flex flex-col items-center gap-1 text-zinc-400 hover:text-forest transition-colors">
        <i data-lucide="mail-search" style="width:20px;height:20px"></i>
    </a>
    <a href="<?= BASE_URL ?>/logout" class="flex flex-col items-center gap-1 text-red-400 hover:text-red-500 transition-colors">
        <i data-lucide="log-out" style="width:20px;height:20px"></i>
    </a>
</nav>

<!-- ═══ HEADER DESKTOP MAIN AREA ═══ -->
<div class="flex-1 md:ml-64 flex flex-col min-h-screen relative w-full pt-16 md:pt-0 pb-20 md:pb-0">
    <header class="hidden md:flex h-20 bg-white/80 backdrop-blur-xl border-b border-zinc-200/50 sticky top-0 z-30 items-center justify-between px-8 shadow-sm">
        <div>
            <h2 class="text-xl font-black text-forest tracking-tight"><?= $title ?? 'Administration' ?></h2>
            <p class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest mt-1">Espace sécurisé - COACKI Platform</p>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-xs font-black text-forest"><?= htmlspecialchars($_SESSION['user']['prenom'] ?? '') . ' ' . htmlspecialchars($_SESSION['user']['nom'] ?? '') ?></p>
                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-widest mt-0.5"><?= htmlspecialchars($_SESSION['user']['role'] ?? '') ?></p>
                </div>
                <img src="<?= htmlspecialchars($_SESSION['user']['avatar_url'] ?? BASE_URL . '/assets/img/default-avatar.png') ?>" alt="Admin Avatar" class="h-10 w-10 rounded-xl object-cover shadow-md border border-zinc-100">
            </div>
        </div>
    </header>

    <!-- ═══ MAIN CONTENT AREA ═══ -->
    <main class="flex-1 w-full relative">
