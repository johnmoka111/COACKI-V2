"use client";

import { Coffee, Menu, X, ArrowRight, User, Building2, Handshake, Mail, Phone, MapPin } from "lucide-react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { useState, useEffect } from "react";

export default function Navbar() {
  const pathname = usePathname();
  const [mobileOpen, setMobileOpen] = useState(false);
  const [partnerOpen, setPartnerOpen] = useState(false);
  const [formSent, setFormSent] = useState(false);

  useEffect(() => {
    const handleOpen = () => setPartnerOpen(true);
    window.addEventListener('openPartnerModal', handleOpen);
    return () => window.removeEventListener('openPartnerModal', handleOpen);
  }, []);

  const navLinks = [
    { name: "Accueil", href: "/" },
    { name: "Notre Café", href: "/notre-cafe" },
    { name: "Processus", href: "/processus" },
    { name: "Impact", href: "/impact" },
    { name: "Carte", href: "/carte" },
    { name: "Galerie", href: "/galerie" },
    { name: "Actualités", href: "/actualites" },
    { name: "FAQ", href: "/faq" },
  ];

  const isActive = (href: string) =>
    href === "/" ? pathname === "/" : pathname.startsWith(href);

  const handlePartnerSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setFormSent(true);
    setTimeout(() => {
      setPartnerOpen(false);
      setFormSent(false);
    }, 3000);
  };

  return (
    <>
      <nav className="fixed w-full z-50 bg-white/90 backdrop-blur-xl border-b border-forest/10 shadow-sm shadow-forest/5">
        <div className="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
          {/* Logo */}
          <Link href="/" className="flex items-center gap-3 flex-shrink-0">
            <div className="h-10 w-10 bg-forest rounded-xl flex items-center justify-center shadow-lg shadow-forest/20">
              <Coffee className="text-gold h-6 w-6" />
            </div>
            <span className="font-black text-2xl tracking-tighter text-forest">COACKI</span>
          </Link>

          {/* Desktop Links */}
          <div className="hidden lg:flex items-center gap-1 text-xs font-black uppercase tracking-widest text-forest/60">
            {navLinks.map((link) => (
              <Link
                key={link.href}
                href={link.href}
                className={`px-3 py-2 rounded-lg transition-all ${
                  isActive(link.href)
                    ? "text-forest bg-forest/5 border-b-2 border-gold"
                    : "hover:text-forest hover:bg-forest/5"
                }`}
              >
                {link.name}
              </Link>
            ))}
          </div>

          {/* Right CTA */}
          <div className="hidden lg:flex items-center gap-3">
            <button
              id="btn-devenir-partenaire"
              onClick={() => setPartnerOpen(true)}
              className="border-2 border-forest/20 text-forest px-5 py-2 rounded-full text-xs font-black uppercase tracking-widest hover:border-gold hover:text-gold transition-all flex items-center gap-2"
            >
              <Handshake className="h-4 w-4" /> Partenaire
            </button>
            <Link
              href="/dashboard"
              className="bg-forest text-gold px-6 py-2.5 rounded-full text-sm font-black shadow-lg shadow-forest/20 hover:scale-105 transition-transform"
            >
              Espace Membres
            </Link>
          </div>

          {/* Mobile hamburger */}
          <button
            id="mobile-menu-toggle"
            className="lg:hidden p-2 rounded-xl hover:bg-forest/5 transition-colors"
            onClick={() => setMobileOpen(!mobileOpen)}
            aria-label="Menu"
          >
            {mobileOpen ? (
              <X className="h-6 w-6 text-forest" />
            ) : (
              <Menu className="h-6 w-6 text-forest" />
            )}
          </button>
        </div>

        {/* Mobile Menu Dropdown */}
        <div
          className={`lg:hidden absolute top-full left-0 w-full overflow-hidden transition-all duration-300 shadow-xl ${
            mobileOpen ? "max-h-[80vh] opacity-100" : "max-h-0 opacity-0"
          } bg-white border-b border-forest/10 flex flex-col`}
        >
          <div className="px-6 py-6 space-y-1 overflow-y-auto">
            {navLinks.map((link) => (
              <Link
                key={link.href}
                href={link.href}
                onClick={() => setMobileOpen(false)}
                className={`flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-black uppercase tracking-widest transition-all ${
                  isActive(link.href)
                    ? "bg-forest text-gold"
                    : "text-forest/70 hover:bg-forest/5 hover:text-forest"
                }`}
              >
                {link.name}
                {isActive(link.href) && <ArrowRight className="h-4 w-4 ml-auto" />}
              </Link>
            ))}

            <div className="pt-4 border-t border-forest/10 space-y-3">
              <button
                onClick={() => { setMobileOpen(false); setPartnerOpen(true); }}
                className="w-full flex items-center justify-center gap-2 border-2 border-forest/20 text-forest px-6 py-3.5 rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-forest hover:text-gold transition-all"
              >
                <Handshake className="h-4 w-4" /> Devenir Partenaire
              </button>
              <Link
                href="/dashboard"
                onClick={() => setMobileOpen(false)}
                className="flex items-center justify-center gap-2 bg-forest text-gold px-6 py-3.5 rounded-2xl text-sm font-black uppercase tracking-widest shadow-lg shadow-forest/20"
              >
                <User className="h-4 w-4" /> Espace Membres
              </Link>
            </div>
          </div>
        </div>
      </nav>

      {/* Mobile overlay */}
      {mobileOpen && (
        <div
          className="fixed inset-0 z-40 bg-forest/40 backdrop-blur-sm lg:hidden transition-opacity"
          onClick={() => setMobileOpen(false)}
        />
      )}

      {/* Partner Modal */}
      {partnerOpen && (
        <div className="fixed inset-0 z-[200] flex items-center justify-center p-4">
          <div
            className="absolute inset-0 bg-forest/80 backdrop-blur-xl"
            onClick={() => { setPartnerOpen(false); setFormSent(false); }}
          />
          <div className="relative bg-white rounded-[40px] shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            {/* Header */}
            <div className="bg-forest p-10 relative overflow-hidden">
              <div className="absolute -bottom-8 -right-8 h-40 w-40 bg-gold/20 rounded-full blur-2xl" />
              <div className="relative z-10">
                <div className="h-14 w-14 bg-gold/20 rounded-2xl flex items-center justify-center mb-6">
                  <Handshake className="h-7 w-7 text-gold" />
                </div>
                <h2 className="text-4xl font-black text-white tracking-tighter mb-2">
                  Devenir Partenaire
                </h2>
                <p className="text-white/70 font-medium">
                  Rejoignez notre réseau de partenaires engagés pour le café de qualité du Kivu.
                </p>
              </div>
              <button
                onClick={() => { setPartnerOpen(false); setFormSent(false); }}
                className="absolute top-6 right-6 h-10 w-10 bg-white/10 hover:bg-gold hover:text-forest text-white rounded-full flex items-center justify-center transition-all"
              >
                <X className="h-5 w-5" />
              </button>
            </div>

            {/* Form */}
            <div className="p-10">
              {formSent ? (
                <div className="text-center py-12 space-y-6">
                  <div className="h-20 w-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto">
                    <svg className="h-10 w-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <div>
                    <h3 className="text-2xl font-black text-forest tracking-tighter">Message envoyé !</h3>
                    <p className="text-zinc-500 font-medium mt-2">
                      Merci pour votre intérêt. Notre équipe vous contactera dans les 48h.
                    </p>
                  </div>
                </div>
              ) : (
                <form onSubmit={handlePartnerSubmit} className="space-y-5">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div className="space-y-2">
                      <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                        Nom complet *
                      </label>
                      <div className="relative">
                        <User className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/40" />
                        <input
                          name="nom"
                          required
                          placeholder="Fleming Cizungu"
                          className="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 focus:border-gold/50 outline-none transition-all"
                        />
                      </div>
                    </div>
                    <div className="space-y-2">
                      <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                        Organisation
                      </label>
                      <div className="relative">
                        <Building2 className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/40" />
                        <input
                          name="organisation"
                          placeholder="Nom de votre entreprise"
                          className="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 outline-none transition-all"
                        />
                      </div>
                    </div>
                  </div>

                  <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div className="space-y-2">
                      <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                        Email *
                      </label>
                      <div className="relative">
                        <Mail className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/40" />
                        <input
                          name="email"
                          type="email"
                          required
                          placeholder="vous@exemple.com"
                          className="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 outline-none transition-all"
                        />
                      </div>
                    </div>
                    <div className="space-y-2">
                      <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                        Téléphone
                      </label>
                      <div className="relative">
                        <Phone className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-forest/40" />
                        <input
                          name="telephone"
                          type="tel"
                          placeholder="+243 XXX XXX XXX"
                          className="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 outline-none transition-all"
                        />
                      </div>
                    </div>
                  </div>

                  <div className="space-y-2">
                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                      Type de partenariat *
                    </label>
                    <select
                      name="type"
                      required
                      className="w-full bg-coacki-bg border border-forest/10 rounded-2xl px-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 outline-none transition-all"
                    >
                      <option value="">Sélectionnez un type...</option>
                      <option value="torrefacteur">Torréfacteur / Importateur</option>
                      <option value="distributeur">Distributeur / Grossiste</option>
                      <option value="investisseur">Investisseur / Bailleur</option>
                      <option value="ong">ONG / Organisation</option>
                      <option value="autre">Autre collaboration</option>
                    </select>
                  </div>

                  <div className="space-y-2">
                    <label className="text-[10px] font-black text-zinc-400 uppercase tracking-widest">
                      Votre message *
                    </label>
                    <div className="relative">
                      <MapPin className="absolute left-4 top-4 h-4 w-4 text-forest/40" />
                      <textarea
                        name="message"
                        required
                        rows={4}
                        placeholder="Expliquez votre projet de partenariat, vos besoins en café, vos volumes estimés..."
                        className="w-full bg-coacki-bg border border-forest/10 rounded-2xl pl-11 pr-4 py-3.5 text-sm font-medium text-forest focus:ring-2 focus:ring-gold/30 outline-none transition-all resize-none"
                      />
                    </div>
                  </div>

                  <button
                    type="submit"
                    className="w-full bg-forest text-gold py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-forest/20 hover:bg-forest/90 active:scale-95 transition-all flex items-center justify-center gap-3"
                  >
                    Envoyer ma demande <ArrowRight className="h-5 w-5" />
                  </button>

                  <p className="text-center text-xs text-zinc-400 font-medium">
                    En soumettant ce formulaire, vous acceptez que COACKI conserve vos données pour repondre à votre demande.
                  </p>
                </form>
              )}
            </div>
          </div>
        </div>
      )}
    </>
  );
}
