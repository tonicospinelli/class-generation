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

    public function testSetAndGetName()
    {
        $constant = new Constant(array('name' => 'testA'));
        $this->assertEquals('testA', $constant->getName());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetValue()
    {
        $constant = new Constant(array('value' => 1));
        $this->assertEquals(1, $constant->getValue());
        $constant->setValue(new \Stdclass());
    }

    public function testSetAndGetDescription()
    {
        $constant = new Constant(array('description' => 'test description'));
        $constant->setDescription('test2');
        $this->assertEquals('test2', $constant->getDescription());
    }

    public function testSetAndGetDocBlock()
    {
        $constant = new Constant();
        $doc = new DocBlock(array('description' => 'Test New DocBlock'));
        $constant->setDocBlock($doc);
        $this->assertEquals('Test New DocBlock', $constant->getDescription());
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