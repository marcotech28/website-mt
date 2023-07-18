# README - Projet Symfony

## Prérequis

Assurez-vous d'avoir installé les éléments suivants avant de commencer :

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

## Installation

1. Clonez le dépôt Git :

```bash
git clone https://github.com/37anton/Marconnet-Technologies-Website.git)https://github.com/37anton/Marconnet-Technologies-Website.git

2. Installez les dépendances via Composer :

```bash
composer install

3. Configuration de la base de données :

```bash
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate


4. Exécution du serveur Symfony

```bash
symfony serve
