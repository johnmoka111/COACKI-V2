    </main>

    <!-- ═══ FOOTER ADMIN ═══ -->
    <footer class="hidden md:block py-6 px-8 bg-zinc-50 border-t border-zinc-200/50 text-[10px] font-black text-zinc-400 uppercase tracking-widest text-center mt-auto">
        &copy; <?= date('Y') ?> COACKI - Pôle Administration. Construit sur demande.
    </footer>
</div> <!-- Fin du Wrapper Principal (ouvert dans admin_header.php) -->


<!-- TOAST & CONFIRM INJECTION -->
<div id="globalToast" class="fixed top-8 right-0 left-0 mx-auto w-[90%] md:w-auto md:right-10 md:left-auto md:max-w-sm bg-white/80 backdrop-blur-2xl rounded-[28px] shadow-[0_30px_90px_-20px_rgba(0,0,0,0.2)] border border-white/40 p-5 transform -translate-y-[180%] opacity-0 transition-all duration-[800ms] cubic-bezier-[0.23,1,0.32,1] z-[1000] flex items-center gap-5">
    <div id="toastIcon" class="h-14 w-14 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-emerald-500/10">
        <!-- Icon injected by JS -->
    </div>
    <div class="flex-1 pr-4">
        <h4 id="toastTitle" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 mb-0.5">Notification</h4>
        <p id="toastMessage" class="text-[13px] font-bold text-forest leading-tight"></p>
    </div>
</div>

<div id="globalConfirm" class="fixed inset-0 bg-forest/40 backdrop-blur-md z-[2000] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-500">
    <div class="bg-white/90 backdrop-blur-xl max-w-xs md:max-w-sm w-[90%] rounded-[48px] shadow-[0_40px_100px_-30px_rgba(0,0,0,0.3)] p-8 md:p-12 transform scale-90 transition-all duration-500 border border-white" id="confirmBox">
        <div class="h-20 w-20 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center mb-8 mx-auto rotate-12 shadow-inner">
            <i data-lucide="shield-alert" style="width:40px;height:40px"></i>
        </div>
        <h3 class="text-2xl font-black text-center text-forest mb-3 tracking-tighter">Confirmation requise</h3>
        <p id="confirmMessage" class="text-sm text-zinc-500 text-center font-medium mb-10 leading-relaxed"></p>
        <div class="flex flex-col gap-3">
            <button id="confirmOkBtn" class="w-full py-4 bg-red-500 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-red-600 shadow-xl shadow-red-500/20 active:scale-95 transition-all order-1">Oui, je confirme</button>
            <button id="confirmCancelBtn" class="w-full py-4 bg-zinc-100 text-zinc-500 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-zinc-200 active:scale-95 transition-all order-2">Annuler</button>
        </div>
    </div>
</div>

    <!-- BOTTOM SHEET GLOBAL CONTAINER -->
    <div id="globalBottomSheet" class="bottom-sheet">
        <div class="bottom-sheet-content">
            <div class="bottom-sheet-handle"></div>
            <h3 id="bsTitle" class="text-xl font-black text-forest mb-6 tracking-tighter text-center">Sélectionner une option</h3>
            <div id="bsOptions" class="space-y-2">
                <!-- Dynamically filled -->
            </div>
            <div class="h-10"></div>
        </div>
    </div>

