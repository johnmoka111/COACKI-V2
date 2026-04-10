<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<section class="py-20 bg-coacki-bg">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        <!-- Header -->
        <div class="text-center space-y-4 max-w-3xl mx-auto">
            <h4 class="text-gold font-black uppercase text-xs tracking-[0.4em]">Terroir Munanira</h4>
            <h1 class="text-5xl md:text-7xl font-black text-forest tracking-tighter">Ancrage Local à <span class="text-gold">Kalehe</span></h1>
            <p class="text-zinc-500 font-medium">Explorez notre terroir et la localisation précise de nos infrastructures.</p>
        </div>

        <!-- Map Container -->
        <div class="relative">
            <div id="map" class="h-[500px] md:h-[700px] w-full rounded-[40px] border-[8px] md:border-[16px] border-white shadow-2xl z-10"></div>
            
            <!-- Informations Overlay (Mobile-Friendly) -->
            <div class="absolute bottom-6 left-6 right-6 md:right-auto md:w-80 p-6 bg-white/90 backdrop-blur-xl rounded-3xl border border-forest/10 shadow-2xl z-20 group hover:bg-forest transition-all duration-500">
                <h4 class="font-black text-forest mb-4 group-hover:text-gold transition-colors">Légende</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-sm font-bold text-zinc-500 group-hover:text-white transition-colors">
                        <div class="h-4 w-4 bg-gold rounded-full ring-4 ring-gold/20"></div> Station de Lavage
                    </div>
                    <div class="flex items-center gap-3 text-sm font-bold text-zinc-500 group-hover:text-white transition-colors">
                        <div class="h-4 w-4 bg-forest rounded-full ring-4 ring-forest/20"></div> Parcelles Membres
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grille -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-10 bg-white rounded-[32px] border border-forest/5 shadow-sm">
                <h3 class="text-xl font-black text-forest mb-3">Altitude</h3>
                <p class="text-zinc-500 text-sm font-medium leading-relaxed">Situé entre 1491m et 2000m d'altitude pour une maturation lente.</p>
            </div>
            <div class="p-10 bg-white rounded-[32px] border border-forest/5 shadow-sm">
                <h3 class="text-xl font-black text-forest mb-3">Sol</h3>
                <p class="text-zinc-500 text-sm font-medium leading-relaxed">Terres volcaniques fertiles du Sud-Kivu, riches en minéraux essentiels.</p>
            </div>
            <div class="p-10 bg-white rounded-[32px] border border-forest/5 shadow-sm">
                <h3 class="text-xl font-black text-forest mb-3">Micro-climat</h3>
                <p class="text-zinc-500 text-sm font-medium leading-relaxed">Régulation naturelle thermique par la proximité du Lac Kivu.</p>
            </div>
        </div>
    </div>
</section>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Initialisation de la carte (Centrée sur Kalehe/Munanira)
    const map = L.map('map', {
        center: [-2.041538, 28.970495],
        zoom: 14,
        zoomControl: false,
        scrollWheelZoom: false
    });

    // Style de la carte (Basé sur CartoDB Positron pour un look épuré)
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; COACKI'
    }).addTo(map);

    // Ajout du contrôle de zoom en bas à droite
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    // Données des stations (injected from PHP)
    const stations = <?= json_encode($stations) ?>;
    const parcelles = <?= json_encode($parcelles) ?>;

    // Icône personnalisée pour les stations
    const stationIcon = L.divIcon({
        className: 'custom-div-icon',
        html: `<div class="h-8 w-8 bg-gold rounded-full border-4 border-white shadow-lg flex items-center justify-center text-forest"><i data-lucide="building-2" style="width:14px;height:14px"></i></div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 32]
    });

    // Icône pour les parcelles
    const parcelleIcon = L.divIcon({
        className: 'custom-div-icon',
        html: `<div class="h-4 w-4 bg-forest rounded-full border-2 border-white shadow-md"></div>`,
        iconSize: [16, 16],
        iconAnchor: [8, 8]
    });

    // Affichage des stations
    stations.forEach(s => {
        L.marker([s.latitude, s.longitude], {icon: stationIcon})
            .addTo(map)
            .bindPopup(`<div class="p-2 font-sans"><b class="text-forest">${s.nom}</b><br><span class="text-xs text-zinc-500">${s.localisation}</span></div>`);
    });

    // Affichage des parcelles
    parcelles.forEach(p => {
        L.marker([p.latitude, p.longitude], {icon: parcelleIcon})
            .addTo(map)
            .bindPopup(`<div class="p-2 font-sans"><b class="text-forest">Parcelle: ${p.producteur}</b><br><span class="text-xs text-zinc-500">${p.nb_pieds} pieds • ${p.altitude}m</span></div>`);
    });

    // Ré-initialisation de Lucide pour les icônes dans la carte
    setTimeout(() => { lucide.createIcons(); }, 100);
</script>

<style>
    .leaflet-popup-content-wrapper { border-radius: 20px; padding: 5px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .custom-div-icon { background: none; border: none; }
</style>
