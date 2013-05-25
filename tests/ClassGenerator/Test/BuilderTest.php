<?php

/**
 * ClassGenerator
 *
 * Copyright (c) 2012 ClassGenerator
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration\Test;

use ClassGeneration\Builder;
use ClassGeneration\Constant;
use ClassGeneration\ConstantCollection;
use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock;
use ClassGeneration\InterfaceCollection;
use ClassGeneration\Method;
use ClassGeneration\MethodCollection;
use ClassGeneration\Property;
use ClassGeneration\PropertyCollection;
use ClassGeneration\UseCollection;

/**
 * @category   ClassGenerator
 * @package    ClassGenerator\Builder
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class BuilderTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfBuilder()
    {
        $code = new Builder();
        $this->assertInstanceOf('\ClassGeneration\Builder', $code);
    }

    public function testSetAndGetName()
    {
        $code = new Builder();
        $code->setName('Test');
        $this->assertEquals('Test', $code->getName());
    }

    public function testSetAndGetNamespace()
    {
        $code = new Builder();
        $code->setNamespace('Builder');
        $this->assertEquals('Builder', $code->getNamespace()->getPath());
    }

    public function testGetFullName()
    {
        $code = new Builder();
        $code->setName('Test');
        $code->setNamespace('Code');
        $this->assertEquals('Code\Test', $code->getFullName());
    }

    public function testSetAndGetAndAddConstants()
    {
        $code = new Builder();
        $code->setConstants(new ConstantCollection(array(
            new Constant(array('name' => 'test1', 'value' => 1))
        )));

        $this->assertInstanceOf('\ClassGeneration\ConstantCollection', $code->getConstants());
        $this->assertInstanceOf('\ClassGeneration\Constant', $code->getConstants()->current());
        $this->assertCount(1, $code->getConstants());
        $this->assertEquals('test1', $code->getConstants()->current()->getName());

        $code->addConstant(new Constant(array('name' => 'test2', 'value' => 1)));
        $this->assertCount(2, $code->getConstants());
        $this->assertEquals('test2', $code->getConstants()->last()->getName());
    }

    public function testSetAndGetAndAddProperties()
    {
        $code = new Builder();
        $code->setProperties(new PropertyCollection(array(
            new Property(array('name' => 'test1', 'value' => 1))
        )));

        $this->assertInstanceOf('\ClassGeneration\PropertyCollection', $code->getProperties());
        $this->assertInstanceOf('\ClassGeneration\Property', $code->getProperties()->current());
        $this->assertCount(1, $code->getProperties());
        $this->assertEquals('test1', $code->getProperties()->current()->getName());

        $code->addProperty(new Property(array('name' => 'test2', 'value' => 1)));
        $this->assertCount(2, $code->getProperties());
        $this->assertEquals('test2', $code->getProperties()->last()->getName());
    }

    public function testGetProperty()
    {
        $code = new Builder();
        $code->setProperties(new PropertyCollection(array(
            new Property(array('name' => 'test', 'value' => 1))
        )));

        $this->assertInstanceOf('\ClassGeneration\PropertyCollection', $code->getProperty('test'));
        $this->assertCount(1, $code->getProperty('test'));
        $this->assertEquals('test', $code->getProperty('test')->current()->getName());
    }

    public function testAddCommentTag()
    {
        $code = new Builder();
        $code->addCommentTag(new Tag(array('name' => Tag::TAG_PARAM)));
        $this->assertCount(1, $code->getDocBlock()->getTagCollection());
    }

    public function testSetAndGetAndAddMethods()
    {
        $code = new Builder();
        $code->setMethods(new MethodCollection(array(
            new Method(array('name' => 'test1'))
        )));

        $this->assertInstanceOf('\ClassGeneration\MethodCollection', $code->getMethods());
        $this->assertInstanceOf('\ClassGeneration\Method', $code->getMethods()->current());
        $this->assertCount(1, $code->getMethods());
        $this->assertEquals('test1', $code->getMethods()->current()->getName());

        $code->addMethod(new Method(array('name' => 'test2')));
        $this->assertCount(2, $code->getMethods());
        $this->assertEquals('test2', $code->getMethods()->last()->getName());
    }

    public function testSetAndGetExtends()
    {
        $code = new Builder();
        $code->setExtends('\SplHeap');
        $this->assertEquals('\SplHeap', $code->getExtends());
    }

    public function testSetAndGetAndAddInterfaces()
    {
        $code = new Builder();
        $code->setInterfaceCollection(new InterfaceCollection(array(
            '\Countable'
        )));

        $this->assertInstanceOf('\ClassGeneration\InterfaceCollection', $code->getInterfaceCollection());
        $this->assertCount(1, $code->getInterfaceCollection());
        $this->assertEquals('\Countable', $code->getInterfaceCollection()->current());

        $code->addInterface('\Traversable');
        $this->assertCount(2, $code->getInterfaceCollection());
        $this->assertEquals('\Traversable', $code->getInterfaceCollection()->last());
    }

    public function testSetAndIsTrait()
    {
        $code = new Builder();
        $code->setIsTrait();
        $this->assertTrue($code->isTrait());
    }

    public function testSetAndIsInterface()
    {
        $code = new Builder();
        $code->setIsInterface();
        $this->assertTrue($code->isInterface());
    }

    public function testSetAndGetDescription()
    {
        $code = new Builder();
        $code->setDescription('Class test');
        $this->assertEquals('Class test', $code->getDocBlock()->getDescription());
    }

    public function testSetAndGetAndAddUse()
    {
        $code = new Builder();
        $code->setUseCollection(new UseCollection(array(
            'ClassGenerator\Builder'
        )));

        $this->assertInstanceOf('\ClassGeneration\UseCollection', $code->getUseCollection());
        $this->assertCount(1, $code->getUseCollection());
        $this->assertEquals('ClassGenerator\Builder', $code->getUseCollection()->current());

        $code->addUse('ClassGenerator\BuilderAbstract', 'Builders');
        $this->assertCount(2, $code->getUseCollection());
        $this->assertEquals('ClassGenerator\BuilderAbstract as Builders', $code->getUseCollection()->last());
    }

    public function testParseToString()
    {
        $code = new Builder();
        $code->setName('Test')
            ->setDescription('Class description')
            ->setExtends('\ArrayIterator')
            ->addMethod(new Method())
            ->addProperty(new Property());
        $expected = '<?php

/**
 * Class description
 * @name Test
 */
