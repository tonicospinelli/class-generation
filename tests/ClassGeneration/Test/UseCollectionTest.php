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

use ClassGeneration\PhpClass;
use ClassGeneration\DocBlock\Tag;
use ClassGeneration\UseClass;
use ClassGeneration\UseCollection;

class UseCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfMethodCollection()
    {
        $collection = new UseCollection();
        $this->assertInstanceOf('\ClassGeneration\UseCollection', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddUse()
    {
        $use = new UseCollection();
        $use->add(new UseClass());
        $use->add(new Tag());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetParent()
    {
        $code = new PhpClass();
        $use = new UseCollection();
        $use->setOptions(array('parent' => $code));
        $this->assertInstanceOf('\ClassGeneration\PhpClass', $use->getParent());
        $use->setParent(new Tag());
    }

    public function testParseToString()
    {
        $collection = new UseCollection();
        $this->assertEmpty($collection->toString());
        $collection->add(new UseClass(array('className' => 'ClassGenerator\Code')));
        $expected = 'use ClassGenerator\Code;' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }
}
