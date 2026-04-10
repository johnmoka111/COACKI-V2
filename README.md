# 🌿 COACKI - Coopérative Agricole du Kivu

[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> **"Le café est notre vie."**

COACKI (Coopérative Agricole du Kivu) est une plateforme numérique robuste et légère bâtie en PHP, dédiée à la gestion de la production de café Bourbon de haute qualité au Sud-Kivu, République Démocratique du Congo.

---

## 🚀 Vision & Mission

Basée à **Mbinga-Sud**, COACKI regroupe plus de **276 membres engagés**. Cette application gère l'ensemble de l'écosystème de la coopérative, de la production à la commercialisation, avec un fort accent sur l'impact social et la qualité (Score 85+).

---

## 🛠️ Architecture & Stack

L'application utilise une architecture **MVC (Modèle-Vue-Contrôleur)** personnalisée, optimisée pour la rapidité et la simplicité de déploiement :

- **Backend** : PHP 8.2+ (MVCR natif)
- **Base de données** : MySQL / MariaDB
- **Frontend** : HTML5, Tailwind CSS (via CDN), Lucide Icons
- **Sécurité** : Gestion native des sessions, protection CSRF, filtrage des entrées PDO
- **Serveur** : Compatible Apache / Nginx (XAMPP recommandé pour le développement local)

---

## ✨ Fonctionnalités Majeures

- 📊 **Dashboard Administratif** : Gestion des membres, des rôles et des accès sécurisés.
- 📰 **Système d'Actualités** : Publication et gestion complète des articles avec engagement (likes, partages).
- ☕ **Espace Partenariat** : CRM pour la gestion des demandes de collaboration et échantillons.
- 🗺️ **Cartographie des Plantations** : Visualisation des zones géographiques de culture.
- 🔐 **Gestion des Utilisateurs** : Système complet de réinitialisation de mot de passe par questions de sécurité.

---

## 📂 Structure du Répertoire

```text
├── app/
│   ├── Controllers/      # Logique métier et routage des requêtes
│   ├── Core/             # Moteur de l'application (Autoloader, DB, Env)
│   ├── Models/           # Interaction avec la base de données
│   ├── Services/         # Services transversaux (Mail, etc.)
│   └── Views/            # Templates HTML/PHP (UI)
├── database/             # Schémas SQL et migrations
├── uploads/              # Médias et documents téléversés
├── assets/               # Assets statiques (CSS, JS, Images)
├── index.php             # Point d'entrée unique et routeur
└── .env                  # Configuration des variables d'environnement
```

---

## 🛠️ Installation

1. **Cloner le dépôt** dans votre dossier `htdocs` :
   ```bash
   git clone https://github.com/johnmoka111/COACKI-V2.git
   ```

2. **Base de données** :
   - Créez une base nommée `coacki_db`.
   - Importez le fichier `database/schema.sql`.

3. **Configuration** :
   - Renommez `.env.example` en `.env` (si applicable) ou configurez vos accès DB dans `app/Core/Database.php`.

4. **Accès** :
   - Lancez Apache/MySQL via XAMPP.
   - Accédez à `http://localhost/COACKI`.

---

## 🤝 Contact

- 📧 **Email** : [coackicoop@gmail.com](mailto:coackicoop@gmail.com)
- 📍 **Localisation** : Mbinga-Sud, Kalehe, Sud-Kivu, RDC

---
*Développé pour l'excellence du café congolais.*
