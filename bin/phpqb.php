<?php

if (!class_exists('\Symfony\Component\Console\Application')) {
    if (file_exists($file = __DIR__ . '/../../../autoload.php') || file_exists($file = __DIR__ . '/../../autoload.php') || file_exists($file = __DIR__ . '/../vendor/autoload.php')) {
        require_once $file;
    }
}

use Symfony\Component\Console\Application;
use \App\Utils\Version;

$version = new Version();

$app = new Application();
$app->setName('PHPQueryBuilder CLI');
$app->setVersion($version->getVersion());

$app->add(new \App\Command\CommandVersion());
$app->add(new \App\Command\CommandDump());
$app->add(new \App\Command\CommandInit());

$app->run();