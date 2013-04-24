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

use ClassGeneration\Constant;
use ClassGeneration\DocBlock;

/**
 * Constants ClassGenerator
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class ConstantTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfConstant()
    {
        $constant = new Constant();
        $this->assertInstanceOf('\ClassGeneration\Constant', $constant);
    }

    public function testGetName()
    {
        $constant = new Constant(array('name' => 'testA'));
        $this->assertEquals('testA', $constant->getName());
    }

    public function testSetName()
    {
        $constant = new Constant(array('name' => 'testA'));
        $constant->setName('testB');
        $this->assertEquals('testB', $constant->getName());
    }

    public function testGetValue()
    {
        $constant = new Constant(array('value' => 1));
        $this->assertEquals(1, $constant->getValue());
    }

    public function testSetValue()
    {
        $constant = new Constant();
        $constant->setValue(1);
        $this->assertEquals(1, $constant->getValue());
    }

    public function testSetDescription()
    {
        $constant = new Constant(array('description' => 'test description'));
        $constant->setDescription('test2');
        $this->assertEquals('test2', $constant->getDescription());
    }

    public function testGetDescription()
    {
        $constant = new Constant(array('description' => 'test description'));
        $this->assertEquals('test description', $constant->getDescription());
    }

    public function testSetDocBlock()
    {
        $constant = new Constant();
        $doc = new DocBlock();
        $doc->setDescription('test doc');
        $constant->setDocBlock($doc);
        $this->assertEquals('test doc', $constant->getDescription());
    }

    public function testParseConstantToString()
    {
        $constant = new Constant();
        $tab = $constant->getTabulation();
        $constant->setName('test')->setValue(1);
        $string = $constant->toString();
        $expected = PHP_EOL . str_repeat(' ', $tab) . 'const TEST = 1;' . PHP_EOL;
        $this->assertEquals($expected, $string);
    }
}