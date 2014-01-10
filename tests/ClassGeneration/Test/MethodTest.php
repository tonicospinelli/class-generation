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
use ClassGeneration\ArgumentCollection;
use ClassGeneration\PhpClass;
use ClassGeneration\DocBlock\Tag;
use ClassGeneration\Method;
use ClassGeneration\Visibility;

class MethodTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfMethod()
    {
        $method = new Method();
        $this->assertInstanceOf('\ClassGeneration\Method', $method);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetParent()
    {
        $code = new PhpClass();
        $method = new Method();
        $method->setParent($code);

        $this->assertInstanceOf('\ClassGeneration\PhpClassInterface', $method->getParent());
        $method->setParent(new Tag());
    }

    public function testSetAndGetName()
    {
        $method = new Method(array('name' => 'test'));
        $method->setName('test');
        $this->assertEquals('test', $method->getName());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetAndIsAbstract()
    {
        $method = new Method(array('name' => 'test'));
        $method->setIsAbstract();
        $this->assertTrue($method->isAbstract());
        $method->setIsInterface();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetAndIsInterface()
    {
        $method = new Method(array('name' => 'test'));
        $method->setIsInterface();
        $this->assertTrue($method->isInterface());
        $method->setIsAbstract();
    }

    public function testSetAndGetArguments()
    {
        $method = new Method();
        $arguments = new ArgumentCollection();
        $arguments->add(new Argument(array('name' => 'arg1')));
        $method->setArgumentCollection($arguments);

        $this->assertInstanceOf('\ClassGeneration\ArgumentCollection', $method->getArgumentCollection());
        $this->assertCount(1, $method->getArgumentCollection());
    }

    public function tesAddAndGetArgument()
    {
        $method = new Method();
        $method->addArgument(new Argument(array('name' => 'arg1')));

        $this->assertInstanceOf('\ClassGeneration\Argument', $method->getArgumentCollection()->get('arg1'));
        $this->assertEquals('arg1', $method->getArgumentCollection()->get('arg1')->getName());
    }

    public function testSetAndGetDescription()
    {
        $method = new Method();
        $method->setDescription('test');
        $this->assertEquals('test', $method->getDescription());
    }

    public function testSetAndGetReturns()
    {
        $method = new Method();
        $method->setReturns(new Tag(array('type' => 'bool')));
        $this->assertInstanceOf('\ClassGeneration\DocBlock\Tag', $method->getReturns());
        $this->assertEquals('bool', $method->getReturns()->getType());
    }

    public function testSetAndGetCode()
    {
        $method = new Method();
        $method->setCode('$test = 0');
        $this->assertEquals('$test = 0', $method->getCode());
    }

    public function testNormalMethodToString()
    {
        $method = new Method();
        $method->setName('test')
            ->setVisibility(Visibility::TYPE_PUBLIC)
            ->setCode('$test = 0;')
            ->addArgument(new Argument(array('name' => 'arg')))
            ->setDescription('test description');
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test description' . PHP_EOL
            . '     * @param mixed $arg' . PHP_EOL
            . '     */' . PHP_EOL
            . '    public function test($arg)' . PHP_EOL
            . '    {' . PHP_EOL
            . '        $test = 0;' . PHP_EOL
            . '    }' . PHP_EOL;
        $this->assertEquals($expected, $method->toString());
    }

    public function testAbstractMethodToString()
    {
        $method = new Method();
        $method->setName('test')
            ->setVisibility(Visibility::TYPE_PUBLIC)
            ->setCode('$test = 0;')
            ->setIsAbstract()
            ->addArgument(new Argument(array('name' => 'arg')))
            ->setDescription('test description');
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test description' . PHP_EOL
            . '     * @param mixed $arg' . PHP_EOL
            . '     */' . PHP_EOL
            . '    abstract public function test($arg);' . PHP_EOL;
        $this->assertEquals($expected, $method->toString());
    }

    public function testInterfaceMethodToString()
    {
        $method = new Method();
        $method->setName('test')
            ->setVisibility(Visibility::TYPE_PUBLIC)
            ->setCode('$test = 0;')
            ->setIsInterface()
            ->addArgument(new Argument(array('name' => 'arg')))
            ->setDescription('test description');
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test description' . PHP_EOL
            . '     * @param mixed $arg' . PHP_EOL
            . '     */' . PHP_EOL
            . '    public function test($arg);' . PHP_EOL;
        $this->assertEquals($expected, $method->toString());
    }

    public function testStaticMethodToString()
    {
        $method = new Method();
        $method->setName('test')
            ->setVisibility(Visibility::TYPE_PUBLIC)
            ->setCode('$test = 0;')
            ->setIsStatic()
            ->addArgument(new Argument(array('name' => 'arg')))
            ->setDescription('test description');
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test description' . PHP_EOL
            . '     * @param mixed $arg' . PHP_EOL
            . '     */' . PHP_EOL
            . '    public static function test($arg)' . PHP_EOL
            . '    {' . PHP_EOL
            . '        $test = 0;' . PHP_EOL
            . '    }' . PHP_EOL;
        $this->assertEquals($expected, $method->toString());
    }

    public function testAbstractAndStaticMethodToString()
    {
        $method = new Method();
        $method->setName('test')
            ->setVisibility(Visibility::TYPE_PUBLIC)
            ->setCode('$test = 0;')
            ->setIsAbstract()
            ->setIsStatic()
            ->addArgument(new Argument(array('name' => 'arg')))
            ->setDescription('test description');
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test description' . PHP_EOL
            . '     * @param mixed $arg' . PHP_EOL
            . '     */' . PHP_EOL
            . '    abstract public static function test($arg);' . PHP_EOL;
        $this->assertEquals($expected, $method->toString());
    }

    public function testFinalMethodToString()
    {
        $method = new Method();
        $method->setName('test')
            ->setVisibility(Visibility::TYPE_PUBLIC)
            ->setCode('$test = 0;')
            ->setIsFinal()
            ->addArgument(new Argument(array('name' => 'arg')))
            ->setDescription('test description');
        $expected = PHP_EOL
            . '    /**' . PHP_EOL
            . '     * test description' . PHP_EOL
            . '     * @param mixed $arg' . PHP_EOL
            . '     */' . PHP_EOL
            . '    final public function test($arg)' . PHP_EOL
            . '    {' . PHP_EOL
            . '        $test = 0;' . PHP_EOL
            . '    }' . PHP_EOL;
        $this->assertEquals($expected, $method->toString());
    }
}
