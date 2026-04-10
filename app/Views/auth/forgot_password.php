<div class="min-h-screen bg-coacki-bg flex items-center justify-center p-5">
    <div class="max-w-md w-full bg-white rounded-[40px] p-8 md:p-12 shadow-2xl border border-forest/5">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black text-forest tracking-tighter">Récupération</h1>
            <p class="text-xs font-medium text-zinc-500 mt-2">Saisissez votre email. Si des questions de sécurité sont configurées, vous pourrez changer votre mot de passe.</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mb-6 p-4 bg-red-50 text-red-500 rounded-2xl text-xs font-black uppercase tracking-widest border border-red-100 flex items-center gap-2">
                <i data-lucide="alert-circle" style="width:16px;height:16px"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/forgot_password" method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Email du compte</label>
                <input type="email" name="email" required placeholder="vous@coacki.cd" class="w-full bg-stone-50 border border-forest/10 rounded-2xl px-4 py-3.5 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
            </div>

            <button type="submit" class="w-full bg-forest text-gold py-4 px-6 rounded-2xl font-black uppercase tracking-widest shadow-xl flex items-center justify-center gap-2 hover:bg-forest/90 transition-all">
                Vérifier <i data-lucide="shield-check" style="width:16px;height:16px"></i>
            </button>
            <div class="text-center mt-4">
                <a href="<?= BASE_URL ?>/login" class="text-xs text-forest hover:font-bold">Retour à la connexion</a>
            </div>
        </form>
    </div>
</div>
