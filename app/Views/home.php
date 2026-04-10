<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center overflow-hidden">
    <!-- Image de fond avec overlay -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-forest via-forest/80 to-transparent z-10"></div>
        <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?q=80&w=2078&auto=format&fit=crop" 
             alt="Café du Kivu" 
             class="w-full h-full object-cover">
    </div>
    
    <div class="relative z-20 max-w-7xl mx-auto px-6 w-full py-20">
        <div class="max-w-2xl space-y-8 animate-in fade-in slide-in-from-left duration-1000">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-gold/20 border border-gold/30 rounded-full text-gold font-bold text-[10px] uppercase tracking-widest backdrop-blur-sm">
                <i data-lucide="award" class="h-4 w-4"></i> Qualité Premium Bourbon
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-white leading-[1.05] tracking-tighter">
                Le café est <br> <span class="text-gold italic">notre vie</span>.
            </h1>
            
            <p class="text-lg md:text-xl text-white/80 leading-relaxed font-medium">
                Né en 2022 de la volonté de 10 membres fondateurs à <span class="text-white font-bold">Mbinga-Sud</span>, COACKI cultive l'excellence au cœur du Sud-Kivu.
            </p>
            
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="<?= BASE_URL ?>/galerie" class="bg-gold text-forest px-8 py-4 rounded-full font-black flex items-center gap-2 hover:bg-white transition-all shadow-xl shadow-black/20 group">
                    Découvrir nos récoltes <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform"></i>
                </a>
                <div class="flex -space-x-3 items-center">
                    <div class="h-10 w-10 rounded-full border-2 border-forest bg-zinc-200"></div>
                    <div class="h-10 w-10 rounded-full border-2 border-forest bg-zinc-300"></div>
                    <div class="h-10 w-10 rounded-full border-2 border-forest bg-zinc-400"></div>
                    <span class="ml-4 text-white/60 text-xs font-bold tracking-tight">+276 Membres Engagés</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Stats Mobile-First -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="p-6 bg-coacki-bg rounded-3xl border border-forest/5 text-center">
            <div class="text-3xl font-black text-forest">85+</div>
            <div class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Score Qualité</div>
        </div>
        <div class="p-6 bg-coacki-bg rounded-3xl border border-forest/5 text-center">
            <div class="text-3xl font-black text-forest">2022</div>
            <div class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Fondation</div>
        </div>
        <div class="p-6 bg-coacki-bg rounded-3xl border border-forest/5 text-center">
            <div class="text-3xl font-black text-forest">276</div>
            <div class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Membres</div>
        </div>
        <div class="p-6 bg-coacki-bg rounded-3xl border border-forest/5 text-center">
            <div class="text-3xl font-black text-forest">1491m</div>
            <div class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Altitude Min</div>
        </div>
    </div>
</section>

