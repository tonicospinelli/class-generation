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
use ClassGeneration\Composition\MethodCollection;
use ClassGeneration\Composition\VisibilityMethod;
use ClassGeneration\Visibility;

class MethodCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfMethodCollection()
    {
        $collection = new MethodCollection();
        $this->assertInstanceOf('\ClassGeneration\Composition\MethodCollection', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddMethodFromInstance()
    {
        $method = new VisibilityMethod('TraitName', 'doSomething', Visibility::TYPE_PRIVATE);

        $collection = new MethodCollection();
        $collection->add($method);
        $this->assertCount(1, $collection);
        $this->assertEquals('doSomething', $collection->current()->getName());
        $collection->add('non-object');
    }

    public function testParseToString()
    {
        $method = new VisibilityMethod('TraitName', 'doSomething', Visibility::TYPE_PRIVATE);

        $collection = new MethodCollection();
        $collection->add($method);
        $expected = '{' . PHP_EOL
            . '        TraitName::doSomething as private;' . PHP_EOL
            . '    }' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }
}
