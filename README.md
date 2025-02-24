# Application de Gestion de Projets Collaboratifs

Cette application permet aux utilisateurs d'organiser des projets en équipe, d'ajouter des tâches, de suivre l'avancement des tâches et de collaborer en temps réel.

## Fonctionnalités principales
- **Dashboard** : Tableau de bord personnalisé pour chaque utilisateur.
- **Gestion des projets** : Création de projets, invitation d'utilisateurs, gestion des statuts.
- **Gestion des tâches** : Création, modification, suppression et assignation de tâches.
- **Gestion des utilisateurs et des rôles** : Système d'authentification et de permissions.
- **Notifications par e-mail** : Envoi d'e-mails pour les tâches assignées ou échéances.
- **Gestion des fichiers** : Téléchargement et affichage de fichiers attachés aux tâches.

## Prérequis
- PHP 8.0 ou supérieur
- Composer
- Node.js et npm
- Base de données MySQL ou équivalente

## Installation
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/gestion-projets.git
   cd gestion-projets

2. Installez les dépendances PHP :
composer install

3. Installez les dépendances JavaScript :
npm install
npm run dev

4. Configurez le fichier .env :

- Copiez le fichier .env.example en .env :
cp .env.example .env
- Générez une clé d'application :
php artisan key:generate
- Configurez les informations de la base de données dans le fichier .env.

5. Migrez la base de données :
php artisan migrate

6. Lancez le serveur de développement :
php artisan serve

7. Accédez à l'application dans votre navigateur :
http://localhost:8000

## Contribution
Les contributions sont les bienvenues ! Pour contribuer, suivez ces étapes :

Forkez le projet.

1. Créez une branche pour votre fonctionnalité (git checkout -b feature/nouvelle-fonctionnalite).

2. Commitez vos changements (git commit -m 'Ajout d'une nouvelle fonctionnalité').

3. Poussez vers la branche (git push origin feature/nouvelle-fonctionnalite).

4. Ouvrez une Pull Request.

5. Auteur
AGBODJOGBE Merveille Espérence - merveilleesp@gmail.com

## Licence
Ce projet n'est pas sous licence.