<!-- Section Historique Premium -->
<section class="py-24 bg-coacki-bg relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-gold/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-forest/5 rounded-full blur-3xl -ml-32 -mb-32"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- Left side: Sticky Header -->
            <div class="lg:col-span-4 space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-forest/5 rounded-full text-forest font-black text-[10px] uppercase tracking-[0.2em]">
                    <i data-lucide="history" class="h-4 w-4"></i> Notre Origine
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-forest tracking-tighter leading-tight">
                    L'héritage de <br><span class="text-gold italic">Mbinga-Sud</span>
                </h2>
                <div class="h-1 w-20 bg-gold rounded-full"></div>
                <p class="text-sm text-zinc-500 font-medium leading-relaxed">
                    Découvrez comment 10 visionnaires ont transformé le paysage caféier de Kalehe pour créer une coopérative d'exception.
                </p>
                
                <!-- Quick Numbers -->
                <div class="pt-6 space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-forest/5">
                        <div class="h-10 w-10 bg-gold/10 text-gold rounded-xl flex items-center justify-center">
                            <i data-lucide="users" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <div class="text-xs font-black text-forest">10 Fondateurs</div>
                            <div class="text-[10px] text-zinc-400 font-bold uppercase">Membres Pionniers</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-forest/5">
                        <div class="h-10 w-10 bg-forest/10 text-forest rounded-xl flex items-center justify-center">
                            <i data-lucide="map" class="h-5 w-5"></i>
                        </div>
                        <div>
                            <div class="text-xs font-black text-forest">Kalehe, Sud-Kivu</div>
                            <div class="text-[10px] text-zinc-400 font-bold uppercase">Province d'origine</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side: History Text -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[40px] p-8 md:p-12 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] border border-forest/5">
                    <div class="prose prose-forest max-w-none space-y-8">
                        <div class="flex gap-6 items-start">
                            <span class="text-4xl font-black text-gold/20 select-none">01</span>
                            <p class="text-forest/80 text-lg md:text-xl font-medium leading-relaxed">
                                La Coopérative des Agriculteurs de Café du Kivu (COACKI) a été créée en 2022 par <strong class="text-forest">10 membres fondateurs</strong>, tous producteurs de café du groupement de Mbinga-Sud dans le territoire de Kalehe.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-8 border-y border-forest/5">
                            <div class="space-y-4">
                                <div class="flex items-center gap-3 text-forest">
                                    <i data-lucide="leaf" class="h-5 w-5 text-gold"></i>
                                    <span class="font-black text-xs uppercase tracking-widest">Culture & Volume</span>
                                </div>
                                <p class="text-sm text-zinc-500 leading-relaxed font-medium">
                                    La coopérative gère actuellement <strong class="text-forest">451 champs</strong> totalisant environ 281 hectares, dont 128,4 hectares dédiés au café avec <strong class="text-forest font-black">321 002 pieds de caféiers</strong>.
                                </p>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3 text-forest">
                                    <i data-lucide="shield-check" class="h-5 w-5 text-gold"></i>
                                    <span class="font-black text-xs uppercase tracking-widest">Certification</span>
                                </div>
                                <p class="text-sm text-zinc-500 leading-relaxed font-medium">
                                    Nous sommes engagés dans le processus de <strong class="text-forest">certification Biologique</strong> suivant les standards internationaux <strong class="text-gold capitalize">EOS, NOP et BRA</strong>.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="flex gap-4 items-start bg-forest/[0.02] p-6 rounded-3xl border border-forest/5">
                                <i data-lucide="settings-2" class="h-6 w-6 text-gold flex-shrink-0 mt-1"></i>
                                <p class="text-sm text-forest/70 leading-relaxed font-medium">
                                    La COACKI est l’une des rares coopératives de la région à avoir construit, sans aide extérieure, sa propre <strong class="text-forest">station de lavage</strong> grâce aux cotisations directes de ses membres fondateurs.
                                </p>
                            </div>

                            <p class="text-sm text-zinc-500 leading-relaxed font-medium">
                                En faisant de la <strong class="text-forest">bonne gouvernance</strong> le pilier central de sa gestion, la COACKI participe activement au développement de la communauté. L'honnêteté est notre marque de fabrique : les bénéfices issus des ventes sont redistribués pour offrir un <strong class="text-gold font-black">prix plus élevé</strong> aux producteurs.
                            </p>
                        </div>

                        <div class="flex items-center justify-between pt-10">
                            <div class="flex items-center gap-4">
                                <div class="flex -space-x-3">
                                    <div class="h-10 w-10 rounded-full bg-pink-100 border-2 border-white flex items-center justify-center text-[10px] font-black text-pink-500">94F</div>
                                    <div class="h-10 w-10 rounded-full bg-blue-100 border-2 border-white flex items-center justify-center text-[10px] font-black text-blue-500">182H</div>
                                </div>
                                <span class="text-xs font-black text-forest">276 Membres Actuels</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-black text-forest">802 Tons</span>
                                <span class="block text-[9px] font-bold text-zinc-400 uppercase tracking-widest">Capacité de production</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
