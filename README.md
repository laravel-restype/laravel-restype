# Laravel-RESType (BETA) - add type-safety to your RESTful API

This project has 2 components:

-   [**laravel-restype**](https://github.com/laravel-restype/laravel-restype) - laravel server / generates the typescript definitions
-   [laravel-restype-client](https://github.com/laravel-restype/laravel-restype-client) - generic typescript client / consumes the typescript definitions generated

**Warning ! Beta software !** please don't use this in production yet !

### What is this ?

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

# Usage

1. First, let's enable automatic discovery for all your routes.
   In your `routes/api.php` file, add this empty class:

```php
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ApiRoutes
{
}

Route::get('/hello-world', [HomeController::class, 'hello_world']);
```

// TODO: not the best solution. make a custom transformer for this one with a prefix parameter

2. Then, add Route definitions for every controller method that coresponds to a route.

```php
use LaravelRESType\Attributes\RouteTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class HomeController extends Controller
{
    #[
        RouteTypeScriptType([
            'responses' => [
                [
                    'hello' => '"world"',
                    'message' => 'string',
                ],
            ],
        ])
    ]
    public $hello_world;
    public function hello_world(Request $request)
    {
        return [
            'hello' => 'world',
            'message' => 'Make the web a better place !',
        ];
    }
}
```

Note: a current limitation is that we can't generate typescript definitions for class methods, instead we have to add an empty property with the same name as the method (`public $hello_world`).

3. Generate your new typescript definition with:

```bash
php artisan typescript:transform
```

4. Install our client typescript package in your frontend project to use your new definitions.

Follow the steps from the [client package documentation](https://github.com/laravel-restype/laravel-restype-client#readme).

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
| &#x2610; | Support url parameters (eg. `/post/{id}`)        |
| &#x2610; | Support file type, convert json body to FormData |

# Changelog:

### v0.1 - 2023-01-07

-   First version
