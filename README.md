<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touiter API - README</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        h1, h2, h3 {
            color: #2c3e50;
        }
        h1 {
            border-bottom: 2px solid #2980b9;
            padding-bottom: 10px;
        }
        pre {
            background: #ecf0f1;
            border-left: 5px solid #2980b9;
            padding: 10px;
            overflow-x: auto;
        }
        code {
            font-family: "Courier New", Courier, monospace;
            background: #ecf0f1;
            padding: 2px 4px;
            border-radius: 4px;
        }
        .command {
            background: #ecf0f1;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
            margin: 5px 0;
            font-weight: bold;
        }
        ul {
            list-style: disc inside;
        }
        ol {
            list-style: decimal inside;
        }
        a {
            color: #2980b9;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .step {
            background-color: #dff9fb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            border-left: 5px solid #6ab04c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Touiter API</h1>
        <p><strong>Touiter</strong> est une API simple inspirée de Twitter qui permet de créer, supprimer et récupérer des "touits". Cette API utilise Symfony 6.4 et inclut l'authentification JWT pour sécuriser les endpoints.</p>

        <h2>Prérequis</h2>
        <p>Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :</p>
        <ul>
            <li>PHP 8.1 ou supérieur</li>
            <li>Composer</li>
            <li>Symfony CLI (optionnel mais recommandé)</li>
            <li>MySQL ou un autre serveur de base de données supporté par Doctrine</li>
            <li>Un environnement de développement (comme Postman ou Hoppscotch) pour tester l'API</li>
        </ul>

        <h2>Installation</h2>
        <p>Suivez ces étapes pour installer et configurer l'API Touiter.</p>

        <div class="step">
            <h3>1. Cloner le dépôt</h3>
            <p>Clonez ce dépôt dans votre répertoire local :</p>
            <pre><code class="command">git clone https://github.com/votre-repository/touiter.git<br>cd touiter</code></pre>
        </div>

        <div class="step">
            <h3>2. Installer les dépendances</h3>
            <p>Installez les dépendances PHP en utilisant Composer :</p>
            <pre><code class="command">composer install</code></pre>
        </div>

        <div class="step">
            <h3>3. Configuration de l'environnement</h3>
            <p>Copiez le fichier <code>.env</code> pour créer une nouvelle configuration d'environnement :</p>
            <pre><code class="command">cp .env .env.local</code></pre>
            <p>Modifiez le fichier <code>.env.local</code> pour configurer les paramètres de votre base de données et des clés JWT :</p>
            <pre><code>
DATABASE_URL="mysql://root:@127.0.0.1:3306/touiter_db?serverVersion=5.7&charset=utf8mb4"

JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=votre-passphrase
            </code></pre>
        </div>

        <div class="step">
            <h3>4. Générer les clés JWT</h3>
            <p>Générez les clés nécessaires pour l'authentification JWT :</p>
            <pre><code class="command">php bin/console lexik:jwt:generate-keypair</code></pre>
        </div>

        <div class="step">
            <h3>5. Créer la base de données</h3>
            <p>Créez la base de données et exécutez les migrations :</p>
            <pre><code class="command">php bin/console doctrine:database:create<br>php bin/console doctrine:migrations:migrate</code></pre>
        </div>

        <div class="step">
            <h3>6. Créer un utilisateur</h3>
            <p>Créez un utilisateur dans la base de données avec un mot de passe :</p>
            <pre><code class="command">php bin/console security:hash-password</code></pre>
            <p>Utilisez la commande suivante pour créer un utilisateur et stockez le mot de passe haché dans la base de données :</p>
            <pre><code class="command">php bin/console make:user</code></pre>
        </div>

        <div class="step">
            <h3>7. Lancer le serveur</h3>
            <p>Lancez le serveur Symfony pour tester l'API :</p>
            <pre><code class="command">symfony server:start</code></pre>
            <p>Ou utilisez <code>php -S localhost:8000 -t public/</code> si vous n'avez pas Symfony CLI.</p>
        </div>

        <h2>Utilisation de l'API</h2>
        <p>Une fois le serveur démarré, vous pouvez tester les différentes routes de l'API à l'aide de Postman, Hoppscotch ou tout autre client HTTP.</p>

        <h3>Routes disponibles</h3>
        <ul>
            <li><code>GET /api/touits</code> - Récupère tous les touits</li>
            <li><code>POST /api/touits</code> - Crée un nouveau touit (nécessite un token JWT)</li>
            <li><code>DELETE /api/touits/{id}</code> - Supprime un touit (nécessite un token JWT)</li>
        </ul>

        <h2>Contribution</h2>
        <p>Les contributions sont les bienvenues ! Si vous avez des suggestions pour améliorer ce projet, n'hésitez pas à créer une pull request ou à ouvrir une issue.</p>

        <h2>Licence</h2>
        <p>Cet projet est sous licence MIT. Consultez le fichier LICENSE pour plus de détails.</p>
    </div>
</body>
</html>
