<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Test;

use ClassGeneration\InterfaceCollection;

class InterfaceCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfInterfaceCollection()
    {
        $collection = new InterfaceCollection();
        $this->assertInstanceOf('\ClassGeneration\InterfaceCollection', $collection);
    }

    public function testParseImplementsInterfaceToString()
    {
        $collection = new InterfaceCollection();
        $collection->add('\Countable');
        $expected = ' implements \Countable';
        $this->assertEquals($expected, $collection->toString());
    }
}
