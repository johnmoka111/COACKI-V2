"use client";

import { useState, useEffect } from "react";
import dynamic from "next/dynamic";
import { Coffee, MapPin, Trees, Building2, Wind, Info, X, Search, Bell, Settings, User, Plus, Filter, MoreVertical, LayoutDashboard, Menu, Download, FileText, Camera, Trash2, Edit2 } from "lucide-react";
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";

// Dynamically import the Map component to avoid SSR issues with Leaflet
const Map = dynamic(() => import("@/components/Map"), {
  ssr: false,
  loading: () => (
    <div className="h-full w-full bg-zinc-100 dark:bg-zinc-900 animate-pulse rounded-2xl flex items-center justify-center">
      <div className="flex flex-col items-center gap-4">
        <MapPin className="h-8 w-8 text-zinc-400 animate-bounce" />
        <span className="text-zinc-500 font-medium tracking-tight">Synchronisation...</span>
      </div>
    </div>
  ),
});

interface GalleryItem {
    id: string;
    url: string;
    title: string;
    description: string;
    category: string;
}

interface Stats {
    totalParcelles: number;
    totalStations: number;
    totalPieds: number;
}

export default function Home() {
  const [stats, setStats] = useState<Stats>({ totalParcelles: 0, totalStations: 0, totalPieds: 0 });
  const [locations, setLocations] = useState<any[]>([]);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [activeTab, setActiveTab ] = useState("dashboard");
  const [isSidebarOpen, setIsSidebarOpen] = useState(false);
  const [activeLocation, setActiveLocation] = useState<[number, number] | null>(null);
  const [modalType, setModalType] = useState<"parcelle" | "station" | "gallery">("parcelle");
  const [galleryItems, setGalleryItems] = useState<GalleryItem[]>([]);
  const [editingItem, setEditingItem] = useState<GalleryItem | null>(null);

  const exportToPDF = () => {
    const doc = new jsPDF();
    const tableData = locations
      .filter(f => f.properties.type === "parcelle")
      .map(f => [
        f.properties.producer,
        f.properties.groupement || "Mbinga-Sud",
        f.properties.nbPieds.toString(),
        `${f.properties.altitude}m`,
        `${f.geometry.coordinates[1].toFixed(4)}, ${f.geometry.coordinates[0].toFixed(4)}`
      ]);

    doc.setFontSize(20);
    doc.text("Registre des Parcelles COACKI", 14, 22);
    doc.setFontSize(11);
    doc.setTextColor(100);
    doc.text(`Généré le: ${new Date().toLocaleDateString()}`, 14, 30);

    autoTable(doc, {
      startY: 40,
      head: [["Producteur", "Groupement", "Pieds", "Altitude", "Coordonnées"]],
      body: tableData,
      theme: "striped",
      headStyles: { fillColor: [13, 27, 42] },
    });

    doc.save("registre-parcelles-coacki.pdf");
  };

  const deleteParcelle = async (id: string) => {
    if (!confirm("Voulez-vous vraiment supprimer cette parcelle ? Cette action est irréversible.")) return;
    try {
        const res = await fetch(`/api/parcelles/${id}`, { method: "DELETE" });
        if (res.ok) window.location.reload();
    } catch (err) { console.error(err); }
  };

  const deleteGalleryItem = async (id: string) => {
    if (!confirm("Voulez-vous vraiment supprimer cette image ?")) return;
    try {
        const res = await fetch(`/api/gallery/${id}`, { method: "DELETE" });
        if (res.ok) fetchGallery();
    } catch (err) { console.error(err); }
  };

  const fetchGallery = () => {
    fetch("/api/gallery")
        .then(res => res.json())
        .then(setGalleryItems);
  };

  useEffect(() => {
    fetch("/api/locations")
        .then(res => res.json())
        .then(data => {
            const parcelles = data.features.filter((f: any) => f.properties.type === "parcelle");
            const stations = data.features.filter((f: any) => f.properties.type === "station");
            const totalPieds = parcelles.reduce((acc: number, f: any) => acc + (f.properties.nbPieds || 0), 0);
            
            setLocations(data.features);
            setStats({
                totalParcelles: parcelles.length,
                totalStations: stations.length,
                totalPieds
            });
        });
    fetchGallery();
  }, []);

  return (
    <div className="flex h-screen bg-[#f7f8fa] dark:bg-black overflow-hidden font-sans text-zinc-900 dark:text-zinc-100">
      {/* Sidebar - Rocker Style */}
      <aside className={`fixed lg:relative inset-y-0 left-0 z-50 w-64 bg-[#0d1b2a] text-zinc-400 flex flex-col transition-transform duration-300 transform ${isSidebarOpen ? "translate-x-0" : "-translate-x-full lg:translate-x-0"}`}>
        <div className="h-20 flex items-center justify-between px-6 border-b border-white/10">
            <div className="flex items-center gap-3">
                <div className="h-9 w-9 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-600/20">
                    <Coffee className="text-white h-5 w-5" />
                </div>
                <span className="font-black text-xl tracking-tighter text-white uppercase italic">Coacki</span>
            </div>
            <button onClick={() => setIsSidebarOpen(false)} className="lg:hidden p-2 hover:bg-white/10 rounded-lg transition-colors">
                <X className="h-5 w-5" />
            </button>
        </div>

        <div className="flex-1 overflow-y-auto py-6 px-4 space-y-8">
            <div className="space-y-1">
                <p className="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 px-4 mb-4">Menu Principal</p>
                {[
                    { id: "dashboard", icon: LayoutDashboard, label: "Vue d'ensemble" },
                    { id: "parcelles", icon: Trees, label: "Parcelles" },
                    { id: "stations", icon: Building2, label: "Stations Lavage" },
                    { id: "production", icon: Coffee, label: "Analyse Récolte" },
                    { id: "gallery", icon: Camera, label: "Galerie Photos" },
                ].map((item) => (
                    <button
                        key={item.id}
                        onClick={() => { setActiveTab(item.id); setIsSidebarOpen(false); }}
                        className={`w-full flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group ${
                            activeTab === item.id 
                            ? "bg-white/10 text-white border-l-4 border-blue-500" 
                            : "hover:bg-white/5 hover:text-white"
                        }`}
                    >
                        <item.icon className={`h-5 w-5 ${activeTab === item.id ? "text-blue-500" : "group-hover:text-blue-400"}`} />
                        <span className="font-semibold text-sm">{item.label}</span>
                    </button>
                ))}
            </div>

            <div className="space-y-1">
                <p className="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 px-4 mb-4">Support & Tools</p>
                {[
                    { id: "settings", icon: Settings, label: "Paramètres" },
                    { id: "info", icon: Info, label: "Aide & Guide" },
                ].map((item) => (
                    <button
                        key={item.id}
                        className="w-full flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/5 hover:text-white group"
                    >
                        <item.icon className="h-5 w-5 group-hover:text-blue-400" />
                        <span className="font-semibold text-sm">{item.label}</span>
                    </button>
                ))}
            </div>
        </div>

        <div className="p-4 border-t border-white/10">
            <div className="p-4 bg-white/5 rounded-2xl border border-white/5">
                <div className="flex items-center gap-2 mb-2">
                    <div className="h-2 w-2 rounded-full bg-emerald-500 animate-pulse" />
                    <span className="text-[10px] font-black text-zinc-500 uppercase">Live Database</span>
                </div>
                <p className="text-[10px] text-zinc-400 font-medium">Connecté à SQLite dev.db</p>
            </div>
        </div>
      </aside>

      {/* Main Content Area */}
      <main className="flex-1 flex flex-col min-w-0 relative h-screen overflow-y-auto">
        <header className="h-20 min-h-[80px] bg-white dark:bg-zinc-950 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between px-8 sticky top-0 z-10 shadow-sm">
            <div className="flex items-center gap-4 flex-1">
                <button 
                    onClick={() => setIsSidebarOpen(true)}
                    className="lg:hidden p-2 hover:bg-zinc-100 dark:hover:bg-zinc-900 rounded-xl transition-colors"
                >
                    <Menu className="h-6 w-6 text-zinc-600" />
                </button>
                <div className="relative max-w-md w-full hidden md:block">
                    <Search className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-zinc-400" />
                    <input 
                        placeholder="Rechercher une parcelle..." 
                        className="w-full bg-zinc-100 dark:bg-zinc-900 border-none rounded-xl pl-11 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all"
                    />
                </div>
            </div>

            <div className="flex items-center gap-6">
                <button className="relative p-2 text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-900 rounded-xl transition-colors">
                    <Bell className="h-5 w-5" />
                    <span className="absolute top-2 right-2 h-2 w-2 bg-red-500 rounded-full border-2 border-white dark:border-zinc-950" />
                </button>
                <div className="h-8 w-[1px] bg-zinc-200 dark:bg-zinc-800" />
                <div className="flex items-center gap-3 pl-2">
                    <div className="flex flex-col items-end hidden sm:flex">
                        <span className="text-sm font-bold">Admin COACKI</span>
                        <span className="text-[10px] font-black text-blue-500 uppercase tracking-widest">Superuser</span>
                    </div>
                    <div className="h-11 w-11 rounded-xl bg-gradient-to-tr from-blue-600 to-blue-400 p-[2px] shadow-lg shadow-blue-500/20">
                        <div className="h-full w-full rounded-[10px] bg-white dark:bg-zinc-900 flex items-center justify-center">
                            <User className="h-6 w-6 text-blue-600" />
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div className="p-8 space-y-8">
            {/* Header Title with Action */}
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 className="text-3xl font-black tracking-tighter text-zinc-900 dark:text-white">Tableau de Bord</h2>
                    <p className="text-sm text-zinc-500 font-medium">Bienvenue dans l'interface de gestion géospatiale COACKI.</p>
                </div>
                <button
                    onClick={() => { setModalType("parcelle"); setIsModalOpen(true); }}
                    className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all shadow-xl shadow-blue-600/20 flex items-center gap-2 w-fit active:scale-95"
                >
                    <Plus className="h-5 w-5" /> Nouvelle Parcelle
                </button>
            </div>

            {/* Stats Grids - Rocker Style */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {[
                    { label: "Total Parcelles", value: stats.totalParcelles, icon: Trees, color: "blue", trend: "+4 ce mois" },
                    { label: "Pieds de Café", value: stats.totalPieds.toLocaleString(), icon: Coffee, color: "emerald", trend: "Capacité : 321k" },
                    { label: "Stations Lavage", value: stats.totalStations, icon: Building2, color: "amber", trend: "100% opérationnel" },
                    { label: "Producteurs", value: "276", icon: User, color: "purple", trend: "94 Femmes" },
                ].map((stat, i) => (
                    <div key={i} className="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm hover:translate-y-[-4px] transition-all duration-300">
                        <div className="flex items-center justify-between mb-4">
                            <div className={`h-12 w-12 rounded-xl flex items-center justify-center ${
                                stat.color === "blue" ? "bg-blue-50 text-blue-600" :
                                stat.color === "emerald" ? "bg-emerald-50 text-emerald-600" :
                                stat.color === "amber" ? "bg-amber-50 text-amber-600" :
                                "bg-purple-50 text-purple-600"
                            }`}>
                                <stat.icon className="h-6 w-6" />
                            </div>
                            <MoreVertical className="h-4 w-4 text-zinc-300" />
                        </div>
                        <div className="space-y-1">
                            <p className="text-2xl font-black tracking-tight">{stat.value}</p>
                            <p className="text-xs font-bold text-zinc-500 uppercase tracking-widest">{stat.label}</p>
                        </div>
                        <div className="mt-4 pt-4 border-t border-zinc-50 dark:border-zinc-800/50 flex items-center justify-between">
                            <span className="text-[10px] font-black text-zinc-400 uppercase">{stat.trend}</span>
                            <div className="h-1.5 w-12 bg-zinc-100 rounded-full overflow-hidden">
                                <div className={`h-full w-2/3 ${
                                    stat.color === "blue" ? "bg-blue-500" :
                                    stat.color === "emerald" ? "bg-emerald-500" :
                                    stat.color === "amber" ? "bg-amber-500" :
                                    "bg-purple-500"
                                }`} />
                            </div>
                        </div>
                    </div>
                ))}
            </div>

            {activeTab === "dashboard" && (
                <div className="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    {/* Large Map Card */}
                    <div className="xl:col-span-2 space-y-6">
                        <div className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden flex flex-col">
                            <div className="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                                <h3 className="font-bold text-lg flex items-center gap-2">
                                    <MapPin className="h-5 w-5 text-blue-500" /> Surveillance du Territoire
                                </h3>
                                <div className="flex items-center gap-2">
                                    <button className="p-2 hover:bg-zinc-50 rounded-lg text-zinc-400 transition-colors"><Filter className="h-4 w-4" /></button>
                                    <button className="p-2 hover:bg-zinc-50 rounded-lg text-zinc-400 transition-colors"><Settings className="h-4 w-4" /></button>
                                </div>
                            </div>
                            <div className="h-[500px] w-full relative">
                                <Map center={activeLocation || undefined} zoom={activeLocation ? 16 : undefined} />
                            </div>
                        </div>

                        {/* Summary Table */}
                        <div className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden">
                            <div className="p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                                <h3 className="font-bold text-lg">Aperçu des Actifs</h3>
                                <button onClick={() => setActiveTab("parcelles")} className="text-xs font-black text-blue-600 hover:text-blue-700 uppercase tracking-widest">Voir le registre complet</button>
                            </div>
                            <div className="overflow-x-auto text-zinc-900 dark:text-zinc-100">
                                <table className="w-full text-left">
                                    <thead className="bg-zinc-50 dark:bg-zinc-900/50 text-[10px] font-black uppercase tracking-widest text-zinc-500 border-b border-zinc-100 dark:border-zinc-800">
                                        <tr>
                                            <th className="px-6 py-4">Nom / Producteur</th>
                                            <th className="px-6 py-4">Type</th>
                                            <th className="px-6 py-4">Altitude</th>
                                            <th className="px-6 py-4">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-zinc-50 dark:divide-zinc-800">
                                        {locations.slice(0, 5).map((loc: any, idx: number) => (
                                            <tr 
                                                key={idx} 
                                                className="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors cursor-pointer group"
                                                onClick={() => {
                                                    setActiveLocation([loc.geometry.coordinates[1], loc.geometry.coordinates[0]]);
                                                    document.querySelector("header")?.scrollIntoView({ behavior: "smooth" });
                                                }}
                                            >
                                                <td className="px-6 py-4">
                                                    <div className="flex items-center gap-3">
                                                        <div className="h-8 w-8 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 font-black text-xs">
                                                            {(loc.properties.producer || loc.properties.name || "?").substring(0, 1)}
                                                        </div>
                                                        <span className="text-sm font-semibold">{loc.properties.producer || loc.properties.name}</span>
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4">
                                                    <span className="text-xs text-zinc-500 font-bold uppercase tracking-tighter opacity-60">{loc.properties.type}</span>
                                                </td>
                                                <td className="px-6 py-4 font-mono text-xs">{loc.properties.altitude ? `${loc.properties.altitude}m` : "--"}</td>
                                                <td className="px-6 py-4">
                                                    <span className={`px-2 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter ${
                                                        loc.properties.type === "station" ? "bg-amber-100 text-amber-700" : "bg-emerald-100 text-emerald-700"
                                                    }`}>
                                                        Actif
                                                    </span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {/* Right Column / Recent Activity */}
                    <div className="space-y-8">
                        <div className="bg-[#007bff] text-white p-8 rounded-[32px] shadow-xl shadow-blue-500/20 relative overflow-hidden group">
                            <div className="relative z-10 space-y-6">
                                <Coffee className="h-12 w-12 opacity-80 group-hover:scale-110 transition-transform duration-500" />
                                <div className="space-y-2">
                                    <h3 className="text-2xl font-black tracking-tighter">Récolte Bourbon</h3>
                                    <p className="text-sm text-white/80 font-medium leading-relaxed">
                                        Les données actuelles indiquent un rendement potentiel de 8.5 tonnes pour le secteur Munanira.
                                    </p>
                                </div>
                                <button className="w-full py-3 bg-white text-blue-600 rounded-xl text-sm font-black hover:bg-white/90 transition-all shadow-lg active:scale-95">
                                    Consulter Rapport
                                </button>
                            </div>
                            <div className="absolute -bottom-10 -right-10 h-40 w-40 bg-white/20 rounded-full blur-3xl" />
                        </div>

                        <div className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 shadow-sm p-6">
                            <h4 className="font-bold text-lg mb-6">Activité Récente</h4>
                            <div className="space-y-6">
                                {[
                                    { user: "Fleming C.", action: "Ajouté Station Lavage", time: "Il y a 2h", icon: Building2, color: "bg-blue-100 text-blue-600" },
                                    { user: "Admin", action: "Mis à jour Parcelle #02", time: "Il y a 5h", icon: Trees, color: "bg-emerald-100 text-emerald-600" },
                                    { user: "Système", action: "Backup automatique réussi", time: "Hier", icon: LayoutDashboard, color: "bg-zinc-100 text-zinc-600" },
                                ].map((item, i) => (
                                    <div key={i} className="flex gap-4">
                                        <div className={`h-10 w-10 flex-shrink-0 rounded-xl flex items-center justify-center ${item.color}`}>
                                            <item.icon className="h-5 w-5" />
                                        </div>
                                        <div className="space-y-1">
                                            <p className="text-sm font-bold text-zinc-900 dark:text-zinc-100">{item.action}</p>
                                            <div className="flex items-center gap-2 text-xs text-zinc-500 font-medium">
                                                <span>{item.user}</span>
                                                <span>•</span>
                                                <span>{item.time}</span>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                            <button className="w-full mt-8 py-3 bg-zinc-50 dark:bg-zinc-800 rounded-xl text-xs font-black uppercase tracking-widest text-zinc-500 hover:bg-zinc-100 transition-colors">
                                Voir historique complet
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {activeTab === "parcelles" && (
                <div className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div className="p-8 border-b border-zinc-100 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h3 className="font-black text-2xl tracking-tighter">Registre des Parcelles</h3>
                            <p className="text-sm text-zinc-500 font-medium">Gestion exhaustive des producteurs et de leurs plantations.</p>
                        </div>
                        <div className="flex gap-2">
                            <button 
                                onClick={exportToPDF}
                                className="px-4 py-2 bg-zinc-100 dark:bg-zinc-800 rounded-xl text-xs font-bold hover:bg-zinc-200 transition-colors flex items-center gap-2"
                            >
                                <Download className="h-3 w-3" /> Exporter PDF
                            </button>
                            <button onClick={() => setIsModalOpen(true)} className="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20 flex items-center gap-2">
                                <Plus className="h-4 w-4" /> Ajouter
                            </button>
                        </div>
                    </div>
                    <div className="overflow-x-auto">
                        <table className="w-full text-left">
                            <thead className="bg-zinc-50 dark:bg-zinc-900/50 text-[10px] font-black uppercase tracking-widest text-zinc-500 border-b border-zinc-100 dark:border-zinc-800">
                                <tr>
                                    <th className="px-6 py-4">Producteur</th>
                                    <th className="px-6 py-4">Groupement</th>
                                    <th className="px-6 py-4">Coord (Lat, Lng)</th>
                                    <th className="px-6 py-4">Pieds</th>
                                    <th className="px-6 py-4">Altitude</th>
                                    <th className="px-6 py-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-zinc-50 dark:divide-zinc-800">
                                {locations.filter(f => f.properties.type === "parcelle").map((loc: any, idx: number) => (
                                    <tr key={idx} className="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                                        <td className="px-6 py-5">
                                            <div className="flex items-center gap-3">
                                                <div className="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xs">
                                                    {(loc.properties.producer || "?").substring(0, 1)}
                                                </div>
                                                <span className="text-sm font-bold text-zinc-900 dark:text-zinc-100">{loc.properties.producer}</span>
                                            </div>
                                        </td>
                                        <td className="px-6 py-5">
                                            <span className="text-xs font-semibold text-zinc-500">{loc.properties.groupement || "Mbinga-Sud"}</span>
                                        </td>
                                        <td className="px-6 py-5">
                                            <div className="flex flex-col gap-0.5">
                                                <span className="text-[10px] font-mono text-zinc-400">LAT: {loc.geometry.coordinates[1].toFixed(6)}</span>
                                                <span className="text-[10px] font-mono text-zinc-400">LNG: {loc.geometry.coordinates[0].toFixed(6)}</span>
                                            </div>
                                        </td>
                                        <td className="px-6 py-5">
                                            <div className="flex items-center gap-2">
                                                <Coffee className="h-3 w-3 text-zinc-300" />
                                                <span className="text-sm font-mono font-bold">{loc.properties.nbPieds}</span>
                                            </div>
                                        </td>
                                        <td className="px-6 py-5">
                                            <span className="text-sm font-bold text-blue-600">{loc.properties.altitude}m</span>
                                        </td>
                                <td className="px-6 py-5">
                                            <div className="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button 
                                                    onClick={() => {
                                                        setActiveLocation([loc.geometry.coordinates[1], loc.geometry.coordinates[0]]);
                                                        setActiveTab("dashboard");
                                                        window.scrollTo({ top: 0, behavior: "smooth" });
                                                    }}
                                                    className="p-2 hover:bg-zinc-200 dark:hover:bg-zinc-800 rounded-lg transition-colors"
                                                >
                                                    <MapPin className="h-4 w-4 text-blue-500" />
                                                </button>
                                                <button 
                                                    onClick={() => deleteParcelle(loc.properties.id)}
                                                    className="p-2 hover:bg-red-50 text-red-500 rounded-lg transition-colors"
                                                >
                                                    <X className="h-4 w-4" />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            )}

            {activeTab === "stations" && (
                <div className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div className="p-8 border-b border-zinc-100 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h3 className="font-black text-2xl tracking-tighter">Stations de Lavage</h3>
                            <p className="text-sm text-zinc-500 font-medium">Infrastructure de traitement et centres de collecte.</p>
                        </div>
                        <button className="px-6 py-3 bg-zinc-900 text-white dark:bg-zinc-100 dark:text-black rounded-xl text-xs font-black uppercase tracking-widest transition-all hover:scale-105 active:scale-95">Nouvelle Station</button>
                    </div>
                    <div className="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {locations.filter(f => f.properties.type === "station").map((loc: any, idx: number) => (
                            <div key={idx} className="p-6 bg-zinc-50 dark:bg-zinc-800/50 rounded-[32px] border border-zinc-200 dark:border-zinc-800 group hover:border-blue-500/50 transition-all duration-300">
                                <div className="h-14 w-14 bg-white dark:bg-zinc-900 rounded-2xl flex items-center justify-center text-blue-600 shadow-sm mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                    <Building2 className="h-7 w-7" />
                                </div>
                                <div className="space-y-4">
                                    <div className="space-y-1">
                                        <h4 className="font-black text-lg text-zinc-900 dark:text-white">{loc.properties.name}</h4>
                                        <div className="flex items-center gap-2 text-xs text-zinc-500 font-bold uppercase tracking-tight">
                                            <MapPin className="h-3 w-3" /> {loc.properties.localisation || "Kalehe"}
                                        </div>
                                    </div>
                                    <div className="pt-4 border-t border-zinc-200 dark:border-zinc-700 flex items-center justify-between">
                                        <div className="flex flex-col">
                                            <span className="text-[10px] font-black text-zinc-400 uppercase">Capacité</span>
                                            <span className="text-sm font-black">2.5 Tonnes / jour</span>
                                        </div>
                                        <span className="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full">Opérationnel</span>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            )}

            {activeTab === "production" && (
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 p-10 space-y-8">
                        <div className="space-y-2">
                            <h3 className="text-3xl font-black tracking-tighter">Analyse de Récolte</h3>
                            <p className="text-sm text-zinc-500 font-medium">Statistiques prédictives basées sur le nombre de pieds de café.</p>
                        </div>
                        <div className="aspect-video bg-zinc-50 dark:bg-zinc-800/50 rounded-2xl border border-dashed border-zinc-300 dark:border-zinc-700 flex items-center justify-center relative overflow-hidden">
                            <Wind className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-40 w-40 text-blue-500/5 animate-pulse" />
                            <span className="text-sm font-bold text-zinc-400 tracking-tight">Graphiques en cours de génération...</span>
                        </div>
                    </div>
                    <div className="space-y-6">
                        <div className="p-8 bg-blue-600 text-white rounded-3xl shadow-xl shadow-blue-500/20">
                            <h4 className="font-bold text-xl mb-4">Potentiel de Rendement</h4>
                            <div className="flex items-baseline gap-2">
                                <span className="text-5xl font-black tracking-tighter">
                                    {(stats.totalPieds * 0.0004).toFixed(1)}
                                </span>
                                <span className="font-bold tracking-widest text-sm text-white/60">TONNES / AN</span>
                            </div>
                            <p className="mt-4 text-sm text-white/70 font-medium">Basé sur une estimation de 0.4kg par pied (Arabica Bourbon).</p>
                        </div>
                        <div className="p-8 bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800">
                            <h4 className="font-bold text-lg mb-6">Objectifs de Durabilité</h4>
                            <div className="space-y-4">
                                {[
                                    { label: "Conversion Bio", progress: 65, color: "bg-emerald-500" },
                                    { label: "Renouvellement Verger", progress: 42, color: "bg-amber-500" },
                                    { label: "Installation Séchoirs", progress: 88, color: "bg-blue-500" },
                                ].map((goal, i) => (
                                    <div key={i} className="space-y-2">
                                        <div className="flex justify-between text-xs font-black uppercase tracking-widest">
                                            <span>{goal.label}</span>
                                            <span>{goal.progress}%</span>
                                        </div>
                                        <div className="h-2 w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                            <div className={`h-full ${goal.color}`} style={{ width: `${goal.progress}%` }} />
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            )}

            {activeTab === "gallery" && (
                <div className="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <div className="flex justify-between items-center bg-white dark:bg-zinc-900 p-8 rounded-3xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div>
                            <h3 className="font-black text-2xl tracking-tighter">Gestion de la Galerie</h3>
                            <p className="text-sm text-zinc-500 font-medium">Ajoutez ou modifiez les images du terroir COACKI.</p>
                        </div>
                        <button 
                            onClick={() => { setEditingItem(null); setModalType("gallery"); setIsModalOpen(true); }}
                            className="bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition-all flex items-center gap-2"
                        >
                            <Plus className="h-5 w-5" /> Ajouter une Image
                        </button>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        {galleryItems.map((item) => (
                            <div key={item.id} className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 overflow-hidden group shadow-sm hover:shadow-xl transition-all">
                                <div className="aspect-video relative overflow-hidden">
                                    <img src={item.url} alt={item.title} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                    <div className="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button 
                                            onClick={() => { setEditingItem(item); setModalType("gallery"); setIsModalOpen(true); }}
                                            className="p-2 bg-white/90 backdrop-blur-md rounded-lg text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-lg"
                                        >
                                            <Edit2 className="h-4 w-4" />
                                        </button>
                                        <button 
                                            onClick={() => deleteGalleryItem(item.id)}
                                            className="p-2 bg-white/90 backdrop-blur-md rounded-lg text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-lg"
                                        >
                                            <Trash2 className="h-4 w-4" />
                                        </button>
                                    </div>
                                    <div className="absolute bottom-4 left-4">
                                        <span className="px-3 py-1 bg-black/50 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest rounded-full border border-white/20">
                                            {item.category}
                                        </span>
                                    </div>
                                </div>
                                <div className="p-6">
                                    <h4 className="font-bold text-zinc-900 dark:text-white mb-2 line-clamp-1">{item.title}</h4>
                                    <p className="text-xs text-zinc-500 line-clamp-2 leading-relaxed">{item.description}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </div>
      </main>

      {isModalOpen && (
        <div className="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div className="absolute inset-0 bg-[#0d1b2a]/80 backdrop-blur-md transition-opacity" onClick={() => { setIsModalOpen(false); setEditingItem(null); }} />
            <div className="bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 w-full max-w-lg rounded-[32px] shadow-2xl relative z-10 overflow-hidden animate-in fade-in zoom-in duration-300">
                <div className="p-8 border-b border-zinc-100 dark:border-zinc-900">
                    <div className="flex items-center justify-between mb-2">
                        <h2 className="text-2xl font-black text-zinc-900 dark:text-white tracking-tighter">
                            {editingItem ? "Modifier l'Image" : "Nouvel Actif"}
                        </h2>
                        <button 
                            onClick={() => { setIsModalOpen(false); setEditingItem(null); }}
                            className="p-3 hover:bg-zinc-100 dark:hover:bg-zinc-900 rounded-2xl transition-colors group"
                        >
                            <X className="h-5 w-5 text-zinc-400 group-hover:text-zinc-900 transition-colors" />
                        </button>
                    </div>
                    
                    {!editingItem && (
                        <div className="flex gap-2 p-1 bg-zinc-100 dark:bg-zinc-900 rounded-xl w-fit">
                            <button 
                                onClick={() => setModalType("parcelle")}
                                className={`px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all ${modalType === "parcelle" ? "bg-white dark:bg-zinc-800 text-blue-600 shadow-sm" : "text-zinc-500"}`}
                            >
                                Parcelle
                            </button>
                            <button 
                                onClick={() => setModalType("station")}
                                className={`px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all ${modalType === "station" ? "bg-white dark:bg-zinc-800 text-blue-600 shadow-sm" : "text-zinc-500"}`}
                            >
                                Station
                            </button>
                            <button 
                                onClick={() => setModalType("gallery")}
                                className={`px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all ${modalType === "gallery" ? "bg-white dark:bg-zinc-800 text-blue-600 shadow-sm" : "text-zinc-500"}`}
                            >
                                Galerie
                            </button>
                        </div>
                    )}
                </div>
                
                <form 
                    className="p-8 space-y-6"
                    onSubmit={async (e) => {
                        e.preventDefault();
                        const formData = new FormData(e.currentTarget);
                        const data = Object.fromEntries(formData.entries());
                        
                        let endpoint = "";
                        if (modalType === "parcelle") endpoint = "/api/parcelles";
                        else if (modalType === "station") endpoint = "/api/stations";
                        else endpoint = editingItem ? `/api/gallery/${editingItem.id}` : "/api/gallery";
                        
                        try {
                            const res = await fetch(endpoint, {
                                method: editingItem ? "PUT" : "POST",
                                headers: { "Content-Type": "application/json" },
                                body: JSON.stringify(data),
                            });
                            if (res.ok) {
                                setIsModalOpen(false);
                                setEditingItem(null);
                                if (modalType === "gallery") fetchGallery();
                                else window.location.reload();
                            }
                        } catch (err) {
                            console.error(err);
                        }
                    }}
                >
                    {modalType === "parcelle" ? (
                        <>
                            <div className="grid grid-cols-2 gap-6">
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Producteur</label>
                                    <input name="producteur" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Groupement</label>
                                    <input name="groupement" className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
                                </div>
                            </div>

                            <div className="grid grid-cols-2 gap-6">
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Latitude</label>
                                    <input name="lat" type="number" step="any" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-1.5 text-sm" />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Longitude</label>
                                    <input name="lng" type="number" step="any" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-1.5 text-sm" />
                                </div>
                            </div>

                            <div className="grid grid-cols-2 gap-6">
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Altitude (m)</label>
                                    <input name="altitude" type="number" className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-1.5 text-sm" />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Nombre de Pieds</label>
                                    <input name="nbPieds" type="number" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-1.5 text-sm" />
                                </div>
                            </div>
                        </>
                    ) : modalType === "station" ? (
                        <div className="space-y-6">
                            <div className="space-y-2">
                                <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Nom de la Station</label>
                                <input name="nom" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
                            </div>
                            <div className="space-y-2">
                                <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Localisation / Village</label>
                                <input name="localisation" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
                            </div>
                            <div className="grid grid-cols-2 gap-6">
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Latitude</label>
                                    <input name="lat" type="number" step="any" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-1.5 text-sm" />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Longitude</label>
                                    <input name="lng" type="number" step="any" required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-1.5 text-sm" />
                                </div>
                            </div>
                        </div>
                    ) : (
                        <div className="space-y-4">
                            <div className="space-y-2">
                                <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Titre de l'Image</label>
                                <input name="title" defaultValue={editingItem?.title} required className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm outline-none" />
                            </div>
                            <div className="space-y-2">
                                <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">URL de l'Image</label>
                                <input name="url" defaultValue={editingItem?.url} required placeholder="/images/gallery/filename.jpg" className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm outline-none" />
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Catégorie</label>
                                    <select name="category" defaultValue={editingItem?.category || "Général"} className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm outline-none">
                                        <option value="Terroir">Terroir</option>
                                        <option value="Récolte">Récolte</option>
                                        <option value="Station">Station</option>
                                        <option value="Membres">Membres</option>
                                        <option value="Général">Général</option>
                                    </select>
                                </div>
                            </div>
                            <div className="space-y-2">
                                <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Description</label>
                                <textarea name="description" defaultValue={editingItem?.description} className="w-full bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm outline-none h-24 resize-none" />
                            </div>
                        </div>
                    )}

                    <button type="submit" className="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-blue-500/30 hover:bg-blue-700 transition-all active:scale-95 mt-4">
                        {editingItem ? "Mettre à jour" : `Enregistrer ${modalType === "parcelle" ? "la Parcelle" : modalType === "station" ? "la Station" : "l'Image"}`}
                    </button>
                </form>
            </div>
        </div>
      )}
    </div>
  );
}
