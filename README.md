
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
