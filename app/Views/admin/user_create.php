<div class="px-6 py-10 md:px-12 md:py-12 bg-[#f8fafc] min-h-screen">
    <div class="max-w-xl mx-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-12">
            <div class="space-y-1">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Recrutement</h1>
                <p class="text-sm font-bold text-slate-400">Nouveau collaborateur ou membre</p>
            </div>
            <a href="<?= BASE_URL ?>/admin/users" class="h-10 w-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm">
                <i data-lucide="x" style="width:18px;height:18px"></i>
            </a>
        </div>

        <!-- Stepper Indicator -->
        <div class="flex items-center justify-between mb-12 px-2">
            <div id="indic-1" class="flex flex-col items-center gap-3 transition-all duration-500">
                <div class="stepper-circle h-10 w-10 rounded-full flex items-center justify-center font-black text-sm">1</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Rôle</span>
            </div>
            <div id="line-1" class="flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 bg-slate-100"></div>
            <div id="indic-2" class="flex flex-col items-center gap-3 transition-all duration-500 opacity-30">
                <div class="stepper-circle h-10 w-10 rounded-full flex items-center justify-center font-black text-sm">2</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Identité</span>
            </div>
            <div id="line-2" class="flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 bg-slate-100"></div>
            <div id="indic-3" class="flex flex-col items-center gap-3 transition-all duration-500 opacity-30">
                <div class="stepper-circle h-10 w-10 rounded-full flex items-center justify-center font-black text-sm">3</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Détails</span>
            </div>
        </div>

        <form action="<?= BASE_URL ?>/admin/users/store" method="POST" id="userForm" enctype="multipart/form-data">
            <div class="bg-white rounded-[40px] shadow-[0_20px_70px_-15px_rgba(0,0,0,0.1)] border border-white p-8 md:p-12 relative overflow-hidden">
                
                <!-- STEP 1: ROLE -->
                <div id="step-1" class="space-y-6">
                    <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest text-center mb-8">Sélectionnez le niveau d'accès</p>
                    
                    <input type="hidden" name="role_id" id="roleInput" value="4">
                    <div class="grid grid-cols-1 gap-4">
                        <?php 
                        $roles = [
                            ['id' => 4, 'label' => 'Membre Agriculteur', 'icon' => 'leaf', 'sub' => 'Accès terroir & géolocalisation'],
                            ['id' => 3, 'label' => 'Communication', 'icon' => 'megaphone', 'sub' => 'Gestion des actus & média'],
                            ['id' => 2, 'label' => 'Administrateur', 'icon' => 'user-cog', 'sub' => 'Gestion standard CRM'],
                            ['id' => 1, 'label' => 'Super Admin', 'icon' => 'shield-check', 'sub' => 'Accès total système']
                        ];
                        foreach($roles as $r):
                        ?>
                        <button type="button" onclick="selectRole(<?= $r['id'] ?>, '<?= $r['label'] ?>')" class="role-card p-6 rounded-3xl border-2 transition-all flex items-center gap-5 text-left <?= $r['id'] == 4 ? 'border-blue-600 bg-blue-50' : 'border-slate-100 bg-slate-50' ?>" data-id="<?= $r['id'] ?>">
                            <div class="h-12 w-12 rounded-2xl flex items-center justify-center <?= $r['id'] == 4 ? 'bg-blue-600 text-white' : 'bg-white text-slate-400 border border-slate-200 shadow-sm' ?> role-icon">
                                <i data-lucide="<?= $r['icon'] ?>" style="width:24px;height:24px"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 leading-tight"><?= $r['label'] ?></h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1"><?= $r['sub'] ?></p>
                            </div>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- STEP 2: IDENTITY -->
                <div id="step-2" class="hidden space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Prénom</label>
                            <input type="text" name="prenom" required placeholder="Ex: Jean" class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Nom</label>
                            <input type="text" name="nom" required placeholder="Ex: Moka" class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Email</label>
                        <input type="email" name="email" required placeholder="nom@coacki.com" class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Téléphone</label>
                        <input type="tel" name="telephone" placeholder="+243..." class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                    </div>
                </div>

                <!-- STEP 3: PASSWORD & AGRI -->
                <div id="step-3" class="hidden space-y-8">
                    <div class="space-y-4 p-6 bg-slate-50 rounded-3xl">
                        <div class="flex items-center justify-between">
                            <label class="text-[10px] font-black uppercase text-slate-900 tracking-widest">Accès temporaire</label>
                            <button type="button" onclick="generatePass()" class="text-[10px] font-black uppercase text-blue-600 hover:underline">Générer sécurisé</button>
                        </div>
                        <input type="text" id="passIn" name="password" value="Coacki<?= date('Y') ?>!" required class="w-full bg-white border border-slate-200 rounded-xl px-5 py-3 text-sm font-black text-slate-900">
                    </div>

                    <!-- Only for Agriculteurs -->
                    <div id="agriWrap" class="space-y-6 pt-6 border-t border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 bg-blue-500 text-white rounded-lg flex items-center justify-center">
                                <i data-lucide="map-pin" style="width:16px;height:16px"></i>
                            </div>
                            <h4 class="font-black text-slate-900 text-sm">Données Terroir</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="any" name="latitude" placeholder="Latitude (GPS)" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-xs">
                            <input type="number" step="any" name="longitude" placeholder="Longitude (GPS)" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-xs">
                        </div>
                        <input type="file" name="photo_champ" accept="image/*" class="w-full bg-slate-50 border border-slate-200 border-dashed rounded-xl px-4 py-3 text-xs">
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center gap-4 pt-8 border-t border-slate-50 mt-8">
                    <button type="button" id="prevB" class="hidden flex-1 h-14 bg-slate-100 text-slate-600 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-slate-200 transition-all">Retour</button>
                    <button type="button" id="nextB" class="flex-1 h-14 bg-blue-600 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-blue-700 shadow-xl shadow-blue-500/20 transition-all flex items-center justify-center gap-2">Suivant <i data-lucide="arrow-right" class="w-4 h-4"></i></button>
                    <button type="submit" id="subB" class="hidden flex-1 h-14 bg-blue-600 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-blue-700 shadow-xl shadow-blue-500/20 transition-all">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
