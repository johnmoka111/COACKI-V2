<div class="min-h-screen bg-[#f8fafc] py-12 md:py-20 px-6 relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-emerald-500/5 rounded-full blur-[120px]"></div>

    <div class="max-w-xl mx-auto relative">
        <!-- Header & Logo -->
        <div class="flex flex-col items-center mb-12">
            <a href="<?= BASE_URL ?>/" class="mb-8 hover:scale-105 transition-transform">
                <img src="<?= BASE_URL ?>/logo.png" alt="Logo" class="h-16 w-auto">
            </a>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight text-center">Rejoindre la Coopérative</h1>
            <p class="text-slate-400 text-sm font-bold mt-2 text-center uppercase tracking-widest">Création de compte membre</p>
        </div>

        <!-- Stepper Indicator -->
        <div class="flex items-center justify-between mb-12 px-2 max-w-sm mx-auto">
            <div id="indic-1" class="flex flex-col items-center gap-3 transition-all duration-500">
                <div class="stepper-circle h-10 w-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-500">1</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Identité</span>
            </div>
            <div id="line-1" class="flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 bg-slate-100"></div>
            <div id="indic-2" class="flex flex-col items-center gap-3 transition-all duration-500 opacity-30">
                <div class="stepper-circle h-10 w-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-500">2</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Sécurité</span>
            </div>
            <div id="line-2" class="flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 bg-slate-100"></div>
            <div id="indic-3" class="flex flex-col items-center gap-3 transition-all duration-500 opacity-30">
                <div class="stepper-circle h-10 w-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-500">3</div>
                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Terroir</span>
            </div>
        </div>

        <div class="bg-white rounded-[40px] shadow-[0_20px_70px_-15px_rgba(0,0,0,0.1)] border border-white p-8 md:p-12">
            
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest mb-8 border border-red-100 flex items-center gap-3">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="flex flex-col items-center text-center py-8">
                    <div class="h-20 w-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-6">
                        <i data-lucide="check-circle-2" class="w-10 h-10"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 mb-4">Compte créé !</h2>
                    <p class="text-slate-500 font-medium mb-8"><?= $success ?></p>
                    <a href="<?= BASE_URL ?>/login" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-500/20">
                        Se connecter
                    </a>
                </div>
            <?php else: ?>

            <form method="POST" action="<?= BASE_URL ?>/register" id="regForm" enctype="multipart/form-data">
                
                <!-- STEP 1: IDENTITY -->
                <div id="step-1" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Prénom</label>
                            <input type="text" name="prenom" required placeholder="Ex: Jean"
                                   class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Nom</label>
                            <input type="text" name="nom" required placeholder="Ex: Moka"
                                   class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Email</label>
                        <input type="email" name="email" required placeholder="jean@exemple.com"
                               class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Téléphone</label>
                        <input type="tel" name="telephone" placeholder="+243..."
                               class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <!-- STEP 2: SECURITY -->
                <div id="step-2" class="hidden space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 relative">
                            <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Mot de passe</label>
                            <input type="password" name="password" required id="regPass" minlength="6"
                                   class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-slate-400 tracking-widest ml-1">Confirmer</label>
                            <input type="password" name="confirm_password" required id="regConfirm"
                                   class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 font-bold focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                        </div>
                    </div>
                    <div class="p-6 bg-blue-50 rounded-3xl space-y-4">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4"></i> Questions de récupération
                        </p>
                        <input type="text" name="reponse_1" required placeholder="Quel est le nom de jeune fille de votre mère ?" class="w-full px-4 py-3 bg-white border border-blue-100 rounded-xl text-sm italic">
                        <input type="text" name="reponse_2" required placeholder="Quel était le nom de votre premier animal ?" class="w-full px-4 py-3 bg-white border border-blue-100 rounded-xl text-sm italic">
                    </div>
                    <!-- Hidden inputs for legacy questions compatibility -->
                    <input type="hidden" name="question_1" value="Nom de jeune fille de votre mère ?">
                    <input type="hidden" name="question_2" value="Nom de votre premier animal ?">
                    <input type="hidden" name="question_3" value="Ville de naissance ?">
                    <input type="hidden" name="reponse_3" value="COACKI-System">
                </div>

                <!-- STEP 3: OPTIONAL INFO -->
                <div id="step-3" class="hidden space-y-8">
                    <div class="bg-blue-600 text-white p-6 rounded-3xl relative overflow-hidden group">
                        <i data-lucide="sprout" class="absolute -bottom-4 -right-4 w-24 h-24 text-white/10 group-hover:scale-125 transition-transform duration-700"></i>
                        <h4 class="font-black text-lg mb-2">Profil Agriculteur ?</h4>
                        <p class="text-white/70 text-sm leading-relaxed mb-6">Si vous êtes producteur de café, vous pouvez renseigner vos coordonnées GPS pour la cartographie territoriale.</p>
                        
                        <label class="flex items-center justify-center gap-4 bg-white/10 p-4 rounded-2xl cursor-pointer hover:bg-white/20 transition-all border border-white/20">
                            <input type="checkbox" id="isAgri" class="w-5 h-5 rounded border-white/20 bg-transparent text-blue-400 focus:ring-blue-400">
                            <span class="font-bold text-sm">Je souhaite renseigner mon champ</span>
                        </label>
                    </div>

                    <div id="agriFields" class="hidden space-y-6 animate-in slide-in-from-top-4 duration-500">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Latitude</label>
                                <input type="number" step="any" name="latitude" placeholder="Ex: -2.1234" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Longitude</label>
                                <input type="number" step="any" name="longitude" placeholder="Ex: 28.5678" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Photo du champ</label>
                            <input type="file" name="photo_champ" accept="image/*" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 border-dashed rounded-xl text-xs">
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center gap-4 pt-8 border-t border-slate-50 mt-8">
                    <button type="button" id="prevBtn" class="hidden flex-1 h-14 bg-slate-100 text-slate-600 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Retour
                    </button>
                    <button type="button" id="nextBtn" class="flex-1 h-14 bg-blue-600 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all flex items-center justify-center gap-2">
                        Suivant <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                    <button type="submit" id="submitBtn" class="hidden flex-1 h-14 bg-blue-600 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all">
                        Créer le compte
                    </button>
                </div>
            </form>
            <?php endif; ?>
        </div>

        <p class="text-center mt-10 text-sm font-bold text-slate-400">
            Déjà membre ? <a href="<?= BASE_URL ?>/login" class="text-blue-600 font-black hover:text-blue-700 ml-1">S'identifier</a>
        </p>
    </div>
