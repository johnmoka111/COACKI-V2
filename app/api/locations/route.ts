import { NextResponse } from "next/server";
import prisma from "@/lib/prisma";

export async function GET() {
  try {
    const parcelles = await prisma.parcelle.findMany();
    const stations = await prisma.stationLavage.findMany();

    const features = [
      ...parcelles.map((p) => ({
        type: "Feature",
        id: `parcelle-${p.id}`,
        geometry: {
          type: "Point",
          coordinates: [p.lng, p.lat],
        },
        properties: {
          id: p.id,
          type: "parcelle",
          producer: p.producteur,
          altitude: p.altitude,
          nbPieds: p.nbPieds,
          groupement: p.groupement,
        },
      })),
      ...stations.map((s) => ({
        type: "Feature",
        id: `station-${s.id}`,
        geometry: {
          type: "Point",
          coordinates: [s.lng, s.lat],
        },
        properties: {
          id: s.id,
          type: "station",
          name: s.nom,
          localisation: s.localisation,
        },
      })),
    ];

    return NextResponse.json({
      type: "FeatureCollection",
      features,
    });
  } catch (error) {
    console.error("API error:", error);
    return NextResponse.json({ error: "Failed to fetch locations" }, { status: 500 });
  }
}
