<div class="min-h-screen bg-coacki-bg pt-10 pb-20">
    <div class="max-w-5xl mx-auto px-5 md:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-forest uppercase tracking-tighter">Nouvelle Campagne</h1>
                <p class="text-zinc-500 font-medium tracking-tight">Sélectionnez les actualités à envoyer à vos abonnés.</p>
            </div>
            <a href="<?= BASE_URL ?>/admin/newsletter" class="px-4 py-3 bg-white border border-forest/10 rounded-2xl text-forest text-xs font-black uppercase tracking-widest hover:bg-forest hover:text-white transition-all flex items-center gap-2">
                <i data-lucide="arrow-left" style="width:14px;height:14px"></i> Annuler
            </a>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/admin/campaign/send" class="space-y-8">
            <div class="bg-white rounded-[40px] border border-forest/5 shadow-2xl p-8 md:p-12">
                <h3 class="text-sm font-black text-zinc-400 uppercase tracking-widest mb-8">Étape 1 : Choisir les articles (max 5 recommandés)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($articles as $art): ?>
                        <label class="relative group cursor-pointer">
                            <input type="checkbox" name="news_ids[]" value="<?= $art['hash_id'] ?>" class="peer hidden">
                            <div class="p-6 bg-zinc-50 border-2 border-transparent rounded-[32px] transition-all group-hover:border-gold/30 peer-checked:border-gold peer-checked:bg-gold/5 flex gap-4 items-center">
                                <div class="h-16 w-16 rounded-2xl overflow-hidden flex-shrink-0 bg-zinc-200">
                                    <img src="<?= $art['image_url'] ?>" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-black text-forest line-clamp-1"><?= htmlspecialchars($art['titre']) ?></h4>
                                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider mt-1"><?= $art['categorie'] ?></p>
                                </div>
                                <div class="h-6 w-6 rounded-full border-2 border-zinc-200 peer-checked:bg-gold peer-checked:border-gold flex items-center justify-center transition-all opacity-0 peer-checked:opacity-100">
                                    <i data-lucide="check" class="text-white" style="width:12px;height:12px"></i>
                                </div>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="mt-12 pt-8 border-t border-forest/5 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4 text-zinc-400">
                        <div class="h-10 w-10 bg-forest/5 rounded-full flex items-center justify-center">
                            <i data-lucide="info" style="width:18px;height:18px"></i>
                        </div>
                        <p class="text-xs font-medium">L'email sera envoyé à tous les abonnés enregistrés avec le design Premium de COACKI.</p>
                    </div>
                    <button type="submit" class="w-full md:w-auto px-10 py-5 bg-forest text-gold rounded-full font-black uppercase tracking-[3px] text-xs shadow-2xl shadow-forest/20 hover:scale-[1.05] active:scale-[0.95] transition-all flex items-center justify-center gap-3">
                        Lancer l'envoi massif <i data-lucide="send" style="width:18px;height:18px"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
