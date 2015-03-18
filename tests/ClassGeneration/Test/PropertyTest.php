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
use ClassGeneration\DocBlock;
use ClassGeneration\Visibility;

class PropertyTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfProperty()
    {
        $property = new Property();
        $this->assertInstanceOf('\ClassGeneration\Property', $property);
        $this->assertInstanceOf('\ClassGeneration\Element\ElementAbstract', $property);
        $this->assertInstanceOf('\ClassGeneration\Element\ElementInterface', $property);
        $this->assertInstanceOf('\ClassGeneration\Element\VisibilityInterface', $property);
        $this->assertInstanceOf('\ClassGeneration\Element\StaticInterface', $property);
        $this->assertInstanceOf('\ClassGeneration\Element\DocumentBlockInterface', $property);
        $this->assertInstanceOf('\ClassGeneration\Element\Tabbable', $property);
    }

    public function testSetAndGetName()
    {
        $property = new Property();
        $property->setName('test');
        $this->assertEquals('test', $property->getName());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetVisibility()
    {
        $property = new Property();
        $this->assertEquals(Visibility::TYPE_PUBLIC, $property->getVisibility());
        $property->setVisibility('test');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetAndHasValue()
    {
        $property = new Property();
        $property->setValue(1);
        $this->assertEquals(1, $property->getValue());
        $this->assertTrue($property->hasValue());
        $property->setValue(new \Stdclass);
    }

    public function testSetAndGetType()
    {
        $property = new Property();
        $property->setType('int');
        $this->assertEquals('int', $property->getType());
    }

    public function testSetAndGetDescription()
    {
        $property = new Property();
        $property->setDescription('test');
        $this->assertEquals('test', $property->getDescription());
    }

    public function testParseToString()
    {
        $property = new Property();
        $property->setName('test')
            ->setType('int')
            ->setValue(1)
            ->setIsStatic();
        $property->getDocBlock()->setDescription('test');
        $expected = '' . PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test' . PHP_EOL
            . '     * @var int' . PHP_EOL
            . '     */' . PHP_EOL
            . '    public static $test = 1;' . PHP_EOL;
        $this->assertEquals($expected, $property->toString());
    }

    public function testSetDockBlock()
    {
        $property = new Property();
        $property->setName('test')
            ->setType('int')
            ->setValue(1);
        $property->setDocBlock(new DocBlock(array('description' => 'New description')));
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * New description' . PHP_EOL
            . '     */' . PHP_EOL
            . '    public $test = 1;' . PHP_EOL;
        $this->assertEquals($expected, $property->toString());
    }
}
