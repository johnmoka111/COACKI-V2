import { NextResponse } from "next/server";
import prisma from "@/lib/prisma";

export async function GET() {
  try {
    const items = await prisma.galleryItem.findMany({
      orderBy: { createdAt: "desc" },
    });
    return NextResponse.json(items);
  } catch (error) {
    console.error("Gallery GET error:", error);
    return NextResponse.json({ error: "Failed to fetch gallery items" }, { status: 500 });
  }
}

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const newItem = await prisma.galleryItem.create({
      data: {
        url: body.url,
        title: body.title,
        description: body.description,
        category: body.category || "Général",
      },
    });
    return NextResponse.json(newItem);
  } catch (error) {
    console.error("Gallery POST error:", error);
    return NextResponse.json({ error: "Failed to create gallery item" }, { status: 500 });
  }
}
