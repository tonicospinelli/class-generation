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

use ClassGeneration\Method;
use ClassGeneration\NamespaceClass;
use ClassGeneration\Writer;
use ClassGeneration\PhpClass;
use ClassGeneration\Property;

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
        $code->setName('FirstClass')
            ->setNamespace(new NamespaceClass('ClassGenerator'))
            ->setDescription('Class description')
            ->setExtends('\ArrayIterator')
            ->addMethod(new Method())
            ->addProperty(new Property());

        $path = $this->path;
        if (!is_dir($path)) {
            $path = './data';
            $i = 0;
            while ($i < 3 and !realpath($path)) {
                $path = '../' . $path;
                $i++;
            }
        }
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $writer = new Writer(array('phpClass' => $code, 'path' => $path,));
        $writer->write();
        $this->assertFileExists($path . '/' . $code->getNamespace()->getPath() . '/' . $code->getName() . '.php');
    }
}
