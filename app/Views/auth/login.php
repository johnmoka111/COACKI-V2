<div class="min-h-screen flex items-center justify-center p-6 bg-[#f8fafc] relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-600/5 rounded-full blur-[120px]"></div>

    <div class="w-full max-w-md relative">
        <!-- Back Link -->
        <a href="<?= BASE_URL ?>/" class="absolute -top-16 left-0 flex items-center gap-2 text-slate-400 hover:text-blue-600 transition-all font-bold text-sm group">
            <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
            Retour au site
        </a>

        <div class="bg-white rounded-[40px] shadow-[0_20px_70px_-15px_rgba(0,0,0,0.1)] border border-white p-8 md:p-12 relative overflow-hidden">
            
            <div class="flex flex-col items-center mb-10">
                <img src="<?= BASE_URL ?>/logo.png" alt="Logo" class="h-20 w-auto mb-6">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight text-center">Espace Membres</h1>
                <p class="text-slate-400 text-sm font-bold mt-2 text-center uppercase tracking-widest">Connectez-vous à COACKI</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest mb-8 border border-red-100 flex items-center gap-3">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/login" class="space-y-6">
                <!-- Email Field -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Adresse Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <input type="email" name="email" required placeholder="nom@exemple.com"
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Mot de passe</label>
                        <a href="<?= BASE_URL ?>/forgot_password" class="text-[10px] font-bold text-blue-600 uppercase tracking-widest hover:underline">Oublié ?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="block w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full h-16 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-blue-500/20 hover:bg-blue-700 active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                    Se connecter 
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-slate-50 text-center">
                <p class="text-sm font-bold text-slate-400">
                    Nouveau ici ? 
                    <a href="<?= BASE_URL ?>/register" class="text-blue-600 font-black hover:text-blue-700 ml-1">Créer un compte</a>
                </p>
            </div>
        </div>
        
        <p class="text-center mt-8 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
            &copy; <?= date('Y') ?> COACKI - Plateforme Sécurisée
        </p>
    </div>
</div>

