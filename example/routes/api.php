<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ApiRoutes
{
}

Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'get']);
});
