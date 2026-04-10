<section class="py-12 md:py-24 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-forest rounded-[60px] p-8 md:p-20 relative overflow-hidden shadow-2xl">
            <!-- Decorative Grain & Light -->
            <div class="absolute inset-0 opacity-20 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')]"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-gold/10 blur-[100px] rounded-full"></div>
            
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                
                <!-- Info Column -->
                <div class="lg:col-span-5 space-y-12 text-white">
                    <div class="space-y-4">
                        <div class="inline-flex h-8 px-4 bg-gold text-forest rounded-full items-center text-[10px] font-black uppercase tracking-widest">Global Alliance</div>
                        <h2 class="text-4xl md:text-6xl font-black tracking-tighter leading-[0.95] mb-6">
                            Unis pour <span class="text-gold italic">l'excellence</span>
                        </h2>
                        <p class="text-white/70 font-bold leading-relaxed text-base md:text-lg max-w-md">
                            Torréfacteurs, importateurs ou partenaires au développement : rejoignez la chaîne de valeur du café Kivu.
                        </p>
                    </div>

                    <!-- Compact Info Grid -->
                    <div class="grid grid-cols-1 gap-4">
                        <div class="p-6 bg-white/5 backdrop-blur-md rounded-[32px] border border-white/10 group hover:bg-white/10 transition-all duration-500">
                            <h4 class="text-gold font-black uppercase text-[10px] tracking-widest mb-4 flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4"></i> Kalehe, Sud-Kivu
                            </h4>
                            <div class="text-xs md:text-sm text-white/60 font-bold leading-relaxed">
                                Village Munanira, Mbinga-Sud. Siège opérationnel de traitement et d'exportation.
                            </div>
                        </div>

                        <div class="p-6 bg-white/5 backdrop-blur-md rounded-[32px] border border-white/10 group hover:bg-white/10 transition-all duration-500">
                            <h4 class="text-gold font-black uppercase text-[10px] tracking-widest mb-4 flex items-center gap-2">
                                <i data-lucide="landmark" class="w-4 h-4"></i> Banque & Transferts
                            </h4>
                            <div class="space-y-3">
                                <span class="block font-mono font-black text-white tracking-widest text-xs md:text-sm bg-black/20 p-3 rounded-xl border border-white/5">EQUITY BCDC: 655200138927337</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Column -->
                <div class="lg:col-span-7 bg-white rounded-[50px] p-8 md:p-14 shadow-[0_40px_100px_-20px_rgba(0,0,0,0.2)]">
                    <?php if (!empty($success)): ?>
                        <div class="text-center py-10 space-y-8">
                            <div class="h-28 w-28 bg-emerald-50 text-emerald-500 rounded-[40px] flex items-center justify-center mx-auto shadow-xl shadow-emerald-500/10 rotate-12">
                                <i data-lucide="check-circle-2" style="width:52px;height:52px"></i>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-3xl font-black text-forest tracking-tighter">Votre voix est entendue</h3>
                                <p class="text-zinc-400 font-bold max-w-xs mx-auto leading-relaxed">
                                    Notre pôle Relations Extérieures vous reviendra par email d'ici 24 à 48 heures.
                                </p>
                            </div>
                            <a href="<?= BASE_URL ?>/" class="inline-flex h-14 px-10 bg-forest text-gold rounded-2xl items-center font-black text-[10px] uppercase tracking-widest hover:scale-105 active:scale-95 transition-all">
                                Retour au Site
                            </a>
                        </div>
                    <?php else: ?>
                    
                        <div class="mb-10 space-y-1">
                            <h3 class="text-2xl font-black text-forest tracking-tight">Initier le contact</h3>
                            <p class="text-zinc-400 font-bold text-sm tracking-tight italic">Les champs marqués d'une étoile (*) sont requis.</p>
                        </div>

                        <?php if (!empty($error)): ?>
                            <div class="bg-red-50 text-red-500 p-4 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 border border-red-100 flex items-center gap-3">
                                <i data-lucide="shield-alert" class="w-4 h-4"></i> <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= BASE_URL ?>/partenaire" class="space-y-4">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="premium-form-group">
                                    <input name="nom" required placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                    <label class="premium-label">Nom complet *</label>
                                </div>
                                <div class="premium-form-group">
                                    <input name="organisation" placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                    <label class="premium-label">Organisation / Société</label>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="premium-form-group">
                                    <input name="email" type="email" required placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                    <label class="premium-label">Email professionnel *</label>
                                </div>
                                <div class="premium-form-group">
                                    <input name="telephone" type="tel" placeholder=" " class="premium-input bg-zinc-50 border-transparent">
                                    <label class="premium-label">Téléphone (WhatsApp)</label>
                                </div>
                            </div>

                            <!-- Partner Type Bottom Sheet Choice -->
                            <div class="space-y-2 mb-6">
                                <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Type de partenariat *</label>
                                <input type="hidden" name="type" id="typeInput" value="">
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

                            <div class="premium-form-group">
                                <textarea name="message" required rows="4" placeholder=" "
                                          class="premium-input bg-zinc-50 border-transparent min-h-[140px] pt-10"></textarea>
                                <label class="premium-label">Votre projet ou demande *</label>
                            </div>

                            <button type="submit" class="w-full h-16 bg-forest text-gold rounded-[24px] font-black text-[11px] uppercase tracking-[0.2em] shadow-2xl shadow-forest/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-4">
                                Transmettre au Board <i data-lucide="send" style="width:18px;height:18px"></i>
                            </button>
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

    const PARTNER_TYPES = [
        { value: 'torrefacteur', label: 'Torréfacteur / Importateur', icon: 'coffee', sub: 'Achat de café cerise ou parche' },
        { value: 'distributeur', label: 'Distributeur / Grossiste', icon: 'truck', sub: 'Distribution locale ou internationale' },
        { value: 'investisseur', label: 'Investisseur / Bailleur', icon: 'trending-up', sub: 'Financement de projets agricoles' },
        { value: 'ong', icon: 'heart-handshake', label: 'ONG / Organisation', sub: 'Développement durable & social' },
        { value: 'autre', icon: 'more-horizontal', label: 'Autre collaboration', sub: 'Services, presse ou divers' }
    ];

    function openPartnerPicker() {
        window.openBottomSheet("Type de partenaire", PARTNER_TYPES, (val, label) => {
            typeInput.value = val;
            typeLabel.innerText = label;
            
            const selected = PARTNER_TYPES.find(p => p.value === val);
            typeIcon.innerHTML = `<i data-lucide="${selected.icon}" style="width:18px;height:18px"></i>`;
            typeIcon.className = "h-10 w-10 bg-gold text-forest shadow-sm rounded-xl flex items-center justify-center";
            lucide.createIcons({ scope: typeIcon });
        });
    }
</script>