(function() {
    let currentStep = 1;
    let selectedRoleId = 4;
    const nextBtn = document.getElementById('nextB');
    const prevBtn = document.getElementById('prevB');
    const submitBtn = document.getElementById('subB');
    const roleInput = document.getElementById('roleInput');
    const agriWrap = document.getElementById('agriWrap');

    window.selectRole = function(id, label) {
        selectedRoleId = id;
        roleInput.value = id;
        
        // UI cards toggle
        document.querySelectorAll('.role-card').forEach(card => {
            const cardId = card.getAttribute('data-id');
            const icon = card.querySelector('.role-icon');
            if(cardId == id) {
                card.className = "role-card p-6 rounded-3xl border-2 border-blue-600 bg-blue-50 flex items-center gap-5 text-left transition-all scale-[1.02] shadow-sm";
                icon.className = "h-12 w-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center role-icon";
            } else {
                card.className = "role-card p-6 rounded-3xl border-2 border-slate-100 bg-slate-50 flex items-center gap-5 text-left transition-all";
                icon.className = "h-12 w-12 rounded-2xl bg-white text-slate-400 border border-slate-200 shadow-sm flex items-center justify-center role-icon";
            }
        });

        // Toggle agri fields for step 3
        if (agriWrap) agriWrap.style.display = (id == 4) ? 'block' : 'none';
        
        // Auto-next to Step 2
        setTimeout(() => { if(currentStep == 1) { currentStep = 2; updateUI(); } }, 300);
    };

    function updateUI() {
        [1,2,3].forEach(s => {
            document.getElementById(`step-${s}`).classList.toggle('hidden', s !== currentStep);
            const indic = document.getElementById(`indic-${s}`);
            const circle = indic.querySelector('.stepper-circle');
            const text = indic.querySelector('span');

            if (s === currentStep) {
                indic.classList.remove('opacity-30');
                circle.className = "stepper-circle h-10 w-10 rounded-full flex items-center justify-center bg-blue-600 text-white font-black text-sm shadow-lg shadow-blue-500/20";
                circle.innerText = s;
                text.className = "text-[9px] font-black uppercase tracking-widest text-blue-600";
            } else if (s < currentStep) {
                indic.classList.remove('opacity-30');
                circle.className = "stepper-circle h-10 w-10 rounded-full flex items-center justify-center bg-emerald-500 text-white font-black text-sm";
                circle.innerHTML = '<i data-lucide="check" class="w-5 h-5"></i>';
                text.className = "text-[9px] font-black uppercase tracking-widest text-emerald-500";
            } else {
                indic.classList.add('opacity-30');
                circle.className = "stepper-circle h-10 w-10 rounded-full flex items-center justify-center bg-slate-200 text-slate-400 font-black text-sm";
                circle.innerText = s;
                text.className = "text-[9px] font-black uppercase tracking-widest text-slate-400";
            }
        });

        const line1 = document.getElementById('line-1');
        const line2 = document.getElementById('line-2');
        if (line1) line1.className = `flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 ${currentStep > 1 ? 'bg-blue-600' : 'bg-slate-100'}`;
        if (line2) line2.className = `flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 ${currentStep > 2 ? 'bg-blue-600' : 'bg-slate-100'}`;

        prevBtn.classList.toggle('hidden', currentStep === 1);
        nextBtn.classList.toggle('hidden', currentStep === 3);
        submitBtn.classList.toggle('hidden', currentStep !== 3);
        
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    nextBtn.onclick = () => { if (currentStep < 3) { currentStep++; updateUI(); } };
    prevBtn.onclick = () => { if (currentStep > 1) { currentStep--; updateUI(); } };

    window.generatePass = function() {
        const chars = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%";
        let pass = "";
        for(let i=0; i<10; i++) pass += chars.charAt(Math.floor(Math.random()*chars.length));
        document.getElementById('passIn').value = pass;
    };

    updateUI();
})();
</script>
