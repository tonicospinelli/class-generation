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

use ClassGeneration\DocBlock\Tag;
use ClassGeneration\PhpClass;
use ClassGeneration\UseClass;

/**
 * Use ClassGenerator
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class UseTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfUseClass()
    {
        $use = new UseClass();
        $this->assertInstanceOf('\ClassGeneration\UseClass', $use);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetParent()
    {
        $code = new PhpClass();
        $use = new UseClass();
        $use->init();
        $use->setOptions(array('parent' => $code));
        $this->assertInstanceOf('\ClassGeneration\PhpClass', $use->getParent());
        $use->setParent(new Tag());
    }

    public function testParseToStringWithoutAlias()
    {
        $use = new UseClass();
        $use->setClassName('ClassGeneration\Code');
        $expected = 'use ClassGeneration\Code;' . PHP_EOL;
        $this->assertEquals($expected, $use->toString());
    }

    public function testParseToStringWithAlias()
    {
        $use = new UseClass();
        $use->setClassName('ClassGeneration\Code')
            ->setAlias('MyCode');
        $expected = 'use ClassGeneration\Code as MyCode;' . PHP_EOL;
        $this->assertEquals($expected, $use->toString());
    }
}