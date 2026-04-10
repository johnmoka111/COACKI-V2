<div class="min-h-[85vh] flex items-center justify-center py-20 px-6">
    <div class="w-full max-w-md bg-white rounded-[48px] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-500 border border-zinc-100 relative">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-gold/10 rounded-full blur-[60px]"></div>
        
        <div class="p-10 md:p-12 relative z-10">
            <div class="flex justify-center mb-10">
                <div class="h-20 w-20 bg-forest rounded-3xl flex items-center justify-center shadow-2xl shadow-forest/20 rotate-3">
                    <i data-lucide="layout-dashboard" class="text-gold" style="width:32px;height:32px"></i>
                </div>
            </div>
            
            <h1 class="text-3xl font-black text-forest text-center mb-1 tracking-tighter">Accès Sécurisé</h1>
            <p class="text-zinc-400 text-center font-bold text-sm mb-12 italic">Pôle Administration COACKI</p>
            
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 text-red-500 p-4 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 border border-red-100 flex items-center gap-3">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/login" class="space-y-4">
                <div class="premium-form-group">
                    <input type="email" name="email" required placeholder=" " 
                           class="premium-input !bg-zinc-50 border-transparent">
                    <label class="premium-label">Adresse Email</label>
                    <i data-lucide="mail" class="absolute right-5 top-[1.4rem] text-zinc-300 pointer-events-none" style="width:18px;height:18px"></i>
                </div>
                
                <div class="premium-form-group">
                    <input type="password" name="password" required placeholder=" " 
                           class="premium-input !bg-zinc-50 border-transparent">
                    <label class="premium-label">Mot de passe</label>
                    <i data-lucide="lock" class="absolute right-5 top-[1.4rem] text-zinc-300 pointer-events-none" style="width:18px;height:18px"></i>
                </div>
                
                <div class="flex justify-end px-1">
                    <a href="<?= BASE_URL ?>/forgot_password" class="text-[10px] font-black text-gold uppercase tracking-[0.2em] hover:underline transition-all">Identifiants perdus ?</a>
                </div>
                
                <button type="submit" class="w-full h-16 bg-forest text-gold py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] shadow-2xl shadow-forest/30 hover:scale-[1.02] active:scale-[0.96] transition-all flex justify-center items-center gap-3 mt-8">
                    S'authentifier <i data-lucide="key-round" style="width:18px;height:18px"></i>
                </button>
            </form>
            
            <div class="mt-12 pt-8 border-t border-zinc-50 text-center">
                <p class="text-[12px] text-zinc-400 font-bold lowercase">
                    Pas encore de catalogue ? 
                    <a href="<?= BASE_URL ?>/register" class="text-forest font-black hover:text-gold transition-colors block mt-1 uppercase tracking-widest text-[10px]">Demander une adhésion</a>
                </p>
            </div>
        </div>
    </div>
</div>