<script>
    lucide.createIcons();

    // Système de Bottom Sheet
    const bsModal = document.getElementById('globalBottomSheet');
    const bsOptionsContainer = document.getElementById('bsOptions');
    const bsTitle = document.getElementById('bsTitle');

    window.openBottomSheet = function(title, options, onSelect) {
        bsTitle.innerText = title;
        bsOptionsContainer.innerHTML = '';
        
        options.forEach(opt => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = "w-full p-5 rounded-2xl flex items-center justify-between font-bold text-sm text-forest hover:bg-zinc-50 transition-all border border-transparent hover:border-zinc-100";
            btn.innerHTML = `
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-xl bg-zinc-50 flex items-center justify-center text-zinc-400">
                        <i data-lucide="${opt.icon || 'circle'}" style="width:18px;height:18px"></i>
                   </div>
                   <div class="text-left">
                        <div class="text-forest">${opt.label}</div>
                        ${opt.sub ? `<div class="text-[10px] uppercase font-black tracking-widest text-zinc-300 mt-0.5">${opt.sub}</div>` : ''}
                   </div>
                </div>
                <div id="check-${opt.value}" class="hidden h-6 w-6 rounded-full bg-emerald-500 text-white flex items-center justify-center">
                    <i data-lucide="check" style="width:14px;height:14px"></i>
                </div>
            `;
            
            btn.onclick = () => {
                onSelect(opt.value, opt.label);
                closeBottomSheet();
            };
            bsOptionsContainer.appendChild(btn);
        });

        lucide.createIcons({ scope: bsOptionsContainer });
        bsModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    function closeBottomSheet() {
        bsModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    bsModal.onclick = (e) => {
        if (e.target === bsModal) closeBottomSheet();
    };

    // Système Global de Toasts (Luxe)
    window.showToast = function(message, type = 'success') {
        const toast = document.getElementById('globalToast');
        const msgEl = document.getElementById('toastMessage');
        const titleEl = document.getElementById('toastTitle');
        const iconContainer = document.getElementById('toastIcon');
        
        msgEl.innerText = message;
        
        if (type === 'success') {
            titleEl.innerText = "Succès";
            titleEl.className = "text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500 mb-0.5";
            toast.style.borderLeft = "6px solid #10B981";
            iconContainer.className = "h-14 w-14 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-emerald-500/5";
            iconContainer.innerHTML = '<i data-lucide="check-circle-2" style="width:28px;height:28px"></i>';
        } else if (type === 'error') {
            titleEl.innerText = "Erreur";
            titleEl.className = "text-[10px] font-black uppercase tracking-[0.2em] text-red-500 mb-0.5";
            toast.style.borderLeft = "6px solid #EF4444";
            iconContainer.className = "h-14 w-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-red-500/5";
            iconContainer.innerHTML = '<i data-lucide="x-circle" style="width:28px;height:28px"></i>';
        }

        lucide.createIcons();
        toast.classList.remove('-translate-y-[180%]', 'opacity-0');
        setTimeout(() => toast.classList.add('-translate-y-[180%]', 'opacity-0'), 5000);
    };

    <?php if (isset($_SESSION['flash_success'])): ?>
        setTimeout(() => showToast(<?= json_encode($_SESSION['flash_success']) ?>, 'success'), 400);
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['flash_error'])): ?>
        setTimeout(() => showToast(<?= json_encode($_SESSION['flash_error']) ?>, 'error'), 400);
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    // Global Confirm Modal Logic
    window.customConfirm = function(message, callback) {
        const modal = document.getElementById('globalConfirm');
        const box = document.getElementById('confirmBox');
        document.getElementById('confirmMessage').innerText = message;
        
        modal.classList.remove('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-95');
        
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const okBtn = document.getElementById('confirmOkBtn');
        const close = () => {
            modal.classList.add('opacity-0', 'pointer-events-none');
            box.classList.add('scale-95');
        };
        
        const newCancelBtn = cancelBtn.cloneNode(true);
        const newOkBtn = okBtn.cloneNode(true);
        cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);
        okBtn.parentNode.replaceChild(newOkBtn, okBtn);
        
        newCancelBtn.onclick = close;
        newOkBtn.onclick = () => { close(); callback(); };
    };

    // Intercepteur Global de Confirmation (Remplace le confirm() natif)
    document.addEventListener('DOMContentLoaded', () => {
        // Intercepter tous les clics et soumissions qui utilisent return confirm()
        const handleIntercept = (e) => {
            const target = e.target.closest('[onclick*="confirm("], [onsubmit*="confirm("]');
            if (!target) return;

            const attr = target.hasAttribute('onclick') ? target.getAttribute('onclick') : target.getAttribute('onsubmit');
            const match = attr.match(/confirm\(['"]([^'"]+)['"]\)/);
            
            if (match) {
                e.preventDefault();
                e.stopImmediatePropagation();
                const message = match[1];
                
                window.customConfirm(message, () => {
                    // Supprimer temporairement l'attribut pour éviter une boucle
                    const originalAttr = attr;
                    const attrName = target.hasAttribute('onclick') ? 'onclick' : 'onsubmit';
                    
                    if (target.tagName.toLowerCase() === 'form') {
                        target.submit();
                    } else if (target.tagName.toLowerCase() === 'button' && target.type === 'submit') {
                        target.closest('form').submit();
                    } else if (target.href) {
                        window.location.href = target.href;
                    }
                });
            }
        };

        // On utilise le bubbling pour attraper les événements dynamiques
        document.addEventListener('click', handleIntercept, true);
        document.addEventListener('submit', handleIntercept, true);
    });

    // Masquer la navigation mobile lors du défilement vers le bas
    let lastScrollY = window.scrollY;
    const bottomNav = document.getElementById('mobileBottomNav');
    if (bottomNav) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > lastScrollY && window.scrollY > 50) {
                // Scroll down
                bottomNav.style.transform = 'translateY(100%)';
            } else {
                // Scroll up
                bottomNav.style.transform = 'translateY(0)';
            }
            lastScrollY = window.scrollY;
        }, { passive: true });
    }
</script>
</body>
</html>
