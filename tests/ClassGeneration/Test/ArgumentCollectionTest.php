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

use ClassGeneration\Argument;
use ClassGeneration\ArgumentCollection;

/**
 * Argument Collection ClassGenerator
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class ArgumentCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfArgumentCollection()
    {
        $collection = new ArgumentCollection();
        $this->assertInstanceOf('\ClassGeneration\ArgumentCollection', $collection);
    }

    public function testAddArgumentFromInstace()
    {
        $argument = new Argument();
        $collection = new ArgumentCollection();
        $collection->add($argument);
        $this->assertCount(1, $collection);
    }

    public function testAddArgumentFromArray()
    {
        $argument = new Argument();
        $collection = new ArgumentCollection();
        $collection->add($argument);
        $this->assertCount(1, $collection);
    }

    public function testGetIterator()
    {
        $collection = new ArgumentCollection();
        $this->assertInstanceOf('\ClassGeneration\ArgumentIterator', $collection->getIterator());
    }

    public function testImplodeRequiredArguments()
    {
        $collection = new ArgumentCollection(array(
            new Argument(array(
                'name' => 'arg1',
                'type' => '\ClassGeneration'
            )),
            new Argument(array(
                'name' => 'arg2',
                'type' => 'int'
            )),
        ));
        $string = $collection->implode();
        $this->assertEquals('\ClassGeneration $arg1, $arg2', $string);
    }

    public function testImplodeRequiredAndOptionalArguments()
    {
        $collection = new ArgumentCollection(array(
            new Argument(array(
                'name' => 'arg1',
                'type' => '\ClassGeneration',
                'isOptional' => true,
            )),
            new Argument(array(
                'name' => 'arg2',
                'type' => 'int'
            )),
        ));
        $string = $collection->implode();
        $this->assertEquals('$arg2, \ClassGeneration $arg1 = NULL', $string);
    }

    public function testRemoveByName()
    {
    }
}