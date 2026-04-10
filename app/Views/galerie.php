<section class="py-12 md:py-20 bg-coacki-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-5 md:px-8 space-y-12">
        <div class="text-center space-y-4 max-w-2xl mx-auto">
            <h4 class="text-gold font-black uppercase text-[10px] md:text-xs tracking-[0.4em]">Notre Histoire en Images</h4>
            <h1 class="text-4xl md:text-6xl font-black text-forest tracking-tighter">Galerie <span class="text-gold italic">COACKI</span></h1>
            <p class="text-zinc-500 font-medium text-sm md:text-base">Découvrez le travail quotidien de nos membres et la beauté du terroir de Kalehe.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($items as $item): ?>
                <div class="gallery-item group relative rounded-3xl overflow-hidden aspect-[4/5] bg-zinc-200 cursor-pointer shadow-sm hover:shadow-2xl transition-all"
                     data-url="<?= htmlspecialchars($item['url']) ?>" 
                     data-titre="<?= htmlspecialchars($item['titre'] ?? 'Galerie photo') ?>"
                     data-description="<?= htmlspecialchars($item['description'] ?? 'Aucune description disponible.') ?>"
                     data-categorie="<?= htmlspecialchars($item['categorie'] ?? '') ?>">
                     
                    <img src="<?= htmlspecialchars($item['url']) ?>" alt="<?= htmlspecialchars($item['titre'] ?? '') ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-forest/90 via-forest/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="absolute inset-x-0 bottom-0 p-6 flex flex-col justify-end h-full">
                        <span class="inline-block px-3 py-1 bg-white text-forest rounded-full text-[9px] font-black uppercase tracking-widest w-max mb-3 shadow-lg">
                            <?= htmlspecialchars($item['categorie'] ?? '') ?>
                        </span>
                        <h3 class="text-xl font-black text-white leading-tight drop-shadow-md">
                            <?= htmlspecialchars($item['titre'] ?? '') ?>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Modal Galerie -->
<div id="galleryModal" class="fixed inset-0 z-[100] bg-forest/95 backdrop-blur-xl hidden flex-col items-center justify-center opacity-0 transition-opacity duration-300">
    <button id="closeModal" class="absolute top-6 right-6 md:top-10 md:right-10 h-12 w-12 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-gold transition-colors">
        <i data-lucide="x" style="width:24px;height:24px"></i>
    </button>
    
    <div class="w-full max-w-5xl px-5 flex flex-col items-center">
        <img id="modalImage" src="" alt="" class="max-h-[60vh] md:max-h-[75vh] w-auto max-w-full rounded-2xl shadow-2xl object-contain mb-8">
        <div class="text-center space-y-4 max-w-2xl">
            <span id="modalCategory" class="px-4 py-1.5 bg-gold text-forest rounded-full text-[10px] font-black uppercase tracking-widest"></span>
            <h2 id="modalTitle" class="text-3xl md:text-5xl font-black text-white tracking-tighter"></h2>
            <p id="modalDescription" class="text-white/70 font-medium text-sm md:text-base leading-relaxed"></p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('galleryModal');
        const modalImg = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalCat = document.getElementById('modalCategory');
        const modalDesc = document.getElementById('modalDescription');
        const closeBtn = document.getElementById('closeModal');

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', () => {
                modalImg.src = item.dataset.url;
                modalTitle.textContent = item.dataset.titre;
                modalCat.textContent = item.dataset.categorie;
                modalDesc.textContent = item.dataset.description;
                
                modal.classList.remove('hidden');
                // Timeout to trigger transition
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                }, 10);
            });
        });

        const hideModal = () => {
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        };

        closeBtn.addEventListener('click', hideModal);
        modal.addEventListener('click', (e) => {
            if(e.target === modal) hideModal();
        });
    });
</script>
