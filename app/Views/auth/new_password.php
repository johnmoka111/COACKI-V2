<div class="min-h-screen bg-coacki-bg flex items-center justify-center p-5">
    <div class="max-w-md w-full bg-white rounded-[40px] p-8 md:p-12 shadow-2xl border border-forest/5 relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-forest to-gold"></div>

        <div class="text-center mb-8">
            <div class="h-12 w-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mx-auto mb-4">
                <i data-lucide="unlock" style="width:24px;height:24px"></i>
            </div>
            <h1 class="text-2xl font-black text-forest tracking-tighter">Nouveau mot de passe</h1>
            <p class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest mt-2">Accès autorisé. Définissez votre nouveau code.</p>
        </div>

        <form action="<?= BASE_URL ?>/update_password" method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Nouveau Mot de passe *</label>
                <div class="relative">
                    <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/40"></i>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full bg-stone-50 border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                </div>
            </div>

            <button type="submit" class="w-full bg-forest text-gold py-4 px-6 rounded-2xl font-black uppercase tracking-widest shadow-xl flex items-center justify-center gap-2 hover:bg-forest/90 transition-all">
                Enregistrer la modification <i data-lucide="save" style="width:16px;height:16px"></i>
            </button>
        </form>
    </div>
</div>
