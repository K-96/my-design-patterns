<?php

namespace DesignPatterns\Builder;

use DesignPatterns\Builder\BuilderInterfaces\ClassBuilderInterface;
use DesignPatterns\Builder\FileParts\Blocks\ClassBlock;
use DesignPatterns\Builder\FileParts\Blocks\DocsBlock;
use DesignPatterns\Builder\FileParts\Blocks\ImportBlock;
use DesignPatterns\Builder\FileParts\Blocks\NamespaceBlock;
use DesignPatterns\Builder\FileParts\Blocks\StartFileBlock;
use DesignPatterns\Builder\Collections\TupleParams;
use DesignPatterns\Builder\FileParts\Templates\Varible;
use DesignPatterns\Builder\FileParts\Tokens\ClassNameToken;
use DesignPatterns\Builder\FileParts\Tokens\FunctionNameToken;
use DesignPatterns\Builder\FileParts\Tokens\LevelAccessToken;
use DesignPatterns\Builder\FileParts\Tokens\PrivateToken;
use DesignPatterns\Builder\FileParts\Tokens\ProtectedToken;
use DesignPatterns\Builder\FileParts\Tokens\PublicToken;
use DesignPatterns\Builder\FileParts\Tokens\TypeHintToken;
use RuntimeException;

class ClassBuilder implements ClassBuilderInterface
{

    private File $file;
    private ?NamespaceBlock $namespace = null;
    private ?ImportBlock $imports = null;
    private ?ClassBlock $class = null;

    public function __construct(File $file = null)
    {
        if ($file === null) {
            $file = new File();
            $file->addPart(new StartFileBlock());
        }

        $this->setFile($file);
    }

    public function setFile(File $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = new NamespaceBlock($namespace);
        return $this;
    }

    public function setImports(array $imports): self
    {
        $this->imports = new ImportBlock($imports);
        return $this;
    }

    public function setClassName(string $name): self
    {
        $this->class = new ClassBlock(new ClassNameToken($name));
        return $this;
    }

    public function setFinal(): self
    {
        if ($this->class === null) {
            throw new RuntimeException('Before call setFinal need call setName.');
        }

        $this->class->asFinalClass();
        return $this;
    }

    public function setParent(string $name): self
    {
        if ($this->class === null) {
            throw new RuntimeException('Before call setParent need call setName.');
        }

        $this->class->extended(new ClassNameToken($name));
        return $this;
    }

    public function setMethod(array $params): self
    {
        if ($this->class === null) {
            throw new RuntimeException('Before call setMethod need call setName.');
        }

        if (empty($params['name'])) {
            throw new RuntimeException('Value by key name can\'t empty.');
        }
        if (!is_string($params['name'])) {
            throw new RuntimeException('Value by key name must be a string.');
        }
        if (!empty($params['return_type']) && !is_string($params['return_type'])) {
            throw new RuntimeException('Value by key return_type must be a string.');
        }

        $throws = [];

        if (!empty($params['docs_block']['throws'])) {
            if (!is_iterable($params['docs_block']['throws'])) {
                throw new RuntimeException('Value by key return_type must be a iterable.');
            }

            foreach ($params['docs_block']['throws'] as $idx => $throw) {
                if (!is_string($throw)) {
                    throw new RuntimeException("Value by key docs_block.throws.{$idx} must be a string.");
                }

                $throws[] = new TypeHintToken($throw);
            }
        }

        $methodParams = [];

        if (!empty($params['method_params'])) {
            if (!is_iterable($params['method_params'])) {
                throw new RuntimeException('Value by key method_params must be iterable.');
            }

            foreach ($params['method_params'] as $idx => $param) {
                if (!is_string($param['variable_name'])) {
                    throw new RuntimeException("Value by key method_params.{$idx}.variable_name must be string.");
                }
                if (isset($param['type_hint'])) {
                    if (!is_string($param['type_hint'])) {
                        throw new RuntimeException("Value by key method_params.{$idx}.type_hint must be string");
                    }
                    if (empty($param['type_hint'])) {
                        throw new RuntimeException("Value by key method_params.{$idx}.type_hint can't empty.");
                    }
                }

                if (isset($param['type_hint'])) {
                    $methodParams[] = new TupleParams(new Varible($param['variable_name']), new TypeHintToken($param['type_hint']));
                } else {
                    $methodParams[] = new TupleParams(new Varible($param['variable_name']));
                }
            }
        }

        $this->class->addMethod(
            $this->resolveLevelAccess($params['level_access'] ?? null),
            new FunctionNameToken($params['name']),
            !empty($params['return_type'])
                ? new TypeHintToken($params['return_type'])
                : null,
            $methodParams,
            !empty($params['docs_block'])
                ? new DocsBlock($throws)
                : null
        );
        return $this;
    }

    public function setProperty(array $params): self
    {
        if ($this->class === null) {
            throw new RuntimeException('Before call setProperty need call setName.');
        }

        if (empty($params['name'])) {
            throw new RuntimeException('Value by key name can\'t empty.');
        }
        if (!is_string($params['name'])) {
            throw new RuntimeException('Value by key name must be a string.');
        }
        if (isset($params['type_hint'])) {
            if (!is_string($params['type_hint'])) {
                throw new RuntimeException('Value by key type_hint must be string|null.');
            }
            if (empty($params['type_hint'])) {
                throw new RuntimeException('Value by key type_hint can\'t empty.');
            }
        }

        $this->class->addProperty(
            new Varible($params['name']),
            $this->resolveLevelAccess($params['level_access'] ?? null),
            isset($params['type_hint']) ? new TypeHintToken($params['type_hint']) : null,
            !empty($params['docs_block'])
        );
        return $this;
    }

    private function resolveLevelAccess($levelAccess): LevelAccessToken
    {
        if (empty($levelAccess)) {
            $la = new PublicToken();
        } elseif ($levelAccess instanceof LevelAccessToken) {
            $la = $levelAccess;
        } else {
            $publ = [0, 'public', 'publ', 'pu'];
            $proc = [1, 'protected', 'proc', 'po'];
            $priv = [2, 'private', 'priv', 'pi'];

            switch (true) {
                case in_array($levelAccess, $proc, true):
                    $la = new ProtectedToken(); break;
                case in_array($levelAccess, $priv, true):
                    $la = new PrivateToken(); break;
                case in_array($levelAccess, $publ, true):
                default:
                    $la = new PublicToken(); break;
            }
        }

        return $la;
    }

    public function build(string $name = null): File
    {
        if ($this->class === null && $name === null) {
            throw new RuntimeException('Before call build need call setName or pass name.');
        }

        if ($this->class === null) {
            $this->setClassName($name);
        }

        if ($this->namespace !== null) {
            $this->file->addPart($this->namespace);
        }
        if ($this->imports !== null) {
            $this->file->addPart($this->imports);
        }

        return $this->file->addPart($this->class);
    }
}