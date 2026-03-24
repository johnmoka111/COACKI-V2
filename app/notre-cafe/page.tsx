import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { Droplets, Trees } from "lucide-react";

export const metadata = {
  title: "Notre Café - COACKI | Excellence Bourbon",
  description: "Découvrez le profil aromatique unique de notre café Bourbon, cultivé sur les hauts plateaux du Kivu avec un score de cupping de 85+.",
};

export default function NotreCafe() {
  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      <main className="pt-20">
        <section className="py-32 relative">
          <div className="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div className="relative animate-in fade-in slide-in-from-left duration-1000">
              <div className="aspect-square bg-forest/5 rounded-[40px] absolute -inset-6 -rotate-3" />
              <div className="relative aspect-square rounded-[32px] overflow-hidden shadow-2xl">
                <img 
                  src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop" 
                  alt="Coffee Cup" 
                  className="w-full h-full object-cover" 
                />
              </div>
              <div className="absolute -right-10 -bottom-10 bg-white dark:bg-zinc-900 p-8 rounded-full shadow-2xl border-8 border-coacki-bg flex flex-col items-center justify-center w-48 h-48 animate-bounce transition-all duration-300">
                <span className="text-5xl font-black text-forest">85</span>
                <span className="text-xs font-black uppercase text-gold tracking-widest">Cupping Score</span>
              </div>
            </div>

            <div className="space-y-10 animate-in fade-in slide-in-from-right duration-1000">
              <div className="space-y-4">
                <h2 className="text-forest text-sm font-black uppercase tracking-[0.2em]">Excellence Bourbon</h2>
                <h1 className="text-5xl lg:text-7xl font-black text-forest tracking-tighter">Profil Aromatique Unique</h1>
                <div className="h-2 w-24 bg-gold rounded-full" />
              </div>

              <div className="space-y-6">
                <p className="text-zinc-600 text-lg leading-relaxed">
                  Cultivé sur les hauts plateaux du Kivu, notre café **Bourbon** se distingue par une complexité rare, fruit d'un terroir volcanique exceptionnel et d'un savoir-faire ancestral. 
                  Notre terroir, situé à Munanira, offre des conditions climatiques optimales pour le développement de notes florales délicates et d'une acidité citronnée équilibrée.
                </p>
                <p className="text-zinc-600 text-lg leading-relaxed">
                  Chaque cerise est sélectionnée individuellement lors de la récolte manuelle, garantissant que seuls les grains à maturité optimale entrent dans notre processus de lavage.
                </p>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="p-8 bg-white rounded-3xl border border-forest/5 shadow-sm hover:shadow-md transition-shadow group">
                  <Droplets className="text-gold h-10 w-10 mb-6 group-hover:scale-110 transition-transform" />
                  <h4 className="font-bold text-xl text-forest mb-3">Processus Lavé</h4>
                  <p className="text-zinc-500">Voie humide intégrale avec fermentation naturelle contrôlée de 8 à 12 heures dans nos bacs en béton.</p>
                </div>
                <div className="p-8 bg-white rounded-3xl border border-forest/5 shadow-sm hover:shadow-md transition-shadow group">
                  <Trees className="text-gold h-10 w-10 mb-6 group-hover:scale-110 transition-transform" />
                  <h4 className="font-bold text-xl text-forest mb-3">Variété Pure</h4>
                  <p className="text-zinc-500">100% Arabica Bourbon, préservé dans son intégrité génétique pour sa douceur et son corps soyeux.</p>
                </div>
              </div>

              <div className="space-y-6 pt-4">
                <h4 className="font-black text-forest uppercase text-xs tracking-wider">Notes de dégustation détaillées</h4>
                <div className="flex flex-wrap gap-3">
                  {["Jasmin", "Fleur de Café", "Agrumes", "Chocolat Noir", "Citronnelle", "Fruits Rouges"].map(note => (
                    <span key={note} className="px-6 py-3 bg-forest/5 rounded-full text-forest text-sm font-bold border border-forest/10 hover:bg-forest hover:text-white transition-all cursor-default shadow-sm">
                      {note}
                    </span>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}
