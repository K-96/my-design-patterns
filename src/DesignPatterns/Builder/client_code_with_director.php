<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use DesignPatterns\Builder\DirectorBuilderClass;
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

echo (new DirectorBuilderClass(new ClassBuilder()))->makeFile($params);
#echo (new DirectorBuilderClass(new ClassBuilder()))->makeFileWithSimpleClass('Simple');