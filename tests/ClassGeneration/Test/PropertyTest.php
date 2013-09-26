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

use ClassGeneration\Property;
use ClassGeneration\DocBlock;

/**
 * Property ClassGenerator
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PropertyTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfProperty()
    {
        $property = new Property();
        $this->assertInstanceOf('\ClassGeneration\Property', $property);
    }

    public function testSetAndGetName()
    {
        $property = new Property();
        $property->setName('test');
        $this->assertEquals('test', $property->getName());
    }

    public function testSetAndGetAndHasValue()
    {
        $property = new Property();
        $property->setValue(1);
        $this->assertEquals(1, $property->getValue());
        $this->assertTrue($property->hasValue());
    }

    public function testSetAndGetType()
    {
        $property = new Property();
        $property->setType('int');
        $this->assertEquals('int', $property->getType());
    }

    public function testSetAndGetDescription()
    {
        $property = new Property();
        $property->setDescription('test');
        $this->assertEquals('test', $property->getDescription());
    }

    public function testParseToString()
    {
        $property = new Property();
        $property->setName('test')
            ->setType('int')
            ->setValue(1)
            ->setIsStatic();
        $property->setDescription('test');
        $expected = '
    /**
     * test
     * @var int
     */
    public static $test = 1;
';
        $this->assertEquals($expected, $property->toString());
    }
    public function testSetDockBlock()
    {
        $property = new Property();
        $property->setName('test')
            ->setType('int')
            ->setValue(1);
        $property->setDocBlock(new DocBlock(array('description' => 'New description')));
        $expected = '
    /**
     * New description
     */
    public $test = 1;
';
        $this->assertEquals($expected, $property->toString());
    }
}