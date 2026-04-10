<div class="px-6 py-10 md:px-12 md:py-12 bg-coacki-bg min-h-screen">
    <div class="max-w-4xl mx-auto space-y-10">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">
                    <i data-lucide="pen-tool" style="width:12px;height:12px"></i> Editor Workspace
                </div>
                <h1 class="text-3xl font-black text-forest tracking-tighter">Rédiger un article</h1>
                <p class="text-sm font-bold text-zinc-400 tracking-tight">Composez un contenu riche pour engager votre communauté.</p>
            </div>
            
            <a href="<?= BASE_URL ?>/admin/news" class="h-10 px-5 bg-white border border-zinc-200 rounded-xl flex items-center justify-center gap-2 text-[10px] font-black uppercase tracking-widest text-zinc-500 hover:bg-zinc-50 transition-all">
                <i data-lucide="arrow-left" style="width:14px;height:14px"></i> Retour aux articles
            </a>
        </div>

        <!-- Main Form -->
        <form action="<?= BASE_URL ?>/admin/news/store" method="POST" enctype="multipart/form-data" class="space-y-8">
            
            <div class="bg-white rounded-[40px] p-8 md:p-12 shadow-2xl shadow-zinc-500/5 border border-zinc-100 space-y-10">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Titre -->
                    <div class="md:col-span-2 space-y-3">
                        <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Titre de la publication *</label>
                        <input type="text" name="titre" required placeholder="Saisissez un titre percutant..." 
                               class="w-full h-14 bg-zinc-50 border border-zinc-200 rounded-2xl px-6 text-sm font-bold text-forest focus:ring-2 focus:ring-forest/10 focus:border-forest outline-none transition-all placeholder:text-zinc-300">
                    </div>
                    <!-- Catégorie -->
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Catégorie *</label>
                        <select name="categorie" required class="w-full h-14 bg-zinc-50 border border-zinc-200 rounded-2xl px-6 text-[11px] font-black uppercase tracking-widest text-forest focus:ring-2 focus:ring-forest/10 focus:border-forest outline-none transition-all cursor-pointer">
                            <option value="Actualité">Actualité générale</option>
                            <option value="Récolte">Récolte & Terroir</option>
                            <option value="Culture">Culture Coop</option>
                            <option value="Femmes">Action des Femmes</option>
                            <option value="Infrastructure">Infrastructure</option>
                        </select>
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Image de couverture</label>
                    <div class="relative group">
                        <input type="file" name="image" accept="image/*" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="h-32 w-full bg-zinc-50 border-2 border-dashed border-zinc-200 rounded-[32px] flex flex-col items-center justify-center gap-2 group-hover:bg-zinc-100 group-hover:border-forest/20 transition-all overflow-hidden relative">
                             <div class="h-10 w-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-zinc-400 group-hover:text-forest transition-colors">
                                 <i data-lucide="image-plus" style="width:20px;height:20px"></i>
                             </div>
                             <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Glissez ou cliquez pour uploader</p>
                        </div>
                    </div>
                </div>

                <!-- Extrait / Chapeau -->
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Accroche (Sommaire court)</label>
                    <textarea name="extrait" rows="2" placeholder="Un court résumé qui sera mis en avant..." 
                              class="w-full bg-zinc-50 border border-zinc-200 rounded-2xl px-6 py-4 text-sm font-medium text-forest focus:ring-2 focus:ring-forest/10 focus:border-forest outline-none transition-all resize-none placeholder:text-zinc-300"></textarea>
                </div>

                <!-- Content Editor -->
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-forest uppercase tracking-[0.2em] ml-1">Production du contenu *</label>
                    <div class="border border-zinc-200 rounded-[32px] overflow-hidden bg-zinc-50 p-1">
                        <textarea id="myeditor" name="contenu"></textarea>
                    </div>
                </div>
            </div>

            <!-- Floating Form Footer -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 bg-white/80 backdrop-blur-xl border border-zinc-100 p-8 rounded-[40px] shadow-2xl shadow-zinc-500/10">
                <div id="draftStatus" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-zinc-400">
                    <span class="h-1.5 w-1.5 rounded-full bg-zinc-200"></span> 
                    En attente de rédaction
                </div>
                <button type="submit" class="w-full md:w-auto h-16 px-12 bg-forest text-gold rounded-2xl font-black uppercase tracking-[0.2em] shadow-2xl shadow-forest/30 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3 text-xs">
                    Publier maintenant <i data-lucide="send" style="width:18px;height:18px"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- TinyMCE Integration -->
<script src="https://cdn.tiny.cloud/1/12wl5n1tvwwf39mualxml5x8w0n39m40uys2egu2jwue86mo/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#myeditor',
    plugins: ['anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount'],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 500,
    menubar: false,
    content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; color: #1B4332; line-height: 1.6; }',
    border_width: 0,
    setup: function (editor) {
        editor.on('change keyup', function () {
            saveDraft();
        });
    }
  });

  const DRAFT_KEY = 'coacki_news_draft';
  const statusEl = document.getElementById('draftStatus');

  function saveDraft() {
      const draft = {
          titre: document.querySelector('input[name="titre"]').value,
          categorie: document.querySelector('select[name="categorie"]').value,
          extrait: document.querySelector('textarea[name="extrait"]').value,
          contenu: tinymce.get('myeditor').getContent()
      };
      localStorage.setItem(DRAFT_KEY, JSON.stringify(draft));
      statusEl.innerHTML = '<span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span> <span class="text-emerald-600">Brouillon sécurisé en local</span>';
  }

  function restoreDraft() {
      const saved = localStorage.getItem(DRAFT_KEY);
      if(saved) {
          try {
              const draft = JSON.parse(saved);
              if(draft.titre || draft.contenu || (draft.extrait && draft.extrait.length > 5)) {
                  window.customConfirm("Une version non publiée de cet article a été récupérée. Souhaitez-vous la restaurer ?", () => {
                      document.querySelector('input[name="titre"]').value = draft.titre || '';
                      document.querySelector('select[name="categorie"]').value = draft.categorie || 'Actualité';
                      document.querySelector('textarea[name="extrait"]').value = draft.extrait || '';
                      setTimeout(() => { 
                          if(draft.contenu) tinymce.get('myeditor').setContent(draft.contenu);
                          statusEl.innerHTML = '<span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span> <span class="text-blue-600">Brouillon restauré</span>';
                      }, 1000);
                  });
              }
          } catch(e) {}
      }
  }

  document.querySelectorAll('input, select, textarea').forEach(el => {
      if(el.name !== 'image' && el.id !== 'myeditor') el.addEventListener('input', saveDraft);
  });
  
  document.querySelector('form').addEventListener('submit', () => localStorage.removeItem(DRAFT_KEY));
  window.addEventListener('DOMContentLoaded', restoreDraft);
</script>

