"use client";

import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Search, Filter, Maximize2, X, Camera } from "lucide-react";

interface GalleryItem {
  id: string;
  url: string;
  title: string;
  description: string;
  category: string;
}

export default function Galerie() {
  const [items, setItems] = useState<GalleryItem[]>([]);
  const [filteredItems, setFilteredItems] = useState<GalleryItem[]>([]);
  const [activeCategory, setActiveCategory] = useState("Tous");
  const [selectedImage, setSelectedImage] = useState<GalleryItem | null>(null);
  const [searchQuery, setSearchQuery] = useState("");

  const categories = ["Tous", "Terroir", "Récolte", "Station", "Membres"];

  useEffect(() => {
    fetch("/api/gallery")
      .then((res) => res.json())
      .then((data) => {
        setItems(data);
        setFilteredItems(data);
      });
  }, []);

  useEffect(() => {
    let result = items;
    if (activeCategory !== "Tous") {
      result = result.filter((item) => item.category === activeCategory);
    }
    if (searchQuery) {
      result = result.filter(
        (item) =>
          item.title?.toLowerCase().includes(searchQuery.toLowerCase()) ||
          item.description?.toLowerCase().includes(searchQuery.toLowerCase())
      );
    }
    setFilteredItems(result);
  }, [activeCategory, searchQuery, items]);

  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      <main className="pt-20">
        <section className="py-24 md:py-32">
          <div className="max-w-7xl mx-auto px-6">
            <div className="text-center space-y-6 mb-20">
              <div className="h-16 w-16 bg-forest/5 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <Camera className="text-forest h-10 w-10 text-gold" />
              </div>
              <h4 className="text-gold font-black uppercase text-xs tracking-widest">Vision COACKI</h4>
              <h1 className="text-6xl lg:text-8xl font-black text-forest tracking-tighter leading-none">Galerie <span className="text-gold">Munanira</span></h1>
              <p className="text-zinc-500 text-xl font-medium max-w-2xl mx-auto">
                Immersion visuelle dans notre quotidien, de la floraison des caféiers Bourbon jusqu'à la station de lavage.
              </p>
            </div>

            {/* Filters */}
            <div className="flex flex-col md:flex-row items-center justify-between gap-8 mb-16 bg-white p-6 md:p-10 rounded-[40px] shadow-sm border border-forest/5">
              <div className="flex flex-wrap justify-center gap-3">
                {categories.map((cat) => (
                  <button
                    key={cat}
                    onClick={() => setActiveCategory(cat)}
                    className={`px-8 py-3 rounded-full text-sm font-black uppercase tracking-widest transition-all ${
                      activeCategory === cat
                        ? "bg-forest text-gold shadow-xl shadow-forest/20"
                        : "bg-forest/5 text-forest hover:bg-forest/10"
                    }`}
                  >
                    {cat}
                  </button>
                ))}
              </div>
              
              <div className="relative w-full md:max-w-md">
                <Search className="absolute left-6 top-1/2 -translate-y-1/2 h-5 w-5 text-forest/40" />
                <input
                  type="text"
                  placeholder="Rechercher une image..."
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                  className="w-full bg-forest/5 border-none rounded-full pl-14 pr-8 py-4 text-sm font-bold text-forest focus:ring-4 focus:ring-gold/20 outline-none transition-all"
                />
              </div>
            </div>

            {/* Grid */}
            <motion.div 
              layout
              className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10"
            >
              <AnimatePresence>
                {filteredItems.map((item) => (
                  <motion.div
                    layout
                    key={item.id}
                    initial={{ opacity: 0, scale: 0.9 }}
                    animate={{ opacity: 1, scale: 1 }}
                    exit={{ opacity: 0, scale: 0.9 }}
                    whileHover={{ y: -10 }}
                    transition={{ duration: 0.5 }}
                    className="group relative h-[450px] rounded-[48px] overflow-hidden shadow-xl cursor-pointer"
                    onClick={() => setSelectedImage(item)}
                  >
                    <img
                      src={item.url}
                      alt={item.title}
                      className="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-forest/90 via-forest/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500" />
                    <div className="absolute inset-0 p-12 flex flex-col justify-end translate-y-2 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                      <span className="text-gold font-black uppercase text-[10px] tracking-[0.3em] mb-4">
                        {item.category}
                      </span>
                      <h3 className="text-3xl font-black text-white tracking-tighter mb-4 leading-tight">
                        {item.title}
                      </h3>
                      <p className="text-white/70 text-sm font-medium leading-relaxed mb-6 line-clamp-2">
                        {item.description}
                      </p>
                      <button className="flex items-center gap-2 text-gold font-black uppercase text-xs tracking-widest hover:text-white transition-colors">
                        <Maximize2 className="h-4 w-4" /> Agrandir focus
                      </button>
                    </div>
                  </motion.div>
                ))}
              </AnimatePresence>
            </motion.div>

            {filteredItems.length === 0 && (
              <div className="text-center py-40 bg-white rounded-[48px] border border-dashed border-forest/10">
                <p className="text-forest/40 font-black uppercase tracking-widest text-lg">
                  Aucune image trouvée
                </p>
              </div>
            )}
          </div>
        </section>
      </main>

      {/* Lightbox */}
      <AnimatePresence>
        {selectedImage && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-[100] flex items-center justify-center p-6 md:p-20 bg-forest/95 backdrop-blur-2xl"
            onClick={() => setSelectedImage(null)}
          >
            <button 
              className="absolute top-10 right-10 h-16 w-16 bg-white/10 hover:bg-gold text-white hover:text-forest rounded-full flex items-center justify-center transition-all z-[110]"
              onClick={() => setSelectedImage(null)}
            >
              <X size={32} />
            </button>
            <motion.div
              initial={{ scale: 0.9, y: 50 }}
              animate={{ scale: 1, y: 0 }}
              exit={{ scale: 0.9, y: 50 }}
              className="relative max-w-6xl w-full aspect-video rounded-[32px] md:rounded-[64px] overflow-hidden shadow-2xl border-4 md:border-8 border-white/10"
              onClick={(e) => e.stopPropagation()}
            >
              <img
                src={selectedImage.url}
                alt={selectedImage.title}
                className="w-full h-full object-cover"
              />
              <div className="absolute bottom-0 inset-x-0 p-8 md:p-20 bg-gradient-to-t from-forest via-forest/40 to-transparent">
                <span className="text-gold font-black uppercase text-xs tracking-[0.4em] mb-4 block">
                  {selectedImage.category}
                </span>
                <h2 className="text-4xl md:text-6xl font-black text-white tracking-tighter mb-4 leading-none">
                  {selectedImage.title}
                </h2>
                <p className="text-white/70 text-lg md:text-xl font-medium max-w-3xl">
                  {selectedImage.description}
                </p>
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
      <Footer />
    </div>
  );
}
