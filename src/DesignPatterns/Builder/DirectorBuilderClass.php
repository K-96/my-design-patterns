<?php

namespace DesignPatterns\Builder;

use RuntimeException;

class DirectorBuilderClass
{

    private ClassBuilder $builder;

    public function __construct(ClassBuilder $builder)
    {
        $this->setBuilder($builder);
    }

    public function setBuilder(ClassBuilder $builder): void
    {
        $this->builder = $builder;
    }

    public function makeFile(array $params): File
    {
        if (isset($params['namespace'])) {
            $this->builder->setNamespace($params['namespace']);
        }
        if (isset($params['imports'])) {
            $this->builder->setImports($params['imports']);
        }
        if (!isset($params['class'])) {
            throw new RuntimeException('Value by key class can\'t be empty.');
        }

        $this->builder->setClassName($params['class']['name']);

        if (isset($params['class']['final']) && $params['class']['final']) {
            $this->builder->setFinal();
        }
        if (isset($params['class']['extends'])) {
            $this->builder->setParent($params['class']['extends']);
        }
        if (isset($params['class']['methods'])) {
            foreach ($params['class']['methods'] as $method) {
                $this->builder->setMethod($method);
            }
        }
        if (isset($params['class']['properties'])) {
            foreach ($params['class']['properties'] as $property) {
                $this->builder->setProperty($property);
            }
        }

        return $this->builder->build();
    }

    public function makeFileWithSimpleClass(string $name): File
    {
        return $this->builder->build($name);
    }
}