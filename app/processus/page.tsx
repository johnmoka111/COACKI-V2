import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { Trees, Droplets, Wind, Award, Coffee, Ship } from "lucide-react";

export const metadata = {
  title: "Processus - COACKI | Cerise vers la Tasse",
  description: "Découvrez notre processus de production méticuleux, de la récolte manuelle au tri manuel final pour garantir la qualité supérieure du café Bourbon.",
};

export default function Processus() {
  const steps = [
    { step: "01", title: "Récolte", desc: "Cerises rouges uniquement, cueillies à la main à une altitude de 1491 \u2013 2000m pour une concentration optimale des sucres.", icon: Trees },
    { step: "02", title: "Lavage", desc: "Traitement par voie humide intégrale sous 24h avec dépulpage mécanique et fermentation naturelle contrôlée.", icon: Droplets },
    { step: "03", title: "Séchage", desc: "Séchage lent sur lits africains surélevés pendant 12 à 15 jours pour stabiliser l'humidité entre 11% et 12%.", icon: Wind },
    { step: "04", title: "Tri Manuel", desc: "Élimination méticuleuse des défauts par nos membres avant l'ensachage final et l'exportation.", icon: Award },
  ];

  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      <main className="pt-20">
        <section className="py-32 bg-white">
          <div className="max-w-7xl mx-auto px-6">
            <div className="flex flex-col md:flex-row justify-between items-end gap-12 mb-20 animate-in fade-in slide-in-from-bottom-10 duration-1000">
              <div className="max-w-xl space-y-6">
                <h4 className="text-gold font-black uppercase text-xs tracking-widest">De la cerise à la tasse</h4>
                <h1 className="text-6xl font-black text-forest tracking-tighter leading-none">Une Traçabilité Totale</h1>
                <div className="h-2 w-32 bg-gold rounded-full" />
              </div>
              <p className="text-zinc-500 font-medium max-w-sm text-lg leading-relaxed">
                Chaque étape est rigoureusement contrôlée par nos membres pour garantir le profil Bourbon Score 85+. 
                Nous ne faisons aucun compromis sur la qualité.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
              {steps.map((item, i) => (
                <div 
                  key={i} 
                  className="relative p-12 bg-coacki-bg rounded-[40px] group hover:bg-forest transition-all duration-700 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                >
                  <span className="text-8xl font-black text-zinc-100 absolute -top-4 -right-2 group-hover:text-white/5 transition-colors duration-500 pointer-events-none">
                    {item.step}
                  </span>
                  <div className="h-16 w-16 bg-white rounded-2xl flex items-center justify-center shadow-lg group-hover:bg-gold transition-colors duration-500 mb-8 relative z-10">
                    <item.icon className="h-8 w-8 text-gold group-hover:text-forest transition-colors duration-500" />
                  </div>
                  <h3 className="text-2xl font-black text-forest mb-4 group-hover:text-white transition-colors relative z-10">{item.title}</h3>
                  <p className="text-zinc-500 group-hover:text-white/70 transition-colors relative z-10 leading-relaxed font-medium">{item.desc}</p>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section className="py-32 bg-zinc-900 text-white overflow-hidden relative">
          <div className="absolute right-0 top-1/2 -translate-y-1/2 opacity-5">
            <Coffee className="h-[800px] w-[800px] rotate-45" />
          </div>
          
          <div className="max-w-7xl mx-auto px-6 relative z-10">
            <div className="max-w-3xl mb-20 space-y-6">
              <h2 className="text-5xl lg:text-7xl font-black tracking-tighter">Cycle Saisonnier</h2>
              <p className="text-zinc-400 text-xl font-medium leading-relaxed">
                Notre production respecte le rythme de la nature, avec des phases spécifiques pour garantir la fraîcheur de nos grains Bourbon.
              </p>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
              <div className="space-y-6 animate-in fade-in slide-in-from-left duration-1000">
                {[
                  { period: "Avril - Mai", activity: "Floraison & Entretien", icon: Droplets, status: "Terminé" },
                  { period: "Septembre - Décembre", activity: "Récolte & Lavage", icon: Coffee, status: "En cours" },
                  { period: "Janvier - Juillet", activity: "Embarquement Principal", icon: Ship, status: "À venir" },
                  { period: "Octobre", activity: "Saison Intermédiaire", icon: Ship, status: "À venir" },
                ].map((item, i) => (
                  <div key={i} className="flex items-center justify-between p-8 bg-white/5 rounded-3xl border border-white/10 hover:bg-white/10 transition-colors group">
                    <div className="flex items-center gap-6">
                      <div className="h-16 w-16 bg-gold/10 rounded-2xl flex items-center justify-center group-hover:bg-gold/20 transition-all">
                        <item.icon className="text-gold h-8 w-8" />
                      </div>
                      <div className="space-y-1">
                        <h4 className="font-bold text-xl">{item.activity}</h4>
                        <p className="text-zinc-500 font-bold uppercase text-xs tracking-widest">{item.period}</p>
                      </div>
                    </div>
                    <span className={`text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-[0.2em] border ${
                      item.status === "En cours" ? "bg-emerald-500/10 text-emerald-400 border-emerald-500/20" : 
                      item.status === "Terminé" ? "bg-zinc-500/10 text-zinc-400 border-zinc-500/20" : 
                      "bg-gold/10 text-gold border-gold/20"
                    }`}>
                      {item.status}
                    </span>
                  </div>
                ))}
              </div>

              <div className="bg-zinc-800/50 p-12 rounded-[48px] border border-white/5 flex flex-col justify-center gap-8 animate-in fade-in slide-in-from-right duration-1000">
                <div className="h-20 w-20 bg-forest rounded-3xl flex items-center justify-center">
                  <Award className="h-10 w-10 text-gold" />
                </div>
                <h3 className="text-4xl font-black tracking-tight">Certification de Qualité</h3>
                <p className="text-zinc-400 text-lg leading-relaxed font-medium">
                  Nous documentons méticuleusement chaque lot. De la date de récolte au conditionnement en sacs GrainPro, nous garantissons l'authenticité de notre Bourbon 85+.
                </p>
                <div className="pt-8 grid grid-cols-2 gap-8 text-center border-t border-white/5">
                  <div>
                    <span className="block text-4xl font-black text-gold">85+</span>
                    <span className="text-xs font-bold uppercase tracking-widest opacity-40">Score Moyen</span>
                  </div>
                  <div>
                    <span className="block text-4xl font-black text-gold">100%</span>
                    <span className="text-xs font-bold uppercase tracking-widest opacity-40">Traçabilité</span>
                  </div>
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
