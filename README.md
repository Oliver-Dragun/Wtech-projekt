# Potion Spot

Laravel + Bootstrap shop. Quick setup below.

## Requirements

- PHP 8.2+ with the `pdo_pgsql` extension
- Composer
- Node.js 18+ and npm
- PostgreSQL 14+

## Setup

1. **Create the Postgres database**

   ```sql
   CREATE DATABASE potionspot;
   ```

2. **Copy the env template**

   ```bash
   cp .env.example .env
   ```

   Then edit `.env` and fill in the DB section:

   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=potionspot
   DB_USERNAME=your_pg_user
   DB_PASSWORD=your_pg_password
   ```

3. **Install PHP dependencies**

   ```bash
   composer install
   ```

4. **Install JS dependencies**

   ```bash
   npm install
   ```

5. **Generate the app key**

   ```bash
   php artisan key:generate
   ```

6. **Run migrations + seed sample data**

   ```bash
   php artisan migrate:fresh --seed
   ```

   This creates all tables, products, categories, photos, and an admin user.

7. **Build front-end assets**

   ```bash
   npm run build
   ```

8. **Start the server**

   ```bash
   php artisan serve
   ```

   Open [http://localhost:8000](http://localhost:8000).

## Default admin login

```
email:    admin@admin.com
password: admin
```

## Project layout

- `app/Http/Controllers/` -> controllers (cart, checkout, payment, admin, etc.)
- `app/Models/` -> models of db tables
- `routes/web.php` -> route definitions
- `resources/views/` -> blade templates
- `public/images/` -> product images and assets
- `database/migrations/final_migration.php` -> schema
- `database/seeders/` -> sample data
