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

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddCompositionFromInstance()
    {
        $composition = new Composition(array('name' => 'ObjectTrait'));
        $collection = new CompositionCollection();
        $collection->add($composition);
        $this->assertCount(1, $collection);
        $this->assertEquals('ObjectTrait', $collection->current()->getName());
        $collection->add(array('name' => 'bla'));
    }

    public function getIterator()
    {
        $collection = new CompositionCollection();
        $this->assertInstanceOf('\ClassGeneration\CompositionIterator', $collection->getIterator());
    }

    public function testParseToStringSimpleCompositionCollection()
    {
        $collection = new CompositionCollection();
        $collection->addComposition(new Composition(array('name' => 'test')));
        $expected = '    use test;' . PHP_EOL;
        $this->assertEquals($expected, $collection->toString());
    }

    public function testParseToStringCompositionCollectionWithAliasMethod()
    {
        $composition = new Composition(array('name' => 'TestTrait'));
        $doSomething = new AliasMethod(array('name' => 'doSomething', 'traitName' => 'TestTrait', 'alias' => 'doNothing'));
        $somethingToDo = new AliasMethod(array('name' => 'somethingToDo', 'traitName' => 'TestTrait', 'alias' => 'nothingToDo', 'visibility' => Visibility::TYPE_PRIVATE));
        $collection = new CompositionCollection();
        $collection->add($composition);
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
        $compositionA = new Composition(array('name' => 'A'));
        $compositionB = new Composition(array('name' => 'B'));
        $smallTalk = new ConflictingMethod(array('name' => 'smallTalk', 'traitName' => 'B', 'insteadOf' => 'A'));
        $bigTalk = new ConflictingMethod(array('name' => 'bigTalk', 'traitName' => 'A', 'insteadOf' => 'B'));
        $talk = new AliasMethod(array('name' => 'bigTalk', 'traitName' => 'B', 'alias' => 'talk'));

        $collection = new CompositionCollection();
        $collection->add($compositionA);
        $collection->add($compositionB);
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
        $composition = new Composition(array('name' => 'TestTrait'));
        $doSomething = new VisibilityMethod(array('name' => 'doSomething', 'traitName' => 'TestTrait', 'visibility' => Visibility::TYPE_PRIVATE));
        $collection = new CompositionCollection();
        $collection->add($composition);
        $collection->addMethod($doSomething);
        $expected = <<<EXPECTED
    use TestTrait {
        TestTrait::doSomething as private;
    }

EXPECTED;

        $this->assertEquals($expected, $collection->toString());
    }
}
