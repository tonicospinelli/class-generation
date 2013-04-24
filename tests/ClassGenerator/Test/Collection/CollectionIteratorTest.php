<?php

/**
 * ClassGenerator
 *
 * Copyright (c) 2012 ClassGenerator
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration\Test\Collection;

use ClassGeneration\Collection\ArrayCollection;
use ClassGeneration\Collection\CollectionIterator;

/**
 * Collection Iterator
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
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

        $collection = new ArrayCollection(array(5,4,3,2,1,0));
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