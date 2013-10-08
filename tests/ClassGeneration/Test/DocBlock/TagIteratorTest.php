<?php

/**
 * ClassGenerator
 * Copyright (c) 2012 ClassGenerator
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration\Test;

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\DocBlock\TagIterator;

/**
 * Tag Iterator ClassGenerator
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class TagIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfTagIterator()
    {
        $tagIterator = new TagIterator(new TagCollection());
        $this->assertInstanceOf('\ClassGeneration\DocBlock\TagIterator', $tagIterator);
    }

    public function testCountElementsInTagIterator()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
                new Tag(array('description' => 'property3')),
            )
        );
        $iterator = new TagIterator($collection);
        $this->assertEquals(3, $iterator->count());
    }

    public function testCurrentElementInTagIterator()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
                new Tag(array('description' => 'property3')),
            )
        );
        $iterator = new TagIterator($collection);
        $this->assertEquals('property1', $iterator->current()->getDescription());
    }

    public function testGetCollectionOfElements()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
                new Tag(array('description' => 'property3')),
            )
        );
        $iterator = new TagIterator($collection);
        $this->assertInstanceOf('\ClassGeneration\DocBlock\TagCollection', $iterator->getCollection());
    }

    public function testCurrentKeyElementInTagIterator()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
                new Tag(array('description' => 'property3')),
            )
        );
        $iterator = new TagIterator($collection);
        $this->assertEquals(0, $iterator->key());
    }

    public function testGoToNextElementInTagIterator()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
                new Tag(array('description' => 'property3')),
            )
        );
        $iterator = new TagIterator($collection);
        $this->assertEquals('property1', $iterator->current()->getDescription());
        $iterator->next();
        $this->assertEquals('property2', $iterator->current()->getDescription());
    }

    public function testRewindKeyInTagIterator()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
                new Tag(array('description' => 'property3')),
            )
        );
        $iterator = new TagIterator($collection);
        $this->assertEquals('property1', $iterator->current()->getDescription());
        $iterator->next();
        $this->assertEquals('property2', $iterator->current()->getDescription());
        $iterator->next();
        $this->assertEquals('property3', $iterator->current()->getDescription());
        $iterator->rewind();
        $this->assertEquals('property1', $iterator->current()->getDescription());
    }

    public function testSetCollectionElementsInTagIterator()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
                new Tag(array('description' => 'property3')),
            )
        );

        $iterator = new TagIterator($collection);
        $this->assertEquals('property1', $iterator->current()->getDescription());
        $iterator->next();
        $this->assertEquals('property2', $iterator->current()->getDescription());

        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'method1')),
                new Tag(array('description' => 'method2')),
                new Tag(array('description' => 'method3')),
            )
        );
        $iterator->setCollection($collection);
        $this->assertEquals('method1', $iterator->current()->getDescription());
        $iterator->next();
        $this->assertEquals('method2', $iterator->current()->getDescription());
    }

    public function testValidElementInTagIterator()
    {
        $collection = new TagCollection(
            array(
                new Tag(array('description' => 'property1')),
                new Tag(array('description' => 'property2')),
            )
        );

        $iterator = new TagIterator($collection);
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertFalse($iterator->valid());
    }
}
