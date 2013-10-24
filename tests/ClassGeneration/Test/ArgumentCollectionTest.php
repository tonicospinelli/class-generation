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

use ClassGeneration\Argument;
use ClassGeneration\ArgumentCollection;

class ArgumentCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfArgumentCollection()
    {
        $collection = new ArgumentCollection();
        $this->assertInstanceOf('\ClassGeneration\ArgumentCollection', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddArgumentFromInstace()
    {
        $argument = new Argument();
        $collection = new ArgumentCollection();
        $collection->add($argument);
        $collection->add(array('name' => 'arg2'));
        $this->assertCount(2, $collection);
    }

    public function testAddArgumentFromArray()
    {
        $argument = new Argument();
        $collection = new ArgumentCollection();
        $collection->add($argument);
        $this->assertCount(1, $collection);
    }

    public function testGetIterator()
    {
        $collection = new ArgumentCollection();
        $this->assertInstanceOf('\ClassGeneration\ArgumentIterator', $collection->getIterator());
    }

    public function testToStringRequiredArguments()
    {
        $collection = new ArgumentCollection(
            array(
                new Argument(array('name' => 'arg1', 'type' => '\ClassGeneration')),
                new Argument(array('name' => 'arg2', 'type' => 'int')),
            )
        );
        $string = $collection->toString();
        $this->assertEquals('\ClassGeneration $arg1, $arg2', $string);
    }

    public function testToStringRequiredAndOptionalArguments()
    {
        $collection = new ArgumentCollection(
            array(
                new Argument(array('name' => 'arg1', 'type' => '\ClassGeneration', 'isOptional' => true)),
                new Argument(array('name' => 'arg2', 'type' => 'int')),
            )
        );
        $string = $collection->toString();
        $this->assertEquals('$arg2, \ClassGeneration $arg1 = NULL', $string);
    }

    public function testRemoveByName()
    {
        $arg1 = new Argument();
        $arg1->setName('arg1');
        $arg2 = clone $arg1;
        $arg2->setName('arg2');
        $arg3 = clone $arg1;
        $arg3->setName('arg3');
        $arg4 = clone $arg1;
        $arg4->setName('arg4');

        $collection = new ArgumentCollection(array($arg1, $arg2, $arg3, $arg4));
        $this->assertCount(4, $collection);

        $removed = $collection->removeByName('arg2');
        $this->assertCount(1, $removed);
        $this->assertCount(3, $collection);

        $removed = $collection->removeByName($arg1);
        $this->assertCount(1, $removed);
        $this->assertCount(2, $collection);

        $removed = $collection->removeByName('test');
        $this->assertCount(0, $removed);
        $this->assertCount(2, $collection);
    }
}
