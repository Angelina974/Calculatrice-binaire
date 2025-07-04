# PARTIE 1 : Construire une calculatrice binaire en php hébergée sur Docker

1. Lancez Docker Desktop et assurez-vous que le démon tourne (logo Docker visible en bas à droite).

2. Construire l’image Docker :
`docker build -t calc-binaire-php .`

3.  Lancer un conteneur :
`docker run --rm -p 8000:80 calc-binaire-php`

4. Tester dans le navigateur
`http://localhost:8000/`

# PARTIE 2 : Ajouter des tests unitaires et d'intégrations

1. Initialisez composer :
`composer init`
Si il y a un fichier `composer.json` dans le projet il suffit de faire la commande suicante : `composer install`

2. Installez PHPUnit en dépendance de développement :
`composer require --dev phpunit/phpunit:^10.0`  


3. Configurer PHPUnit :
Créez un fichier phpunit.xml à la racine du projet

4. Écrire les premiers tests
    - Création le dossier tests/ à la racine.
    - À l’intérieur, création de CalculatorTest.php

5. Mettre à jour le Dockerfile pour Composer & PHPUnit
**Rebuild :** 
    - `docker build -t calc-binaire-php:test .`

6. Lancer les tests avec du détail dans les réponses
` ./vendor/bin/phpunit --testdox`

# PARTIE 3 : Installer des dépendances php

- Installer PHPStan
- Installer PHPMD
- Installer PHPCPD
- Créer un makefile ou un script pour lancer tout ça avec les tests 

1. Création d'in fichier Makefile à la racine du projet

2. Lancer wsl dans le terminal

3. Une fois dans wsl, lancer la commande : `make install`

4. Une fois make installer lancer la commande `make tests` pour lancer les tests

# PARTIE 4 : Création d'une image docker 