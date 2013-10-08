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

use ClassGeneration\Constant;
use ClassGeneration\ConstantCollection;
use ClassGeneration\ConstantIterator;

/**
 * Constant Iterator ClassGenerator
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class ConstantIteratortest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfConstantIterator()
    {
        $argumentIterator = new ConstantIterator(new ConstantCollection());
        $this->assertInstanceOf('\ClassGeneration\ConstantIterator', $argumentIterator);
    }

    public function testCurrentElementInConstantIterator()
    {
        $collection = new ConstantCollection(array(
            new Constant(array('name' => 'test')),
        ));
        $iterator = new ConstantIterator($collection);
        $this->assertEquals('test', $iterator->current()->getName());
    }
}
