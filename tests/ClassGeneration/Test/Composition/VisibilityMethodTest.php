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
use ClassGeneration\Composition\VisibilityMethod;
use ClassGeneration\Visibility;

class VisibilityMethodTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfVisibilityCompositionMethod()
    {
        $traitMethod = new VisibilityMethod();
        $this->assertInstanceOf('\ClassGeneration\Composition\VisibilityMethod', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Composition\VisibilityMethodInterface', $traitMethod);
        $this->assertInstanceOf('\ClassGeneration\Element\VisibilityInterface', $traitMethod);
    }

    public function testSetAndGetName()
    {
        $traitMethod = new VisibilityMethod(array('name' => 'method'));
        $this->assertEquals('method', $traitMethod->getName());
    }

    public function testSetAndGetVisibility()
    {
        $traitMethod = new VisibilityMethod();
        $traitMethod->setVisibility(Visibility::TYPE_PUBLIC);
        $this->assertEquals(Visibility::TYPE_PUBLIC, $traitMethod->getVisibility());
    }

    public function testParseToString()
    {
        $traitMethod = VisibilityMethod::create('doSomething', 'ObjectTrait', Visibility::TYPE_PRIVATE);

        $expected = 'ObjectTrait::doSomething as private;' . PHP_EOL;
        $this->assertEquals($expected, $traitMethod->toString());
    }
}
