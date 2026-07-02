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

## Included structure

- `app/Filament/Resources` - admin CRUD resources
- `app/Livewire` - customer-facing interactive components
- `app/Models` - application models
- `resources/views/livewire` - Livewire views
- `resources/views/components` - shared Blade components

