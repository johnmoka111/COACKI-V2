</main>

<?php 
$currentUrl = trim($_GET['url'] ?? '', '/'); 
$isLoginPage = ($currentUrl === 'login');
?>

<?php if (!$isLoginPage): ?>
<!-- ═══ NAV MOBILE BOTTOM (Mobile First) ═══ -->
<nav class="md:hidden fixed bottom-0 left-0 w-full z-50 bg-white/95 backdrop-blur-2xl border-t border-forest/10 pb-[env(safe-area-inset-bottom)] shadow-[0_-10px_40px_rgba(0,0,0,0.05)] overflow-x-auto no-scrollbar">
    <div class="flex items-center min-w-[320px] w-full h-20 px-2 justify-between">
        <a href="<?= BASE_URL ?>/" class="flex-1 flex flex-col items-center gap-1.5 <?= ($currentUrl === '' || $currentUrl === 'home') ? 'text-gold' : 'text-forest/60' ?> hover:text-gold transition-colors">
            <i data-lucide="home" style="width:20px;height:20px"></i>
            <span class="text-[9px] font-black uppercase tracking-tighter">Accueil</span>
        </a>
        <a href="<?= BASE_URL ?>/actualites" class="flex-1 flex flex-col items-center gap-1.5 <?= ($currentUrl === 'actualites') ? 'text-gold' : 'text-forest/60' ?> hover:text-gold transition-colors">
            <i data-lucide="newspaper" style="width:20px;height:20px"></i>
            <span class="text-[9px] font-black uppercase tracking-tighter">News</span>
        </a>
        <a href="<?= BASE_URL ?>/galerie" class="flex-1 flex flex-col items-center gap-1.5 <?= ($currentUrl === 'galerie') ? 'text-gold' : 'text-forest/60' ?> hover:text-gold transition-colors">
            <i data-lucide="image" style="width:20px;height:20px"></i>
            <span class="text-[9px] font-black uppercase tracking-tighter">Galerie</span>
        </a>
        <a href="<?= BASE_URL ?>/partenaire" class="flex-1 flex flex-col items-center gap-1.5 <?= ($currentUrl === 'partenaire') ? 'text-gold' : 'text-forest/60' ?> hover:text-gold transition-colors">
            <i data-lucide="handshake" style="width:20px;height:20px"></i>
            <span class="text-[9px] font-black uppercase tracking-tighter">S'allier</span>
        </a>
    </div>
</nav>

<!-- ═══ FOOTER DESKTOP ═══ -->
<footer class="bg-forest text-white py-20 px-6 border-t border-gold/10 hidden md:block">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        <!-- Logo & Présentation -->
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <img src="<?= BASE_URL ?>/logo.png" alt="Logo" class="h-10 w-auto object-contain brightness-0 invert">
                <span class="font-black text-2xl tracking-tighter">COACKI</span>
            </div>
            <p class="text-white/60 text-sm leading-relaxed">
                Cultiver l'excellence au cœur du Sud-Kivu, de la cerise à la tasse.
            </p>
        </div>
        
        <!-- Liens rapides -->
        <div>
            <h4 class="font-black mb-6 uppercase tracking-widest text-[11px] text-gold">Navigation</h4>
            <ul class="space-y-4 text-sm text-white/60 font-medium tracking-wide">
                <li><a href="<?= BASE_URL ?>/" class="hover:text-white transition-colors">Accueil</a></li>
                <li><a href="<?= BASE_URL ?>/actualites" class="hover:text-white transition-colors">Actualités</a></li>
                <li><a href="<?= BASE_URL ?>/carte" class="hover:text-white transition-colors">Carte & Terroir</a></li>
                <li><a href="<?= BASE_URL ?>/galerie" class="hover:text-white transition-colors">Galerie</a></li>
            </ul>
        </div>
        
        <!-- Contact & Siège -->
        <div>
            <h4 class="font-black mb-6 uppercase tracking-widest text-[11px] text-gold">Siège Social</h4>
            <ul class="space-y-4 text-sm text-white/60 font-medium tracking-wide">
                <li><i data-lucide="map-pin" class="inline w-4 h-4 mr-2"></i> Munanira, Mbinga-Sud, Kalehe</li>
                <li>Sud-Kivu, RDC</li>
                <li><i data-lucide="mail" class="inline w-4 h-4 mr-2"></i> coopcoacki.2022@gmail.com</li>
                <li><i data-lucide="phone" class="inline w-4 h-4 mr-2"></i> +243 997 385 989</li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h4 class="font-black mb-6 uppercase tracking-widest text-[11px] text-gold">Suivez-nous</h4>
            <p class="text-[11px] text-white/60 mb-4 leading-relaxed">
                Abonnez-vous pour recevoir les dernières actualités agricoles au Sud-Kivu.
            </p>
            <form id="newsletterForm" class="flex flex-col gap-2">
                <input type="email" id="nlEmail" placeholder="votre@email.com" required
                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs focus:ring-1 focus:ring-gold outline-none text-white transition-all">
                <button type="submit" class="w-full bg-gold text-forest py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-white transition-all flex items-center justify-center gap-2">
                    M'abonner <i data-lucide="bell-ring" style="width:14px;height:14px"></i>
                </button>
            </form>
            <div id="nlResult" class="mt-2 text-[10px] font-black uppercase tracking-tighter"></div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto pt-16 mt-16 border-t border-white/5 text-center text-white/40 text-[10px] font-black uppercase tracking-widest">
        &copy; <?= date('Y') ?> COACKI - Coopérative Agricole du Kivu. Tous droits réservés.
    </div>
