<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use DesignPatterns\Builder\FileParts\Blocks\ClassBlock;
use DesignPatterns\Builder\FileParts\Blocks\ImportBlock;
use DesignPatterns\Builder\FileParts\Blocks\NamespaceBlock;
use DesignPatterns\Builder\FileParts\Blocks\StartFileBlock;
use DesignPatterns\Builder\FileParts\Templates\ImplementsClassNames;
use DesignPatterns\Builder\FileParts\Templates\Varible;
use DesignPatterns\Builder\FileParts\Tokens\ClassNameToken;
use DesignPatterns\Builder\FileParts\Tokens\FunctionNameToken;
use DesignPatterns\Builder\FileParts\Tokens\PrivateToken;
use DesignPatterns\Builder\FileParts\Tokens\ProtectedToken;
use DesignPatterns\Builder\FileParts\Tokens\PublicToken;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;
use DesignPatterns\Builder\Collections\TupleParams;
use DesignPatterns\Builder\FileParts\Blocks\DocsBlock;
use DesignPatterns\Builder\File;

$file = new File();

$file->addPart(new StartFileBlock());

$namespace = new NamespaceBlock('DesignPatterns\Builder');
$file->addPart($namespace);

$import = new ImportBlock([
    ArrayIterator::class,
    ArrayAccess::class,
    Iterator::class,
    Throwable::class
]);
$file->addPart($import);

$class = (new ClassBlock(new ClassNameToken('SomeIterator')))
    ->asFinalClass()
    ->extended(new ClassNameToken(ArrayIterator::class))
    ->implements(new ImplementsClassNames([
        ArrayAccess::class,
        Iterator::class,
    ]))
    ->addProperty(
        new Varible('test'),
        new PrivateToken(),
        new TypeHintToken('int'),
        true
    )
    ->addProperty(
        new Varible('test2'),
        new ProtectedToken(),
        new TypeHintToken('string')
    )
    ->addProperty(
        new Varible('test3'),
        new PublicToken(),
        new ClassNameToken(Throwable::class),
        true
    )
    ->addMethod(
        new PublicToken(),
        new FunctionNameToken('test'),
        new TypeHintToken('void')
    )
    ->addMethod(
        new PublicToken(),
        new FunctionNameToken('testT'),
        new TypeHintToken('string'),
        [
            new TupleParams(new Varible('a'), new TypeHintToken('string')),
            new TupleParams(new Varible('b'), new TypeHintToken('string')),
        ],
    )
    ->addMethod(
        new PublicToken(),
        new FunctionNameToken('testE'),
        new TypeHintToken('int'),
        [
            new TupleParams(new Varible('a'), new TypeHintToken('int')),
            new TupleParams(new Varible('b'), new TypeHintToken('float')),
        ],
        new DocsBlock([
            new ClassNameToken(Exception::class),
            new ClassNameToken(RuntimeException::class),
        ]),
    );
$file->addPart($class);

echo $file;