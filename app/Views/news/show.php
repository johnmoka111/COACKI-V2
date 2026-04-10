<article class="bg-coacki-bg min-h-screen pb-12">

    <!-- Barre de progression de lecture (fixée en haut) -->
    <div id="readingProgress" class="fixed top-0 left-0 z-[200] h-1 bg-gold transition-all duration-100" style="width:0%"></div>

    <!-- 🟢 VERSION MOBILE: En-tête Edge-to-Edge -->
    <header class="md:hidden relative h-[55vh] w-full overflow-hidden">
        <img src="<?= $article['image_url'] ?>" alt="<?= $article['titre'] ?>" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-forest via-forest/60 to-transparent"></div>
        
        <div class="absolute inset-x-0 bottom-0 px-5 pb-8 space-y-4">
            <a href="<?= BASE_URL ?>/actualites" class="inline-flex items-center gap-1.5 text-gold font-black text-[10px] uppercase tracking-widest bg-forest/40 backdrop-blur-md px-3 py-1.5 rounded-full border border-gold/20">
                <i data-lucide="arrow-left" style="width:12px;height:12px"></i> Retour
            </a>
            
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3 py-1 bg-gold text-forest rounded-full text-[9px] font-black uppercase tracking-widest">
                    <?= $article['categorie'] ?>
                </span>
                <span class="text-white/80 text-[10px] font-bold">
                    <?= $article['time_ago'] ?? date('d M Y', strtotime($article['date_publication'])) ?>
                </span>
                <span class="text-white/50 text-[10px] flex items-center gap-1">
                    <i data-lucide="eye" style="width:10px;height:10px"></i> <?= $article['vues'] ?? 0 ?>
                </span>
            </div>
            
            <h1 class="text-3xl font-black text-white tracking-tighter leading-tight drop-shadow-md">
                <?= $article['titre'] ?>
            </h1>
        </div>
    </header>

    <!-- 🟢 VERSION DESKTOP -->
    <header class="hidden md:block relative h-[60vh] w-full overflow-hidden mt-20">
        <img src="<?= $article['image_url'] ?>" alt="<?= $article['titre'] ?>" class="w-full h-full object-cover absolute inset-0 z-0 scale-105">
        <div class="absolute inset-0 bg-forest/80 backdrop-blur-sm z-10"></div>
        
        <div class="relative z-20 max-w-5xl mx-auto px-8 h-full flex flex-col justify-center space-y-8 pt-10">
            <div>
                <a href="<?= BASE_URL ?>/actualites" class="inline-flex items-center gap-2 text-gold font-black text-[11px] uppercase tracking-widest hover:text-white transition-colors mb-6">
                    <i data-lucide="arrow-left" style="width:14px;height:14px"></i> Toutes les actualités
                </a>
                
                <div class="flex items-center gap-4 mb-4 flex-wrap">
                    <span class="px-4 py-1.5 bg-gold text-forest rounded-full text-[11px] font-black uppercase tracking-widest">
                        <?= $article['categorie'] ?>
                    </span>
                    <span class="text-white/60 text-[11px] font-bold flex items-center gap-2">
                        <i data-lucide="calendar" style="width:14px;height:14px"></i>
                        <?= $article['date_heure'] ?? date('d M Y à H\hi', strtotime($article['date_publication'])) ?>
                    </span>
                    <span class="text-white/60 text-[11px] font-bold flex items-center gap-2">
                        <i data-lucide="clock" style="width:14px;height:14px"></i> <?= $article['temps_lecture'] ?>
                    </span>
                    <span class="text-white/60 text-[11px] font-bold flex items-center gap-2">
                        <i data-lucide="eye" style="width:14px;height:14px"></i> <?= $article['vues'] ?? 0 ?> vue(s)
                    </span>
                </div>
                
                <h1 class="text-6xl font-black text-white tracking-tighter leading-[1.05] drop-shadow-xl max-w-4xl">
                    <?= $article['titre'] ?>
                </h1>
            </div>
        </div>
    </header>

    <!-- 🟢 CORPS DE L'ARTICLE -->
    <div id="articleBody" class="max-w-4xl mx-auto px-5 md:px-8 py-10 md:py-16 bg-white md:-mt-16 relative z-30 md:rounded-[40px] md:shadow-2xl border-t md:border border-forest/5">
        
        <?php 
        $avatarUrl = !empty($article['avatar_url']) ? $article['avatar_url'] : null;
        $authorName = !empty($article['prenom']) ? $article['prenom'] . ' ' . $article['nom'] : $article['auteur'];
        $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&background=032E1A&color=EAB308&size=128';
        ?>

        <!-- Auteur (Mobile) -->
        <div class="md:hidden flex items-center gap-3 pb-8 border-b border-forest/5 mb-8">
            <img src="<?= $avatarUrl ?: $defaultAvatar ?>" alt="<?= htmlspecialchars($authorName) ?>" class="h-11 w-11 rounded-full object-cover border-2 border-gold/30 flex-shrink-0">
            <div>
                <div class="text-[9px] font-black uppercase tracking-widest text-zinc-400">Rédigé par</div>
                <div class="font-black text-forest text-sm"><?= htmlspecialchars($authorName) ?></div>
                <div class="text-[10px] text-zinc-400 mt-0.5"><?= $article['time_ago'] ?? '' ?></div>
            </div>
        </div>

        <!-- Contenu article -->
        <div class="prose prose-lg md:prose-xl prose-forest max-w-none text-zinc-600 font-medium leading-[1.8]">
            <p class="text-lg md:text-2xl text-forest font-black tracking-tight mb-8 md:mb-12 italic border-l-4 border-gold pl-6 md:pl-8">
                <?= $article['extrait'] ?>
            </p>
            
            <div class="space-y-6 md:space-y-8 text-sm md:text-base">
                <?= $article['contenu'] ?>
            </div>
        </div>
        
        <!-- ─── BARRE ENGAGEMENT ─── -->
        <div class="mt-16 pt-8 border-t border-forest/5">
            <!-- Stats row -->
            <div class="flex items-center flex-wrap gap-3 mb-8 text-xs font-bold text-zinc-400">
                <span class="flex items-center gap-1.5"><i data-lucide="eye" style="width:14px;height:14px"></i> <?= $article['vues'] ?? 0 ?> vues</span>
                <span>·</span>
                <span class="flex items-center gap-1.5"><i data-lucide="heart" style="width:14px;height:14px" class="text-rose-400"></i> <span id="likeCount"><?= $stats['likes'] ?? 0 ?></span> j'aime</span>
                <span>·</span>
                <span class="flex items-center gap-1.5"><i data-lucide="message-circle" style="width:14px;height:14px"></i> <?= $stats['commentaires'] ?? 0 ?> commentaires</span>
                <span>·</span>
                <span class="flex items-center gap-1.5"><i data-lucide="share-2" style="width:14px;height:14px"></i> <span id="shareCount"><?= $stats['partages'] ?? 0 ?></span> partages</span>
            </div>

            <!-- Auteur (Desktop) + Actions -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="hidden md:flex items-center gap-4">
                    <img src="<?= $avatarUrl ?: $defaultAvatar ?>" alt="<?= htmlspecialchars($authorName) ?>" class="h-14 w-14 rounded-full object-cover border-2 border-gold/30 flex-shrink-0">
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-0.5">Rédigé par</div>
                        <div class="font-black text-forest text-lg"><?= htmlspecialchars($authorName) ?></div>
                        <?php if (!empty($article['time_ago'])): ?>
                            <div class="text-xs text-zinc-400"><?= $article['time_ago'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Boutons Like / Partage -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <button id="likeBtn" data-hash="<?= $article['hash_id'] ?>"
                        class="flex items-center gap-2 px-5 py-3 rounded-2xl border font-black text-xs uppercase tracking-widest transition-all
                            <?= $hasLiked ? 'bg-rose-500 border-rose-500 text-white' : 'bg-white border-forest/10 text-forest hover:border-rose-300 hover:text-rose-500' ?>">
                        <i data-lucide="heart" style="width:16px;height:16px"></i>
                        <?= $hasLiked ? 'Aimé' : "J'aime" ?>
                    </button>

                    <!-- Partage WhatsApp -->
                    <a id="shareWhatsapp" href="https://wa.me/?text=<?= urlencode($article['titre'] . ' - ' . BASE_URL . '/actualites/show/' . $article['hash_id']) ?>"
                        target="_blank" onclick="recordShare('whatsapp')"
                        class="flex items-center justify-center w-12 h-12 rounded-2xl bg-emerald-500 text-white hover:bg-emerald-600 transition-all flex-shrink-0">
                        <i data-lucide="message-circle" style="width:18px;height:18px"></i>
                    </a>

                    <!-- Partage Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(BASE_URL . '/actualites/show/' . $article['hash_id']) ?>"
                        target="_blank" onclick="recordShare('facebook')"
                        class="flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-600 text-white hover:bg-blue-700 transition-all flex-shrink-0">
                        <i data-lucide="facebook" style="width:18px;height:18px"></i>
                    </a>

                    <!-- Copier lien -->
                    <button onclick="copyLink('<?= BASE_URL ?>/actualites/show/<?= $article['hash_id'] ?>')"
                        class="flex items-center justify-center w-12 h-12 rounded-2xl bg-white border border-forest/10 text-forest hover:bg-forest hover:text-gold transition-all flex-shrink-0">
                        <i data-lucide="link-2" style="width:18px;height:18px"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- ─── COMMENTAIRES ─── -->
        <div class="mt-16 pt-10 border-t border-forest/5 space-y-8">
            <h3 class="text-2xl font-black text-forest">Commentaires <span class="text-gold">(<?= $stats['commentaires'] ?? 0 ?>)</span></h3>

            <!-- Liste commentaires -->
            <?php if (!empty($comments)): ?>
                <div class="space-y-6">
                    <?php foreach ($comments as $comment): ?>
                        <div class="flex gap-4">
                            <img src="<?= $comment['auteur_avatar'] ?>" alt="<?= htmlspecialchars($comment['auteur_nom']) ?>" class="h-10 w-10 rounded-full object-cover flex-shrink-0 border-2 border-forest/10">
                            <div class="flex-1">
                                <div class="bg-coacki-bg rounded-2xl px-5 py-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-black text-forest text-sm"><?= htmlspecialchars($comment['auteur_nom']) ?></span>
                                        <span class="text-[10px] font-bold text-zinc-400"><?= date('d M Y, H:i', strtotime($comment['created_at'])) ?></span>
                                    </div>
                                    <p class="text-sm text-zinc-600 font-medium leading-relaxed"><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-zinc-400 font-medium italic text-sm">Aucun commentaire pour l'instant. Soyez le premier !</p>
            <?php endif; ?>

            <!-- Formulaire de commentaire -->
            <form id="commentForm" class="space-y-4 pt-4 border-t border-forest/5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Votre nom *</label>
                        <input type="text" id="commentNom" required placeholder="Prénom Nom"
                               class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Email (optionnel)</label>
                        <input type="email" id="commentEmail" placeholder="vous@exemple.com"
                               class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Votre commentaire *</label>
                    <textarea id="commentTexte" required rows="3" placeholder="Partagez votre avis..."
                              class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none resize-none"></textarea>
                </div>
                <button type="submit" class="bg-forest text-gold px-8 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-forest/90 transition-all flex items-center gap-2">
                    Publier <i data-lucide="send" style="width:14px;height:14px"></i>
                </button>
            </form>
        </div>
    </div>
    
    <!-- 🟢 AUTRES ACTUALITÉS SUGGÉRÉES -->
    <?php if (!empty($autresArticles)): ?>
    <div class="max-w-7xl mx-auto px-5 md:px-8 mt-20 mb-10">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-2xl md:text-3xl font-black text-forest tracking-tighter">Découvrir aussi</h3>
            <a href="<?= BASE_URL ?>/actualites" class="hidden md:flex items-center gap-2 text-[10px] font-black text-forest uppercase tracking-widest hover:text-gold transition-colors">
                Toutes les news <i data-lucide="arrow-right" style="width:14px;height:14px"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($autresArticles as $autre): ?>
                <a href="<?= BASE_URL ?>/actualites/show/<?= $autre['hash_id'] ?>" class="group block bg-white rounded-3xl overflow-hidden shadow-sm border border-forest/5 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="h-48 w-full relative overflow-hidden">
                        <img src="<?= $autre['image_url'] ?>" alt="<?= $autre['titre'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest/80 via-transparent to-transparent"></div>
                        <span class="absolute bottom-4 left-4 px-3 py-1 bg-gold text-forest rounded-full text-[9px] font-black uppercase tracking-widest">
                            <?= $autre['categorie'] ?>
                        </span>
                    </div>
                    <div class="p-6">
                        <h4 class="font-black text-forest text-lg leading-tight group-hover:text-gold transition-colors line-clamp-2 mb-3">
                            <?= $autre['titre'] ?>
                        </h4>
                        <div class="flex items-center gap-3 text-[10px] font-bold text-zinc-400 uppercase tracking-widest">
                            <span><?= $autre['time_ago'] ?? date('d M Y', strtotime($autre['date_publication'])) ?></span>
                            <span>·</span>
                            <span><?= $autre['temps_lecture'] ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-8 text-center md:hidden">
            <a href="<?= BASE_URL ?>/actualites" class="inline-flex items-center justify-center gap-2 w-full px-6 py-4 bg-white rounded-2xl border border-forest/10 text-xs font-black text-forest uppercase tracking-widest hover:bg-forest hover:text-gold transition-all">
                Toutes les actualités <i data-lucide="list" style="width:16px;height:16px"></i>
            </a>
        </div>
    </div>
    <?php endif; ?>
    
</article>

<style>
    .prose p { margin-bottom: 2rem; color: #4B5563; }
    .prose strong { color: #1B4332; font-weight: 900; }
    .prose h2, .prose h3 { color: #1B4332; font-weight: 900; }
</style>

<script>
// ─── Barre de progression de lecture ───
(function() {
    const bar = document.getElementById('readingProgress');
    const body = document.getElementById('articleBody');
    if (!bar || !body) return;
    
    window.addEventListener('scroll', () => {
        const bodyTop = body.offsetTop;
        const bodyHeight = body.offsetHeight;
        const scrolled = window.scrollY - bodyTop;
        const total = bodyHeight - window.innerHeight;
        const pct = Math.min(Math.max((scrolled / total) * 100, 0), 100);
        bar.style.width = pct + '%';
    }, { passive: true });
})();

// ─── Like AJAX ───
document.getElementById('likeBtn')?.addEventListener('click', async function() {
    const hash = this.dataset.hash;
    const res = await fetch(`<?= BASE_URL ?>/api/like`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ hash })
    });
    const data = await res.json();
    document.getElementById('likeCount').textContent = data.count;
    if (data.liked) {
        this.className = 'flex items-center gap-2 px-5 py-3 rounded-2xl border font-black text-xs uppercase tracking-widest transition-all bg-rose-500 border-rose-500 text-white';
        this.innerHTML = '<i data-lucide="heart" style="width:16px;height:16px"></i> Aimé';
    } else {
        this.className = 'flex items-center gap-2 px-5 py-3 rounded-2xl border font-black text-xs uppercase tracking-widest transition-all bg-white border-forest/10 text-forest hover:border-rose-300 hover:text-rose-500';
        this.innerHTML = '<i data-lucide="heart" style="width:16px;height:16px"></i> J\'aime';
    }
    if (window.lucide) lucide.createIcons();
});

// ─── Enregistrement partage ───
function recordShare(platform) {
    fetch(`<?= BASE_URL ?>/api/share`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ hash: '<?= $article['hash_id'] ?>', platform })
    }).then(r => r.json()).then(d => {
        document.getElementById('shareCount').textContent = d.count;
    });
}

// ─── Copier lien ───
function copyLink(url) {
    navigator.clipboard.writeText(url).then(() => {
        const btn = event.currentTarget;
        btn.innerHTML = '<i data-lucide="check" style="width:18px;height:18px"></i>';
        if (window.lucide) lucide.createIcons();
        setTimeout(() => {
            btn.innerHTML = '<i data-lucide="link-2" style="width:18px;height:18px"></i>';
            if (window.lucide) lucide.createIcons();
        }, 2000);
        recordShare('copier');
    });
}

// ─── Commentaire AJAX ───
document.getElementById('commentForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    const nom = document.getElementById('commentNom').value.trim();
    const email = document.getElementById('commentEmail').value.trim();
    const contenu = document.getElementById('commentTexte').value.trim();
    if (!nom || !contenu) return;

    const res = await fetch(`<?= BASE_URL ?>/api/comment`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ hash: '<?= $article['hash_id'] ?>', nom, email, contenu })
    });
    const data = await res.json();
    if (data.success) {
        this.reset();
        if (typeof window.showToast === 'function') {
            window.showToast('Commentaire publié !', 'success');
        } else {
            alert('Commentaire publié !');
        }
        location.reload();
    }
});
</script>
