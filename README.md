# TP Symfony – Boutique de produits

Petite application web réalisée avec **Symfony 7.3** dans le cadre d'un TP. Elle permet de gérer un catalogue de produits (CRUD), d'afficher un panier et de proposer un formulaire de contact.

## Fonctionnalités

- Page d'accueil
- Liste des produits et page de détail
- Création, modification et suppression d'un produit
- Panier
- Formulaire de contact

## Prérequis

- PHP >= 8.2 (extensions `ctype` et `iconv`)
- [Composer](https://getcomposer.org/)
- MySQL / MariaDB (WAMP, par exemple)
- [Symfony CLI](https://symfony.com/download) (optionnel, pour lancer le serveur local)

## Installation

```bash
# 1. Installer les dépendances
composer install

# 2. Configurer la base de données (voir ci-dessous)

# 3. Créer la base et appliquer les migrations
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# 4. Lancer le serveur
symfony server:start
# ou : php -S localhost:8000 -t public
```

L'application est ensuite accessible sur `http://localhost:8000`.

### Configuration de la base de données

Par défaut, [.env](.env) utilise :

```
DATABASE_URL="mysql://root@localhost:3307/tp_symfony"
```

Pour adapter la configuration (port, identifiants…), créez un fichier `.env.local` qui surcharge cette variable :

```
DATABASE_URL="mysql://utilisateur:motdepasse@127.0.0.1:3306/tp_symfony"
```

## Routes

| Route            | URL                        | Description                    |
|------------------|----------------------------|--------------------------------|
| `home`           | `/`                        | Accueil                        |
| `list_products`  | `/products`                | Liste des produits             |
| `single_product` | `/products/{id}`           | Détail d'un produit            |
| `create_product` | `/CreateProduct`           | Création d'un produit          |
| `update_product` | `/products/update/{id}`    | Modification d'un produit      |
| `delete_product` | `/products/delete/{id}`    | Suppression d'un produit       |
| `basket`         | `/basket`                  | Panier                         |
| `contact`        | `/contact`                 | Formulaire de contact          |

## Modèle de données

Entité `Product` :

| Champ        | Type     | Remarque       |
|--------------|----------|----------------|
| `id`         | int      | Clé primaire   |
| `title`      | string   |                |
| `description`| string   |                |
| `price`      | float    |                |
| `price_promo`| float    | Optionnel      |
| `link_img`   | string   | Lien de l'image|

## Structure du projet

```
src/
├── Controller/   # Home, Product, Basket, Contact
├── Entity/       # Product
└── Repository/   # ProductRepository
templates/        # Vues Twig
migrations/       # Migrations Doctrine
assets/           # JS / CSS (AssetMapper, Stimulus, Turbo)
tests/            # Tests PHPUnit
```

## Technologies

- Symfony 7.3, Twig
- Doctrine ORM 3 + Migrations
- AssetMapper, Stimulus, Symfony UX Turbo
- PHPUnit 12

## Tests

```bash
php bin/phpunit
```
