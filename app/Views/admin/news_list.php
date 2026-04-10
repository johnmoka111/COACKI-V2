<div class="px-6 py-10 md:px-12 md:py-12 bg-coacki-bg min-h-screen">
    <div class="max-w-7xl mx-auto space-y-12">
        
        <!-- Top Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-forest rounded-xl flex items-center justify-center text-gold shadow-lg shadow-forest/20">
                        <i data-lucide="newspaper" style="width:20px;height:20px"></i>
                    </div>
                    <h1 class="text-3xl font-black text-forest tracking-tighter">Rédaction & Presse</h1>
                </div>
                <p class="text-zinc-500 font-medium leading-relaxed max-w-md">Gérez vos publications, surveillez l'audience et archivez les contenus passés.</p>
            </div>
            
            <a href="<?= BASE_URL ?>/admin/news/create" class="flex h-14 px-8 bg-forest text-gold rounded-2xl items-center justify-center gap-3 font-black text-xs uppercase tracking-widest hover:scale-[1.02] shadow-xl shadow-forest/20 transition-all self-start md:self-auto group">
                Nouvel Article <i data-lucide="plus-circle" class="group-hover:rotate-90 transition-transform" style="width:18px;height:18px"></i>
            </a>
        </div>

        <!-- News Table -->
        <div class="bg-white rounded-[40px] border border-zinc-100 shadow-2xl shadow-zinc-500/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50/50 border-b border-zinc-100">
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Contenu & Audience</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Engagement</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Publication</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50">
                        <?php foreach($news as $a): ?>
                        <tr class="group hover:bg-zinc-50/30 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-6">
                                    <div class="w-24 h-16 rounded-2xl overflow-hidden flex-shrink-0 bg-zinc-100 relative shadow-sm border border-zinc-50">
                                        <img src="<?= $a['image_url'] ?>" class="w-full h-full object-cover transition-transform group-hover:scale-110 duration-700">
                                        <?php if($a['est_archive']): ?>
                                            <div class="absolute inset-0 bg-zinc-900/60 flex items-center justify-center backdrop-blur-[2px]">
                                                <i data-lucide="archive" class="text-white" style="width:16px;height:16px"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="max-w-md">
                                        <div class="text-[10px] font-black tracking-widest uppercase text-gold mb-1"><?= htmlspecialchars($a['categorie']) ?></div>
                                        <h3 class="text-base font-black text-forest leading-tight tracking-tight mb-1 group-hover:text-forest transition-colors <?= $a['est_archive'] ? 'opacity-40 italic' : '' ?>">
                                            <?= htmlspecialchars($a['titre']) ?>
                                        </h3>
                                        <div class="flex items-center gap-2 text-[10px] font-bold text-zinc-300 uppercase">
                                            <span>ID: <?= substr($a['hash_id'], 0, 8) ?></span>
                                            <span>•</span>
                                            <span class="<?= $a['est_archive'] ? 'text-zinc-300' : 'text-emerald-500' ?>"><?= $a['est_archive'] ? 'Archivé' : 'En ligne' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2 text-forest">
                                    <i data-lucide="eye" style="width:14px;height:14px" class="opacity-40"></i>
                                    <span class="text-sm font-black tracking-tighter"><?= number_format($a['vues'], 0, ',', ' ') ?></span>
                                    <span class="text-[10px] font-black text-zinc-300 uppercase ml-1">Vues</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-bold text-zinc-500 leading-tight">
                                    <?= date('d M Y', strtotime($a['date_publication'])) ?>
                                    <span class="block text-[10px] text-zinc-300 font-black uppercase tracking-widest"><?= date('H:i', strtotime($a['date_publication'])) ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-3 translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                                    <?php if(!$a['est_archive']): ?>
                                        <a href="<?= BASE_URL ?>/admin/news/edit/<?= $a['hash_id'] ?>" class="h-10 w-10 flex items-center justify-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition-all" title="Modifier">
                                            <i data-lucide="edit-3" style="width:16px;height:16px"></i>
                                        </a>
                                        <form action="<?= BASE_URL ?>/admin/news/archive/<?= $a['hash_id'] ?>" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment archiver cet article ? Il ne sera plus visible sur le site public.');">
                                            <button type="submit" class="h-10 w-10 flex items-center justify-center bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white rounded-xl transition-all" title="Archiver">
                                                <i data-lucide="archive" style="width:16px;height:16px"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <div class="h-10 px-4 flex items-center gap-2 bg-zinc-100 text-zinc-400 rounded-xl text-[10px] font-black uppercase tracking-widest border border-zinc-200/50">
                                            <i data-lucide="lock-keyhole" style="width:12px;height:12px"></i> Contenu Archivé
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($news)): ?>
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3 opacity-20">
                                        <i data-lucide="newspaper" style="width:48px;height:48px"></i>
                                        <p class="text-zinc-500 font-black uppercase tracking-[0.2em] text-[10px]">Aucun article rédigé</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

