import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import PartnerButton from "@/components/PartnerButton";
import { Coffee, MapPin, Trees, Building2, Wind, Info, Heart, Award, ArrowRight, Phone, Mail, Calendar, CheckCircle, Ship, Droplets, Rss } from "lucide-react";
import Link from "next/link";
import { actualites } from "@/lib/newsData";

export const metadata = {
  title: "COACKI - Le café est notre vie | Café du Kivu Bourbon",
  description: "Coopérative Agricole Agricole du Kivu (COACKI). Café Bourbon de haute qualité (Score 85+), impact social et développement durable à Kalehe, Sud-Kivu.",
  keywords: ["Café Kivu", "Bourbon", "COACKI", "Congo Coffee", "Kalehe", "Sud-Kivu", "Café de spécialité"],
};

const categoryColors: Record<string, string> = {
  Récolte: "bg-emerald-50 text-emerald-700 border-emerald-200",
  Femmes: "bg-pink-50 text-pink-700 border-pink-200",
  Infrastructure: "bg-blue-50 text-blue-700 border-blue-200",
};

export default function Home() {
  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      {/* Navigation */}
      <Navbar />

      {/* Hero Section */}
      <section id="hero" className="relative h-screen flex items-center pt-20 overflow-hidden">
        <div className="absolute inset-0 z-0">
          <div className="absolute inset-0 bg-gradient-to-r from-forest via-forest/80 to-transparent z-10" />
          <div className="w-full h-full bg-[url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?q=80&w=2078&auto=format&fit=crop')] bg-cover bg-center " />
        </div>
        
        <div className="relative z-20 max-w-7xl mx-auto px-6 w-full">
          <div className="max-w-2xl space-y-8 animate-in fade-in slide-in-from-left duration-1000">
            <div className="inline-flex items-center gap-2 px-4 py-2 bg-gold/20 border border-gold/30 rounded-full text-gold font-bold text-xs uppercase tracking-widest backdrop-blur-sm">
                < Award className="h-4 w-4" /> Qualité Premium Bourbon
            </div>
            <h1 className="text-7xl lg:text-8xl font-black text-white leading-[1.1] tracking-tighter">
                Le café est <span className="text-gold">notre vie</span>.
            </h1>
            <p className="text-xl text-white/80 leading-relaxed font-medium">
                Né en 2022 de la volonté de 10 membres fondateurs à <span className="text-white font-bold">Mbinga-Sud</span>, COACKI cultive l'excellence au cœur du Sud-Kivu.
            </p>
            <div className="flex flex-wrap gap-4 pt-4">
                <Link href="/galerie" className="bg-gold text-forest px-8 py-4 rounded-full font-black flex items-center gap-2 hover:bg-white transition-all shadow-xl shadow-black/20 group">
                    Découvrir nos récoltes <ArrowRight className="group-hover:translate-x-1 transition-transform" />
                </Link>
                <div className="flex -space-x-3 items-center">
                    {[1,2,3,4].map(i => (
                        <div key={i} className="h-10 w-10 rounded-full border-2 border-forest bg-zinc-200" />
                    ))}
                    <span className="ml-4 text-white/60 text-sm font-bold tracking-tight">+276 Membres Engagés</span>
                </div>
            </div>
          </div>
        </div>
      </section>

      {/* Actualités Section */}
      <section id="actualites" className="py-32 bg-white">
        <div className="max-w-7xl mx-auto px-6">
            <div className="flex flex-col md:flex-row justify-between items-end gap-8 mb-20">
                <div className="max-w-xl space-y-4">
                    <h4 className="text-gold font-black uppercase text-xs tracking-widest">Vie de la coopérative</h4>
                    <h2 className="text-5xl font-black text-forest tracking-tighter">Nos Dernières Actualités</h2>
                </div>
                <Link href="/actualites" className="inline-flex items-center gap-2 text-forest font-black text-sm uppercase tracking-widest hover:text-gold transition-colors group">
                    Toutes nos actualités <ArrowRight className="h-4 w-4 group-hover:translate-x-1 transition-transform" />
                </Link>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {actualites.slice(0, 3).map((article, i) => (
                <article
                    key={article.id}
                    className="bg-coacki-bg rounded-[36px] overflow-hidden border border-forest/5 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group flex flex-col animate-in fade-in zoom-in fill-mode-both"
                    style={{ animationDelay: `${i * 150}ms` }}
                >
                    <div className="relative h-56 overflow-hidden flex-shrink-0">
                    <img
                        src={article.image}
                        alt={article.title}
                        className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-forest/50 to-transparent" />
                    <span
                        className={`absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-black border ${
                        categoryColors[article.category] ?? "bg-white text-forest border-forest/10"
                        }`}
                    >
                        {article.category}
                    </span>
                    </div>
                    <div className="p-8 flex flex-col flex-1">
                    <div className="flex items-center gap-3 mb-5 text-zinc-400 text-xs font-bold">
                        <Calendar className="h-3 w-3" /> {article.date}
                        <span>•</span>
                        <Rss className="h-3 w-3" /> {article.readTime}
                    </div>
                    <h3 className="text-xl font-black text-forest tracking-tight leading-snug mb-4 group-hover:text-gold transition-colors flex-1">
                        {article.title}
                    </h3>
                    <p className="text-zinc-500 text-sm font-medium leading-relaxed line-clamp-3 mb-6">
                        {article.excerpt}
                    </p>
                    <div className="flex items-center justify-between pt-5 border-t border-forest/5 mt-auto">
                        <div className="flex items-center gap-2">
                            <div className="h-8 w-8 rounded-full bg-forest/10 flex items-center justify-center text-forest font-black text-xs">
                                {article.author.charAt(0)}
                            </div>
                            <span className="text-xs font-bold text-zinc-500">{article.author}</span>
                        </div>
                        <Link href={`/actualites/${article.id}`} className="flex items-center gap-1 text-forest font-black text-xs uppercase tracking-widest hover:text-gold transition-colors">
                            Lire <ArrowRight className="h-3 w-3" />
                        </Link>
                    </div>
                    </div>
                </article>
                ))}
            </div>
        </div>
      </section>

      {/* CTA Section */}
      <section id="partenaire" className="py-20 bg-gold">
        <div className="max-w-7xl mx-auto px-6">
            <div className="bg-forest rounded-[48px] p-12 lg:p-20 relative overflow-hidden shadow-2xl">
                {/* Decorative Pattern */}
                <div className="absolute top-0 right-0 w-1/3 h-full opacity-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-gold via-transparent to-transparent pointer-events-none" />
                
                <div className="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div className="space-y-8 text-white">
                        <h2 className="text-5xl lg:text-7xl font-black tracking-tighter leading-[1.1]">
                            Prêt à goûter <span className="text-gold italic">l'excellence</span> ?
                        </h2>
                        <p className="text-xl text-white/80 font-medium leading-relaxed">
                            Que vous soyez un amateur de café, un torréfacteur ou un partenaire potentiel, COACKI est ouvert à la collaboration. Ensemble, développons le Kivu.
                        </p>
                        <div className="flex flex-wrap gap-4">
                            <PartnerButton />
                            <a href="mailto:coackicoop@gmail.com" className="border-2 border-white/20 hover:border-white/40 text-white px-8 py-4 rounded-full font-black transition-colors">
                                Demander un échantillon
                            </a>
                        </div>
                    </div>
                    
                    <div className="grid grid-cols-2 gap-4">
                        <div className="p-8 bg-white/5 backdrop-blur-sm rounded-3xl border border-white/10 space-y-4">
                            <h4 className="text-gold font-black uppercase text-xs tracking-widest">Producteurs</h4>
                            <p className="text-sm text-white/60">Rejoignez nos 276 membres et bénéficiez de notre station de lavage.</p>
                        </div>
                        <div className="p-8 bg-white/5 backdrop-blur-sm rounded-3xl border border-white/10 space-y-4">
                            <h4 className="text-gold font-black uppercase text-xs tracking-widest">Qualité</h4>
                            <p className="text-sm text-white/60">Accédez à des lots Bourbon certifiés avec un score minimum de 85.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>

      {/* Footer */}
      <Footer />
    </div>
  );
}
