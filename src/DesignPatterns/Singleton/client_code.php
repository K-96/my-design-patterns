<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use DesignPatterns\Singleton\FileSystem;

$fs = FileSystem::instance();

$path = '/tmp/DesignPatternsTest.trash';

if (!$fs->write($path, 'trash')) {
    throw new RuntimeException('Cannot write content in file');
}

$content = $fs->read($path);

if (is_null($content)) {
    throw new RuntimeException('Cannot read content from file');
}

echo $content;
