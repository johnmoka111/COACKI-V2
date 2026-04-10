<div class="px-6 py-10 md:px-12 md:py-12 bg-coacki-bg min-h-screen">
    <div class="max-w-6xl mx-auto space-y-12">
        
        <!-- Top Section: Stats & Title -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-red-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-red-500/20">
                        <i data-lucide="shield-check" style="width:20px;height:20px"></i>
                    </div>
                    <h1 class="text-3xl font-black text-forest tracking-tighter">Sécurité & Accès</h1>
                </div>
                <p class="text-zinc-500 font-medium leading-relaxed max-w-md">Validation manuelle des demandes de réinitialisation de mot de passe pour les membres de la coopérative.</p>
            </div>
            
            <div class="flex items-center gap-4 bg-white p-2 rounded-2xl border border-zinc-200 shadow-sm">
                <div class="px-6 py-3 text-center border-r border-zinc-100">
                    <div class="text-2xl font-black text-red-500"><?= count($requests ?? []) ?></div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-zinc-400">En attente</div>
                </div>
                <div class="px-6 py-3 text-center">
                    <div class="text-2xl font-black text-forest"><?= count($history ?? []) ?></div>
                    <div class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Traitées</div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Grid -->
        <div class="space-y-6">
            <div class="flex items-center gap-3 text-xs font-black uppercase tracking-[0.2em] text-zinc-400">
                <span class="w-12 h-[1px] bg-zinc-200"></span>
                Demandes urgentes
            </div>

            <?php if(empty($requests)): ?>
                <div class="py-20 px-8 flex flex-col items-center justify-center bg-white rounded-[40px] border border-zinc-200 border-dashed transition-all hover:bg-zinc-50/50">
                    <div class="h-16 w-16 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="check-check" style="width:28px;height:28px"></i>
                    </div>
                    <p class="font-bold text-forest uppercase tracking-widest text-xs">Tout est sous contrôle</p>
                    <p class="text-sm text-zinc-400 mt-1">Aucune demande de sécurité en attente pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach($requests as $r): ?>
                        <div class="bg-white rounded-[40px] p-8 border border-zinc-100 shadow-xl shadow-zinc-500/5 hover:shadow-zinc-500/10 transition-all duration-500 group relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16 blur-2xl opacity-50 group-hover:scale-110 transition-transform"></div>
                            
                            <div class="flex flex-col h-full relative z-10">
                                <div class="flex items-start justify-between mb-8">
                                    <div class="flex items-center gap-5">
                                        <div class="h-14 w-14 rounded-2xl bg-zinc-50 flex items-center justify-center border border-zinc-100 group-hover:bg-red-50 group-hover:border-red-100 transition-colors">
                                            <i data-lucide="user-round-x" class="text-zinc-400 group-hover:text-red-500 transition-colors" style="width:24px;height:24px"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-black text-forest tracking-tight"><?= htmlspecialchars($r['prenom'] . ' ' . $r['nom']) ?></h3>
                                            <p class="text-sm font-bold text-zinc-400"><?= htmlspecialchars($r['email']) ?></p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-full">Urgent</span>
                                </div>
                                
                                <div class="mt-auto space-y-6">
                                    <div class="flex items-center justify-between text-[11px] font-bold text-zinc-400 uppercase tracking-widest border-t border-zinc-50 pt-6">
                                        <span>Soumis le</span>
                                        <span class="text-forest"><?= date('d M Y, H:i', strtotime($r['created_at'])) ?></span>
                                    </div>
                                    
                                    <div class="flex gap-3">
                                        <a href="<?= BASE_URL ?>/admin/resets/approve/<?= $r['id'] ?>" class="flex-1 h-14 bg-forest text-gold rounded-2xl font-black text-xs uppercase tracking-[0.15em] hover:bg-forest/90 hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-forest/20 flex items-center justify-center gap-3">
                                            Approuver <i data-lucide="shield-check" style="width:16px;height:16px"></i>
                                        </a>
                                        <a href="<?= BASE_URL ?>/admin/resets/refuse/<?= $r['id'] ?>" class="h-14 w-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all group-hover:shadow-lg group-hover:shadow-red-500/20">
                                            <i data-lucide="trash-2" style="width:20px;height:20px"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- History Table Section -->
        <div class="space-y-6">
            <div class="flex items-center gap-3 text-xs font-black uppercase tracking-[0.2em] text-zinc-400">
                <span class="w-12 h-[1px] bg-zinc-200"></span>
                Historique des audits
            </div>
            
            <div class="bg-white rounded-[40px] border border-zinc-100 shadow-2xl shadow-zinc-500/5 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-zinc-50/50 border-b border-zinc-100">
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Membre Audité</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">État Final</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Audit par</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Date Audit</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-50">
                            <?php if(empty($history)): ?>
                                <tr>
                                    <td colspan="4" class="px-10 py-16 text-center text-zinc-400 font-bold uppercase text-[10px] tracking-widest">
                                        <i data-lucide="archive" class="mx-auto h-8 w-8 mb-3 opacity-20"></i>
                                        Aucun historique d'audit disponible.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($history as $h): ?>
                                    <tr class="group hover:bg-zinc-50/50 transition-colors">
                                        <td class="px-10 py-6">
                                            <div class="flex items-center gap-4">
                                                <div class="h-10 w-10 bg-zinc-100 rounded-xl flex items-center justify-center text-zinc-400 font-black text-xs uppercase tracking-tighter">
                                                    <?= substr($h['prenom'], 0, 1) . substr($h['nom'], 0, 1) ?>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-black text-forest tracking-tight"><?= htmlspecialchars($h['prenom'] . ' ' . $h['nom']) ?></div>
                                                    <div class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider"><?= htmlspecialchars($h['email']) ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-10 py-6">
                                            <?php if($h['status'] === 'approuve'): ?>
                                                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    Approuvé
                                                </div>
                                            <?php else: ?>
                                                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-100">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                                    Refusé
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-10 py-6">
                                            <div class="text-xs font-bold text-forest"><?= htmlspecialchars($h['admin_prenom'] . ' ' . $h['admin_nom']) ?></div>
                                            <div class="text-[10px] text-zinc-400 font-black uppercase tracking-widest opacity-60">Admin Validator</div>
                                        </td>
                                        <td class="px-10 py-6 text-zinc-400 font-bold text-[10px] uppercase tracking-[0.1em]">
                                            <?= date('d/m/Y', strtotime($h['updated_at'])) ?>
                                            <span class="block opacity-50 font-normal"><?= date('H:i', strtotime($h['updated_at'])) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

