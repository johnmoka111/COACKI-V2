<section class="py-12 md:py-24 bg-coacki-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-forest rounded-[60px] p-8 md:p-20 relative overflow-hidden shadow-2xl">
            <!-- Background effects -->
            <div class="absolute inset-0 opacity-10 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-gold/5 blur-[120px] rounded-full"></div>
            
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                
                <!-- Info Column -->
                <div class="lg:col-span-5 space-y-12 text-white">
                    <div class="space-y-6">
                        <div class="inline-flex h-8 px-4 bg-gold/20 border border-gold/30 text-gold rounded-full items-center text-[10px] font-black uppercase tracking-widest backdrop-blur-md">Alliance & Impact</div>
                        <h2 class="text-5xl md:text-7xl font-black tracking-tighter leading-[0.9] mb-6">
                            Cultivons <span class="text-gold italic">l'avenir</span> ensemble
                        </h2>
                        <p class="text-white/60 font-medium leading-relaxed text-base md:text-lg max-w-sm">
                            Devenez un maillon essentiel de l'excellence caféière au Sud-Kivu. Un partenariat équitable pour un impact durable.
                        </p>
                    </div>

                    <!-- Stepper Progress (Visible on Desktop) -->
                    <div class="hidden lg:block space-y-8">
                        <div class="flex items-center gap-6 group cursor-default" id="stepIndicator1">
                            <div class="h-12 w-12 rounded-2xl border-2 border-gold flex items-center justify-center font-black text-gold bg-gold/10 transition-all duration-500" id="stepIcon1">1</div>
                            <div>
                                <h4 class="font-black text-sm uppercase tracking-widest text-white">Identité</h4>
                                <p class="text-[10px] text-white/40 font-bold uppercase">Société & Logo</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 group opacity-40 transition-all duration-500" id="stepIndicator2">
                            <div class="h-12 w-12 rounded-2xl border-2 border-white/20 flex items-center justify-center font-black text-white/40" id="stepIcon2">2</div>
                            <div>
                                <h4 class="font-black text-sm uppercase tracking-widest text-white">Coopération</h4>
                                <p class="text-[10px] text-white/40 font-bold uppercase">Type & Projet</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 group opacity-40 transition-all duration-500" id="stepIndicator3">
                            <div class="h-12 w-12 rounded-2xl border-2 border-white/20 flex items-center justify-center font-black text-white/40" id="stepIcon3">3</div>
                            <div>
                                <h4 class="font-black text-sm uppercase tracking-widest text-white">Validation</h4>
                                <p class="text-[10px] text-white/40 font-bold uppercase">Contacts</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Column (The Glass Card) -->
                <div class="lg:col-span-7 bg-white rounded-[50px] p-6 md:p-12 shadow-[0_40px_120px_-20px_rgba(0,0,0,0.3)] min-h-[500px] flex flex-col justify-center relative">
                    
                    <?php if (!empty($success)): ?>
                        <div class="text-center py-10 space-y-8 animate-in fade-in zoom-in duration-700">
                            <div class="h-24 w-24 bg-emerald-50 text-emerald-500 rounded-[32px] flex items-center justify-center mx-auto shadow-xl shadow-emerald-500/10 rotate-12">
                                <i data-lucide="party-popper" style="width:48px;height:48px"></i>
                            </div>
                            <div class="space-y-3">
                                <h3 class="text-3xl font-black text-forest tracking-tighter">C'est transmis !</h3>
                                <p class="text-zinc-400 font-bold max-w-xs mx-auto leading-relaxed text-sm">
                                    Nous avons bien reçu votre demande. Notre équipe "Alliances" l'étudie avec attention.
                                </p>
                            </div>
                            <a href="<?= BASE_URL ?>/" class="inline-flex h-14 px-10 bg-forest text-gold rounded-2xl items-center font-black text-[10px] uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-lg shadow-forest/20">
                                Revenir à l'accueil
                            </a>
                        </div>
                    <?php else: ?>
                    
                        <form id="partnerStepper" method="POST" action="<?= BASE_URL ?>/partenaire" enctype="multipart/form-data" class="space-y-6">
                            
                            <!-- STEP 1: IDENTITÉ -->
                            <div id="step1" class="space-y-6 animate-in fade-in slide-in-from-right duration-500">
                                <div class="mb-8">
                                    <span class="text-[10px] font-black text-gold uppercase tracking-[0.3em]">Étape 01/03</span>
                                    <h3 class="text-3xl font-black text-forest tracking-tight mt-1">Qui êtes-vous ?</h3>
                                </div>

                                <div class="premium-form-group">
                                    <input name="nom" required placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                    <label class="premium-label">Nom complet du porteur *</label>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="premium-form-group">
                                        <input name="organisation" placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                        <label class="premium-label">Nom de l'entreprise</label>
                                    </div>
                                    <!-- Logo Upload -->
                                    <div class="relative group h-[72px]">
                                        <input type="file" name="logo" id="logoUpload" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-20">
                                        <div class="absolute inset-0 bg-zinc-50 border-2 border-dashed border-zinc-200 rounded-[20px] flex items-center px-6 gap-4 group-hover:border-gold/50 transition-colors">
                                            <div class="h-10 w-10 bg-white shadow-sm rounded-xl flex items-center justify-center text-zinc-400" id="logoPreview">
                                                <i data-lucide="image-plus" style="width:18px;height:18px"></i>
                                            </div>
                                            <div class="text-[10px] font-black text-zinc-400 uppercase tracking-widest" id="logoText">Logo Société</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="button" onclick="goToStep(2)" class="w-full h-16 bg-forest text-gold rounded-[24px] font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-forest/10 hover:translate-y-[-2px] active:translate-y-0 transition-all flex items-center justify-center gap-3">
                                        Continuer <i data-lucide="arrow-right" style="width:16px;height:16px"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- STEP 2: COOPÉRATION -->
                            <div id="step2" class="hidden space-y-6 animate-in fade-in slide-in-from-right duration-500">
                                <div class="mb-8">
                                    <span class="text-[10px] font-black text-gold uppercase tracking-[0.3em]">Étape 02/03</span>
                                    <h3 class="text-3xl font-black text-forest tracking-tight mt-1">Le Projet</h3>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Profil Partenaire *</label>
                                    <input type="hidden" name="type" id="typeInput" required>
                                    <div onclick="openPartnerPicker()" class="premium-select-trigger bg-zinc-50/50 border-zinc-100 h-16 flex items-center px-6">
                                        <div class="flex items-center justify-between w-full">
                                            <div class="flex items-center gap-4">
                                                <div id="typeIcon" class="h-10 w-10 bg-white shadow-sm rounded-xl flex items-center justify-center text-zinc-400">
                                                    <i data-lucide="help-circle" style="width:18px;height:18px"></i>
                                                </div>
                                                <div id="typeLabel" class="text-sm font-black text-forest">Choisir un profil...</div>
                                            </div>
                                            <i data-lucide="chevron-down" class="text-zinc-300" style="width:16px;height:16px"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Field for 'Autres' -->
                                <div id="autreField" class="hidden animate-in fade-in slide-in-from-top duration-300">
                                    <div class="premium-form-group">
                                        <input name="description_autre" id="autreInput" placeholder=" " class="premium-input bg-zinc-50 border-gold/20">
                                        <label class="premium-label">Précisez votre collaboration</label>
                                    </div>
                                </div>

                                <div class="premium-form-group">
                                    <textarea name="message" required rows="3" placeholder=" "
                                              class="premium-input bg-zinc-50 border-transparent min-h-[120px] pt-10"></textarea>
                                    <label class="premium-label">Détails de la demande *</label>
                                </div>

                                <div class="grid grid-cols-2 gap-4 pt-4">
                                    <button type="button" onclick="goToStep(1)" class="h-16 bg-zinc-100 text-zinc-400 rounded-[24px] font-black text-[11px] uppercase tracking-[0.2em] hover:bg-zinc-200 transition-all">Précédent</button>
                                    <button type="button" onclick="goToStep(3)" class="h-16 bg-forest text-gold rounded-[24px] font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-forest/10 transition-all flex items-center justify-center gap-3">Suivant <i data-lucide="arrow-right" style="width:16px;height:16px"></i></button>
                                </div>
                            </div>

                            <!-- STEP 3: COORDONNÉES & VALIDATION -->
                            <div id="step3" class="hidden space-y-6 animate-in fade-in slide-in-from-right duration-500">
                                <div class="mb-8">
                                    <span class="text-[10px] font-black text-gold uppercase tracking-[0.3em]">Étape 03/03</span>
                                    <h3 class="text-3xl font-black text-forest tracking-tight mt-1">Dernier pas</h3>
                                </div>

                                <div class="premium-form-group">
                                    <input name="email" type="email" required placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                    <label class="premium-label">Email professionnel *</label>
                                </div>

                                <div class="premium-form-group">
                                    <input name="telephone" type="tel" placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                    <label class="premium-label">Téléphone / WhatsApp</label>
                                </div>

                                <div class="p-6 bg-gold/10 rounded-3xl border border-gold/20">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 bg-gold text-forest rounded-full flex items-center justify-center">
                                            <i data-lucide="shield-check" style="width:20px;height:20px"></i>
                                        </div>
                                        <p class="text-[10px] font-bold text-forest uppercase tracking-widest leading-relaxed">
                                            En transmettant ce formulaire, vous initiez une procédure de revue par notre conseil d'administration.
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-4 pt-4">
                                    <button type="submit" class="w-full h-18 bg-forest text-gold rounded-[28px] font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-forest/40 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-4">
                                        Envoyer ma candidature <i data-lucide="send" style="width:20px;height:20px"></i>
                                    </button>
                                    <button type="button" onclick="goToStep(2)" class="text-[10px] font-black text-zinc-300 uppercase tracking-widest hover:text-forest transition-colors mt-2">Modifier les détails</button>
                                </div>
                            </div>

                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const typeInput = document.getElementById('typeInput');
    const typeLabel = document.getElementById('typeLabel');
    const typeIcon = document.getElementById('typeIcon');
    const autreField = document.getElementById('autreField');
    const logoUpload = document.getElementById('logoUpload');
    const logoPreview = document.getElementById('logoPreview');
    const logoText = document.getElementById('logoText');

    const PARTNER_TYPES = [
        { value: 'torrefacteur', label: 'Torréfacteur / Importateur', icon: 'coffee', sub: 'Achat de café cerise ou parche' },
        { value: 'distributeur', label: 'Distributeur / Grossiste', icon: 'truck', sub: 'Distribution locale ou internationale' },
        { value: 'investisseur', label: 'Investisseur / Bailleur', icon: 'trending-up', sub: 'Financement de projets agricoles' },
        { value: 'ong', icon: 'heart-handshake', label: 'ONG / Organisation', sub: 'Développement durable & social' },
        { value: 'autre', icon: 'more-horizontal', label: 'Autre collaboration', sub: 'Services, presse ou divers' }
    ];

    function goToStep(num) {
        // Validation basique avant de passer aux étapes suivantes
        if (num === 2) {
            const nom = document.querySelector('input[name="nom"]').value;
            if (!nom) {
                showToast("Veuillez entrer votre nom.", "error");
                return;
            }
        }
        if (num === 3) {
            const type = typeInput.value;
            const msg = document.querySelector('textarea[name="message"]').value;
            if (!type || !msg) {
                showToast("Détails du projet requis.", "error");
                return;
            }
        }

        // Cacher tous les pas
        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('step3').classList.add('hidden');

        // Afficher celui demandé
        document.getElementById('step' + num).classList.remove('hidden');

        // Mettre à jour les indicateurs visuels (Step indicators)
        for (let i = 1; i <= 3; i++) {
            const indicator = document.getElementById('stepIndicator' + i);
            const icon = document.getElementById('stepIcon' + i);
            if (i < num) {
                indicator.classList.remove('opacity-40');
                icon.className = "h-12 w-12 rounded-2xl border-2 border-emerald-500 bg-emerald-500 text-white flex items-center justify-center font-black transition-all";
                icon.innerHTML = '<i data-lucide="check" style="width:20px;height:20px"></i>';
            } else if (i === num) {
                indicator.classList.remove('opacity-40');
                icon.className = "h-12 w-12 rounded-2xl border-2 border-gold bg-gold/20 text-gold flex items-center justify-center font-black transition-all";
                icon.innerHTML = num;
            } else {
                indicator.classList.add('opacity-40');
                icon.className = "h-12 w-12 rounded-2xl border-2 border-white/20 text-white/40 flex items-center justify-center font-black transition-all";
                icon.innerHTML = i;
            }
        }
        lucide.createIcons();
    }

    function openPartnerPicker() {
        window.openBottomSheet("Type de partenaire", PARTNER_TYPES, (val, label) => {
            typeInput.value = val;
            typeLabel.innerText = label;
            
            const selected = PARTNER_TYPES.find(p => p.value === val);
            typeIcon.innerHTML = `<i data-lucide="${selected.icon}" style="width:18px;height:18px"></i>`;
            typeIcon.className = "h-10 w-10 bg-gold text-forest shadow-sm rounded-xl flex items-center justify-center";
            lucide.createIcons({ scope: typeIcon });

            // Afficher le champ 'Autre' si sélectionné
            if (val === 'autre') {
                autreField.classList.remove('hidden');
                document.getElementById('autreInput').focus();
            } else {
                autreField.classList.add('hidden');
            }
        });
    }

    // Preview du logo uploadé
    logoUpload.onchange = evt => {
        const [file] = logoUpload.files;
        if (file) {
            logoText.innerText = file.name;
            logoText.className = "text-[10px] font-black text-gold uppercase tracking-widest truncate max-w-[150px]";
            
            const reader = new FileReader();
            reader.onload = e => {
                logoPreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg shadow-inner">`;
                logoPreview.className = "h-10 w-10 bg-white shadow-sm rounded-xl flex items-center justify-center p-1 overflow-hidden";
            };
            reader.readAsDataURL(file);
        }
    };
</script>