</footer>

<!-- Popup Newsletter Automatique -->
<div id="nlPopup" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 w-[90%] md:w-[380px] bg-white rounded-3xl shadow-2xl border border-forest/10 p-6 transform translate-y-[150%] opacity-0 pointer-events-none transition-all duration-700 z-50">
    <button onclick="closeNlPopup()" class="absolute top-4 right-4 h-8 w-8 bg-zinc-50 hover:bg-zinc-100 flex items-center justify-center rounded-full text-zinc-400 hover:text-red-500 transition-colors">
        <i data-lucide="x" style="width:14px;height:14px"></i>
    </button>
    
    <div class="flex items-center gap-4 mb-4">
        <div class="h-12 w-12 bg-gold/10 text-gold rounded-full flex items-center justify-center flex-shrink-0 shadow-inner">
            <i data-lucide="megaphone" style="width:20px;height:20px"></i>
        </div>
        <div>
            <h3 class="font-black text-forest text-sm uppercase tracking-widest">Ne ratez rien !</h3>
            <p class="text-[11px] text-zinc-500 font-medium leading-tight">Recevez nos dernières actus COACKI sans plus attendre.</p>
        </div>
    </div>
    
    <form id="popupNewsletterForm" class="flex flex-col gap-2 mt-4">
        <input type="email" id="popupNlEmail" placeholder="votre@email.com" required
               class="w-full bg-zinc-50 border border-zinc-200 rounded-xl px-4 py-3 text-xs focus:ring-1 focus:ring-gold outline-none text-forest transition-all">
        <button type="submit" class="w-full bg-forest text-gold py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gold hover:text-forest transition-all flex items-center justify-center gap-2">
            S'abonner instantanément <i data-lucide="send-to-back" style="width:14px;height:14px"></i>
        </button>
    </form>
    <div id="popupNlResult" class="mt-2 text-[10px] font-black uppercase tracking-tighter text-center h-4"></div>
</div>
<?php endif; ?>

