<div class="px-6 py-10 md:px-12 md:py-12 bg-coacki-bg min-h-screen">
    <div class="max-w-4xl mx-auto space-y-10">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">
                    <i data-lucide="user-plus" style="width:12px;height:12px"></i> Recrutement
                </div>
                <h1 class="text-3xl font-black text-forest tracking-tighter">Créer un catalogue</h1>
                <p class="text-sm font-bold text-zinc-400 tracking-tight">Ajouter un nouveau collaborateur ou membre agriculteur.</p>
            </div>
            
            <a href="<?= BASE_URL ?>/admin/users" class="h-10 px-5 bg-white border border-zinc-200 rounded-xl flex items-center justify-center gap-2 text-[10px] font-black uppercase tracking-widest text-zinc-500 hover:bg-zinc-50 transition-all">
                <i data-lucide="arrow-left" style="width:14px;height:14px"></i> Retour
            </a>
        </div>

        <form action="<?= BASE_URL ?>/admin/users/store" method="POST" enctype="multipart/form-data" class="space-y-6">
            
            <!-- Type de Compte Selector (Luxe Mobile) -->
            <div class="space-y-3">
                <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Type de compte *</label>
                <input type="hidden" name="role_id" id="roleInput" value="4">
                <div onclick="openRolePicker()" class="premium-select-trigger group">
                    <div class="flex items-center gap-4">
                        <div id="roleIcon" class="h-10 w-10 rounded-xl bg-forest text-gold flex items-center justify-center shadow-lg shadow-forest/10 transition-transform group-active:scale-90">
                            <i data-lucide="leaf" style="width:20px;height:20px"></i>
                        </div>
                        <div>
                             <div id="roleLabel" class="text-sm font-black text-forest">Membre Agriculteur</div>
                             <div class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Appuyez pour changer</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[40px] p-8 md:p-12 shadow-2xl shadow-zinc-500/5 border border-zinc-100 space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2">
                    <div class="premium-form-group">
                        <input type="text" name="prenom" required placeholder=" " 
                               class="premium-input">
                        <label class="premium-label">Prénom *</label>
                    </div>
                    <div class="premium-form-group">
                        <input type="text" name="nom" required placeholder=" " 
                               class="premium-input">
                        <label class="premium-label">Nom de famille *</label>
                    </div>
                </div>

                <div class="premium-form-group">
                    <input type="email" name="email" required placeholder=" " 
                           class="premium-input">
                    <label class="premium-label">Adresse Email *</label>
                </div>

                <div class="premium-form-group">
                    <input type="tel" name="telephone" placeholder=" " 
                           class="premium-input">
                    <label class="premium-label">Téléphone</label>
                </div>
                
                <div class="space-y-3 p-6 bg-yellow-50/50 rounded-3xl border border-yellow-100">
                    <label class="text-[10px] font-black text-yellow-700 uppercase tracking-[0.2em]">Mot de passe temporaire *</label>
                    <div class="flex gap-2">
                        <input type="text" id="passwordInput" name="password" required 
                               value="Coacki<?= date('Y') ?>!" 
                               autocomplete="new-password"
                               class="w-full h-14 bg-white border border-yellow-200 rounded-2xl px-6 text-sm font-black text-yellow-900 focus:ring-2 focus:ring-yellow-500/20 outline-none transition-all">
                        <button type="button" onclick="generateSecurePassword()" class="h-14 px-5 bg-yellow-400 text-yellow-900 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-yellow-500 transition-all flex-shrink-0">
                            Générer
                        </button>
                    </div>
                </div>
            </div>

            <!-- CHAMPS SPÉCIFIQUES MEMBRE -->
            <div id="memberFields" class="bg-emerald-50/50 p-8 md:p-12 rounded-[40px] space-y-8 border border-emerald-100 shadow-xl shadow-emerald-500/5">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center">
                        <i data-lucide="map" style="width:16px;height:16px"></i>
                    </div>
                    <h3 class="text-sm font-black text-forest uppercase tracking-widest">Terroir & Géolocalisation</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2">
                    <div class="premium-form-group">
                        <input type="number" step="any" name="latitude" placeholder=" " class="premium-input">
                        <label class="premium-label">Latitude</label>
                    </div>
                    <div class="premium-form-group">
                        <input type="number" step="any" name="longitude" placeholder=" " class="premium-input">
                        <label class="premium-label">Longitude</label>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-emerald-800 uppercase tracking-[0.2em] ml-1">Photo du champ (Fichier requis)</label>
                    <div class="relative group">
                        <input type="file" name="photo_champ" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="h-32 w-full bg-white border-2 border-dashed border-emerald-200 rounded-[32px] flex flex-col items-center justify-center gap-2 group-hover:bg-emerald-50 transition-all">
                             <div class="h-10 w-10 bg-emerald-500 text-white rounded-xl shadow-lg shadow-emerald-500/20 flex items-center justify-center">
                                 <i data-lucide="camera" style="width:20px;height:20px"></i>
                             </div>
                             <p class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Prendre ou choisir une photo</p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full h-16 flex items-center justify-center gap-3 bg-forest text-gold rounded-2xl font-black uppercase tracking-[0.2em] shadow-2xl shadow-forest/30 active:scale-95 transition-all text-xs">
                Valider l'inscription <i data-lucide="shield-check" style="width:18px;height:18px"></i>
            </button>
        </form>
    </div>
</div>

<script>
    const roleInput = document.getElementById('roleInput');
    const roleLabel = document.getElementById('roleLabel');
    const roleIcon = document.getElementById('roleIcon');
    const memberFields = document.getElementById('memberFields');

    const ROLES = [
        { value: '4', label: 'Membre Agriculteur', icon: 'leaf', sub: 'Gestion des cultures & terroir' },
        { value: '3', label: 'Chargé de Communication', icon: 'megaphone', sub: 'Gestion des articles & newsletters' },
        { value: '2', label: 'Administrateur', icon: 'user-cog', sub: 'Gestion standard du système' },
        { value: '1', label: 'Super Administrateur', icon: 'shield-check', sub: 'Accès total & personnel CRM' }
    ];

    function openRolePicker() {
        window.openBottomSheet("Type de compte", ROLES, (val, label) => {
            roleInput.value = val;
            roleLabel.innerText = label;
            
            const selected = ROLES.find(r => r.value === val);
            roleIcon.innerHTML = `<i data-lucide="${selected.icon}" style="width:20px;height:20px"></i>`;
            lucide.createIcons({ scope: roleIcon });
            
            memberFields.style.display = (val === '4') ? 'block' : 'none';
        });
    }

    function generateSecurePassword() {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
        let password = "";
        for (let i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('passwordInput').value = password;
    }

    // Initial check
    memberFields.style.display = 'block';
</script>

