import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { actualites } from "@/lib/newsData";
import { Calendar, ArrowRight, Rss, ArrowLeft } from "lucide-react";
import Link from "next/link";
import { notFound } from "next/navigation";

export async function generateMetadata({ params }: { params: Promise<{ id: string }> }) {
  const { id } = await params;
  const article = actualites.find((a) => a.id.toString() === id);
  if (!article) return { title: "Article Introuvable | COACKI" };
  return {
    title: `${article.title} - COACKI`,
    description: article.excerpt,
  };
}

export default async function ArticleDetail({ params }: { params: Promise<{ id: string }> }) {
  const { id } = await params;
  const article = actualites.find((a) => a.id.toString() === id);

  if (!article) {
    notFound();
  }

  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      
      <main className="pt-32 pb-24">
        <article className="max-w-4xl mx-auto px-6">
          <Link href="/actualites" className="inline-flex items-center gap-2 text-forest/60 hover:text-forest font-black text-xs uppercase tracking-widest transition-colors mb-12">
            <ArrowLeft className="h-4 w-4" /> Retour aux actualités
          </Link>

          <header className="space-y-8 mb-12">
            <div className="flex flex-wrap items-center gap-4 text-xs font-bold text-zinc-500">
              <span className="px-4 py-2 bg-forest/5 text-forest border border-forest/10 rounded-full uppercase tracking-widest bg-emerald-50 text-emerald-700 border-emerald-200">
                {article.category}
              </span>
              <div className="flex items-center gap-2">
                <Calendar className="h-4 w-4" /> {article.date}
              </div>
              <div className="flex items-center gap-2">
                <Rss className="h-4 w-4" /> {article.readTime} de lecture
              </div>
            </div>

            <h1 className="text-4xl md:text-6xl font-black text-forest tracking-tighter leading-tight">
              {article.title}
            </h1>

            <div className="flex items-center gap-3 pt-4">
              <div className="h-12 w-12 rounded-full bg-forest flex items-center justify-center text-gold font-black text-lg">
                {article.author.charAt(0)}
              </div>
              <div>
                <p className="text-sm font-black text-forest">{article.author}</p>
                <p className="text-xs font-bold text-zinc-400">Auteur de l'article</p>
              </div>
            </div>
          </header>

          <div className="relative h-[400px] md:h-[600px] rounded-[40px] overflow-hidden mb-16 shadow-2xl">
            <img 
              src={article.image} 
              alt={article.title} 
              className="w-full h-full object-cover"
            />
          </div>

          <div className="prose prose-lg md:prose-xl max-w-none text-zinc-600 font-medium leading-relaxed">
            {article.content.split('\n\n').map((paragraph, i) => (
              <p key={i} className="mb-6">{paragraph}</p>
            ))}
          </div>

          <div className="mt-20 p-12 bg-gold/10 rounded-[32px] border border-gold/20 text-center space-y-6">
            <h3 className="text-2xl font-black text-forest">Vous aimez notre démarche ?</h3>
            <p className="text-forest/70 font-medium">Partagez l'excellence de la coopérative COACKI autour de vous et rejoignez notre aventure.</p>
            <div className="flex justify-center gap-4">
              <Link href="/galerie" className="bg-forest text-gold px-8 py-4 rounded-full font-black text-xs uppercase tracking-widest shadow-xl hover:scale-105 transition-transform">
                Photos de notre activité
              </Link>
            </div>
          </div>
        </article>
      </main>

      <Footer />
    </div>
  );
}