<!-- TOAST & CONFIRM INJECTION -->
<div id="globalToast" class="fixed top-8 right-0 left-0 mx-auto w-[90%] md:w-auto md:right-10 md:left-auto md:max-w-sm bg-white/80 backdrop-blur-2xl rounded-[28px] shadow-[0_30px_90px_-20px_rgba(0,0,0,0.2)] border border-white/40 p-5 transform -translate-y-[180%] opacity-0 transition-all duration-[800ms] cubic-bezier-[0.23,1,0.32,1] z-[1000] flex items-center gap-5">
    <div id="toastIcon" class="h-14 w-14 rounded-2xl flex items-center justify-center flex-shrink-0">
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
        <div id="bsOptions" class="space-y-4">
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
            btn.className = "w-full p-6 rounded-3xl flex items-center justify-between font-bold text-sm text-forest hover:bg-zinc-50 transition-all border border-transparent hover:border-zinc-100 bg-zinc-50/50";
            btn.innerHTML = `
                <div class="flex items-center gap-5">
                    <div class="h-12 w-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-zinc-400">
                        <i data-lucide="${opt.icon || 'circle'}" style="width:20px;height:20px"></i>
                   </div>
                   <div class="text-left">
                        <div class="text-forest text-base font-black tracking-tight">${opt.label}</div>
                        ${opt.sub ? `<div class="text-[10px] uppercase font-black tracking-[0.1em] text-zinc-400 mt-1 line-clamp-1">${opt.sub}</div>` : ''}
                   </div>
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

    // Global Confirm Logic (Remplace le confirm() natif)
    window.customConfirm = function(message, callback) {
        const modal = document.getElementById('globalConfirm');
        const box = document.getElementById('confirmBox');
        document.getElementById('confirmMessage').innerText = message;
        
        modal.classList.remove('opacity-0', 'pointer-events-none');
        box.classList.remove('scale-90');
        
        const okBtn = document.getElementById('confirmOkBtn');
        const cancelBtn = document.getElementById('confirmCancelBtn');
        const close = () => {
            modal.classList.add('opacity-0', 'pointer-events-none');
            box.classList.add('scale-90');
        };
        
        const newOkBtn = okBtn.cloneNode(true);
        const newCancelBtn = cancelBtn.cloneNode(true);
        okBtn.parentNode.replaceChild(newOkBtn, okBtn);
        cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);
        
        newCancelBtn.onclick = close;
        newOkBtn.onclick = () => { close(); callback(); };
    };

    // Intercepteur Global de Confirmation
    document.addEventListener('DOMContentLoaded', () => {
        const handleIntercept = (e) => {
            const target = e.target.closest('[onclick*="confirm("], [onsubmit*="confirm("]');
            if (!target) return;

            const attr = target.hasAttribute('onclick') ? target.getAttribute('onclick') : target.getAttribute('onsubmit');
            const match = attr.match(/confirm\(['"]([^'"]+)['"]\)/);
            
            if (match) {
                e.preventDefault();
                e.stopImmediatePropagation();
                window.customConfirm(match[1], () => {
                    if (target.tagName.toLowerCase() === 'form') target.submit();
                    else if (target.tagName.toLowerCase() === 'button' && target.type === 'submit') target.closest('form').submit();
                    else if (target.href) window.location.href = target.href;
                });
            }
        };
        document.addEventListener('click', handleIntercept, true);
        document.addEventListener('submit', handleIntercept, true);
    });

    // Gestion Newsletter
    const handleNewsletter = async (formId, emailId, resultId) => {
        const form = document.getElementById(formId);
        if (!form) return;
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById(emailId).value;
            const res = document.getElementById(resultId);
            res.innerText = "Traitement...";

            try {
                const response = await fetch('<?= BASE_URL ?>/newsletter/subscribe', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'email=' + encodeURIComponent(email)
                });
                const data = await response.json();
                if (data.status === 'success') {
                    showToast("Merci pour votre abonnement !");
                    document.getElementById(emailId).value = "";
                    res.innerText = "";
                    if (formId === 'popupNewsletterForm') closeNlPopup();
                } else {
                    res.innerText = data.message;
                    res.classList.add('text-red-500');
                }
            } catch (e) {
                res.innerText = "Erreur de connexion.";
            }
        });
    };
    handleNewsletter('newsletterForm', 'nlEmail', 'nlResult');
    handleNewsletter('popupNewsletterForm', 'popupNlEmail', 'popupNlResult');

    // Popup Newsletter Logic
    setTimeout(() => {
        if (!localStorage.getItem('coacki_newsletter_seen')) {
            const popup = document.getElementById('nlPopup');
            popup?.classList.remove('translate-y-[150%]', 'opacity-0', 'pointer-events-none');
            lucide.createIcons();
        }
    }, 5000);

    window.closeNlPopup = function() {
        document.getElementById('nlPopup')?.classList.add('translate-y-[150%]', 'opacity-0', 'pointer-events-none');
        localStorage.setItem('coacki_newsletter_seen', 'true');
    };
</script>
</body>
</html>
