# Laravel-RESType - add type-safety to your RESTful API

I saw the tRPC project and I wanted something similar, but for my existing Laravel projects.

After a quick google search I found the awesome project [spatie/typescript-transformer](https://github.com/spatie/typescript-transformer), however the integration with laravel is very barebones, serving as a building block.

This project helps you generate TypeScript definitions for your entire existing laravel REST api. After the definition is generated, you can import it in your frontend, or download it into your react-native project.

# Instalation

```bash
composer require laravel-restype/laravel-restype:"*"
```

Publish config

```bash
php artisan vendor:publish --tag="laravel-restype-config"
```

# Example project

```bash
git clone https://github.com/laravel-restype/laravel-restype
cd laravel-restype/example
docker compose up -d
docker-compose exec php su app -c 'cd example; composer install'
docker-compose exec php su app -c 'cd example; cp .env.example .env; php artisan key:generate'
```

# Roadmap:

|          |                                                  |
| -------- | ------------------------------------------------ |
| &#x2610; | Support file type, convert json body to FormData |

# Changelog:

### **[WIP]** v0.1 - 2023-01-07

-   First version
