<div class="px-6 py-10 md:px-12 md:py-12 bg-coacki-bg min-h-screen">
    <div class="max-w-7xl mx-auto space-y-12">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-600/20">
                        <i data-lucide="users" style="width:20px;height:20px"></i>
                    </div>
                    <h1 class="text-3xl font-black text-forest tracking-tighter">Gestion CRM</h1>
                </div>
                <p class="text-zinc-500 font-medium leading-relaxed max-w-md">Contrôlez les accès, gérez les rôles et surveillez l'activité des membres de l'organisation.</p>
            </div>
            
            <a href="<?= BASE_URL ?>/admin/users/create" class="flex h-14 px-8 bg-forest text-gold rounded-2xl items-center justify-center gap-3 font-black text-xs uppercase tracking-widest hover:scale-[1.02] shadow-xl shadow-forest/20 transition-all self-start md:self-auto">
                Ajouter un personnel <i data-lucide="user-plus" style="width:18px;height:18px"></i>
            </a>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-[40px] border border-zinc-100 shadow-2xl shadow-zinc-500/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-zinc-50/50 border-b border-zinc-100">
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Identité & Statut</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Contact</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">Rôle au sein du CRM</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50 font-bold">
                        <?php foreach($users as $u): ?>
                        <tr class="group hover:bg-zinc-50/30 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="relative">
                                        <?php $avatar = $u['avatar_url'] ?: 'https://ui-avatars.com/api/?name='.urlencode($u['prenom'].' '.$u['nom']).'&background=1B4332&color=D4AF37'; ?>
                                        <img src="<?= $avatar ?>" class="h-12 w-12 rounded-2xl border border-zinc-100 object-cover shadow-sm group-hover:scale-105 transition-transform">
                                        <!-- Indicator -->
                                        <div class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full border-2 border-white <?= $u['actif'] ? 'bg-emerald-500' : 'bg-red-500' ?>"></div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-forest"><?= htmlspecialchars($u['prenom'].' '.$u['nom']) ?></div>
                                        <div class="text-[10px] uppercase font-bold text-zinc-400 tracking-wider">HASH: <?= substr($u['hash_id'], 0, 8) ?>...</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-xs text-forest"><?= htmlspecialchars($u['email']) ?></div>
                                <?php if($u['telephone']): ?>
                                    <div class="text-[10px] text-zinc-400 font-medium px-2 py-0.5 bg-zinc-100 rounded-full inline-block mt-1"><?= htmlspecialchars($u['telephone']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-8 py-6">
                                <?php if($u['id'] == $_SESSION['user']['id']): ?>
                                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-forest text-gold rounded-full text-[10px] font-black uppercase tracking-widest border border-gold/20">
                                        <i data-lucide="shield-check" style="width:12px;height:12px"></i> <?= $u['role_nom'] ?> (MOI)
                                    </div>
                                <?php else: ?>
                                    <form action="<?= BASE_URL ?>/admin/users/update/<?= $u['id'] ?>" method="POST" class="flex items-center gap-2 max-w-[200px]">
                                        <input type="hidden" name="prenom" value="<?= htmlspecialchars($u['prenom']) ?>">
                                        <input type="hidden" name="nom" value="<?= htmlspecialchars($u['nom']) ?>">
                                        <select name="role_id" onchange="this.form.submit()" class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-4 py-2 text-[10px] font-black tracking-widest uppercase text-forest focus:ring-1 focus:ring-forest outline-none transition-all cursor-pointer">
                                            <option value="1" <?= $u['role_id'] == 1 ? 'selected' : '' ?>>Super Admin</option>
                                            <option value="2" <?= $u['role_id'] == 2 ? 'selected' : '' ?>>Admin</option>
                                            <option value="3" <?= $u['role_id'] == 3 ? 'selected' : '' ?>>Com' Staff</option>
                                            <option value="4" <?= $u['role_id'] == 4 ? 'selected' : '' ?>>Membre</option>
                                        </select>
                                    </form>
                                <?php endif; ?>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-3 translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                                    <?php if($u['id'] != 1 && $u['id'] != $_SESSION['user']['id']): ?>
                                        
                                        <!-- Activation Toggle (Superadmin Only) -->
                                        <?php if($_SESSION['user']['role'] === 'superadmin'): ?>
                                            <a href="<?= BASE_URL ?>/admin/users/toggle/<?= $u['id'] ?>" 
                                               class="h-10 px-3 flex items-center justify-center gap-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all <?= $u['actif'] ? 'bg-red-50 text-red-500 hover:bg-red-500 hover:text-white' : 'bg-emerald-50 text-emerald-500 hover:bg-emerald-500 hover:text-white' ?>"
                                               title="<?= $u['actif'] ? 'Désactiver' : 'Activer' ?>">
                                                <i data-lucide="<?= $u['actif'] ? 'power-off' : 'user-check' ?>" style="width:14px;height:14px"></i>
                                                <?= $u['actif'] ? 'Désactiver' : 'Activer' ?>
                                            </a>
                                        <?php endif; ?>

                                        <a href="<?= BASE_URL ?>/admin/users/reset/<?= $u['id'] ?>" onclick="return confirm('Réinitialiser le mot de passe pour cet utilisateur ? (Sera: COACKI_2026_Reset)');" class="h-10 w-10 flex items-center justify-center bg-zinc-100 text-zinc-400 hover:bg-forest hover:text-gold rounded-xl transition-all" title="Réinitialiser MDP">
                                            <i data-lucide="key" style="width:16px;height:16px"></i>
                                        </a>
                                        <a href="<?= BASE_URL ?>/admin/users/delete/<?= $u['id'] ?>" onclick="return confirm('Supprimer définitivement cet utilisateur ?');" class="h-10 w-10 flex items-center justify-center bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all">
                                            <i data-lucide="trash-2" style="width:16px;height:16px"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-[10px] bg-zinc-100 px-3 py-1 text-zinc-400 font-black uppercase tracking-widest rounded-full">Protégé</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

