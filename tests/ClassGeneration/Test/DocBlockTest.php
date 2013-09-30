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
namespace ClassGeneration\Test;

use ClassGeneration\DocBlock;
use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock\TagCollection;
use ClassGeneration\Property;

/**
 * DocBlock ClassGenerator
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class DocBlockTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfDocBlock()
    {
        $docBlock = new DocBlock();
        $this->assertInstanceOf('\ClassGeneration\DocBlock', $docBlock);
    }

    public function testGetDescription()
    {
        $docBlock = new DocBlock();
        $docBlock->setOptions(array('description' => 'test'));
        $this->assertEquals('test', $docBlock->getDescription());
    }

    public function testSetDescription()
    {
        $docBlock = new DocBlock();
        $docBlock->setDescription('test');
        $this->assertEquals('test', $docBlock->getDescription());
    }

    public function testSetOptions()
    {
        $docBlock = new DocBlock();
        $docBlock->setOptions(array('description' => 'test'));
        $this->assertEquals('test', $docBlock->getDescription());
    }


    public function testAddTag()
    {
        $docBlock = new DocBlock();
        $tag = new Tag();
        $docBlock->addTag($tag);
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testSetTagCollection()
    {
        $docBlock = new DocBlock();
        $docBlock->setTagCollection(new TagCollection(array(new Tag())));
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testRemoveTagsByName()
    {
        $docBlock = new DocBlock();
        $docBlock->setTagCollection(new TagCollection(array(
            new Tag(array('name' => 'param')),
            new Tag(array('name' => 'return')),
        )));
        $this->assertCount(2, $docBlock->getTagCollection());
        $docBlock->removeTagsByName('return');
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testRemoveTagsByReference()
    {
        $docBlock = new DocBlock();
        $property = new Property(array('name' => 'test'));
        $docBlock->setTagCollection(new TagCollection(array(
            new Tag(array('name' => 'param', 'referenced' => $property)),
            new Tag(array('name' => 'param', 'referenced' => $property)),
            new Tag(array('name' => 'param')),
        )));
        $this->assertCount(3, $docBlock->getTagCollection());
        $docBlock->removeTagsByReference($property);
        $this->assertCount(1, $docBlock->getTagCollection());
    }

    public function testGetTagsByName()
    {
        $docBlock = new DocBlock();
        $docBlock->setTagCollection(new TagCollection(array(
            new Tag(array('name' => 'param')),
            new Tag(array('name' => 'return')),
            new Tag(array('name' => 'param')),
        )));
        $this->assertCount(3, $docBlock->getTagCollection());
        $this->assertCount(2, $docBlock->getTagsByName('param'));
    }

    public function testGetTabulation()
    {
        $docBlock = new DocBlock();
        $this->assertEquals(4, $docBlock->getTabulation());
    }

    public function testGetTabulationFormatted()
    {
        $docBlock = new DocBlock();
        $expected = str_repeat(' ', $docBlock->getTabulation());
        $this->assertEquals($expected, $docBlock->getTabulationFormatted());
    }

    public function testSetTabulation()
    {
        $docBlock = new DocBlock();
        $this->assertEquals(4, $docBlock->getTabulation());
        $docBlock->setTabulation(2);
        $this->assertEquals(2, $docBlock->getTabulation());
    }

    public function testParseDocBlockToString()
    {
        $docBlock = new DocBlock();
        $docBlock->setDescription('test')
            ->addTag(new Tag(array('name' => 'param')));
        $expected = "
    /**
     * test
     * @param type
     */".PHP_EOL;

        $this->assertEquals($expected, $docBlock->toString());
    }
}