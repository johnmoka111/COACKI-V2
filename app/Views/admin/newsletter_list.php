<div class="px-6 py-10 md:px-12 md:py-12 bg-coacki-bg min-h-screen">
    <div class="max-w-7xl mx-auto space-y-12">
        
        <!-- Top Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-gold rounded-xl flex items-center justify-center text-forest shadow-lg shadow-gold/20">
                        <i data-lucide="mail" style="width:20px;height:20px"></i>
                    </div>
                    <h1 class="text-3xl font-black text-forest tracking-tighter">Audience & Emailing</h1>
                </div>
                <p class="text-zinc-500 font-medium leading-relaxed max-w-md">Administrez la liste de diffusion et gardez contact avec vos abonnés.</p>
            </div>
            
            <a href="<?= BASE_URL ?>/admin/campaign/create" class="flex h-14 px-8 bg-forest text-gold rounded-2xl items-center justify-center gap-3 font-black text-xs uppercase tracking-widest hover:scale-[1.02] shadow-xl shadow-forest/20 transition-all self-start md:self-auto group">
                Lancer une campagne <i data-lucide="send" class="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" style="width:18px;height:18px"></i>
            </a>
        </div>

        <!-- Stats Overview (Small) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-[32px] border border-zinc-100 shadow-sm flex items-center gap-4">
                <div class="h-12 w-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <i data-lucide="users" style="width:20px;height:20px"></i>
                </div>
                <div>
                    <div class="text-[10px] font-black uppercase text-zinc-400 tracking-widest">Abonnés</div>
                    <div class="text-2xl font-black text-forest"><?= count($subscribers) ?></div>
                </div>
            </div>
        </div>

        <!-- Subscribers Table -->
        <div class="bg-white rounded-[40px] border border-zinc-100 shadow-2xl shadow-zinc-500/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50/50 border-b border-zinc-100">
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Coordonnées de l'abonné</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Date d'adhésion</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50">
                        <?php foreach ($subscribers as $sub): ?>
                        <tr class="group hover:bg-zinc-50/30 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 bg-zinc-50 border border-zinc-100 rounded-xl flex items-center justify-center text-zinc-400 group-hover:bg-forest group-hover:text-gold transition-all duration-500">
                                        <i data-lucide="user" style="width:14px;height:14px"></i>
                                    </div>
                                    <div class="text-sm font-bold text-forest"><?= htmlspecialchars($sub['email']) ?></div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-xs font-bold text-zinc-500">
                                    <?= date('d F Y', strtotime($sub['created_at'])) ?>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="<?= BASE_URL ?>/admin/newsletter/delete/<?= $sub['id'] ?>" 
                                       onclick="return confirm('Voulez-vous vraiment retirer cet abonné ?')"
                                       class="h-10 w-10 flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all" 
                                       title="Supprimer l'abonné">
                                        <i data-lucide="trash-2" style="width:16px;height:16px"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($subscribers)): ?>
                            <tr>
                                <td colspan="3" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3 opacity-20">
                                        <i data-lucide="mail-x" style="width:48px;height:48px"></i>
                                        <p class="text-zinc-500 font-black uppercase tracking-[0.2em] text-[10px]">Aucun abonné enregistré</p>
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

