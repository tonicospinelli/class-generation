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

use ClassGeneration\Property;
use ClassGeneration\PropertyCollection;
use ClassGeneration\PropertyIterator;

class PropertyIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfPropertyIterator()
    {
        $argumentIterator = new PropertyIterator(new PropertyCollection());
        $this->assertInstanceOf('\ClassGeneration\PropertyIterator', $argumentIterator);
    }

    public function testCurrentElementInPropertyIterator()
    {
        $collection = new PropertyCollection(array(new Property(array('name' => 'test'))));
        $iterator = new PropertyIterator($collection);
        $this->assertEquals('test', $iterator->current()->getName());
    }
}
