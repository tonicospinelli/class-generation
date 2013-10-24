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

use ClassGeneration\Method;
use ClassGeneration\MethodCollection;
use ClassGeneration\MethodIterator;

class MethodIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfMethodIterator()
    {
        $argumentIterator = new MethodIterator(new MethodCollection());
        $this->assertInstanceOf('\ClassGeneration\MethodIterator', $argumentIterator);
    }

    public function testCurrentElementInMethodIterator()
    {
        $collection = new MethodCollection(array(new Method(array('name' => 'test'))));
        $iterator = new MethodIterator($collection);
        $this->assertEquals('test', $iterator->current()->getName());
    }
}
