"use client";

import dynamic from "next/dynamic";
import { MapPin } from "lucide-react";

const Map = dynamic(() => import("./Map"), {
  ssr: false,
  loading: () => (
    <div className="h-[500px] w-full bg-zinc-100 dark:bg-zinc-900 animate-pulse rounded-3xl flex items-center justify-center">
      <div className="flex flex-col items-center gap-4">
        <MapPin className="h-8 w-8 text-forest animate-bounce" />
        <span className="text-zinc-500 font-medium">Localisation de Munanira...</span>
      </div>
    </div>
  ),
});

export default function MapWrapper() {
  return <Map />;
}
