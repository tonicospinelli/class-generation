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

use ClassGeneration\Composition\AliasMethod;
use ClassGeneration\PhpClass;
use ClassGeneration\Visibility;

class AliasMethodTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfAliasCompositionMethod()
    {
        $traitMethod = new AliasMethod('A', 'something', 'doSomething');
        $this->assertInstanceOf('\ClassGeneration\Composition\AliasMethod', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Composition\AliasMethodInterface', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Element\AliasInterface', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Element\VisibilityInterface', $traitMethod);
    }

    public function testSetAndGetName()
    {
        $traitMethod = new AliasMethod('A', 'something', 'doSomething');
        $this->assertEquals('something', $traitMethod->getName());
    }

    public function testSetAndGetParent()
    {
        $traitMethod = new AliasMethod('A', 'something', 'doSomething');
        $traitMethod->setParent(new PhpClass());
        $this->assertInstanceOf('\ClassGeneration\PhpClass', $traitMethod->getParent());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetInvalidParent()
    {
        $traitMethod = new AliasMethod('A', 'something', 'doSomething');
        $traitMethod->setParent(new AliasMethod('A', 'something', 'doSomething'));
    }

    public function testSetAndGetAlias()
    {
        $traitMethod = new AliasMethod('A', 'something', 'bla');
        $this->assertTrue($traitMethod->hasAlias());
        $this->assertEquals('bla', $traitMethod->getAlias());
    }

    public function testSetAndGetVisibility()
    {
        $traitMethod = new AliasMethod('A', 'something', 'doSomething', Visibility::TYPE_PUBLIC);
        $this->assertEquals(Visibility::TYPE_PUBLIC, $traitMethod->getVisibility());
    }

    public function testParseToStringWithAlias()
    {
        $traitMethod = new AliasMethod('ObjectTrait', 'doSomething', 'do');

        $expected = 'ObjectTrait::doSomething as do;' . PHP_EOL;
        $this->assertEquals($expected, $traitMethod->toString());
    }

    public function testParseToStringWithAliasAndVisibility()
    {
        $traitMethod = new AliasMethod('ObjectTrait', 'doSomething', 'do', Visibility::TYPE_PRIVATE);

        $expected = 'ObjectTrait::doSomething as private do;' . PHP_EOL;
        $this->assertEquals($expected, $traitMethod->toString());
    }
}
