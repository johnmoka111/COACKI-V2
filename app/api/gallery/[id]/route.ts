import { NextResponse } from "next/server";
import prisma from "@/lib/prisma";

export async function DELETE(
  request: Request,
  { params }: { params: Promise<{ id: string }> }
) {
  try {
    const { id } = await params;
    await prisma.galleryItem.delete({
      where: { id },
    });
    return NextResponse.json({ message: "Gallery item deleted" });
  } catch (error) {
    console.error("Gallery DELETE error:", error);
    return NextResponse.json({ error: "Failed to delete gallery item" }, { status: 500 });
  }
}

export async function PUT(
  request: Request,
  { params }: { params: Promise<{ id: string }> }
) {
  try {
    const { id } = await params;
    const body = await request.json();
    const updated = await prisma.galleryItem.update({
      where: { id },
      data: {
        title: body.title,
        description: body.description,
        category: body.category,
        url: body.url,
      },
    });
    return NextResponse.json(updated);
  } catch (error) {
    console.error("Gallery PUT error:", error);
    return NextResponse.json({ error: "Failed to update gallery item" }, { status: 500 });
  }
}
