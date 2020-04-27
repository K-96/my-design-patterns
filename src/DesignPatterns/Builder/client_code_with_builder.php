<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use DesignPatterns\Builder\ClassBuilder;

$params = [
    'namespace' => 'DesignPatterns\Builder',
    'imports' => [
        ArrayIterator::class,
        ArrayAccess::class,
        Iterator::class,
        Throwable::class
    ],
    'class' => [
        'name' => 'SomeIterator',
        'final' => true,
        'extends' => ArrayIterator::class,
        'implements' => [
            ArrayAccess::class,
            Iterator::class,
        ],
        'properties' => [
            [
                'name' => 'test',
                'level_access' => 'pi',
                'type_hint' => 'int',
                'docs_block' => true,
            ],
            [
                'name' => 'test2',
                'level_access' => 'protected',
                'type_hint' => 'string',
            ],
            [
                'name' => 'test3',
                'type_hint' => Throwable::class,
            ],
            [
                'name' => 'test4',
            ],
        ],
        'methods' => [
            [
                'name' => 'testT',
                'return_type' => 'string',
                'method_params' => [
                    [
                        'variable_name' => 'a',
                        'type_hint' => 'string',
                    ],
                    [
                        'variable_name' => 'b',
                        'type_hint' => 'string',
                    ],
                ],
                'docs_block' => true,
            ],
            [
                'name' => 'testE',
                'return_type' => 'int',
                'method_params' => [
                    [
                        'variable_name' => 'a',
                        'type_hint' => 'int',
                    ],
                    [
                        'variable_name' => 'b',
                        'type_hint' => 'float',
                    ],
                ],
                'docs_block' => [
                    'throws' => [
                        Exception::class,
                        RuntimeException::class,
                    ],
                ],
            ],
            [
                'name' => 'testA',
                'level_access' => 2,
                'method_params' => [
                    [
                        'variable_name' => 'a',
                    ],
                    [
                        'variable_name' => 'b',
                        'type_hint' => 'int',
                    ],
                ],
                'docs_block' => [
                    'throws' => [
                        Exception::class,
                    ],
                ],
            ],
        ],
    ]
];

$builder = new ClassBuilder();
# echo $builder->build('Simple');die(); # Generate Simple class

if (isset($params['namespace'])) {
    $builder->setNamespace($params['namespace']);
}
if (isset($params['imports'])) {
    $builder->setImports($params['imports']);
}
if (!isset($params['class'])) {
    throw new RuntimeException('Value by key class can\'t be empty.');
}

$builder->setClassName($params['class']['name']);

if (isset($params['class']['final']) && $params['class']['final']) {
    $builder->setFinal();
}
if (isset($params['class']['extends'])) {
    $builder->setParent($params['class']['extends']);
}
if (isset($params['class']['methods'])) {
    foreach ($params['class']['methods'] as $method) {
        $builder->setMethod($method);
    }
}
if (isset($params['class']['properties'])) {
    foreach ($params['class']['properties'] as $property) {
        $builder->setProperty($property);
    }
}

echo $builder->build();
