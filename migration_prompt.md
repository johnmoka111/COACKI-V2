# Prompt de Migration : COACKI Next.js vers PHP MVC

## 📝 Contexte du Projet
Nous migrons le projet **COACKI** d'une stack **Next.js / Prisma / SQLite** vers une stack **PHP Native / MySQL / Tailwind CSS**. Le but est de simplifier l'infrastructure tout en gardant exactement le même design "premium" et la même logique métier.

---

## 🚀 Instructions de Migration

### 1. Architecture Logicielle
*   **Modèle** : MVC (Model-View-Controller) natif.
*   **Entrée Unique** : `index.php` servant de routeur.
*   **Structure Dossiers** :
    *   `app/Controllers/` : Classes de gestion (ex: `HomeController`, `NewsController`, `MapController`).
    *   `app/Models/` : Classes d'accès aux données MySQL (utilisant PDO).
    *   `app/Views/` : Fichiers `.php` contenant le HTML et les classes Tailwind CSS extraites du projet Next.js.
    *   `app/Core/` : Logique de routage, gestion de session et utilitaires.

### 2. Base de Données (MySQL)
*   Convertir les modèles Prisma (`Parcelle`, `StationLavage`, `GalleryItem`) en schéma SQL MySQL.
*   Ajouter des horodatages `created_at` et `updated_at`.
*   Utiliser des clés primaires auto-incrémentées.

### 3. Interface & Design (Mobile-First Professionnel)
*   **Priorité Smartphone** : Les administrateurs utiliseront principalement des smartphones. L'interface doit être pensée pour une utilisation à une main.
*   **Navigation Tactile** : 
    *   Implémenter une barre de navigation (type Bottom Navigation Bar) sur mobile pour les accès rapides.
    *   Utiliser des boutons larges et des zones de clic généreuses (min 44x44px).
*   **Extraction HTML** : Copier le HTML des composants React en l'adaptant pour un responsive "Edge-to-Edge" sur mobile.
*   **Actualités & Dashboard** : Le rendu des news sur mobile doit être clair, avec une typographie lisible et des images optimisées.
*   **Tailwind** : Utiliser les préfixes `sm:`, `md:`, `lg:` pour garantir que le UI s'adapte parfaitement du smartphone au desktop.
*   **Iconographie** : Remplacer `lucide-react` par des SVGs légers pour une performance maximale sur réseaux mobiles.

### 4. Fonctionnalités Clés
*   **Carte Interactive** : Utiliser **Leaflet.js** dans la vue `carte.php`. Charger les données des parcelles et stations de lavage depuis le contrôleur PHP en JSON pour les afficher sur la carte.
*   **Hashage des IDs & URLs** :
    *   Créer une classe utilitaire `Security` pour encoder/décoder les IDs numériques en chaînes de caractères (type Hashids).
    *   Toutes les URLs publiques (ex: `/actualites/aB7x9`) doivent utiliser ces IDs hashés.
*   **News & Galerie** : Implémenter le CRUD simple pour la gestion du contenu dynamique.

### 5. SEO & URLs Propres
*   Utiliser un fichier `.htaccess` pour gérer la réécriture d'URL (URL Rewriting) et obtenir des chemins propres (ex: `/actualites` => `index.php?url=actualites`).

---

## ⚡ Objectif UI Final
L'utilisateur final ne doit percevoir **aucune différence visuelle** entre la version Next.js et la version PHP. L'interactivité (modales, menus mobiles, cartes) doit être fluide et identique.

---

*Ce prompt sert de guide strict pour la réimplémentation du système.*
