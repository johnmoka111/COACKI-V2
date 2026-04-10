<div class="min-h-[85vh] flex items-center justify-center py-20 px-6">
    <div class="w-full max-w-xl bg-white rounded-[40px] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-500 border border-forest/10 relative">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gold/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-forest/5 rounded-full blur-3xl"></div>
        
        <div class="p-10 relative z-10">
            <div class="flex justify-center mb-6">
                <div class="h-16 w-16 bg-forest rounded-2xl flex items-center justify-center shadow-lg shadow-forest/20">
                    <i data-lucide="user-plus" class="text-gold" style="width:28px;height:28px"></i>
                </div>
            </div>
            
            <h1 class="text-3xl font-black text-forest text-center mb-2 tracking-tight">Rejoignez-nous</h1>
            <p class="text-zinc-500 text-center font-medium text-sm mb-8">Créez votre compte membre COACKI.</p>
            
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-sm font-bold mb-6 flex items-center gap-3 border border-red-100">
                    <i data-lucide="alert-circle" style="width:18px;height:18px"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl text-sm font-bold mb-6 flex flex-col items-center gap-3 border border-emerald-100 text-center">
                    <div class="h-12 w-12 bg-emerald-100 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="text-emerald-600" style="width:24px;height:24px"></i>
                    </div>
                    <?= htmlspecialchars($success) ?>
                    <a href="<?= BASE_URL ?>/login" class="px-6 py-2 bg-emerald-600 text-white rounded-full mt-2 hover:bg-emerald-700 transition">Se connecter</a>
                </div>
            <?php else: ?>

            <form method="POST" action="<?= BASE_URL ?>/register" enctype="multipart/form-data" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Prénom *</label>
                        <div class="relative">
                            <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 text-forest/40" style="width:18px;height:18px"></i>
                            <input type="text" name="prenom" required
                                   class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 focus:border-gold outline-none transition-all">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Nom *</label>
                        <div class="relative">
                            <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 text-forest/40" style="width:18px;height:18px"></i>
                            <input type="text" name="nom" required
                                   class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 focus:border-gold outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Email *</label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 text-forest/40" style="width:18px;height:18px"></i>
                            <input type="email" name="email" required
                                   class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 focus:border-gold outline-none transition-all">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Téléphone</label>
                        <div class="relative">
                            <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 text-forest/40" style="width:18px;height:18px"></i>
                            <input type="tel" name="telephone" placeholder="+243..."
                                   class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 focus:border-gold outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Mot de passe *</label>
                        <div class="relative flex gap-2">
                            <div class="relative flex-1">
                                <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 text-forest/40" style="width:18px;height:18px"></i>
                                <input id="regPass" type="password" name="password" required minlength="6" autocomplete="new-password"
                                       class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 focus:border-gold outline-none transition-all">
                            </div>
                            <button type="button" onclick="suggestPassword()" class="px-3 bg-zinc-100 text-forest border border-forest/10 rounded-2xl text-[9px] font-black uppercase hover:bg-gold transition-all">Suggérer</button>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Confirmer *</label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 text-forest/40" style="width:18px;height:18px"></i>
                            <input id="regConfirm" type="password" name="confirm_password" required minlength="6" autocomplete="new-password"
                                   class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 focus:border-gold outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Bloc Sécurité (Questions) -->
                <div class="bg-zinc-50 p-6 rounded-[24px] border border-zinc-200 mt-4 space-y-4">
                    <p class="text-[10px] font-black text-forest uppercase tracking-widest mb-2">Questions de Sécurité (Obligatoires)</p>
                    
                    <div class="space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-center">
                            <input type="text" name="question_1" value="Nom de jeune fille de votre mère ?" class="bg-white border rounded-xl px-4 py-2 text-[11px] font-bold" readonly>
                            <input type="text" name="reponse_1" required placeholder="Votre réponse" class="bg-white border rounded-xl px-4 py-2 text-[11px]">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-center">
                            <input type="text" name="question_2" value="Nom de votre premier animal ?" class="bg-white border rounded-xl px-4 py-2 text-[11px] font-bold" readonly>
                            <input type="text" name="reponse_2" required placeholder="Votre réponse" class="bg-white border rounded-xl px-4 py-2 text-[11px]">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-center">
                            <input type="text" name="question_3" value="Ville de naissance ?" class="bg-white border rounded-xl px-4 py-2 text-[11px] font-bold" readonly>
                            <input type="text" name="reponse_3" required placeholder="Votre réponse" class="bg-white border rounded-xl px-4 py-2 text-[11px]">
                        </div>
                    </div>
                </div>
                
                <!-- Bloc Optionnel : Infos Agriculteur -->
                <div class="mt-4 pt-4 border-t border-forest/5">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" id="isAgri" class="w-5 h-5 rounded border-forest/20 text-forest focus:ring-gold">
                        <span class="text-xs font-black text-forest uppercase tracking-widest">Je suis un agriculteur membre</span>
                    </label>
                    
                    <div id="agriFields" class="hidden mt-4 space-y-4 bg-forest/5 p-5 rounded-3xl border border-forest/5">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="any" name="latitude" placeholder="Latitude (GPS)" class="w-full bg-white border border-forest/10 rounded-xl px-4 py-2 text-xs">
                            <input type="number" step="any" name="longitude" placeholder="Longitude (GPS)" class="w-full bg-white border border-forest/10 rounded-xl px-4 py-2 text-xs">
                        </div>
                        <div>
                            <label class="text-[9px] font-black text-zinc-400 uppercase ml-1">Photo de mon champ</label>
                            <input type="file" name="photo_champ" accept="image/*" class="w-full bg-white border border-forest/10 rounded-xl px-4 py-2 text-xs">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-forest text-gold py-4 rounded-2xl text-sm font-black uppercase tracking-widest shadow-xl shadow-forest/20 hover:scale-[1.02] active:scale-[0.98] transition-all mt-4">
                    Créer mon compte
                </button>
            </form>
            
            <p class="text-center text-sm text-zinc-500 font-medium mt-8">
                Vous avez déjà un compte ? 
                <a href="<?= BASE_URL ?>/login" class="text-forest font-black hover:text-gold transition-colors">Connectez-vous</a>
            </p>
            
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function suggestPassword() {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*";
        let pass = "";
        for(let i=0; i<12; i++) pass += chars.charAt(Math.floor(Math.random()*chars.length));
        document.getElementById('regPass').value = pass;
        document.getElementById('regConfirm').value = pass;
        document.getElementById('regPass').type = 'text';
    }

    document.getElementById('isAgri')?.addEventListener('change', function() {
        document.getElementById('agriFields').style.display = this.checked ? 'block' : 'none';
    });
</script>
