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
namespace ClassGeneration\Test\DocBlock;

use ClassGeneration\DocBlock\Tag;

/**
 * Tag DocBlock ClassGenerator
 *
 * @category   ClassGenerator
 * @package    ClassGeneration_DocBlock
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class TagTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingAnInstanceOfTagDocblock()
    {
        $tag = new Tag();
        $this->assertInstanceOf('\ClassGeneration\DocBlock\Tag', $tag);
    }

    public function testSetOptions()
    {
        $tag = new Tag();
        $tag->setOptions(array('name' => Tag::TAG_ABSTRACT));
        $this->assertEquals('abstract', $tag->getName());
    }

    public function testGetName()
    {
        $tag = new Tag(array('name' => 'param'));
        $this->assertEquals('param', $tag->getName());
    }

    public function testSetName()
    {
        $tag = new Tag();
        $tag->setName('param');
        $this->assertEquals('param', $tag->getName());
    }

    public function testGetType()
    {
        $tag = new Tag(array('type' => 'int'));
        $this->assertEquals('int', $tag->getType());
    }

    public function testSetType()
    {
        $tag = new Tag();
        $tag->setType('int');
        $this->assertEquals('int', $tag->getType());
    }

    public function testGetVariable()
    {
        $tag = new Tag(array('variable' => 'test'));
        $this->assertEquals('test', $tag->getVariable());
    }

    public function testSetVariable()
    {
        $tag = new Tag();
        $tag->setVariable('test');
        $this->assertEquals('test', $tag->getVariable());
    }

    public function testGetDescription()
    {
        $tag = new Tag(array('description' => 'test description'));
        $this->assertEquals('test description', $tag->getDescription());
    }

    public function testSetDescription()
    {
        $tag = new Tag();
        $tag->setDescription('test description');
        $this->assertEquals('test description', $tag->getDescription());
    }

    public function testGetReferenced()
    {
        $tag = new Tag(array('referenced' => 'test referenced'));
        $this->assertEquals('test referenced', $tag->getReferenced());
    }

    public function testSetReferenced()
    {
        $tag = new Tag(array('name' => 'see'));
        $ref = new Tag(array('name' => 'param'));
        $tag->setReferenced($ref);
        $this->assertInstanceOf('\ClassGeneration\DocBlock\Tag', $tag->getReferenced());
        $this->assertEquals('param', $tag->getReferenced()->getName());
    }

    public function testParseTagToString()
    {
        $tag = new Tag();
        $tag->setName(Tag::TAG_PROPERTY)
            ->setType('int')
            ->setDescription('property description');
        $this->assertEquals('@property int property description' . PHP_EOL, $tag->toString());
    }
}