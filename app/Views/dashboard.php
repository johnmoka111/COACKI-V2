<div class="px-6 py-10 md:px-12 md:py-12 bg-coacki-bg min-h-screen">
    <div class="max-w-6xl mx-auto space-y-12">

        <!-- Welcome Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">
                    <i data-lucide="layout-dashboard" style="width:12px;height:12px"></i> Overview
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-forest tracking-tighter">
                    Bonjour, <span class="text-gold italic"><?= htmlspecialchars($user) ?></span>
                </h1>
                <p class="text-sm font-bold text-zinc-400">Content de vous revoir sur la plateforme COACKI.</p>
            </div>
            
            <div class="flex items-center gap-4 bg-white p-2 rounded-2xl border border-zinc-200 shadow-sm self-start md:self-center">
                <div class="h-10 px-4 flex items-center justify-center bg-forest/5 text-forest rounded-xl text-[10px] font-black uppercase tracking-widest border border-forest/10">
                    Role : <?= ucfirst($role) ?>
                </div>
            </div>
        </div>

        <!-- Metric Widgets -->
        <div class="flex overflow-x-auto gap-6 pb-4 -mx-6 px-6 no-scrollbar md:grid md:grid-cols-3 md:mx-0 md:px-0">
            <!-- Metric 1 -->
            <div class="min-w-[280px] md:min-w-0 bg-forest rounded-[40px] p-8 shadow-2xl shadow-forest/20 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-12 -mt-12 blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                <div class="relative z-10 space-y-4">
                    <div class="h-12 w-12 bg-white/10 rounded-2xl flex items-center justify-center text-gold">
                        <i data-lucide="package" style="width:24px;height:24px"></i>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-white tracking-tighter">12.5t</div>
                        <div class="text-[10px] font-black text-gold uppercase tracking-[0.2em]">Collecte Totale</div>
                    </div>
                </div>
            </div>

            <!-- Metric 2 -->
            <div class="min-w-[280px] md:min-w-0 bg-white rounded-[40px] p-8 border border-zinc-100 shadow-xl shadow-zinc-500/5 relative overflow-hidden group">
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-gold/5 rounded-full -ml-12 -mb-12 blur-2xl"></div>
                <div class="relative z-10 space-y-4">
                    <div class="h-12 w-12 bg-gold/10 rounded-2xl flex items-center justify-center text-gold">
                        <i data-lucide="users" style="width:24px;height:24px"></i>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-forest tracking-tighter">276</div>
                        <div class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Membres Actifs</div>
                    </div>
                </div>
            </div>

            <!-- Metric 3 -->
            <div class="min-w-[280px] md:min-w-0 bg-white rounded-[40px] p-8 border border-zinc-100 shadow-xl shadow-zinc-500/5 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                <div class="relative z-10 space-y-4">
                    <div class="h-12 w-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500">
                        <i data-lucide="trending-up" style="width:24px;height:24px"></i>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-forest tracking-tighter">85.4</div>
                        <div class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">Score Engagement</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="space-y-8">
            <div class="flex items-center gap-3 text-xs font-black uppercase tracking-[0.2em] text-zinc-400">
                <span class="w-12 h-[1px] bg-zinc-200"></span>
                Portails d'Action
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <!-- Action 1: News -->
                <a href="<?= BASE_URL ?>/admin/news/create" class="bg-white p-6 md:p-8 rounded-[40px] border border-zinc-100 shadow-lg shadow-zinc-500/5 hover:bg-forest hover:border-forest group transition-all duration-500">
                    <div class="h-14 w-14 bg-gold/10 rounded-2xl flex items-center justify-center text-gold group-hover:bg-gold/20 mb-6 transition-colors">
                        <i data-lucide="pen-tool" style="width:24px;height:24px"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-sm font-black text-forest uppercase tracking-widest group-hover:text-gold transition-colors">Publier</h4>
                        <p class="text-[10px] font-bold text-zinc-400 group-hover:text-white/60 transition-colors uppercase">Actualité</p>
                    </div>
                </a>

                <!-- Action 2: Gallery -->
                <a href="<?= BASE_URL ?>/admin/news" class="bg-white p-6 md:p-8 rounded-[40px] border border-zinc-100 shadow-lg shadow-zinc-500/5 hover:bg-forest hover:border-forest group transition-all duration-500">
                    <div class="h-14 w-14 bg-zinc-50 rounded-2xl flex items-center justify-center text-zinc-400 group-hover:bg-white/10 group-hover:text-white mb-6 transition-colors">
                        <i data-lucide="layers" style="width:24px;height:24px"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-sm font-black text-forest uppercase tracking-widest group-hover:text-gold transition-colors">Gérer</h4>
                        <p class="text-[10px] font-bold text-zinc-400 group-hover:text-white/60 transition-colors uppercase">Articles</p>
                    </div>
                </a>

                <?php if (in_array($role, ['superadmin', 'admin'])): ?>
                <!-- Action 3: Security -->
                <a href="<?= BASE_URL ?>/admin/resets" class="bg-white p-6 md:p-8 rounded-[40px] border border-zinc-100 shadow-lg shadow-zinc-500/5 hover:border-red-500 group transition-all duration-500 relative">
                    <?php if ($pending_resets > 0): ?>
                        <span class="absolute top-6 right-6 h-6 px-2 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white shadow-lg animate-pulse">
                            <?= $pending_resets ?>
                        </span>
                    <?php endif; ?>
                    <div class="h-14 w-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 mb-6 group-hover:bg-red-500 group-hover:text-white transition-all">
                        <i data-lucide="shield-alert" style="width:24px;height:24px"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-sm font-black text-forest uppercase tracking-widest group-hover:text-red-500 transition-colors">Sécurité</h4>
                        <p class="text-[10px] font-bold text-zinc-400 uppercase">Mot de passe</p>
                    </div>
                </a>
                <!-- Action 4: CRM Personnel -->
                <a href="<?= BASE_URL ?>/admin/users" class="bg-white p-6 md:p-8 rounded-[40px] border border-zinc-100 shadow-lg shadow-zinc-500/5 hover:bg-zinc-800 hover:border-zinc-800 group transition-all duration-500">
                    <div class="h-14 w-14 bg-zinc-50 rounded-2xl flex items-center justify-center text-zinc-400 mb-6 group-hover:bg-white/10 group-hover:text-white transition-all">
                        <i data-lucide="users" style="width:24px;height:24px"></i>
                    </div>
                    <div class="space-y-1 text-nowrap">
                        <h4 class="text-xs font-black text-forest uppercase tracking-widest group-hover:text-white transition-colors">Personnel</h4>
                        <p class="text-[9px] font-bold text-zinc-400 group-hover:text-white/60 transition-colors uppercase">Gestion Staff</p>
                    </div>
                </a>
                <?php endif; ?>
            </div>
            
            <?php if (in_array($role, ['superadmin', 'admin'])): ?>
            <!-- Wide Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                <!-- Partenariats Card -->
                <a href="<?= BASE_URL ?>/admin/partenariats" class="bg-white p-8 rounded-[40px] border border-zinc-100 shadow-xl shadow-zinc-500/5 flex items-center justify-between hover:border-blue-500 transition-all group relative overflow-hidden">
                    <?php if ($pending_parts > 0): ?>
                        <div class="absolute top-0 right-0 bg-blue-500 text-white px-4 py-1 rounded-bl-2xl text-[10px] font-black uppercase tracking-widest animate-pulse">
                            <?= $pending_parts ?> Nouveau(x)
                        </div>
                    <?php endif; ?>
                    <div class="flex items-center gap-6">
                        <div class="h-16 w-16 bg-blue-50 text-blue-600 rounded-[24px] flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            <i data-lucide="handshake" style="width:28px;height:28px"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-forest tracking-tight">Partenariats</h4>
                            <p class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Demandes & CRM</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="text-zinc-300 group-hover:text-blue-500 transition-colors"></i>
                </a>

                <a href="<?= BASE_URL ?>/admin/newsletter" class="bg-white p-8 rounded-[40px] border border-zinc-100 shadow-xl shadow-zinc-500/5 flex items-center justify-between hover:scale-[1.01] transition-all group">
                    <div class="flex items-center gap-6">
                        <div class="h-16 w-16 bg-gold/10 text-gold rounded-[24px] flex items-center justify-center group-hover:bg-gold group-hover:text-white transition-colors">
                            <i data-lucide="megaphone" style="width:28px;height:28px"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-forest tracking-tight">Newsletter</h4>
                            <p class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Gérer les abonnés</p>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="text-zinc-300 group-hover:text-gold transition-colors"></i>
                </a>

                <a href="<?= BASE_URL ?>/admin/campaign/create" class="bg-forest p-8 rounded-[40px] shadow-2xl shadow-forest/20 flex items-center justify-between hover:scale-[1.01] transition-all group lg:col-span-1">
                    <div class="flex items-center gap-6">
                        <div class="h-16 w-16 bg-white/10 text-gold rounded-[24px] flex items-center justify-center group-hover:bg-gold group-hover:text-forest transition-colors">
                            <i data-lucide="send-to-back" style="width:28px;height:28px"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-white tracking-tight">Campagne</h4>
                            <p class="text-xs font-bold text-gold/60 uppercase tracking-widest">Emailing Global</p>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="text-gold"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

