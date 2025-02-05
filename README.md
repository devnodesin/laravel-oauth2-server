# Laravel OAuth2 Server

A full-featured OAuth2 authorization server implementation built with Laravel and Laravel Passport. This application serves as a reference implementation for securing your APIs and authenticating OAuth2 clients.

This implementation demonstrates:

- Client credential management
- Access token generation and validation  
- Refresh token handling
- Scope-based authorization
- Protected API resources

Clone or Download the Laravel Project

```bash
git clone https://github.com/devnodesin/laravel-oauth2-server.git users
cd users
```

## Install Dependencies

Install PHP dependencies and npm for frontend assets.

```bash
composer install
npm install
npm run build
```

### Copy the example .env file

```bash
cp .env.example .env
```

By default, this app uses SQLite as the database. You can customize it to use MySQL by updating the `.env` file as shown below:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run the following command to generate the application key:

```bash
php artisan key:generate
php artisan passport:keys
```

## Set Up the Database

Run migrations to create the database tables:
If the project includes seeders, run:

```bash
php artisan migrate
php artisan db:seed
```

## Debug

```bash

php artisan migrate:refresh
php artisan db:seed
php artisan key:generate
php artisan passport:keys --force


ls -lah storage/oauth-*.key

chmod 600 storage/oauth-*.key
chown www-data:www-data storage/oauth-*.key  # For Linux

```

```env
PASSPORT_PRIVATE_KEY=storage/oauth-private.key
PASSPORT_PUBLIC_KEY=storage/oauth-public.key
```

```bash
php artisan config:clear
php artisan cache:clear
php artisan session:clear
php artisan token:clear

php artisan config:cache


php artisan queue:restart

sudo systemctl restart nginx
sudo systemctl restart php-fpm
```
