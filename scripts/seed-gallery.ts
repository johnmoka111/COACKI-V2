import { PrismaClient } from "@prisma/client";
import { PrismaBetterSqlite3 } from "@prisma/adapter-better-sqlite3";
import Database from "better-sqlite3";
import fs from "fs";
import path from "path";

const adapter = new PrismaBetterSqlite3({ url: "dev.db" });
const prisma = new PrismaClient({ adapter });

// Map filenames to categories/titles/descriptions for known images
const imageMetadata: Record<string, { title: string; description: string; category: string }> = {
  "IMG-20260323-WA0062.jpg": { title: "Vue des parcelles Munanira", description: "Panorama du terroir volcanique COACKI à 1600m d'altitude dans le groupement Mbinga-Sud.", category: "Terroir" },
  "IMG-20260323-WA0063.jpg": { title: "Floraison des caféiers Bourbon", description: "Caféiers Bourbon en pleine floraison, couverts de fleurs blanches au parfum de jasmin.", category: "Terroir" },
  "IMG-20260323-WA0064.jpg": { title: "Récolte manuelle des cerises", description: "Nos membres sélectionnent à la main uniquement les cerises rouges à maturité optimale.", category: "Récolte" },
  "IMG-20260323-WA0065.jpg": { title: "Cerises Bourbon rouges", description: "Closeup sur les cerises de café Bourbon 100% sélectionnées pour la qualité premium.", category: "Récolte" },
  "IMG-20260323-WA0066.jpg": { title: "Station de lavage COACKI", description: "Notre station de lavage construite par les membres à Munanira, Kalehe, Sud-Kivu.", category: "Station" },
  "IMG-20260323-WA0067.jpg": { title: "Fermentation naturelle", description: "Bacs de fermentation naturelle contrôlée de 8 à 12 heures pour développer les arômes floraux.", category: "Station" },
  "IMG-20260323-WA0068.jpg": { title: "Séchage sur lits africains", description: "Parche mise sur lits surélevés africains pour un séchage lent et uniforme pendant 12–15 jours.", category: "Station" },
  "IMG-20260323-WA0069.jpg": { title: "Membres fondateurs COACKI", description: "Photo de groupe de nos 276 membres, dont 94 femmes leaders dans la prise de décision.", category: "Membres" },
  "IMG-20260323-WA0070.jpg": { title: "Femmes leaders COACKI", description: "Les 94 femmes membres de COACKI jouent un rôle clé dans la gestion de la coopérative.", category: "Membres" },
  "IMG-20260323-WA0071.jpg": { title: "Tri manuel des grains", description: "Tri méticuleux des grains verts pour éliminer les défauts avant ensachage et exportation.", category: "Récolte" },
  "IMG-20260323-WA0072.jpg": { title: "Terroir volcanique Kivu", description: "Le sol volcanique riche en minéraux du Sud-Kivu, fondement de la complexité aromatique de notre Bourbon.", category: "Terroir" },
};

async function seedGallery() {
  // Get existing URLs to avoid duplicates
  const existing = await prisma.galleryItem.findMany({ select: { url: true } });
  const existingUrls = new Set(existing.map((e) => e.url));

  const galleryDir = path.join(process.cwd(), "public", "images", "gallery");

  if (!fs.existsSync(galleryDir)) {
    console.error("Gallery directory not found:", galleryDir);
    process.exit(1);
  }

  const imageFiles = fs.readdirSync(galleryDir).filter((f) =>
    /\.(jpg|jpeg|png|webp|gif)$/i.test(f)
  );

  let added = 0;
  let skipped = 0;

  for (const filename of imageFiles) {
    const url = `/images/gallery/${filename}`;
    if (existingUrls.has(url)) {
      console.log(`⏭  Skipped (already in DB): ${filename}`);
      skipped++;
      continue;
    }

    const meta = imageMetadata[filename] ?? {
      title: filename.replace(/\.[^.]+$/, "").replace(/-/g, " "),
      description: "Photo du terroir et des activités de la coopérative COACKI à Munanira, Kalehe.",
      category: "Général",
    };

    await prisma.galleryItem.create({
      data: { url, title: meta.title, description: meta.description, category: meta.category },
    });

    console.log(`✅ Added: ${filename} → [${meta.category}] ${meta.title}`);
    added++;
  }

  console.log(`\n📸 Gallery seed complete: ${added} added, ${skipped} skipped.`);
}

seedGallery()
  .catch((e) => { console.error(e); process.exit(1); })
  .finally(async () => { await prisma.$disconnect(); });
