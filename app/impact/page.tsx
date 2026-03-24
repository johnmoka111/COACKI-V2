import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { Coffee, CheckCircle, Heart, Building2, Trees, Award, HeartHandshake, UserPlus } from "lucide-react";

export const metadata = {
  title: "Impact Social - COACKI | Développement Durable",
  description: "Apprenez-en plus sur notre engagement social, le leadership féminin à COACKI et comment nous bâtissons l'indépendance de nos membres à Kalehe.",
};

export default function Impact() {
  const stats = [
    { label: "Membres", value: "276", sub: "94F / 182H", icon: UserPlus, color: "blue" },
    { label: "Pieds de Café", value: "321k", sub: "Production Intensive", icon: Trees, color: "emerald" },
    { label: "Altitude", value: "2000m", sub: "1491 \u2013 2000m", icon: Coffee, color: "amber" },
    { label: "Fondateurs", value: "10", sub: "Depuis 2022", icon: Building2, color: "purple" },
  ];

  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      <main className="pt-20">
        <section className="py-32 bg-forest text-white overflow-hidden relative">
          <div className="absolute right-0 top-1/2 -translate-y-1/2 opacity-10">
            <Coffee className="h-[800px] w-[800px] rotate-12" />
          </div>
          
          <div className="max-w-7xl mx-auto px-6 relative z-10">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
              <div className="space-y-12 animate-in fade-in slide-in-from-left duration-1000">
                <div className="space-y-6">
                  <h4 className="text-gold font-black uppercase text-xs tracking-widest">Notre Raison d'être</h4>
                  <h1 className="text-7xl lg:text-8xl font-black tracking-tighter leading-none">Impact Social & <span className="text-gold">Indépendance</span></h1>
                  <div className="h-2 w-32 bg-gold rounded-full" />
                </div>
                
                <p className="text-xl text-white/80 leading-relaxed font-medium">
                  Chez COACKI, nous croyons fermement en l'auto-développement. Notre station de lavage au village Munanira est le symbole de notre autonomie. 
                  Nous l'avons <span className="text-gold font-black underline underline-offset-8">entièrement construite avec les cotisations</span> de nos membres, sans avoir recours à des aides extérieures. 
                  C'est notre fierté et notre force.
                </p>

                <div className="space-y-6">
                  {[
                    "94 femmes leaders pleinement impliquées dans la prise de décision",
                    "Soutien direct au développement communautaire du groupement Mbinga-Sud",
                    "Transparence totale de la chaîne de valeur du producteur à l'exportation",
                    "Formation continue des membres sur les meilleures pratiques culturales"
                  ].map(item => (
                    <div key={item} className="flex items-center gap-6 group">
                      <div className="h-10 w-10 bg-gold rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg shadow-gold/20">
                        <CheckCircle className="text-forest h-6 w-6" />
                      </div>
                      <span className="text-xl font-bold tracking-tight">{item}</span>
                    </div>
                  ))}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-8 animate-in fade-in slide-in-from-right duration-1000">
                {stats.map((stat, i) => (
                  <div 
                    key={i} 
                    className="p-12 bg-white/5 backdrop-blur-xl rounded-[48px] border border-white/10 flex flex-col items-center text-center group hover:bg-gold hover:text-forest transition-all duration-700 hover:shadow-2xl hover:shadow-gold/20"
                  >
                    <div className="h-20 w-20 bg-white/10 rounded-3xl flex items-center justify-center mb-8 group-hover:bg-forest/10 transition-colors">
                      <stat.icon className="h-10 w-10 text-gold group-hover:text-forest transition-colors" />
                    </div>
                    <span className="text-6xl font-black mb-4 tracking-tighter">{stat.value}</span>
                    <span className="text-sm font-black uppercase tracking-[0.2em] opacity-60 mb-2">{stat.label}</span>
                    <span className="text-xs font-bold opacity-40">{stat.sub}</span>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </section>

        <section className="py-32 bg-coacki-bg">
          <div className="max-w-7xl mx-auto px-6">
            <div className="text-center max-w-3xl mx-auto mb-20 space-y-6">
              <h2 className="text-5xl font-black text-forest tracking-tighter leading-none">Nos Valeurs Fondamentales</h2>
              <p className="text-zinc-500 text-lg font-medium leading-relaxed">
                COACKI n'est pas qu'une coopérative de café, c'est une communauté engagée pour le progrès durable et humain du Sud-Kivu.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-12">
              <div className="p-12 bg-white rounded-[48px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                <div className="h-20 w-20 bg-forest/5 rounded-3xl flex items-center justify-center group-hover:bg-forest transition-colors duration-500 mb-8">
                  <Heart className="text-forest h-10 w-10 group-hover:text-gold transition-colors duration-500" />
                </div>
                <h3 className="text-3xl font-black text-forest mb-6 tracking-tight">Social & Inclusif</h3>
                <p className="text-zinc-500 leading-relaxed font-medium text-lg">
                  Avec 94 femmes occupant des postes de leadership, nous transformons le tissu social de Kalehe à travers l'égalité, l'entraide et le développement des compétences.
                </p>
              </div>

              <div className="p-12 bg-white rounded-[48px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                <div className="h-20 w-20 bg-forest/5 rounded-3xl flex items-center justify-center group-hover:bg-forest transition-colors duration-500 mb-8">
                  <Building2 className="text-forest h-10 w-10 group-hover:text-gold transition-colors duration-500" />
                </div>
                <h3 className="text-3xl font-black text-forest mb-6 tracking-tight">Auto-Souveraineté</h3>
                <p className="text-zinc-500 leading-relaxed font-medium text-lg">
                  Chaque brique de notre centre opérationnel a été posée par nous. Nous valorisons l'autonomie financière et la prise de décision indépendante.
                </p>
              </div>

              <div className="p-12 bg-white rounded-[48px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                <div className="h-20 w-20 bg-forest/5 rounded-3xl flex items-center justify-center group-hover:bg-forest transition-colors duration-500 mb-8">
                  <HeartHandshake className="text-forest h-10 w-10 group-hover:text-gold transition-colors duration-500" />
                </div>
                <h3 className="text-3xl font-black text-forest mb-6 tracking-tight">Solidarité Membres</h3>
                <p className="text-zinc-500 leading-relaxed font-medium text-lg">
                   Nous avons instauré un système de prévoyance et d'aide mutuelle pour soutenir nos membres lors des moments difficiles de l'intersaison.
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
