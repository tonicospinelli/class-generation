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

use ClassGeneration\Constant;
use ClassGeneration\ConstantCollection;
use ClassGeneration\ConstantIterator;

class ConstantIteratortest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfConstantIterator()
    {
        $argumentIterator = new ConstantIterator(new ConstantCollection());
        $this->assertInstanceOf('\ClassGeneration\ConstantIterator', $argumentIterator);
    }

    public function testCurrentElementInConstantIterator()
    {
        $collection = new ConstantCollection(array(new Constant(array('name' => 'test'))));
        $iterator = new ConstantIterator($collection);
        $this->assertEquals('test', $iterator->current()->getName());
    }
}
