"use client";

import { ArrowRight } from "lucide-react";

export default function PartnerButton() {
  return (
    <button
        onClick={() => {
            window.dispatchEvent(new CustomEvent('openPartnerModal'));
        }}
        className="bg-gold text-forest px-8 py-4 rounded-full font-black flex items-center gap-2 hover:scale-105 transition-transform shadow-xl shadow-black/20"
    >
        Devenir Partenaire <ArrowRight className="h-5 w-5" />
    </button>
  );
}
