<div class="min-h-[85vh] bg-coacki-bg pt-10 pb-20">
    <div class="max-w-2xl mx-auto px-5 md:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-forest">Ajouter à la Galerie</h1>
                <p class="text-zinc-500 font-medium">Enrichissez la banque d'images de la coopérative.</p>
            </div>
            <a href="<?= BASE_URL ?>/dashboard" class="px-4 py-2 bg-white border border-forest/10 rounded-xl text-forest text-xs font-black uppercase tracking-widest hover:bg-forest hover:text-white transition-all">
                Retour
            </a>
        </div>

        <form action="<?= BASE_URL ?>/admin/gallery/store" method="POST" enctype="multipart/form-data" class="bg-white rounded-[32px] md:rounded-[40px] p-6 md:p-10 shadow-xl border border-forest/5 space-y-6">
            
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Titre de l'image (Optionnel)</label>
                <input type="text" name="titre" placeholder="Ex: Femmes au tri manuel..." class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Image (Fichier) *</label>
                <input type="file" name="image" required accept="image/*" class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Catégorie *</label>
                <select name="categorie" required class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                    <option value="Général">Général</option>
                    <option value="Récolte">Récolte</option>
                    <option value="Culture">Culture</option>
                    <option value="Femmes">Femmes</option>
                    <option value="Infrastructure">Infrastructure</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-forest text-gold px-10 py-4 rounded-2xl font-black uppercase tracking-widest shadow-xl hover:bg-forest/90 transition-all flex items-center justify-center gap-2 mt-8">
                Ajouter l'image <i data-lucide="image-plus" style="width:16px;height:16px"></i>
            </button>
        </form>
    </div>
</div>
