"use client";

import { useEffect, useState } from "react";
import { MapContainer, TileLayer, Marker, Popup, useMap, useMapEvents, LayersControl } from "react-leaflet";
import L from "leaflet";
import "leaflet/dist/leaflet.css";

// Fix Leaflet icon issue
const DefaultIcon = L.icon({
  iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
  shadowUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
  iconSize: [25, 41],
  iconAnchor: [12, 41],
});

const StationIcon = L.icon({
    iconUrl: "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
    shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

const HQIcon = L.icon({
    iconUrl: "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png",
    shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
    iconSize: [35, 56],
    iconAnchor: [17, 56],
    popupAnchor: [1, -40],
    shadowSize: [56, 56]
});

const ParcelleIcon = L.icon({
    iconUrl: "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png",
    shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

L.Marker.prototype.options.icon = DefaultIcon;

interface MapProps {
    onCoordsSelect?: (lat: number, lng: number) => void;
    center?: [number, number];
    zoom?: number;
}

function MapEvents({ onCoordsSelect }: MapProps) {
    useMapEvents({
        click(e) {
            onCoordsSelect?.(e.latlng.lat, e.latlng.lng);
        },
    });
    return null;
}

function ChangeView({ center, zoom }: { center: [number, number]; zoom: number }) {
    const map = useMap();
    useEffect(() => {
        map.setView(center, zoom);
    }, [center, zoom, map]);
    return null;
}

export default function Map({ onCoordsSelect, center: initialCenter, zoom: initialZoom }: MapProps) {
  const [data, setData] = useState<any>(null);
  const [center, setCenter] = useState<[number, number]>(initialCenter || [-2.041538, 28.970495]);
  const [zoom, setZoom] = useState(initialZoom || 14);

  useEffect(() => {
    if (initialCenter) setCenter(initialCenter);
    if (initialZoom) setZoom(initialZoom);
  }, [initialCenter, initialZoom]);

  useEffect(() => {
    fetch("/api/locations")
      .then((res) => res.json())
      .then((data) => {
        setData(data);
      });
  }, []);

  const flyTo = (coords: [number, number], z: number) => {
    setCenter(coords);
    setZoom(z);
  };

  return (
    <div className="h-full w-full rounded-3xl overflow-hidden shadow-2xl border border-zinc-200 dark:border-zinc-800 transition-all duration-500 hover:shadow-primary/20 relative group/map">
      {/* Story Mapping Controls */}
      <div className="absolute top-4 left-1/2 -translate-x-1/2 z-[1000] flex gap-2 bg-white/90 dark:bg-zinc-900/90 backdrop-blur-md p-2 rounded-2xl border border-white/20 shadow-2xl opacity-0 group-hover/map:opacity-100 transition-opacity duration-300">
          {[
              { label: "Munanira (Village)", coords: [-2.041538, 28.970495], zoom: 16 },
              { label: "Hauts Plateaux (2000m)", coords: [-2.035, 28.975], zoom: 15 },
              { label: "Station Lavage", coords: [-2.041538, 28.970495], zoom: 17 }
          ].map((step, i) => (
              <button 
                key={i}
                onClick={() => flyTo(step.coords as [number, number], step.zoom)}
                className="px-4 py-2 text-[10px] font-black uppercase tracking-tighter text-zinc-600 dark:text-zinc-300 hover:bg-blue-600 hover:text-white rounded-xl transition-all"
              >
                  {step.label}
              </button>
          ))}
      </div>

      <MapContainer
        center={center}
        zoom={zoom}
        scrollWheelZoom={true}
        className="h-full w-full"
      >
        <ChangeView center={center} zoom={zoom} />
        <MapEvents onCoordsSelect={onCoordsSelect} />
        
        <LayersControl position="topright">
            <LayersControl.BaseLayer checked name="Simple">
                <TileLayer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    attribution='&copy; OpenStreetMap'
                />
            </LayersControl.BaseLayer>
            <LayersControl.BaseLayer name="Satellite">
                <TileLayer
                    url="https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}"
                    attribution='Esri'
                />
            </LayersControl.BaseLayer>
        </LayersControl>

        {data?.features?.map((feature: any) => (
          <Marker
            key={feature.id}
            position={[feature.geometry.coordinates[1], feature.geometry.coordinates[0]]}
            icon={
                feature.properties.type === "station" 
                ? (feature.properties.name?.includes("COACKI") ? HQIcon : StationIcon) 
                : ParcelleIcon
            }
          >
            <Popup className="premium-popup">
              <div className="p-2 min-w-[200px]">
                <h3 className="text-lg font-bold text-zinc-900 dark:text-zinc-100 flex items-center gap-2">
                    {feature.properties.type === "station" ? "☕ Station de Lavage" : "🌱 Parcelle Caféière"}
                </h3>
                <p className="text-sm font-semibold mt-1 text-blue-500">
                    {feature.properties.type === "station" ? feature.properties.name : feature.properties.producer}
                </p>
                <div className="mt-3 space-y-1 text-xs text-zinc-500">
                    {feature.properties.type === "parcelle" && (
                        <>
                            <div className="flex justify-between">
                                <span>Altitude:</span>
                                <span className="font-mono">{feature.properties.altitude}m</span>
                            </div>
                            <div className="flex justify-between">
                                <span>Nombre de pieds:</span>
                                <span className="font-mono">{feature.properties.nbPieds}</span>
                            </div>
                        </>
                    )}
                    {feature.properties.type === "station" && (
                        <div className="flex justify-between">
                            <span>Village:</span>
                            <span className="font-mono">Munanira</span>
                        </div>
                    )}
                </div>
              </div>
            </Popup>
          </Marker>
        ))}
      </MapContainer>

      {/* Map Tip */}
      <div className="absolute bottom-4 left-4 z-[1000] bg-white/90 dark:bg-zinc-900/90 backdrop-blur-md p-3 rounded-2xl border border-white/20 shadow-lg pointer-events-none">
          <p className="text-[10px] font-black uppercase text-zinc-400">Astuce</p>
          <p className="text-[10px] font-bold text-zinc-600 dark:text-zinc-300">Cliquez sur la carte pour sélectionner des coordonnées</p>
      </div>
    </div>
  );
}
