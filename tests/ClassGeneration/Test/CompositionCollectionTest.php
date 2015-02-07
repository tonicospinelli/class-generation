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


use ClassGeneration\Composition;
use ClassGeneration\Composition\AliasMethod;
use ClassGeneration\Composition\ConflictingMethod;
use ClassGeneration\Composition\VisibilityMethod;
use ClassGeneration\CompositionCollection;
use ClassGeneration\Visibility;

class CompositionCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfCompositionCollection()
    {
        $collection = new CompositionCollection();
        $this->assertInstanceOf('\ClassGeneration\CompositionCollection', $collection);
    }

    public function testSetMethodCollection()
    {
        $collection = new CompositionCollection();
        $collection->addMethod(new AliasMethod('A', 'doSomething', 'doNothing'));
        $this->assertCount(1, $collection->getMethods());

        $collection->setMethods(new Composition\MethodCollection());
        $this->assertCount(0, $collection->getMethods());
    }

    public function testParseToStringSimpleCompositionCollection()
    {
        $collection = new CompositionCollection();
        $collection->addComposition('test');
        $expected = '    use test;' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }

    public function testParseToStringCompositionCollectionWithAliasMethod()
    {
        $doSomething = new AliasMethod('TestTrait', 'doSomething', 'doNothing');
        $somethingToDo = new AliasMethod('TestTrait', 'somethingToDo', 'nothingToDo', Visibility::TYPE_PRIVATE);
        $collection = new CompositionCollection();
        $collection->add('TestTrait');
        $collection->addMethod($doSomething);
        $collection->addMethod($somethingToDo);
        $expected = <<<EXPECTED
    use TestTrait {
        TestTrait::doSomething as doNothing;
        TestTrait::somethingToDo as private nothingToDo;
    }

EXPECTED;

        $this->assertEquals($expected, $collection->toString());
    }

    public function testParseToStringCompositionCollectionWithConflictingResolution()
    {
        $smallTalk = new ConflictingMethod('B', 'smallTalk', 'A');
        $bigTalk = new ConflictingMethod('A', 'bigTalk', 'B');
        $talk = new AliasMethod('B', 'bigTalk', 'talk');

        $collection = new CompositionCollection();
        $collection->add('A');
        $collection->add('B');
        $collection->addMethod($smallTalk);
        $collection->addMethod($bigTalk);
        $collection->addMethod($talk);
        $expected = <<<EXPECTED
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as talk;
    }

EXPECTED;

        $this->assertEquals($expected, $collection->toString());
    }

    public function testParseToStringCompositionCollectionWithVisibilityChanging()
    {
        $doSomething = new VisibilityMethod( 'TestTrait', 'doSomething',Visibility::TYPE_PRIVATE);
        $collection = new CompositionCollection();
        $collection->addMethod($doSomething);
        $expected = <<<EXPECTED
    use TestTrait {
        TestTrait::doSomething as private;
    }

EXPECTED;

        $this->assertEquals($expected, $collection->toString());
    }
}
