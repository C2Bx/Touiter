 # Touiter API

Touiter est une API simple inspirée de Twitter qui permet de créer, supprimer et récupérer des "touits". Cette API utilise Symfony 6.4 et inclut l'authentification JWT pour sécuriser les endpoints.

 ## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP 8.1 ou supérieur
- Composer
- Symfony CLI (optionnel mais recommandé)
- MySQL ou un autre serveur de base de données supporté par Doctrine
- Un environnement de développement (comme Postman ou Hoppscotch) pour tester l'API

 ## Installation

Suivez ces étapes pour installer et configurer l'API Touiter.

 ### 1. Cloner le dépôt

Clonez ce dépôt dans votre répertoire local :

 ```bash
git clone https://github.com/votre-repository/touiter.git
cd touiter
 ```

 ### 2. Installer les dépendances

Installez les dépendances PHP en utilisant Composer :

 ```bash
composer install
 ```

 ### 3. Configuration de l'environnement

Copiez le fichier `.env` pour créer une nouvelle configuration d'environnement :

 ```bash
cp .env .env.local
 ```

Modifiez le fichier `.env.local` pour configurer les paramètres de votre base de données et des clés JWT :

 ```bash
DATABASE_URL"mysql://root:@127.0.0.1:3306/touiter_db?serverVersion5.7&charsetutf8mb4"

JWT_SECRET_KEY%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASEvotre-passphrase
 ```

 ### 4. Générer les clés JWT

Générez les clés nécessaires pour l'authentification JWT :

 ```bash
php bin/console lexik:jwt:generate-keypair
 ```

 ### 5. Créer la base de données

Créez la base de données et exécutez les migrations :

 ```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
 ```

 ### 6. Créer un utilisateur

Créez un utilisateur dans la base de données avec un mot de passe :

 ```bash
php bin/console security:hash-password
 ```

Utilisez la commande suivante pour créer un utilisateur et stockez le mot de passe haché dans la base de données :

 ```bash
php bin/console makeuser
 ```

 ### 7. Lancer le serveur

Lancez le serveur Symfony pour tester l'API :

 ```bash
symfony serverstart
 ```

Ou utilisez :

 ```bash
php -S localhost:8000 -t public/
 ```

si vous n'avez pas Symfony CLI.

 ## Utilisation de l'API

Une fois le serveur démarré, vous pouvez tester les différentes routes de l'API à l'aide de Postman, Hoppscotch ou tout autre client HTTP.

 ### Routes disponibles

- `GET /api/touits` - Récupère tous les touits
- `POST /api/touits` - Crée un nouveau touit (nécessite un token JWT)
- `DELETE /api/touits/{id}` - Supprime un touit (nécessite un token JWT)

 ## Contribution

Les contributions sont les bienvenues ! Si vous avez des suggestions pour améliorer ce projet, n'hésitez pas à créer une pull request ou à ouvrir une issue.

 ## Licence

Ce projet est sous licence MIT. Consultez le fichier LICENSE pour plus de détails.
