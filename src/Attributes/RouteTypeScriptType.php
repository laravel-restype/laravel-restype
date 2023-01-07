<?php

namespace LaravelRESType\Attributes;

use Attribute;
use phpDocumentor\Reflection\Type;
use Spatie\TypeScriptTransformer\Types\StructType;
use Spatie\TypeScriptTransformer\Types\TypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptTransformableAttribute;

#[Attribute]
class RouteTypeScriptType implements TypeScriptTransformableAttribute
{
    private string|array $typeScript;

    public function __construct(string|array $typeScript)
    {
        $this->typeScript = $typeScript;
    }

    public function getType($type = null, $level = 1): Type
    {
        if ($type == null) {
            $type = $this->typeScript;
        }
        if (is_string($type)) {
            return new TypeScriptType($type);
        }

        $types = array_map(function ($item) use ($level) {
            return $this->getType($item, $level + 1);
        }, $type);

        if ($level == 1) {
            if (!isset($types['params'])) {
                $types['params?'] = new TypeScriptType('null | undefined');
            }
            if (!isset($types['query'])) {
                $types['query?'] = new TypeScriptType('null | undefined');
            }
            if (!isset($types['body'])) {
                $types['body?'] = new TypeScriptType('null | undefined');
            }
            if (!isset($types['responses'])) {
                $types['responses'] = new StructType(isset($types['response']) ? [$types['response']] : []);
            }
            if (isset($types['response'])) {
                unset($types['response']);
            }
        }

        return new StructType($types);
    }
}
