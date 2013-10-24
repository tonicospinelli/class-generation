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

use ClassGeneration\Argument;
use ClassGeneration\ArgumentCollection;
use ClassGeneration\ArgumentIterator;

class ArgumentIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfArgumentIterator()
    {
        $argumentIterator = new ArgumentIterator(new ArgumentCollection());
        $this->assertInstanceOf('\ClassGeneration\ArgumentIterator', $argumentIterator);
    }

    public function testCurrentElementInArgumentIterator()
    {
        $collection = new ArgumentCollection(array(new Argument(array('name' => 'arg1'))));
        $iterator = new ArgumentIterator($collection);
        $this->assertEquals('arg1', $iterator->current()->getName());
    }
}
