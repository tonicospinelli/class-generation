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
use ClassGeneration\Property;

/**
 * Tag DocBlock ClassGenerator
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
        $this->assertInstanceOf('\ClassGeneration\Element\ElementAbstract', $tag);
        $this->assertInstanceOf('\ClassGeneration\Element\ElementInterface', $tag);
        $this->assertInstanceOf('\ClassGeneration\DocBlock\Tag', $tag);
    }

    public function testSetOptions()
    {
        $tag = new Tag();
        $tag->setOptions(
            array(
                'name'        => Tag::TAG_ABSTRACT,
                'description' => 'Test Description'
            )
        );
        $this->assertEquals('abstract', $tag->getName());
    }

    public function testSetAndGetName()
    {
        $tag = new Tag();
        $tag->setName('param');
        $this->assertEquals('param', $tag->getName());
    }

    public function testSetAndGetType()
    {
        $tag = new Tag(array('type' => 'int'));
        $this->assertEquals('int', $tag->getType());
    }

    public function testSetAndGetVariable()
    {
        $tag = new Tag(array('variable' => 'test'));
        $this->assertEquals('test', $tag->getVariable());
    }

    public function testSetAndGetDescription()
    {
        $tag = new Tag(array('description' => 'test description'));
        $this->assertEquals('test description', $tag->getDescription());
    }

    public function testSetAndGetReferenced()
    {
        $tag = new Tag(array('referenced' => new Property()));
        $this->assertInstanceOf('\ClassGeneration\Property', $tag->getReferenced());
    }

    public function testSetAndGetIsInline()
    {
        $tag = new Tag(array('isInline' => true));
        $this->assertTrue($tag->isInline());
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
