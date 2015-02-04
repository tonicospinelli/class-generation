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
use ClassGeneration\Composition\AliasMethod;
use ClassGeneration\Visibility;

class AliasMethodTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfAliasCompositionMethod()
    {
        $traitMethod = new AliasMethod();
        $this->assertInstanceOf('\ClassGeneration\Composition\AliasMethod', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Composition\AliasMethodInterface', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Element\AliasInterface', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Element\VisibilityInterface', $traitMethod);
    }

    public function testSetAndGetName()
    {
        $traitMethod = new AliasMethod(array('name' => 'arg'));
        $this->assertEquals('arg', $traitMethod->getName());
    }

    public function testSetAndGetAlias()
    {
        $traitMethod = new AliasMethod();
        $traitMethod->setAlias('bla');
        $this->assertTrue($traitMethod->hasAlias());
        $this->assertEquals('bla', $traitMethod->getAlias());
    }

    public function testSetAndGetVisibility()
    {
        $traitMethod = new AliasMethod();
        $traitMethod->setVisibility(Visibility::TYPE_PUBLIC);
        $this->assertEquals(Visibility::TYPE_PUBLIC, $traitMethod->getVisibility());
    }

    public function testParseToStringWithAlias()
    {
        $composition = new Composition();
        $composition->setName('ObjectTrait');
        $traitMethod = new AliasMethod();
        $traitMethod->setParent($composition);
        $traitMethod->setName('doSomething');
        $traitMethod->setAlias('do');

        $expected = 'ObjectTrait::doSomething as do;' . PHP_EOL;
        $this->assertEquals($expected, $traitMethod->toString());
    }

    public function testParseToStringWithVisibility()
    {
        $composition = new Composition();
        $composition->setName('ObjectTrait');
        $traitMethod = new AliasMethod();
        $traitMethod->setParent($composition);
        $traitMethod->setName('doSomething');
        $traitMethod->setVisibility(Visibility::TYPE_PRIVATE);

        $expected = 'ObjectTrait::doSomething as private;' . PHP_EOL;
        $this->assertEquals($expected, $traitMethod->toString());
    }

    public function testParseToStringWithAliasAndVisibility()
    {
        $composition = new Composition();
        $composition->setName('ObjectTrait');
        $traitMethod = new AliasMethod();
        $traitMethod->setParent($composition);
        $traitMethod->setName('doSomething');
        $traitMethod->setAlias('do');
        $traitMethod->setVisibility(Visibility::TYPE_PRIVATE);

        $expected = 'ObjectTrait::doSomething as private do;' . PHP_EOL;
        $this->assertEquals($expected, $traitMethod->toString());
    }
}
