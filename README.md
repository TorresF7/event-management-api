## Laravel 12 API – Backend Demo

This repository contains a Laravel 12 API project focused on applying Laravel best practices in a realistic backend setup.

The objective of this project is to showcase backend development: authentication, authorization, queues, rate limiting, background processes, and a fully Dockerized environment.

## Project Overview
-   Headless REST API

-   Designed to be consumed by SPAs, mobile apps, or external services

## Key Features
### Authentication

-   Token-based authentication using Laravel Sanctum
-   Stateless API
-   Secure login and logout flows

### Authorization

-   Resource-level access control using Policies
-   Cross-cutting authorization rules using Gates

### Queues & Background Processing

-   Laravel queues using the database driver
-   Dedicated queue worker container
-   Job retries and failure handling
-   Used for tasks that should not block HTTP requests.

### Rate Limiting

-   Per-user rate limiting for authenticated requests
-   Per-IP limits for public endpoints
-   Configured using Laravel's RateLimiter


### Docker Setup

The project is fully dockerized using Docker Compose.

Services

-   app: PHP 8.2 + Laravel application
-   nginx: HTTP server
-   mysql: MySQL 8.0 database
-   queue: Dedicated container running php artisan queue:work
-   scheduler: Dedicated container running php artisan schedule:work
-   mailpit: Local mail testing service

## Setup
- Clone the repository:
    ```git clone https://github.com/TorresF7/event-management-api.git cd event-management-api```
- Start the containers:
    ```docker-compose up -d --build```
- Install dependencies:
    ```docker exec -it laravel_app composer install```
- Generate application key:
    ```docker exec -it laravel_app php artisan key:generate```    
- Run migrations:
    ```docker exec -it laravel_app php artisan migrate```
- (Optional) Seed the database:
    ```docker exec -it laravel_app php artisan db:seed```

- The application will be available at:
    http://localhost:8000
- Mailpit UI:
    http://localhost:8025
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
