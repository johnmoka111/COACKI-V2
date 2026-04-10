<div class="min-h-[85vh] bg-coacki-bg pt-10 pb-24 md:pb-20">
    <div class="max-w-xl mx-auto px-5 md:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-forest">Mon Profil</h1>
                <p class="text-zinc-500 font-medium text-sm">Cliquez sur votre photo pour la changer.</p>
            </div>
            <a href="<?= BASE_URL ?>/dashboard" class="flex items-center gap-2 px-4 py-2 bg-white border border-forest/10 rounded-xl text-forest text-xs font-black uppercase tracking-widest hover:bg-forest hover:text-white transition-all">
                <i data-lucide="arrow-left" style="width:14px;height:14px"></i> Retour
            </a>
        </div>

        <form action="<?= BASE_URL ?>/admin/profile/update" method="POST" enctype="multipart/form-data" class="bg-white rounded-[32px] md:rounded-[40px] p-6 md:p-10 shadow-xl border border-forest/5 space-y-8">
            
            <!-- Avatar Upload Zone (cliquable) -->
            <?php 
            $avatarSession = $_SESSION['user']['avatar_url'] ?? null;
            $defaultAvatar = 'https://ui-avatars.com/api/?name=' . urlencode(($_SESSION['user']['prenom'] ?? '') . ' ' . ($_SESSION['user']['nom'] ?? '')) . '&background=032E1A&color=EAB308&size=256';
            ?>
            <div class="flex flex-col items-center gap-4">
                <!-- Zone cliquable avec overlay -->
                <label for="avatarInput" class="relative group cursor-pointer">
                    <img id="avatarPreview" src="<?= $avatarSession ?: $defaultAvatar ?>" alt="Avatar"
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl ring-2 ring-forest/10 group-hover:ring-gold transition-all">
                    
                    <!-- Overlay au hover -->
                    <div class="absolute inset-0 rounded-full bg-forest/60 flex flex-col items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <i data-lucide="camera" class="text-white" style="width:28px;height:28px"></i>
                        <span class="text-white text-[9px] font-black uppercase tracking-widest">Changer</span>
                    </div>

                    <!-- Badge caméra (toujours visible) -->
                    <div class="absolute bottom-1 right-1 h-9 w-9 bg-gold rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                        <i data-lucide="camera" class="text-forest" style="width:16px;height:16px"></i>
                    </div>
                </label>

                <!-- Input caché -->
                <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden">
                
                <div class="text-center">
                    <p class="text-sm font-black text-forest">
                        <?= htmlspecialchars(($_SESSION['user']['prenom'] ?? '') . ' ' . ($_SESSION['user']['nom'] ?? '')) ?>
                    </p>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gold mt-1">
                        <?= ucfirst($_SESSION['user']['role'] ?? '') ?>
                    </p>
                </div>
            </div>

            <!-- Champs Nom/Prénom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Prénom *</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/40"></i>
                        <input type="text" name="prenom" required
                               value="<?= htmlspecialchars($_SESSION['user']['prenom'] ?? '') ?>"
                               class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Nom de famille *</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/40"></i>
                        <input type="text" name="nom" required
                               value="<?= htmlspecialchars($_SESSION['user']['nom'] ?? '') ?>"
                               class="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                    </div>
                </div>
            </div>

            <!-- Email (lecture seule) -->
            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Email (non modifiable)</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/20"></i>
                    <input type="email" value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" disabled
                           class="w-full bg-zinc-50 border border-forest/5 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium text-zinc-400 cursor-not-allowed">
                </div>
            </div>

            <button type="submit" class="w-full bg-forest text-gold py-4 rounded-2xl font-black uppercase tracking-widest shadow-xl hover:bg-forest/90 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                Enregistrer <i data-lucide="check" style="width:16px;height:16px"></i>
            </button>
        </form>
    </div>
</div>

<script>
// Prévisualisation instantanée de l'avatar avant soumission
document.getElementById('avatarInput')?.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;

    if (file) {
        if(!file.type.match('image.*')) {
            showToast('Format non supporté. Utilisez JPG, PNG ou WEBP.', 'error');
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
