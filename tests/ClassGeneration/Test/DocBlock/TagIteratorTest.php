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

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\DocBlock\TagIterator;

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
