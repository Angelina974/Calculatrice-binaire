# PARTIE 1 : Construire une calculatrice binaire en php hébergée sur Docker

1. Lancez Docker Desktop et assurez-vous que le démon tourne (logo Docker visible en bas à droite).

2. Construire l’image Docker :
`docker build -t calc-binaire-php .`

3.  Lancer un conteneur :
`docker run --rm -p 8000:80 calc-binaire-php`

4. Tester dans le navigateur
`http://localhost:8000/`

# PARTIE 2 : Ajouter des tests unitaires

1. Initialisez composer :
`docker run --rm -v "%cd%":/app -w /app composer init --no-interaction`

2. Installez PHPUnit en dépendance de développement :
`docker run --rm -v "%cd%":/app -w /app composer require --dev phpunit/phpunit:^9`

3. Configurer PHPUnit :
Créez un fichier phpunit.xml à la racine du projet

4. Écrire les premiers tests
    - Création le dossier tests/ à la racine.
    - À l’intérieur, création de CalculatorTest.php

5. Mettre à jour le Dockerfile pour Composer & PHPUnit
**Rebuild :** 
    - `docker build -t calc-binaire-php:test .`
