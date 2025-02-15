# Simple GraphQL API with Laravel 11 and Lighthouse PHP

A simple GraphQL API for a blog (users, posts, comments, tags).

## Installation:

1. Clone repository:

    ```
    git clone https://github.com/ArtemTitariev/graphql-api.git
    ```

2. Install dependencies, setup enviroment:

    ```
    composer install
    cp .env.example .env
    php artisan key:generate
    ```

3. Create necessary database.
   
    ```
    php artisan db
    create database graphql_api
    ```

4. Configure Laravel Passport package:
   
    ```
    php artisan passport:client --password
    ```
5. Run the initial migrations and seeders:

   ```
   php artisan migrate --seed
   ```