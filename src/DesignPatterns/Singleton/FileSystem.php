<?php

namespace DesignPatterns\Singleton;

use RuntimeException;

final class FileSystem
{

    private static self $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new RuntimeException('Cannot unserialize a FileSystem.');
    }

    public static function instance(): self
    {
        return self::$instance = self::$instance ?? new self();
    }

    public function write(string $fileName, string $content): bool
    {
        return is_int(file_put_contents($fileName, $content));
    }

    public function read(string $fileName): ?string
    {
        $content = file_get_contents($fileName);

        return is_string($content) ? $content : null;
    }
}