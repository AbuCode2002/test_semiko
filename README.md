## Installation

To get started with the installation, follow these steps:

1. Enter project directory
   `cd laravel-inertia-vue-project`

2. Install/update composer
   `composer install | composer update | composer install --ignore-platform-req=ext-iconv`

3. Install npm
   `npm install`

4. Set up the environment variables
   `cp .env.example .env`

5. Generate an application key
   `php artisan key:generate`

6. Configure the database
   `php artisan migrate`

7. Generate storage link
   `php artisan storage:link`

8. Start the development servers
   `npm run dev` & `php artisan serve`

9. Visit the application at [http://localhost:8000](http://localhost:8000)

## Tests

To get started with the tests, make sure you have enabled these extensions in your "php.ini" file if you are running the application on your local machine:

```
extension=pdo_sqlite
extension=sqlite3
```

Before running test make sure you bilded application using following command:
```
npm run build
```

To run tests run:
```
php artisan test
```


