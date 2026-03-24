import { NextResponse } from "next/server";
import prisma from "@/lib/prisma";

export async function POST(req: Request) {
  try {
    const body = await req.json();
    const { lat, lng, altitude, nbPieds, producteur, groupement } = body;

    if (!lat || !lng || !producteur || !nbPieds) {
      return NextResponse.json({ error: "Missing required fields" }, { status: 400 });
    }

    const parcelle = await prisma.parcelle.create({
      data: {
        lat: parseFloat(lat),
        lng: parseFloat(lng),
        altitude: parseFloat(altitude) || 0,
        nbPieds: parseInt(nbPieds),
        producteur,
        groupement: groupement || "Inconnu",
      },
    });

    return NextResponse.json(parcelle, { status: 201 });
  } catch (error) {
    console.error("API error:", error);
    return NextResponse.json({ error: "Failed to create parcelle" }, { status: 500 });
  }
}
