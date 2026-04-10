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
