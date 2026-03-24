import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import Map from "@/components/MapWrapper";
import { Crosshair, MapPin } from "lucide-react";

export const metadata = {
  title: "Carte & Terroir - COACKI | Localisation à Kalehe",
  description: "Explorez la carte interactive de notre terroir à Munanira, Kalehe. Découvrez la localisation précise de notre station de lavage et des parcelles de nos membres.",
};

export default function Carte() {
  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      <main className="pt-20">
        <section className="py-32 relative">
          <div className="max-w-7xl mx-auto px-6 space-y-16">
            <div className="text-center space-y-6 max-w-4xl mx-auto animate-in fade-in slide-in-from-top-10 duration-1000">
              <h2 className="text-forest text-sm font-black uppercase tracking-[0.4em]">Terroir Munanira</h2>
              <h1 className="text-6xl lg:text-8xl font-black text-forest tracking-tighter leading-none">Ancrage Local à <span className="text-gold">Kalehe</span></h1>
              <p className="text-zinc-500 text-xl font-medium leading-relaxed">
                Notre terroir est situé au village Munanira, groupement Mbinga-Sud. Explorez notre zone de production et l'emplacement de nos infrastructures de traitement.
              </p>
            </div>

            <div className="rounded-[40px] overflow-hidden border-8 md:border-[16px] border-white shadow-2xl h-[400px] md:h-[600px] lg:h-[700px] relative animate-in fade-in zoom-in duration-1000">
               <Map />
               <div className="absolute bottom-10 left-10 p-6 bg-white/90 backdrop-blur-md rounded-3xl border border-forest/10 shadow-2xl z-20 hidden md:block group hover:bg-forest transition-colors duration-500">
                  <h4 className="font-black text-forest mb-4 group-hover:text-gold transition-colors">Point de Référence</h4>
                  <div className="space-y-3">
                    <p className="flex items-center gap-3 text-sm font-bold text-zinc-500 group-hover:text-white transition-colors">
                        <MapPin size={16} className="text-gold" /> Village Munanira
                    </p>
                    <p className="flex items-center gap-3 text-sm font-bold text-zinc-500 group-hover:text-white transition-colors">
                        <Crosshair size={16} className="text-gold" /> Latitude: -2.041538
                    </p>
                    <p className="flex items-center gap-3 text-sm font-bold text-zinc-500 group-hover:text-white transition-colors">
                        <Crosshair size={16} className="text-gold" /> Longitude: 28.970495
                    </p>
                  </div>
               </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-12 pt-12">
                <div className="p-10 bg-white rounded-3xl border border-forest/5 shadow-sm hover:translate-y-[-8px] transition-all">
                    <h3 className="text-2xl font-black text-forest mb-4">Altitude Idéale</h3>
                    <p className="text-zinc-500 font-medium leading-relaxed">
                        Situé entre 1491m et 2000m, notre terroir profite d'une maturation lente des cerises, cruciale pour la complexité aromatique.
                    </p>
                </div>
                <div className="p-10 bg-white rounded-3xl border border-forest/5 shadow-sm hover:translate-y-[-8px] transition-all">
                    <h3 className="text-2xl font-black text-forest mb-4">Sol Volcanique</h3>
                    <p className="text-zinc-500 font-medium leading-relaxed">
                        La province du Sud-Kivu offre des terres volcaniques fertiles et riches en minéraux, nourrissant naturellement nos caféiers Bourbon.
                    </p>
                </div>
                <div className="p-10 bg-white rounded-3xl border border-forest/5 shadow-sm hover:translate-y-[-8px] transition-all">
                    <h3 className="text-2xl font-black text-forest mb-4">Micro-climat Lake Kivu</h3>
                    <p className="text-zinc-500 font-medium leading-relaxed">
                        La proximité du Lac Kivu régule les températures et apporte l'humidité nécessaire durant les phases critiques de floraison.
                    </p>
                </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}
