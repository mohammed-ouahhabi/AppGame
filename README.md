# Application APPGame


Cette application web est une plateforme dédiée aux jeux vidéo, offrant une gestion centralisée des jeux et des offres associées. 
Les utilisateurs peuvent consulter les détails des jeux, comparer les offres en fonction du prix, et accéder à des liens directs pour l'achat. 
L'application permet également d'ajouter et de supprimer des jeux et des offres, de filtrer et trier les offres selon différents critères.
Les utilisateurs peuvent créer et gérer leur wishlist, tandis que les administrateurs disposent d'outils complets pour la gestion et la modification des contenus. 
Des métadonnées détaillées sur les jeux et les offres enrichissent l'expérience utilisateur.


## Pré-requis

- PHP 7.4 ou supérieur
- Composer
- Symfony CLI
- MySQL ou une autre base de données supportée

## Installation

1. **Cloner le dépôt**

    ```sh
    git clone https://github.com/somloul/AppGame.git
    cd AppGame
    ```

2. **Installer les dépendances**

    ```sh
    composer install
    ```

5. **Créer la base de données**

    ```sh
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

6. **Importer le Fichier SQL**

   Importer le fichier sql inclus dans le dossier AppGame dans votre BDD pour avoir des données de test.

## Utilisation

1. **Démarrer le serveur**

    ```sh
    symfony server:start
    ```

2. **Accéder à l'application**

    Ouvrez votre navigateur web et allez sur `http://localhost:8000`.
    Pour avoir acces à un compte admin utiliser test@test.com, mdp : test

## Contact

Akram CHAMI - a.chami@ecole-ipssi.net
Mohammed OUAHHABI - m.ouahhabi@ecole-ipssi.net

Lien du projet : https://github.com/somloul/AppGame
