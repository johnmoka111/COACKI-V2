<div class="min-h-screen bg-coacki-bg pt-10 pb-20">
    <div class="max-w-7xl mx-auto px-5 md:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-forest">Demandes de Partenariat</h1>
                <p class="text-zinc-500 font-medium tracking-tight">Consultez les messages reçus depuis la page de contact.</p>
            </div>
            <a href="<?= BASE_URL ?>/dashboard" class="px-4 py-2 bg-white border border-forest/10 rounded-xl text-forest text-xs font-black uppercase tracking-widest hover:bg-forest hover:text-white transition-all flex items-center gap-2">
                <i data-lucide="arrow-left" style="width:14px;height:14px"></i> Retour
            </a>
        </div>

        <div class="space-y-4">
            <?php if(empty($demandes)): ?>
                <div class="p-8 text-center text-zinc-400 bg-white border border-forest/5 rounded-[32px]">
                    <i data-lucide="inbox" class="mx-auto h-12 w-12 opacity-20 mb-4"></i>
                    Aucune demande pour le moment.
                </div>
            <?php else: ?>
                <?php foreach($demandes as $d): ?>
                    <div class="bg-white rounded-[32px] p-6 md:p-8 border <?= $d['est_lu'] ? 'border-forest/5' : 'border-emerald-500 shadow-xl shadow-emerald-500/5' ?> relative">
                        
                        <?php if(!$d['est_lu']): ?>
                            <div class="absolute -top-3 -right-3 h-6 w-6 bg-emerald-500 border-4 border-white rounded-full flex items-center justify-center shadow-md">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            </div>
                        <?php endif; ?>

                        <div class="flex items-start gap-5">
                            <?php if(!empty($d['logo_url'])): ?>
                                <img src="<?= $d['logo_url'] ?>" class="h-20 w-20 rounded-2xl object-contain bg-slate-50 border p-2 flex-shrink-0" alt="Logo">
                            <?php else: ?>
                                <div class="h-20 w-20 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-300 flex-shrink-0">
                                    <i data-lucide="image" class="w-8 h-8"></i>
                                </div>
                            <?php endif; ?>

                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                                    <div>
                                        <h3 class="text-lg font-black text-forest flex items-center gap-2">
                                            <?= htmlspecialchars($d['nom_complet'] ?? 'Anonyme') ?>
                                            <span class="px-2.5 py-1 bg-gold/20 text-forest text-[9px] uppercase tracking-widest rounded-full">
                                                <?= htmlspecialchars($d['type_partenariat'] ?? 'Contact') ?>
                                            </span>
                                            <?php if(!empty($d['autre_details'])): ?>
                                                <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-[9px] uppercase tracking-widest rounded-full border border-blue-100">
                                                    <?= htmlspecialchars($d['autre_details']) ?>
                                                </span>
                                            <?php endif; ?>
                                        </h3>
                                        <p class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest mt-1">
                                            <i data-lucide="calendar" class="inline" style="width:12px;height:12px"></i> <?= date('d M Y à H:i', strtotime($d['created_at'])) ?>
                                            <?php if($d['organisation']): ?>
                                                • <?= htmlspecialchars($d['organisation']) ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        <a href="mailto:<?= htmlspecialchars($d['email']) ?>" class="h-10 w-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-colors">
                                            <i data-lucide="mail" style="width:16px;height:16px"></i>
                                        </a>
                                        <?php if($d['telephone']): ?>
                                        <a href="tel:<?= htmlspecialchars($d['telephone']) ?>" class="h-10 w-10 flex items-center justify-center bg-green-50 text-green-600 rounded-xl hover:bg-green-100 transition-colors">
                                            <i data-lucide="phone" style="width:16px;height:16px"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if(!$d['est_lu'] && !empty($d['hash_id'])): ?>
                                        <a href="<?= BASE_URL ?>/admin/partenariats/lu/<?= $d['hash_id'] ?>" class="px-4 flex items-center justify-center gap-2 bg-emerald-500 text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-emerald-600 transition-colors">
                                            Marquer lu <i data-lucide="check" style="width:14px;height:14px"></i>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="bg-coacki-bg rounded-2xl p-5 text-sm text-zinc-600 font-medium leading-relaxed border border-forest/5">
                                    "<?= nl2br(htmlspecialchars($d['message'])) ?>"
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
