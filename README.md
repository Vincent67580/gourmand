# 🍳 Gourmand - Application Web de Partage de Recettes

Gourmand est une application web développée avec **Symfony 7** permettant aux utilisateurs de découvrir, publier et gérer des recettes de cuisine.

---

## 🛠️ Stack Technique

- **Backend :** PHP 8.2+ / Symfony 7
- **Base de données :** MySQL / MariaDB (compatible local)
- **ORM :** Doctrine
- **Moteur de templates :** Twig
- **Styling :** Bootstrap / CSS
- **Serveur local recommandé :** Symfony CLI, WampServer ou Laragon

---

## 📋 Prérequis

Avant d'installer et d'exécuter le projet sur ta machine, assure-toi d'avoir installé :

- [PHP 8.2](https://www.php.net/) ou supérieur (avec les extensions `intl`, `pdo_mysql`, `zip`, `mbstring` activées)
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)
- Un serveur MySQL local (WampServer, XAMPP, Laragon ou MySQL Server)

---

## 🚀 Installation & Lancement en Local

### 1. Cloner le dépôt Git

Ouvre un terminal et récupère le projet :

```bash
git clone https://github.com/Vincent67580/gourmand.git
cd gourmand
```

### 2. Installer les dépendances PHP

Exécute Composer pour télécharger l'ensemble des paquets :

```bash
composer install
```

### 3. Configurer l'environnement

Crée le fichier `.env.local` à la racine du projet à partir du fichier exemple :

```bash
cp .env .env.local
```

Ouvre `.env.local` et adapte la variable `DATABASE_URL` selon ton installation MySQL :

```env
# Exemple pour un serveur MySQL local (WampServer / XAMPP )
DATABASE_URL="mysql://root:@127.0.0.1:3306/gourmand_db?serverVersion=8.0&charset=utf8mb4"

```

### 4. Créer la base de données et la structure

Génère la base de données et applique le schéma avec Doctrine :

```bash
# Création de la base de données
php bin/console doctrine:database:create

# Application du schéma de tables
php bin/console doctrine:schema:update --force
```

### 5. Charger les données de test *(Optionnel)*

Le projet intègre un jeu de données de démonstration. Pour alimenter la base de données directement :

```bash
php bin/console doctrine:fixtures:load
```

---

## 💻 Démarrer l'application

Pour lancer le serveur localement :

###  Via le serveur intégré PHP

```bash
php -S 127.0.0.1:8000 -t public
```

---

## 🛠️ Commandes utiles 

- **Vider le cache :**  
  `php bin/console cache:clear`

- **Mettre à jour la base après modification d'une entité :**  
  `php bin/console doctrine:schema:update --force`

- **Créer ou modifier une entité :**  
  `php bin/console make:entity`

- **Créer un contrôleur :**  
  `php bin/console make:controller`