"use client";

import { Coffee, Mail, Phone } from "lucide-react";

export default function Footer() {
  return (
    <footer className="bg-white dark:bg-zinc-950 pt-32 pb-12 border-t border-forest/10">
      <div className="max-w-7xl mx-auto px-6">
        <div className="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-12 mb-20">
          <div className="space-y-8">
            <div className="flex items-center gap-3">
              <div className="h-10 w-10 bg-forest rounded-lg flex items-center justify-center">
                <Coffee className="text-gold h-6 w-6" />
              </div>
              <span className="font-black text-2xl tracking-tighter text-forest">COACKI</span>
            </div>
            <p className="text-zinc-500 text-sm font-medium leading-relaxed">
              Coopérative d'excellence au Sud-Kivu, unissant les petits producteurs pour un café durable et de qualité supérieure.
            </p>
            <div className="flex gap-4">
              <div className="h-10 w-10 rounded-full border border-forest/20 flex items-center justify-center text-forest hover:bg-forest hover:text-white transition-all cursor-pointer"><Mail size={18} /></div>
              <div className="h-10 w-10 rounded-full border border-forest/20 flex items-center justify-center text-forest hover:bg-forest hover:text-white transition-all cursor-pointer"><Phone size={18} /></div>
            </div>
          </div>

          <div className="space-y-8">
            <h4 className="font-black text-forest uppercase text-xs tracking-widest">Abonnez-vous à notre Journal</h4>
            <p className="text-zinc-500 text-sm font-medium">Recevez les nouvelles de la récolte et l'impact de COACKI directement dans votre boîte mail.</p>
            <form className="flex flex-col gap-3" onSubmit={(e) => e.preventDefault()}>
              <input type="email" placeholder="Votre email" className="bg-coacki-bg border border-forest/10 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gold/20 outline-none transition-all" />
              <button className="bg-forest text-gold py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:opacity-90 transition-opacity">
                S'abonner
              </button>
            </form>
          </div>

          <div className="space-y-6">
            <h4 className="font-black text-forest uppercase text-xs tracking-widest">Informations juridiques de la COACKI</h4>
            <div className="space-y-3 text-sm text-zinc-500 font-bold">
              <div className="flex justify-between border-b border-forest/5 pb-2">
                <span>N° Juridique</span>
                <span className="text-forest text-right">CD/SK/RSC/24-B-0045</span>
              </div>
              <div className="flex justify-between border-b border-forest/5 pb-2">
                <span>N° ID.NAT</span>
                <span className="text-forest text-right">22-A0101-N49017J</span>
              </div>
              <div className="flex justify-between border-b border-forest/5 pb-2">
                <span>RCCM</span>
                <span className="text-forest text-right">CD/BKV/RCCM/24-G-00012</span>
              </div>
              <div className="flex justify-between border-b border-forest/5 pb-2">
                <span>N° Impôt</span>
                <span className="text-forest text-right">A24200367Q</span>
              </div>
              <div className="flex justify-between border-b border-forest/5 pb-2">
                <span>Compte SMICO</span>
                <span className="text-forest text-right">BK015432</span>
              </div>
              <div className="flex justify-between border-b border-forest/5 pb-2">
                <span>Compte Bank</span>
                <span className="text-forest text-right">655200138927337<br/><span className="text-xs">(EQUITY)</span></span>
              </div>
            </div>
          </div>

          <div className="space-y-8">
            <h4 className="font-black text-forest uppercase text-xs tracking-widest">Contact & Direction</h4>
            <div className="p-6 bg-coacki-bg rounded-2xl border border-forest/10 space-y-4">
              <div>
                <span className="text-xs font-black uppercase text-gold tracking-tight lowercase">Gérant</span>
                <p className="text-forest font-black text-lg">Fleming CIZUNGU BAKULIKIRA</p>
              </div>
              <div className="flex items-center gap-2 text-zinc-500 text-sm font-bold">
                <Mail size={14} className="text-gold" /> coackicoop@gmail.com
              </div>
              <div className="flex items-center gap-2 text-zinc-500 text-sm font-bold">
                <Phone size={14} className="text-gold" /> +243 971 234 567
              </div>
            </div>
          </div>
        </div>
        
        <div className="pt-12 border-t border-forest/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-black text-forest/40 uppercase tracking-[0.2em]">
          <span>&copy; 2026 COACKI Coopérative. Tous droits réservés.</span>
          <div className="flex gap-8">
            <span>Politique de Confidentialité</span>
            <span>Mentions Légales</span>
          </div>
        </div>
      </div>
    </footer>
  );
}
