<section class="py-12 md:py-24 bg-coacki-bg min-h-screen relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-gold/5 rounded-full blur-[100px]"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-forest/5 rounded-full blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="bg-forest rounded-[48px] md:rounded-[64px] p-6 md:p-16 lg:p-24 relative overflow-hidden shadow-2xl border border-white/5">
            <div class="absolute inset-0 opacity-10 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
            
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
                
                <!-- Left: Persuasion & Info -->
                <div class="lg:col-span-5 space-y-10 text-white">
                    <div class="space-y-6">
                        <div class="inline-flex h-9 px-5 bg-gold/20 border border-gold/30 text-gold rounded-full items-center text-[10px] font-black uppercase tracking-[0.2em] backdrop-blur-sm">
                            <i data-lucide="globe" class="w-3 h-3 mr-2"></i> Alliance Mondiale
                        </div>
                        <h2 class="text-5xl md:text-7xl font-black tracking-tighter leading-[0.9] transition-all">
                            Traçons <br><span class="text-gold italic">l'avenir</span> ensemble
                        </h2>
                        <p class="text-white/60 font-medium leading-relaxed text-lg max-w-md">
                            Que vous soyez torréfacteur, investisseur ou une organisation engagée, COACKI est votre partenaire de confiance au Kivu.
                        </p>
                    </div>

                    <!-- Visual Stepper Progress (Desktop Only) -->
                    <div class="hidden lg:block space-y-8 pt-6">
                        <div class="flex items-center gap-6 group" id="stepIndicator1">
                            <div class="h-12 w-12 rounded-2xl bg-gold text-forest flex items-center justify-center font-black text-lg shadow-lg shadow-gold/20 transition-all duration-500">1</div>
                            <div class="space-y-1">
                                <h4 class="font-black text-sm uppercase tracking-widest text-white">Identité</h4>
                                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest">Qui êtes-vous ?</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 group opacity-30" id="stepIndicator2">
                            <div class="h-12 w-12 rounded-2xl bg-white/10 text-white flex items-center justify-center font-black text-lg transition-all duration-500">2</div>
                            <div class="space-y-1">
                                <h4 class="font-black text-sm uppercase tracking-widest text-white">Contact</h4>
                                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest">Comment vous joindre ?</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 group opacity-30" id="stepIndicator3">
                            <div class="h-12 w-12 rounded-2xl bg-white/10 text-white flex items-center justify-center font-black text-lg transition-all duration-500">3</div>
                            <div class="space-y-1">
                                <h4 class="font-black text-sm uppercase tracking-widest text-white">Vision</h4>
                                <p class="text-white/40 text-[10px] font-bold uppercase tracking-widest">Votre projet</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bank details card -->
                    <div class="p-8 bg-white/5 backdrop-blur-xl rounded-[40px] border border-white/10 space-y-4">
                        <div class="flex items-center gap-3 text-gold">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">Compte Officiel Certifié</span>
                        </div>
                        <div class="font-mono text-sm break-all bg-black/20 p-4 rounded-2xl border border-white/5 text-white/90">
                            EQUITY BCDC: 655200138927337
                        </div>
                    </div>
                </div>
                
                <!-- Right: Stepper Form -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-[48px] p-6 md:p-12 lg:p-14 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] min-h-[600px] flex flex-col items-stretch">
                        
                        <?php if (!empty($success)): ?>
                            <div class="my-auto text-center space-y-8 animate-in zoom-in duration-500">
                                <div class="h-32 w-32 bg-emerald-50 text-emerald-500 rounded-[48px] flex items-center justify-center mx-auto shadow-2xl shadow-emerald-500/10 rotate-12">
                                    <i data-lucide="send-to-back" style="width:56px;height:56px"></i>
                                </div>
                                <div class="space-y-3">
                                    <h3 class="text-4xl font-black text-forest tracking-tighter">Proposition Reçue</h3>
                                    <p class="text-zinc-400 font-bold max-w-xs mx-auto text-sm leading-relaxed">
                                        Notre équipe d'administration analyse votre demande. Vous recevrez une réponse sous 48h.
                                    </p>
                                </div>
                                <a href="<?= BASE_URL ?>/" class="inline-flex h-16 px-12 bg-forest text-gold rounded-3xl items-center font-black text-[11px] uppercase tracking-widest hover:bg-gold hover:text-forest transition-all shadow-xl shadow-forest/20">
                                    Retour à l'accueil
                                </a>
                            </div>
                        <?php else: ?>
                            
                            <form id="stepperForm" method="POST" action="<?= BASE_URL ?>/partenaire" enctype="multipart/form-data" class="flex-1 flex flex-col h-full">
                                
                                <div class="flex justify-between items-center mb-10 overflow-hidden">
                                    <div class="space-y-1">
                                        <h3 id="stepTitle" class="text-3xl font-black text-forest tracking-tighter transition-all">Identité</h3>
                                        <p id="stepSubtitle" class="text-zinc-400 font-bold text-xs uppercase tracking-widest">Étape <span id="currentStepNum">1</span> sur 3</p>
                                    </div>
                                    <div class="h-14 w-14 bg-forest/5 text-forest rounded-2xl flex items-center justify-center font-black" id="stepIcon">
                                        <i data-lucide="building-2"></i>
                                    </div>
                                </div>

                                <?php if (!empty($error)): ?>
                                    <div class="bg-red-50 text-red-600 p-5 rounded-3xl text-[11px] font-black uppercase tracking-widest mb-8 border border-red-100 flex items-center gap-4">
                                        <i data-lucide="alert-triangle" class="w-5 h-5"></i> <?= htmlspecialchars($error) ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Step 1 Content -->
                                <div class="step-content space-y-6" id="step1">
                                    <div class="premium-form-group">
                                        <input name="nom" required placeholder=" " class="premium-input shadow-sm border-zinc-50">
                                        <label class="premium-label">Nom complet du responsable *</label>
                                    </div>
                                    <div class="premium-form-group">
                                        <input name="organisation" placeholder=" " class="premium-input shadow-sm border-zinc-50">
                                        <label class="premium-label">Nom de l'Organisation / Entreprise</label>
                                    </div>
                                    
                                    <!-- Logo Upload -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Logo de l'entreprise</label>
                                        <div class="relative group">
                                            <input type="file" name="logo" id="logoInput" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                            <div id="logoPreview" class="h-24 w-full bg-zinc-50 border-2 border-dashed border-zinc-200 rounded-3xl flex items-center justify-center gap-4 group-hover:border-gold group-hover:bg-gold/5 transition-all duration-300">
                                                <div class="h-12 w-12 bg-white rounded-2xl flex items-center justify-center text-zinc-300 shadow-sm" id="logoIconBox">
                                                    <i data-lucide="camera" class="w-6 h-6"></i>
                                                </div>
                                                <span class="text-sm font-black text-zinc-400" id="logoText">Cliquer pour uploader</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2 Content -->
                                <div class="step-content space-y-6 hidden" id="step2">
                                    <div class="premium-form-group">
                                        <input name="email" type="email" required placeholder=" " class="premium-input shadow-sm border-zinc-50">
                                        <label class="premium-label">Email professionnel *</label>
                                    </div>
                                    <div class="premium-form-group">
                                        <input name="telephone" type="tel" placeholder=" " class="premium-input shadow-sm border-zinc-50">
                                        <label class="premium-label">Téléphone / WhatsApp (International)</label>
                                    </div>
                                    <div class="p-6 bg-gold/5 rounded-3xl border border-gold/10 flex gap-4">
                                        <i data-lucide="info" class="w-5 h-5 text-gold flex-shrink-0 mt-1"></i>
                                        <p class="text-[11px] text-forest/70 font-medium leading-relaxed">
                                            Assurez-vous que vos coordonnées sont correctes afin que notre board puisse vous recontacter rapidement.
                                        </p>
                                    </div>
                                </div>

                                <!-- Step 3 Content -->
                                <div class="step-content space-y-6 hidden" id="step3">
                                    <!-- Partner Type selector -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Secteur d'intérêt *</label>
                                        <input type="hidden" name="type" id="typeInput" value="">
                                        <button type="button" onclick="openPartnerPicker()" class="w-full h-16 bg-zinc-50 border border-zinc-100 rounded-2xl flex items-center justify-between px-6 hover:border-gold transition-all group">
                                            <div class="flex items-center gap-4">
                                                <div id="typeIcon" class="h-10 w-10 bg-white shadow-sm rounded-xl flex items-center justify-center text-zinc-400 group-hover:text-gold">
                                                    <i data-lucide="layers" style="width:18px;height:18px"></i>
                                                </div>
                                                <div id="typeLabel" class="text-sm font-black text-forest">Choisir un profil...</div>
                                            </div>
                                            <i data-lucide="chevron-down" class="text-zinc-300 group-hover:text-gold" style="width:16px;height:16px"></i>
                                        </button>
                                    </div>

                                    <!-- Conditional Extra Field -->
                                    <div id="otherDetailsWrap" class="premium-form-group hidden animate-in slide-in-from-top-4 duration-300">
                                        <input name="autre_details" id="autreDetails" placeholder=" " class="premium-input bg-zinc-50 border-gold/20 font-black text-gold">
                                        <label class="premium-label text-gold font-black">Précisez votre domaine *</label>
                                    </div>

                                    <div class="premium-form-group">
                                        <textarea name="message" required rows="4" placeholder=" "
                                                  class="premium-input shadow-sm border-zinc-50 min-h-[140px] pt-10"></textarea>
                                        <label class="premium-label">Message ou Détails de la proposition *</label>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="mt-auto pt-10 flex gap-4">
                                    <button type="button" id="prevBtn" class="flex-1 h-16 bg-zinc-100 text-zinc-400 rounded-3xl font-black text-[11px] uppercase tracking-widest hidden hover:bg-zinc-200 transition-all">Précédent</button>
                                    <button type="button" id="nextBtn" class="flex-[2] h-16 bg-forest text-gold rounded-3xl font-black text-[11px] uppercase tracking-widest shadow-xl shadow-forest/10 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                                        Continuer <i data-lucide="arrow-right" style="width:16px;height:16px"></i>
                                    </button>
                                    <button type="submit" id="submitBtn" class="flex-[2] h-16 bg-forest text-gold rounded-3xl font-black text-[11px] uppercase tracking-widest shadow-xl shadow-forest/10 hidden hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                                        Envoyer le Projet <i data-lucide="check" style="width:16px;height:16px"></i>
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let currentStep = 1;
    const steps = [1, 2, 3];
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    const stepTitle = document.getElementById('stepTitle');
    const stepIcon = document.getElementById('stepIcon');
    const stepNumEl = document.getElementById('currentStepNum');

    const stepInfo = {
        1: { title: "Identité", icon: "building-2" },
        2: { title: "Contact", icon: "mail" },
        3: { title: "Vision", icon: "lightbulb" }
    };

    function updateStepperUI() {
        // Hide all steps
        steps.forEach(s => {
            document.getElementById(`step${s}`).classList.add('hidden');
            const indicator = document.getElementById(`stepIndicator${s}`);
            if (indicator) {
                if (s === currentStep) {
                    indicator.classList.remove('opacity-30');
                    indicator.querySelector('div').className = "h-12 w-12 rounded-2xl bg-gold text-forest flex items-center justify-center font-black text-lg shadow-lg shadow-gold/20";
                } else if (s < currentStep) {
                    indicator.classList.remove('opacity-30');
                    indicator.querySelector('div').className = "h-12 w-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-emerald-500/20";
                    indicator.querySelector('div').innerHTML = '<i data-lucide="check" class="w-5 h-5"></i>';
                } else {
                    indicator.classList.add('opacity-30');
                    indicator.querySelector('div').className = "h-12 w-12 rounded-2xl bg-white/10 text-white flex items-center justify-center font-black text-lg";
                    indicator.querySelector('div').innerHTML = s;
                }
            }
        });

        // Show current
        const currentEl = document.getElementById(`step${currentStep}`);
        currentEl.classList.remove('hidden');
        currentEl.classList.add('animate-in', 'fade-in', 'slide-in-from-right-8', 'duration-500');

        stepTitle.innerText = stepInfo[currentStep].title;
        stepNumEl.innerText = currentStep;
        stepIcon.innerHTML = `<i data-lucide="${stepInfo[currentStep].icon}"></i>`;
        lucide.createIcons({ scope: stepIcon });
        if (typeof lucide !== 'undefined' && currentStep > 1) lucide.createIcons();

        // Button visibility
        prevBtn.classList.toggle('hidden', currentStep === 1);
        nextBtn.classList.toggle('hidden', currentStep === 3);
        submitBtn.classList.toggle('hidden', currentStep !== 3);
    }

    nextBtn.onclick = () => {
        if (currentStep < 3) {
            currentStep++;
            updateStepperUI();
        }
    };

    prevBtn.onclick = () => {
        if (currentStep > 1) {
            currentStep--;
            updateStepperUI();
        }
    };

    // Image Upload Preview
    const logoInput = document.getElementById('logoInput');
    const logoPreview = document.getElementById('logoPreview');
    const logoText = document.getElementById('logoText');
    const logoIconBox = document.getElementById('logoIconBox');

    logoInput.onchange = (e) => {
        const file = e.target.files[0];
        if (file) {
            logoText.innerText = "Fichier sélectionné : " + file.name;
            logoIconBox.className = "h-12 w-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-sm";
            logoIconBox.innerHTML = '<i data-lucide="check" class="w-6 h-6"></i>';
            logoPreview.className = "h-24 w-full bg-emerald-50 border-2 border-dashed border-emerald-200 rounded-3xl flex items-center justify-center gap-4";
            lucide.createIcons();
        }
    };

    // Conditional Fields Logic
    const typeInput = document.getElementById('typeInput');
    const typeLabel = document.getElementById('typeLabel');
    const typeIcon = document.getElementById('typeIcon');
    const otherDetailsWrap = document.getElementById('otherDetailsWrap');
    const otherDetailsInput = document.getElementById('autreDetails');

    const PARTNER_TYPES = [
        { value: 'torrefacteur', label: 'Torréfacteur / Importateur', icon: 'coffee', sub: 'Achat de café cerise ou parche' },
        { value: 'distributeur', label: 'Distributeur / Grossiste', icon: 'truck', sub: 'Distribution locale ou internationale' },
        { value: 'investisseur', label: 'Investisseur / Bailleur', icon: 'trending-up', sub: 'Financement de projets agricoles' },
        { value: 'ong', icon: 'heart-handshake', label: 'ONG / Organisation', sub: 'Développement durable & social' },
        { value: 'autre', icon: 'more-horizontal', label: 'Autre collaboration', sub: 'Services, presse ou divers' }
    ];

    function openPartnerPicker() {
        window.openBottomSheet("Votre profil", PARTNER_TYPES, (val, label) => {
            typeInput.value = val;
            typeLabel.innerText = label;
            
            const selected = PARTNER_TYPES.find(p => p.value === val);
            typeIcon.innerHTML = `<i data-lucide="${selected.icon}" style="width:18px;height:18px"></i>`;
            typeIcon.className = "h-10 w-10 bg-gold text-forest shadow-sm rounded-xl flex items-center justify-center";
            
            // Handle conditional field
            if (val === 'autre') {
                otherDetailsWrap.classList.remove('hidden');
                otherDetailsInput.required = true;
            } else {
                otherDetailsWrap.classList.add('hidden');
                otherDetailsInput.required = false;
            }

            lucide.createIcons({ scope: typeIcon });
        });
    }

    lucide.createIcons();
</script>
