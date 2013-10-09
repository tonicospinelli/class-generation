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

use ClassGeneration\Property;
use ClassGeneration\PropertyCollection;

/**
 * Property Collection ClassGenerator
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PropertyCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfPropertyCollection()
    {
        $collection = new PropertyCollection();
        $this->assertInstanceOf('\ClassGeneration\PropertyCollection', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddPropertyFromInstace()
    {
        $property = new Property(array('name' => 'test'));
        $collection = new PropertyCollection();
        $collection->add($property);
        $this->assertCount(1, $collection);
        $this->assertEquals('test', $collection->current()->getName());
        $collection->add('asd');
    }

    public function testGetIterator()
    {
        $collection = new PropertyCollection();
        $this->assertInstanceOf('\ClassGeneration\PropertyIterator', $collection->getIterator());
    }

    public function testRemoveByName()
    {
        $collection = new PropertyCollection();
        $collection->add(new Property(array('name' => 'test')));
        $this->assertCount(1, $collection);
        $collection->removeByName('test');
        $this->assertCount(0, $collection);
    }

    public function testParseToString()
    {
        $collection = new PropertyCollection();
        $collection->add(new Property(array('name' => 'test1')));
        $collection->add(new Property(array('name' => 'test2')));
        $expected = PHP_EOL
            . '    public $test1;' . PHP_EOL
            . '' . PHP_EOL
            . '    public $test2;' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }

    public function testGetByName()
    {
        $collection = new PropertyCollection();
        $collection->add(new Property(array('name' => 'test')));
        $this->assertEquals('test', $collection->getByName('test')->current()->getName());
    }
}
