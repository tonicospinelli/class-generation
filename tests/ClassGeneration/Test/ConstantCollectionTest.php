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
use ClassGeneration\ConstantCollection;

/**
 * Constant Collection ClassGenerator
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class ConstantCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfConstantCollection()
    {
        $collection = new ConstantCollection();
        $this->assertInstanceOf('\ClassGeneration\ConstantCollection', $collection);
    }

    public function testAddConstantFromInstace()
    {
        $constant = new Constant(array('name' => 'test'));
        $collection = new ConstantCollection();
        $collection->add($constant);
        $this->assertCount(1, $collection);
        $this->assertEquals('test', $collection->current()->getName());
    }

    public function testAddConstantFromArray()
    {
        $collection = new ConstantCollection();
        $collection->add(array('name' => 'test'));
        $this->assertCount(1, $collection);
        $this->assertEquals('test', $collection->current()->getName());
    }

    public function getIterator()
    {
        $collection = new ConstantCollection();
        $this->assertInstanceOf('\ClassGeneration\ConstantIterator', $collection->getIterator());
    }

    public function testContantCollectionToString()
    {
        $collection = new ConstantCollection();
        $collection->add(new Constant(array(
            'name'  => 'test',
            'value' => 1,
        )));
        $expected = PHP_EOL . str_repeat(' ', $collection->current()->getTabulation()) . 'const TEST = 1;' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }

    public function removeByName()
    {
        $collection = new ConstantCollection();
        $collection->add(new Constant(array(
            'name'  => 'test',
            'value' => 1,
        )));
        $this->assertCount(1, $collection);
        $collection->removeByName('test');
        $this->assertCount(0, $collection);
    }
}