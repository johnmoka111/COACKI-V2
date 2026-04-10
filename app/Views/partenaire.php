<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-blue: #2196F3;
        --border-gray: #E0E0E0;
        --text-dark: #212121;
        --text-secondary: #757575;
    }
    .font-roboto { font-family: 'Roboto', sans-serif; }
    
    .outlined-input-group {
        position: relative;
        margin-bottom: 24px;
    }
    
    .outlined-input {
        width: 100%;
        height: 56px;
        padding: 0 16px 0 48px;
        border: 1.5px solid var(--border-gray);
        border-radius: 12px;
        background: white;
        font-size: 16px;
        color: var(--text-dark);
        outline: none;
        transition: all 0.3s ease;
    }
    
    .outlined-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px rgba(33, 150, 243, 0.1);
    }
    
    .outlined-label {
        position: absolute;
        left: 48px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-weight: 500;
        pointer-events: none;
        transition: all 0.2s ease;
        background: transparent;
        padding: 0 4px;
    }
    
    .outlined-input:focus ~ .outlined-label,
    .outlined-input:not(:placeholder-shown) ~ .outlined-label {
        top: 0;
        transform: translateY(-50%) scale(0.85);
        background: white;
        color: var(--primary-blue);
    }
    
    .prefix-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        transition: color 0.3s ease;
    }
    
    .outlined-input:focus ~ .prefix-icon {
        color: var(--primary-blue);
    }

    .cta-button {
        width: 100%;
        height: 56px;
        background: var(--primary-blue);
        color: white;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 8px 16px rgba(33, 150, 243, 0.3);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .cta-button:active {
        transform: scale(0.98);
        box-shadow: 0 4px 8px rgba(33, 150, 243, 0.2);
    }

    .stepper-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        transition: all 0.4s ease;
    }
</style>