class Test extends \ArrayIterator
{

    public $property1;

    public function method1()
    {
        //TODO: implements the method1 method
    }

}';

        $this->assertEquals($expected, $code->toString());
    }

    public function testSaveFile()
    {
        $code = new Builder();
        $code->setName('Test')
            ->setNamespace('ClassGenerator')
            ->setDescription('Class description')
            ->setExtends('\ArrayIterator')
            ->addMethod(new Method())
            ->addProperty(new Property());
        $path = './data';
        $i = 0;
        while ($i < 3 AND !realpath($path)) {
            $path = '../' . $path;
            $i++;
        }

        $code->save($path);
        $this->assertFileExists($path . '/' . $code->getName() . '.php');
    }

    public function testEvaluate()
    {
        $code = new Builder();
        $code->setName('Test')
            ->setDescription('Class description')
            ->setExtends('\ArrayIterator')
            ->addMethod(new Method())
            ->addProperty(new Property());
        $code->evaluate();
        $this->assertTrue(class_exists('\Test'));
    }

    public function testSetAndGetDocBlock()
    {
        $code = new Builder();
        $code->setDescription('first test');
        $this->assertEquals('first test', $code->getDocBlock()->getDescription());
        $code->setDocBlock(new DocBlock(array('description' => 'second test')));
        $this->assertEquals('second test', $code->getDocBlock()->getDescription());
    }

    public function testSetOptions()
    {
        $code = new Builder();
        $code->setOptions(array(
            'description' => 'first test',
        ));
        $this->assertEquals('first test', $code->getDocBlock()->getDescription());
    }

    public function testSetAndGetTabulation()
    {
        $code = new Builder();
        $code->setTabulation(0);
        $this->assertEquals(0, $code->getTabulation());
    }

    public function testGetTabulationFormatted()
    {
        $code = new Builder();
        $code->setTabulation(4);
        $this->assertEquals('    ', $code->getTabulationFormatted());
    }

    public function testSetAndIsFinal()
    {
        $code = new Builder();
        $code->setIsFinal();
        $this->assertTrue($code->isFinal());
    }

    public function testSetAndIsAbstract()
    {
        $code = new Builder();
        $code->setIsAbstract();
        $this->assertTrue($code->isAbstract());
    }

    public function testSetAndIsStatic()
    {
        $code = new Builder();
        $code->setIsStatic();
        $this->assertTrue($code->isStatic());
    }

    public function testMaskValue()
    {
        $code = new Builder();
        $this->assertEquals('1', $code->maskValue(1));
        $this->assertEquals('1.2', $code->maskValue(1.2));
        $this->assertEquals("'test'", $code->maskValue('test'));
        $this->assertEquals('TRUE', $code->maskValue(true));
        $this->assertEquals('array()', $code->maskValue(array()));
        $this->assertEquals('NULL', $code->maskValue(NULL));
    }
}
