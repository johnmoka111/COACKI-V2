# 🌿 COACKI - Coopérative Agricole du Kivu

[![Next.js](https://img.shields.io/badge/Next.js-15.0-black?style=for-the-badge&logo=next.js)](https://nextjs.org/)
[![Prisma](https://img.shields.io/badge/Prisma-7.5-2D3748?style=for-the-badge&logo=prisma)](https://www.prisma.io/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> **"Le café est notre vie."**

COACKI (Coopérative Agricole du Kivu) est une plateforme numérique moderne dédiée à la promotion et à la gestion de la production de café Bourbon de haute qualité au cœur du Sud-Kivu, République Démocratique du Congo.

---

## 🚀 Vision & Mission

Née en 2022 à **Mbinga-Sud**, COACKI regroupe aujourd'hui plus de **276 membres engagés**. Notre mission est de cultiver l'excellence tout en assurant un impact social positif et un développement durable pour les communautés de Kalehe.

- **Qualité Premium** : Spécialistes du café Bourbon avec un score de dégustation minimal de **85+**.
- **Impact Social** : Soutien aux producteurs locaux et autonomisation des femmes.
- **Durabilité** : Pratiques agricoles respectueuses de l'environnement du Kivu.

---

## 🛠️ Stack Technique

Cette application est bâtie avec les technologies les plus récentes pour garantir performance, sécurité et élégance :

- **Frontend** : [Next.js 15+](https://nextjs.org/) (App Router)
- **Styling** : [Tailwind CSS 4](https://tailwindcss.com/) & [Framer Motion](https://www.framer.com/motion/) pour des animations fluides.
- **Base de données** : [Prisma ORM](https://www.prisma.io/) avec SQLite (compatible PostgreSQL pour la production).
- **Cartographie** : [Leaflet](https://leafletjs.com/) pour la géolocalisation des plantations.
- **UI Components** : [Lucide React](https://lucide.dev/) pour l'iconographie premium.

---

## ✨ Fonctionnalités Clés

- 📊 **Dashboard Administratif** : Gestion complète de la coopérative, des membres et des récoltes.
- ☕ **Catalogue de Café** : Présentation détaillée des lots Bourbon et de leurs profils aromatiques.
- 🗺️ **Carte Interactive** : Visualisation des zones de culture et des infrastructures (stations de lavage).
- 📰 **Gestion des Actualités** : Flux dynamique pour informer la communauté sur la vie de la coopérative.
- 📱 **Mobile-First Responsive** : Une interface ergonomique optimisée pour tous les appareils.

---

## 📂 Structure du Projet

```text
├── app/                  # Application Next.js (Pages, API, Layouts)
│   ├── dashboard/        # Interface administrative
│   ├── galerie/          # Visuels des récoltes
│   └── api/              # Endpoints backend
├── components/           # Composants UI réutilisables
├── lib/                  # Utilitaires et configuration (Prisma, data)
├── prisma/               # Schéma de base de données
├── public/               # Assets statiques
└── legacy/               # (Optionnel) Anciens scripts PHP/Services
```

---

## 🛠️ Installation et Démarrage

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/johnmoka111/COACKI-V2.git
   cd COACKI-V2
   ```

2. **Installer les dépendances** :
   ```bash
   npm install
   ```

3. **Configurer la base de données** :
   ```bash
   npx prisma generate
   npx prisma db push
   ```

4. **Lancer le serveur de développement** :
   ```bash
   npm run dev
   ```

---

## 🤝 Partenariat & Contact

Nous sommes ouverts aux collaborations avec les torréfacteurs, amateurs de café et partenaires de développement.

- 📧 **Email** : [coackicoop@gmail.com](mailto:coackicoop@gmail.com)
- 📍 **Localisation** : Mbinga-Sud, Kalehe, Sud-Kivu, RDC

---
*Réalisé avec ❤️ pour la communauté COACKI.*
