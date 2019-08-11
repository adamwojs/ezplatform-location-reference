<?php

// Get global config.php settings
if (!file_exists(__DIR__ . '/vendor/ezsystems/ezpublish-kernel/config.php')) {
    if (!symlink(__DIR__ . '/vendor/ezsystems/ezpublish-kernel/config.php-DEVELOPMENT', __DIR__ . '/vendor/ezsystems/ezpublish-kernel/config.php')) {
        throw new \RuntimeException('Could not symlink config.php-DEVELOPMENT to config.php, please copy config.php-DEVELOPMENT to config.php & customize to your needs!');
    }
}

if (!($settings = include(__DIR__ . '/vendor/ezsystems/ezpublish-kernel/config.php'))) {
    throw new \RuntimeException('Could not read config.php, please copy config.php-DEVELOPMENT to config.php & customize to your needs!');
}

require_once __DIR__ . '/vendor/autoload.php';
