<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelRESType\Attributes\RouteTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserController extends Controller
{
    #[
        RouteTypeScriptType([
            'responses' => ['App.Models.User'],
        ])
    ]
    public $get;
    public function get(Request $request)
    {
        return $request->user();
    }
}
