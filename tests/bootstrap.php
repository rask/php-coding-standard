<?php declare(strict_types = 1);

/**
 * File bootstrap.php
 *
 * Bootstrap for various tests.
 */

require \dirname(__DIR__) . '/vendor/autoload.php';

if (\file_exists(\dirname(__DIR__) . '/vendor/squizlabs/php_codesniffer/autoload.php')) {
    require \dirname(__DIR__) . '/vendor/squizlabs/php_codesniffer/autoload.php';
}
