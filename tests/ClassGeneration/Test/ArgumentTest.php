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

use ClassGeneration\Argument;

class ArgumentTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfArgument()
    {
        $argument = new Argument();
        $this->assertInstanceOf('\ClassGeneration\Argument', $argument);
        $this->assertInstanceOf('\ClassGeneration\ArgumentInterface', $argument);
    }

    public function testSetAndGetNameFormatted()
    {
        $argument = new Argument(array('name' => 'arg'));
        $this->assertEquals('arg', $argument->getName());
        $this->assertEquals('$arg', $argument->getNameFormatted());
    }

    public function testSetAndGetValue()
    {
        $argument = new Argument();
        $argument->setValue(1);
        $this->assertEquals(1, $argument->getValue());
    }

    public function testSetAndIsOptional()
    {
        $argument = new Argument();
        $this->assertFalse($argument->isOptional());
        $argument->setIsOptional();
        $this->assertTrue($argument->isOptional());
    }

    public function testSetAndGetAndHasType()
    {
        $argument = new Argument(array('type' => 'int'));
        $this->assertEquals('int', $argument->getType());
        $this->assertFalse($argument->hasType());
        $argument->setType('\ClassGeneration');
        $this->assertTrue($argument->hasType());
    }

    public function testSetAndGetDescription()
    {
        $argument = new Argument();
        $argument->setDescription('test');
        $this->assertEquals('test', $argument->getDescription());
    }

    public function testParseArgumentWithoutTypeAndRequiredToString()
    {
        $argument = new Argument();
        $argument->setType('int')
            ->setName('arg');
        $this->assertEquals('$arg', $argument->toString());
    }

    public function testParseArgumentWithoutTypeAndOptionalToString()
    {
        $argument = new Argument();
        $argument->setType('int')
            ->setIsOptional()
            ->setValue(0)
            ->setName('arg');
        $this->assertEquals('$arg = 0', $argument->toString());
    }


    public function testParseArgumentWithTypeAndRequiredToString()
    {
        $argument = new Argument();
        $argument->setType('\ClassGeneration')
            ->setName('arg');
        $this->assertEquals('\ClassGeneration $arg', $argument->toString());
    }

    public function testParseArgumentWithTypeAndOptionalToString()
    {
        $argument = new Argument();
        $argument->setType('\ClassGeneration')
            ->setIsOptional()
            ->setName('arg');
        $this->assertEquals('\ClassGeneration $arg = NULL', $argument->toString());
    }
}
