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


use ClassGeneration\Constant;
use ClassGeneration\ConstantCollection;

class ConstantCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfConstantCollection()
    {
        $collection = new ConstantCollection();
        $this->assertInstanceOf('\ClassGeneration\ConstantCollection', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddConstantFromInstance()
    {
        $constant = new Constant();
        $collection = new ConstantCollection();
        $collection->add($constant);
        $this->assertCount(1, $collection);
        $this->assertEquals('constant1', $collection->current()->getName());
        $collection->add(array('name' => 'bla'));
    }

    public function getIterator()
    {
        $collection = new ConstantCollection();
        $this->assertInstanceOf('\ClassGeneration\ConstantIterator', $collection->getIterator());
    }

    public function testContantCollectionToString()
    {
        $collection = new ConstantCollection();
        $collection->add(new Constant(array('name' => 'test', 'value' => 1)));
        $expected = PHP_EOL . '    const TEST = 1;' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }

    public function testRemoveByName()
    {
        $collection = new ConstantCollection();
        $collection->add(new Constant());
        $collection->add(new Constant(array('name' => 'test2', 'value' => 1)));
        $collection->add(new Constant(array('name' => 'test3', 'value' => 1)));
        $this->assertCount(3, $collection);
        $collection->removeByName(array('constant1', 'test2'));
        $this->assertCount(1, $collection);
        $collection->removeByName('test3');
        $this->assertCount(0, $collection);
    }
}
