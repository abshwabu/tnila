# Tnila

A Laravel 11 construction company website starter with a Filament 3 admin panel, Livewire 3, Alpine.js, Tailwind CSS 3, Spatie Media Library, and Spatie Laravel Sluggable.

## Requirements

- PHP 8.3+
- Composer
- Node.js and npm
- PostgreSQL

## Local setup

1. Install PHP dependencies:
   ```bash
   composer install
   ```

2. Install frontend dependencies:
   ```bash
   npm install
   ```

3. Copy environment variables and configure PostgreSQL:
   ```bash
   cp .env.example .env
   ```

4. Generate the app key if needed:
   ```bash
   php artisan key:generate
   ```

5. Run the database migrations and seed starter content:
   ```bash
   php artisan migrate --seed
   ```

6. Start the app:
   ```bash
   php artisan serve
   ```

7. In a second terminal, compile assets:
   ```bash
   npm run dev
   ```

## Admin access

- Filament runs at `/admin`
- Seeded local admin:
  - Email: `admin@tnila.test`
  - Password: `password`

## Going live checklist

1. Point your DNS records at the production server and verify the public hostname resolves correctly.
2. Install SSL and confirm the site redirects to HTTPS end-to-end.
3. Copy `.env.production.example` to your production `.env` and set the app key, database, cache, queue, mail, and monitoring values.
4. Create the first Filament administrator with:
   ```bash
   php artisan make:filament-user
   ```
5. Run production caches after deployment:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```
6. Make sure a queue worker is running for contact emails and job application confirmations.
7. Confirm storage is linked and media uploads are writable:
   ```bash
   php artisan storage:link
   ```
8. Verify `robots.txt` and `sitemap.xml` are reachable and reference the live domain.
9. Turn on uptime and error monitoring with Laravel Pulse and/or Sentry before launch.

## Included structure

- `app/Filament/Resources` - admin CRUD resources
- `app/Livewire` - customer-facing interactive components
- `app/Models` - application models
- `resources/views/livewire` - Livewire views
- `resources/views/components` - shared Blade components
