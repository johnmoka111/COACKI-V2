import { NextResponse } from "next/server";
import prisma from "@/lib/prisma";

export async function POST(req: Request) {
  try {
    const body = await req.json();
    const { lat, lng, nom, localisation } = body;

    if (!lat || !lng || !nom) {
      return NextResponse.json({ error: "Missing required fields" }, { status: 400 });
    }

    const station = await prisma.stationLavage.create({
      data: {
        lat: parseFloat(lat),
        lng: parseFloat(lng),
        nom,
        localisation: localisation || "Kalehe",
      },
    });

    return NextResponse.json(station, { status: 201 });
  } catch (error) {
    console.error("API error:", error);
    return NextResponse.json({ error: "Failed to create station" }, { status: 500 });
  }
}