<section class="min-h-screen bg-white font-roboto">
    <div class="max-w-xl mx-auto px-6 py-12">
        <!-- Header -->
        <div class="text-center mb-10 space-y-4 animate-in fade-in slide-in-from-top-4 duration-700">
            <div class="h-16 w-16 bg-blue-50 text-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <i data-lucide="handshake" class="w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Devenir Partenaire</h1>
            <p class="text-slate-500 font-medium">Rejoignez l'écosystème COACKI et participez au développement durable du Kivu.</p>
        </div>

        <!-- Stepper Indicator -->
        <div class="flex items-center justify-between mb-12 px-2">
            <div class="flex flex-col items-center gap-2" id="indic-1">
                <div class="stepper-circle bg-blue-500 text-white shadow-lg shadow-blue-500/20">1</div>
                <span class="text-[10px] font-bold uppercase text-blue-500 tracking-widest">Identité</span>
            </div>
            <div class="flex-1 h-[2px] mx-4 bg-slate-100 mb-6" id="line-1"></div>
            <div class="flex flex-col items-center gap-2 opacity-30" id="indic-2">
                <div class="stepper-circle bg-slate-200 text-slate-400">2</div>
                <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Contact</span>
            </div>
            <div class="flex-1 h-[2px] mx-4 bg-slate-100 mb-6" id="line-2"></div>
            <div class="flex flex-col items-center gap-2 opacity-30" id="indic-3">
                <div class="stepper-circle bg-slate-200 text-slate-400">3</div>
                <span class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Projet</span>
            </div>
        </div>

        <div class="bg-white">
            <?php if (!empty($success)): ?>
                <div class="text-center py-12 space-y-8 animate-in zoom-in duration-500">
                    <div class="h-24 w-24 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto">
                        <i data-lucide="check" class="w-12 h-12"></i>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-2xl font-bold text-slate-900">Demande envoyée !</h3>
                        <p class="text-slate-500">Nous vous recontacterons très prochainement.</p>
                    </div>
                    <a href="<?= BASE_URL ?>/" class="cta-button">Retour à l'accueil</a>
                </div>
            <?php else: ?>
                <form id="stepperForm" method="POST" action="<?= BASE_URL ?>/partenaire" enctype="multipart/form-data" class="space-y-6">
                    
                    <?php if (!empty($error)): ?>
                        <div class="bg-red-50 text-red-500 p-4 rounded-xl text-sm font-medium mb-6">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Step 1: Identité -->
                    <div id="step-1" class="step-pane space-y-6">
                        <div class="outlined-input-group">
                            <i data-lucide="user" class="prefix-icon w-5 h-5"></i>
                            <input name="nom" required placeholder=" " class="outlined-input">
                            <label class="outlined-label">Nom complet *</label>
                        </div>
                        <div class="outlined-input-group">
                            <i data-lucide="building" class="prefix-icon w-5 h-5"></i>
                            <input name="organisation" placeholder=" " class="outlined-input">
                            <label class="outlined-label">Organisation / Société</label>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1">Photo / Logo de l'entreprise</label>
                            <label class="flex items-center gap-4 p-4 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all">
                                <input type="file" name="logo" class="hidden" id="logoInput">
                                <i data-lucide="image-plus" class="w-6 h-6 text-slate-300"></i>
                                <span class="text-sm font-medium text-slate-500" id="logoText">Ajouter un logo...</span>
                            </label>
                        </div>
                    </div>

                    <!-- Step 2: Contact -->
                    <div id="step-2" class="step-pane space-y-6 hidden">
                        <div class="outlined-input-group">
                            <i data-lucide="mail" class="prefix-icon w-5 h-5"></i>
                            <input name="email" type="email" required placeholder=" " class="outlined-input">
                            <label class="outlined-label">Email professionnel *</label>
                        </div>
                        <div class="outlined-input-group">
                            <i data-lucide="phone" class="prefix-icon w-5 h-5"></i>
                            <input name="telephone" type="tel" placeholder=" " class="outlined-input">
                            <label class="outlined-label">Téléphone / WhatsApp</label>
                        </div>
                    </div>

                    <!-- Step 3: Projet -->
                    <div id="step-3" class="step-pane space-y-6 hidden">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1">Type de partenariat *</label>
                            <input type="hidden" name="type" id="typeInput">
                            <button type="button" onclick="openPartnerPicker()" class="w-full h-14 border-1.5 border-slate-200 rounded-xl px-4 flex items-center justify-between group hover:border-blue-500 transition-all">
                                <span id="typeLabel" class="text-slate-500 font-medium">Sélectionner un type...</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                            </button>
                        </div>

                        <div id="otherDetailsWrap" class="outlined-input-group hidden animate-in slide-in-from-top-2">
                            <i data-lucide="info" class="prefix-icon w-5 h-5"></i>
                            <input name="autre_details" id="autreDetails" placeholder=" " class="outlined-input">
                            <label class="outlined-label">Précisez votre demande *</label>
                        </div>

                        <div class="outlined-input-group">
                            <textarea name="message" required rows="4" placeholder=" " class="outlined-input min-h-[120px] pt-4"></textarea>
                            <label class="outlined-label">Votre message / vision *</label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col gap-4 pt-6">
                        <div class="flex gap-4">
                            <button type="button" id="prevBtn" class="flex-1 h-14 bg-slate-100 text-slate-600 rounded-xl font-bold text-sm hidden">Précédent</button>
                            <button type="button" id="nextBtn" class="flex-[2] cta-button">Continuer</button>
                            <button type="submit" id="submitBtn" class="flex-[2] cta-button hidden">Finaliser</button>
                        </div>
                        
                        <p class="text-center text-sm text-slate-500">
                            Déjà partenaire ? <a href="<?= BASE_URL ?>/login" class="text-blue-500 font-bold hover:underline">Se connecter</a>
                        </p>
                    </div>

                </form>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    let currentStep = 1;
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');

    function updateUI() {
        // Handle Step Panes
        [1,2,3].forEach(s => {
            const pane = document.getElementById(`step-${s}`);
            if (pane) pane.classList.toggle('hidden', s !== currentStep);
            
            const indic = document.getElementById(`indic-${s}`);
            if (indic) {
                const circle = indic.querySelector('.stepper-circle');
                const text = indic.querySelector('span');
                
                if (s === currentStep) {
                    indic.classList.remove('opacity-30');
                    circle.className = "stepper-circle bg-blue-500 text-white shadow-lg shadow-blue-500/20";
                    text.className = "text-[10px] font-bold uppercase text-blue-500 tracking-widest";
                } else if (s < currentStep) {
                    indic.classList.remove('opacity-30');
                    circle.className = "stepper-circle bg-emerald-500 text-white";
                    circle.innerHTML = '<i data-lucide="check" class="w-4 h-4"></i>';
                    text.className = "text-[10px] font-bold uppercase text-emerald-500 tracking-widest";
                } else {
                    indic.classList.add('opacity-30');
                    circle.className = "stepper-circle bg-slate-200 text-slate-400";
                    circle.innerText = s;
                    text.className = "text-[10px] font-bold uppercase text-slate-400 tracking-widest";
                }
            }
        });

        // Lines
        const line1 = document.getElementById('line-1');
        const line2 = document.getElementById('line-2');
        if (line1) line1.className = `flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 ${currentStep > 1 ? 'bg-blue-500' : 'bg-slate-100'}`;
        if (line2) line2.className = `flex-1 h-[2px] mx-4 mb-6 transition-all duration-500 ${currentStep > 2 ? 'bg-blue-500' : 'bg-slate-100'}`;

        // Buttons
        if (prevBtn) prevBtn.classList.toggle('hidden', currentStep === 1);
        if (nextBtn) nextBtn.classList.toggle('hidden', currentStep === 3);
        if (submitBtn) submitBtn.classList.toggle('hidden', currentStep !== 3);
        
        lucide.createIcons();
    }

    if (nextBtn) nextBtn.onclick = () => { if (currentStep < 3) { currentStep++; updateUI(); } };
    if (prevBtn) prevBtn.onclick = () => { if (currentStep > 1) { currentStep--; updateUI(); } };

    // Logo Upload Text
    const logoInput = document.getElementById('logoInput');
    if (logoInput) {
        logoInput.onchange = function() {
            if (this.files[0]) document.getElementById('logoText').innerText = this.files[0].name;
        };
    }

    // Picker Logic
    const PARTNER_TYPES = [
        { value: 'torrefacteur', label: 'Torréfacteur / Importateur', icon: 'coffee' },
        { value: 'distributeur', label: 'Distributeur / Grossiste', icon: 'truck' },
        { value: 'investisseur', label: 'Investisseur / Bailleur', icon: 'trending-up' },
        { value: 'ong', label: 'ONG / Organisation', icon: 'heart' },
        { value: 'autre', label: 'Autre collaboration', icon: 'more-horizontal' }
    ];

    window.openPartnerPicker = function() {
        window.openBottomSheet("Type de partenaire", PARTNER_TYPES, (val, label) => {
            const input = document.getElementById('typeInput');
            const labelEl = document.getElementById('typeLabel');
            if (input) input.value = val;
            if (labelEl) {
                labelEl.innerText = label;
                labelEl.className = "text-slate-900 font-bold";
            }
            
            const otherWrap = document.getElementById('otherDetailsWrap');
            if (otherWrap) {
                if (val === 'autre') otherWrap.classList.remove('hidden');
                else otherWrap.classList.add('hidden');
            }
        });
    }

    lucide.createIcons();
</script>
