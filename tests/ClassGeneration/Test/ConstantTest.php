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

use ClassGeneration\Constant;
use ClassGeneration\DocBlock;

class ConstantTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfConstant()
    {
        $constant = new Constant();
        $this->assertInstanceOf('\ClassGeneration\Constant', $constant);
        $this->assertInstanceOf('\ClassGeneration\ConstantInterface', $constant);
    }

    public function testSetAndGetName()
    {
        $constant = new Constant(array('name' => 'testA'));
        $this->assertEquals('testA', $constant->getName());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetValue()
    {
        $constant = new Constant(array('value' => 1));
        $this->assertEquals(1, $constant->getValue());
        $constant->setValue(new \Stdclass());
    }

    public function testSetAndGetDescription()
    {
        $constant = new Constant(array('description' => 'test description'));
        $constant->setDescription('test2');
        $this->assertEquals('test2', $constant->getDescription());
    }

    public function testSetAndGetDocBlock()
    {
        $constant = new Constant();
        $doc = new DocBlock(array('description' => 'Test New DocBlock'));
        $constant->setDocBlock($doc);
        $this->assertEquals('Test New DocBlock', $constant->getDescription());
    }

    public function testParseConstantToString()
    {
        $constant = new Constant();
        $tab = $constant->getTabulation();
        $constant->setName('test')->setValue(1);
        $string = $constant->toString();
        $expected = PHP_EOL . str_repeat(' ', $tab) . 'const TEST = 1;' . PHP_EOL;
        $this->assertEquals($expected, $string);
    }
}
