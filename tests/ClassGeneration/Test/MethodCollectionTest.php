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


use ClassGeneration\Method;
use ClassGeneration\MethodCollection;

/**
 * Method Collection ClassGenerator
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class MethodCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfMethodCollection()
    {
        $collection = new MethodCollection();
        $this->assertInstanceOf('\ClassGeneration\MethodCollection', $collection);
    }

    public function testAddMethodFromInstace()
    {
        $Method = new Method(array('name' => 'test'));
        $collection = new MethodCollection();
        $collection->add($Method);
        $this->assertCount(1, $collection);
        $this->assertEquals('test', $collection->current()->getName());
    }

    public function testGetIterator()
    {
        $collection = new MethodCollection();
        $this->assertInstanceOf('\ClassGeneration\MethodIterator', $collection->getIterator());
    }

    public function testRemoveByName()
    {
        $collection = new MethodCollection();
        $collection->add(new Method(array('name' => 'test')));
        $this->assertCount(1, $collection);
        $collection->removeByName('test');
        $this->assertCount(0, $collection);
    }

    public function testParseToString()
    {
        $collection = new MethodCollection();
        $collection->add(new Method(array('name' => 'test1')));
        $collection->add(new Method(array('name' => 'test2')));
        $expected = '
    public function test1()
    {
        //TODO: implements the test1 method
    }

    public function test2()
    {
        //TODO: implements the test2 method
    }' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }
}