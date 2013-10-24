<?php

/*
 * This file bootstraps the test environment and
 * is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PositionalText\Tests;

error_reporting(E_ALL | E_STRICT);

if (file_exists(__DIR__ . '/../../../vendor/autoload.php')) {
    // dependencies were installed via composer - this is the main project
    $classLoader = require __DIR__ . '/../../../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../../../autoload.php')) {
    // installed as a dependency in `vendor`
    $classLoader = require __DIR__ . '/../../../../../autoload.php';
} else {
    throw new \Exception('Can\'t find autoload.php. Did you install dependencies via composer?');
}

/* @var $classLoader \Composer\Autoload\ClassLoader */
$classLoader->add('ClassGeneration\\Test\\', __DIR__ . '/../../');
unset($classLoader);
