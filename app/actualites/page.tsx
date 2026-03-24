"use client";

import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Calendar, Tag, ArrowRight, Newspaper, Rss } from "lucide-react";
import Link from "next/link";
import { actualites } from "@/lib/newsData";

const categories = ["Toutes", "Récolte", "Femmes", "Infrastructure", "Export", "Formation", "Qualité"];

const categoryColors: Record<string, string> = {
  Récolte: "bg-emerald-50 text-emerald-700 border-emerald-200",
  Femmes: "bg-pink-50 text-pink-700 border-pink-200",
  Infrastructure: "bg-blue-50 text-blue-700 border-blue-200",
  Export: "bg-amber-50 text-amber-700 border-amber-200",
  Formation: "bg-purple-50 text-purple-700 border-purple-200",
  Qualité: "bg-gold/10 text-forest border-gold/30",
};

export default function Actualites() {
  const [activeCategory, setActiveCategory] = useState("Toutes");

  const filtered =
    activeCategory === "Toutes"
      ? actualites
      : actualites.filter((a) => a.category === activeCategory);

  const featured = filtered.find((a) => a.featured) ?? filtered[0];
  const others = filtered.filter((a) => a.id !== featured?.id);

  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      <main className="pt-20">
        {/* Hero */}
        <section className="py-24 bg-white border-b border-forest/5">
          <div className="max-w-7xl mx-auto px-6">
            <div className="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-16">
              <div className="space-y-6">
                <div className="h-16 w-16 bg-forest/5 rounded-2xl flex items-center justify-center">
                  <Newspaper className="h-8 w-8 text-forest" />
                </div>
                <div>
                  <h4 className="text-gold font-black uppercase text-xs tracking-widest mb-3">
                    Vie de la Coopérative
                  </h4>
                  <h1 className="text-6xl lg:text-7xl font-black text-forest tracking-tighter leading-none">
                    Actualités <span className="text-gold">COACKI</span>
                  </h1>
                </div>
              </div>
              <p className="text-zinc-500 text-lg font-medium max-w-sm leading-relaxed">
                Suivez notre parcours : récoltes, partenariats, impact social et les dernières nouvelles de Munanira.
              </p>
            </div>

            {/* Category Filter */}
            <div className="flex flex-wrap gap-3">
              {categories.map((cat) => (
                <button
                  key={cat}
                  onClick={() => setActiveCategory(cat)}
                  className={`px-6 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border transition-all ${
                    activeCategory === cat
                      ? "bg-forest text-gold border-forest shadow-lg shadow-forest/20"
                      : "bg-white text-forest/60 border-forest/10 hover:border-forest/30 hover:text-forest"
                  }`}
                >
                  {cat}
                </button>
              ))}
            </div>
          </div>
        </section>

        {/* Content */}
        <section className="py-20">
          <div className="max-w-7xl mx-auto px-6 space-y-16">
            <AnimatePresence mode="wait">
              {featured && (
                <motion.div
                  key={featured.id + "-featured"}
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  exit={{ opacity: 0, y: -20 }}
                  transition={{ duration: 0.4 }}
                  className="grid grid-cols-1 lg:grid-cols-2 gap-10 bg-white rounded-[48px] overflow-hidden border border-forest/5 shadow-xl shadow-forest/5 group"
                >
                  <div className="relative h-[400px] lg:h-auto overflow-hidden">
                    <img
                      src={featured.image}
                      alt={featured.title}
                      className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-forest/60 to-transparent" />
                    <span className="absolute top-6 left-6 px-4 py-2 bg-gold text-forest text-xs font-black uppercase tracking-widest rounded-full shadow-lg">
                      À la Une
                    </span>
                  </div>
                  <div className="p-12 flex flex-col justify-center space-y-8">
                    <div className="flex items-center gap-3 flex-wrap">
                      <span className={`px-3 py-1 rounded-full text-xs font-black border ${categoryColors[featured.category] ?? "bg-forest/5 text-forest border-forest/10"}`}>
                        {featured.category}
                      </span>
                      <div className="flex items-center gap-2 text-zinc-400 text-xs font-bold">
                        <Calendar className="h-3 w-3" /> {featured.date}
                      </div>
                      <div className="flex items-center gap-1 text-zinc-400 text-xs font-bold">
                        <Rss className="h-3 w-3" /> {featured.readTime} de lecture
                      </div>
                    </div>
                    <div>
                      <h2 className="text-3xl lg:text-4xl font-black text-forest tracking-tighter leading-tight mb-6">
                        {featured.title}
                      </h2>
                      <p className="text-zinc-500 font-medium leading-relaxed text-lg">
                        {featured.excerpt}
                      </p>
                    </div>
                    <div className="flex items-center justify-between pt-6 border-t border-forest/5">
                      <div className="flex items-center gap-3">
                        <div className="h-10 w-10 rounded-full bg-forest flex items-center justify-center text-gold font-black text-sm">
                          {featured.author.charAt(0)}
                        </div>
                        <span className="text-sm font-bold text-forest">{featured.author}</span>
                      </div>
                      <Link href={`/actualites/${featured.id}`} className="flex items-center gap-2 text-forest font-black text-sm uppercase tracking-widest hover:text-gold transition-colors group/btn">
                        Lire <ArrowRight className="h-4 w-4 group-hover/btn:translate-x-1 transition-transform" />
                      </Link>
                    </div>
                  </div>
                </motion.div>
              )}
            </AnimatePresence>

            {/* Grid */}
            {others.length > 0 && (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <AnimatePresence>
                  {others.map((article, i) => (
                    <motion.article
                      key={article.id}
                      initial={{ opacity: 0, y: 20 }}
                      animate={{ opacity: 1, y: 0 }}
                      exit={{ opacity: 0, scale: 0.95 }}
                      transition={{ duration: 0.4, delay: i * 0.08 }}
                      className="bg-white rounded-[36px] overflow-hidden border border-forest/5 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group flex flex-col"
                    >
                      <div className="relative h-52 overflow-hidden flex-shrink-0">
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
                    </motion.article>
                  ))}
                </AnimatePresence>
              </div>
            )}

            {filtered.length === 0 && (
              <div className="text-center py-32 bg-white rounded-[48px] border border-dashed border-forest/10">
                <Tag className="h-12 w-12 text-forest/20 mx-auto mb-4" />
                <p className="text-forest/40 font-black uppercase tracking-widest">
                  Aucun article dans cette catégorie
                </p>
              </div>
            )}

            {/* Newsletter CTA */}
            <div className="bg-forest rounded-[48px] p-12 lg:p-16 text-white text-center space-y-8 relative overflow-hidden">
              <div className="absolute -top-20 -right-20 h-60 w-60 bg-gold/10 rounded-full blur-3xl" />
              <div className="relative z-10 space-y-6">
                <div className="h-16 w-16 bg-gold/20 rounded-2xl flex items-center justify-center mx-auto">
                  <Rss className="h-8 w-8 text-gold" />
                </div>
                <h3 className="text-4xl font-black tracking-tighter">
                  Ne manquez aucune actualité
                </h3>
                <p className="text-white/70 text-lg font-medium max-w-xl mx-auto">
                  Abonnez-vous à notre newsletter pour recevoir les récoltes, partenariats et actualités de COACKI directement dans votre boîte mail.
                </p>
                <form
                  className="flex flex-col sm:flex-row gap-3 max-w-md mx-auto"
                  onSubmit={(e) => e.preventDefault()}
                >
                  <input
                    type="email"
                    placeholder="votre@email.com"
                    className="flex-1 bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-white placeholder:text-white/40 font-medium focus:ring-2 focus:ring-gold/40 outline-none transition-all"
                  />
                  <button
                    type="submit"
                    className="bg-gold text-forest px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:scale-105 transition-transform shadow-xl shadow-black/20 whitespace-nowrap"
                  >
                    S'abonner
                  </button>
                </form>
              </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}
