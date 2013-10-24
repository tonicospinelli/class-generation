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


use ClassGeneration\Method;
use ClassGeneration\MethodCollection;

class MethodCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfMethodCollection()
    {
        $collection = new MethodCollection();
        $this->assertInstanceOf('\ClassGeneration\MethodCollection', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddMethodFromInstace()
    {
        $Method = new Method(array('name' => 'test'));
        $collection = new MethodCollection();
        $collection->add($Method);
        $this->assertCount(1, $collection);
        $this->assertEquals('test', $collection->current()->getName());
        $collection->add('non-object');
    }

    public function testGetIterator()
    {
        $collection = new MethodCollection();
        $this->assertInstanceOf('\ClassGeneration\MethodIterator', $collection->getIterator());
    }

    public function testRemoveByName()
    {
        $collection = new MethodCollection();
        $collection->add(new Method(array('name' => 'test')));
        $this->assertCount(1, $collection);
        $collection->removeByName('test');
        $this->assertCount(0, $collection);
    }

    public function testParseToString()
    {
        $collection = new MethodCollection();
        $collection->add(new Method(array('name' => 'test1')));
        $collection->add(new Method(array('name' => 'test2')));
        $expected = PHP_EOL
            . '    public function test1()' . PHP_EOL
            . '    {' . PHP_EOL
            . '        //TODO: implements the test1 method' . PHP_EOL
            . '    }' . PHP_EOL . PHP_EOL
            . '    public function test2()' . PHP_EOL
            . '    {' . PHP_EOL
            . '        //TODO: implements the test2 method' . PHP_EOL
            . '    }' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }
}
