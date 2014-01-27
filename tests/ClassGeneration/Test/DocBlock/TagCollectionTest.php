<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Test\DocBlock;

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\Property;

class TagCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfTagCollection()
    {
        $tagCollection = new TagCollection();
        $this->assertInstanceOf('\ClassGeneration\DocBlock\TagCollection', $tagCollection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddTag()
    {
        $tagCollection = new TagCollection();
        $tagCollection->add(new Tag());
        $this->assertCount(1, $tagCollection);
        $tagCollection->add(new \stdClass());
    }

    public function testIsUniqueTag()
    {
        $tagCollection = new TagCollection();
        $this->assertTrue($tagCollection->isUniqueTag('return'));
        $this->assertFalse($tagCollection->isUniqueTag('property'));
    }

    public function testGetIterator()
    {
        $tagCollection = new TagCollection();
        $this->assertInstanceOf('\ClassGeneration\DocBlock\TagIterator', $tagCollection->getIterator());
    }

    public function testRemoveByReferece()
    {
        $tagCollection = new TagCollection();
        $property = new Property();
        $tagCollection->add(new Tag(array('referenced' => $property)));
        $this->assertCount(1, $tagCollection);
        $tagCollection->removeByReferece($property);
        $this->assertCount(0, $tagCollection);
    }

    public function testRemoveByName()
    {
        $tagCollection = new TagCollection();
        $property = new Property();
        $tagCollection->add(new Tag(array('referenced' => $property, 'name' => 'param')));
        $this->assertCount(1, $tagCollection);
        $tagCollection->removeByName('param');
        $this->assertCount(0, $tagCollection);
    }

    public function testSortAsc()
    {
        $tagCollection = new TagCollection();
        $tagCollection->add(new Tag(array('name' => 'return')));
        $tagCollection->add(new Tag(array('name' => 'param')));
        $tagCollection->add(new Tag(array('name' => 'param')));
        $this->assertEquals('return', $tagCollection->first()->getName());
        $tagCollection->sortAsc();
        $this->assertEquals('param', $tagCollection->first()->getName());
    }

    public function testSortDesc()
    {
        $tagCollection = new TagCollection();
        $tagCollection->add(new Tag(array('name' => 'param',)));
        $tagCollection->add(new Tag(array('name' => 'param',)));
        $tagCollection->add(new Tag(array('name' => 'return',)));
        $this->assertEquals('param', $tagCollection->first()->getName());
        $tagCollection->sortDesc();
        $this->assertEquals('return', $tagCollection->first()->getName());
    }

    public function testToString()
    {
        $tagCollection = new TagCollection();
        $tagCollection->add(new Tag(array('name' => 'param', 'variable' => 'test')));
        $tagCollection->add(new Tag(array('name' => 'return',)));

        $expexted = ' * @param mixed $test' . PHP_EOL
            . ' * @return mixed' . PHP_EOL;
        $this->assertEquals($expexted, $tagCollection->toString());
    }

    public function testGetTagsByName()
    {
        $tagCollection = new TagCollection();
        $tagCollection->add(new Tag(array('name' => 'param',)));
        $tagCollection->add(new Tag(array('name' => 'param',)));
        $tagCollection->add(new Tag(array('name' => 'return',)));
        $tagCollection->add(new Tag(array('name' => 'internal',)));
        $this->assertCount(4, $tagCollection);
        $this->assertCount(2, $tagCollection->getByName('param'));
        $this->assertCount(2, $tagCollection->getByName(array('return', 'internal')));
    }
}
