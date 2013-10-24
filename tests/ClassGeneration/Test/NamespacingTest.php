<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Test;

use ClassGeneration\DocBlock;
use ClassGeneration\NamespaceClass;

class NamespaceTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfNamespaceInterface()
    {
        $namespace = new NamespaceClass();
        $this->assertInstanceOf('\ClassGeneration\NamespaceInterface', $namespace);
    }

    public function testSetAndGetPath()
    {
        $namespace = new NamespaceClass();
        $namespace->setPath('Test');
        $this->assertEquals('Test', $namespace->getPath());
    }

    public function testSetAndGetDescription()
    {
        $namespace = new NamespaceClass();
        $namespace->setDescription('Test');
        $this->assertEquals('Test', $namespace->getDescription());
    }

    public function testParseToString()
    {
        $namespace = new NamespaceClass();
        $namespace->setPath('Test');
        $namespace->setDescription('Test');
        $expected = PHP_EOL
            . '/**' . PHP_EOL
            . ' * Test' . PHP_EOL
            . ' */' . PHP_EOL
            . 'namespace Test;' . PHP_EOL;
        $this->assertEquals($expected, $namespace->toString());
    }

    public function testSetNewDocBlock()
    {
        $namespace = new NamespaceClass();
        $namespace->setPath('Test');
        $namespace->setDescription('Test');
        $namespace->setDocBlock(new DocBlock(array('description' => 'New Description')));
        $this->assertEquals('New Description', $namespace->getDescription());
    }
}
