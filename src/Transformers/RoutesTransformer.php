<?php

namespace LaravelRESType\Transformers;

use ReflectionClass;
use Spatie\TypeScriptTransformer\Structures\TransformedType;
use Spatie\TypeScriptTransformer\Transformers\Transformer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RoutesTransformer implements Transformer
{
    public function transform(ReflectionClass $class, string $name): ?TransformedType
    {
        if (!$this->isTransformable($class)) {
            return null;
        }
        return TransformedType::create(
            $class,
            $name . 'Props',
            $this->resolveOptions($class),
            null,
            false,
            'interface',
            false
        );
    }

    private function isTransformable(ReflectionClass $class): bool
    {
        return strpos($class->getName(), 'Routes') !== false;
    }

    private function resolveOptions(ReflectionClass $class): string
    {
        $result = '';
        $className = $class->getName();
        $resultList = '';
        $routeCollection = Route::getRoutes();
        $iterator = $routeCollection->getIterator();
        $iterator->rewind();
        while ($iterator->valid()) {
            $route = $iterator->current();
            $controller = optional($route->getAction())['controller'];
            $method = optional($route->methods())[0] ?: 'GET';
            $url = str_replace('api/', '', $route->uri());
            if (strpos($controller, 'App\Http\Controllers\Api') !== false) {
                $name = Str::camel(str_replace(['/', '{', '?'], '-', str_replace('}', '', $url)));
                $controllerDef = explode('@', str_replace('\\', '.', $controller));
                $controllerDef = "{$controllerDef[0]}['$controllerDef[1]']";
                $result .= "\n    $name: ({ method: '$method', url: '/$url' } as {$className}Type<
        {$controllerDef}
    >),";
            }
            $iterator->next();
        }
        return "{ params?: any; query?: any; body?: any; responses: any; }
export type {$className}Type <I extends {$className}Props> = Omit<I, 'responses'> &  {
    method: string;
    url: string;
    response: I['responses'][keyof I['responses']];
}
export const {$className} = {{$result}
};
export default App;
";
    }
}
