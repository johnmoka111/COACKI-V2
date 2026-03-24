import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { ArrowRight, HelpCircle, Mail, Phone, MessageSquare } from "lucide-react";

export const metadata = {
  title: "FAQ - COACKI | Questions Fréquentes",
  description: "Retrouvez les réponses aux questions les plus courantes sur notre café Bourbon, notre coopérative et nos activités au Sud-Kivu.",
};

export default function FAQ() {
  const faqs = [
    { q: "Qu'est-ce qui rend le Bourbon COACKI unique ?", a: "Notre Bourbon pousse à plus de 2000m d'altitude sur des terres volcaniques. Ce terroir, combiné à un processus de lavage méticuleux, lui confère des notes florales exceptionnelles et un score de cupping certifié de 85+." },
    { q: "Comment la coopérative soutient-elle les femmes ?", a: "COACKI compte 94 femmes parmi ses membres fondateurs et actuels. Elles occupent des postes de direction stratégique et participent activement aux décisions, favorisant l'indépendance financière et le leadership féminin à Kalehe." },
    { q: "Où se trouve précisément votre station de lavage ?", a: "Notre centre opérationnel et station de lavage sont situés au village Munanira, dans le groupement Mbinga-Sud, territoire de Kalehe, province du Sud-Kivu en République Démocratique du Congo." },
    { q: "Quelles sont vos capacités d'exportation ?", a: "Nous produisons principalement du café lavé de spécialité. Nos embarquements se font par conteneurs ou petites quantités d'échantillons, via le port de Goma, principalement entre les mois de Janvier et Juillet pour la saison principale." },
    { q: "Puis-je devenir partenaire ou distributeur ?", a: "Absolument. COACKI est ouvert aux collaborations avec les torréfacteurs, importateurs et distributeurs partageant nos valeurs de qualité et d'impact social. Contactez-nous pour recevoir nos échantillons." },
    { q: "Comment est assurée la traçabilité de votre café ?", a: "Nous utilisons un système de registre géospatial pour chaque parcelle. Chaque sac exporté possède un numéro de lot permettant de remonter jusqu'au secteur de production et à la date de traitement." },
  ];

  return (
    <div className="min-h-screen bg-coacki-bg font-sans selection:bg-gold/30">
      <Navbar />
      <main className="pt-20">
        <section className="py-32 bg-white">
          <div className="max-w-4xl mx-auto px-6">
            <div className="text-center space-y-6 mb-24 animate-in fade-in slide-in-from-top-10 duration-1000">
              <div className="h-16 w-16 bg-forest/5 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <HelpCircle className="text-forest h-10 w-10 text-gold" />
              </div>
              <h4 className="text-gold font-black uppercase text-xs tracking-widest">Aide & Information</h4>
              <h1 className="text-6xl font-black text-forest tracking-tighter leading-none">Questions Fréquentes</h1>
              <p className="text-zinc-500 text-lg font-medium">
                Tout ce que vous devez savoir sur COACKI, notre production de café Bourbon et notre impact à Kalehe.
              </p>
            </div>
            
            <div className="space-y-6">
              {faqs.map((item, i) => (
                <details key={i} className="group bg-coacki-bg rounded-[32px] overflow-hidden border border-forest/5 hover:border-forest/20 transition-all shadow-sm">
                  <summary className="flex items-center justify-between p-10 cursor-pointer list-none">
                    <h4 className="font-black text-forest text-xl tracking-tight leading-snug">{item.q}</h4>
                    <div className="h-10 w-10 rounded-full border border-forest/20 flex items-center justify-center group-open:rotate-180 group-open:bg-forest group-open:text-gold transition-all flex-shrink-0 ml-4">
                      <ArrowRight className="h-5 w-5 text-forest group-open:text-gold rotate-90" />
                    </div>
                  </summary>
                  <div className="px-10 pb-10 text-zinc-500 text-lg font-medium leading-relaxed animate-in slide-in-from-top-4 duration-300">
                    {item.a}
                  </div>
                </details>
              ))}
            </div>

            <div className="mt-24 p-12 bg-forest rounded-[48px] text-white text-center space-y-8 animate-in fade-in zoom-in duration-1000">
                <h3 className="text-4xl font-black tracking-tighter">Vous avez encore des questions ?</h3>
                <p className="text-white/70 text-lg font-medium max-w-xl mx-auto">
                    Si vous ne trouvez pas la réponse que vous cherchez, n'hésitez pas à nous contacter directement. Notre équipe vous répondra dans les plus brefs délais.
                </p>
                <div className="flex flex-wrap justify-center gap-6 pt-4">
                    <a href="mailto:coackicoop@gmail.com" className="bg-gold text-forest px-8 py-4 rounded-full font-black flex items-center gap-3 hover:scale-105 transition-transform shadow-xl shadow-black/20">
                        <Mail className="h-5 w-5" /> coackicoop@gmail.com
                    </a>
                    <a href="tel:+243971234567" className="border-2 border-white/20 hover:border-white/50 text-white px-8 py-4 rounded-full font-black flex items-center gap-3 transition-colors">
                        <Phone className="h-5 w-5" /> +243 971 234 567
                    </a>
                </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}