</div>

<script>
(function() {
    let currentStep = 1;
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');

    function updateRegisterUI() {
        [1,2,3].forEach(s => {
            const stepEl = document.getElementById(`step-${s}`);
            if (stepEl) stepEl.classList.toggle('hidden', s !== currentStep);
            
            const indic = document.getElementById(`indic-${s}`);
            if (indic) {
                const circle = indic.querySelector('.stepper-circle');
                const label = indic.querySelector('span');
                
                if (s === currentStep) {
                    indic.classList.remove('opacity-30');
                    circle.className = "stepper-circle h-10 w-10 rounded-full flex items-center justify-center bg-blue-600 text-white font-black text-sm shadow-lg shadow-blue-500/20";
                    circle.innerText = s;
                    label.className = "text-[9px] font-black uppercase tracking-widest text-blue-600";
                } else if (s < currentStep) {
                    indic.classList.remove('opacity-30');
                    circle.className = "stepper-circle h-10 w-10 rounded-full flex items-center justify-center bg-emerald-500 text-white font-black text-sm";
                    circle.innerHTML = '<i data-lucide="check" class="w-5 h-5"></i>';
                    label.className = "text-[9px] font-black uppercase tracking-widest text-emerald-500";
                } else {
                    indic.classList.add('opacity-30');
                    circle.className = "stepper-circle h-10 w-10 rounded-full flex items-center justify-center bg-slate-200 text-slate-400 font-black text-sm";
                    circle.innerText = s;
                    label.className = "text-[9px] font-black uppercase tracking-widest text-slate-400";
                }
            }
        });

        const line1 = document.getElementById('line-1');
        const line2 = document.getElementById('line-2');
        if (line1) line1.className = `flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 ${currentStep > 1 ? 'bg-blue-600' : 'bg-slate-100'}`;
        if (line2) line2.className = `flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 ${currentStep > 2 ? 'bg-blue-600' : 'bg-slate-100'}`;

        if (prevBtn) prevBtn.classList.toggle('hidden', currentStep === 1);
        if (nextBtn) nextBtn.classList.toggle('hidden', currentStep === 3);
        if (submitBtn) submitBtn.classList.toggle('hidden', currentStep !== 3);
        
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    if (nextBtn) nextBtn.onclick = () => { if (currentStep < 3) { currentStep++; updateRegisterUI(); } };
    if (prevBtn) prevBtn.onclick = () => { if (currentStep > 1) { currentStep--; updateRegisterUI(); } };

    document.getElementById('isAgri')?.addEventListener('change', function() {
        document.getElementById('agriFields')?.classList.toggle('hidden', !this.checked);
    });

    updateRegisterUI();
})();
</script>
