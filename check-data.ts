import prisma from "./lib/prisma"

const main = async () => {
    const parcelles = await prisma.parcelle.findMany();
    const stations = await prisma.stationLavage.findMany();
    console.log("Parcelles:", parcelles.length);
    console.log("Stations:", stations.length);
    process.exit(0);
}

main();
