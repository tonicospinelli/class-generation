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

use ClassGeneration\Property;
use ClassGeneration\PropertyCollection;

class PropertyCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfPropertyCollection()
    {
        $collection = new PropertyCollection();
        $this->assertInstanceOf('\ClassGeneration\PropertyCollection', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddPropertyFromInstace()
    {
        $property = new Property(array('name' => 'test'));
        $collection = new PropertyCollection();
        $collection->add($property);
        $this->assertCount(1, $collection);
        $this->assertEquals('test', $collection->current()->getName());
        $collection->add('asd');
    }

    public function testGetIterator()
    {
        $collection = new PropertyCollection();
        $this->assertInstanceOf('\ClassGeneration\PropertyIterator', $collection->getIterator());
    }

    public function testRemoveByName()
    {
        $collection = new PropertyCollection();
        $collection->add(new Property(array('name' => 'test')));
        $this->assertCount(1, $collection);
        $collection->removeByName('test');
        $this->assertCount(0, $collection);
    }

    public function testParseToString()
    {
        $collection = new PropertyCollection();
        $collection->add(new Property(array('name' => 'test1')));
        $collection->add(new Property(array('name' => 'test2')));
        $expected = PHP_EOL
            . '    public $test1;' . PHP_EOL
            . '' . PHP_EOL
            . '    public $test2;' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }

    public function testGetByName()
    {
        $collection = new PropertyCollection();
        $collection->add(new Property(array('name' => 'test')));
        $this->assertEquals('test', $collection->getByName('test')->current()->getName());
    }
}
