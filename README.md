# 🌿 COACKI - Coopérative Agricole du Kivu
![Project Banner](https://img.shields.io/badge/Status-Premium_UI_Overhaul-blue?style=for-the-badge)

[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> **"Le café est notre vie."**  
> COACKI (Coopérative Agricole du Kivu) est une plateforme numérique de pointe dédiée à la gestion de la production de café Bourbon de haute qualité au Sud-Kivu, RDC.

---

## 💎 Mise à jour Majeure : Premium UI Overhaul (Avril 2026)

Le système a bénéficié d'une refonte totale de l'expérience utilisateur (UX) et de l'interface (UI) pour atteindre les standards des applications professionnelles modernes.

### ✨ Nouvelles Fonctionnalités UI
*   **Système de Stepper Forms** : Les formulaires complexes (Inscription, Partenariat, Recrutement) sont désormais divisés en étapes logiques, réduisant la charge cognitive et améliorant le taux de conversion.
*   **Design Harmonisé "Professional Blue"** : Adoption d'un système de design épuré utilisant des "Outlined Text Fields", des rayons de courbure de 12px à 40px, et des icônes de préfixe pour une clarté maximale.
*   **Identité de Marque Intégrée** : Migration complète vers le logo officiel de COACKI dans les headers, les sidebars administratifs et les notifications.
*   **CRM Amélioré** : La gestion des partenariats inclut désormais la prévisualisation des logos d'entreprises et les badges de notification en temps réel sur le tableau de bord.

---

## 🛠️ Architecture Technologique

L'application repose sur une architecture **MVC (Modèle-Vue-Contrôleur)** robuste sans dépendances lourdes pour une performance optimale :

- **Backend** : PHP 8.2+ Natif (Architecture MVCR).
- **Frontend** : Tailwind CSS, Lucide Icons, Google Fonts (Roboto & Inter).
- **Système de Migration** : Script de "Self-Healing" `update_db.php` pour la synchronisation automatique des schémas de données.
- **Sécurité** : Protection par Questions de Récupération, hachage bcrypt, et routage sécurisé.

---

## ✨ Modules du Système

| Module | Description | Public |
| :--- | :--- | :--- |
| **Pôle Partenariat** | Formulaire intelligent avec upload de logo et détection automatique des types de collaboration. | Visiteurs |
| **Dashboard Admin** | Monitoring global, statistiques de collecte (12.5t) et gestion des abonnés. | Admin |
| **Recrutement CRM** | Inscription de nouveaux membres via un sélecteur de rôle visuel et génération de mots de passe. | Admin |
| **Articles & News** | Éditeur riche (TinyMCE) avec système de brouillon local automatique. | Staff |

---

## 📂 Installation Rapide

1. **Environnement** : Installez [XAMPP](https://www.apachefriends.org/) (PHP 8.2+).
2. **Déploiement** : 
   ```bash
   git clone https://github.com/johnmoka111/COACKI-V2.git
   ```
3. **Synchronisation DB** : 
   - Créez `coacki_db` dans phpMyAdmin.
   - Visitez `http://localhost/COACKI/update_db.php` pour générer automatiquement les tables et colonnes nécessaires.
4. **Prêt !** Accédez à `http://localhost/COACKI`.

---

## 🤝 Engagement & Impact Social
COACKI regroupe **276 membres** (94 femmes, 182 hommes). Chaque grain de café raconte l'histoire de la résilience du groupement de **Mbinga-Sud** à Kalehe.

- 📧 **Contact** : [coackicoop@gmail.com](mailto:coackicoop@gmail.com)
- 📍 **Siège** : Munanira, Kalehe, Sud-Kivu, RDC

---
*Développé avec passion pour l'excellence durable.*
