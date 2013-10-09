<?php

/**
 * ClassGenerator
 * Copyright (c) 2012 ClassGenerator
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 * @category   ClassGenerator
 * @package    ClassGenerator
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

namespace ClassGeneration\Test;

use ClassGeneration\PhpClass;
use ClassGeneration\Constant;
use ClassGeneration\ConstantCollection;
use ClassGeneration\DocBlock\Tag;
use ClassGeneration\DocBlock;
use ClassGeneration\InterfaceCollection;
use ClassGeneration\Method;
use ClassGeneration\MethodCollection;
use ClassGeneration\NamespaceClass;
use ClassGeneration\Property;
use ClassGeneration\PropertyCollection;
use ClassGeneration\UseClass;
use ClassGeneration\UseCollection;

/**
 * @category   ClassGenerator
 * @package    ClassGenerator\PhpClass
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PhpClassTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingInstanceOfPhpClassInterface()
    {
        $code = new PhpClass();
        $this->assertInstanceOf('\ClassGeneration\PhpClassInterface', $code);
    }

    public function testSetAndGetName()
    {
        $code = new PhpClass();
        $code->setName('Test');
        $this->assertEquals('Test', $code->getName());
    }

    public function testSetAndGetNamespace()
    {
        $code = new PhpClass();
        $code->setNamespace(new NamespaceClass(array('path' => 'PhpClass')));
        $this->assertEquals('PhpClass', $code->getNamespace()->getPath());
    }

    public function testGetFullName()
    {
        $code = new PhpClass();
        $code->setName('Test');
        $code->setNamespace(new NamespaceClass('Code'));
        $this->assertEquals('Code\Test', $code->getFullName());
    }

    public function testSetAndGetAndAddConstants()
    {
        $code = new PhpClass();
        $code->setConstantCollection(
            new ConstantCollection(
                array(
                    new Constant(array('name' => 'test1', 'value' => 1))
                )
            )
        );

        $this->assertInstanceOf('\ClassGeneration\ConstantCollection', $code->getConstantCollection());
        $this->assertInstanceOf('\ClassGeneration\Constant', $code->getConstantCollection()->current());
        $this->assertCount(1, $code->getConstantCollection());
        $this->assertEquals('test1', $code->getConstantCollection()->current()->getName());

        $code->addConstant(new Constant(array('name' => 'test2', 'value' => 1)));
        $this->assertCount(2, $code->getConstantCollection());
        $this->assertEquals('test2', $code->getConstantCollection()->last()->getName());
    }

    public function testSetAndGetAndAddProperties()
    {
        $code = new PhpClass();
        $code->setPropertyCollection(
            new PropertyCollection(
                array(
                    new Property(array('name' => 'test1', 'value' => 1))
                )
            )
        );

        $this->assertInstanceOf('\ClassGeneration\PropertyCollection', $code->getPropertyCollection());
        $this->assertInstanceOf('\ClassGeneration\Property', $code->getPropertyCollection()->current());
        $this->assertCount(1, $code->getPropertyCollection());
        $this->assertEquals('test1', $code->getPropertyCollection()->current()->getName());

        $code->addProperty(new Property(array('name' => 'test2', 'value' => 1)));
        $this->assertCount(2, $code->getPropertyCollection());
        $this->assertEquals('test2', $code->getPropertyCollection()->last()->getName());
    }

    public function testSetAndGetPropertiesAndGenerateMethodsGettersAndSetters()
    {
        $code = new PhpClass();
        $code->setPropertyCollection(
            new PropertyCollection(array(new Property(array('name' => 'test1', 'value' => 1))))
        );

        $code->generateGettersAndSettersFromProperties();

        $this->assertCount(1, $code->getPropertyCollection());
        $this->assertEquals('test1', $code->getPropertyCollection()->current()->getName());

        $this->assertCount(2, $code->getMethodCollection());
        $this->assertEquals('getTest1', $code->getMethodCollection()->current()->getName());
        $this->assertEquals('setTest1', $code->getMethodCollection()->last()->getName());
    }

    public function testGetProperty()
    {
        $code = new PhpClass();
        $code->setPropertyCollection(
            new PropertyCollection(
                array(
                    new Property(array('name' => 'test', 'value' => 1))
                )
            )
        );

        $this->assertInstanceOf('\ClassGeneration\PropertyCollection', $code->getProperty('test'));
        $this->assertCount(1, $code->getProperty('test'));
        $this->assertEquals('test', $code->getProperty('test')->current()->getName());
    }

    public function testAddCommentTag()
    {
        $code = new PhpClass();
        $code->addCommentTag(new Tag(array('name' => Tag::TAG_PARAM)));
        $this->assertCount(1, $code->getDocBlock()->getTagCollection());
    }

    public function testSetAndGetAndAddMethods()
    {
        $code = new PhpClass();
        $code->setMethodCollection(
            new MethodCollection(
                array(
                    new Method(array('name' => 'test1'))
                )
            )
        );

        $this->assertInstanceOf('\ClassGeneration\MethodCollection', $code->getMethodCollection());
        $this->assertInstanceOf('\ClassGeneration\Method', $code->getMethodCollection()->current());
        $this->assertCount(1, $code->getMethodCollection());
        $this->assertEquals('test1', $code->getMethodCollection()->current()->getName());

        $code->addMethod(new Method(array('name' => 'test2')));
        $this->assertCount(2, $code->getMethodCollection());
        $this->assertEquals('test2', $code->getMethodCollection()->last()->getName());
    }

    public function testSetAndGetExtends()
    {
        $code = new PhpClass();
        $code->setExtends('\SplHeap');
        $this->assertEquals('\SplHeap', $code->getExtends());
    }

    public function testSetAndGetAndAddInterfaces()
    {
        $code = new PhpClass();
        $code->setInterfaceCollection(new InterfaceCollection(array('\Traversable')));

        $this->assertInstanceOf('\ClassGeneration\InterfaceCollection', $code->getInterfaceCollection());
        $this->assertCount(1, $code->getInterfaceCollection());
        $this->assertEquals('\Traversable', $code->getInterfaceCollection()->current());

        $code->addInterface('\Countable');
        $this->assertCount(2, $code->getInterfaceCollection());
        $this->assertEquals('\Countable', $code->getInterfaceCollection()->last());
    }

    public function testSetAndIsTrait()
    {
        $code = new PhpClass();
        $code->setIsTrait();
        $this->assertTrue($code->isTrait());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetAndIsInterface()
    {
        $code = new PhpClass();
        $code->setIsInterface();
        $this->assertTrue($code->isInterface());
        $code->setIsAbstract();
    }

    public function testSetAndGetDescription()
    {
        $code = new PhpClass();
        $code->setDescription('Class test');
        $this->assertEquals('Class test', $code->getDocBlock()->getDescription());
    }

    public function testSetAndGetAndAddUse()
    {
        $code = new PhpClass();
        $code->setUseCollection(
            new UseCollection(array(new UseClass(array('className' => 'ClassGeneration\PhpClass'))))
        );

        $this->assertInstanceOf('\ClassGeneration\UseCollection', $code->getUseCollection());
        $this->assertCount(1, $code->getUseCollection());
        $this->assertEquals(
            'ClassGeneration\PhpClass',
            $code->getUseCollection()->current()->getClassName()
        );

        $code->addUse(
            new UseClass(
                array(
                    'className' => 'ClassGeneration\PropertyCollection',
                    'alias'     => 'Properties'
                )
            )
        );
        $this->assertCount(2, $code->getUseCollection());
        $this->assertEquals(
            'use ClassGeneration\PropertyCollection as Properties;' . PHP_EOL,
            $code->getUseCollection()->last()->toString()
        );
    }

    public function testParseClassToString()
    {
        $code = new PhpClass();
        $code->setName('Test')
            ->setDescription('Class description')
            ->setExtends('\ArrayIterator')
            ->addMethod(new Method())
            ->addProperty(new Property());
        $expected = '<?php' . PHP_EOL
            . '' . PHP_EOL
            . '/**' . PHP_EOL
            . ' * Class description' . PHP_EOL
            . ' * @name Test' . PHP_EOL
            . ' */' . PHP_EOL
            . 'class Test extends \ArrayIterator' . PHP_EOL
            . '{' . PHP_EOL
            . '' . PHP_EOL
            . '    public $property1;' . PHP_EOL
            . '' . PHP_EOL
            . '    public function method1()' . PHP_EOL
            . '    {' . PHP_EOL
            . '        //TODO: implements the method1 method' . PHP_EOL
            . '    }' . PHP_EOL
            . '}' . PHP_EOL;
        $this->assertEquals($expected, $code->toString());
    }

    public function testParseInterfaceToString()
    {
        $code = new PhpClass();
        $code->setName('Test')
            ->setDescription('Class description')
            ->setIsInterface()
            ->addMethod(new Method(array('isInterface' => true)));
        $expected = '<?php' . PHP_EOL
            . '' . PHP_EOL
            . '/**' . PHP_EOL
            . ' * Class description' . PHP_EOL
            . ' * @name Test' . PHP_EOL
            . ' */' . PHP_EOL
            . 'interface Test' . PHP_EOL
            . '{' . PHP_EOL
            . '' . PHP_EOL
            . '    public function method1();' . PHP_EOL
            . '}' . PHP_EOL;
        $this->assertEquals($expected, $code->toString());
    }

    public function testParseAbstractClassToString()
    {
        $code = new PhpClass();
        $code->setName('Test')
            ->setDescription('Class description')
            ->setIsAbstract()
            ->addMethod(new Method(array('isAbstract' => true)));
        $expected = '<?php' . PHP_EOL
            . '' . PHP_EOL
            . '/**' . PHP_EOL
            . ' * Class description' . PHP_EOL
            . ' * @name Test' . PHP_EOL
            . ' */' . PHP_EOL
            . 'abstract class Test' . PHP_EOL
            . '{' . PHP_EOL
            . '' . PHP_EOL
            . '    abstract public function method1();' . PHP_EOL
            . '}' . PHP_EOL;
        $this->assertEquals($expected, $code->toString());
    }

    public function testParseFinalClassToString()
    {
        $code = new PhpClass();
        $code->setName('Test')
            ->setDescription('Class description')
            ->setIsFinal()
            ->addMethod(new Method(array('isFinal' => true)));
        $expected = '<?php' . PHP_EOL
            . '' . PHP_EOL
            . '/**' . PHP_EOL
            . ' * Class description' . PHP_EOL
            . ' * @name Test' . PHP_EOL
            . ' */' . PHP_EOL
            . 'final class Test' . PHP_EOL
            . '{' . PHP_EOL
            . '' . PHP_EOL
            . '    final public function method1()' . PHP_EOL
            . '    {' . PHP_EOL
            . '        //TODO: implements the method1 method' . PHP_EOL
            . '    }' . PHP_EOL
            . '}' . PHP_EOL;
        $this->assertEquals($expected, $code->toString());
    }

    public function testParseTraitToString()
    {
        $code = new PhpClass();
        $code->setName('Test')
            ->setDescription('Class description')
            ->setIsTrait()
            ->addMethod(new Method());
        $expected = '<?php' . PHP_EOL
            . '' . PHP_EOL
            . '/**' . PHP_EOL
            . ' * Class description' . PHP_EOL
            . ' * @name Test' . PHP_EOL
            . ' */' . PHP_EOL
            . 'trait Test' . PHP_EOL
            . '{' . PHP_EOL
            . '' . PHP_EOL
            . '    public function method1()' . PHP_EOL
            . '    {' . PHP_EOL
            . '        //TODO: implements the method1 method' . PHP_EOL
            . '    }' . PHP_EOL
            . '}' . PHP_EOL;
        $this->assertEquals($expected, $code->toString());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSaveFile()
    {
        $code = new PhpClass();
        $code->setName('Test')
            ->setNamespace(new NamespaceClass('ClassGenerator'))
            ->setDescription('Class description')
            ->setExtends('\ArrayIterator')
            ->addMethod(new Method())
            ->addProperty(new Property());
        $path = './tests/data';
        if (!is_dir('./tests/data')) {
            $path = './data';
            $i = 0;
            while ($i < 3 and !realpath($path)) {
                $path = '../' . $path;
                $i++;
            }
        }
        $code->save($path, null, true);
        $this->assertFileExists($path . '/' . $code->getNamespace()->getPath() . '/' . $code->getName() . '.php');
        $code->save('/asd');
    }

    public function testEvaluate()
    {
        $code = new PhpClass();
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
        $code = new PhpClass();
        $code->setDescription('first test');
        $this->assertEquals('first test', $code->getDocBlock()->getDescription());
        $code->setDocBlock(new DocBlock(array('description' => 'second test')));
        $this->assertEquals('second test', $code->getDocBlock()->getDescription());
    }

    public function testSetOptions()
    {
        $code = new PhpClass();
        $code->setOptions(array('description' => 'first test'));
        $this->assertEquals('first test', $code->getDocBlock()->getDescription());
    }

    public function testSetAndGetTabulation()
    {
        $code = new PhpClass();
        $code->setTabulation(0);
        $this->assertEquals(0, $code->getTabulation());
    }

    public function testGetTabulationFormatted()
    {
        $code = new PhpClass();
        $code->setTabulation(4);
        $this->assertEquals('    ', $code->getTabulationFormatted());
    }

    public function testSetAndIsFinal()
    {
        $code = new PhpClass();
        $code->setIsFinal();
        $this->assertTrue($code->isFinal());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetAndIsAbstract()
    {
        $code = new PhpClass();
        $code->setIsAbstract();
        $this->assertTrue($code->isAbstract());
        $code->setIsInterface();
    }
}
