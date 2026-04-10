<div class="min-h-screen bg-coacki-bg pt-10 pb-20">
    <div class="max-w-5xl mx-auto px-5 md:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-forest">Modifier l'article</h1>
                <p class="text-zinc-500 font-medium">Apportez vos corrections ici.</p>
            </div>
            <a href="<?= BASE_URL ?>/admin/news" class="px-4 py-2 bg-white border border-forest/10 rounded-xl text-forest text-xs font-black uppercase tracking-widest hover:bg-forest hover:text-white transition-all">
                Retour
            </a>
        </div>

        <form action="<?= BASE_URL ?>/admin/news/update/<?= $article['hash_id'] ?>" method="POST" enctype="multipart/form-data" class="bg-white rounded-[32px] md:rounded-[40px] p-6 md:p-10 shadow-xl border border-forest/5 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Titre *</label>
                    <input type="text" name="titre" required value="<?= htmlspecialchars($article['titre']) ?>" class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Catégorie *</label>
                    <select name="categorie" required class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                        <?php foreach(['Actualité','Récolte','Culture','Femmes','Infrastructure'] as $cat): ?>
                            <option value="<?= $cat ?>" <?= ($article['categorie'] === $cat) ? 'selected' : '' ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Image actuelle + nouvelle -->
            <div class="space-y-3">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Image de couverture</label>
                <div class="flex items-center gap-4">
                    <?php if($article['image_url']): ?>
                        <img src="<?= $article['image_url'] ?>" class="w-24 h-16 object-cover rounded-xl border border-forest/10 flex-shrink-0">
                    <?php endif; ?>
                    <input type="file" name="image" accept="image/*" class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none">
                </div>
                <p class="text-xs text-zinc-400 italic">Laisser vide pour conserver l'image actuelle.</p>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Extrait</label>
                <textarea name="extrait" rows="2" class="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-gold/30 outline-none resize-none"><?= htmlspecialchars($article['extrait']) ?></textarea>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Contenu complet *</label>
                <div class="border border-forest/10 rounded-2xl overflow-hidden">
                    <textarea id="myeditor" name="contenu"><?= $article['contenu'] ?></textarea>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <span id="draftStatus" class="text-[10px] font-black uppercase tracking-widest text-zinc-400"></span>
                <button type="submit" class="w-full md:w-auto bg-forest text-gold px-10 py-4 rounded-2xl font-black uppercase tracking-widest shadow-xl hover:bg-forest/90 transition-all flex items-center justify-center gap-2">
                    Enregistrer les modifications <i data-lucide="save" style="width:16px;height:16px"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/12wl5n1tvwwf39mualxml5x8w0n39m40uys2egu2jwue86mo/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#myeditor',
    plugins: ['anchor','autolink','charmap','codesample','emoticons','image','link','lists','media','searchreplace','table','visualblocks','wordcount'],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 500,
    menubar: false,
    content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; color: #4B5563; }',
    setup: function (editor) {
        editor.on('change keyup', function () {
            saveDraft();
        });
    }
  });

  // ─── LOGIQUE DE BROUILLON (AUTO-SAVE) ───
  const DRAFT_KEY = 'coacki_news_edit_draft_<?= $article["hash_id"] ?>';
  const statusEl = document.getElementById('draftStatus');
  const formStrInputs = ['input[name="titre"]', 'select[name="categorie"]', 'textarea[name="extrait"]'];

  function saveDraft() {
      const draft = {
          titre: document.querySelector('input[name="titre"]').value,
          categorie: document.querySelector('select[name="categorie"]').value,
          extrait: document.querySelector('textarea[name="extrait"]').value,
          contenu: tinymce.get('myeditor').getContent()
      };
      localStorage.setItem(DRAFT_KEY, JSON.stringify(draft));
      statusEl.innerHTML = '<i data-lucide="save" style="width:12px;height:12px;display:inline"></i> Modifications auto-enregistrées';
      if(window.lucide) lucide.createIcons();
  }

  function restoreDraft() {
      const saved = localStorage.getItem(DRAFT_KEY);
      if(saved) {
          try {
              const draft = JSON.parse(saved);
              window.customConfirm("Des modifications non enregistrées pour cet article ont été trouvées suite à une coupure. Voulez-vous les restaurer ?", () => {
                  if(draft.titre) document.querySelector('input[name="titre"]').value = draft.titre;
                  if(draft.categorie) document.querySelector('select[name="categorie"]').value = draft.categorie;
                  if(draft.extrait) document.querySelector('textarea[name="extrait"]').value = draft.extrait;
                  setTimeout(() => { if(draft.contenu) tinymce.get('myeditor').setContent(draft.contenu); }, 500);
                  statusEl.innerText = "Brouillon restauré.";
              });
          } catch(e) {}
      }
  }

  formStrInputs.forEach(selector => document.querySelector(selector).addEventListener('input', saveDraft));
  document.querySelector('form').addEventListener('submit', () => localStorage.removeItem(DRAFT_KEY));
  window.addEventListener('DOMContentLoaded', restoreDraft);
</script>
