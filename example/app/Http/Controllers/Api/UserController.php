<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelRESType\Attributes\RouteTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserController extends Controller
{
    #[
        RouteTypeScriptType([
            'responses' => [
                [
                    'logged' => 'false',
                    'user' => 'null',
                ],
                [
                    'logged' => 'true',
                    'user' => 'App.Models.User',
                ],
            ],
        ])
    ]
    public $get;
    public function get(Request $request)
    {
        return [
            'logged' => Auth::check(),
            'user' => $request->user(),
        ];
    }
}
