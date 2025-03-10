<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Vending Machine Backend

A backend system for a vending machine built with Laravel. This application manages drink options, user orders, and integrates with vending machine hardware via APIs.

## Features
- Menu with four drinks: Tea, Karak, Masala, and Nescafe.
- Configurable sweetness level for drinks.
- Generates unique random codes for each order.
- API to validate codes and update order statuses.
- Receipt generation with download functionality.

## Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js (for frontend assets, if needed)

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/do11ir/CoffeeVendingMachine-IOT
   cd vending-backend
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the .env file:

    ```bash
    cp .env.example .env
    ```

4. Generate the application key:

    ```bash
    php artisan key:generate
    Run migrations:
    ```

5. Run migrations:
    ```bash
    php artisan migrate
    ```

## API Endpoints

| Endpoint             | Method | Description                    |
|----------------------|--------|--------------------------------|
| `/api/validate-code` | POST   | Validates order random codes.  |

## Contributing

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature-name
   ```
3. Commit your changes:
    ```bash
    git commit -m "Add feature-name"
    Push to the branch:
    ```
4. Push to the branch:
    ```bash
    git push origin feature-name
    Open a pull request.
    ```
5. Open a pull request.

## License

This project is open-source and available under the [MIT License](LICENSE).
