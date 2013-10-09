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

use ClassGeneration\Visibility;

/**
 * @category   ClassGenerator
 * @package    ClassGenerator\Visibility
 * @copyright  Copyright (c) 2012
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL v.3
 * @author     Antonio Spinelli <tonicospinelli85@gmail.com>
 */
class VisibilityTest extends \PHPUnit_Framework_TestCase
{

    public function testPublic()
    {
        $this->assertEquals('public', Visibility::TYPE_PUBLIC);
    }

    public function testPrivate()
    {
        $this->assertEquals('private', Visibility::TYPE_PRIVATE);
    }

    public function testProtected()
    {
        $this->assertEquals('protected', Visibility::TYPE_PROTECTED);
    }

    public function testIsValid()
    {
        $this->assertTrue(Visibility::isValid('public'));
    }
}
