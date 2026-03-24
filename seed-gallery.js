const { PrismaClient } = require('@prisma/client');
const fs = require('fs');
const path = require('path');

const prisma = new PrismaClient();

async function main() {
  const imagesDir = path.join(__dirname, 'public/images/gallery');
  const files = fs.readdirSync(imagesDir);
  
  const entries = files.filter(f => f.endsWith('.jpg')).map(f => ({
    url: `/images/gallery/${f}`,
    title: `Coacki - ${f.split('-')[1]?.split('.')[0] || 'Café'}`,
    description: "Image de notre terroir à Kalehe.",
    category: "Terroir",
  }));
  
  console.log(`Adding ${entries.length} images...`);
  
  for (const entry of entries) {
    await prisma.galleryItem.create({
      data: entry
    });
  }
  
  console.log('Finished.');
}

main()
  .catch(e => console.error(e))
  .finally(async () => {
    await prisma.$disconnect();
  });
