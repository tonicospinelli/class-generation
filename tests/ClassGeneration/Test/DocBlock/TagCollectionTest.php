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

namespace ClassGeneration\Test\DocBlock;

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\Property;

/**
 * Tag Collection ClassGenerator
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
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
}
