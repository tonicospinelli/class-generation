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

use ClassGeneration\Argument;

/**
 * Argument ClassGenerator
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class ArgumentTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfArgument()
    {
        $argument = new Argument();
        $this->assertInstanceOf('\ClassGeneration\Argument', $argument);
        $this->assertInstanceOf('\ClassGeneration\ArgumentInterface', $argument);
    }

    public function testSetAndGetNameFormatted()
    {
        $argument = new Argument(array('name' => 'arg'));
        $this->assertEquals('arg', $argument->getName());
        $this->assertEquals('$arg', $argument->getNameFormatted());
    }

    public function testSetAndGetValue()
    {
        $argument = new Argument();
        $argument->setValue(1);
        $this->assertEquals(1, $argument->getValue());
    }

    public function testSetAndIsOptional()
    {
        $argument = new Argument();
        $this->assertFalse($argument->isOptional());
        $argument->setIsOptional();
        $this->assertTrue($argument->isOptional());
    }

    public function testSetAndGetAndHasType()
    {
        $argument = new Argument(array('type' => 'int'));
        $this->assertEquals('int', $argument->getType());
        $this->assertFalse($argument->hasType());
        $argument->setType('\ClassGeneration');
        $this->assertTrue($argument->hasType());
    }

    public function testSetAndGetDescription()
    {
        $argument = new Argument();
        $argument->setDescription('test');
        $this->assertEquals('test', $argument->getDescription());
    }

    public function testParseArgumentWithoutTypeAndRequiredToString()
    {
        $argument = new Argument();
        $argument->setType('int')
            ->setName('arg');
        $this->assertEquals('$arg', $argument->toString());
    }

    public function testParseArgumentWithoutTypeAndOptionalToString()
    {
        $argument = new Argument();
        $argument->setType('int')
            ->setIsOptional()
            ->setValue(0)
            ->setName('arg');
        $this->assertEquals('$arg = 0', $argument->toString());
    }


    public function testParseArgumentWithTypeAndRequiredToString()
    {
        $argument = new Argument();
        $argument->setType('\ClassGeneration')
            ->setName('arg');
        $this->assertEquals('\ClassGeneration $arg', $argument->toString());
    }

    public function testParseArgumentWithTypeAndOptionalToString()
    {
        $argument = new Argument();
        $argument->setType('\ClassGeneration')
            ->setIsOptional()
            ->setName('arg');
        $this->assertEquals('\ClassGeneration $arg = NULL', $argument->toString());
    }
}
