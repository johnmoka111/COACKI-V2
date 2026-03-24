import { PrismaClient } from "@prisma/client";
import { PrismaBetterSqlite3 } from "@prisma/adapter-better-sqlite3";
import Database from "better-sqlite3";

const adapter = new PrismaBetterSqlite3({ url: "dev.db" });

const prisma = new PrismaClient({ adapter });

async function main() {
  // Clear existing data
  await prisma.parcelle.deleteMany();
  await prisma.stationLavage.deleteMany();

  // Seed Station Lavage
  await prisma.stationLavage.create({
    data: {
      nom: "Station de Lavage COACKI - Mbinga-Sud",
      lat: -2.041538,
      lng: 28.970495,
      localisation: "Kalehe, Sud-Kivu",
    },
  });

  // Seed Parcelles
  await prisma.parcelle.createMany({
    data: [
      {
        producteur: "Jean-Marie B.",
        lat: -2.042100,
        lng: 28.971200,
        altitude: 1560,
        nbPieds: 450,
        groupement: "Mbinga-Sud",
      },
      {
        producteur: "Mama Sifa",
        lat: -2.040800,
        lng: 28.969800,
        altitude: 1585,
        nbPieds: 320,
        groupement: "Mbinga-Sud",
      },
      {
        producteur: "Justin K.",
        lat: -2.039500,
        lng: 28.972500,
        altitude: 1610,
        nbPieds: 1200,
        groupement: "Mbinga-Sud",
      },
    ],
  });

  console.log("Seed data created successfully!");
}

main()
  .catch((e) => {
    console.error(e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
