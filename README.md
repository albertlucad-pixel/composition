# StarCraft Compositions

Application web MVC en PHP permettant de créer et partager des compositions d'unités StarCraft.

---

## 📋 Prérequis

- [Laragon](https://laragon.org/) installé
- Un navigateur web

---

## 🚀 Installation et lancement

### 1. Cloner le projet

```bash
git clone https://github.com/herveleguern/authenticate.git
```

Placer le dossier `composition` dans le répertoire `www` de Laragon :
```
C:\laragon\www\composition\
```

### 2. Démarrer Laragon

- Ouvrir **Laragon**
- Cliquer sur **Start All** pour lancer Apache et MySQL

### 3. Créer la base de données

- Dans Laragon, ouvrir le **Terminal**
- Exécuter le script SQL :

```bash
mysql -u root -p < script.sql
```

> Cela crée la base de données `starcraft` avec les tables `users`, `units`, `compositions` et `composition_units`.

### 4. Accéder à l'application

Ouvrir un navigateur et aller à l'adresse :

```
http://localhost/composition
```

L'application est prête à l'emploi ✅

---

## 🎮 Présentation de l'application

**StarCraft Compositions** est une application web qui permet de gérer et partager des compositions d'unités de jeu.

### Fonctionnalités

#### 👤 Compte utilisateur
- Créer un compte avec un mot de passe sécurisé
- Se connecter / se déconnecter
- Consulter son profil (nombre de compositions publiques et privées)
- Supprimer son compte

#### ⚔️ Gestion des unités
- Créer des unités parmi une liste prédéfinie (Marines, Zealot, Zergling, etc.)
- Définir les statistiques de chaque unité :
  - **Santé** (points de vie)
  - **Dégâts**
  - **Armure**
  - **Vitesse**
  - **Coût**
- Modifier ou supprimer une unité

#### 🗂️ Gestion des compositions
- Créer une composition en sélectionnant des unités et en définissant leur quantité
- Donner un nom et une description à chaque composition
- Choisir si la composition est **publique** ou **privée**
- Modifier ou supprimer ses compositions

#### 🌍 Compositions publiques
- Toutes les compositions marquées comme **publiques** sont visibles par tous les visiteurs, même non connectés
- Permet de partager et consulter les stratégies des autres joueurs

---

## 🗄️ Structure de la base de données

```
users               → comptes utilisateurs
units               → unités disponibles avec leurs statistiques
compositions        → compositions créées par les utilisateurs
composition_units   → table de jointure (quelle unité, en quelle quantité, dans quelle composition)
```

---

## 🏗️ Architecture du projet (MVC)

```
composition/
├── index.php               ← Routeur principal
├── script.sql              ← Script de création de la BDD
├── config/
│   └── database.php        ← Connexion PDO
├── models/
│   ├── User.php
│   ├── Unit.php
│   └── Composition.php
├── controllers/
│   ├── AuthController.php
│   ├── HomeController.php
│   ├── UnitController.php
│   └── CompositionController.php
└── views/
    ├── layout.php
    ├── home.php
    ├── login.php
    ├── register.php
    ├── profile.php
    ├── compositions/
    └── units/
```
