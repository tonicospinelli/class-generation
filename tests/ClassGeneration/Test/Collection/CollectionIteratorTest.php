<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Test\Collection;

use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Collection\CollectionIterator;

class CollectionIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertInstanceOf('\ClassGeneration\Collection\CollectionIterator', $iterator);
    }

    public function testCountElementsInCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertEquals(6, $iterator->count());
    }

    public function testCurrentElementInCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertEquals(0, $iterator->current());
    }

    public function testGetCollectionOfElements()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertInstanceOf('\ClassGeneration\Collection\ArrayCollection', $iterator->getCollection());
    }

    public function testCurrentKeyElementInCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertEquals(0, $iterator->key());
    }

    public function testGoToNextElementInCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertEquals(0, $iterator->current());
        $iterator->next();
        $this->assertEquals(1, $iterator->current());
    }

    public function testRewindKeyInCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertEquals(0, $iterator->current());
        $iterator->next();
        $this->assertEquals(1, $iterator->current());
        $iterator->next();
        $this->assertEquals(2, $iterator->current());
        $iterator->rewind();
        $this->assertEquals(0, $iterator->current());
    }

    public function testSetCollectionElementsInCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1, 2, 3, 4, 5));
        $iterator = new CollectionIterator($collection);
        $this->assertEquals(0, $iterator->current());
        $iterator->next();
        $this->assertEquals(1, $iterator->current());

        $collection = new ArrayCollection(array(5, 4, 3, 2, 1, 0));
        $iterator->setCollection($collection);
        $this->assertEquals(5, $iterator->current());
        $iterator->next();
        $this->assertEquals(4, $iterator->current());
    }

    public function testValidElementInCollectionIterator()
    {
        $collection = new ArrayCollection(array(0, 1));
        $iterator = new CollectionIterator($collection);
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertFalse($iterator->valid());
    }
}
