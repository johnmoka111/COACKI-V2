<div class="min-h-screen bg-coacki-bg flex items-center justify-center p-5">
    <div class="max-w-md w-full bg-white rounded-[40px] p-8 md:p-12 shadow-2xl border border-forest/5 relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-forest to-gold"></div>

        <div class="text-center mb-8">
            <div class="h-12 w-12 bg-forest/5 rounded-2xl flex items-center justify-center text-forest mx-auto mb-4">
                <i data-lucide="file-question" style="width:24px;height:24px"></i>
            </div>
            <h1 class="text-2xl font-black text-forest tracking-tighter">Questions de Sécurité</h1>
            <p class="text-[11px] font-bold text-zinc-400 uppercase tracking-widest mt-2">Prouvez votre identité</p>
        </div>

        <form action="<?= BASE_URL ?>/verify_questions" method="POST" class="space-y-6">
            <div class="space-y-2">
                <p class="text-xs font-black text-forest"><?= htmlspecialchars($q1) ?></p>
                <input type="text" name="rep1" required placeholder="Votre réponse" class="w-full bg-stone-50 border border-forest/10 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold/30 outline-none">
            </div>

            <div class="space-y-2">
                <p class="text-xs font-black text-forest"><?= htmlspecialchars($q2) ?></p>
                <input type="text" name="rep2" required placeholder="Votre réponse" class="w-full bg-stone-50 border border-forest/10 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold/30 outline-none">
            </div>

            <div class="space-y-2">
                <p class="text-xs font-black text-forest"><?= htmlspecialchars($q3) ?></p>
                <input type="text" name="rep3" required placeholder="Votre réponse" class="w-full bg-stone-50 border border-forest/10 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold/30 outline-none">
            </div>

            <button type="submit" class="w-full bg-forest text-gold py-4 px-6 rounded-2xl font-black uppercase tracking-widest shadow-xl flex items-center justify-center gap-2 hover:bg-forest/90 transition-all">
                Confirmer <i data-lucide="key-round" style="width:16px;height:16px"></i>
            </button>
        </form>
    </div>
</div>
