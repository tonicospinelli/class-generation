<?php

/*
 * This file is part of the ClassGeneration package.
 *
 * (c) Antonio Spinelli <tonicospinelli@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ClassGeneration\Test\Composition;

use ClassGeneration\Composition;
use ClassGeneration\Composition\ConflictingMethod;

class ConflictingMethodTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfConflictingCompositionMethod()
    {
        $traitMethod = new ConflictingMethod();
        $this->assertInstanceOf('\ClassGeneration\Composition\ConflictingMethod', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Composition\ConflictingMethodInterface', $traitMethod);
    }

    public function testSetAndGetName()
    {
        $traitMethod = new ConflictingMethod(array('name' => 'method'));
        $this->assertEquals('method', $traitMethod->getName());
    }

    public function testParseToString()
    {
        $traitMethod = new ConflictingMethod();
        $traitMethod->setTraitName('ObjectTrait');
        $traitMethod->setName('doSomething');
        $traitMethod->setInsteadOf('OtherTrait');

        $expected = 'ObjectTrait::doSomething insteadof OtherTrait;' . PHP_EOL;
        $this->assertEquals($expected, $traitMethod->toString());
    }
}
