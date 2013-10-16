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

use ClassGeneration\Method;
use ClassGeneration\NamespaceClass;
use ClassGeneration\Writer;
use ClassGeneration\PhpClass;
use ClassGeneration\Property;


/**
 * @category   ClassGenerator
 * @package    ClassGenerator\PhpClass
 * @copyright  Copyright (c) 2012 ClassGenerator (https://github.com/tonicospinelli/ClassGenerator)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class WriterTest extends \PHPUnit_Framework_TestCase
{

    protected $path = './tests/data';

    public function testCreatingInstanceOfWriterInterface()
    {
        $code = new Writer();
        $this->assertInstanceOf('\ClassGeneration\WriterInterface', $code);
    }

    public function testCreatingInstanceOfWriterInterfaceWithPhpClassObject()
    {
        $code = new Writer(new PhpClass());
        $this->assertInstanceOf('\ClassGeneration\WriterInterface', $code);
    }

    public function testSetAndGetFileName()
    {
        $code = new Writer();
        $code->setFileName('Test');
        $this->assertEquals('Test', $code->getFileName());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testToStringIsNotAllowedMethod()
    {
        $writer = new Writer();
        $writer->toString();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testSetAndGetPath()
    {
        $code = new Writer();
        $code->setPath($this->path);
        $this->assertEquals('./tests/data', $code->getPath());
        $code->setPath('/asd');
    }

    public function testWrite()
    {
        $code = new PhpClass();
        $code->setName('Test')
            ->setNamespace(new NamespaceClass('ClassGenerator'))
            ->setDescription('Class description')
            ->setExtends('\ArrayIterator')
            ->addMethod(new Method())
            ->addProperty(new Property());

        if (!is_dir($this->path)) {
            $path = './data';
            $i = 0;
            while ($i < 3 and !realpath($path)) {
                $path = '../' . $path;
                $i++;
            }
        }
        $writer = new Writer(array('phpClass' => $code, 'path' => $this->path,));
        $writer->write();
        $this->assertFileExists($this->path . '/' . $code->getNamespace()->getPath() . '/' . $code->getName() . '.php');
    }
}
