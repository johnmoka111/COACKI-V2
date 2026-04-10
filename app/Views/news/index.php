<section class="py-20 bg-coacki-bg">
    <div class="max-w-7xl mx-auto px-6">
        <!-- En-tête de section -->
        <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
            <div class="max-w-xl space-y-4">
                <h4 class="text-gold font-black uppercase text-xs tracking-[0.3em]">Vie de la coopérative</h4>
                <h2 class="text-5xl md:text-6xl font-black text-forest tracking-tighter leading-none">Journal <span class="text-gold italic">COACKI</span></h2>
                <p class="text-zinc-500 font-medium">Restez informé des dernières nouvelles de notre terroir à Kalehe.</p>
            </div>
        </div>

        <?php if (empty($news)): ?>
            <div class="py-20 text-center bg-white rounded-[40px] border border-forest/5">
                <div class="h-20 w-20 bg-coacki-bg rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="newspaper" class="h-10 w-10 text-forest opacity-20"></i>
                </div>
                <h3 class="text-2xl font-black text-forest">Aucune actualité pour le moment</h3>
                <p class="text-zinc-400 mt-2">Revenez bientôt pour découvrir nos prochaines récoltes.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($news as $article): ?>
                    <a href="<?= BASE_URL ?>/actualites/show/<?= $article['hash_id'] ?>" class="group bg-white rounded-[32px] overflow-hidden border border-forest/5 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full cursor-pointer">
                        
                        <!-- Image -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?= $article['image_url'] ?>" alt="<?= $article['titre'] ?>" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span class="bg-forest text-gold px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg backdrop-blur-md bg-forest/90">
                                    <?= $article['categorie'] ?>
                                </span>
                            </div>
                        </div>

                        <!-- Contenu -->
                        <div class="p-8 flex flex-col flex-1 relative">
                            <div class="flex items-center gap-4 text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-4">
                                <span class="flex items-center gap-2"><i data-lucide="calendar" style="width:14px;height:14px"></i> <?= $article['time_ago'] ?? date('d M Y', strtotime($article['date_publication'])) ?></span>
                                <span>•</span>
                                <span class="flex items-center gap-2"><i data-lucide="clock" style="width:14px;height:14px"></i> <?= $article['temps_lecture'] ?></span>
                                <span class="flex items-center gap-1.5"><i data-lucide="eye" style="width:12px;height:12px"></i> <?= $article['vues'] ?? 0 ?></span>
                            </div>

                            <h3 class="text-2xl font-black text-forest mb-4 leading-tight group-hover:text-gold transition-colors">
                                <?= $article['titre'] ?>
                            </h3>
                            
                            <p class="text-zinc-500 font-medium line-clamp-3 mb-6 text-sm">
                                <?= $article['extrait'] ?>
                            </p>
                            
                            <div class="flex items-center justify-between pt-6 border-t border-forest/5 mt-auto">
                                <span class="text-[10px] font-black text-forest/40 uppercase tracking-widest">
                                    Par <?= htmlspecialchars($article['auteur'] ?? 'COACKI') ?>
                                </span>
                                <span class="flex items-center gap-2 text-forest font-black text-xs uppercase tracking-[0.2em] group-hover:text-gold transition-colors">
                                    Lire <i data-lucide="arrow-right" style="width:14px;height:14px" class="group-hover:translate-x-1 transition-transform"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Pagination logic like Google (Prev / Next / Numbers) -->
            <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="mt-16 flex justify-center items-center gap-2">
                <!-- Precedent -->
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="px-4 py-3 bg-white border border-forest/10 rounded-xl text-forest font-black text-xs uppercase hover:bg-forest hover:text-gold transition-all">Précédent</a>
                <?php endif; ?>

                <div class="hidden md:flex gap-2">
                    <?php 
                    $start = max(1, $page - 2);
                    $end = min($totalPages, $page + 2);
                    for ($i = $start; $i <= $end; $i++): 
                    ?>
                        <a href="?page=<?= $i ?>" class="w-10 h-10 flex items-center justify-center rounded-xl font-black text-sm transition-all border <?= $i === $page ? 'bg-forest text-gold border-forest shadow-lg' : 'bg-white text-forest border-forest/10 hover:bg-forest/5' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>

                <!-- Suivant -->
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="px-4 py-3 bg-white border border-forest/10 rounded-xl text-forest font-black text-xs uppercase hover:bg-forest hover:text-gold transition-all">Suivant</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
